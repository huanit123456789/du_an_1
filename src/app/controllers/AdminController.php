<?php

//controller cac chuc nang con 
function danhmuc()
{

    if (isset($_GET["type"]) && !empty($_GET["type"])) {

        require_once __DIR__ . "./../models/admin/danhmuc.php";

        switch ($_GET["type"]) {
            case "list":
                $list = list_dm_search($_POST["trangthai_dm"] ?? "", $_POST["ten_dm"] ?? "");
                require_once __DIR__ . "./../views/admin/danhmuc/list.php";
                break;
            case "add":
                if ($_SESSION["admin"]["id_cv"] == 1) {

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {

                        // add dm
                        if (isset($_POST["adddm"]) && !empty($_POST["adddm"])) {
                            $check = true;
                            // ten
                            $tenErr = validation_ten_dm($_POST["ten_dm"]);
                            if (!empty($tenErr)) $check = false;

                            // anh
                            if ($_FILES["anh_dm"]["size"] == 0) {
                                // do khi gui thi co anh hay k thi FILES van khoi tao 1 file chua anh
                                $check = false;
                                $anhErr = " * Ảnh không được bỏ trống";
                            } else {
                                $anhErr = validation_img($_FILES["anh_dm"]);
                                if (!empty($anhErr)) $check = false;
                            }

                            // select
                            $selectErr = validation_select($_POST["trangthai_dm"]);
                            if (!empty($selectErr)) $check = false;

                            if ($check) {
                                $tmp = __DIR__ . "./../../public/image/anhsanpham/";
                                $anh_dm = time() . $_FILES["anh_dm"]["name"];

                                if (move_uploaded_file($_FILES["anh_dm"]["tmp_name"], $tmp . $anh_dm)) {
                                    add_dm(trim($_POST["ten_dm"]), $anh_dm, $_POST["trangthai_dm"]);
                                    $message = '<div class="alert alert-success" role="alert">
                                                        <strong>Thêm thành công!</strong>
                                                    </div>';
                                    unset($_POST["ten_dm"], $anh_dm, $_POST["trangthai_dm"]);
                                } else {
                                    $message = '<div class="alert alert-danger" role="alert">
                                                        <strong>Thêm ảnh không thành công!</strong>
                                                    </div>';
                                }
                            }
                        }
                    }

                    require_once __DIR__ . "./../views/admin/danhmuc/add.php";
                }
                break;
            case "edit":
                if ($_SESSION["admin"]["id_cv"] == 1) {

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {

                        // update dm
                        if (isset($_POST["updatedm"]) && !empty($_POST["updatedm"])) {
                            $list = list_dm($_GET["id"]);
                            $check = true;
                            // ten
                            $tenErr = validation_ten_dm_update($_POST["ten_dm"], $list["id_dm"]);
                            if (!empty($tenErr)) $check = false;

                            // anh
                            if ($_FILES["anh_dm"]["size"] !== 0) {
                                // co anh
                                $bool = true;
                                $anhErr = validation_img($_FILES["anh_dm"]);
                                if (!empty($anhErr)) $check = false;
                            } else {
                                // k co anh
                                $bool = false;
                            }

                            // select
                            $selectErr = validation_select($_POST["trangthai_dm"]);
                            if (!empty($selectErr)) $check = false;

                            if ($check) {
                                // co anh
                                if ($bool) {
                                    $tmp = __DIR__ . "./../../public/image/anhsanpham/";
                                    $anh_dm = time() . $_FILES["anh_dm"]["name"];

                                    if (move_uploaded_file($_FILES["anh_dm"]["tmp_name"], $tmp . $anh_dm)) {
                                        update_dm($list["id_dm"], trim($_POST["ten_dm"]), $anh_dm, $_POST["trangthai_dm"]);
                                        $message = '<div class="alert alert-success" role="alert">
                                                        <strong>Cập nhật thành công!</strong>
                                                    </div>';
                                        delete_img($list["anh_dm"], "anhsanpham");
                                    } else {
                                        $message = '<div class="alert alert-danger" role="alert">
                                                            <strong>Cập nhật ảnh không thành công!</strong>
                                                        </div>';
                                    }
                                } else {
                                    // k co anh
                                    $anh_dm = $list["anh_dm"];
                                    update_dm($list["id_dm"], trim($_POST["ten_dm"]), $anh_dm, $_POST["trangthai_dm"]);
                                    $message = '<div class="alert alert-success" role="alert">
                                                        <strong>Cập nhật thành công!</strong>
                                                    </div>';
                                }
                                unset($_POST["ten_dm"], $anh_dm, $_POST["trangthai_dm"]);
                            }
                        }
                    }

                    $list = list_dm($_GET["id"]);
                    require_once __DIR__ . "./../views/admin/danhmuc/edit.php";
                }
                break;
            case "delete":
                if ($_SESSION["admin"]["id_cv"] == 1) {
                    require_once __DIR__ . "./../models/admin/sanpham.php";
                    require_once __DIR__ . "./../models/admin/bienthe.php";
                    $check = delete_dm($_GET["id"]);
                    if (!empty($check)) {
                        echo $check;
                    } else {
                        header("Location: index.php?act=dm&type=list");
                    }
                }
                break;
        }
    } else {
        require_once __DIR__ . "./../views/admin/trangchu/trangchu.php";
    }
}

