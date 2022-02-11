<?php
    $result = file_get_contents("http://localhost/eticket/public/index.php/showBankByID/".$_GET['id']);
    $Data = json_decode($result, true); 
    $result = file_get_contents("http://localhost/eticket/public/index.php/showRegion/");
    $tbRegion = json_decode($result,true);
    if(!empty($_POST['region'])){
    $result = file_get_contents("http://localhost/eticket/public/index.php/showAgenceByBankRegion/".$_GET['id']."/".$_POST['region']);
    $tbAgence = json_decode($result, true);
    }
    else $tbAgence = array();
    $_SESSION['ID'] = $_GET['id'];
?>
<div class="w-100 d-flex align-items-middle">
    <img src="img/<?php echo $Data[$_SESSION['ID']]['image'];?>" alt="<?php echo $Data[$_SESSION['ID']]['nomBanque']; ?>" style="height:30px;">
    <?php echo $Data[$_SESSION['ID']]['nomBanque']; ?>
</div>
<hr>
<form id='etape1'>
    <div class="form-row">
        <div class="form-group col-md-6">
        <label for="region">Région</label>
        <select id="refion" name="region" value='<?php echo $_POST['region'];?>' onchange='send();' class="form-control">
            <option value="0">...</option>
            <?php
            foreach($tbRegion as $ID => $tb){
                if($ID == $_POST['region'])echo "<option selected value='".$ID."'>".$tb['nomRegion']."</option>";
                else echo "<option value='".$ID."'>".$tb['nomRegion']."</option>";
            }
            ?>
      </select>
        </div>
        <div class="form-group col-md-6">
        <label for="agence">Agence</label>
        <select id="agence" name="agence" class="form-control">
            <?php
            foreach($tbAgence as $ID => $tb)echo "<option value='".$ID."'>".$tb['nomAgence']."</option>";
            ?>
      </select>
        </div>
        <div class="form-group col-md-6">
      <label for="service">Service</label>
      <select id="service" name='service' class="form-control">
        <option selected>Caisse</option>
        <option>...</option>
      </select>
    </div>
    <div class="form-group col-md-6">
    <label for="date">Date</label>
    <input type="date" class="form-control" id="date" name="date" placeholder="1234 Main St">
  </div>
    </div>
    <div class="btn btn-primary" onclick="send1();">Valider</div>
</form>

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