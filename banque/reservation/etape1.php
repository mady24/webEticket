<?php 
    if(empty($_SESSION))session_start();
    if(empty($_SESSION['user']))header('location: login.php');
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

<?php
echo'<div class="container-fluid bg-light">';
    $header   = array();
    $header[] = 'Authorization: Bearer ' . $_SESSION['access_token'];
    $header[] = 'Content-Type:  application/json ';
    // Affichage des banques
    echo'<h1 class= " text-center mx-auto text-primary ">Liste des banques</h1>';
    echo'<div class="row bg-light justify-center gy-3 d-flex shadow row-cols-4">';
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
            
            foreach($banque_array as $key => $value){
                    $no_images = array("0","1","4","6","9","10","13","14","15","17","18","19");
                if(!in_array($key,$no_images)){
                    //echo '<a class="col card bg-light m-2 p-1 py-2 d-flex mx-auto flex-column-reverse align-items-center justify-evenly"  href="http://localhost/webEticket/banque/reservation/etape2.php?id='.$value[id].'" ><h4 class="text-white h6 rounded bg-primary p-2 my-1 " >Réserver un ticket</h4> <img src='.$value[logoUrl].' class="img-fluid card-img-top w-75"/></a>';
                    echo '<div class="col card bg-light m-2 p-1 py-2 d-flex mx-auto flex-column-reverse align-items-center justify-evenly"  onclick="send('.$value['id'].')" ><img src='.$value['logoUrl'].' class="img-fluid card-img-top w-75"/></div>';
                }
            }
        }
        curl_close($ch);
    echo'</div>';

                        
echo"</div>";
?>
<script>
var form = jQuery('#etape1');
   
    function send(id){
        var url = 'ajax.php?rubrique=<?php echo @$_SESSION['rubrique']; ?>&etape=etape2&id='+id;
        
            $.ajax({
                type: "GET",
                url: url,
                //data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    jQuery('#reservation').html(data);
                    //alert(data); // show response from the php script.
                }
            });
        }
    function send1(){
        var url = 'ajax.php?rubrique=<?php echo @$_SESSION['rubrique']; ?>&etape=etape1';
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
    

