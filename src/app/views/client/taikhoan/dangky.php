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
        margin-bottom: 50px;
        padding: 60px;
    }

    .form-group {
        width: 60%;
        /* Đặt chiều rộng của form-group là 100% */
    }

    .login-container form {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .button>a,
    .button>button {
        width: 150px;
    }
</style>

<body>
    <div class="container login-container">
        <form action="index.php?act=tk&type=dk" method="POST" enctype="multipart/form-data">
            <h2 class="mb-5"><b>Đăng ký tài khoản</b></h2>

            <div class="form-group">
                <label for="ten_nd">Họ và tên</label>
                <span class="error"><?= $tenErr ?? "" ?></span>
                <input type="text" class="form-control" id="ten_nd" name="ten_nd" placeholder="Nhập tên khách hàng" value="<?= $_POST['ten_nd'] ?? "" ?>">
            </div>

            <div class="form-group">
                <label>Email</label>
                <span class="error"><?= $emailErr ?? "" ?></span>
                <input type="text" class="form-control" name="email_nd" placeholder="Nhập email...">
            </div>

            <div class="form-group">
                <label>Mật khẩu</label>
                <span class="error"><?= $passErr ?? "" ?></span>
                <input type="password" name="mk_nd" class="form-control" placeholder="Nhập mật khẩu...">
            </div>

            <div class="form-group">
                <label for="ngaysinh_nd">Ngày sinh</label>
                <span class="error"><?= $dateErr ?? "" ?></span>
                <input type="date" class="form-control" id="ngaysinh_nd" name="ngaysinh_nd" value="<?= $_POST['ngaysinh_nd'] ?? "" ?>">
            </div>

            <div class="form-group">
                <label for="anhNhanVien">Ảnh</label>
                <span class="error"><?= $anhErr ?? "" ?></span>
                <input type="file" class="form-control-file" id="anhNhanVien" name="anh_nd" onchange="hienThiAnh()">
                <img alt="" class="mt-3" id="anhHienThi" width="20%">
            </div>

            <?= $message ?? "" ?>
            <div class="button d-flex justify-content-between mt-5">
                <button type="submit" name="dk" value="dk" class="btn btn-primary mr-2">Đăng ký</button>
                <a href="index.php?act=tk&type=dn" class="btn btn-primary">Đăng nhập</a>
            </div>

        </form>
    </div>