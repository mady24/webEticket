<?php

$result = file_get_contents("http://localhost/eticket/public/index.php/showBank/");
$Data = json_decode($result, true);
?>
<div>
    <form id="etape1">
        <div class="form-row">
            <div class="form-group col-md-12">
                <input type="text" name="nom" class="w-100" id="nom" placeholder="chercher une banque" onkeyup="send1();" value="<?php echo @$_POST['nom']; ?>">
            </div>
        </div>
    </form>
</div>
<div class="row p-0 m-0 y-auto">
    <?php
    echo @$_POST['nom'];
        foreach($Data as $ID => $tb){
            $div = '<div class="col-lg-4 col-md-6 col-sm-12" style="height: 200px !important; "  onclick="send('.$ID.');">
            <div class="bg-white border rounded h-100 row m-2" style="border-color:primary !important; background-image: linear-gradient(rgba(255,255,255,0.8), rgba(255,255,255,0.8)), url(img/'.$tb['image'].'); background-size:cover;">
                <div class="col-12 m-auto text-center text-dark" style="font-size:50px;">
                    '.$tb['nomBank'].'
                </div>
            </div>
        </div>';
            if(empty($_POST['nom']))echo $div;
            else if(!empty($_POST['nom']) && stripos($tb['nomBank'],$_POST['nom']) !== false)echo $div;
           
        }
    ?>
    <!--<div class="col-lg-4 col-md-6 col-sm-12" style="height: 200px !important;">
        <div class="bg-white border border-primary rounded h-100 row m-2">
            <div class="col-6 m-auto">
                <img src="" alt="CORIS BANK">
            </div>
            <div class="col-6 m-auto">
                CORIS BANK
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12" style="height: 200px !important;">
        <div class="bg-white border border-danger rounded h-100 row m-2">
            <div class="col-6 m-auto">
                <img src="" alt="BHS">
            </div>
            <div class="col-6 m-auto">
                BHS
            </div>
        </div>
    </div>
</div>-->
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