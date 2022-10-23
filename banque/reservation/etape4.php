<?php 
    if(empty($_SESSION))session_start();
    if(empty($_SESSION['user']))    header('location: login.php');


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


<div class="container-fluid ">
    <?php
echo'<h1 class= " text-center mx-auto text-primary my-2">Choisir le mode de paiement</h1>';
                echo'<div class="row  justify-center gy-3 d-flex shadow row-cols-4">';
                    $ch = curl_init();
                    $header   = array();
                    $header[] = 'Authorization: Bearer ' . $_SESSION['access_token'];
                    
                    $header[] = 'Content-Type:  application/json ';
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                    curl_setopt($ch,CURLOPT_URL,'https://api.eticket.sn/eticket/entity/findAllPaymentPartners/SN');
                    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
                    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
                    $payement = curl_exec($ch);
                    if($e = curl_error($ch)){
                        echo $e;
                    }else{
                        $payement_array = json_decode($payement, true);
                        foreach($payement_array as $key => $value){
                            echo '<a class="col card bg-light m-2 shadow p-1 py-2 d-flex mx-auto flex-column-reverse align-items-center justify-evenly"  href="#" ><h4 class="text-white h6 rounded bg-primary p-2 my-1 " >Payez avec '.$value[name].'</h4> <img src='.$value[logoUrl].' class="img-fluid card-img-top w-75 my-3"/></a>'; 
                        }
                    }
                    curl_close($ch);
                echo'</div>';

?>
</div>



</body>
</html>