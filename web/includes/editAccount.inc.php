<?php

include "databaseServer.inc.php";
include "function.inc.php";

if (isset($_POST['confirm-edit'])){
    
    $username_input = trim($_POST['username']);
    $email_input = trim($_POST['email']);
    $phone_number_input = trim($_POST['phone-number']);
    $address_input = trim($_POST['address']);

    update_table($database_connection, 'table_akun_pengguna', 'username', $username_input, 'user_id', 'id');
    setcookie("username", $username_input, time() + (86400*2), '/');
    
    update_table($database_connection, 'table_akun_pengguna', 'user_email', $email_input, 'user_id', 'id');
    setcookie("email", $email_input, time() + (86400*2), '/');
    
    update_table($database_connection, 'table_akun_pengguna', 'user_phone_number', $phone_number_input, 'user_id', 'id');
    setcookie("phone-number", $phone_number_input, time() + (86400*2), '/');
    
    update_table($database_connection, 'table_akun_pengguna', 'user_address', $address_input, 'user_id', 'id');
    setcookie("address", $address_input, time() + (86400*2), '/');
    
} 
if(isset($_POST['delete-account'])){
    delete_table_row($database_connection, 'notification_table', 'user_id', $_SESSION['user-id']);
    delete_table_row($database_connection, 'table_akun_pengguna', 'user_id', $_SESSION['user-id']);
    logout_account($database_connection);
}

push_notification($database_connection, $_COOKIE['id'], "Perubahan Profil", "profil akunmu telah berhasil diubah :D");

header("Location: ../profile.php?profile_navigation=biodata");

?>