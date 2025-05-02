<?php
    $id_pelanggan = 0;
    $success = false;
    $username_input = isset($_POST['username_input']) ? $_POST['username_input'] : '';
    $password_input = isset($_POST['password_input']) ? $_POST['password_input'] : '';
    $database_server = 'localhost';
    $database_user = 'root';
    $database_password = '';
    $database_name = 'Wingspart25';
    $conection = '';

    try{
        $conection = mysqli_connect($database_server, $database_user, $database_password, $database_name);
        if($conection->connect_error){
            echo "Maaf, Koneksi terhadap server gagal";
        }else{
            $sql = "SELECT * FROM table_akun_pengguna WHERE username = '{$username_input}';";
            $index_ID = mysqli_query($conection, $sql);     
            if(mysqli_num_rows($index_ID) > 0){
                $row = mysqli_fetch_assoc($index_ID);
                if( $row['password'] == $password_input){
                    $id_pelanggan = $row['id'];
                    echo $id_pelanggan;
                    $success = true;
                }
            }
        }
        mysqli_close($conection);
    }catch(mysqli_sql_exception){
        echo "hehe";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../FrameWork/Wingspart25-FrameWork.css">
    <link rel="stylesheet" href="../style/create.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>
<body>
    <?php if($success){?>
        <div class="create succsessful">
            <h1><i class="bi bi-check-circle"></i></h1>
            <h1>Anda berhasil Log in :D</h1>
            <a href='../index.php?page=home&logined=true&id_user=<?=$id_pelanggan?>'><button class="back-button">Kembali ke beranda</button></a>
        </div>
    <?php } ?>
</body>
</html>
