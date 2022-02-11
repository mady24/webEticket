<?php
if (!empty($_POST)) {
    $data = array();
    $data['nomRegion'] = $_POST['region'];
    $data = json_encode($data);

    $url = "http://localhost/eticket/public/index.php/addRegion/" . $data;
    $ch = curl_init($url);
    $result = curl_exec($ch);
    curl_close($ch);
}
$result = file_get_contents("http://localhost/eticket/public/index.php/showRegion/");
$region = json_decode($result,true);
?>

<div class="row p-0 m-0">
    <div class="col-12">
        <form method="post" id="region">
            <div class="row">
                <div class="col-6">
            <input type="text" name="region" placeholder="region" class="form-control">
                </div>
                <div class="col-auto">
            <input type="submit" value="Ajouter" class="btn btn-success">
                </div>
            </div>
        </form>
    </div>
    <div class="col-12 mt-2">
        <table class="table">
        <thead>
            <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nom</th>
                    <th scope="col" class="text-right">Statut</th>
            </tr>
            </thead>
            <tbody>
        <?php
        foreach($region as $key => $region){
            if($region['Statut'] == true)$status = "<i class='fa fa-eye text-success'></i>";
            else $status = "<i class='fa fa-eye-slash text-danger'>";
            echo "<tr><th  scope='row'>".$key."</th>";
            echo "<td>".$region['nomRegion']."</td>";
            echo "<td class='text-right'>".$status."</i></td></tr>";
        }
        ?>
        </tbody>
        </table>
    </div>
</div>
<script>
var form = jQuery('#region');
    
    function send1(){
        var url = 'ajax.php?rubrique=<?php echo @$_SESSION['rubrique']; ?>&etape=region';
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    jQuery('#reservation').html(data);
                    //alert(data); // show response from the php script.
                }
            });
        }
</script>