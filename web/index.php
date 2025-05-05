<?php
    session_start();

    require "includes/databaseServer.inc.php";
    require "includes/function.inc.php";

    update_notification_row($database_connection);
    
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


    //hallo dunia !!!!!


?>