<div class="container mb-5 mt-5">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="font-size:2vw"><b>Đơn hàng</b></h1>
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
                                            <th>Mã đơn hàng</th>
                                            <th>Giá tiền</th>
                                            <th>Ngày đặt</th>
                                            <th>Trạng thái</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($list_dh)) {
                                            foreach ($list_dh as $temp) {

                                                $ngaydat_dh = date('d/m/Y', strtotime($temp['ngaydat_dh']));


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

                                                echo "
                                                <tr>
                                                    <td>{$temp['id_dh']}</td>  
                                                    <td>". number_format($temp["giakm_dh"],0,",",".") ."</td>
                                                    <td>{$ngaydat_dh}</td>
                                                    <td><b>{$trangthai_dh}</b></td>
                                                    <td>
                                                        <a href='index.php?act=ql&type=dhct&id={$temp['id_dh']}' class='btn btn-primary'>Chi tiết</a>";

                                                        if($temp["trangthai_dh"] == 4){
                                                            echo "
                                                                <a href='index.php?act=ql&type=xn&id={$temp['id_dh']}' class='btn btn-success'>Đã nhận được hàng</a>
                                                            ";
                                                        }

                                                        if($temp["trangthai_dh"] == 1){
                                                            echo "
                                                            <a href='index.php?act=ql&type=huy&id={$temp['id_dh']}' class='btn btn-danger'>Hủy</a>
                                                            ";
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
</div>