function nhanvien()
{

    if (isset($_GET["type"]) && !empty($_GET["type"])) {

        require_once __DIR__ . "./../models/admin/nhanvien.php";

        switch ($_GET["type"]) {
            case "list":
                $list = list_nv_search($_POST["id_cv"] ?? "", $_POST["ten_nd"] ?? "");
                require_once __DIR__ . "./../views/admin/nhanvien/list.php";
                break;
            case "add":
                if ($_SESSION["admin"]["id_cv"] == 1) {

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {

                        // add nhan vien
                        if (isset($_POST["addnv"]) && !empty($_POST["addnv"])) {
                            $check = true;

                            // ten
                            $tenErr = validation_name($_POST["ten_nd"]);
                            if (!empty($tenErr)) $check = false;

                            // anh
                            if ($_FILES["anh_nd"]["size"] == 0) {
                                // do khi gui thi co anh hay k thi FILES van khoi tao 1 file chua anh
                                $check = false;
                                $anhErr = " * Ảnh không được bỏ trống";
                            } else {
                                $anhErr = validation_img($_FILES["anh_nd"]);
                                if (!empty($anhErr)) $check = false;
                            }

                            // email
                            $emailErr = validation_email($_POST["email_nd"]);
                            if (!empty($emailErr)) $check = false;

                            // mat khau
                            $passErr = validation_pass($_POST["mk_nd"]);
                            if (!empty($passErr)) $check = false;

                            // chuc vu
                            $selectErr = validation_select($_POST["id_cv"]);
                            if (!empty($selectErr)) $check = false;

                            // ngay sinh
                            $dateErr = validation_date_birthday($_POST["ngaysinh_nd"]);
                            if (!empty($dateErr)) $check = false;

                            // sdt
                            $phoneErr = validation_phone($_POST["sdt_nd"]);
                            if (!empty($phoneErr)) $check = false;

                            // dia chi
                            $adressErr = validation_adress($_POST["diachi_nd"]);
                            if (!empty($adressErr)) $check = false;

                            // NEU DUNG TAT CA
                            if ($check) {
                                $tmp = __DIR__ . "./../../public/image/anhnguoidung/";
                                $anh_nd = time() . $_FILES["anh_nd"]["name"];

                                if (move_uploaded_file($_FILES["anh_nd"]["tmp_name"], $tmp . $anh_nd)) {
                                    add_nv(trim($_POST["ten_nd"]), $anh_nd, trim(($_POST["sdt_nd"])), $_POST["ngaysinh_nd"], trim($_POST["diachi_nd"]), trim($_POST["email_nd"]), $_POST["mk_nd"], $_POST["id_cv"]);
                                    $message = '<div class="alert alert-success" role="alert">
                                                    <strong>Thêm thành công!</strong>
                                                </div>';
                                    unset($_POST["ten_nd"], $anh_nd, $_POST["sdt_nd"], $_POST["ngaysinh_nd"], $_POST["diachi_nd"], $_POST["email_nd"], $_POST["mk_nd"], $_POST["id_cv"]);
                                } else {
                                    $message = '<div class="alert alert-danger" role="alert">
                                                    <strong>Thêm ảnh không thành công!</strong>
                                                </div>';
                                }
                            }
                        }
                    }
                    require_once __DIR__ . "./../views/admin/nhanvien/add.php";
                }
                break;
            case "detail":
                if ($_SESSION["admin"]["id_cv"] == 1) {
                    $list = list_nv($_GET["id"]);
                    require_once __DIR__ . "./../views/admin/nhanvien/detail.php";
                }
                break;
            case "edit":
                if ($_SESSION["admin"]["id_cv"] == 1) {

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // update nhan vien
                        if (isset($_POST["updatenv"]) && !empty($_POST["updatenv"])) {
                            $list = list_nv($_GET["id"]);
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

                            // chuc vu
                            $selectErr = validation_select($_POST["id_cv"]);
                            $id_cv = $_POST["id_cv"];
                            if (!empty($selectErr)) $check = false;

                            // ngay sinh
                            $dateErr = validation_date_birthday($_POST["ngaysinh_nd"]);
                            if (!empty($dateErr)) $check = false;

                            // sdt
                            $phoneErr = validation_phone_update($_POST["sdt_nd"], $_GET["id"]);
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
                                        update_nv($_GET["id"], trim($_POST["ten_nd"]), $anh_nd, trim($_POST["sdt_nd"]), $_POST["ngaysinh_nd"], trim($_POST["diachi_nd"]), $_POST["mk_nd"], $id_cv);
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
                                    update_nv($_GET["id"], $_POST["ten_nd"], $anh_nd, $_POST["sdt_nd"], $_POST["ngaysinh_nd"], $_POST["diachi_nd"], $_POST["mk_nd"], $id_cv);
                                    $message = '<div class="alert alert-success" role="alert">
                                <strong>Cập nhật thành công!</strong>
                            </div>';
                                }
                                unset($_POST["ten_nd"], $anh_nd, $_POST["sdt_nd"], $_POST["ngaysinh_nd"], $_POST["diachi_nd"], $_POST["mk_nd"], $id_cv);
                            }
                        }
                    }

                    $list = list_nv($_GET["id"]);
                    require_once __DIR__ . "./../views/admin/nhanvien/edit.php";
                }
                break;
            case "listpr":
                $list = list_nv($_SESSION["admin"]["id_nd"]);
                require_once __DIR__ . "./../views/admin/taikhoan/profile.php";
                break;
            case "editpr":

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // update profile
                    if (isset($_POST["updatepr"]) && !empty($_POST["updatepr"])) {
                        $list = list_nv($_GET["id"]);
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
                        $phoneErr = validation_phone_update($_POST["sdt_nd"], $_GET["id"]);
                        if (!empty($phoneErr)) $check = false;

                        // dia chi
                        $adressErr = validation_adress($_POST["diachi_nd"]);
                        if (!empty($adressErr)) $check = false;

                        // var_dump($bool);

                        if ($check) {
                            // co anh
                            if ($bool) {
                                $tmp = __DIR__ . "./../../public/image/anhnguoidung/";
                                $anh_nd = time() . $_FILES["anh_nd"]["name"];

                                if (move_uploaded_file($_FILES["anh_nd"]["tmp_name"], $tmp . $anh_nd)) {
                                    update_nv($_GET["id"], trim($_POST["ten_nd"]), $anh_nd, trim($_POST["sdt_nd"]), $_POST["ngaysinh_nd"], trim($_POST["diachi_nd"]), $_POST["mk_nd"], $list["id_cv"]);
                                    $message = '<div class="alert alert-success" role="alert">
                                        <strong>Cập nhật thành công!</strong>
                                    </div>';
                                    delete_img($list["anh_nd"], "anhnguoidung");
                                    // var_dump($list["anh_nd"]);

                                } else {
                                    $message = '<div class="alert alert-danger" role="alert">
                                        <strong>Cập nhật ảnh không thành công!</strong>
                                    </div>';
                                }
                            } else {
                                // k co anh
                                $anh_nd = $list["anh_nd"];
                                // var_dump($list);
                                update_nv($_GET["id"], $_POST["ten_nd"], $anh_nd, $_POST["sdt_nd"], $_POST["ngaysinh_nd"], $_POST["diachi_nd"], $_POST["mk_nd"], $list["id_cv"]);
                                $message = '<div class="alert alert-success" role="alert">
                                    <strong>Cập nhật thành công!</strong>
                                </div>';
                            }
                            unset($_POST["ten_nd"], $anh_nd, $_POST["sdt_nd"], $_POST["ngaysinh_nd"], $_POST["diachi_nd"], $_POST["mk_nd"], $id_cv);
                        }
                    }
                }

                $list = list_nv($_GET["id"]);
                require_once __DIR__ . "./../views/admin/taikhoan/edit.php";
                break;
            case "delete":
                if ($_SESSION["admin"]["id_cv"] == 1) {
                    $check = delete_nv($_GET["id"]);
                    if (!empty($check)) {
                        echo $check;
                    } else {
                        header("Location: index.php?act=nv&type=list");
                    }
                }
                break;
            case "deleteSL":
                if ($_SESSION["admin"]["id_cv"] == 1) {
                    $check = delete_nv_sl(explode(",", $_GET["arr"]));
                    if (!empty($check)) {
                        echo $check;
                    } else {
                        header("Location: index.php?act=nv&type=list");
                    }
                }
                break;
        }
    } else {
        require_once __DIR__ . "./../trangchu/trangchu.php";
    }
}

