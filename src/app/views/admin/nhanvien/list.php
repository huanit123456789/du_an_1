<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Danh sách nhân viên</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">QLTK-NV</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">

      <form class="form-inline mb-2" action="index.php?act=nv&type=list" method="post">
        <div class="input-group">
          <select class="custom-select" name="id_cv">
            <option>Tất cả</option>
            <option <?php if (!empty($_POST["id_cv"])) {
                      echo $_POST["id_cv"] == 1 ? "selected" : "";
                    } ?> value="1">Admin</option>
            <option <?php if (!empty($_POST["id_cv"])) {
                      echo $_POST["id_cv"] == 2 ? "selected" : "";
                    } ?> value="2">Nhân viên</option>
          </select>
          <input type="text" class="form-control" placeholder="Search" value="<?= $_POST["ten_nd"] ?? "" ?>" aria-label="Search" aria-describedby="button-addon2" name="ten_nd">
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
                    <th>Tên</th>
                    <th>Số điện thoại</th>
                    <th>Chức vụ</th>
                    <th>Email</th>
                    <th>Mật khẩu</th>
                    <th>Hành động</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if (!empty($list)) {
                    foreach ($list as $temp) {
                      echo "
                        <tr>
                          <td style='width:5%; text-align: center;'>
                              <input type='checkbox' value='{$temp['id_nd']}' class='check-box'>
                          </td>
                          <td><a href='index.php?act=nv&type=detail&id={$temp['id_nd']}'>{$temp['ten_nd']}</a></td>
                          <td>{$temp['sdt_nd']}</td>
                          <td>{$temp['ten_cv']}</td>
                          <td>{$temp['email_nd']}</td>
                          <td>{$temp['mk_nd']}</td>
                          <td>
                            <div class='btn-group custom-btns' role='group' aria-label='Basic example'>
                              <a type='button' href='index.php?act=nv&type=edit&id={$temp['id_nd']}' class='btn btn-success mr-2'>Sửa</a>
                              <button type='button' onclick='message(`nv`,{$temp['id_nd']})' class='btn btn-danger mr-2'>Xóa</button>
                            </div>
                          </td>
                        </tr>
                      ";
                    }
                  }
                  ?>

                </tbody>
              </table>
            </div>
          </div>
          <div class="btn-group" role="group" aria-label="Manage Items">
            <button type="button" class="btn btn-primary mr-2" id="chonTatCa" onclick="chonTatCa()">Chọn Tất Cả</button>
            <button type="button" class="btn btn-warning mr-2" id="boChonTatCa" onclick="boTatCa()">Bỏ Chọn Tất Cả</button>
            <button type="button" class="btn btn-danger mr-2" onclick="xoaDaChon(`nv`)">Xóa Các Mục Đã Chọn</button>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>