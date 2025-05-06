<?php

include "includes/signUp.inc.php";

$error = isset($_GET['error']) ? $_GET['error'] : 'none'



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <h1>Create account</h1>
            <?php if($error != 'none'){ ?>
                <p><?= $error ?></p>
            <?php }?>
            <form action="includes/signUp.inc.php" method="POST">
                <label for="" >Username :</label><br>
                <input type="text" maxlength="24" name="username"><br>
                <label for="">Password :</label><br>
                <input type="password" name="password"><br>
                <label for="">Confirm your Password :</label><br>
                <input type="password" name="confirm-password"><br>
                <label for="">Email :</label><br>
                <input type="email" name="email"><br>
                <label for="">Phone Number :</label><br>
                <input type="number" maxlength="12" name="number"><br>
                <label for="">Alamat :</label><br>
                <textarea name="address"></textarea><br>
                <button type="submit" name="sign-up">Daftar</button>
            </form>
        </div>
    </div>

</body>
</html>