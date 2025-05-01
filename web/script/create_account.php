<?php
$step = 0;
$username = $_POST['username'];
$password;
if($_POST['password'] == $_POST['confirm-password']){
    $password = $_POST['password'];
}else{
    header('Location : create_account.php');
}
$email = $_POST['email'];
$address = $_POST['address'];
$phone_number = $_POST['number'];
$date = date('Y-d-m H:i:s');
$notification = 0;


$database_server = 'localhost';
$database_user = 'root';
$database_password = '';
$database_name = 'Wingspart25';
$conection = '';

// try{
    $conection = mysqli_connect($database_server, $database_user, $database_password, $database_name);
    if($conection->connect_error){
        echo "koneksimu napa dah ??";
    }else{
        $stmt = $conection->prepare("insert into table_akun_pengguna(username, password, alamat, nomor_tellphone, email, tanggal_daf, notification) value(?,?,?,?,?,?, ?);");
        $stmt->bind_param("ssssssi", $username, $password, $address, $phone_number, $email, $date, $notification);
        $stmt->execute();
        echo"Akun telah berhasil dibuat";
        mysqli_close($conection);
    }
// }


// header("Location: ../index.php");
?>