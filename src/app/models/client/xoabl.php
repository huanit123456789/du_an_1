
<?php

session_start();
require_once __DIR__ . "./../../models/pdo.php";
require_once __DIR__ . "./../../models/client/client.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    delete_bl($_POST["id"]);
}
?>
