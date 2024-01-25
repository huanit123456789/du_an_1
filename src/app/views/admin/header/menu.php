<!-- body: bắt đầu thân trang -->

<body class="hold-transition sidebar-mini layout-fixed">

  <!-- container -->
  <div class="wrapper">

    <!-- LOAD ẢNH -->
    <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../../../public/assets/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->


    <!--Thanh menu trên -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
          <a href="index.php" class="nav-link">Home</a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
          <a href="../../../index.php" class="nav-link">Web</a>
        </li>

      </ul>

      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" id="accountDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Account
          </a>
          <div class="dropdown-menu" aria-labelledby="accountDropdown">
            <a class="dropdown-item" href="index.php?act=nv&type=listpr">Tài khoản</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="index.php?act=dx">Đăng xuất</a>
          </div>
        </li>
      </ul>
    </nav>

    <!-- Thanh menu bên trái -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->

      <a href="index.php?act=dc&type=list" class="brand-link">
        <img src="../../../public/image/anhsanpham/<?= $shop["anh_shop"] ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Nelly Shop</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">

        <!-- thong tin admin -->
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <!-- anh admin -->
          <div class="image">
            <img src="../../../public/image/anhnguoidung/<?= $admin["anh_nd"] ?>" alt="User Image">
          </div>
          <div class="info">
            <a href="index.php?act=nv&type=listpr" class="d-block"><?= $admin["ten_nd"] ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <!-- quản lý danh mục -->
            <li class="nav-header"></li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-list-alt"></i>
                <p>Quản lý danh mục
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="index.php?act=dm&type=list" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Danh sách danh mục</p>
                  </a>
                </li>
                <?php
                if ($_SESSION["admin"]["id_cv"] == 1) {
                  echo "<li class='nav-item'>
                          <a href='index.php?act=dm&type=add' class='nav-link'>
                            <i class='far fa-circle nav-icon'></i>
                            <p>Thêm danh mục</p>
                          </a>
                      </li>";
                }
                ?>
              </ul>
            </li>

            <!-- quản lý sản phẩm -->
            <li class="nav-header"></li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                  Quản lý sản phẩm
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="index.php?act=sp&type=list" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Danh sách sản phẩm</p>
                  </a>
                </li>

                <?php
                if ($_SESSION["admin"]["id_cv"] == 1) {
                  echo "
                    <li class='nav-item'>
                      <a href='index.php?act=sp&type=add' class='nav-link'>
                        <i class='far fa-circle nav-icon'></i>
                        <p>Thêm sản phẩm</p>
                      </a>
                    </li>
                  ";
                }
                ?>
              </ul>
            </li>

            <!-- quản lý tài khoản nhân viên -->
            <?php
            if ($_SESSION["admin"]["id_cv"] == 1) {
              echo "
                <li class='nav-header'></li>
                <li class='nav-item'>
                  <a href='#' class='nav-link'>
                    <i class='nav-icon fa fa-user'></i>
                    <p>Tài khoản nhân viên
                      <i class='right fas fa-angle-left'></i>
                    </p>
                  </a>
                  <ul class='nav nav-treeview'>
                    <li class='nav-item'>
                      <a href='index.php?act=nv&type=list' class='nav-link'>
                        <i class='far fa-circle nav-icon'></i>
                        <p>Danh sách nhân viên</p>
                      </a>    
                    </li>
                    <li class='nav-item'>
                      <a href='index.php?act=nv&type=add' class='nav-link'>
                        <i class='far fa-circle nav-icon'></i>
                        <p>Thêm nhân viên</p>
                      </a>
                    </li>
                  </ul>
                </li>
              ";
            }
            ?>

            <!-- quản lý tài khoản khách hàng -->
            <li class='nav-header'></li>
            <li class='nav-item'>
              <a href='#' class='nav-link'>
                <i class='nav-icon far fa-id-card'></i>
                <p>Tài khoản khách hàng
                  <i class='right fas fa-angle-left'></i>
                </p>
              </a>
              <ul class='nav nav-treeview'>

                <?php
                if ($_SESSION["admin"]["id_cv"] == 1) {
                  echo "
                    <li class='nav-item'>
                    <a href='index.php?act=kh&type=list' class='nav-link'>
                      <i class='far fa-circle nav-icon'></i>
                      <p>Danh sách khách hàng</p>
                    </a>
                  </li>
                    ";
                }
                ?>

                <li class='nav-item'>
                  <a href='index.php?act=kh&type=add' class='nav-link'>
                    <i class='far fa-circle nav-icon'></i>
                    <p>Thêm khách hàng</p>
                  </a>
                </li>
              </ul>
            </li>

            <!-- quản lý khuyến mãi -->
            <li class="nav-header"></li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-bullhorn"></i>
                <p>
                  Quản lý khuyến mãi
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="index.php?act=km&type=list" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Danh sách khuyến mãi</p>
                  </a>
                </li>
                <?php
                if ($_SESSION["admin"]["id_cv"] == 1) {
                  echo "
                    <li class='nav-item'>
                      <a href='index.php?act=km&type=add' class='nav-link'>
                        <i class='far fa-circle nav-icon'></i>
                        <p>Thêm mã khuyến mãi</p>
                      </a>
                    </li>
                  ";
                }
                ?>
              </ul>
            </li>

            <!-- quản lý banner -->
            <li class="nav-header"></li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  Quản lý banner
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="index.php?act=bn&type=list" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Danh sách banner</p>
                  </a>
                </li>
                <?php
                if ($_SESSION["admin"]["id_cv"] == 1) {
                  echo "
                      <li class='nav-item'>
                        <a href='index.php?act=bn&type=add' class='nav-link'>
                          <i class='far fa-circle nav-icon'></i>
                          <p>Thêm banner</p>
                        </a>
                      </li>
                    ";
                }
                ?>
              </ul>
            </li>

            <!-- quản lý địa chỉ -->
            <?php
            if ($_SESSION["admin"]["id_cv"] == 1) {
              echo "
                <li class='nav-header'></li>
                <li class='nav-item'>
                  <a href='#' class='nav-link'>
                    <i class='nav-icon fas fa-map-marker-alt'></i>
                    <p>
                      Địa chỉ
                      <i class='fas fa-angle-left right'></i>
                    </p>
                  </a>
                  <ul class='nav nav-treeview'>
                    <li class='nav-item'>
                      <a href='index.php?act=dc&type=list' class='nav-link'>
                        <i class='far fa-circle nav-icon'></i>
                        <p>Thông tin</p>
                      </a>
                    </li>
                  </ul>
                </li>
              ";
            }
            ?>

            <!-- quản lý đơn hàng -->
            <li class="nav-header"></li>
            <li class="nav-item">
              <a href="index.php?act=dh&type=list" class="nav-link">
                <i class="nav-icon fas fa-cart-arrow-down"></i>
                <p>
                  Đơn hàng
                  <span class="badge badge-info right"><?php if (empty($donhang)) {
                                                          echo "0";
                                                        } else {
                                                          echo count($donhang);
                                                        } ?></span>
                </p>
              </a>
            </li>

            <!-- liên hệ -->
            <li class="nav-header"></li>
            <li class="nav-item">
              <a href="index.php?act=lh&type=list" class="nav-link">
                <i class="nav-icon fa fa-envelope"></i>
                <p>
                  Liên hệ
                  <span class="badge badge-info right"><?php if (empty($lienhe)) {
                                                          echo "0";
                                                        } else {
                                                          echo count($lienhe);
                                                        } ?></span>
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>