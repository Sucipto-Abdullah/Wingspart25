<?php
include "web-element/navigation.php";

$profile_navigation = isset($_GET['profile_navigation']) ? $_GET['profile_navigation'] : 'biodata';

?>

<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="FrameWork/Wingspart25-FrameWork.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>
<body>

    <div class="page profile">
        <div class="profile-navigation" style="grid-area:box-1">
            <h1>Navigasi</h1>
            <ul>
                <a href="profile.php?$profile_navigation=biodata"><li><i class="bi bi-person"></i> Biodata</li></a>
                <a href="profile.php?$profile_navigation=notifikasi"><li><i class="bi bi-bell"></i> Notifikasi</li></a>
                <a href="profile.php?$profile_navigation=pesanan"><li><i class="bi bi-card-text"></i> Pesanan</li></a>
                <a href="profile.php?$profile_navigation=transaksi"><li><i class="bi bi-basket"></i> Riwayat Transaksi</li></a>
            </ul>
        </div>
        <div class="profile-content" style="grid-area: box-2">
            <h1 style="grid-area: box-1;"><i class="bi bi-person-fill"></i>  Profil</h1>
            <img style="grid-area: box-2;" src="icon/Profile picture icon default.svg" alt="Muka anda">
        </div>
    </div>
        
</body>
</html>

<?php
include "web-element/footer.php";
?>