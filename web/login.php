<?php

$_SESSION['login-failed'] = false;

if(isset($_POST['button-login-act'])){

    if( $_POST['username_input'] != '' && $_POST['password_input'] != ''){

        $username_input = $_POST['username_input'];
        $password_input = $_POST['password_input'];

        $sql_code = "SELECT * FROM table_akun_pengguna WHERE username = '{$username_input}' AND password = '{$password_input}'";
        $result = mysqli_query($_SESSION['connection'], $sql_code);
        
        if(mysqli_num_rows($result) > 0 ){
            $target = mysqli_fetch_assoc($result);
            if( $username_input == $target['username'] && $password_input == $target['password'] ){
                header('Location: ../web../index.php?page=cart');
                echo $_SESSION['account']['username'];
            }
        }
    } else{
        $_SESSION['login-failed'] = true;
    }
}
?>

<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="FrameWork/Wingspart25-FrameWork.css">
    <link rel="stylesheet" href="style/create.css">
</head>
<body>
    
    <div class="create-account-container">
        <div class="sambutan" style="grid-area: box-1">
            <h1>Selamat Datang di Wingspart25</h1>
            <p>Kami sangat senang menyambut Anda untuk bergabung dengan kami. Dengan begitu, Anda dapat:</p>
            <ul>
                <li>Mencari Sparepart motor lebih mudah</li>
                <li>Berbelanja Sparepart motor</li>
            </ul>
            <img src="icon/WingPart25 logo replica.svg" alt="harusnya sih ini logo Wingspart25, cuman nggak tahu kenapa nggak ke load">
        </div>
        <div class="create" style="grid-area: box-2">
            <h1>Log your account</h1>
            <?php if( $_SESSION['login-failed']){ ?>
            <p>Maaf, username dan password tidak ditemukan</p>
            <?php }?>
            <form method="POST">
                <label for="">Username :</label><br>
                <input type="text" name="username_input"><br>
                <label for="">Password :</label><br>
                <input type="password" name="password_input"><br>
                <button type="submit" name="button-login-act" value="button-login">Login</button>
            </form>
            <p><a href="index.php?page=create_account">Belum punya akun</a></p>
        </div>
    </div>

</body>
</html>