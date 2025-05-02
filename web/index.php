<?php
    $database_server = 'localhost';
    $database_user = 'root';
    $database_password = '';
    $database_name = 'Wingspart25';
    $conection = '';
    
    $account = array(
        'id-user' => 0,
        "username" => 'guest',
        'address' => '-',
        'phone-number' => '-',
        'email' => '-',
        'notification-wait' => 0,
        'date-sign-in' => '-'
    );
    $id_user = isset($_GET['id_user']) ? $_GET['id_user'] : 0;
    $logined = isset($_GET['logined']) ? $_GET['logined'] === 'true' : false;
    
    try{    
        $conection = mysqli_connect($database_server, $database_user, $database_password, $database_name);

        $page = isset($_GET['page']) ? $_GET['page'] : 'home';
        $category = 'all';

        $username_login_input = isset($_POST['username_input']) ? $_POST['username_input'] : '';
        $password_login_input = isset($_POST['password_input']) ? $_POST['password_input'] : '';
        if($username_login_input && $password_login_input){
            $login_code = "SELECT * FROM table_akun_pengguna WHERE username = '{$username_login_input}';";
            $login_query = mysqli_query($conection, $login_code);
            if(mysqli_num_rows($login_query) > 0){
                $sql_row = mysqli_fetch_assoc($login_query);
                $logined = true;
                $account['id-user'] = $sql_row['id'];
                $account['username'] = $sql_row['username'];
                $account['address'] = $sql_row['alamat'];
                $account['phone-number'] = $sql_row['nomor_tellphone'];
                $account['email'] = $sql_row['email'];
                $account['notification-wait'] = $sql_row['notification'];
                $account['date-sign-in'] = $sql_row['tanggal_daf'];
                $id_user = $account['id-user'];
            }
        }

        if($logined && $id_user != 0){
            $login_code = "SELECT * FROM table_akun_pengguna WHERE id = {$id_user};";
            $login_query = mysqli_query($conection, $login_code);
            if(mysqli_num_rows($login_query) > 0){
                $sql_row = mysqli_fetch_assoc($login_query);
                $id_user = $sql_row['id'];
                $account['id-user'] = $sql_row['id'];
                $account['username'] = $sql_row['username'];
                $account['address'] = $sql_row['alamat'];
                $account['phone-number'] = $sql_row['nomor_tellphone'];
                $account['email'] = $sql_row['email'];
                $account['notification-wait'] = $sql_row['notification'];
                $account['date-sign-in'] = $sql_row['tanggal_daf'];
            }
        }

        // echo $logined. "<br>";
        // echo $id_user. "<br>";
        // echo $account['username']. "<br>";
        // echo $account['email']. "<br>";

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
            case 'profile':
                include "web-element/navigation.php";
                include "web-element/profile.php";
                include "web-element/footer.php";
                // echo 'cart page';
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