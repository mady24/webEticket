<?php

if(!empty($_GET['etape'])){
    switch($_GET['etape']){
        case 'etape1': $page = 'event/reservation/etape1.php';break;
        case 'etape2': $page =  'event/reservation/etape2.php';break;
        case 'etape3': $page =  'event/reservation/etape3.php';break;
        case 'etape4': $page =  'event/reservation/etape4.php';break;
        case 'etape5': $page =  'event/reservation/etape5.php';break;
    }
}else $page = 'event/reservation/etape1.php';

require_once $page;
?>