<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thêm sản phẩm</h1>
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
                        <?php
                            if(!empty($listdm)){
                                echo "
                                    <form action='' method='POST' enctype='multipart/form-data'>
                            
                                        <div class='form-group'>
                                            <label for='id_dm'>Danh mục</label>
                                            <span class='error'>";

                                            echo $dmErr??"";

                                            echo "</span>
                                            <select class='form-control' id='id_dm' name='id_dm'>";

                                            foreach($listdm as $temp){

                                                if($_POST["id_dm"] == $temp["id_dm"]){
                                                    $select = "selected";
                                                }else{
                                                    $select = "";
                                                }

                                                echo "<option value='{$temp['id_dm']}'";
                                                
                                                echo $select??"";

                                                echo ">{$temp['ten_dm']}</option>";
                                            }

                                            echo "
                                            </select>
                                        </div>
                            
                                        <div class='form-group'>
                                            <label for='ten_sp'>Tên sản phẩm</label>
                                            <span class='error'>";

                                            echo $tenErr??"";

                                            echo "
                                            </span>
                                            <input type='text' class='form-control' id='ten_sp' name='ten_sp' placeholder='Nhập tên sản phẩm' value='";
                                            echo $_POST["ten_sp"]??"";
                                            echo "'>
                                        </div>
    
                                        <div class='form-group'>
                                            <label for='anhNhanVien'>Ảnh</label>
                                            <span class='error'>";

                                            echo $anhErr??"";
                                            
                                            echo "</span>
                                            <input type='file' class='form-control-file' id='anhNhanVien' name='anh_sp' onchange='hienThiAnh()'>
                                            <img alt='' class='mt-3' id='anhHienThi' width='20%'>
                                        </div>
                                        
                                        <div class='form-group'>
                                            <label for='gia_sp'>Giá</label>
                                            <span class='error'>";

                                            echo $giaErr??"";
                                            
                                            echo "</span>
                                            <input type='number' min=0 class='form-control' id='gia_sp' name='gia_sp' placeholder='Nhập giá sản phẩm' value='";
                                            echo $_POST["gia_sp"]??"";
                                            echo "'>
                                        </div>
    
                                        <div class='form-group'>
                                            <label for='mota_sp'>Mô tả</label>
                                            <span class='error'>";

                                            echo $motaErr??"";
                                            
                                            echo "</span>
                                            <textarea class='form-control' id='mota_sp' name='mota_sp' rows='3' placeholder='Nhập mô tả sản phẩm'>";
                                            
                                            echo $_POST["mota_sp"]??"";
                                            
                                            echo "</textarea>
                                        </div>";
    
                                        // <div class='form-group'>
                                        //     <div onclick='addBienThe()' class='btn btn-primary mb-2'>Thêm Size</div>
                                        //     <div class='error'>";

                                        //     echo $bientheErr??"";

                                        //     echo "</div>
                                        //     <div id='inputBienThe' class='mb-2'>
                                        //         <div class='input-group mb-2' id='bt1'>
                                        //             <span class='btn btn-danger mr-2'>X</span>
                                        //             <span class='input-group-text mr-2'>1</span>
                                        //             <input type='number' class='form-control mr-2' placeholder='Nhập Size' name='size_bt1'>
                                        //             <input type='number' min = 0 class='form-control ml-2' placeholder='Nhập Số Lượng' name='soluong_bt1'>
                                        //         </div>
                                        //     </div>
                                        // </div>";

                                        echo $message??"";
                                
                                        echo"<button type='submit' class='btn btn-primary mb-3 mt-3' value='addsp' name='addsp'>Thêm sản phẩm</button>
                                    </form>
                                ";
                            }else{
                                echo"<div class='alert alert-danger' role='alert'>
                                        <strong>Chưa có danh mục sản phẩm nào!</strong>
                                    </div>";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

