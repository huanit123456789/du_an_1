<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Danh sách tài khoản người dùng</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">QLTK-KH</li>
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
                      <th></th>
                      <th>Tên</th>
                      <th>Số điện thoại</th>
                      <th>Địa chỉ</th>
                      <th>Email</th>
                      <th>Hành động</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                      if(!empty($list)){
                        foreach($list as $temp){
                          echo "
                            <tr>
                              <td style='width:5%; text-align: center;'>
                                <input type='checkbox' value='{$temp['id_nd']}' class='check-box'>
                              </td>
                              <td><a href='index.php?act=kh&type=detail&id={$temp['id_nd']}'>{$temp['ten_nd']}</a></td>
                              <td>{$temp['sdt_nd']}</td>
                              <td>{$temp['diachi_nd']}</td>
                              <td>{$temp['email_nd']}</td>
                              <td>
                                <div class='btn-group custom-btns' role='group' aria-label='Basic example'>
                                  <a type='button' href='index.php?act=kh&type=edit&id={$temp['id_nd']}' class='btn btn-success mr-2'>Sửa</a>
                                  <button type='button' onclick='message(`kh`,{$temp['id_nd']})' class='btn btn-danger mr-2'>Xóa</button>
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
            <button type="button" class="btn btn-danger mr-2" onclick="xoaDaChon(`kh`)">Xóa Các Mục Đã Chọn</button>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
