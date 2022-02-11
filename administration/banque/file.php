<?php
if (!empty($_POST)) {
    $data = array();
    $data['idAgence'] = 1;
    $data = json_encode($data);

    $url = "http://localhost/eticket/public/index.php/addFile/" . $data;
    $ch = curl_init($url);
    $result = curl_exec($ch);
    curl_close($ch);
}
$result = file_get_contents("http://localhost/eticket/public/index.php/showFile/");
/*$url = "http://localhost/eticket/public/index.php/showRegion/";
$ch = curl_init($url);
$result = curl_exec($ch);
curl_close($ch);*/
$region = json_decode($result,true);
?>

<div class="row">
    <!--<div class="col-6">
        <form method="post" id="file">
            <input type="text" name="agence" placeholder="agence">
            <input type="text" name="adresse" placeholder="adresse">
            <input type="text" name="phone" placeholder="phone">
            <input type="submit" value="Ajouter">
        </form>
    </div>-->
    <div class="col-12">
        <table class="table">
        <thead>
            <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Agence</th>
                    <th scope="col">Nombre de numero</th>
                    <th scope="col">Nombre de numero apple</th>
                    <th scope="col">Date</th>
            </tr>
            </thead>
            <tbody>
        <?php
        foreach($region as $key => $region){
            echo "<tr><th scope='row'>".$key."</th>";
            echo "<td>".$region['nomAgence']."</td>";
            echo "<td>".$region['Count']."</td>";
            echo "<td>".$region['Call']."</td>";
            echo "<td>".$region['Date']."</td>";
        }
        ?>
        </tbody>
        </table>
    </div>
</div>

<script>
    var form = jQuery('#file');

    function send1() {
        var url = 'ajax.php?rubrique=<?php echo @$_SESSION['rubrique']; ?>&etape=file';
        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // serializes the form's elements.
            success: function(data) {
                jQuery('#reservation').html(data);
                //alert(data); // show response from the php script.
            }
        });
    }
</script>