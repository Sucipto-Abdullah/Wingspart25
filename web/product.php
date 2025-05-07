<?php

include "includes/databaseServer.inc.php";
include "includes/function.inc.php";
include "web-element/navigation.php";

$product_navigation = isset($_GET['product_navigation']) ? $_GET['product_navigation'] : 'product-list';

if ($_SESSION['role'] != 'admin'){
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wingspart25</title>
</head>
<body>
    <div class="page product">

        <div class="profile-navigation product" style="grid-area:box-1">
            <h1>Navigasi</h1>
            <ul>
                <a class="profile-navigation-list <?= $product_navigation == 'dashboard' ? 'active' : '' ?>" href="product.php?product_navigation=dashboard"><li><i class="bi bi-bag-dash"></i> Dashboard</li></a>
                <a class="profile-navigation-list <?= $product_navigation == 'product-list' ? 'active' : '' ?>" href="product.php?product_navigation=product-list"><li><i class="bi bi-hdd-stack"></i> list produk</li></a>
                <a class="profile-navigation-list <?= $product_navigation == 'pesanan' ? 'active' : '' ?>" href="product.php?product_navigation=pesanan"><li><i class="bi bi-basket"></i> Pesanan</li></a>
                <a class="profile-navigation-list <?= $product_navigation == 'analitik' ? 'active' : '' ?>" href="product.php?product_navigation=analitik"><li><i class="bi bi-graph-up-arrow"></i> Analitik</li></a>
                <a class="profile-navigation-list <?= $product_navigation == 'umpan-balik' ? 'active' : '' ?>" href="product.php?product_navigation=umpan-balik"><li><i class="bi bi-envelope"></i> Umpan Balik</li></a>
            </ul>
        </div>

        <div class="product-page dashboard open" style="grid-area: box-1;">
            <h1><i class="bi bi-bag-dash"></i> Dashboard</h1>
        </div>

    </div>
</body>
</html>
