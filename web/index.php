<?php
    session_start();

    include "includes/databaseServer.inc.php";

    include "web-element/navigation.php";

    include "web-element/category.php";

    $page = isset($_GET['page']) ? $_GET['page'] : 'home';

?>