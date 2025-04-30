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
                include "web-element/catogory.php";
                echo 'KALO PENGEN NGELANJUTIN NIH KODINGAN JANGAN PAKEK A.I !!!!<br>btw ini halaman home';
                break;
        }

        include "web-element/footer.php";
    }
    catch(mysqli_sql_exception){
        echo"404 was Not found";
    }


?>