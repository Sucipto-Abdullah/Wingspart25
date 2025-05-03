<?php

include "databaseServer.inc.php";
include "function.inc.php";

if(isset($_POST['button-login-act'])){
    $username = trim($_POST['username_input']);
    $password = trim($_POST['password_input']);

    //jika username atau password kosong
    if( is_login_form_empty($username, $password) ){
        header("Location: ../signIn.php?error=form login empty");
        exit();
    }

    //jika username tidak ditemukan
    else if( !userExist($database_connection, $username) ){
        header("Location: ../signIn.php?error=username tidak ditemukan");
        exit();
    }
    
    //jika password salah
    else if( !password_check($database_connection, $username, $password) ){
        header("Location: ../signIn.php?error=password salah");
        exit();
    }

    login_account($database_connection, $username);

    header("Location: ../index.php?logined=true");

}

?>