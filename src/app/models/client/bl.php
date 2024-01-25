
<?php

session_start();
require_once __DIR__ . "./../../models/pdo.php";
require_once __DIR__ . "./../../models/client/client.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $check = true;

    if($_POST["nd_bl"] == 0){
        
    }elseif(empty($_POST["nd_bl"])){
        echo "Bình luận không được bỏ trống";
        $check = false;
    }

    if($check){
        add_bl($_POST["id_sp"], $_SESSION["khachhang"] ?? $_SESSION["admin"]["id_nd"], $_POST["nd_bl"]);
        echo "TC";
    }
}
?>
