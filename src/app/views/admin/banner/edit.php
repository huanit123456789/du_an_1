<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chỉnh sửa banner</h1>
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
                        <form action="index.php?act=bn&type=edit&id=<?= $list["id_banner"] ?>" method="POST" enctype="multipart/form-data">
                    
                            <div class="form-group">
                                <label for="anhNhanVien">Ảnh banner</label>
                                <span class="error"><?= $anhErr??"" ?></span>
                                <input type="file" class="form-control-file" id="anhNhanVien" name="anh_banner" onchange="hienThiAnh()">
                                <img alt="" src="../../../public/image/anhsanpham/<?= $list["anh_banner"] ?>" class="mt-3" id="anhHienThi" width="20%">
                            </div>
                                    
                            <div class="form-group">
                                <label for="link_banner">Link banner</label>
                                <span class="error"><?= $linkErr??"" ?></span>
                                <input type="text" class="form-control" id="link_banner" name="link_banner" placeholder="Nhập đường dẫn" value="<?php if(isset($_POST["link_banner"])){echo $_POST["link_banner"];}else{echo $list["link_banner"];}  ?>">
                            </div>

                            <div class="form-group">
                                <label for="mota_banner">Mô tả</label>
                                <span class="error"><?= $motaErr??"" ?></span>
                                <textarea class="form-control" id="mota_banner" name="mota_banner" rows="3" placeholder="Nhập mô tả"><?php if(isset($_POST["mota_banner"])){echo $_POST["mota_banner"];}else{echo $list["mota_banner"];}  ?></textarea>
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
                                        }else{
                                            if($list["trangthai_banner"] == 1){
                                                $select1 = "selected";
                                            }

                                            if($list["trangthai_banner"] == 2){
                                                $select2 = "selected";
                                            }
                                        }
                                    ?>

                                    <option value="1" <?= $select1??"" ?> >Bật</option>
                                    <option value="2" <?= $select2??"" ?> >Tắt</option>
                                </select>
                            </div>


                            <?= $message??"" ?>
                            <button type="submit" value="updatebn" name="updatebn" class="btn btn-primary mb-3">Cập nhật banner</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->