function khachhang()
{

    if (isset($_GET["type"]) && !empty($_GET["type"])) {

        require_once __DIR__ . "./../models/admin/khachhang.php";

        switch ($_GET["type"]) {

            case "list":
                if ($_SESSION["admin"]["id_cv"] == 1) {
                    $list = list_kh("");
                    require_once __DIR__ . "./../views/admin/khachhang/list.php";
                }
                break;
            case "add":

                if ($_SESSION["admin"]["id_cv"] == 1 || $_SESSION["admin"]["id_cv"] == 2) {
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {

                        // add khach hang
                        if (isset($_POST["addkh"]) && !empty($_POST["addkh"])) {
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

                            // email
                            $emailErr = validation_email($_POST["email_nd"]);
                            if (!empty($emailErr)) $check = false;

                            // pass
                            $passErr = validation_pass($_POST["mk_nd"]);
                            if (!empty($passErr)) $check = false;

                            // ngaysinh
                            $dateErr = validation_date_birthday($_POST["ngaysinh_nd"]);
                            if (!empty($dateErr)) $check = false;

                            // sdt
                            $phoneErr = validation_phone($_POST["sdt_nd"]);
                            if (!empty($phoneErr)) $check = false;

                            // dia chi
                            $adressErr = validation_adress($_POST["diachi_nd"]);
                            if (!empty($adressErr)) $check = false;

                            if ($check) {
                                $tmp = __DIR__ . "./../../public/image/anhnguoidung/";
                                $anh_nd = time() . $_FILES["anh_nd"]["name"];

                                if (move_uploaded_file($_FILES["anh_nd"]["tmp_name"], $tmp . $anh_nd)) {
                                    add_kh(trim($_POST["ten_nd"]), $anh_nd, trim($_POST["sdt_nd"]), $_POST["ngaysinh_nd"], trim($_POST["diachi_nd"]), $_POST["email_nd"], $_POST["mk_nd"]);
                                    $message = '<div class="alert alert-success" role="alert">
                                                        <strong>Thêm thành công!</strong>
                                                    </div>';
                                    unset($_POST["ten_nd"], $anh_nd, $_POST["sdt_nd"], $_POST["ngaysinh_nd"], $_POST["diachi_nd"], $_POST["email_nd"], $_POST["mk_nd"]);
                                } else {
                                    $message = '<div class="alert alert-danger" role="alert">
                                                        <strong>Thêm ảnh không thành công!</strong>
                                                    </div>';
                                }
                            }
                        }
                    }

                    require_once __DIR__ . "./../views/admin/khachhang/add.php";
                }

                break;
            case "detail":

                if ($_SESSION["admin"]["id_cv"] == 1) {
                    $list = list_kh($_GET["id"]);
                    require_once __DIR__ . "./../views/admin/khachhang/detail.php";
                }

                break;
            case "edit":

                if ($_SESSION["admin"]["id_cv"] == 1) {
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // update khach hang
                        if (isset($_POST["updatekh"]) && !empty($_POST["updatekh"])) {
                            $list = list_kh($_GET["id"]);
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
                            $dateErr = validation_date($_POST["ngaysinh_nd"]);
                            if (!empty($dateErr)) $check = false;

                            // sdt
                            $phoneErr = validation_phone_update($_POST["sdt_nd"], $_GET["id"]);
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
                                        update_kh($_GET["id"], trim($_POST["ten_nd"]), $anh_nd, trim($_POST["sdt_nd"]), $_POST["ngaysinh_nd"], trim($_POST["diachi_nd"]), $_POST["mk_nd"]);
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
                                    update_kh($_GET["id"], $_POST["ten_nd"], $anh_nd, $_POST["sdt_nd"], $_POST["ngaysinh_nd"], $_POST["diachi_nd"], $_POST["mk_nd"]);
                                    $message = '<div class="alert alert-success" role="alert">
                                        <strong>Cập nhật thành công!</strong>
                                    </div>';
                                }
                                unset($_POST["ten_nd"], $anh_nd, $_POST["sdt_nd"], $_POST["ngaysinh_nd"], $_POST["diachi_nd"], $_POST["mk_nd"]);
                            }
                        }
                    }

                    $list = list_kh($_GET["id"]);
                    require_once __DIR__ . "./../views/admin/khachhang/edit.php";
                }

                break;
            case "delete":

                if ($_SESSION["admin"]["id_cv"] == 1) {
                    delete_kh($_GET["id"]);
                    header("Location: index.php?act=kh&type=list");
                }

                break;
            case "deleteSL":

                if ($_SESSION["admin"]["id_cv"] == 1) {
                    delete_kh_sl(explode(",", $_GET["arr"]));
                    header("Location: index.php?act=kh&type=list");
                }
                break;
        }
    } else {
        require_once __DIR__ . "./../trangchu/trangchu.php";
    }
}


