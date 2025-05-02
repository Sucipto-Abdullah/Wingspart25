<?php

$database_server = 'localhost';
$database_user = 'root';
$database_password = '';
$database_name = 'Wingspart25';
$database_connection = '';

try{
    $database_connection = mysqli_connect($database_server, $database_user, $database_password, $database_name);

}catch( mysqli_sql_exception ){
    echo "fail connecting to database server";
}
?>