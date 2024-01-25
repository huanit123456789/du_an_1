<?php
session_start();

require_once __DIR__ . "./../../../models/pdo.php";
require_once __DIR__ . "./../../../models/client/client.php";




if (!empty($_SESSION["cart"])) {
    $id_bt = array_column($_SESSION["cart"], "id_bt");
    $list_gh_bt = list_gh_bt(implode(",", $id_bt));

    // Mảng để chứa các sản phẩm cần xóa
    $productsToRemove = array();

    // Xóa bỏ sản phẩm trong giỏ hàng nếu nó hết hàng
    // Cập nhật lại số lượng của sản phẩm
    foreach ($_SESSION["cart"] as $key => $temp) {
        foreach ($list_gh_bt as $sp) {
            if (isset($temp["id_bt"]) && isset($sp["id_bt"]) && $temp["id_bt"] == $sp["id_bt"]) {
                // Kiểm tra số lượng tồn kho
                if ($sp["soluong_bt"] == 0) {
                    $productsToRemove[] = $key;
                }

                // Cập nhật số lượng giỏ hàng nếu nó lớn hơn số lượng tồn kho
                if ($temp["soluong"] > $sp["soluong_bt"]) {
                    $_SESSION["cart"][$key]["soluong"] = $sp["soluong_bt"];
                }
            }
        }
        // Nếu sản phẩm đã được xóa, hãy xóa nó khỏi list_gh_bt để tránh trùng lặp
        if (!empty($productRemoved)) {
            unset($list_gh_bt[array_search($temp["id_bt"], array_column($list_gh_bt, "id_bt"))]);
        }
    }

    // Xóa các sản phẩm cần xóa khỏi giỏ hàng
    foreach ($productsToRemove as $key) {
        unset($_SESSION["cart"][$key]);
    }
}
?>
<!-- // Hiển thị sản phẩm trong giỏ hàng -->
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