function khuyenmai()
{

    if (isset($_GET["type"]) && !empty($_GET["type"])) {

        require_once __DIR__ . "./../models/admin/khuyenmai.php";

        switch ($_GET["type"]) {
            case "list":
                $list = list_km_search($_POST["trangthai_km"] ?? "");
                require_once __DIR__ . "./../views/admin/khuyenmai/list.php";
                break;
            case "add":
                if ($_SESSION["admin"]["id_cv"] == 1) {

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {

                        // add khuyen mai
                        if (isset($_POST["addkm"]) && !empty($_POST["addkm"])) {
                            $check = true;

                            // ma km
                            $maErr = validation_makm($_POST["ma_km"]);
                            if (!empty($maErr)) $check = false;

                            // ngay bd
                            $ngaybdErr = validation_date($_POST["ngaybd_km"]);
                            if (!empty($ngaybdErr)) $check = false;

                            // ngay kt
                            $ngayktErr = validation_date($_POST["ngaykt_km"]);
                            if (!empty($ngayktErr)) $check = false;

                            // so sanh ngay
                            if ($_POST["ngaybd_km"] > $_POST["ngaykt_km"]) {
                                $check = false;
                                $ngaybdErr = " * Ngày bắt đầu không hợp lệ";
                            }

                            // phantram
                            if (empty($_POST["phantram_km"])) {
                                $phantramErr = " * Không được bỏ trống";
                                $check = false;
                            } elseif ($_POST["phantram_km"] < 0 || $_POST["phantram_km"] > 100) {
                                $phantramErr = " * Giá trị không hợp lệ";
                                $check = false;
                            }

                            if ($check) {
                                if ($_POST["ngaybd_km"] > $_POST["ngaykt_km"]) {
                                    $message = '<div class="alert alert-danger" role="alert">
                                                    <strong>Sai ngày</strong>
                                                </div>';
                                } else {
                                    add_km($_POST["ma_km"], $_POST["phantram_km"], $_POST["ngaybd_km"], $_POST["ngaykt_km"]);
                                    $message = '<div class="alert alert-danger" role="alert">
                                                    <strong>Thêm mã thành công</strong>
                                                </div>';
                                    unset($_POST["ma_km"], $_POST["phantram_km"], $_POST["ngaybd_km"], $_POST["ngaykt_km"]);
                                }
                            }
                        }
                    }

                    require_once __DIR__ . "./../views/admin/khuyenmai/add.php";
                }
                break;
            case "edit":
                if ($_SESSION["admin"]["id_cv"] == 1) {

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // update khuyen mai
                        if (isset($_POST["updatekm"]) && !empty($_POST["updatekm"])) {
                            $list = list_km($_GET["id"]);
                            $check = true;

                            // ma km
                            $maErr = validation_makm_update($_POST["ma_km"], $list["id_km"]);
                            if (!empty($maErr)) $check = false;

                            // ngay bd
                            $ngaybdErr = validation_date($_POST["ngaybd_km"]);
                            if (!empty($ngaybdErr)) $check = false;

                            // ngay kt
                            $ngayktErr = validation_date($_POST["ngaykt_km"]);
                            if (!empty($ngayktErr)) $check = false;

                            // so sanh ngay
                            if ($_POST["ngaybd_km"] > $_POST["ngaykt_km"]) {
                                $check = false;
                                $ngaybdErr = " * Ngày bắt đầu không hợp lệ";
                            }

                            // phantram
                            if (empty($_POST["phantram_km"])) {
                                $phantramErr = " * Không được bỏ trống";
                                $check = false;
                            } elseif ($_POST["phantram_km"] < 0 || $_POST["phantram_km"] > 100) {
                                $phantramErr = " * Giá trị không hợp lệ";
                                $check = false;
                            }

                            if ($check) {
                                if ($_POST["ngaybd_km"] > $_POST["ngaykt_km"]) {
                                    $message = '<div class="alert alert-danger" role="alert">
                                    <strong>Sai ngày</strong>
                                </div>';
                                } else {
                                    update_km($list["id_km"], $_POST["ma_km"], $_POST["phantram_km"], $_POST["ngaybd_km"], $_POST["ngaykt_km"]);
                                    $message = '<div class="alert alert-danger" role="alert">
                                    <strong>Cập nhật mã thành công</strong>
                                </div>';
                                    unset($_POST["ma_km"], $_POST["phantram_km"], $_POST["ngaybd_km"], $_POST["ngaykt_km"]);
                                }
                            }
                        }
                    }

                    $list = list_km($_GET["id"]);
                    require_once __DIR__ . "./../views/admin/khuyenmai/edit.php";
                }
                break;
            case "delete":
                if ($_SESSION["admin"]["id_cv"] == 1) {
                    delete_km($_GET["id"]);
                    header("Location: index.php?act=km&type=list");
                }
                break;
            case "deleteSL":
                if ($_SESSION["admin"]["id_cv"] == 1) {
                    delete_km_sl(explode(",", $_GET["arr"]));
                    header("Location: index.php?act=km&type=list");
                }
                break;
        }
    } else {
        require_once __DIR__ . "./../trangchu/trangchu.php";
    }
}

