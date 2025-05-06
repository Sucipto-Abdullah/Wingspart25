<?php

// session_start();

include "includes/databaseServer.inc.php";
include "includes/function.inc.php";

include "web-element/navigation.php";

$profile_navigation = isset($_GET['profile_navigation']) ? $_GET['profile_navigation'] : 'biodata';

$error = isset($_GET['error']) ? $_GET['error'] : '';

if( !$_SESSION['login-status'] ){
    header("Location: index.php");
}

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
                <a href="profile.php?profile_navigation=biodata"><li><i class="bi bi-person"></i> Biodata</li></a>
                <a href="profile.php?profile_navigation=edit_biodata"><li><i class="bi bi-pencil"></i> Edit Biodata</li></a>
                <a href="profile.php?profile_navigation=notifikasi"><li><i class="bi bi-bell"></i> Notifikasi</li></a>
                <a href="profile.php?profile_navigation=pesanan"><li><i class="bi bi-card-text"></i> Pesanan</li></a>
                <a href="profile.php?profile_navigation=transaksi"><li><i class="bi bi-basket"></i> Riwayat Transaksi</li></a>
            </ul>
        </div>

        <?php if($profile_navigation == 'biodata') {?>
            <div class="profile-content" style="grid-area: box-2">
                <h1 style="grid-area: box-1;"><i class="bi bi-person-fill"></i>  Profil</h1>
                <img style="grid-area: box-2;" src="image/profile-image/<?= $_SESSION['profile'] != "" ? $_SESSION['profile'] : "Profile picture icon default.svg" ?>" alt="Muka anda">
                <div class="biodata-profile" style="grid-area: box-3;">
                    <h2>Biodata : </h2>
                    <table>
                        <tr>
                            <td class="profile-data" >Username</td>
                            <td> : </td>
                            <td><?= isset($_SESSION['username']) ? $_SESSION['username'] : 'guest' ?> <?= isset($_SESSION['role']) && $_SESSION['role'] == 'admin' ? '(admin)' : '' ?></td>
                        </tr>
                        <tr>
                            <td class="profile-data" >Email</td>
                            <td> : </td>
                            <td><?= $_SESSION['email'] ?></td>
                        </tr>
                        <tr>
                            <td class="profile-data" >Nomor telephone</td>
                            <td> : </td>
                            <td><?= $_SESSION['phone-number'] ?></td>
                        </tr>
                        <tr>
                            <td class="profile-data"     >Alamat</td>
                            <td> : </td>
                            <td><?= $_SESSION['address'] ?></td>
                        </tr>
                    </table>
                </div>
                <div class="ongoing-transaction" style="grid-area: box-4">
                    <h2>Ongoing Transaction :  (<?= count_ongoing_transaction($database_connection) ?>)</h2>
                </div>
            </div>
        <?php } ?>
        
        <?php if($profile_navigation == 'edit_biodata') {?>
            <div class="profile-content edit" style="grid-area: box-2">
                <h1 style="grid-area: box-1;"><i class="bi bi-person-fill"></i> Edit Profil</h1>
                <div class="edit-biodata" style="grid-area: box-2;" >
                    <form action="includes/editAccount.inc.php" method="POST" enctype="multipart/form-data">
                        <div class="image-input" style="grid-area: photo-input">
                            <img style="grid-area: box-2;" src="image/profile-image/<?= $_SESSION['profile'] != "" ? $_SESSION['profile'] : "Profile picture icon default.svg" ?>" alt="Muka anda">
                            <input type="file" name="photo_profile" value="<?=$_SESSION['profile']?>">
                            <p class="profile-upload-error"><?= $error ?></p>
                        </div>

                        <div class="input-edit" style="grid-area: text-input">
                            <h2>Biodata :</h2>
                            <table >
                                <tr>
                                    <td class="profile-data" >Username</td>
                                    <td> : </td>
                                    <td><input name="username" value="<?= $_SESSION['username'] ?>"></td>
                                </tr>
                                <tr>
                                    <td class="profile-data" >Email</td>
                                    <td> : </td>
                                    <td><input name="email" value="<?= $_SESSION['email'] ?>" ></td>
                                </tr>
                                <tr>
                                    <td class="profile-data" >Nomor telephone</td>
                                    <td> : </td>
                                    <td><input name="phone-number" value="<?= $_SESSION['phone-number'] ?>" ></td>
                                </tr>
                                <tr>
                                    <td class="profile-data alamat">Alamat</td>
                                    <td> : </td>
                                    <td><textarea name="address" value="<?= $_SESSION['address'] ?>"><?= $_SESSION['address'] ?></textarea></td>
                                </tr>
                            </table>
                            <button type="submit" name="cancel-edit" class="btn edit-profile cancel"> batal </button>
                            <button type="submit" name="confirm-edit" class="btn edit-profile"> Ubah </button>
                            <button type="submit" name="delete-account" class="btn edit-profile"> Hapus Akun </button>
                        </div>
                    </form>
                </div>
            </div>
        <?php } ?>
        
        <?php if($profile_navigation == 'notifikasi') {?>

            <div class="profile-content notifikasi" style="grid-area: box-2">
                <h1 style="grid-area: box-1;"><i class="bi bi-envelope"></i> Notifikasi : (<?= count_notification($database_connection, 'unread') ?>) </h1>
                <?php render_notification($database_connection); ?>
            </div>

        <?php } ?>

    </div>
        
</body>
</html>

<?php
get_time_pass("2025-04-05 12:0:0");
include "web-element/footer.php";
?>