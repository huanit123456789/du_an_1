<!-- ========================= 4 SAN PHAM CUNG LOAI KHAC============================== -->
<section class="related-product">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related__product__title">
                    <h2>SẢN PHẨM CÙNG LOẠI</h2>
                </div>
            </div>
        </div>

        <div class="row">

            
                <?php
                    if(!empty($spcl)){
                        foreach($spcl as $temp){
                            echo "
                            <div class='col-lg-3 col-md-4 col-sm-6'>
                                <div class='product__item'>
                                    <div class='product__item__pic set-bg' data-setbg='./public/image/anhsanpham/{$temp['anh_sp']}'>
                                        <ul class='product__item__pic__hover'>
                                            <li><a href='index.php?act=spct&id={$temp['id_sp']}'><i class='fa fa-shopping-cart'></i></a></li>
                                        </ul>
                                    </div>
                                    <div class='product__item__text'>
                                        <h6><a href='index.php?act=spct&id={$temp['id_sp']}'>{$temp['ten_sp']}</a></h6>
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
</section>