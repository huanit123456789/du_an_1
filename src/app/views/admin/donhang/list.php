<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh sách đơn hàng</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">QLĐH</li>
                    </ol>
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
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Mã ĐH</th>
                                        <th>Người nhận</th>
                                        <th>Số điện thoại</th>
                                        <th>Giá tiền</th>
                                        <th>Địa chỉ</th>
                                        <th>Ngày đặt</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($list)) {
                                        foreach ($list as $temp) {

                                            switch ($temp["trangthai_dh"]) {
                                                case 1:
                                                    $trangthai_dh = "Chờ xử lý";
                                                    break;
                                                case 2:
                                                    $trangthai_dh = "Đồng ý";
                                                    break;
                                                case 3:
                                                    $trangthai_dh = "Chờ giao hàng";
                                                    break;
                                                case 4:
                                                    $trangthai_dh = "Đang giao hàng";
                                                    break;
                                                case 5:
                                                    $trangthai_dh = "Đã nhận hàng";
                                                    break;
                                                case 6:
                                                    $trangthai_dh = "Hủy";
                                                    break;
                                            }

                                            $ngaydat_dh = date('d/m/Y', strtotime($temp['ngaydat_dh']));

                                            echo "
                                                <tr>
                                                    <td style='width:8%'>{$temp['id_dh']}</td>
                                                    <td>{$temp['nguoinhan_dh']}</td>
                                                    <td>{$temp['sdt_dh']}</td>
                                                    <td>". number_format($temp['giakm_dh'], 0, "," , "."    ) ."</td>
                                                    <td>{$temp['diachi_dh']}</td>
                                                    <td>" . $ngaydat_dh . "</td>
                                                    <td><b>{$trangthai_dh}</b></td>
                                                    
                                                    <td>";

                                                        if($temp['trangthai_dh'] != 5 && $temp['trangthai_dh'] != 6 &&  $temp['trangthai_dh'] != 4){
                                                            echo "<a href='index.php?act=dh&type=edit&id={$temp['id_dh']}' class='btn btn-primary mr-2'>Cập nhật</a>";
                                                        }

                                                        echo "<a href='index.php?act=dh&type=detail&id={$temp['id_dh']}' class='btn btn-secondary mr-2'>Chi tiết</a>";

                                                        if ($temp["trangthai_dh"] == 6 && $_SESSION["admin"]["id_cv"] == 1) {
                                                            echo "<button onclick='message(`dh`,{$temp['id_dh']})' class='btn btn-danger'>Xóa</button>";
                                                        }

                                                    echo "</td>
                                                </tr>
                                            ";
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
    </section>
</div>