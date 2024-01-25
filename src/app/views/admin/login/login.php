<?php
    require_once __DIR__ . "./../../../models/pdo.php";

    function login($tk,$mk){
        $sql = "SELECT * FROM nguoi_dung WHERE id_cv IN (1,2)";
        $temp = pdo_qr($sql);

        foreach($temp as $temp){
            if($mk == $temp["mk_nd"] && $tk == $temp["email_nd"]){
                return $temp;
            }
        }
        return false;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["login"]) && !empty($_POST["login"])){
            $check = true;

            if(empty($_POST["tk"])){
                $tkErr = " * Tài khoản không được bỏ trống";
                $check = false;
            }

            if(empty($_POST["mk"])){
                $mkErr = " * Mật khẩu không được bỏ trống";
                $check = false;
            }

            if($check){
                $login = login($_POST["tk"],$_POST["mk"]);
                if($login == false){
                    $message = '<div class="alert alert-danger" role="alert">
                                    <strong>Đăng nhập không thành công!</strong>
                                </div>';
                }else{

                    // huy bien session khachhang neu co
                    unset($_SESSION["khachhang"]);
            
                    $_SESSION["admin"]["id_cv"] = $login["id_cv"];
                    $_SESSION["admin"]["id_nd"] = $login["id_nd"];
                    header("Location: index.php");
                }
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=dsevice-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Login</title>
    <!-- Bao gồm Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-image: url('https://images.unsplash.com/photo-1419133203517-f3b3ed0ba2bb?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTB8fHJpdmVyfGVufDB8fDB8fHww');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .transparent-bg {
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 10px;
            padding: 30px;
            width: 400px;
        }

        .transparent-bg h4 {
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .error{
            color: red;
            font-size: 60%;
        }
    </style>
</head>
<body>

    <div class="container transparent-bg">
        <div class="text-center mb-4">
            <img src="https://www.ebanhang.vn/app/webroot/img/icon_login.png" alt="Logo" height="80">
            <h4 class="mt-3">Admin</h4>
        </div>
        <!-- Form đăng nhập -->
        <form action="" method="POST">
            <div class="form-group">
                <span class="error"><?= $tkErr??"" ?></span>
                <input type="text" name="tk" class="form-control" placeholder="Nhập email" required>
            </div>
            <div class="form-group">
                <span class="error"><?= $mkErr??"" ?></span>
                <input type="password" name="mk" class="form-control" placeholder="Mật khẩu" required>
            </div>

            <?= $message??"" ?>
            <button type="submit" name="login" value="login" class="btn btn-primary btn-block">Đăng nhập</button>
        </form>
    </div>
</body>
</html>
