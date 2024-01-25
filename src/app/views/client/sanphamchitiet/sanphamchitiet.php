<!-- =======================BANNER CON CUA SAN PHAM CHI TIET========================= -->
<section class="breadcrumb-section set-bg" data-setbg="./public/assets/dist/img/ppp.png">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Nelly Shop</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Trang chủ</a>
                        <span>Sản phẩm</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ==========================SAN PHAM CHI TIET========================================== -->
<section class="product-details">
    <div class="container">
        <div class="row">

            <!-- ẢNH HIỂN THỊ VÀ CÁC ẢNH CON -->
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large" src="./public/image/anhsanpham/<?= $spct['anh_sp'] ?>" alt="">
                    </div>

                    <!-- ================================= ANH CON CUA SAN PHAM CHINH ==========================-->
                    <div class="product__details__pic__slider owl-carousel">
                        <img data-imgbigurl='./public/image/anhsanpham/<?= $spct['anh_sp'] ?>' src='./public/image/anhsanpham/<?= $spct['anh_sp'] ?>'>
                        <?php
                        foreach ($ha as $temp) {
                            echo "
                                    <img data-imgbigurl='./public/image/anhsanpham/{$temp['anh_ha']}' src='./public/image/anhsanpham/{$temp['anh_ha']}'>
                                ";
                        }
                        ?>
                    </div>
                </div>
            </div>



            <!-- ================MÔ TẢ CỦA SẢN PHẨM=================== -->
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3>
                        <?= $spct["ten_sp"] ?>
                    </h3>
                    <div class="product__details__rating">
                        <!-- <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i> -->
                        <span><?= $spct["luotxem_sp"] ?> lượt quan tâm</span>
                    </div>

                    <div class="product__details__price">
                        <?php echo number_format($spct["gia_sp"],0,",",".")  ?> VND
                    </div>

                    <div class="product__details__size mt-4 mb-4">
                        <div class="container">

                            <?php
                                if ($spct["trangthai2_sp"] == 2) {

                                    echo "<button class='btn btn-danger' type='button'>Hết hàng</button>";

                                } else {

                                    $i = 0;

                                    echo "
                                        <form method='POST' action='index.php?act=ql&type=add'>
                                            <div class='form-group'>";

                                        // ===============================================================================
                                    foreach ($bt as $temp) {

                                        if ($temp['soluong_bt'] == 0) {
                                            $disabled = "dis";
                                        } else {
                                            $disabled = "";
                                        }

                                        echo "
                                            <label onclick='capnhat(this,{$temp['soluong_bt']},{$temp['id_bt']})' class='btn btn-outline-primary {$disabled}'>{$temp['size_bt']}</label>
                                            ";
                                    }
                                        //================================================================================

                                    echo "
                                        </div>
                                            <div class='form-group'>
                                                <div class='mb-3'><button type='button'>Còn lại: <span id='soluong_bt'>{$sum_bt['tong']}</span></button></div>
                                                <label><b>Số Lượng:</b></label>
                                                <input type='number' class='form-control' id='max' min='1' value='1' disabled>
                                                <button id='id_bt' style='display:none'>0</button>
                                            </div>";

                                    if (!empty($_SESSION["khachhang"])) {
                                        echo "<button type='button' data-id='{$spct['id_sp']}' onclick='addToCart()'  class='btn btn-primary'>Thêm vào giỏ hàng</button>";
                                    }else{
                                        echo "<div><a class='error' href='index.php?act=tk&type=dn&id={$spct['id_sp']}'>Đăng nhập để mua hàng</a></div>";
                                    }

                                    echo "</form>";
                                }
                            ?>

                        </div>
                    </div>

                    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
                    <script>
                        function addToCart(){

                            var input = document.getElementById("max");
                            var id_bt = document.getElementById("id_bt").innerText;

                            if(input.disabled == true){
                                alert("Vui lòng chọn size và số lượng phù hợp");
                            }else{
                                // Sử dụng jquery để sử dụng yêu cầu ajax
                                $.ajax({

                                    // ===========DAY LA SU DUNG POST SANG ADDTOCART.PHP
                                    type: 'POST',
                                    url: "./app/models/client/addToCart.php",
                                    data: {
                                        id_bt: id_bt,
                                        soluong: input.value
                                    },

                                    //  SU DUNG HAM NAY NEU THANH CONG   response la so ban gi co trong gio hang
                                    success: function(response){
                                        document.getElementById("count").innerText = response;
                                        // console.log(id_bt,input.value);
                                        alert("Đã thêm vào giỏ hàng");
                                    },

                                    // SU DUNG HAM NAY NEU LOI
                                    error: function(error){
                                        console.log(error);
                                    }

                                });
                            }

                        }
                    </script>

                    <!-- ======================QUANG CAO=============================== -->
                    <ul class="list-service ml-3">
                        <li><img class="dt-width-auto mb-3" src="//theme.hstatic.net/1000230642/1001036938/14/service_ic_2.png?v=4901" width="32" height="32">Bảo hành 06 tháng</li>
                        <li><img class="dt-width-auto mb-3" src="//theme.hstatic.net/1000230642/1001036938/14/service_ic_3.png?v=4901" width="32" height="32">Đổi size trong vòng 7 ngày</li>
                        <li><img class="dt-width-auto mb-3" src="//theme.hstatic.net/1000230642/1001036938/14/service_ic_4.png?v=4901" width="32" height="32">Đổi trả hàng trong vòng 7 ngày</li>
                        <li><img class="dt-width-auto mb-3" src="//theme.hstatic.net/1000230642/1001036938/14/service_ic_5.png?v=4901" width="32" height="32">Free ship đơn hàng 1.5 Triệu</li>
                        <li><img class="dt-width-auto mb-3" src="//theme.hstatic.net/1000230642/1001036938/14/service_ic_6.png?v=4901" width="32" height="32">Giao hàng 2h Grab khu vực Hà Nội</li>
                    </ul>

                </div>

            </div>

            <div class="container mt-5 mb-5">
                <b>Mô tả:</b>
                <p><?= $spct["mota_sp"] ?></p>
            </div>

        </div>
    </div>
</section>

<!-- ============================BINH LUAN==================================== -->
<?php require_once __DIR__ . "./binhluan.php"; ?>


<!-- ========================= 4 SAN PHAM CUNG LOAI KHAC============================== -->
<?php require_once __DIR__ . "./sanphamcungloai.php"; ?>