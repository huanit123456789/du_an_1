<section class="ftco-section mt-5">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-10 mb-5 text-center">
                <ul class="product-category d-flex justify-content-center nav">
                    <li><a href='index.php?act=all' class='nav-link btn btn-primary'>All</a></li>


                    <?php
                    if (!empty($list_dm)) {
                        foreach ($list_dm as $temp) {
                            echo "
                                    <li><a href='index.php?act=spdm&id={$temp['id_dm']}' class='nav-link'>{$temp['ten_dm']}</a></li>
                                ";
                        }
                    }
                    ?>

                </ul>
            </div>
        </div>



        <div class="row">

            <div class="col-lg-9 col-md-7">
                <div class="product__discount">
                    

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
                                    <a class="dropdown-item" href="index.php?act=all">Mặc định</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="index.php?act=all&type=1">Giá từ cao đến thấp</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="index.php?act=all&type=2">Giá từ thấp lên cao</a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>


            <?php
            if (!empty($all_sp)) {
                foreach ($all_sp as $temp) {
                    echo "
                            <div class='col-lg-4 col-md-6 col-sm-6'>
                                <div class='product__item'>
                                    <div class='product__item__pic set-bg' data-setbg='./public/image/anhsanpham/{$temp['anh_sp']}'>
                                        <ul class='product__item__pic__hover'>
                                            <li><a href='index.php?act=spct&id={$temp['id_sp']}'><i class='fa fa-shopping-cart'></i></a></li>
                                        </ul>
                                    </div>
                                    <div class='product__item__text'>
                                        <h6><a href='index.php?act=spct&id={$temp['id_sp']}'>{$temp['ten_sp']}</a></h6>
                                        <h5>" . number_format($temp["gia_sp"], 0, ",", ".") . " VND</h5>
                                    </div>
                                </div>
                            </div>
                        ";
                }
            }
            ?>

        </div>
    </div>
</section>