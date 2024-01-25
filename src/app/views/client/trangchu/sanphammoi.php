<!--============================ 6 SAN PHAM MOI ======================================= -->
<section class="categories mt-5">
    <div class="container">
        <div class='row'>

            <div class='col-lg-12'>
                <div class='section-title'>
                    <h2>Sản phẩm mới ra mắt</h2>
                </div>
            </div>

            <div class='categories__slider owl-carousel'>

                <?php
                if (!empty($list_new)) {
                    foreach ($list_new as $temp) {
                        echo "
                            <div class='col-lg-3 col-md-4 col-sm-6 mix'>
                                <div class='featured__item'>
                                    <div class='featured__item__pic set-bg' data-setbg='./public/image/anhsanpham/{$temp['anh_sp']}'>
                                        <ul class='featured__item__pic__hover'>
                                            <li><a href='index.php?act=spct&id={$temp['id_sp']}'><i class='fa fa-shopping-cart'></i></a></li>
                                        </ul>
                                    </div>
                                    <div class='featured__item__text'>
                                        <h6><a href='index.php?act=spct&id={$temp['id_sp']}'>" . $temp['ten_sp']  .  "</a></h6>
                                        <h5>". number_format($temp["gia_sp"],0,",",".") ." VND</h5>
                                    </div>
                                </div>
                            </div>
                        ";
                    }
                }
                ?>

            </div>
        </div>
    </div>
</section>