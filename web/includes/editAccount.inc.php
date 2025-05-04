<?php

include "databaseServer.inc.php";
include "function.inc.php";

if (isset($_POST['confirm-edit'])){

    $username_input = $_POST['username'];
    $email_input = $_POST['email'];
    $phone_number_input = $_POST['phone-number'];
    $address_input = $_POST['address'];

    update_table($database_connection, 'table_akun_pengguna', 'username', $username_input, 'id');


} 
if(isset($_POST['delete-account'])){
    delete_table_row($database_connection, 'table_akun_pengguna', 'id', $_COOKIE['id']);
    logout_account($database_connection);
}

header("Location; ../profile.php?profile_navigation=biodata");

?>