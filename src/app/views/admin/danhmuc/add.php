<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thêm danh mục</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">QLDM</li>
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
                        <form action="index.php?act=dm&type=add" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="ten_dm">Tên danh mục</label>
                                <span class="error"><?= $tenErr??"" ?></span>
                                <input type="text" class="form-control" id="ten_dm" name="ten_dm" placeholder="Nhập tên danh mục" value="<?= $_POST["ten_dm"]??"" ?>">
                            </div>

                            <div class="form-group">
                                <label for="anhNhanVien">Ảnh</label>
                                <span class="error"><?= $anhErr??"" ?></span>
                                <input type="file" class="form-control-file" id="anhNhanVien" name="anh_dm" onchange="hienThiAnh()">
                                <img alt="" class="mt-3" id="anhHienThi" width="20%">
                            </div>

                            <div class="form-group">
                                <label for="trangthai_dm">Trạng thái danh mục</label>
                                <span class="error"><?= $selectErr??"" ?></span>
                                <select class="form-control" id="trangthai_dm" name="trangthai_dm">

                                    <?php
                                        if(isset($_POST["trangthai_dm"])){
                                            if($_POST["trangthai_dm"] == 1){
                                                $select1 = "selected";
                                            }

                                            if($_POST["trangthai_dm"] == 2){
                                                $select2 = "selected";
                                            }
                                        }
                                    ?>

                                    <option value="1" <?= $select1??"" ?> >Kinh doanh</option>
                                    <option value="2" <?= $select2??"" ?> >Ngừng kinh doanh</option>
                                </select>
                            </div>
                            
                            <?= $message??"" ?>
                            <button type="submit" name="adddm" value="adddm" class="btn btn-primary mb-3">Thêm danh mục</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
