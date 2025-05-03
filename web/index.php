<?php
    session_start();

    include "includes/databaseServer.inc.php";
    include "includes/function.inc.php";

    role_check($database_connection);

    include "web-element/navigation.php";

    include "web-element/category.php";

    include "web-element/footer.php";

    $page = isset($_GET['page']) ? $_GET['page'] : 'home';

    //hallo


?>