function banner()
{
    if (isset($_GET["type"]) && !empty($_GET["type"])) {

        require_once __DIR__ . "./../models/admin/banner.php";

        switch ($_GET["type"]) {
            case "list":
                $list = list_banner_search($_POST["trangthai_banner"] ?? "");
                require_once __DIR__ . "./../views/admin/banner/list.php";
                break;
            case "add":
                if ($_SESSION["admin"]["id_cv"] == 1) {

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {

                        // add banner
                        if (isset($_POST["addbn"]) && !empty($_POST["addbn"])) {
                            $check = true;

                            // anh
                            if ($_FILES["anh_banner"]["size"] == 0) {
                                // do khi gui thi co anh hay k thi FILES van khoi tao 1 file chua anh
                                $check = false;
                                $anhErr = " * Ảnh không được bỏ trống";
                            } else {
                                $anhErr = validation_img($_FILES["anh_banner"]);
                                if (!empty($anhErr)) $check = false;
                            }

                            // link banner
                            if ($_POST["link_banner"] == 0) {
                                $linkErr = " * Sai đường dẫn";
                                $check = false;
                            } elseif (empty($_POST["link_banner"])) {
                                $linkErr = " * Link không được bỏ trống";
                                $check = false;
                            }

                            // mo ta co duoc khong co duoc

                            // trang thai
                            $trangthaiErr = validation_select($_POST["trangthai_banner"]);
                            if (!empty($trangthaiErr)) $check = false;

                            if ($check) {
                                $tmp = __DIR__ . "./../../public/image/anhsanpham/";
                                $anh_banner = time() . $_FILES["anh_banner"]["name"];

                                if (move_uploaded_file($_FILES["anh_banner"]["tmp_name"], $tmp . $anh_banner)) {
                                    add_banner($anh_banner, $_POST["link_banner"], $_POST["mota_banner"], $_POST["trangthai_banner"]);
                                    $message = '<div class="alert alert-success" role="alert">
                                                    <strong>Thêm banner thành công!</strong>
                                                </div>';
                                    unset($anh_banner, $_POST["link_banner"], $_POST["mota_banner"], $_POST["tranngthai_banner"]);
                                } else {
                                    $message = '<div class="alert alert-danger" role="alert">
                                                    <strong>Thêm ảnh không thành công!</strong>
                                                </div>';
                                }
                            }
                        }
                    }

                    require_once __DIR__ . "./../views/admin/banner/add.php";
                }
                break;
            case "edit":
                if ($_SESSION["admin"]["id_cv"] == 1) {

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // update banner
                        if (isset($_POST["updatebn"]) && !empty($_POST["updatebn"])) {
                            $list = list_banner($_GET["id"]);
                            $check = true;

                            // anh
                            if ($_FILES["anh_banner"]["size"] !== 0) {
                                // co anh
                                $bool = true;
                                $anhErr = validation_img($_FILES["anh_banner"]);
                                if (!empty($anhErr)) $check = false;
                            } else {
                                // k co anh
                                $bool = false;
                            }

                            // link banner
                            if ($_POST["link_banner"] == 0) {
                                $linkErr = " * Sai đường dẫn";
                                $check = false;
                            } elseif (empty($_POST["link_banner"])) {
                                $linkErr = " * Link không được bỏ trống";
                                $check = false;
                            }

                            // trang thai
                            $trangthaiErr = validation_select($_POST["trangthai_banner"]);
                            if (!empty($trangthaiErr)) $check = false;

                            if ($check) {
                                if ($bool) {
                                    $tmp = __DIR__ . "./../../public/image/anhsanpham/";
                                    $anh_banner = time() . $_FILES["anh_banner"]["name"];

                                    if (move_uploaded_file($_FILES["anh_banner"]["tmp_name"], $tmp . $anh_banner)) {
                                        update_banner($list["id_banner"], $anh_banner, $_POST["link_banner"], $_POST["mota_banner"], $_POST["trangthai_banner"]);
                                        $message = '<div class="alert alert-success" role="alert">
                                        <strong>Cập nhật banner thành công!</strong>
                                    </div>';
                                        delete_img($list["anh_banner"], "anhsanpham");
                                    } else {
                                        $message = '<div class="alert alert-danger" role="alert">
                                        <strong>Cập nhật ảnh không thành công!</strong>
                                    </div>';
                                    }
                                } else {
                                    // k co anh
                                    $anh_banner = $list["anh_banner"];
                                    update_banner($list["id_banner"], $anh_banner, $_POST["link_banner"], $_POST["mota_banner"], $_POST["trangthai_banner"]);
                                    $message = '<div class="alert alert-success" role="alert">
                                    <strong>Cập nhật thành công!</strong>
                                </div>';
                                }
                                unset($list["id_banner"], $anh_banner, $_POST["link_banner"], $_POST["mota_banner"], $_POST["trangthai_banner"]);
                            }
                        }
                    }

                    $list = list_banner($_GET["id"]);
                    require_once __DIR__ . "./../views/admin/banner/edit.php";
                }
                break;
            case "delete":
                if ($_SESSION["admin"]["id_cv"] == 1) {
                    delete_banner($_GET["id"]);
                    header("Location: index.php?act=bn&type=list");
                }
                break;
            case "deleteSL":
                if ($_SESSION["admin"]["id_cv"] == 1) {
                    delete_banner_sl(explode(",", $_GET["arr"]));
                    header("Location: index.php?act=bn&type=list");
                }
                break;
            case "turn":
                if ($_SESSION["admin"]["id_cv"] == 1) {
                    turn_banner($_GET["id"]);
                    header("Location: index.php?act=bn&type=list");
                }
                break;
        }
    } else {
        require_once __DIR__ . "./../trangchu/trangchu.php";
    }
}

