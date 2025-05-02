<?php


$database_server = 'localhost';
$database_user = 'root';
$database_password = '';
$database_name = 'Wingspart25';
$conection = '';

$conection = mysqli_connect($database_server, $database_user, $database_password, $database_name);
$id_target = $account['id-user'];
$sql_code = "ALTER TABLE table_akun_pengguna WHERE id = {$id_target}";
$sql_query = mysqli_query($conection, $sql_code);
echo "nih akun dah ke apus, wkwkwkw";
?>