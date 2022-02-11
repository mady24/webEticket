<?php
$Data = array(0=>array('img'=>'','name'=>'CBAO','color'=>'orange'),1=>array('img'=>'','name'=>'CORIS BANK','color'=>'blue'),2=>array('img'=>'','name'=>'BHS','color'=>'green'));
$_SESSION['ID'] = $_GET['id'];

?>
<div class="w-100 d-flex align-items-middle">
    <img src="<?php echo $Data[$_SESSION['ID']]['img']; ?>" alt="<?php echo $Data[$_SESSION['ID']]['name']; ?>">
    <?php echo $Data[$_SESSION['ID']]['name']; ?>
</div>
<hr>
<div class="row p-0 m-0 y-auto">
    <div class="col-lg-4 col-md-6 col-sm-12" style="height: 200px !important;">
        <div class="bg-white border border-warning rounded h-100 row m-2">
            <div class="col-6 m-auto">
                <img src="" alt="ORANGE MONEY">
            </div>
            <div class="col-6 m-auto">
                Orange Money
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12" style="height: 200px !important;">
        <div class="bg-white border border-primary rounded h-100 row m-2">
            <div class="col-6 m-auto">
                <img src="" alt="WAVE">
            </div>
            <div class="col-6 m-auto">
                Wave
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12" style="height: 200px !important;">
        <div class="bg-white border border-danger rounded h-100 row m-2">
            <div class="col-6 m-auto">
                <img src="" alt="FREE MONEY">
            </div>
            <div class="col-6 m-auto">
                Free Money
            </div>
        </div>
    </div>
</div>