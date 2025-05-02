<?php

function is_login_form_empty($username, $password){
    return empty($username) || empty($password) || $username == '' || $password == '';
}

function userExist($connection, $username){
    $sql_code = "SELECT * FROM table_akun_pengguna WHERE username = ? ";

    try{
        $target = mysqli_query($connection, $sql_code);
        if(mysqli_num_rows($target) > 0){
            $row = mysqli_fetch_assoc($target);
        }
        return true;
    } catch(mysqli_sql_exception){
        return false;
    }

}

function password_check($connection, $username, $password){
    $sql_code = "SELECT * FROM table_akun_pengguna WHERE username = '{$username}'";
    $target_query = mysqli_query($connection, $sql_code);

    if( mysqli_num_rows($target_query) > 0 ){
        $row = mysqli_fetch_assoc($target_query);

        if($row['password'] == $password){
            return true;
        }else{
            return false;
        }

    }
}


?>