<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chỉnh sửa hình ảnh</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">QLSP</li>
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
                        <form action="index.php?act=sp&type=editha&idsp=<?= $hinhanh["id_sp"] ?>&idha=<?= $hinhanh["id_ha"] ?>" method="POST" enctype="multipart/form-data">
                    
                            <div class="form-group">
                                <label for="anhNhanVien">Ảnh mô tả</label>
                                <span class="error"><?= $anhErr??"" ?></span>
                                <input type="file" class="form-control-file" id="anhNhanVien" name="anh_ha" onchange="hienThiAnh()">
                                <img alt="" src="../../../public/image/anhsanpham/<?= $hinhanh["anh_ha"] ?>" class="mt-3" id="anhHienThi" width="20%">
                            </div>
                                    
                            <?= $message??"" ?>
                            <button type="submit" value="updateha" name="updateha" class="btn btn-primary mb-3">Cập nhật hình ảnh</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->
