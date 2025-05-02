<?php

$_SESSION['category-list'] = array(
    array('nama' => 'Helm'),
    array('nama' => 'Spion'),
    array('nama' => 'Knalpot'),
    array('nama' => 'Head lamp'),
    array('nama' => 'Rem'),
    array('nama' => 'Disc motor'),
    array('nama' => 'Motor'),
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
            <?php for($i=0; $i < count($_SESSION['category-list']) ; $i++) {?>
                <a class='category-object <?=$_GET['category'] == $_SESSION['category-list'][$i]['nama'] ? 'active' : ''?>' id='<?=$_SESSION['category-list'][$i]['nama']?>' href="index.php?category=<?=$_SESSION['category-list'][$i]['nama']?>">
                    <img style="grid-area: box-1;" src="image/<?=$_SESSION['category-list'][$i]['nama']?>.png">
                    <p style="grid-area: box-2;"><?=$_SESSION['category-list'][$i]['nama']?></p>
                </a>
            <?php }?>
        </div>
    </div>
</body>
<script src="FrameWork/Wingspart25-FrameWork.js"></script>
</html>
