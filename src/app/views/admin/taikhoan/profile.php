<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thông tin người đăng nhập</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form>
                                <div class="form-group">
                                    <label for="username">Tên người dùng</label>
                                    <input type="text" class="form-control" id="username" value="<?= $list["ten_nd"] ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="email">Ảnh</label>
                                    <div style="width: 15%">
                                        <img src="../../../public/image/anhnguoidung/<?= $list["anh_nd"] ?>" alt="" class="img-fluid">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="role">Email</label>
                                    <input type="text" class="form-control" id="role" value="<?= $list["email_nd"] ?>" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="role">Số điện thoại</label>
                                    <input type="text" class="form-control" id="role" value="<?= $list["sdt_nd"] ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="role">Địa chỉ</label>
                                    <textarea class="form-control" rows="3" id="role" disabled><?= $list["diachi_nd"] ?></textarea   >
                                </div>
                                
                                <div class="form-group">
                                    <label for="role">Chức vụ</label>
                                    <input type="text" class="form-control" id="role" value="<?php echo $list["id_cv"]==1? "Admin" : "Nhân viên"; ?>" disabled>
                                </div>

                                <a href="index.php?act=nv&type=editpr&id=<?= $list["id_nd"] ?>" class="btn btn-success">Chỉnh sửa thông tin</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>