<?php

$database_server = 'localhost';
$database_user = 'root';
$database_password = '';
$database_name = 'Wingspart25';
$database_connection = '';

date_default_timezone_set("Asia/Bangkok");

// $_SESSION['login-status'] = false;

try{
    $database_connection = mysqli_connect($database_server, $database_user, $database_password, $database_name);

}catch( mysqli_sql_exception ){
    echo "fail connecting to database server";
}

// $database_connection = new PDO ("mysql:host=$database_server;dbname=$database_name", $database_user, $database_password);

// $database_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>