<?php
$category = array(
    array("nama" => 'Helm'),
    array("nama" => 'Spion'),
    array("nama" => 'Knalpot'),
    array("nama" => 'Head Lamp'),
    array("nama" => 'Disc Motor'),
    array("nama" => 'Rem'),
    array("nama" => 'Motor')
);

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="FrameWork/Wingspart25-FrameWork.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>
<body>
    <div class="category bg-secondary margin-auto content-center">
        <h1 style="grid-area: box-1">Kategori</h1>
        <!-- <button class="btn bg-transparant left-scroll" id="left-scroll" style="grid-area: box-2;" onclick="scroll(this.value)" value="left"><i class="bi bi-arrow-left-circle-fill"></i></button> -->
        <div class="category-list" id="category" style="grid-area: box-2;">
            <a id="all" class='category-object  <?= $_GET['category'] == 'all' ? 'active' : ''?> delete' href='index.php?category=all'>
                <h1><i class="bi bi-filter-right"></i></h1>
                <p>All</p>
            </a>
            <?php for($i=0; $i<count($category); $i++) {?>
                <a class='category-object <?=$_GET['category'] == $category[$i]["nama"] ? 'active' : ''?>' id='<?=$category['nama']?>' href="index.php?category=<?=$category[$i]["nama"]?>">
                    <img style="grid-area: box-1;" src="image/<?= $category[$i]["nama"] ?>.png">
                    <p style="grid-area: box-2;"><?= $category[$i]["nama"] ?></p>
                </a>
            <?php }?>
        </div>
        <!-- <button class="btn bg-transparant right-scroll" id="right-scroll" style="grid-area: box-2;" onclick="scroll(this.value)" value='right'><i class="bi bi-arrow-right-circle-fill"></i></button> -->
    </div>
</body>
<script src="FrameWork/Wingspart25-FrameWork.js"></script>
</html>
