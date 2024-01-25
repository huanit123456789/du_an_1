<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Danh sách sản phẩm</h1>
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

      <form class="form-inline mb-2" action="index.php?act=sp&type=list" method="post">
        <div class="input-group">
          <select class="custom-select" name="dm_search">
            <option value="">Tất cả</option>

            <?php
            if (!empty($listdm)) {
              foreach ($listdm as $temp) {

                $selected = "";
                if (!empty($_POST["dm_search"])) {
                  if ($_POST["dm_search"] == $temp["id_dm"]) {
                    $selected = "selected";
                  }
                }

                echo "
                    <option value='{$temp['id_dm']}' {$selected}>{$temp['ten_dm']}</option>
                  ";
              }
            }
            ?>

          </select>
          <input type="text" class="form-control" placeholder="Search" value="<?= $_POST["sp_search"]??"" ?>" aria-label="Search" aria-describedby="button-addon2" name="sp_search">
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
                    <th>Stt</th>
                    <th>Tên</th>
                    <th>Ảnh</th>
                    <th>Danh mục</th>
                    <th>Giá</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  if (!empty($listsp)) {
                    $i = 1;
                    foreach ($listsp as $temp) {

                      if ($temp["trangthai1_sp"] == 1) {
                        $trangthai_sp = "Kinh doanh";
                      }

                      if ($temp["trangthai1_sp"] == 2) {
                        $trangthai_sp = "Ngưng kinh doanh";
                      }

                      foreach ($listdm as $dm) {
                        if ($dm["id_dm"] == $temp["id_dm"]) {
                          $ten_dm = $dm["ten_dm"];
                        }
                      }

                      echo "
                        <tr>
                          <td style='width:5%; text-align: center;'>{$i}</td>
                          <td style='width:25%'><a href='index.php?act=sp&type=detail&id={$temp['id_sp']}'>{$temp['ten_sp']}</a></td>
                          <td style='width:100px; height:100px'><img src='../../../public/image/anhsanpham/{$temp['anh_sp']}' class='img-fluid'></td>
                          <td>{$ten_dm}</td>
                          <td>" . number_format($temp['gia_sp'], 0, ",", ".") . "</td>
                          <td class='text-wrap'>{$trangthai_sp}</td>
                          <td>";

                      if ($_SESSION["admin"]["id_cv"] == 1) {
                        echo "
                          <div class='btn-group custom-btns' role='group' aria-label='Basic example'>
                            <a type='button' href='index.php?act=sp&type=edit&id={$temp['id_sp']}' class='btn btn-success mr-2'>Sửa</a>
                            <button type='button' onclick='message(`sp`,{$temp['id_sp']})' class='btn btn-danger mr-2'>Xóa</button>
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
            </div>
          </div>
          <!-- <div class="btn-group" role="group" aria-label="Manage Items">
            <button type="button" class="btn btn-primary mr-2" id="chonTatCa" onclick="chonTatCa()">Chọn Tất Cả</button>
            <button type="button" class="btn btn-warning mr-2" id="boChonTatCa" onclick="boTatCa()">Bỏ Chọn Tất Cả</button>
            <button type="button" class="btn btn-danger mr-2" onclick="xoaDaChon(`sp`)">Xóa Các Mục Đã Chọn</button>
          </div> -->
        </div>
      </div>
    </div>
  </section>
</div>