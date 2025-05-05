<?php

include "databaseServer.inc.php";
include "function.inc.php";

if( isset($_POST['sign-up']) ){

    $username_input = $_POST['username'];
    $password_input = $_POST['password'];
    $password_confirm_input = $_POST['confirm-password'];
    $email_input = $_POST['email'];
    $number_input = $_POST['number'];
    $address_input = $_POST['address'];

    //jika username sudah ada yang memeakainya duluan
    if ( userExist($database_connection, $username_input )){
        header("Location: ../signUp.php?error=username sudah ada yang memakainya sebelumnya");
        exit();
    }

    //jika password dengan confirm-password beda
    if ( $password_confirm_input != $password_input ){
        header("Location: ../signUp.php?error=password konfirmasi beda dengan sebelumnya");
        exit();
    }

    //jika email telah dipakai sebelumnya
    if ( email_used($database_connection, $email_input) ){
        header("Location: ../signUp.php?error=Email ini telah digunakan sebelumnya");
        exit();
    }
    
    //jika nomor telephone telah dipakai sebelumnya
    if ( number_used($database_connection, $number_input) ){
        header("Location: ../signUp.php?error=Email ini telah digunakan sebelumnya");
        exit();
    }

    create_account($database_connection, $username_input, password_hash($password_input, PASSWORD_DEFAULT), $email_input, $number_input, $address_input);
    login_account($database_connection, $username_input);
    push_notification($database_connection, (int)get_max_id($database_connection, 'table_akun_pengguna', 'user_id'), "Selamat Datang", "Selamat datang di Wingspart25 {$_SESSION['username']}, selamat berbelanja {$_COOKIE[get_max_id($database_connection, 'table_akun_pengguna', 'user_id')]} :D");
    header("Location: ../index.php");
}

?>