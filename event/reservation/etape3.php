<?php
    $Data = array(0=>array('img'=>'','name'=>'CONCERT','color'=>'orange'),1=>array('img'=>'','name'=>'SPECTACLE','color'=>'blue'),2=>array('img'=>'','name'=>'CINEMA','color'=>'green'));
    $Data1 = array(0=>array('img'=>'','name'=>'EVENT1','color'=>'orange'),1=>array('img'=>'','name'=>'EVENT2','color'=>'blue'),2=>array('img'=>'','name'=>'EVENT3','color'=>'green'));
$_SESSION['ID'] = $_GET['id'];
$_SESSION['IDSub'] = $_GET['idSub'];
?>
<div class="w-100 d-flex align-items-middle">

    <?php echo $Data[$_SESSION['ID']]['name']; ?> > <?php echo $Data1[$_SESSION['IDSub']]['name'];?>
</div>
<hr>
<form id='etape1'>
    <div class="form-row">
        <div class="form-group col-md-6">
        <label for="nb">Nombre de Ticket</label>
        <select id="nb" name="nb" onchange='send();' class="form-control">
            <?php
            for($i=1;$i<=20;$i++){
                echo "<option value='".$i."'>".$i."</option>";
            }
            ?>
      </select>
        </div>
        <div class="form-group col-md-6">
        <label for="type_ticket">Type de Ticket</label>
        <select id="type_ticket" name="type_ticket" class="form-control">
            <option value="0">Fausse</option>
            <option value="1">Assis</option>
            <option value="2">VIP</option>
      </select>
        </div>
    <div class="form-group col-md-12">
        <label for="myself">Moi même</label>
        <input type="checkbox" class="form-control" id="myself" name="self">
    </div> 
    <div class="form-group col-md-6">
        <label for="nom">Date</label>
        <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom">
    </div>
    <div class="form-group col-md-6">
        <label for="prenm">Date</label>
        <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom">
    </div>
    </div>
    <div class="btn btn-primary" onclick="send1();">Valider</div>
</form>

<script>

var form = jQuery('#etape1');
    
    function send(){
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