function diachi()
{
    if ($_SESSION["admin"]["id_cv"] == 1) {
        if (isset($_GET["type"]) && !empty($_GET["type"])) {

            require_once __DIR__ . "./../models/admin/diachi.php";

            switch ($_GET["type"]) {
                case "list":
                    $list = list_shop("");
                    require_once __DIR__ . "./../views/admin/diachi/list.php";
                    break;
                case "edit":

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // update
                        if (isset($_POST["shop"]) && !empty($_POST["shop"])) {

                            $list = list_shop($_GET["id"]);
                            $check = true;


                            // anh
                            if ($_FILES["anh_shop"]["size"] != 0) {
                                // co anh
                                $bool = true;
                                $anhErr = validation_img($_FILES["anh_shop"]);
                                if (!empty($anhErr)) $check = false;
                            } else {
                                // k co anh
                                $bool = false;
                            }

                            // sdt
                            if (empty($_POST["sdt_shop"])) {
                                $check = false;
                                $sdtErr = " * Số điện thoại không được bỏ trống";
                            } elseif (strlen($_POST["sdt_shop"]) > 20 || strlen($_POST["sdt_shop"]) < 8) {
                                $check = false;
                                $sdtErr = " * Độ dài điện thoại không đúng";
                            } elseif (!preg_match("/^[0-9]+$/", $_POST["sdt_shop"])) {
                                $check = false;
                                $sdtErr = " * Sai định dạng số điện thoại";
                            }

                            // email
                            if (empty($_POST["email_shop"])) {
                                $emailErr =  " * Email không được bỏ trống";
                                $check = false;
                            } elseif (!filter_var($_POST["email_shop"], FILTER_VALIDATE_EMAIL)) {
                                $emailErr = " * Email không đúng định dạng";
                                $check = false;
                            } elseif (strlen($_POST["email_shop"]) > 100) {
                                $emailErr = " * Độ dài Email không vượt quá 100 ký tự";
                                $check = false;
                            }

                            // dia chi
                            if (empty($_POST["diachi_shop"])) {
                                $diachiErr =  " * Địa chỉ không được bỏ trống";
                                $check = false;
                            }

                            if ($check) {
                                if ($bool) {
                                    $tmp = __DIR__ . "./../../public/image/anhsanpham/";
                                    $anh_shop = time() . $_FILES["anh_shop"]["name"];

                                    if (move_uploaded_file($_FILES["anh_shop"]["tmp_name"], $tmp . $anh_shop)) {
                                        update_shop($list["id_shop"], $_POST["sdt_shop"], $_POST["email_shop"], $_POST["diachi_shop"], $anh_shop);
                                        $message = '<div class="alert alert-success" role="alert">
                                                            <strong>Cập nhật địa chỉ thành công!</strong>
                                                        </div>';
                                        delete_img($list["anh_shop"], "anhsanpham");
                                    } else {
                                        $message = '<div class="alert alert-danger" role="alert">
                                                            <strong>Cập nhật ảnh không thành công!</strong>
                                                        </div>';
                                    }
                                } else {
                                    // k co anh
                                    $anh_shop = $list["anh_shop"];
                                    update_shop($list["id_shop"], $_POST["sdt_shop"], $_POST["email_shop"], $_POST["diachi_shop"], $anh_shop);
                                    $message = '<div class="alert alert-success" role="alert">
                                                        <strong>Cập nhật địa chỉ thành công!</strong>
                                                    </div>';
                                }
                                unset($_POST["sdt_shop"], $_POST["email_shop"], $_POST["diachi_shop"], $anh_shop);
                            }
                        }
                    }

                    $list = list_shop($_GET["id"]);
                    require_once __DIR__ . "./../views/admin/diachi/edit.php";
                    break;
            }
        } else {
            require_once __DIR__ . "./../trangchu/trangchu.php";
        }
    }
}

