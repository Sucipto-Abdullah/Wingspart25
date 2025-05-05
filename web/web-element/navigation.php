<?php

    require_once "includes/function.inc.php";
    // session_start();

    $notification_nothing = '<div class="notification-nothing">
                                <h1>tidak ada notifikisai yang menunggu</h1>
                            </div>';
?>

<html>
    <head>
        <link rel="stylesheet" href="FrameWork/Wingspart25-FrameWork.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    </head>
    <body> 
        <nav class="navigation bg-main">
            <div class="container">
                <a href="index.php" class="wingspart25-logo" style="grid-area: box-1"></a>
                <form name="search" class="form search-form" style="grid-area: box-2">
                    <input class="input search-bar" placeholder="search">
                    <button class="btn search-btn bg-transparant" type="submit" name="submit"></button>
                </form>
                <a class="btn cart-btn bg-transparant" href="cart.php" class="cart-button" style="grid-area: box-3"><img src="icon/icon keranjang.svg" alt="keranjang"></a>
                <button class="btn notification-btn bg-transparant" onclick="popup_menu(this.value)" value="notification" style="grid-area: box-4"><img src="icon/notification-icon.svg" alt="notification" ></button>
                <button class="btn profile-btn bg-transparant" onclick="popup_menu(this.value)" style="grid-area: box-5;" value="profile"><img src="icon/Profile picture icon default.svg" alt="profile-picture" id="profile-picture"></button>
            </div>
        </nav>
        <div class="sub-notification" id="sub-notification">
            <?php
                if( !isset($_SESSION['notification-wait']) || $_SESSION['notification-wait'] < 1){
                    echo $notification_nothing;
                    echo $_SESSION['notification-wait'];
                }else{
                    render_notification($database_connection);
                }
            ?>
        </div>

        <div class="profile-menu" id="profile-menu">
            <?php if( isset($_SESSION['login-status']) && $_SESSION['login-status'] == true) {?>

                <img src="icon/Profile picture icon default.svg" alt="Muka Burik anda">
                <p class="profile-name" ><b><?= $_SESSION['username'] ?> <?= $_SESSION['role'] == 'admin' ? '<br>(admin)' : ''?></b></p>
                <a href="profile.php"><button class="btn account-btn ">Profile <i class="bi bi-person-fill"></i></button></a>

                <?php if( isset($_SESSION['role']) && $_SESSION['role'] == 'admin' ) {?>
                    <a href="product.php"><button class="btn account-btn ">Our Product <i class="bi bi-hdd-stack"></i></button></a>
                <?php } ?>

                <a href="signIn.php"><button class="btn account-btn ">Switch User <i class="bi bi-arrow-repeat"></i></button></a>
                <a href="includes/signOut.php"><button class="btn account-btn ">Sign out <i class="bi bi-box-arrow-right"></i></button></a>

            <?php } else {?>

                <img src="icon/Profile picture icon default.svg" alt="Muka Burik anda">
                <p class="profile-name"><b>Anda Belum Login</b></p>
                <a href="signIn.php"><button onclick="" class="btn account-btn">Sign In <i class="bi bi-box-arrow-in-left"></i></button></a>

            <?php }?>
        </div>

    </body>
    <script src="script/navigation.js"></script>
    <script src="FrameWork/Wingspart25-FrameWork.js"></script>
</html>