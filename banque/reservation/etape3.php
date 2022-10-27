
<?php
if(empty($_SESSION))session_start();
//Set Headers
$header   = array();
$header[] = 'Authorization: Bearer' . $_SESSION['access_token'];
$header[] = 'Content-Type:  application/json ';

// Récuperation de la banque 
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch,CURLOPT_URL,'https://api.eticket.sn/eticket/entity/findAllCompanies/SN/QUEUE_MANAGEMENT');
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    $banque = curl_exec($ch);
    if($e = curl_error($ch)){
        echo $e;
    }else{
        $banque_array = json_decode($banque, true);
        // print_r($Data);
    }
curl_close($ch);

// Récuperation de la region
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

//Récuperation de l'agence de la banque;
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
<style>
    .title{
        font-style: bold;
        color:black;
    }
    .content{
        color: blue;
        font-style: italic;
    }
    
    
</style> 
<div class="d-flex flex-column border shadow w-75 mx-auto align-items-middle p-2">

    <div class="d-flex  border-bottom-primary flex-column">
        <?php foreach ($banque_array as $data) {
            if ($data['id'] == $_SESSION['banque_id']) {?>
            <img class="img-fluid w-50 mx-auto " src="<?php echo $data['logoUrl']; ?>" alt="<?php echo $data['name']; ?>" >
            <span class="h3 text-primary bold mx-auto"><?php echo $data['name']?></span>
        <?php }}?>
    </div>

    <div class="d-flex flex-column justify-between">
       <div class="py-2 d-flex justify-between"><span class="title h4">Région :</span><span class="content h4">
            <?php
            foreach ($regions_array as $data) {
                if ($data['id'] == $_POST['region']) {?>
                    <?php echo $data['name']; 
                }} 
            ?>
        </span></div>
            <div class="py-2"><span class="title h4 ">Agence :</span><span class="content h4">
            <?php
            foreach ($agences_array as $data) {
                if ($data['id'] == $_POST['agence']) {?>
                    <?php echo $data['name']; 
                }} 
            ?>
        </span></div>
        <div class="py-2"><span class="title h4  ">Service :</span><span class="content h4"><?php echo $_POST['service']; ?></span></div>
        <div class="py-2"><span class="title h4 ">Date :</span><span class="content h4"><?php echo $_POST['date']; ?></span></div>
    </div>
    <form id='etape1'>
        <input type="hidden" class="form-control" id="region" name="region" value="<?php echo $_POST['region']; ?>">
        <input type="hidden" class="form-control" id="agence" name="agence" value="<?php echo $_POST['agence']; ?>">
        <input type="hidden" class="form-control" id="service" name="service" value="<?php echo $_POST['service']; ?>">
        <input type="hidden" class="form-control" id="date" name="date" value="<?php echo $_POST['date']; ?>">
        <div class="btn btn-primary w-100 my-3" onclick="send1();">Confirmer</div>
    </form>

</div>
<script>
    
    var form = jQuery('#etape1');
    
    function send1(){
        var url = 'ajax.php?rubrique=<?php echo @$_SESSION['rubrique']; ?>&etape=etape4&id=<?php echo @$_SESSION['ID']; ?>';
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
