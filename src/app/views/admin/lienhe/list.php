<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Danh sách người muốn nhận thông báo</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">QLLH</li>
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
                                <input type='checkbox' value='{$temp['id_lh']}' class='check-box'>
                              </td>
                              <td>{$temp['email_lh']}</td>
                              <td>";
                                
                            if($_SESSION["admin"]["id_cv"] == 1){
                              echo "<div class='btn-group custom-btns' role='group' aria-label='Basic example'>
                              <button type='button' onclick='message(`lh`,{$temp['id_lh']})' class='btn btn-danger mr-2'>Xóa</button>
                            </div>";
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
                        if($_SESSION["admin"]["id_cv"] == 1){
                          echo "
                              <div class='btn-group' role='group' aria-label='Manage Items'>
                          <button type='button' class='btn btn-primary mr-2' id='chonTatCa' onclick='chonTatCa()'>Chọn Tất Cả</button>
                          <button type='button' class='btn btn-warning mr-2' id='boChonTatCa' onclick='boTatCa()'>Bỏ Chọn Tất Cả</button>
                          <button type='button' class='btn btn-danger mr-2' onclick='xoaDaChon(`lh`)'>Xóa Các Mục Đã Chọn</button>
                        </div>
                          ";
                        }
                      ?>

        </div>
      </div>
    </div>
  </section>
</div>
