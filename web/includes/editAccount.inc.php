<?php

include "databaseServer.inc.php";
include "function.inc.php";

if (isset($_POST['confirm-edit'])){
    
    $username_input = trim($_POST['username']);
    $email_input = trim($_POST['email']);
    $phone_number_input = trim($_POST['phone-number']);
    $address_input = trim($_POST['address']);

    try{
        $image_file = $_FILES['photo_profile'];
        
        $image_name = $_FILES['photo_profile']['name'];
        $image_format = $_FILES['photo_profile']['type'];
        $image_tmp = $_FILES['photo_profile']['tmp_name'];
        $image_error = $_FILES['photo_profile']['error'];
        $image_size = $_FILES['photo_profile']['size'];
        
        $image_name_EXT = explode('.', $image_name);
        $image_file_format = strtolower(end($image_name_EXT));
        $format_allow = array('jpg', 'jpeg', 'png');
        
        $image_new_name = '';
        
        if( in_array($image_file_format, $format_allow) ){
            
            if( $image_error === 0 ){
                
                if( $image_size < 10000000 ){
                    
                    $image_new_name = uniqid('', true).'.'.$image_name_EXT[0].'.'.$image_name_EXT[1];
                    $image_destination = "../image/profile-image/{$image_new_name}";
                    move_uploaded_file($image_tmp, $image_destination);
                    
                }else{
                    header("Location: ../profile.php?profile_navigation=edit_biodata&error=ukuran gambar terlalu besar, maksimal 7mb");
                }

            }else {
                header("Location: ../profile.php?profile_navigation=edit_biodata&error=maaf, foto yang kamu posting mengalami gangguan, silakan coba lagi");
            }

        }else{
            header("Location: ../profile.php?profile_navigation=edit_biodata?error=maaf, format foto yang kamu posting tidak mendukung");
        }
        update_table($database_connection, 'table_akun_pengguna', 'user_profile', $image_new_name, 'user_id', 'user-id');
        $_SESSION['profile'] = $image_new_name;
    } catch(mysqli_sql_exception) {
        // header("Location: ../profile.php?profile_navigation=edit_biodata?error=maaf, format foto yang kamu posting tidak mendukung");
    }
}
    update_table($database_connection, 'table_akun_pengguna', 'username', $username_input, 'user_id', 'user-id');
    $_SESSION['username'] = $username_input;
    
    update_table($database_connection, 'table_akun_pengguna', 'user_email', $email_input, 'user_id', 'user-id');
    $_SESSION['email'] = $email_input;
    
    update_table($database_connection, 'table_akun_pengguna', 'user_phone_number', $phone_number_input, 'user_id', 'user-id');
    $_SESSION['phone-number'] = $phone_number_input;

    update_table($database_connection, 'table_akun_pengguna', 'user_address', $address_input, 'user_id', 'user-id');
    $_SESSION['address'] = $address_input;
     
if(isset($_POST['delete-account'])){
    delete_table_row($database_connection, 'notification_table', 'user_id', $_SESSION['user-id']);
    delete_table_row($database_connection, 'table_akun_pengguna', 'user_id', $_SESSION['user-id']);
    logout_account($database_connection);
}

push_notification($database_connection, $_SESSION['user-id'], "Perubahan Profil", "profil akunmu telah berhasil diubah :D", '');

header("Location: ../profile.php?profile_navigation=biodata");

?>