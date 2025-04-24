<?php
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';
    include "web-element/navigation.php";

    switch($page){
        case 'login':
            echo 'login page';
            break;
        case 'create_account':
            echo 'create account page';
            break;
        case 'cart':
            echo 'cart page';
            break;
        case 'confirmation':
            echo 'purchase confirmation page';
            break;
        default:
            echo 'home page';
            break;
    }

    include "web-element/footer.php";
?>