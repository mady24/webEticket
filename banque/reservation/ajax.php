<?php

if(!empty($_GET['etape'])){
    switch($_GET['etape']){
        case 'etape1': $page = 'banque/reservation/etape1.php';break;
        case 'etape2': $page =  'banque/reservation/etape2.php';break;
        case 'etape3': $page =  'banque/reservation/etape3.php';break;
        case 'etape4': $page =  'banque/reservation/etape4.php';break;
        case 'etape5': $page =  'banque/reservation/etape5.php';break;
    }
}else $page = 'banque/reservation/etape1.php';
require_once $page;
?>