<?php
$Data = array(0=>array('img'=>'','name'=>'CONCERT','color'=>'orange'),1=>array('img'=>'','name'=>'SPECTACLE','color'=>'blue'),2=>array('img'=>'','name'=>'CINEMA','color'=>'green'));
$Data1 = array(0=>array('img'=>'','name'=>'EVENT1','color'=>'orange'),1=>array('img'=>'','name'=>'EVENT2','color'=>'blue'),2=>array('img'=>'','name'=>'EVENT3','color'=>'green'));
    $jsonData = json_encode($Data);
    $Data = json_decode($jsonData,true);
    $_SESSION['ID'] = $_GET['id'];
?>
<div class="w-100 d-flex align-items-middle">
    <!--<img src="<?php //echo $Data[$_SESSION['ID']]['img']; ?>" alt="<?php //echo $Data[$_SESSION['ID']]['name']; ?>">-->
    <?php echo $Data[$_SESSION['ID']]['name']; ?>
</div>
<hr>
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
    //echo $_POST['nom'];
        foreach($Data1 as $ID => $tb){
            $div = '<div class="col-lg-4 col-md-6 col-sm-12" style="height: 200px !important;" onclick="send('.$_SESSION['ID'].','.$ID.');">
            <div class="bg-white border rounded h-100 row m-2" style="border-color:'.$tb['color'].' !important;">
                <div class="col-6 m-auto">
                    <img src="'.$tb['img'].'" alt="'.$tb['name'].'">
                </div>
                <div class="col-6 m-auto">
                    '.$tb['name'].'
                </div>
            </div>
        </div>';
            if(empty($_POST['nom']))echo $div;
            else if(!empty($_POST['nom']) && stripos($tb['name'],$_POST['nom']) !== false)echo $div;
           
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
    
    function send(id,id1){
        var url = 'ajax.php?rubrique=<?php echo @$_SESSION['rubrique']; ?>&etape=etape3&id='+id+'&idSub='+id1;
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
        var url = 'ajax.php?rubrique=<?php echo @$_SESSION['rubrique']; ?>&etape=etape2';
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