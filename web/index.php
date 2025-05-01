<?php
    $database_server = 'localhost';
    $database_user = 'root';
    $database_password = '';
    $database_name = 'Wingspart25';
    $conection = '';
    $logined = false;

    try{
        $conection = mysqli_connect($database_server, $database_user, $database_password, $database_name);

        $page = isset($_GET['page']) ? $_GET['page'] : 'home';
        $category = 'all';

        switch($page){
            case 'login':
                include "web-element/login.php";
                break;
            case 'create_account':
                include "web-element/create_account.php";
                break;
            case 'cart':
                include "web-element/navigation.php";
                include "web-element/footer.php";
                echo 'cart page';
                break;
            case 'confirmation':
                include "web-element/navigation.php";
                include "web-element/footer.php";
                echo 'purchase confirmation page';
                break;
            default:
                include "web-element/navigation.php";
                include "web-element/category.php";
                include "web-element/footer.php";
                break;
            }
        }
        
    catch(mysqli_sql_exception){
        echo"404 was Not found";
    }


?>