<?php

if(isset($_POST['cancel'])){
    header("Location: ../product.php?product_navigation=product-list");
}

if( isset($_POST['edit']) ){
    echo 'hehe';
}


?>