<?php

include "includes/signIn.inc.php";

$error = isset($_GET['error']) ? $_GET['error'] : 'none';

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
            <?php if( $error != 'none'){ ?>
            <p><?= $error ?></p>
            <?php }?>
            <form action="includes/signIn.inc.php" method="POST">
                <label for="">Username :</label><br>
                <input type="text" name="username_input"><br>
                <label for="">Password :</label><br>
                <input type="password" name="password_input"><br>
                <button type="submit" name="button-login-act" value="button-login">Login</button>
            </form>
            <p><a href="signUp.php">Belum punya akun</a></p>
        </div>
    </div>

</body>
</html>