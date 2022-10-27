<?php 
    if(empty($_SESSION))session_start();
    if(empty($_SESSION['user'])){header('location: login.php');}else{

        $_SESSION['ID'] = $_POST['region'];
        $_SESSION['agence_id'] = $_POST['agence'];

        if(empty($_SESSION['banque_id'])){$_SESSION['banque_id'] = $_GET['id'];};
        //Récupération des regions
        $header   = array();
        $header[] = 'Authorization: Bearer ' . $_SESSION['access_token'];
        $header[] = 'Content-Type:  application/json ';
        $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch,CURLOPT_URL,'https://api.eticket.sn/eticket/entity/findRegions/SN');
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            $regions = curl_exec($ch);
            if($e = curl_error($ch)){
                echo $e;
            }else{
                $regions_array = json_decode($regions, true);
            }
        curl_close($ch);
    }
    // Récupération des agences de la region     
    if(!empty($_POST['region'])){
        $header   = array();
        $header[] = 'Authorization: Bearer ' . $_SESSION['access_token'];
        $header[] = 'Content-Type:  application/json ';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch,CURLOPT_URL,"https://api.eticket.sn/eticket/entity/findAllAgencies/".$_SESSION['banque_id']."/QUEUE_MANAGEMENT"."/".$_POST['region']);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $agences = curl_exec($ch);
        if($e = curl_error($ch)){
            echo $e;
        }else{
            $agences_array = json_decode($agences, true);
        }
        curl_close($ch);
    }
    if(!empty($_POST['agence'])){
        $header   = array();
        $header[] = 'Authorization: Bearer ' . $_SESSION['access_token'];
        $header[] = 'Content-Type:  application/json ';
        $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch,CURLOPT_URL,'https://api.eticket.sn/eticket/entity/findAllService/'.$_SESSION["agence_id"].'/QUEUE_MANAGEMENT');
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            $service = curl_exec($ch);
            if($e = curl_error($ch)){
                echo $e;
            }else{
                $service_array = json_decode($service, true);
            }
            curl_close($ch);
        }

?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Eticket</title>

    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
    <script src="../../js/jquery-3.4.1.min.js"></script>
</head>
<body>


<div class="container-fluid bg-light py-2">
<?php echo'<h1 class= " text-center mx-auto text-primary my-2">Reservez un ticket</h1>';?>
<hr>
<form id='etape1'>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="region">Région</label>
            <select id="region" name="region" value='<?php echo $_POST['region'];?>' onchange='send();' class="form-control">
                <option value="0">...</option>
                <?php
            foreach($regions_array as $ID => $tb){
                if($tb['id'] == $_POST['region'])
                echo "<option selected value='".$tb['id']."'>".$tb['name']."</option>";
                else echo "<option value='".$tb['id']."'>".$tb['name']."</option>";
                
            }

            ?>
      </select>
      
        </div>
        <div class="form-group col-md-6">
        <label for="agence">Agence</label>
        <select id="agence" name="agence" class="form-control" onchange='send2();' value='<?php echo $_POST['agence'];?>'>
            <option value="0">...</option>
            <?php
            foreach($agences_array as $ID => $tb){
                if($tb['id'] == $_POST['agence'])
                echo "<option selected value='".$tb['id']."'>".$tb['name']."</option>";
                else echo "<option value='".$tb['id']."'>".$tb['name']."</option>";
                
            }
            ?>
      </select>
        </div>
        <div class="form-group col-md-6">
      <label for="service">Service</label>
      <select id="service" name='service' class="form-control">
        <option selected>Caisse</option>
        <?php
            foreach($service_array as $ID => $tb){
                if($tb['id'] == $_POST['agence'])
                echo "<option selected value='".$tb['id']."'>".$tb['name']."</option>";
                else echo "<option value='".$tb['id']."'>".$tb['name'];
            }
        ?>

      </select>
    </div>
    <div class="form-group col-md-6">
    <label for="date">Date</label>
    <input type="date" class="form-control" id="date" name="date" placeholder="1234 Main St">
  </div>
    </div>
    <div class="btn btn-primary w-100 mt-4" onclick="send1();">Valider</div>
</form>
</div>


<script> 
  
var form = jQuery('#etape1');
    
    function send(){
        var url = 'ajax.php?rubrique=<?php echo @$_SESSION['rubrique']; ?>&etape=etape2&id=<?php echo @$_SESSION['ID']; ?>';
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
    function send2(){
        var url = 'ajax.php?rubrique=<?php echo @$_SESSION['rubrique']; ?>&etape=etape2&id=<?php echo @$_SESSION['agence_id']; ?>';
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
    function send1(){
        var url = 'ajax.php?rubrique=<?php echo @$_SESSION['rubrique']; ?>&etape=etape3&id=<?php echo @$_SESSION['ID']; ?>';
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

</body>
</html>