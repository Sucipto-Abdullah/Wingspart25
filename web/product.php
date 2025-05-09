<?php

include "includes/databaseServer.inc.php";
include "includes/function.inc.php";
include "web-element/navigation.php";

$product_navigation = isset($_GET['product_navigation']) ? $_GET['product_navigation'] : 'dashboard';

$alert = '';

if ($_SESSION['role'] != 'admin'){
    header("Location: index.php");
}

if ( isset($_POST['add-product']) ){
    $alert = $_POST['add-product'];
}

if ( isset($_POST['edit']) ){
    $alert = 'edit';
    $name = getRowColumn($database_connection, 'table_barang', 'id_barang', (int)$_POST['edit'], 'nama_barang');
    $cost = getRowColumn($database_connection, 'table_barang', 'id_barang', (int)$_POST['edit'], 'harga_barang');
    $condition = getRowColumn($database_connection, 'table_barang', 'id_barang', (int)$_POST['edit'], 'kondisi_barang');
    $description = getRowColumn($database_connection, 'table_barang', 'id_barang', (int)$_POST['edit'], 'deskripsi_barang');
    $brand = getRowColumn($database_connection, 'table_barang', 'id_barang', (int)$_POST['edit'], 'merek_barang');
    $image = getRowColumn($database_connection, 'table_barang', 'id_barang', (int)$_POST['edit'], 'gambar_barang');
}