function sanpham()
{
    if (isset($_GET["type"]) && !empty($_GET["type"])) {

        require_once __DIR__ . "./../models/admin/danhmuc.php";
        require_once __DIR__ . "./../models/admin/sanpham.php";
        require_once __DIR__ . "./../models/admin/bienthe.php";
        require_once __DIR__ . "./../models/admin/binhluan.php";

        switch ($_GET["type"]) {
            case "list":
                $listdm = list_dm("");
                $listsp = list_sp_search($_POST["dm_search"] ?? "", $_POST["sp_search"] ?? "");
                require_once __DIR__ . "./../views/admin/sanpham/list.php";
                break;
            case "detail":
                $listdm = list_dm("");
                $listsp = list_sp($_GET["id"]);
                $listbt = list_bt($_GET["id"], "");
                $hinhanh = hinh_anh($_GET["id"], "");
                $listbl = list_bl($_GET["id"]);
                require_once __DIR__ . "./../views/admin/sanpham/detail.php";
                break;
            case "add":
                if ($_SESSION["admin"]["id_cv"] == 1) {

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {

                        // add
                        if (isset($_POST["addsp"]) && !empty($_POST["addsp"])) {

                            $listdm  = pdo_qr("SELECT * FROM danh_muc");
                            $check = true;

                            // danh muc
                            foreach ($listdm as $temp) {
                                // kiem neu k co danh muc trong bang danh_muc
                                if ($temp["id_dm"] == $_POST["id_dm"]) {
                                    $trangthai1_sp = $temp["trangthai_dm"];
                                    $check = true;
                                    break;
                                } else {
                                    $check = false;
                                }
                            }

                            if (!$check) {
                                $dmErr = " * Không tồn tại danh mục";
                            }


                            // ten sp
                            $tenErr = validation_ten_sp($_POST["ten_sp"]);
                            if (!empty($tenErr)) $check = false;

                            // anh sp
                            if ($_FILES["anh_sp"]["size"] == 0) {
                                $check = false;
                                $anhErr = " * Ảnh không được bỏ trống";
                            } else {
                                $anhErr = validation_img($_FILES["anh_sp"]);
                                if (!empty($anhErr)) $check = false;
                            }

                            // gia sp
                            $giaErr = validation_number($_POST["gia_sp"]);
                            if (!empty($giaErr)) $check = false;

                            // mota sp
                            $motaErr = validation_adress(trim($_POST["mota_sp"]));
                            if (!empty($motaErr)) $check = false;

                            if ($check) {
                                $tmp = __DIR__ . "./../../public/image/anhsanpham/";
                                $anh_sp = time() . $_FILES["anh_sp"]["name"];

                                if (move_uploaded_file($_FILES["anh_sp"]["tmp_name"], $tmp . $anh_sp)) {
                                    add_sp($_POST["id_dm"], trim($_POST["ten_sp"]), trim($_POST["mota_sp"]), $anh_sp, $_POST["gia_sp"], $trangthai1_sp);
                                    $message = '<div class="alert alert-success" role="alert">
                                                            <strong>Thêm thành công!</strong>
                                                        </div>';
                                    unset($_POST["id_dm"], $_POST["ten_sp"], $_POST["mota_sp"], $anh_sp, $_POST["gia_sp"], $trangthai1_sp);
                                } else {
                                    $message = '<div class="alert alert-danger" role="alert">
                                                            <strong>Thêm ảnh không thành công!</strong>
                                                        </div>';
                                }
                            }
                        }
                    }

                    $listdm = list_dm("");
                    require_once __DIR__ . "./../views/admin/sanpham/add.php";
                }
                break;
            case "edit":
                if ($_SESSION["admin"]["id_cv"] == 1) {

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // update
                        if (isset($_POST["updatesp"]) && !empty($_POST["updatesp"])) {

                            $listsp = list_sp($_GET["id"]);
                            $listdm  = pdo_qr("SELECT * FROM danh_muc");
                            $check = true;

                            // danh muc
                            foreach ($listdm as $temp) {
                                // kiem neu k co danh muc trong bang danh_muc
                                if ($temp["id_dm"] == $_POST["id_dm"]) {
                                    $trangthai1_sp = $temp["trangthai_dm"];
                                    $check = true;
                                    break;
                                } else {
                                    $check = false;
                                }
                            }

                            if (!$check) {
                                $dmErr = " * Không tồn tại danh mục";
                            }


                            // ten sp
                            $tenErr = validation_ten_sp_update($_POST["ten_sp"], $listsp["id_sp"]);
                            if (!empty($tenErr)) $check = false;

                            // anh
                            if ($_FILES["anh_sp"]["size"] !== 0) {
                                // co anh
                                $bool = true;
                                $anhErr = validation_img($_FILES["anh_sp"]);
                                if (!empty($anhErr)) $check = false;
                            } else {
                                // k co anh
                                $bool = false;
                            }

                            // gia sp
                            $giaErr = validation_number($_POST["gia_sp"]);
                            if (!empty($giaErr)) $check = false;

                            // mota sp
                            $motaErr = validation_adress(trim($_POST["mota_sp"]));
                            if (!empty($motaErr)) $check = false;

                            if ($check) {
                                // co anh
                                if ($bool) {
                                    $tmp = __DIR__ . "./../../public/image/anhsanpham/";
                                    $anh_sp = time() . $_FILES["anh_sp"]["name"];

                                    if (move_uploaded_file($_FILES["anh_sp"]["tmp_name"], $tmp . $anh_sp)) {

                                        update_sp($listsp["id_sp"], $_POST["id_dm"], trim($_POST["ten_sp"]), trim($_POST["mota_sp"]), $anh_sp, $_POST["gia_sp"]);

                                        $message = '<div class="alert alert-success" role="alert">
                                            <strong>Cập nhật thành công!</strong>
                                        </div>';
                                        delete_img($listsp["anh_sp"], "anhsanpham");
                                        // var_dump($list["anh_nd"]);

                                    } else {
                                        $message = '<div class="alert alert-danger" role="alert">
                                            <strong>Cập nhật ảnh không thành công!</strong>
                                        </div>';
                                    }
                                } else {
                                    // k co anh
                                    $anh_sp = $listsp["anh_sp"];
                                    // var_dump($list);
                                    update_sp($listsp["id_sp"], $_POST["id_dm"], trim($_POST["ten_sp"]), trim($_POST["mota_sp"]), $anh_sp, $_POST["gia_sp"]);
                                    $message = '<div class="alert alert-success" role="alert">
                                        <strong>Cập nhật thành công!</strong>
                                    </div>';
                                }
                                unset($_POST["id_dm"], $_POST["ten_sp"], $_POST["mota_sp"], $anh_sp, $_POST["gia_sp"]);
                            }
                        }
                    }
                    $listdm = list_dm("");
                    $listsp = list_sp($_GET["id"]);
                    require_once __DIR__ . "./../views/admin/sanpham/edit.php";
                }
                break;
            case "delete":
                if ($_SESSION["admin"]["id_cv"] == 1) {
                    $check = delete_sp($_GET["id"]);
                    if (!empty($check)) {
                        echo $check;
                    } else {
                        header("Location: index.php?act=sp&type=list");
                    }
                }
                break;
                // bien the size
            case "addbt":
                if ($_SESSION["admin"]["id_cv"] == 1) {
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // add bien the
                        if (isset($_POST["addbt"]) && !empty($_POST["addbt"])) {
                            $check = true;

                            // size
                            $sizeErr = validation_size($_GET["id"], $_POST["size_bt"]);
                            if (!empty($sizeErr)) $check = false;

                            // so luong
                            if ($_POST["soluong_bt"] == 0) {
                            } elseif (empty($_POST["soluong_bt"])) {
                                $soluongErr = " * Số lượng không được bỏ trống";
                                $check = false;
                            } elseif ($_POST["soluong_bt"] <= 0) {
                                $soluongErr = " * Số lượng không được âm";
                                $check = false;
                            }

                            if ($check) {
                                add_bt($_GET["id"], $_POST["size_bt"], $_POST["soluong_bt"]);
                                $message = '<div class="alert alert-success" role="alert">
                                            <strong>Thêm biến thể thành công!</strong>
                                        </div>';
                                unset($_POST["size_bt"], $_POST["soluong_bt"]);
                            }
                        }
                    }
                    require_once __DIR__ . "./../views/admin/sanpham/bienthe/add.php";
                }
                break;
            case "editbt":
                if ($_SESSION["admin"]["id_cv"] == 1) {

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // edit bien the
                        if (isset($_POST["editbt"]) && !empty($_POST["editbt"])) {
                            $listbt = list_bt($_GET["idsp"], $_GET["idbt"]);
                            $check = true;

                            // size
                            $sizeErr = validation_size_update($listbt["id_sp"], $_POST["size_bt"], $listbt["id_bt"]);
                            if (!empty($sizeErr)) $check = false;

                            // so luong
                            if ($_POST["soluong_bt"] == 0) {
                            } elseif (empty($_POST["soluong_bt"])) {
                                $soluongErr = " * Số lượng không được bỏ trống";
                                $check = false;
                            } elseif ($_POST["soluong_bt"] <= 0) {
                                $soluongErr = " * Số lượng không được âm";
                                $check = false;
                            }

                            if ($check) {
                                update_bt($listbt["id_sp"], $listbt["id_bt"], $_POST["size_bt"], $_POST["soluong_bt"]);
                                $message = '<div class="alert alert-success" role="alert">
                                            <strong>Thêm biến thể thành công!</strong>
                                        </div>';
                                unset($_POST["size_bt"], $_POST["soluong_bt"]);
                                // ===============================
                                header("Location: index.php?act=sp&type=detail&id=" . $_GET["idsp"]);
                                // ===============================
                            }
                        }
                    }
                    $listbt = list_bt($_GET["idsp"], $_GET["idbt"]);
                    require_once __DIR__ . "./../views/admin/sanpham/bienthe/edit.php";
                }
                break;
            case "deletebt":
                if ($_SESSION["admin"]["id_cv"] == 1) {
                    delete_bt($_GET["idsp"], $_GET["idbt"]);
                    header("Location: index.php?act=sp&type=detail&id=" . $_GET["idsp"]);
                }
                break;
                // hinh anh
            case "editha":
                if ($_SESSION["admin"]["id_cv"] == 1) {

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // update hinh anh
                        if (isset($_POST["updateha"]) && !empty($_POST["updateha"])) {
                            $check = true;

                            $hinhanh = hinh_anh($_GET["idsp"], $_GET["idha"]);
                            if ($_FILES["anh_ha"]["size"] == 0) {
                                $check = false;
                                $anhErr = " * Ảnh không được bỏ trống";
                            } else {
                                $anhErr = validation_img($_FILES["anh_ha"]);
                                if (!empty($anhErr)) {
                                    $check = false;
                                }

                                if ($check) {
                                    $tmp = __DIR__ . "./../../public/image/anhsanpham/";
                                    $anh_ha = time() . $_FILES["anh_ha"]["name"];

                                    if ($hinhanh["anh_ha"] == "anhmacdinh.jpg") {
                                        move_uploaded_file($_FILES["anh_ha"]["tmp_name"], $tmp . $anh_ha);
                                        update_ha($hinhanh["id_sp"], $hinhanh["id_ha"], $anh_ha);
                                        $message = '<div class="alert alert-success" role="alert">
                                            <strong>Cập nhật thành công!</strong>
                                        </div>';
                                    } else {
                                        delete_img($hinhanh["anh_ha"], "anhsanpham");
                                        move_uploaded_file($_FILES["anh_ha"]["tmp_name"], $tmp . $anh_ha);
                                        update_ha($hinhanh["id_sp"], $hinhanh["id_ha"], $anh_ha);
                                        $message = '<div class="alert alert-success" role="alert">
                                            <strong>Cập nhật thành công!</strong>
                                        </div>';
                                    }

                                    // ===============================
                                    header("Location: index.php?act=sp&type=detail&id=" . $_GET["idsp"]);
                                    // ===============================
                                }
                            }
                        }
                    }
                    $hinhanh = hinh_anh($_GET["idsp"], $_GET["idha"]);
                    require_once __DIR__ . "./../views/admin/sanpham/hinhanh/edit.php";
                }
                break;
        }
    } else {
        require_once __DIR__ . "./../trangchu/trangchu.php";
    }
}

