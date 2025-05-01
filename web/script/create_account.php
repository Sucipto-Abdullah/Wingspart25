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

try{
    $conection = mysqli_connect($database_server, $database_user, $database_password, $database_name);
    if($conection->connect_error){
        echo "koneksimu napa dah ??";
    }else{
        $stmt = $conection->prepare("insert into table_akun_pengguna(username, password, alamat, nomor_tellphone, email, tanggal_daf, notification) value(?,?,?,?,?,?, ?);");
        $stmt->bind_param("ssssssi", $username, $password, $address, $phone_number, $email, $date, $notification);
        $stmt->execute();
        mysqli_close($conection);
    }
}catch(mysqli_sql_exception){
    header("Location: ../index.php?page=create_account");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="FrameWork/Wingspart25-FrameWork.css">
    <link rel="stylesheet" href="style/create.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>
<body>
    <div class="create succsessful">
        <h1><i class="bi bi-check-circle"></i></h1>
        <h1>Akunmu telah berhasil dibuat :D</h1>
        <a href="../index.php?page=home"><button class="back-button">Kembali ke beranda</button></a>
    </div>
</body>
</html>