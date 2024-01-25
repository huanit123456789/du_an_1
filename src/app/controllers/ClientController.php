<?php

function taikhoan()
{
    if (isset($_GET["type"]) && !empty($_GET["type"])) {

        switch ($_GET["type"]) {
            case "dn":

                if (empty($_SESSION["khachhang"])) {
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        if (isset($_POST["dn"]) && !empty($_POST["dn"])) {
                            $check = true;

                            // tk
                            if ($_POST["email_nd"] == 0) {
                            } elseif (empty($_POST["email_nd"])) {
                                $emailErr =  " * Email không được bỏ trống";
                                $check = false;
                            } elseif (!filter_var($_POST["email_nd"], FILTER_VALIDATE_EMAIL)) {
                                $emailErr = " * Email không đúng định dạng";
                                $check = false;
                            }

                            // mk
                            if (empty($_POST["mk_nd"])) {
                                $mkErr =  " * Mật khẩu không được bỏ trống";
                                $check = false;
                            }

                            if ($check) {
                                $temp = dangnhap($_POST["email_nd"], $_POST["mk_nd"]);
                                if ($temp == false) {
                                    $message = '<div class="alert alert-danger" role="alert">
                                                    <strong>Đăng nhập không thành công!</strong>
                                                </div>';
                                } else {
                                    // xoa session admin neu co
                                    unset($_SESSION["admin"]);

                                    $_SESSION["khachhang"] = $temp["id_nd"];
                                    $_SESSION["cart"] = array();
                                    if(!empty($_POST["id"])){
                                        header("Location: index.php?act=spct&id=" . $_POST["id"]);
                                    }else{
                                        header("Location: index.php");
                                    }
                                }
                            }
                        }
                    }

                    require_once __DIR__ . "./../views/client/taikhoan/dangnhap.php";
                }

                break;

            case "dk":

                if (empty($_SESSION["khachhang"])) {
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        if (isset($_POST["dk"]) && !empty($_POST["dk"])) {
                            require_once __DIR__ . "./../models/admin/khachhang.php";

                            $check = true;

                            $tenErr = validation_name($_POST["ten_nd"]);
                            if (!empty($tenErr)) $check = false;

                            // anh
                            if ($_FILES["anh_nd"]["size"] == 0) {
                                $anhErr = " * Không được bỏ trống ảnh";
                                $check = false;
                            } else {
                                $anhErr = validation_img($_FILES["anh_nd"]);
                                if (!empty($anhErr)) $check = false;
                            }

                            // ngay sinh
                            $dateErr = validation_date_birthday($_POST["ngaysinh_nd"]);
                            if (!empty($dateErr)) $check = false;

                            // email
                            $emailErr = validation_email($_POST["email_nd"]);
                            if (!empty($emailErr)) $check = false;

                            // pass
                            $passErr = validation_pass($_POST["mk_nd"]);
                            if (!empty($passErr)) $check = false;

                            if ($check) {
                                $tmp = __DIR__ . "./../../public/image/anhnguoidung/";
                                $anh_nd = time() . $_FILES["anh_nd"]["name"];

                                if (move_uploaded_file($_FILES["anh_nd"]["tmp_name"], $tmp . $anh_nd)) {
                                    add_kh(trim($_POST["ten_nd"]), $anh_nd, "", $_POST["ngaysinh_nd"], "", $_POST["email_nd"], $_POST["mk_nd"]);
                                    $message = '<div class="alert alert-success" role="alert">
                                            <strong>Đăng ký thành công thành công!</strong>
                                        </div>';
                                    unset($_POST["ten_nd"], $anh_nd, $_POST["email_nd"], $_POST["mk_nd"]);
                                    header("Location: index.php?act=tk&type=dn");
                                } else {
                                    $message = '<div class="alert alert-danger" role="alert">
                                            <strong>Thêm ảnh không thành công!</strong>
                                        </div>';
                                }
                            }
                        }
                    }
                    require_once __DIR__ . "./../views/client/taikhoan/dangky.php";
                }


                break;

            case "prf":

                if (!empty($_SESSION["khachhang"])) {
                    require_once __DIR__ . "./../models/admin/khachhang.php";
                    $list = list_kh($_SESSION["khachhang"]);
                    require_once __DIR__ . "./../views/client/taikhoan/profile.php";
                }

                break;
            case "edit":

                if (!empty($_SESSION["khachhang"])) {
                    require_once __DIR__ . "./../models/admin/khachhang.php";

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        //  update khach hang
                        if (isset($_POST["updatepr"]) && !empty($_POST["updatepr"])) {
                            $list = list_kh($_SESSION["khachhang"]);
                            $check = true;

                            // ten
                            $tenErr = validation_name($_POST["ten_nd"]);
                            if (!empty($tenErr)) $check = false;

                            // anh
                            if ($_FILES["anh_nd"]["size"] !== 0) {
                                // co anh
                                $bool = true;
                                $anhErr = validation_img($_FILES["anh_nd"]);
                                if (!empty($anhErr)) $check = false;
                            } else {
                                // k co anh
                                $bool = false;
                            }

                            // mat khau
                            $passErr = validation_pass($_POST["mk_nd"]);
                            if (!empty($passErr)) $check = false;

                            // ngay sinh
                            $dateErr = validation_date_birthday($_POST["ngaysinh_nd"]);
                            if (!empty($dateErr)) $check = false;

                            // sdt
                            $phoneErr = validation_phone_update($_POST["sdt_nd"], $_SESSION["khachhang"]);
                            if (!empty($phoneErr)) $check = false;

                            // dia chi
                            $adressErr = validation_adress($_POST["diachi_nd"]);
                            if (!empty($adressErr)) $check = false;

                            if ($check) {
                                // co anh
                                if ($bool) {
                                    $tmp = __DIR__ . "./../../public/image/anhnguoidung/";
                                    $anh_nd = time() . $_FILES["anh_nd"]["name"];

                                    if (move_uploaded_file($_FILES["anh_nd"]["tmp_name"], $tmp . $anh_nd)) {
                                        update_kh($_SESSION["khachhang"], trim($_POST["ten_nd"]), $anh_nd, trim($_POST["sdt_nd"]), $_POST["ngaysinh_nd"], trim($_POST["diachi_nd"]), $_POST["mk_nd"]);
                                        $message = '<div class="alert alert-success" role="alert">
                                                    <strong>Cập nhật thành công!</strong>
                                                </div>';
                                        delete_img($list["anh_nd"], "anhnguoidung");
                                    } else {
                                        $message = '<div class="alert alert-danger" role="alert">
                                                    <strong>Cập nhật ảnh không thành công!</strong>
                                                </div>';
                                    }
                                } else {
                                    // k co anh
                                    $anh_nd = $list["anh_nd"];
                                    update_kh($_SESSION["khachhang"], $_POST["ten_nd"], $anh_nd, $_POST["sdt_nd"], $_POST["ngaysinh_nd"], $_POST["diachi_nd"], $_POST["mk_nd"]);
                                    $message = '<div class="alert alert-success" role="alert">
                                                <strong>Cập nhật thành công!</strong>
                                            </div>';
                                }
                                unset($_POST["ten_nd"], $anh_nd, $_POST["sdt_nd"], $_POST["ngaysinh_nd"], $_POST["diachi_nd"], $_POST["mk_nd"]);
                            }
                        }
                    }

                    $list = list_kh($_SESSION["khachhang"]);
                    require_once __DIR__ . "./../views/client/taikhoan/edit.php";
                }

                break;
        }
    } else {
        $list_bn = list_banner();
        $list_nb = list_nb();
        $list_km = list_km();
        $list_new = list_new();
        require_once __DIR__ . "./../views/client/trangchu/trangchu.php";
    }
}

