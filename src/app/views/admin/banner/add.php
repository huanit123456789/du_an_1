<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thêm banner</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">QLBN</li>
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
                        <form action="index.php?act=bn&type=add" method="POST" enctype="multipart/form-data">
                    
                            <div class="form-group">
                                <label for="anhNhanVien">Ảnh banner</label>
                                <span class="error"><?= $anhErr??"" ?></span>
                                <input type="file" class="form-control-file" id="anhNhanVien" name="anh_banner" onchange="hienThiAnh()">
                                <img alt="" class="mt-3" id="anhHienThi" width="20%">
                            </div>
                                    
                            <div class="form-group">
                                <label for="link_banner">Link banner</label>
                                <span class="error"><?= $linkErr??"" ?></span>
                                <input type="text" class="form-control" id="link_banner" name="link_banner" placeholder="Nhập đường dẫn" value="<?= $_POST["link_banner"]??"" ?>">
                            </div>

                            <div class="form-group">
                                <label for="mota_banner">Mô tả</label>
                                <span class="error"><?= $motaErr??"" ?></span>
                                <textarea class="form-control" id="mota_banner" name="mota_banner" rows="3" placeholder="Nhập mô tả"><?= $_POST["mota_banner"]??"" ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="trangthai_banner">Trạng thái banner</label>
                                <span class="error"><?= $trangthaiErr??"" ?></span>
                                <select class="form-control" id="trangthai_banner" name="trangthai_banner">

                                    <?php
                                        if(isset($_POST["trangthai_banner"])){
                                            if($_POST["trangthai_banner"] == 1){
                                                $select1 = "selected";
                                            }

                                            if($_POST["trangthai_banner"] == 2){
                                                $select2 = "selected";
                                            }
                                        }
                                    ?>

                                    <option value="1" <?= $select1??"" ?> >Bật</option>
                                    <option value="2" <?= $select2??"" ?> >Tắt</option>
                                </select>
                            </div>


                            <?= $message??"" ?>
                            <button type="submit" value="addbn" name="addbn" class="btn btn-primary mb-3">Thêm banner</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->
