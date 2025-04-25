<html>
    <head>
        <link rel="stylesheet" href="style/navigation.css">
    </head>
    <body> 
        <nav class="navigation">
            <a href="index.php?page=home" style="grid-area: box-1;" class="wingspart25-logo"><img src="icon/WingPart25 logo replica.svg" alt="Wingspart25"></a>
            <form action="navigation.php" name="search" class="search" style="grid-area: box-2;">
                <input class="search-bar" placeholder="search" style="grid-area: search">
                <button type="submit" name="submit" style="grid-area: submit;"><img src="icon/search-con.svg"></button>
            </form>
            <a href="index.php?page=cart" style="grid-area: box-3;" class="cart-button"><img src="icon/icon keranjang.svg" alt="keranjang"></a>
            <button class="notification-button" style="grid-area: box-4;" onclick="showNotification()"><img src="icon/notification-icon.svg" alt="notification"></button>
            <button class="profile-button" style="grid-area: box-5;" onclick="showProfile()"><img src="icon/Profile picture icon default.svg" alt="profile-picture" id="profile-picture"></button>
        </nav>

        <div class="navigation sub-notification open">
            <h1>cok</h1>
        </div>
    </body>
</html>