function quanly()
{
    if (!empty($_SESSION["khachhang"])) {
        if (isset($_GET["type"]) && !empty($_GET["type"])) {
            switch ($_GET["type"]) {
                case "dh":
                    $list_dh = list_dh($_SESSION["khachhang"], "");
                    require_once __DIR__ . "./../views/client/quanly/dh.php";
                    break;
                case "dhct":
                        $donhang = ttdonhang($_GET["id"]);
                        $list = list_dh($_SESSION["khachhang"], $_GET["id"]);
                        require_once __DIR__ . "./../views/client/quanly/dhct.php";
                    break;
                case "xn":
                    xacnhan($_GET["id"]);
                    header("Location: index.php?act=ql&type=dh");
                    break;
                case "huy":
                    huy($_GET["id"]);
                    // CAP NHAT LAI SO LUONG SAN PHAM
                    $sql = "CALL capnhatsoluong(" . $_GET["id"] . ")";
                    pdo_exe($sql);

                    header("Location: index.php?act=ql&type=dh");
                    break;
                case "gh":

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


                    require_once __DIR__ . "./../views/client/quanly/gh.php";
                    break;
                case "tt":
                    
                    if(!empty($_SESSION["cart"])){
                        require_once __DIR__ . "./../models/admin/khachhang.php";

                        $list_gh_bt = list_gh_bt(implode(",", array_column($_SESSION["cart"], "id_bt")));
                        $list = list_kh($_SESSION["khachhang"]);
                        $list_km = list_km();
                        require_once __DIR__ . "./../views/client/quanly/tt.php";
                    }

                    break;
                case "add":

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        if (isset($_POST["add"]) && !empty($_POST["add"])) {
                            $list_gh_bt = list_gh_bt(implode(",", array_column($_SESSION["cart"], "id_bt")));
                            $idBill = addOrder($_SESSION["khachhang"], $_POST["nguoinhan_dh"], $_POST["sdt_dh"], $_POST["diachi_dh"], $_POST["ghichu_dh"], $_POST["giagoc_dh"], $_POST["giakm_dh"], $_POST["km_dh"]);
                            foreach ($list_gh_bt as $key => $item) {
                                addOrderDetail($idBill["id_dh"], $item['id_bt'], $_SESSION["cart"][$key]["soluong"], $item["gia_sp"]);

                                // cap nhat so luong, cap nhat trang thai 3 khi them don hang vao bang
                                // cap nhat trang thai 2 khi truy cap trang web
                                // cap nhat trang thai 1 khi update danh muc == TRIGGER
                                // cap snhat so luong san pham con lai trong shop
                                // cap nhat trang thai 3 san pham o day
                                // Neu admin nhan vien huy thi so luong se duoc hoan lai, con trangthai3_sp thi chua biet duoc
                            }

                            $sql = "CALL capnhatsoluong(" . $idBill["id_dh"] . ")";
                            pdo_exe($sql);

                            $sql = "CALL capnhattrangthai3(" . $idBill["id_dh"] . ")";
                            pdo_exe($sql);

                            unset($_SESSION['cart']);
                            unset($list_gh_bt);
                            $_SESSION["cart"] = array();

                            header("Location: index.php?act=ql&type=dhct&id=". $idBill['id_dh']);
                        }
                    }

                    break;
            }
        } else {
            $list_bn = list_banner();
            $list_nb = list_nb();
            $list_km = list_km();
            $list_new = list_new();
            require_once __DIR__ . "./../views/client/trangchu/trangchu.php";
        }
    }
}


