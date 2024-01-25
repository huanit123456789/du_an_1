<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thêm tài khoản khách hàng</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">QLTK-KH</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="container">
                        <form action="index.php?act=kh&type=add" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="ten_nd">Họ và tên</label>
                                <span class="error"><?= $tenErr??"" ?></span>
                                <input type="text" class="form-control" id="ten_nd" name="ten_nd" placeholder="Nhập tên khách hàng" value="<?= $_POST['ten_nd']??"" ?>" >
                            </div>

                            <div class="form-group">
                                <label for="anhNhanVien">Ảnh</label>
                                <span class="error"><?= $anhErr??"" ?></span>
                                <input type="file" class="form-control-file" id="anhNhanVien" name="anh_nd" onchange="hienThiAnh()">
                                <img alt="" class="mt-3" id="anhHienThi" width="20%">
                            </div>
                                    
                            <div class="form-group">
                                <label for="email_nd">Email</label>
                                <span class="error"><?= $emailErr??"" ?></span>
                                <input type="email" class="form-control" id="email_nd" name="email_nd" placeholder="Nhập email" value="<?= $_POST['email_nd']??"" ?>">
                            </div>

                            <div class="form-group">
                                <label for="mk_nd">Mật Khẩu</label>
                                <span class="error"><?= $passErr??"" ?></span>
                                <input type="password" class="form-control" id="mk_nd" name="mk_nd" placeholder="Nhập mật khẩu">
                            </div>

                            <div class="form-group">
                                <label for="ngaysinh_nd">Ngày sinh</label>
                                <span class="error"><?= $dateErr??"" ?></span>
                                <input type="date" class="form-control" id="ngaysinh_nd" name="ngaysinh_nd" value="<?= $_POST['ngaysinh_nd']??"" ?>" >
                            </div>

                            <div class="form-group">
                                <label for="sdt_nd">Số Điện Thoại</label>
                                <span class="error"><?= $phoneErr??"" ?></span>
                                <input type="tel" class="form-control" id="sdt_nd" name="sdt_nd" placeholder="Nhập số điện thoại" value="<?= $_POST['sdt_nd']??"" ?>" >
                            </div>

                            <div class="form-group">
                                <label for="diachi_nd">Địa Chỉ</label>
                                <span class="error"><?= $adressErr??"" ?></span>
                                <textarea class="form-control" id="diachi_nd" name="diachi_nd" rows="3" placeholder="Nhập địa chỉ"><?= $_POST['diachi_nd']??"" ?></textarea>
                            </div>

                            <?= $message??"" ?>
                            <button type="submit" class="btn btn-primary mb-3" name="addkh" value="addkh">Thêm tài khoản</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

