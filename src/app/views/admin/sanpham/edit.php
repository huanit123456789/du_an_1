<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sửa sản phẩm</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">DataTables</li>
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
                        <form action="index.php?act=sp&type=edit&id=<?= $listsp["id_sp"] ?>" method="POST" enctype="multipart/form-data">
                            
                            <div class="form-group">
                                <label for="">Danh mục</label>
                                <span class="error"><?= $dmErr??"" ?></span>
                                <select class='form-control' id='id_dm' name='id_dm'>
                                    <?php
                                        foreach($listdm as $temp){

                                            if(isset($_POST["id_dm"])){
                                                if($_POST["id_dm"] == $temp["id_dm"]){
                                                    $select = "selected";
                                                }else{
                                                    $select = "";
                                                }
                                            }else{
                                                if($listsp["id_dm"] == $temp["id_dm"]){
                                                    $select = "selected";
                                                }else{
                                                    $select = "";
                                                }
                                            }

                                            echo "<option value='{$temp['id_dm']}'";
                                            
                                            echo $select??"";

                                            echo ">{$temp['ten_dm']}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        
                            <div class="form-group">
                                <label for="ten_sp">Tên sản phẩm</label>
                                <span class="error"><?= $tenErr??"" ?></span>
                                <input type="text" class="form-control" id="ten_sp" name="ten_sp" placeholder="Nhập tên sản phẩm" value="<?php if(isset($_POST["ten_sp"])){echo $_POST["ten_sp"];}else{echo $listsp["ten_sp"];} ?>">
                            </div>

                            <div class="form-group">
                                <label for="anhNhanVien">Ảnh</label>
                                <span class="error"><?= $anhErr??"" ?></span>
                                <input type="file" class="form-control-file" id="anhNhanVien" name="anh_sp" onchange="hienThiAnh()">
                                <img alt="" src="../../../public/image/anhsanpham/<?= $listsp["anh_sp"] ?>" class="mt-3" id="anhHienThi" width="20%">
                            </div>
                                    
                            <div class="form-group">
                                <label for="gia_sp">Giá</label>
                                <span class="error"><?= $giaErr??"" ?></span>
                                <input type="number" min=0 class="form-control" id="gia_sp" name="gia_sp" placeholder="Nhập giá sản phẩm" value="<?php if(isset($_POST["gia_sp"])){echo $_POST["gia_sp"];}else{echo $listsp["gia_sp"];} ?>">
                            </div>

                            <div class="form-group">
                                <label for="mota_sp">Mô tả</label>
                                <span class="error"><?= $motaErr??"" ?></span>
                                <textarea class="form-control" id="mota_sp" name="mota_sp" rows="3" placeholder="Nhập mô tả sản phẩm"><?php if(isset($_POST["mota_sp"])){echo $_POST["mota_sp"];}else{echo $listsp["mota_sp"];} ?></textarea>
                            </div>

                            <?= $message??"" ?>
                            <button type="submit" class="btn btn-primary mb-3" name="updatesp" value="updatesp">Cập nhật sản phẩm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

