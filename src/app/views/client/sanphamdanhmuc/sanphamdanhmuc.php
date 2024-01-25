<!-- BANNER ANH DANH MUC -->
<section class="breadcrumb-section set-bg" data-setbg="./public/assets/dist/img/ppp.png">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Nelly Shop</h2>
                    <div class="breadcrumb__option">
                        <a href="index.php">Trang chủ</a>
                        <span>Danh mục</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="product spad">
    <div class="container">
        <div class="row">
            <!-- ======================================= LIST DANH MUC ==============================================-->
            <?php require_once __DIR__ . "./danhmuc.php"; ?>

            <!--===================================== TEN DANH MUC HIEN TAI ===========================================-->
            <div class="col-lg-9 col-md-7">
                <div class="product__discount">
                    <div class="section-title product__discount__title">
                        <h2><?= $danhmuc["ten_dm"] ?></h2>
                    </div>
                    <p><b>Số lượng sản phẩm:</b> <?= count($list_spdm) ?></p>

                    <!-- LOC THEO TIEU CHI CUA SAN PHAM THEO DANH MUC -->
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown d-flex">
                                <a class="nav-link dropdown-toggle mr-3" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <b>Lọc theo giá</b>
                                </a>
                                <span class="ml-auto m-auto"><?php if (!empty($_GET["type"])) {
                                                                    if ($_GET["type"] == 1) {
                                                                        echo "Giá từ cao đến thấp";
                                                                    } else {
                                                                        echo "Giá từ thấp đến cao";
                                                                    }
                                                                } ?></span>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="index.php?act=spdm&id=<?= $danhmuc["id_dm"] ?>">Mặc định</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="index.php?act=spdm&id=<?= $danhmuc["id_dm"] ?>&type=1">Giá từ cao đến thấp</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="index.php?act=spdm&id=<?= $danhmuc["id_dm"] ?>&type=2">Giá từ thấp lên cao</a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>




                <!-- SAN PHAM THEO DANH MUC -->
                <div class="row">
                    <?php
                    if (!empty($list_spdm)) {
                        foreach ($list_spdm as $temp) {
                            echo "
                                <div class='col-lg-4 col-md-6 col-sm-6'>
                                    <div class='product__item'>
                                        <div class='product__item__pic set-bg'
                                            data-setbg='./public/image/anhsanpham/{$temp['anh_sp']}'>
                                            <ul class='product__item__pic__hover'>
                                                <li><a href='index.php?act=spct&id={$temp['id_sp']}'><i class='fa fa-shopping-cart'></i></a></li>
                                            </ul>
                                        </div>
                                        <div class='product__item__text'>
                                            <h6><a href='index.php?act=spct&id={$temp['id_sp']}'>{$temp['ten_sp']}</a></h6>
                                            <h5>" . number_format($temp["gia_sp"], 0, ",", ".") . " VND</h5>
                                        </div>
                                    </div>
                                </div>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>