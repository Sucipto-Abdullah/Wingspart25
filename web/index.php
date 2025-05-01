<?php
    $database_server = 'localhost';
    $database_user = 'root';
    $database_password = '';
    $database_name = 'Wingspart25';
    $conection = '';

    
    try{    
        $conection = mysqli_connect($database_server, $database_user, $database_password, $database_name);
        $account = array(
            'id-user' => 0,
            "username" => 'guest',
            'address' => 'earth',
            'phone-number' => '-',
            'email' => '-',
            'notification-wait' => 0,
            'date-sign-in' => '-'
        );

        $logined = isset($_GET['logined']) ? $_GET['logined'] === 'true' : false;
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';
        $category = 'all';
        $id_user = isset($_GET['id_user']) ? $_GET['id_user'] : 0;

        if($logined && $id_user != 0){
            $sql_code = "SELECT * FROM table_akun_pengguna WHERE id = {$id_user};";
            $sql_query = mysqli_query($conection, $sql_code);
            if(mysqli_num_rows($sql_query) > 0){
                $kolom = mysqli_fetch_assoc($sql_query);
                $account['id-user'] = $kolom['id'];
                $account['username'] = $kolom['username'];
                $account['address'] = $kolom['alamat'];
                $account['phone-number'] = $kolom['nomor_tellphone'];
                $account['email'] = $kolom['email'];
                $account['notification-wait'] = $kolom['notification'];
                $account['date-sign-in'] = $kolom['tanggal_daf'];
            }
        }
        echo $logined. "<br>";
        echo $id_user. "<br>";
        echo $account['username']. "<br>";
        echo $account['email']. "<br>";
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
        mysqli_close($conection);
    }
        
    catch(mysqli_sql_exception){
        echo"404 was Not found";
    }


?>