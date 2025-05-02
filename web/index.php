<?php
    session_start();

    include "includes/databaseServer.inc.php";

    $_SESSION['logined'] = false;

    include "web-element/navigation.php";

    include "web-element/category.php";

    if($_SESSION['login']){
        echo $_SESSION['login'];
    }

    $page = isset($_GET['page']) ? $_GET['page'] : 'home';

?>