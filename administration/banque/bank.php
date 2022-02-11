<?php
if (!empty($_POST)) {
   // print_r($_POST);exit;
    $data = array();
    // Ajout image
    $target_dir = "img/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $imageName = $_FILES["fileToUpload"]["name"];
    $imageNameTMP = $_FILES["fileToUpload"]["tmp_name"];
    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    //End Ajout image
    $data['nomBank'] = $_POST['bank'];
    $data['address'] = $_POST['adresse'];
    $data['phone'] = $_POST['phone'];
    $data['image'] = $imageName;
    $data = json_encode($data);
    $data = str_replace(' ', '%20', $data);
    $url = "http://localhost/eticket/public/index.php/addBank/" . $data;
    //print_r($url);exit;
    $ch = curl_init($url);
    $result = curl_exec($ch);
    curl_close($ch);
}
$result = file_get_contents("http://localhost/eticket/public/index.php/showBank/");
$region = json_decode($result, true);
?>

<div class="row">
    <div class="col-12">
        <form method="post" enctype="multipart/form-data" id="bank">
            <div class="row">
                <div class="col-6">
                    <input type="text" name="bank" placeholder="bank" class="form-control">
                </div>
                <div class="col-6">
                    <input type="text" name="adresse" placeholder="adresse" class="form-control">
                </div>
                <div class="col-6">
                    <input type="text" name="phone" placeholder="phone" class="form-control">
                </div>
                <div class="col-6">
                    <input type="file" name="fileToUpload" id="fileToUpload" class="form-control">
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
                    <th scope="col">Adresse</th>
                    <th scope="col">Phone</th>
                    <th scope="col" class="text-right">Statut</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($region as $key => $region) {
                    if ($region['Statut'] == true) $status = "<i class='fa fa-eye text-success'></i>";
                    else $status = "<i class='fa fa-eye-slash text-danger'>";
                    echo "<tr><th scope='row'>" . $key . "</th>";
                    echo "<td>" . $region['nomBank'] . "</td>";
                    echo "<td>" . $region['address'] . "</td>";
                    echo "<td>" . $region['phone'] . "</td>";
                    echo "<td class='text-right'>" . $status . "</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    var form = jQuery('#bank');

    function send1() {
        var url = 'ajax.php?rubrique=<?php echo @$_SESSION['rubrique']; ?>&etape=region';
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