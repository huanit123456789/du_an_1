<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chi tiết sản phẩm</h1>
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

            <?php
                foreach($listdm as $temp){
                    if($listsp["id_dm"] == $temp["id_dm"]){
                        $ten_dm = $temp["ten_dm"];
                        break;
                    }
                }

                if($listsp["trangthai1_sp"] == 1){
                    $trangthai1_sp = "Kinh doanh";
                }

                if($listsp["trangthai1_sp"] == 2){
                    $trangthai1_sp = "Ngưng kinh doanh";
                }

                $soluong_bt = soluong_bt($listsp["id_sp"]);

            ?>

            <div class="container">
                <div class="col-12">

                    <div class="row">
                        <div class="col-md-4">
                            <div>
                                <div class="card-body">
                                    <div class="card-text">
                                        <img src="../../../public/image/anhsanpham/<?= $listsp["anh_sp"] ?>" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div>
                                <div class="card-body">
                                    <h5 class="card-title mb-1">
                                        <b>Tên sản phẩm</b>
                                    </h5>
                                    <p class="card-text"><?= $listsp["ten_sp"] ?></p>

                                    <h5 class="card-title mb-1">
                                        <b>Số lượng</b>
                                    </h5>
                                    <p class="card-text"><?= $soluong_bt ?></p>

                                    <h5 class="card-title mb-1">
                                        <b>Giá</b>
                                    </h5>
                                    <p class="card-text"><?= number_format($listsp["gia_sp"],0,",",".") ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div>
                                <div class="card-body">
                                    <h5 class="card-title mb-1">
                                        <b>Danh mục</b>
                                    </h5>
                                    <p class="card-text"><?= $ten_dm ?></p>

                                    <h5 class="card-title mb-1">
                                        <b>Trạng thái</b>
                                    </h5>
                                    <p class="card-text"><?= $trangthai1_sp ?></p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-12">
                        <button style="border:1px solid" class="btn btn-link" type="button" data-toggle="collapse"
                            data-target="#additionalInfo" aria-expanded="false" aria-controls="additionalInfo">Thông tin
                            mở rộng</button>
                    </div>

                    <div class="col-12">

                        <div class="collapse" id="additionalInfo">

                            <div class="card-body">
                                <div class="mb-5">
                                    <h5 class="card-title mb-1">
                                        <b>Mô tả</b>
                                    </h5>
                                    <p class="card-text"><?= $listsp["mota_sp"] ?></p>
                                </div>

                                <div class="mb-5">
                                    <h5 class="card-title mb-1">
                                        <b>Size</b>
                                    </h5>
                                    <div class="card-text">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>STT</th>
                                                    <th>Size</th>
                                                    <th>Số lượng</th>
                                                    <th>Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    if(!empty($listbt)){
                                                        $i = 1;
                                                        foreach($listbt as $temp){
                                                            echo "
                                                            <tr>
                                                                <td style='width:5%; text-align: center;'>{$i}</td>
                                                                <td style='width:30%'>{$temp['size_bt']}</td>
                                                                <td>{$temp['soluong_bt']}</td>
                                                                <td style='width:40%'>";
                                                                  
                                                            if($_SESSION["admin"]["id_cv"] == 1){
                                                                echo "
                                                                <div class='btn-group custom-btns' role='group' aria-label='Basic example'>
                                                                <a type='button' href='index.php?act=sp&type=editbt&idsp=" . $temp["id_sp"] . "&idbt=" . $temp["id_bt"] . "' class='btn btn-success mr-2'>Sửa</a>
                                                                <a type='button' href='index.php?act=sp&type=deletebt&idsp=" . $temp["id_sp"] . "&idbt=" . $temp["id_bt"]. "' class='btn btn-danger mr-2'>Xóa</a>
                                                            </div>
                                                                ";
                                                            }    

                                                            echo "</td>
                                                            </tr>
                                                            ";
                                                            $i++;
                                                        }
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                        <?php
                                            if($_SESSION["admin"]["id_cv"] == 1){
                                                echo "
                                                    <a type='button' href='index.php?act=sp&type=addbt&id=" . $listsp["id_sp"] ."' class='btn btn-success mr-2'>Thêm</a>
                                                ";
                                            }
                                        ?>
                                    </div>
                                </div>

                                <div class="mb-5">
                                    <h5 class="card-title mb-1">
                                        <b>Ảnh</b>
                                    </h5>
                                    <div class="card-text">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>STT</th>
                                                    <th>Ảnh</th>
                                                    <th>Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    if(!empty($hinhanh)){
                                                        $i = 1;
                                                        foreach($hinhanh as $temp){
                                                            echo "
                                                                <tr>
                                                                    <td style='width:5%; text-align: center;'>{$i}</td>
                                                                    <td><img style='width:30%' src='../../../public/image/anhsanpham/";
                                                                    
                                                                    echo $temp["anh_ha"];

                                                                    echo "' alt='' class='img-fluid'></td>";

                                                                    if($_SESSION["admin"]["id_cv"] == 1){
                                                                        echo "
                                                                            <td style='width:34.5%'>
                                                                                <div class='btn-group custom-btns' role='group' aria-label='Basic example'>
                                                                                    <a type='button' href='index.php?act=sp&type=editha&idsp=" . $listsp["id_sp"] . "&idha=" . $temp["id_ha"] ."' class='btn btn-success mr-2'>Sửa</a>
                                                                        </div>
                                                                    </td>
                                                                        ";
                                                                    }
                                                                    
                                                                echo "</tr>
                                                            ";
                                                            $i++;
                                                        }
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                        if($_SESSION["admin"]["id_cv"] == 1){
                            echo "
                                <div class='btn-group custom-btns ml-auto mb-5' role='group' aria-label='Basic example'>
                                    <a type='button' href='index.php?act=sp&type=edit&id=" .  $listsp["id_sp"] . "'class='btn btn-success mr-2' style='color:white'>Sửa</a>
                                </div>
                            ";
                        }
                    ?>

                </div>

                <!-- binh luan -->
                <div class="mb-5">
                        <h5 class="card-title mb-1">
                            <b>Bình luận</b>
                        </h5>
                        <div class="card-text">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Người dùng</th>
                                        <th>Nội dung</th>
                                        <th>Ngày bình luận</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(!empty($listbl)){
                                            $i = 1;
                                            foreach($listbl as $temp){
                                                echo "
                                                    <tr>
                                                        <td style='width:5%; text-align: center;'>{$i}</td>
                                                        <td style='width:30%'>{$temp['ten_nd']}</td>
                                                        <td>{$temp['noidung_bl']}</td>
                                                        <td>". date('d/m/Y', strtotime($temp["ngay_bl"] )) ."</td>
                                                    </tr>
                                                ";
                                                $i++;
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>


            </div>
        </div>
    </section>
</div>