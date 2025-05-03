<?php
    session_start();

    include "includes/databaseServer.inc.php";

    include "web-element/navigation.php";

    include "web-element/category.php";

    include "web-element/footer.php";

    $page = isset($_GET['page']) ? $_GET['page'] : 'home';

?>