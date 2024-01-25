<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Thông tin địa chỉ</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">ĐC</li>
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
                    <th>Logo</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Địa chỉ</th>
                    <th>Hành động</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                    if(!empty($list)){
                      foreach($list as $temp){
                        echo "
                          <tr>
                            <td style='width:20%'><img src='../../../public/image/anhsanpham/{$temp['anh_shop']}' class='img-fluid'></td>
                            <td>{$temp['sdt_shop']}</td>
                            <td>{$temp['email_shop']}</td>
                            <td>{$temp['diachi_shop']}</td>
                            <td>
                              <div class='btn-group custom-btns' role='group' aria-label='Basic example'>
                                <a type='button' href='index.php?act=dc&type=edit&id={$temp['id_shop']}' class='btn btn-success mr-2'>Sửa</a>
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
        </div>
      </div>
    </div>
  </section>
</div>
