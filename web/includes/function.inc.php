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
    $sql_code = "SELECT * FROM table_akun_pengguna WHERE user_email = '{$email}' ";

    try{
        $target = mysqli_query($connection, $sql_code);
        if(mysqli_num_rows($target) > 0){
            $row = mysqli_fetch_assoc($target);
            if($email == $row['user_email']){
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
    $sql_code = "SELECT * FROM table_akun_pengguna WHERE user_phone_number = '{$number}' ";

    try{
        $target = mysqli_query($connection, $sql_code);
        if(mysqli_num_rows($target) > 0){
            $row = mysqli_fetch_assoc($target);
            if( $number == $row['user_phone_number'] ){
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

        if( password_verify($password, $row['user_password']) ){
            return true;
        }else{
            return false;
        }
    }
}

function create_account($connection, $username, $password, $email, $number, $address){
    $sql_code = "INSERT INTO table_akun_pengguna(username, user_password, user_address, user_phone_number, user_email, user_date, user_notification, user_role) value (?, ?, ?, ?, ?, ?, ?, ?);";

    $notification_default = 1;
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
        setcookie('id', (string)$row['user_id'], time() + (86400*2), '/');
        setcookie('username', $row['username'], time() + (86400*2), '/');
        setcookie('email', $row['user_email'], time() + (86400*2), '/');
        setcookie('address', $row['user_address'], time() + (86400*2), '/');
        setcookie('phone-number', $row['user_phone_number'], time() + (86400*2), '/');
        setcookie('notification-wait', (string)$row['user_notification'], time() + (86400*2), '/');
        setcookie('role', $row['user_role'], time() + (86400*2), '/');

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
            setcookie('role', $row['user_role'], time() + (86400*2), '/');
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

function update_table($connection, $table, $row, $new_value, $row_target, $row_target_value){
    $sql_code = "UPDATE {$table} SET {$row} = '{$new_value}' WHERE $row_target = {$_COOKIE[$row_target_value]}";
    mysqli_query($connection, $sql_code);
}

function delete_table_row($connection, $table, $target, $target_value){
    $sql_code = "DELETE FROM {$table} WHERE {$target} = {$target_value}";
    mysqli_query($connection, $sql_code);
}

function count_notification($connection){
    $sql_code = "SELECT * FROM notification_table WHERE user_id = {$_COOKIE['id']};";
    $sql_query_execute = mysqli_query($connection, $sql_code);

    $count_notification = (int)mysqli_num_rows($sql_query_execute);

    return $count_notification;

}

function update_notification_row($connection){
    $sql_code = "SELECT * FROM notification_table WHERE id = {$_COOKIE['id']};";
    $sql_query_execute = mysqli_query($connection, $sql_code);

    update_table($connection, 'table_akun_pengguna', 'user_notification', mysqli_num_rows($sql_query_execute), 'user_id', 'id');
    setcookie('notification-wait', (string)count_notification($connection), time() + (86400*2), '/');
}

function get_max_id($connection, $table_target, $column_target){
    $sql_code = "SELECT * FROM {$table_target} WHERE {$column_target} = (SELECT MAX($column_target) FROM $table_target)";
    $target = mysqli_query($connection, $sql_code);

    if(mysqli_num_rows($target) > 0){
        $row = mysqli_fetch_assoc($target);
        return $row[$column_target];
    }
}

function value_math_add($connection, $table_target, $target_id, $target_id_value, $column_target, $value_to_add){
    $sql_code = "SELECT * FROM {$table_target} WHERE {$target_id} = $target_id_value";
    $sql_query_execute = mysqli_query($connection, $sql_code);
    if(mysqli_num_rows($sql_query_execute) > 0){
        $row = mysqli_fetch_assoc($sql_query_execute);
        return (int)$row[$column_target] + $value_to_add;
    }
}

function push_notification($connection, $user_id_target, $header, $massage){
    $sql_code = "INSERT INTO notification_table(user_id, header, massage, date) VALUE (?, ?, ?, ?)";

    $date = date('Y-d-m H:i:s');

    $statement = $connection->prepare($sql_code);
    $statement->bind_param("isss", $user_id_target, $header, $massage, $date);
    $statement->execute();

}

function notification_content($connection, $header, $massage){
    return "<div class='notification-list'>
                <a href='profile.php?profile_navigation=notifikasi' id='notification-link'>
                    <img src='image/Product 1.png' class='notification-image' style='grid-area: image;'>
                    <h1 class='notification-header' style='grid-area: header;'>{$header}</h1>
                    <p class='notification-text' style='grid-area: text;'>{$massage}</p>
                </a>
            </div>";
}

function render_notification($connection){
    $sql_code = "SELECT * FROM notification_table WHERE user_id = {$_COOKIE['id']} ORDER BY id DESC";
    $sql_query_execute = mysqli_query($connection, $sql_code);

    while ($row = mysqli_fetch_assoc($sql_query_execute)){
        echo notification_content($connection, $row['header'], $row['massage']);
    }

}

?>