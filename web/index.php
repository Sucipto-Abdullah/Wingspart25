<?php
    session_start();

    include "includes/databaseServer.inc.php";
    include "includes/function.inc.php";

    // role_check($database_connection);
    //$page = isset($_GET['page']) ? $_GET['page'] : 'home';

    include "web-element/navigation.php";

    include "web-element/category.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wingspart25</title>
</head>
<body>
    <div class="page">

    </div>
</body>
</html>

<?php
    include "web-element/footer.php";


    //hallo


?>