if ( isset($_POST['info']) ){
    $alert = 'info';
    $name = getRowColumn($database_connection, 'table_barang', 'id_barang', (int)$_POST['info'], 'nama_barang');
    $cost = getRowColumn($database_connection, 'table_barang', 'id_barang', (int)$_POST['info'], 'harga_barang');
    $condition = getRowColumn($database_connection, 'table_barang', 'id_barang', (int)$_POST['info'], 'kondisi_barang');
    $description = getRowColumn($database_connection, 'table_barang', 'id_barang', (int)$_POST['info'], 'deskripsi_barang');
    $brand = getRowColumn($database_connection, 'table_barang', 'id_barang', (int)$_POST['info'], 'merek_barang');
    $image = getRowColumn($database_connection, 'table_barang', 'id_barang', (int)$_POST['info'], 'gambar_barang');
    $status = getRowColumn($database_connection, 'table_barang', 'id_barang', (int)$_POST['info'], 'status_barang');
}
if (isset($_POST['cancel'])){
    $alert = '';
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

    <div class="alert <?= $alert != '' ? 'open' : '' ?>">

        <?php if( $alert == 'add' ) {?>
            <div class="add-product">
            <h1>Tambah produk</h1>
            <form action="includes/addProduct.inc.php" method="POST">
                <div class="input-barang">
                    <label>Nama Produk :   </label>
                    <input type="text" name="name-input" placeholder="Nama Produk">
                </div>
                <div class="input-barang">
                    <label>Harga Produk :   </label>
                    <input type="number" name="cost-input" placeholder="Harga Produk">
                </div>
                <div class="input-barang">
                    <label>Merek Produk :   </label>
                    <input type="text" name="brand-input" placeholder="Merk Produk">
                </div>
                <div class="input-barang">
                    <label>Kondisi : </label>
                    <div class="kondisi-choice">
                        <input type="radio" id="kondisi-baru" name="kondisi">
                        <label for="kondisi-baru">baru</label>
                        <input type="radio" id="kondisi-bekas" name="kondisi">
                        <label for="kondisi-bekas">bekas</label>
                    </div>
                </div>
                <div class="input-barang">
                    <label>Deskripsi produk : </label>
                    <textarea type="text" name="description-input" placeholder="Deskripsi"></textarea>
                </div>
                <div class="input-barang">
                    <label>Gambar produk : </label>
                    <input type="FILE" name="image-input">
                </div>
                <div class="input-barang">
                    <button class="btn bg-red" name="cancel" type="submit">cancel</button>
                    <button class="btn bg-blue" name="submit" type="submit">Submit</button>
                </div>
            </form>
            </div>
        <?php } ?>

        <?php if( $alert == 'edit' ) {?>
            <div class="add-product">
            <h1>Edit produk</h1>
            <form action="includes/addProduct.inc.php" method="POST">
                <div class="input-barang">
                    <label>Nama Produk :   </label>
                    <input type="text" name="name-input" placeholder="Nama Produk" value="<?= $name ?>">
                </div>
                <div class="input-barang">
                    <label>Harga Produk :</label>
                    <input type="number" name="cost-input" placeholder="Harga Produk" value="<?= $cost ?>">
                </div>
                <div class="input-barang">
                    <label>Merek Produk :   </label>
                    <input type="text" name="brand-input" placeholder="Merk Produk" value="<?= $brand ?>">
                </div>
                <div class="input-barang">
                    <label>Kondisi : </label>
                    <div class="kondisi-choice">
                        <?php if( $condition == 'baru' ){ ?>
                            <input type="radio" id="kondisi-baru" name="kondisi" checked>
                            <label for="kondisi-baru">baru</label>
                            <input type="radio" id="kondisi-bekas" name="kondisi">
                            <label for="kondisi-bekas">bekas</label>
                        <?php } else{?>
                            <input type="radio" id="kondisi-baru" name="kondisi">
                            <label for="kondisi-baru">baru</label>
                            <input type="radio" id="kondisi-bekas" name="kondisi" checked>
                            <label for="kondisi-bekas">bekas</label>
                        <?php }?>
                    </div>
                </div>
                <div class="input-barang">
                    <label>Deskripsi produk : </label>
                    <textarea type="text" name="description-input" placeholder="Deskripsi"><?= $description ?></textarea>
                </div>
                <div class="input-barang">
                    <label>Gambar produk : </label>
                    <input type="FILE" name="image-input" value="">
                </div>
                <div class="input-barang">
                    <button class="btn bg-red" name="cancel" type="submit">cancel</button>
                    <button class="btn bg-blue" name="submit" type="submit">Submit</button>
                </div>
            </form>
        </div>
        <?php } ?>
        <?php if( $alert == 'info' ){ ?>
            <div class="add-product info">
                <h1 style="grid-area: box-1;">Info Produk</h1>
                <div class="image-product" style="grid-area: box-2;">
                    <img src="image/product-image/<?= $image ?>" alt="<?= $image ?>">
                </div>
                <table style="grid-area: box-3">
                    <tr>
                        <td>Nama Produk</td>
                        <td>:</td>
                        <td><?= $name ?></td>
                    </tr>
                    <tr>
                        <td>Harga Produk</td>
                        <td>:</td>
                        <td>Rp<?= $cost ?></td>
                    </tr>
                    <tr>
                        <td>Merk Produk</td>
                        <td>:</td>
                        <td><?= $brand ?></td>
                    </tr>
                    <tr>
                        <td>Status Produk</td>
                        <td>:</td>
                        <td><?= $status ?></td>
                    </tr>
                    <tr>
                        <td>Kondisi Produk</td>
                        <td>:</td>
                        <td><?= $condition ?></td>
                    </tr>
                </table>
                <div class="description-box" style="grid-area: box-4;">
                    <p class="description-header">Deskripsi :</p>
                    <p class="description-content"><?= $description ?></p>
                </div>
                <form method="POST" style="grid-area: box-5;">
                    <button class="btn bg-blue" name="cancel" type="submit"><i class="bi bi-arrow-left-square-fill"></i> back</button>
                </form>
            </div>
        <?php } ?>
    </div>

    <div class="page product">

        <div class="profile-navigation product" style="grid-area:box-1">
            <h1>Admin Control</h1>
            <ul>
                <a class="profile-navigation-list <?= $product_navigation == 'dashboard' ? 'active' : '' ?>" href="product.php?product_navigation=dashboard"><li><i class="bi bi-bag-dash"></i> Dashboard</li></a>
                <a class="profile-navigation-list <?= $product_navigation == 'product-list' ? 'active' : '' ?>" href="product.php?product_navigation=product-list"><li><i class="bi bi-hdd-stack"></i> list produk</li></a>
                <a class="profile-navigation-list <?= $product_navigation == 'pesanan' ? 'active' : '' ?>" href="product.php?product_navigation=pesanan"><li><i class="bi bi-basket"></i> Pesanan</li></a>
                <a class="profile-navigation-list <?= $product_navigation == 'analitik' ? 'active' : '' ?>" href="product.php?product_navigation=analitik"><li><i class="bi bi-graph-up-arrow"></i> Analitik</li></a>
                <a class="profile-navigation-list <?= $product_navigation == 'umpan-balik' ? 'active' : '' ?>" href="product.php?product_navigation=umpan-balik"><li><i class="bi bi-envelope"></i> Umpan Balik</li></a>
            </ul>
        </div>

        <div class="product-page dashboard <?= $product_navigation == 'dashboard' ? 'open' : '' ?>" style="grid-area: box-1;">
            <h1><i class="bi bi-bag-dash"></i> Dashboard</h1>
        </div>
        <div class="product-page product <?= $product_navigation == 'product-list' ? 'open' : '' ?>" style="grid-area: box-1;">
            <h1><i class="bi bi-hdd-stack"></i> Product</h1>
            <div class="btn-control-product">
                <form method="POST">
                    <button name="add-product" value="add" class="btn bg-blue"><i class="bi bi-plus-circle"></i> Tambah</button>
                </form>
            </div>
            <div class="product-list-table">
                <!-- <div class="table">
                    <div class="tr">
                        <div class="row option-column th">
                            <p>Option</p>
                        </div>
                        <div class="row number-column th">
                            <p>NO</p>
                        </div>
                        <div class="row image-column th">
                            <p>Gambar</p>
                        </div>
                        <div class="row name-column th">
                            <p>Nama</p>
                        </div>
                        <div class="row cost-column th">
                            <p>Harga</p>
                        </div>
                        <div class="row brand-column th">
                            <p>Merk</p>
                        </div>
                        <div class="row description-column th">
                            <p>Deskripsi</p>
                        </div>
                        <div class="row status-column th">
                            <p>status</p>
                        </div>
                        <div class="row category-column th">
                            <p>kategori</p>
                        </div>
                        <div class="row condition-column th">
                            <p>Kondisi</p>
                        </div>
                    </div>
                        <div class="tr value odd">
                        <div class="row option-column td">
                            <form method="POST">
                                <button type="submit" name="info" value="3" class="btn bg-yellow"><i class="bi bi-info-circle"></i></button>
                                <button type="submit" name="edit" value="3" class="btn bg-blue"><i class="bi bi-pencil"></i></button>
                                <button type="submit" name="delete" value="3" class="btn bg-red"><i class="bi bi-trash3"></i></button>
                            </form>
                        </div>
                        <div class="row number-column td">
                            <p>1</p>
                        </div>
                        <div class="row image-column td">
                            <img src="image/product-image/681d2c8084f7b2.50898420.Product 1.png" alt="hehe">
                        </div>
                        <div class="row name-column td">
                            <p>	Agv K3SV Five</p>
                        </div>
                        <div class="row cost-column td">
                            <p>Rp5.000.000,00</p>
                        </div>
                        <div class="row brand-column td">
                            <p>Agv</p>
                        </div>
                        <div class="row description-column td">
                            <p>Barangnya bagus</p>
                        </div>
                        <div class="row status-column td">
                            <p>baru</p>
                        </div>
                        <div class="row category-column td">
                            <p>Helm</p>
                        </div>
                        <div class="row condition-column td">
                            <p>bagus</p>
                        </div>
                    </div> -->
                    <!-- <?php  ?>
                </div> -->
                <div class="table">
                    <table>
                        <tr>
                            <th class="option-column">Option</th>
                            <th class="number-column">No</th>
                            <th class="image-column">Gambar</th>
                            <th class="name-column">Nama</th>
                            <th class="cost-column">Harga</th>
                            <th class="brand-column">Merek</th>
                            <!-- <th class="description-column">Deskripsi</th> -->
                            <th class="category-column">Kategori</th>
                            <th class="condition-column">Kondisi</th>
                            <th class="status-column">Stastus</th>
                        </tr>
                        <!-- <tr>
                            <td class='option-column'>
                                <form method='POST'>
                                    <button type='submit' name='info' value='3' class='btn bg-yellow'><i class='bi bi-info-circle'></i></button>
                                    <button type='submit' name='edit' value='3' class='btn bg-blue'><i class='bi bi-pencil'></i></button>
                                    <button type='submit' name='delete' value='3' class='btn bg-red'><i class='bi bi-trash3'></i></button>
                                </form>
                            </td>
                            <td class='number-column'>1</td>
                            <td class='image-column'>
                                <img src='image/product-image/681d2c8084f7b2.50898420.Product 1.png'>
                            </td>
                            <td class='name-column'>Agv K3SV Five</td>
                            <td class='cost-column'>Rp5.000.000,00</td>
                            <td class='brand-column'>Agv</td>
                            <td class='category-column'>Helm</td>
                            <td class='condition-column'>baru</td>
                            <td class='status-column'>tersedia</td>
                        </tr> -->
                        <?php print_all_product($database_connection) ?>
                    </table>

                </div>
            </div>
        </div>

    </div>
</body>
</html>
