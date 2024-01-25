<!-- ẢNH BANNER PHẦN GIỎ HÀNG -->
<section class="breadcrumb-section set-bg" data-setbg="./public/assets/dist/img/ppp.png">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Nelly Shop</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Trang chủ</a>
                        <span>Giỏ hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- BẮT ĐẦU GIỎ HÀNG -->
<section class="shoping-cart spad">
    <div class="container" id="order">

        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Ảnh</th>
                                        <th>Tên</th>
                                        <th>Size</th>
                                        <th>Số lượng</th>
                                        <th>Giá</th>
                                        <th>Tổng tiền</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    // Hiển thị sản phẩm trong giỏ hàng
                                    if (!empty($list_gh_bt)) {
                                        foreach ($_SESSION["cart"] as $key => $temp) {
                                            foreach ($list_gh_bt as $sp) {

                                                if (isset($temp["id_bt"]) && isset($sp["id_bt"]) && $temp["id_bt"] == $sp["id_bt"]) {
                                                    echo "
                    <tr>
                        <td>" . $key + 1 . "</td>
                        <td style='width: 25%'><img src='./public/image/anhsanpham/{$sp['anh_sp']}'></td>
                        <td>{$sp['ten_sp']}</td>
                        <td>{$sp['size_bt']}</td>
                        <td>
                            <input id='idbt{$sp['id_bt']}' type='number' min='1' max='{$sp['soluong_bt']}' oninput='capnhatcart({$sp['id_bt']},{$key})' value='{$temp['soluong']}'>
                        </td>
                        <td>" . number_format($sp["gia_sp"], 0, ",", ".") . "</td>
                        <td>" . number_format($sp["gia_sp"] * $temp["soluong"], 0, ",", ".") . "</td>
                        <td>
                            <button onclick='xoaGH({$sp['id_bt']})' class='btn btn-danger'>Xóa</button>
                        </td>
                    </tr>
                ";
                                                }
                                            }
                                        }
                                    }
                                    ?>



                                </tbody>
                            </table>
                            <?php
                            if (!empty($list_gh_bt)) {
                                echo "
                                        <a href='index.php?act=ql&type=tt' class='btn btn-primary'>Đặt hàng</a>
                                    ";
                            }

                            ?>

                        </div>
                    </div>
                </div>
        </section>
    </div>
</section>
<!-- KẾT THÚC GIỎ HÀNG -->


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    // ham cap nhat session gio hang khi thay doi so luong
    function capnhatcart(id_bt, key) {
        var input = document.getElementById(`idbt${id_bt}`);

        if (parseInt(input.value) <= 0) {
            input.value = 1;
        }

        if (parseInt(input.value) > parseInt(input.max)) {
            input.value = 1;
            alert("Hết hàng");
        }


        // gui yeeu cau bang ajax de cap nhat SESSION cart
        $.ajax({
            type: "POST",
            url: "./app/models/client/updateCart.php",
            data: {
                id_bt: id_bt,
                soluong: input.value
            },

            success: function(response) {
                // sau khi cap nhat thi ke thua 
                $.post("app/views/client/quanly/order.php", function(data) {
                    $("#order").html(data);
                })
            },

            error: function(error) {
                console.log(error);
            }
        });
    }

    function xoaGH(id_bt) {
        if (confirm("Bạn có muốn xóa không")) {
            $.ajax({
                type: "POST",
                url: "./app/models/client/removeCart.php",
                data: {
                    id_bt: id_bt,
                },

                success: function(response) {
                    // sau khi cap nhat thi ke thua 
                    $.post("app/views/client/quanly/order.php", function(data) {
                        $("#order").html(data);
                    })

                    document.getElementById("count").innerText = response;
                },

                error: function(error) {
                    console.log(error);
                }
            });
        }
    }
</script>