if (isset($_GET["act"]) && !empty($_GET["act"])) {
    switch ($_GET["act"]) {
        case "spdm":
            $danhmuc = list_dm($_GET["id"]);
            $list_spdm = list_spdm($_GET["id"], $_GET["type"] ?? "");
            require_once __DIR__ . "./../views/client/sanphamdanhmuc/sanphamdanhmuc.php";
            break;
        case "spct":
            $spct = sanphamchitiet($_GET["id"]);
            $ha = hinhanh($_GET["id"]);
            $bt = bienthe($_GET["id"]);
            $list_bl = list_bl($_GET["id"]);
            $spcl = sanphamcungloai($_GET["id"]);
            capnhatluotxem($_GET["id"]);
            $sum_bt = sum_bt($_GET["id"]);
            require_once __DIR__ . "./../views/client/sanphamchitiet/sanphamchitiet.php";
            break;
        case "search":
            $timkiem = timkiem($_POST["tukhoa"] ?? $_GET["tukhoa"], $_GET["type"] ?? "");
            require_once __DIR__ . "./../views/client/timkiem/timkiem.php";
            break;
        case "tk":
            taikhoan();
            break;
        case "ql":
            quanly();
            break;
        case "all":
            $all_sp = all_sp($_GET["type"]??"");
            require_once __DIR__ . "./../views/client/allsanpham/allsanpham.php";
            break;
        case "dx":
            session_destroy();
            header("Location: index.php");
            break;
    }
} else {
    $list_bn = list_banner();
    $list_nb = list_nb();
    $list_km = list_km();
    $list_new = list_new();
    require_once __DIR__ . "./../views/client/trangchu/trangchu.php";
}
