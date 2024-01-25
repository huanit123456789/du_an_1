<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Danh sách khuyến mãi theo sản phẩm</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">QLKM</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">

    <form class="form-inline mb-2" action="index.php?act=km&type=list" method="post">
        <div class="input-group">
          <select class="custom-select" name="trangthai_km">
            <option>Tất cả</option>
            <option <?php if (!empty($_POST["trangthai_km"])) {
                      echo $_POST["trangthai_km"] == 1 ? "selected" : "";
                    } ?> value="1">Hoạt động</option>
            <option <?php if (!empty($_POST["trangthai_km"])) {
                      echo $_POST["trangthai_km"] == 2 ? "selected" : "";
                    } ?> value="2">Ngưng hoạt động</option>
          </select>
          <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
          </div>
        </div>
      </form>


      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-body">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th></th>
                    <th>Mã KM</th>
                    <th>Khuyến mãi(%)</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày kết thúc</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                  </tr>
                </thead>
                <tbody>
                  
                  <?php
                    if(!empty($list)){
                      foreach($list as $temp){

                        if($temp["trangthai_km"] == 1){
                          $trangthai_km = "Hoạt động";
                        }

                        if($temp["trangthai_km"] == 2){
                          $trangthai_km = "Ngưng hoạt động";
                        }

                        echo "
                        <tr>
                        <td style='width:5%; text-align: center;'>
                          <input type='checkbox' value='{$temp['id_km']}' class='check-box'>
                        </td>
                        <td>{$temp['ma_km']}</td>
                        <td>{$temp['phantram_km']}</td>
                        <td>". date('d/m/Y', strtotime($temp['ngaybd_km'] )) ."</td>
                        <td>". date('d/m/Y', strtotime($temp['ngaykt_km'] )) ."</td>
                        <td>{$trangthai_km}</td>
                        <td>";

                        if($_SESSION["admin"]["id_cv"] == 1){
                          echo "
                            <div class='btn-group custom-btns' role='group' aria-label='Basic example'>
                              <a type='button' href='index.php?act=km&type=edit&id={$temp['id_km']}' class='btn btn-success mr-2'>Sửa</a>
                              <button type='button' onclick='message(`km`,{$temp['id_km']})' class='btn btn-danger mr-2'>Xóa</button>
                            </div>
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
          
        <?php
          if($_SESSION["admin"]["id_cv"]==1){
            echo "
              <div class='btn-group' role='group' aria-label='Manage Items'>
                <button type='button' class='btn btn-primary mr-2' id='chonTatCa' onclick='chonTatCa()'>Chọn Tất Cả</button>
                <button type='button' class='btn btn-warning mr-2' id='boChonTatCa' onclick='boTatCa()'>Bỏ Chọn Tất Cả</button>
                <button type='button' class='btn btn-danger mr-2' onclick='xoaDaChon(`km`)' >Xóa Các Mục Đã Chọn</button>
              </div>
            ";
          } 
        ?>

        </div>
      </div>
    </div>
  </section>
</div>
