<?php

if(!empty($_GET['etape'])){
    switch($_GET['etape']){
        case 'region': $page = 'administration/banque/region.php';break;
        case 'bank': $page =  'administration/banque/bank.php';break;
        case 'agence': $page =  'administration/banque/agence.php';break;
        case 'file': $page =  'administration/banque/file.php';break;
    }
}else $page = 'administration/banque/region.php';

require_once $page;
?>