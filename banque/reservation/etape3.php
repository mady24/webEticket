<?php
$result = file_get_contents("http://localhost/eticket/public/index.php/showBankByID/".$_GET['id']);
$Data = json_decode($result, true); 
$result = file_get_contents("http://localhost/eticket/public/index.php/showRegion/");
$tbRegion = json_decode($result,true);
$result = file_get_contents("http://localhost/eticket/public/index.php/showAgenceByBankRegion/".$_GET['id']."/".$_POST['region']);
$tbAgence = json_decode($result, true);
$_SESSION['ID'] = $_GET['id'];
?>
<style>
    .title{
        color: grey;
        font-style: bold;
        font-size: 100%;
    }
    .content{
        color: grey;
        font-style: bold;
        font-size: 100%;
    }
</style> 
<div class="w-100 d-flex align-items-middle">
    <img src="img/<?php echo $Data[$_SESSION['ID']]['image']; ?>" alt="<?php echo $Data[$_SESSION['ID']]['nomBanque']; ?>" style="height:30px;">
    <?php echo $Data[$_SESSION['ID']]['nomBanque']; ?>
</div>
<hr>

<div>
    <span class="title">Région :</span><span class="content"><?php echo $tbRegion[$_POST['region']]['nomRegion']; ?></span><br/>
    <span class="title">Agence :</span><span class="content"><?php echo $tbAgence[$_POST['agence']]['nomAgence']; ?></span><br/>
    <span class="title">Service :</span><span class="content"><?php echo $_POST['service']; ?></span><br/>
    <span class="title">Date :</span><span class="content"><?php echo $_POST['date']; ?></span><br/>
</div>
<form id='etape1'>
    <input type="hidden" class="form-control" id="region" name="region" value="<?php echo $_POST['region']; ?>">
    <input type="hidden" class="form-control" id="agence" name="agence" value="<?php echo $_POST['agence']; ?>">
    <input type="hidden" class="form-control" id="service" name="service" value="<?php echo $_POST['service']; ?>">
    <input type="hidden" class="form-control" id="date" name="date" value="<?php echo $_POST['date']; ?>">
    <div class="btn btn-primary" onclick="send1();">Valider</div>
</form>

<script>

var form = jQuery('#etape1');
    
    function send1(){
        var url = 'ajax.php?rubrique=<?php echo @$_SESSION['rubrique']; ?>&etape=etape5&id=<?php echo @$_SESSION['ID']; ?>';
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