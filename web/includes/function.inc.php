<?php

session_start();

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

        $_SESSION['login-status'] = true;
        $_SESSION['user-id'] = $row['user_id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['email'] = $row['user_email'];
        $_SESSION['address'] = $row['user_address'];
        $_SESSION['phone-number'] = $row['user_phone_number'];
        $_SESSION['notification-wait'] = $row['user_notification'];
        $_SESSION['role'] = $row['user_role'];
        $_SESSION['profile'] = $row['user_profile'];

    }
}

function logout_account($connection){

    $_SESSION['login-status'] = false;

    session_unset();
    session_destroy();
}

function role_check($connection){
    if ( getRowColumn($connection, 'table_akun_pengguna', 'user_id', $_SESSION['user_id'], 'user_role') == 'admin' ){
        $username = getRowColumn($connection, 'table_akun_pengguna', 'user_id', $_SESSION['user_id'], 'username');
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
    $user_id = isset($_SESSION['user-id']) ? (int)$_SESSION['user-id'] : 0;
    $sql_code = "SELECT * FROM transaksi WHERE transaction_status != 'finish' AND id_pengguna = {$user_id}";
    $target_query = mysqli_query($connection, $sql_code);

    return (int)mysqli_num_rows($target_query);

}

function update_table($connection, $table, $row, $new_value, $row_target, $row_target_value){
    $sql_code = "UPDATE {$table} SET {$row} = '{$new_value}' WHERE $row_target = {$_SESSION[$row_target_value]}";
    mysqli_query($connection, $sql_code);
}

function delete_table_row($connection, $table, $target, $target_value){
    $sql_code = "DELETE FROM {$table} WHERE {$target} = {$target_value}";
    mysqli_query($connection, $sql_code);
}

function count_notification($connection, $status){
        $user_id = isset($_SESSION['user-id']) ? (int)$_SESSION['user-id'] : 0;
        $sql_code = "SELECT * FROM notification_table WHERE user_id = {$user_id} AND status = '{$status}';";
        $sql_query_execute = mysqli_query($connection, $sql_code);
    
        $count_notification = mysqli_num_rows($sql_query_execute);
        
        return $count_notification;
}

function update_notification_row($connection){
    if( isset($_SESSION['user-id']) ){
        $user_id = $_SESSION['user-id'];
        $sql_code = "SELECT * FROM notification_table WHERE id = {$user_id};";
        $sql_query_execute = mysqli_query($connection, $sql_code);
    
        update_table($connection, 'table_akun_pengguna', 'user_notification', mysqli_num_rows($sql_query_execute), 'user_id', 'id');
        // setcookie('notification-wait', (string)count_notification($connection), time() + (86400*2), '/');
    }
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

function push_notification($connection, $user_id_target, $header, $massage, $image){
    $sql_code = "INSERT INTO notification_table(user_id, header, massage, date, image) VALUE (?, ?, ?, ?, ?)";

    $date = date('Y-d-m H:i:s');

    $statement = $connection->prepare($sql_code);
    $statement->bind_param("issss", $user_id_target, $header, $massage, $date, $image);
    $statement->execute();

}

function notification_content($connection, $header, $massage, $time, $image){
    $image_notification = $image != '' ? $image : "notification-image-default.jpg";
    return "<div class='notification-list'>
                <a href='profile.php?profile_navigation=notifikasi' id='notification-link'>
                    <img src='image/notification-image/{$image_notification}' class='notification-image' style='grid-area: image;'>
                    <h1 class='notification-header' style='grid-area: header;'>{$header}</h1>
                    <p class='notification-date' style='grid-area: date;'>{$time}</p><br>
                    <p class='notification-text' style='grid-area: text;'>{$massage}</p>
                </a>
            </div>";
}

function get_time_pass($date_target){
    $time_now = array(date("Y"), date("d"), date("m"), date("H"), date("i"), date('s'));

    $date_slice = explode(' ', $date_target);
    $date_pass = explode('-', $date_slice[0]);
    $time_pass = explode(':', $date_slice[1]);

    $result = array("", "", "", "", "", "");

    if( $time_now[0] - $date_pass[0] > 0){
        $time_date_pass = abs((int)$time_now[0] - (int)$date_pass[0]);
        $result[0] = "{$time_date_pass} tahun ";
    }
    if( $time_now[1] - $date_pass[1] != 0){
        $time_date_pass = abs((int)$time_now[1] - (int)$date_pass[1]);
        $result[2] = "{$time_date_pass} hari ";
    }
    if( $time_now[2] - $date_pass[2] != 0){
        $time_date_pass = abs($time_now[2] - $date_pass[2]);
        $result[1] = "{$time_date_pass} bulan ";
    }
    if( $time_now[3] - $time_pass[0] != 0){
        $time_date_pass = abs((int)$time_now[3] - (int)$time_pass[0]);
        $result[3] = "{$time_date_pass} jam ";
    }
    if( $time_now[4] - $time_pass[1] > 0){
        $time_date_pass = abs((int)$time_now[4] - (int)$time_pass[1]);
        $result[4] = "{$time_date_pass} menit ";
    }
    if( $time_now[5] - $time_pass[2] != 0){
        $time_date_pass = abs((int)$time_now[5] - (int)$time_pass[2]);
        $result[5] = "{$time_date_pass} Detik";
    }

    if( end($result) == '' ){
        return 'baru saja';
    }else{
        return $result[0].$result[1].$result[2].$result[3].$result[4].$result[5]. " yang lalu.";
    }
    
}

function render_notification($connection){
    $sql_code = "SELECT * FROM notification_table WHERE user_id = {$_SESSION['user-id']} ORDER BY id DESC";
    $sql_query_execute = mysqli_query($connection, $sql_code);



    while ($row = mysqli_fetch_assoc($sql_query_execute)){
        echo notification_content($connection, $row['header'], $row['massage'], get_time_pass($row['date']), $row['image']);
    }
}

function getRowColumn($connection, $table_target, $column_target, $value_condition, $target_value){
    $sql_code = "SELECT * FROM {$table_target} WHERE $column_target = {$value_condition};";
    $sql_query_execute = mysqli_query($connection, $sql_code);

    if( mysqli_num_rows($sql_query_execute) > 0 ){
        $row = mysqli_fetch_assoc($sql_query_execute);
        return $row[$target_value];
    }
}

function upload_image($image, $purpose){
    if( $purpose == 'notification' || $purpose == 'profile' || $purpose == 'prodct'){

    }
}

function print_product_table($index, $id, $name, $brand, $cost, $condition, $image, $status, $category, $number_type){
    return "<tr class='$number_type'>
                <td class='option-column'>
                    <form method='POST'>
                        <button type='submit' name='info' value='$id' class='btn bg-yellow'><i class='bi bi-info-circle'></i></button>
                        <button type='submit' name='edit' value='$id' class='btn bg-blue'><i class='bi bi-pencil'></i></button>
                        <button type='submit' name='delete' value='$id' class='btn bg-red'><i class='bi bi-trash3'></i></button>
                    </form>
                </td>
                <td class='number-column'>$index</td>
                <td class='image-column'>
                    <img src='image/product-image/$image'>
                </td>
                <td class='name-column'>$name</td>
                <td class='cost-column'>Rp$cost</td>
                <td class='brand-column'>$brand</td>
                <td class='category-column'>$category</td>
                <td class='condition-column'>$condition</td>
                <td class='status-column'>$status</td>
            </tr>";
}

function print_all_product($connection){
    $sql_code = "SELECT * FROM table_barang";
    $sql_query = mysqli_query($connection, $sql_code);

    $index = 1;

    if(mysqli_num_rows($sql_query) > 0){
        while($row = mysqli_fetch_assoc($sql_query)){
            if( $index % 2 == 0 ){
                echo print_product_table($index, $row['id_barang'], $row['nama_barang'], $row['merek_barang'], $row['harga_barang'], $row['kondisi_barang'], $row['gambar_barang'], $row['status_barang'], $row['category'], 'even');
            }else{
                echo print_product_table($index, $row['id_barang'], $row['nama_barang'], $row['merek_barang'], $row['harga_barang'], $row['kondisi_barang'], $row['gambar_barang'], $row['status_barang'], $row['category'], 'odd');
            }
            $index += 1;
        }
    }

}

?>