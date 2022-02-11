<?php

if(empty($page)){
    if(!empty($_GET['rubrique'])){
        $_SESSION['rubrique'] = $_GET['rubrique'];
        $_SESSION['etape'] = @$_GET['etape'];
        switch($_GET['rubrique']){
            case 'tB':$page = 'banque/reservation/index.php';break;
            case 'tE':$page = 'event/reservation/index.php';break;
            case 'sB':$page = 'banque/suivi/index.php';break;
            case 'sE':$page = 'event/suivi/index.php';break;
            case 'admBank':$page = 'administration/banque/index.php';break;
            default : $page = 'default/index.php';break;
        }
    }else{
        $page = 'default/index.php';
    }
}

require_once $page;

?>