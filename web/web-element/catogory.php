<?php
$category = array(
    array("nama" => "Helm"),
    array("nama" => "Spion"),
    array("nama" => "Knalpot"),
    array("nama" => "Head Lamp"),
    array("nama" => "Disc Motor"),
    array("nama" => "Rem"),
    array("nama" => "Motor")
);

?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="FrameWork/Wingspart25.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>
<body>
    <div class="category bg-secondary margin-auto content-center">
        <h1 style="grid-area: box-1">Kategori</h1>
        <div class="category-list" style="grid-area: box-2;">
            <a class="category-object  <?= $_GET['category'] == 'all' ? 'active' : ''?> delete " href="index.php?category=all">
                <h1><i class="bi bi-filter-right"></i></h1>
                <p>All</p>
            </a>
            <?php for($i=0; $i<count($category); $i++) {?>
                <a class="category-object <?= $_GET['category'] == $category[$i]["nama"] ? 'active' : ''?>" href="index.php?category=<?= $category[$i]["nama"] ?>">
                    <img style="grid-area: box-1;" src="image/<?= $category[$i]["nama"] ?>.png">
                    <p style="grid-area: box-2;"><?= $category[$i]["nama"] ?></p>
                </a>
            <?php }?>
        </div>
    </div>
</body>
</html>
