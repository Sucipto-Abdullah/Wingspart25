<?php

function is_login_form_empty($username, $password){
    return empty($username) || empty($password) || $username == '' || $password == '';
}

function userExist($connection, $username){
    $sql_code = "SELECT * FROM table_akun_pengguna WHERE username = '{$username}' ";

    try{
        $target = mysqli_query($connection, $sql_code);
        if(mysqli_num_rows($target) > 0){
            $row = mysqli_fetch_assoc($target);
            if($username == $row['username']){
                return true;
            }else{
                return false;
            }
        }
    } catch(mysqli_sql_exception){
        return false;
    }

}

function email_used($connection, $email){
    $sql_code = "SELECT * FROM table_akun_pengguna WHERE email = '{$email}' ";

    try{
        $target = mysqli_query($connection, $sql_code);
        if(mysqli_num_rows($target) > 0){
            $row = mysqli_fetch_assoc($target);
            if($email == $row['email']){
                return true;
            }else{
                return false;
            }
        }
    } catch(mysqli_sql_exception){
        return false;
    }
}

function number_used($connection, $number){
    $sql_code = "SELECT * FROM table_akun_pengguna WHERE nomor_tellphone = '{$number}' ";

    try{
        $target = mysqli_query($connection, $sql_code);
        if(mysqli_num_rows($target) > 0){
            $row = mysqli_fetch_assoc($target);
            if( $number == $row['nomor_tellphone'] ){
                return true;
            } else {
                return false;
            }
        }
    } catch(mysqli_sql_exception){
        return false;
    }
}

function password_check($connection, $username, $password){
    $sql_code = "SELECT * FROM table_akun_pengguna WHERE username = '{$username}'";
    $target_query = mysqli_query($connection, $sql_code);

    if( mysqli_num_rows($target_query) > 0 ){
        $row = mysqli_fetch_assoc($target_query);

        if( password_verify($password, $row['password']) ){
            return true;
        }else{
            return false;
        }
    }
}

function create_account($connection, $username, $password, $email, $number, $address){
    $sql_code = "INSERT INTO table_akun_pengguna(username, password, alamat, nomor_tellphone, email, tanggal_daf, notification, role_pengguna) value (?, ?, ?, ?, ?, ?, ?, ?);";

    $notification_default = 0;
    $role_default = 'pembeli';
    $get_date = date('Y-d-m H:i:s');

    $statement = $connection->prepare($sql_code);
    $statement->bind_param('ssssssis', $username, $password, $address, $number, $email, $get_date, $notification_default, $role_default);
    $statement->execute();

}

function login_account($connection, $username){
    $sql_code = "SELECT * FROM table_akun_pengguna WHERE username = '{$username}'";
    $target_query = mysqli_query($connection, $sql_code);

    if( mysqli_num_rows($target_query) > 0 ){
        $row = mysqli_fetch_assoc($target_query);

        setcookie("login_status", '1', time() + (86400*2), '/');
        setcookie('id', (string)$row['id'], time() + (86400*2), '/');
        setcookie('username', $row['username'], time() + (86400*2), '/');
        setcookie('email', $row['email'], time() + (86400*2), '/');
        setcookie('address', $row['alamat'], time() + (86400*2), '/');
        setcookie('phone-number', $row['nomor_tellphone'], time() + (86400*2), '/');
        setcookie('notification-wait', (string)$row['notification'], time() + (86400*2), '/');
        setcookie('role', $row['role_pengguna'], time() + (86400*2), '/');

    }
}

function logout_account($connection){
    setcookie("login_status", '0', time() + (86400*2), '/');
    setcookie('id', '0', time() + (86400*2), '/');
    setcookie('username', 'guest', time() + (86400*2), '/');
    setcookie('email', '-', time() + (86400*2), '/');
    setcookie('address', '-', time() + (86400*2), '/');
    setcookie('phone-number', '-', time() + (86400*2), '/');
    setcookie('notification-wait', '0', time() + (86400*2), '/');
    setcookie('role', 'pembeli', time() + (86400*2), '/');
}

function role_check($connection){
    if ( $_COOKIE['role'] == 'admin' ){
        $username = $_COOKIE['username'];
        $sql_code = "SELECT * FROM table_akun_pengguna WHERE username = '{$username}';";
        $target_query = mysqli_query($connection, $sql_code);

        if( mysqli_num_rows($target_query) > 0 ){
            $row = mysqli_fetch_assoc($target_query);
            setcookie('role', $row['role_pengguna'], time() + (86400*2), '/');
            header("location: index.php");
        }

    }
}

function isLogin(){
    return $_COOKIE['login_status'] == '1' ? true : false;
}

function count_ongoing_transaction($connection){
    $user_id = (int)$_COOKIE['id'];
    $sql_code = "SELECT * FROM transaksi WHERE transaction_status != 'finish' AND id_pengguna = {$user_id}";
    $target_query = mysqli_query($connection, $sql_code);

    return (int)mysqli_num_rows($target_query);

}

function update_table($connection, $table, $row, $new_value, $row_target){
    $sql_code = "UPDATE {$table} SET {$row} = '{$new_value}' WHERE $row_target = {$_COOKIE[$row_target]}";

    mysqli_query($connection, $sql_code);
    setcookie("username", $new_value, time() + (86400*2), '/');
}

function delete_table_row($connection, $table, $target, $target_value){
    $sql_code = "DELETE FROM {$table} WHERE {$target} = {$target_value}";

    mysqli_query($connection, $sql_code);
}

?>