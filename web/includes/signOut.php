<?php

include "databaseServer.inc.php";
include "function.inc.php";

logout_account($database_connection);

header("Location: ../index.php");

?>