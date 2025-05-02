<?php

include "databaseServer.inc.php";
include "function.inc.php";

if(isset($_POST['button-login-act'])){
    $username = trim($_POST['username_input']);
    $password = trim($_POST['password_input']);

    //jika username atau password kosong
    if( is_login_form_empty($username, $password) ){
        header("Location: ../login.php?error=form login empty");
        exit();
    }

    //jika username tidak ditemukan
    else if( userExist($database_connection, $username) ){
        header("Location: ../login.php?error=username and password was not found");
        exit();
    }
    
    //jika password salah
    else if( !password_check($database_connection, $username, $password) ){
        header("Location: ../login.php?error=username and password was not found");
        exit();
    }

    $_SESSION['login'] = true;

    header("Location: ../index.php");

}

?>