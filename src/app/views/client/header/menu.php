<!-- Page Preloder -->
<!-- <div id="preloder">
        <div class="loader"></div>
    </div> -->

<!-- Humberger Begin -->
<div class="humberger__menu__overlay"></div>

<!--=======================EMAIL + DANG NHAP + MENU MOBILE + GIO HANG ============================== -->
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a href="index.php"><img src="./public/image/anhsanpham/<?= $shop["anh_shop"] ?>" alt=""></a>
    </div>
    <div class="humberger__menu__cart">
        <ul>
            
            <?php
                if(!empty($_SESSION["khachhang"])){
                    echo "<li><a href='index.php?act=ql&type=gh'><i class='fa fa-shopping-bag'></i> <span>" . (!empty($_SESSION["cart"]) ? count($_SESSION["cart"]) : 0) . "</span></a></li>";
                }
            ?>
        </ul>
    </div>
    <div class="humberger__menu__widget">
    <div class="header__top__right__auth mr-3">
                            <?php
                                if(!empty($_SESSION["khachhang"])){
                                    echo "
                                    <nav class='main-header navbar navbar-expand navbar-white navbar-light'>
                                    <ul class='navbar-nav ml-auto'>
                                    <li class='nav-item dropdown'>
                                        <a href='#' class='nav-link dropdown-toggle' id='accountDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                            Account
                                        </a>
                                        <div class='dropdown-menu' aria-labelledby='accountDropdown'>
                                            <a class='dropdown-item' href='index.php?act=tk&type=prf'>Tài khoản</a>
                                            <div class='dropdown-divider'></div>
                                            <a class='dropdown-item' href='index.php?act=ql&type=gh'>Giỏ hàng</a>
                                            <div class='dropdown-divider'></div>
                                            <a class='dropdown-item' href='index.php?act=ql&type=dh'>Quản lý đơn hàng</a>
                                            <div class='dropdown-divider'></div>
                                            <a class='dropdown-item' href='index.php?act=dx'>Đăng xuất</a>
                                        </div>
                                    </li>
                                </ul>
                                </nav>
                                    ";
                                }elseif(!empty($_SESSION["admin"])){
                                    echo "
                                    <nav class='main-header navbar navbar-expand navbar-white navbar-light'>
                                    <ul class='navbar-nav ml-auto'>
                                    <li class='nav-item dropdown'>
                                        <a href='#' class='nav-link dropdown-toggle' id='accountDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                            Account
                                        </a>
                                        <div class='dropdown-menu' aria-labelledby='accountDropdown'>
                                            <a class='dropdown-item' href='./app/views/admin/index.php'>Admin</a>
                                            <div class='dropdown-divider'></div>
                                            <a class='dropdown-item' href='index.php?act=dx'>Đăng xuất</a>
                                        </div>
                                    </li>
                                </ul>
                                </nav>
                                    ";
                                }else{
                                    echo "<a href='index.php?act=tk&type=dn'><i class='fa fa-user'></i> Login</a>";
                                }
                            ?>
                        </div>
    </div>
    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <li class="active"><a href="index.php">Trang chủ</a></li>
            <li class="active"><a href="index.php?act=all">Sản phẩm</a></li>
            <li class="active"><a href="">Tin tức</a></li>
            <li class="active"><a href="">Về chúng tôi</a></li>
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="header__top__right__social">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-linkedin"></i></a>
        <a href="#"><i class="fa fa-pinterest-p"></i></a>
    </div>
    <div class="humberger__menu__contact">
        <ul>
            <li><i class="fa fa-envelope"></i><?= $shop["email_shop"] ?></li>
        </ul>
    </div>
</div>
<!-- Humberger End -->

<!--=======================EMAIL + DANG NHAP + MENU LATOP + GIO HANG ============================== -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i><?= $shop["email_shop"] ?></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-pinterest-p"></i></a>
                        </div>
                        <div class="header__top__right__auth mr-3">
                            <?php
                                if(!empty($_SESSION["khachhang"])){
                                    echo "
                                    <nav class='main-header navbar navbar-expand navbar-white navbar-light'>
                                    <ul class='navbar-nav ml-auto'>
                                    <li class='nav-item dropdown'>
                                        <a href='#' class='nav-link dropdown-toggle' id='accountDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                            Account
                                        </a>
                                        <div class='dropdown-menu' aria-labelledby='accountDropdown'>
                                            <a class='dropdown-item' href='index.php?act=tk&type=prf'>Tài khoản</a>
                                            <div class='dropdown-divider'></div>
                                            <a class='dropdown-item' href='index.php?act=ql&type=gh'>Giỏ hàng</a>
                                            <div class='dropdown-divider'></div>
                                            <a class='dropdown-item' href='index.php?act=ql&type=dh'>Quản lý đơn hàng</a>
                                            <div class='dropdown-divider'></div>
                                            <a class='dropdown-item' href='index.php?act=dx'>Đăng xuất</a>
                                        </div>
                                    </li>
                                </ul>
                                </nav>
                                    ";
                                }elseif(!empty($_SESSION["admin"])){
                                    echo "
                                    <nav class='main-header navbar navbar-expand navbar-white navbar-light'>
                                    <ul class='navbar-nav ml-auto'>
                                    <li class='nav-item dropdown'>
                                        <a href='#' class='nav-link dropdown-toggle' id='accountDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                            Account
                                        </a>
                                        <div class='dropdown-menu' aria-labelledby='accountDropdown'>
                                            <a class='dropdown-item' href='./app/views/admin/index.php'>Admin</a>
                                            <div class='dropdown-divider'></div>
                                            <a class='dropdown-item' href='index.php?act=dx'>Đăng xuất</a>
                                        </div>
                                    </li>
                                </ul>
                                </nav>
                                    ";
                                }else{
                                    echo "<a href='index.php?act=tk&type=dn'><i class='fa fa-user'></i> Login</a>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="index.php"><img src="./public/image/anhsanpham/<?= $shop["anh_shop"] ?>" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li class="active"><a href="index.php">Trang chủ</a></li>
                        <li class="active"><a href="index.php?act=all">Sản phẩm</a></li>
                        <li class="active"><a href="">Tin tức</a></li>
                        <li class="active"><a href="">Về chúng tôi</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__cart">
                    <ul>
                        <?php
                            if(!empty($_SESSION["khachhang"])){
                                echo "<li><a href='index.php?act=ql&type=gh'><i class='fa fa-shopping-bag'></i> <span id='count'>" . (!empty($_SESSION["cart"]) ? count($_SESSION["cart"]) : 0) . "</span></a></li>";
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>

<!-- ===================== DANH MUC + SEARCH + SDT ============================== -->
<section class="hero hero-normal">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>Danh mục</span>
                    </div>
                    <ul class="nav">
                        <li><a href='index.php?act=all'>All</a></li>
                        <?php
                            if(!empty($list_dm)){
                                foreach($list_dm as $temp){
                                    echo "
                                        <li><a href='index.php?act=spdm&id={$temp['id_dm']}'>{$temp['ten_dm']}</a></li>        
                                    ";
                                }
                            }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="index.php?act=search" method="POST">
                            <input type="text" name="tukhoa" placeholder="Bạn cần tìm sản phẩm..">
                            <button type="submit" name="timkiem" value="timkiem" class="site-btn">Tìm kiếm</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5><?= $shop["sdt_shop"] ?></h5>
                            <span>Hỗ trợ 24/7</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- =========================================================== -->