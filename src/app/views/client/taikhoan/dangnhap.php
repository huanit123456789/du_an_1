<style>
        body {
            background-color: #f8f9fa;
        }

        .login-container {
            width: 80%;
            margin: auto;
            margin-top: 50px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            margin-bottom:50px;
            padding: 60px;
        }

        .form-group {
            width: 60%; /* Đặt chiều rộng của form-group là 100% */
        }

        .login-container form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .button>a, .button>button{
            width:150px;
        }


    </style>

<body>
    <div class="container login-container">
        <form action="index.php?act=tk&type=dn" method="POST">
            <h2 class="mb-5"><b>Đăng nhập</b></h2>
            <div class="form-group">
                <label>Email</label>
                <span class="error"><?= $emailErr??"" ?></span>
                <input type="text" class="form-control" name="email_nd" placeholder="Nhập email...">
            </div>
            <div class="form-group">
                <label>Mật khẩu</label>
                <span class="error"><?= $mkErr??"" ?></span>
                <input type="password" name="mk_nd" class="form-control" placeholder="Nhập mật khẩu...">
                <input type="hidden" value="<?= $_GET["id"]??$_POST["id"]??"" ?>" name="id">
            </div>

            <?= $message??"" ?>
            <div class="button d-flex justify-content-between mt-5">
                <button type="submit" name="dn" value="dn" class="btn btn-primary mr-2">Đăng nhập</button>
                <a href="index.php?act=tk&type=dk" class="btn btn-primary">Đăng ký</a>
            </div>

        </form>
    </div>