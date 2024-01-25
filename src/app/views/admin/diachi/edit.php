<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chỉnh sửa thông tin địa chỉ</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">ĐC</li>
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
                        <form action="index.php?act=dc&type=edit&id=<?=$list["id_shop"]?>" method="POST" enctype="multipart/form-data">
                        
                            <div class="form-group">
                                <label for="anhNhanVien">Logo</label>
                                <span class="error"><?= $anhErr??"" ?></span>
                                <input type="file" class="form-control-file" id="anhNhanVien" name="anh_shop" onchange="hienThiAnh()">
                                <img alt="" src="../../../public/image/anhsanpham/<?= $list["anh_shop"] ?>" class="mt-3" id="anhHienThi" width="20%">
                            </div>

                            <div class="form-group">
                                <label for="sdt_shop">Số điện thoại</label>
                                <span class="error"><?= $sdtErr??"" ?></span>
                                <input type="text" class="form-control" id="sdt_shop" name="sdt_shop" placeholder="Nhập số điện thoại" value="<?php if(isset($_POST["sdt_shop"])){echo $_POST["sdt_shop"];}else{echo $list["sdt_shop"];} ?>">
                            </div>
                                    
                            <div class="form-group">
                                <label for="email_shop">Email</label>
                                <span class="error"><?= $emailErr??"" ?></span>
                                <input type="text"class="form-control" id="email_shop" name="email_shop" placeholder="Nhập email" value="<?php if(isset($_POST["email_shop"])){echo $_POST["email_shop"];}else{echo $list["email_shop"];} ?>">
                            </div>

                            <div class="form-group">
                                <label for="diachi_shop">Địa chỉ</label>
                                <span class="error"><?= $diachiErr??"" ?></span>
                                <textarea class="form-control" id="diachi_shop" name="diachi_shop" rows="3" placeholder="Nhập địa chỉ"><?php if(isset($_POST["diachi_shop"])){echo $_POST["diachi_shop"];}else{echo $list["diachi_shop"];} ?></textarea>
                            </div>

                            <?= $message??"" ?>
                            <button type="submit" class="btn btn-primary mb-3" value="shop" name="shop">Cập nhật thông tin</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

