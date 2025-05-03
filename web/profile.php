<?php
include "web-element/navigation.php";

$profile_navigation = 'profile';

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
                <a href="profile.php?$profile_navigation=biodata"><li>Biodata</li></a>
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