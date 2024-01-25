<!-- =============================BANNER CON PHAN THANH TOAN=================== -->
<section class="breadcrumb-section set-bg" data-setbg="./public/assets/dist/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Thanh toán</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home</a>
                        <span>Checkout</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- ====================================THANH TOAN============================= -->

<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <h4>Chi tiết thanh toán</h4>
            <form action="index.php?act=ql&type=add" method="POST">
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="checkout__input">
                            <p>Người nhận<span> *</span></p>
                            <input type="text" name='nguoinhan_dh' required value="<?= $list['ten_nd'] ?? "" ?>">
                        </div>
                        <div class="checkout__input">
                            <p>Địa chỉ<span> *</span></p>
                            <input type="text" name='diachi_dh' required value="<?= $list['diachi_nd'] ?? "" ?>">
                        </div>
                        <div class="checkout__input">
                            <p>Số điện thoại<span>*</span></p>
                            <input type="text" name='sdt_dh' required value="<?= $list['sdt_nd'] ?? "" ?>" class="checkout__input__add">
                        </div>
                        <div class="checkout__input">
                            <p>Mã KM (Nếu có) <span class="error" id="errorkm"></span></p>
                            <input type="text" name='km_dh' oninput="textkm(this)" class="checkout__input__add">
                        </div>
                        <div class="checkout__input">
                            <p>Ghi chú<span>*</span></p>
                            <textarea name="ghichu_dh" id="" cols="90" rows="10"></textarea>
                        </div>
                    </div>



                    <!-- ======================HOA DON CUA TOI================== -->
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4>Hóa đơn của bạn</h4>
                            <div class="checkout__order__products">Sản phẩm <span> <span>Giá tiền</span></div>
                            <ul>
                                <?php
                                $tongtien = 0;
                                foreach ($list_gh_bt as $key => $temp) {
                                    echo "<li>" . $temp['ten_sp'] . " <b> " . $temp['size_bt'] . "</b> <span>" . number_format($temp['gia_sp'], 0, ",", ".") . "</span></li>";
                                    echo "<small>SL: " . $_SESSION["cart"][$key]["soluong"]  . "</small>";

                                    $tongtien += $_SESSION["cart"][$key]["soluong"] * $temp["gia_sp"];
                                }
                                ?>
                            </ul>
                            <br>
                            <div class="checkout__order__total">Tổng tiền
                                <span>
                                    <div><?= number_format($tongtien, 0, ",", ".") ?></div>
                                    <input type="hidden" value="<?= $tongtien ?>" name="giagoc_dh">
                                </span>
                            </div>
                            <div class="checkout__order__total">Khuyến mãi
                                <span>
                                    <div id='km_dh_text'>0 %</div>
                                    <input type="hidden" value="0" id="km_dh_hidden" name="km_dh">
                                </span>
                            </div>

                            <div class="checkout__order__total">Tổng tiền phải trả
                                <span>
                                    <div id='giakm_dh_text'><?= number_format($tongtien, 0, ",", ".") ?></div>
                                    <input type="hidden" value="<?= $tongtien ?>" id="giakm_dh_hidden" name="giakm_dh">
                                </span>
                            </div>


                            <!-- <div class="checkout__input__checkbox">
                                <label for="payment">
                                    Thanh toán online
                                    <input type="checkbox" id="payment" disabled>
                                    <span class="checkmark"></span>
                                </label>
                            </div> -->
                            <div class="checkout__input__checkbox">
                                <label for="paypal">
                                    Thanh toán khi nhận hàng
                                    <input type="checkbox" id="paypal" checked disabled>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <button type="submit" name="add" value="add" class="site-btn">Thanh toán</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<script>

    // ============================== CHECK MA KHUYEN MAI ==============================================
    // Mảng chứa các mã khuyến mãi và phần trăm tương ứng
    var arraykm = [
        <?php
            if(!empty($list_km)){
                foreach($list_km as $temp){
                    echo "
                        {
                            ma: '{$temp['ma_km']}',
                            phanTram: {$temp['phantram_km']}
                        },  
                    ";
                }
            }
        ?>
    ];

    function textkm(input) {
        // Kiểm tra xem mã nhập liệu có trong mảng không
        var check = phantramkm(input.value);

        // Hiển thị phần trăm khuyến mãi
        // var hienThiPhanTramElement = document.getElementById("hienThiPhanTram");

        var VND = new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND'
        });

        if (check !== null) {
            document.getElementById("errorkm").innerText = ""
            document.getElementById("km_dh_text").innerText = `${check} %`;
            document.getElementById("km_dh_hidden").value = check;
            document.getElementById("giakm_dh_text").innerText = VND.format(<?php echo $tongtien ?> - (<?php echo $tongtien ?> * (check / 100)));
            document.getElementById("giakm_dh_hidden").value = <?php echo $tongtien ?> - (<?php echo $tongtien ?> * (check / 100));
        } else {
            document.getElementById("km_dh_text").innerText = `0 %`;
            document.getElementById("km_dh_hidden").value = 0;
            document.getElementById("errorkm").innerText = ` Mã khuyến mãi không tồn tại!`;
            document.getElementById("giakm_dh_text").innerText = VND.format(<?php echo $tongtien ?>);
            document.getElementById("giakm_dh_hidden").value = <?php echo $tongtien ?>;
        }
    }

    function phantramkm(ma_km) {
        // Tìm phần trăm tương ứng với mã khuyến mãi
        for (var i = 0; i < arraykm.length; i++) {
            if (arraykm[i].ma.toLowerCase() === ma_km.toLowerCase()) {
                return arraykm[i].phanTram;
            }
        }
        return null; // Trả về null nếu không tìm thấy mã khuyến mãi
    }

</script>