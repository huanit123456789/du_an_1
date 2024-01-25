<div class="content-wrapper">

  <!-- <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Chi tiết đơn hàng</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">QLĐH</li>
          </ol>
        </div>
      </div>
    </div>
  </section> -->

  <style>
    .invoice-header {
      background-color: #f8f9fa;
      padding: 20px;
    }

    .invoice-body {
      padding: 20px;
    }
  </style>
  </head>

  <body>

    <div class="container mt-3">
      <div class="card">
        <div class="card-header bg-dark text-white">
          <h3 class="mb-0">HÓA ĐƠN ĐẶT HÀNG</h3>
        </div>
        <div class="card-body">
          <div class="row mb-4">
            <div class="col-md-6">
              <h2 class="mb-0">Thông tin khách hàng</h2>
              <br>
              <p class="mb-1"><strong>Họ và tên:</strong> <?= $donhang["nguoinhan_dh"] ?></p>
              <p class="mb-1"><strong>Địa chỉ:</strong> <?= $donhang["diachi_dh"] ?></p>
              <p class="mb-1"><strong>Số điện thoại:</strong> <?= $donhang["sdt_dh"] ?></p>
              <p class="mb-1"><strong>Ghi chú:</strong> <?= $donhang["ghichu_dh"] ?></p>
            </div>
            <div class="col-md-6 text-right">
              <br><br>
              <p class="mb-1"><strong>Ngày đặt hàng:</strong> <?= date('d/m/Y', strtotime($donhang["ngaydat_dh"])) ?></p>
              <p class="mb-1"><strong>Mã đơn hàng:</strong> <?= $donhang["id_dh"] ?></p>
            </div>


          </div>
          <br>
          <h2 class="mb-0">Thông tin đơn hàng</h2>

          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Sản phẩm</th>
                <th scope="col">Ảnh</th>
                <th scope="col">Size</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Đơn giá</th>
                <th scope="col">Thành tiền</th>
              </tr>
            </thead>
            <tbody>

              <?php
              if (!empty($list)) {
                $i = 1;
                foreach ($list as $temp) {
                  echo "
                                <tr>
                                    <td>{$i}</td>
                                    <td>{$temp['ten_sp']}</td>
                                    <td style='width:100px; height:100px'><img src='../../../public/image/anhsanpham/{$temp['anh_sp']}' class='img-fluid'></td>
                                    <td>{$temp['size_bt']}</td>
                                    <td>{$temp['soluong_dhct']}</td>
                                    <td>" . number_format($temp['gia_bt'], 0, ",", ".") . "</td>
                                    <td>" . number_format($temp['gia_dhct'], 0, ",", ".") . "</td>
                                </tr>  
                            ";
                  $i++;
                }
              }


              switch ($donhang["trangthai_dh"]) {
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
              ?>
            </tbody>
          </table>
          <hr>
          <div class="row">
            <div class="col-md-6">
              <p><strong>Tổng tiền:</strong> <?= number_format($donhang["giagoc_dh"], "0", ",", ".") ?> VND</p>
              <p><strong>Khuyến mãi:</strong> <?= number_format($donhang["km_dh"], "0", ",", ".") ?> %</p>
              <p><strong>Tổng tiền phải trả:</strong> <?= number_format($donhang["giakm_dh"], "0", ",", ".") ?> VND</p>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <b>Trạng thái <button class='btn btn-danger'><?= $trangthai_dh ?></button></b>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>


<!-- <section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Stt</th>
                  <th>Sản phẩm</th>
                  <th>Ảnh</th>
                  <th>Size</th>
                  <th>Số lượng</th>
                  <th>Giá</th>
                </tr>
              </thead>
              <tbody>

                <?php
                if (!empty($list)) {
                  $i = 1;
                  foreach ($list as $temp) {
                    echo "
                                <tr>
                                    <td>{$i}</td>
                                    <td>{$temp['ten_sp']}</td>
                                    <td style='width:100px; height:100px'><img src='../../../public/image/anhsanpham/{$temp['anh_sp']}' class='img-fluid'></td>
                                    <td>{$temp['size_bt']}</td>
                                    <td>{$temp['soluong_dhct']}</td>
                                    <td>" . number_format($temp['gia_dhct'], 0, ",", ".") . "</td>
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
  </div>
</section> -->