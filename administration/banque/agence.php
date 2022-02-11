<?php
if (!empty($_POST)) {
    $data = array();
    $data['nomAgence'] = $_POST['agence'];
    $data['address'] = $_POST['adresse'];
    $data['phone'] = $_POST['phone'];
    $data['IDBank'] = $_POST['banque'];
    $data['IDRegion'] = $_POST['region'];
    $data = json_encode($data);
    $data  = str_replace(' ', '%20', $data);
    $url = "http://localhost/eticket/public/index.php/addAgence/" . $data;
    $ch = curl_init($url);
    $result = curl_exec($ch);
    curl_close($ch);
}
$result = file_get_contents("http://localhost/eticket/public/index.php/showAgence/");
$agence = json_decode($result, true);
$result = file_get_contents("http://localhost/eticket/public/index.php/showBank/");
$bank = json_decode($result, true);
$result = file_get_contents("http://localhost/eticket/public/index.php/showRegion/");
$region = json_decode($result, true);


?>

<div class="row">
    <div class="col-12">
        <form method="post" id="agence">
            <div class="row">
                <div class="col-6">
                    <input type="text" name="agence" placeholder="agence" class="form-control">
                </div>
                <div class="col-6">
                    <input type="text" name="adresse" placeholder="adresse" class="form-control col-auto">
                </div>
                <div class="col-6 mt-2">
                    <input type="text" name="phone" placeholder="phone" class="form-control col-auto">
                </div>
                <div class="col-3 mt-2">
                    <select name="banque" id="banque" class="form-control col-auto">
                        <?php
                        foreach ($bank as $ID => $data) echo "<option value='" . $ID . "'>" . $data['nomBank'] . "</option>";
                        ?>
                    </select>
                </div>
                <div class="col-3 mt-2">
                    <select name="region" id="region" class="form-control col-auto">
                        <?php
                        foreach ($region as $ID => $data) echo "<option value='" . $ID . "'>" . $data['nomRegion'] . "</option>";
                        ?>
                    </select>
                </div>
                <div class="col-auto mt-2">
                    <input type="submit" value="Ajouter" class="btn btn-success col-auto">
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
                    <th scope="col">Adresse</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Banque</th>
                    <th scope="col">Region</th>
                    <th scope="col" class="text-right">Statut</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($agence as $key => $region) {
                    if ($region['Statut'] == true) $status = "<i class='fa fa-eye text-success'></i>";
                    else $status = "<i class='fa fa-eye-slash text-danger'>";
                    echo "<tr><th  scope='row'>" . $key . "</th>";
                    echo "<td>" . $region['nomAgence'] . "</td>";
                    echo "<td>" . $region['address'] . "</td>";
                    echo "<td>" . $region['phone'] . "</td>";
                    echo "<td>" . $region['nomBank'] . "</td>";
                    echo "<td>" . $region['nomRegion'] . "</td>";
                    echo "<td class='text-right'>" . $status . "</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    var form = jQuery('#agence');

    function send1() {
        var url = 'ajax.php?rubrique=<?php echo @$_SESSION['rubrique']; ?>&etape=agence';
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