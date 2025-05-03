<?php
    $notif_index = 1;

    include "includes/databaseServer.inc.php";

    $notification_content = '<div class="notification-list">
                                <a href="#" id="notification-link">
                                    <img src="image/Product 1.png" class="notification-image" style="grid-area: image;">
                                    <h1 class="notification-header" style="grid-area: header;">Judul Notifikasi</h1>
                                    <p class="notification-text" style="grid-area: text;">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                </a>
                            </div>';
    $notification_nothing = '<div class="notification-nothing">
                                <h1>tidak ada notifikisai yang menunggu</h1>
                            </div>';
?>

<html>
    <head>
        <link rel="stylesheet" href="FrameWork/Wingspart25-FrameWork.css">
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
                if($notif_index < 1){
                    echo $notification_nothing;
                }else{
                    for($i = 0; $i<$notif_index; $i++){
                        echo $notification_content;
                    }
                }
            ?>
        </div>

        <div class="profile-menu" id="profile-menu">
            <?php if( $_SESSION['login']) {?>
                <img src="icon/Profile picture icon default.svg" alt="Muka Burik anda">
                <p><b>hehe</b></p>
                <a href="profile.php"><button class="btn account-btn bg-light-color">Profile</button></a>
                <a href="signIn.php"><button class="btn account-btn bg-light-color">Change Account</button></a>
            <?php } else {?>
                <img src="icon/Profile picture icon default.svg" alt="Muka Burik anda">
                <p><b>Anda Belum Login</b></p>
                <a href="signIn.php"><button onclick="" class="btn account-btn bg-light-color">Sign In</button></a>
            <?php }?>
        </div>

    </body>
    <script src="script/navigation.js"></script>
    <script src="FrameWork/Wingspart25-FrameWork.js"></script>
</html>