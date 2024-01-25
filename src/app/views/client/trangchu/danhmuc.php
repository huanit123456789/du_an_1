<!--=================================================== LIST DANH MUC =======================================================-->
<section class="categories">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>DANH MỤC</h2>
                </div>
            </div>

            <div class="categories__slider owl-carousel">

                <!-- FOREACH DANH MUC -->
                <?php
                    if(!empty($list_dm)){
                        foreach($list_dm as $temp){
                            echo "
                                <div class='col-lg-3'>
                                    <div class='categories__item set-bg' data-setbg='./public/image/anhsanpham/{$temp['anh_dm']}'>
                                        <h5><a href='index.php?act=spdm&id={$temp['id_dm']}'>{$temp['ten_dm']}</a></h5>
                                    </div>
                                </div>
                            ";
                        }
                    }
                ?>

                <!-- END FOREACH DANH MUC -->
            </div>


        </div>
    </div>
</section>