function donhang()
{
    if (isset($_GET["type"]) && !empty($_GET["type"])) {

        require_once __DIR__ . "./../models/admin/donhang.php";

        switch ($_GET["type"]) {
            case "list":
                $list = list_dh("");
                require_once __DIR__ . "./../views/admin/donhang/list.php";
                break;
            case "detail":
                $donhang = ttdonhang($_GET["id"]);

                $list = list_dh($_GET["id"]);

                require_once __DIR__ . "./../views/admin/donhang/detail.php";
                break;
            case "edit":

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (isset($_POST["updatedh"]) && !empty($_POST["updatedh"])) {
                        // cap nhat trang thai don hang
                        update_dh($_GET["id"], $_POST["trangthai_dh"]);

                        if (trangthai_dh($_GET["id"])["trangthai_dh"] == 6) {
                            $sql = "CALL capnhatsoluong(" . $_GET["id"] . ")";
                            pdo_exe($sql);
                        }

                        $message = '<div class="alert alert-success" role="alert">
                                    <strong>Cập nhật thành công!</strong>
                                </div>';
                    }
                }

                $trangthai = trangthai_dh($_GET["id"])["trangthai_dh"];
                require_once __DIR__ . "./../views/admin/donhang/edit.php";
                break;
            case "delete":
                // CHUA NEN LAM ++> CHUA CAP NHAT DUOC TRANG THAI 3 CUA SAN PHAM
                delete_dh($_GET["id"]);
                header("Location: index.php?act=dh&type=list");
                break;
        }
    } else {
        require_once __DIR__ . "./../trangchu/trangchu.php";
    }
}

function lienhe()
{
    if (isset($_GET["type"]) && !empty($_GET["type"])) {
        require_once __DIR__ . "./../models/admin/lienhe.php";

        switch ($_GET["type"]) {
            case "list":
                $list = list_lh();
                require_once __DIR__ . "./../views/admin/lienhe/list.php";
                break;
            case "delete":
                delete_lh($_GET["id"]);
                header("Location: index.php?act=lh&type=list");
                break;
            case "deleteSL":
                delete_lh_sl(explode(",", $_GET["arr"]));
                header("Location: index.php?act=lh&type=list");
                break;
        }
    } else {
        require_once __DIR__ . "./../trangchu/trangchu.php";
    }
}

if (isset($_GET["act"]) && !empty($_GET["act"])) {
    switch ($_GET["act"]) {
        case "dm":
            danhmuc();
            break;
        case "sp":
            sanpham();
            break;
        case "kh":
            khachhang();
            break;
        case "nv":
            nhanvien();
            break;
        case "km":
            khuyenmai();
            break;
        case "bn":
            banner();
            break;
        case "dc":
            diachi();
            break;
        case "dh":
            donhang();
            break;
        case "lh":
            lienhe();
            break;
        case "dx":
            // Hủy bỏ tat ca bien session
            session_destroy();
            header("Location: index.php");
            break;
    }
} else {
    require_once __DIR__ . "./../views/admin/trangchu/trangchu.php";
}
