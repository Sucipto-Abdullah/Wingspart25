<?php
    $notif_index = 5;

    $notification_content = '<div class="notification-list">
                                <a href="#" id="notification-link">
                                    <img src="image/Product 1.png" class="notification-image" style="grid-area: image;">
                                    <h1 class="notification-header" style="grid-area: header;">Judul Notifikasi</h1>
                                    <p class="notification-text" style="grid-area: text;">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                </a>
                            </div>';
?>

<html>
    <head>
        <link rel="stylesheet" href="style/navigation.css">
    </head>
    <body> 
        <nav class="navigation" id="navigation">
            <a href="index.php?page=home" style="grid-area: box-1;" class="wingspart25-logo"><img src="icon/WingPart25 logo replica.svg" alt="Wingspart25"></a>
            <form action="navigation.php" name="search" class="search" style="grid-area: box-2;">
                <input class="search-bar" placeholder="search" style="grid-area: search">
                <button type="submit" name="submit" style="grid-area: submit;"><img src="icon/search-con.svg"></button>
            </form>
            <a href="index.php?page=cart" style="grid-area: box-3;" class="cart-button"><img src="icon/icon keranjang.svg" alt="keranjang"></a>
            <button class="notification-button" id="notification-button" style="grid-area: box-4;" onclick="submenu_open(this.value)" value="notification"><img src="icon/notification-icon.svg" alt="notification"></button>
            <button class="profile-button" id="profile-button" style="grid-area: box-5;" onclick="submenu_open(this.value)" value="profile"><img src="icon/Profile picture icon default.svg" alt="profile-picture" id="profile-picture"></button>
        </nav>
        <div class="sub-notification" id="sub-notification">
            <?php
                if($notif_index < 1){
                    echo "there is no notification";
                }else{
                    for($i = 0; $i<$notif_index; $i++){
                        echo $notification_content;
                    }
                }
            ?>
        </div>
    </body>
    <script src="script/navigation.js"></script>
</html>