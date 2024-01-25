<?php

require_once __DIR__ . "./../../models/pdo.php";
require_once __DIR__ . "./../../models/client/client.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $check = true;

    if (empty($_POST["email"])) {
        $check = false;
        echo "Email không được bỏ trống";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $check = false;
        echo "Email không đúng định dạng";
    } elseif (strlen($_POST["email"]) > 100) {
        $check = false;
        echo "Độ dài Email không vượt quá 100 ký tự";
    } else {
        $sql = "SELECT email_lh FROM lien_he";
        foreach (pdo_qr($sql) as $temp) {
            if ($_POST["email"] == $temp["email_lh"]) {
                echo "Email đã tồn tại";
                $check = false;
                break;
            }
        }
        
    }

    if ($check) {
        add_lh($_POST["email"]);
        echo "Cảm ơn bạn đã quan tâm đến shop";
    }
}
