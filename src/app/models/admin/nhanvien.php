<?php
function list_nv($id)
{
    if (empty($id)) {
        $sql = "SELECT nguoi_dung.*, chuc_vu.ten_cv FROM nguoi_dung INNER JOIN chuc_vu ON nguoi_dung.id_cv = chuc_vu.id_cv WHERE nguoi_dung.id_cv IN (1, 2)";
        return pdo_qr($sql);
    } else {
        $sql = "SELECT nguoi_dung.*, chuc_vu.ten_cv FROM nguoi_dung INNER JOIN chuc_vu ON nguoi_dung.id_cv = chuc_vu.id_cv WHERE nguoi_dung.id_nd = " . $id;
        return pdo_qr_one($sql);
    }
}

function list_nv_search($id_cv, $ten_nd)
{
    $sql = "SELECT nguoi_dung.*, chuc_vu.ten_cv FROM nguoi_dung INNER JOIN chuc_vu ON nguoi_dung.id_cv = chuc_vu.id_cv WHERE nguoi_dung.id_cv IN (1,2)";

    if ($id_cv == 1) {
        $sql .= " AND nguoi_dung.id_cv = 1";
    }

    if ($id_cv == 2) {
        $sql .= " AND nguoi_dung.id_cv = 2";
    }

    if ($ten_nd != "") {
        $sql .= " AND nguoi_dung.ten_nd LIKE '%" . $ten_nd . "%'";
    }

    return pdo_qr($sql);
}

function delete_nv($id)
{
    if ($id == $_SESSION["admin"]["id_nd"]) {
        return "
                <script>
                    alert('Không xóa được tài khoản đang đăng nhập');
                    window.location.href = `index.php?act=nv&type=list`;
                </script>
                ";
    } else {
        $sql = "DELETE FROM binh_luan WHERE id_nd = $id";
        pdo_exe($sql);
        $temp = list_nv($id);
        delete_img($temp["anh_nd"], "anhnguoidung");
        $sql = "DELETE FROM nguoi_dung WHERE id_nd = " . $id;
        pdo_exe($sql);
    }
}

function delete_nv_sl($arr)
{
    // kiem tra xem co thuoc mang hay khong
    if (in_array($_SESSION["admin"]["id_nd"], $arr)) {
        return "
                <script>
                    alert('Không xóa được tài khoản đang đăng nhập');
                    window.location.href = `index.php?act=nv&type=list`;
                </script>
                ";
    } else {
        foreach ($arr as $id) {
            delete_nv($id);
        }
    }
}

function add_nv($ten_nd, $anh_nd, $sdt_nd, $ngaysinh_nd, $diachi_nd, $email_nd, $mk_nd, $id_cv)
{
    $sql = "INSERT INTO `nguoi_dung` (`ten_nd`, `anh_nd`, `sdt_nd`, `ngaysinh_nd`, `diachi_nd`, `email_nd`, `mk_nd`, `id_cv`) 
                VALUES ('$ten_nd', '$anh_nd', '$sdt_nd', '$ngaysinh_nd', '$diachi_nd', '$email_nd', '$mk_nd', $id_cv)";
    pdo_exe($sql);
}

function update_nv($id_nd, $ten_nd, $anh_nd, $sdt_nd, $ngaysinh_nd, $diachi_nd, $mk_nd, $id_cv)
{
    $sql = "UPDATE `nguoi_dung` SET 
                `ten_nd` = '$ten_nd',
                `anh_nd` = '$anh_nd',
                `sdt_nd` = '$sdt_nd',
                `ngaysinh_nd` = '$ngaysinh_nd',
                `diachi_nd` = '$diachi_nd',
                `mk_nd` = '$mk_nd',
                `id_cv` = $id_cv
                WHERE `id_nd` = $id_nd";
    pdo_exe($sql);
}

// if ($_SERVER["REQUEST_METHOD"] == "POST") {

//     // add nhan vien
//     if (isset($_POST["addnv"]) && !empty($_POST["addnv"])) {
//         $check = true;

//         // ten
//         $tenErr = validation_name($_POST["ten_nd"]);
//         if (!empty($tenErr)) $check = false;

//         // anh
//         if ($_FILES["anh_nd"]["size"] == 0) {
//             // do khi gui thi co anh hay k thi FILES van khoi tao 1 file chua anh
//             $check = false;
//             $anhErr = " * Ảnh không được bỏ trống";
//         } else {
//             $anhErr = validation_img($_FILES["anh_nd"]);
//             if (!empty($anhErr)) $check = false;
//         }

//         // email
//         $emailErr = validation_email($_POST["email_nd"]);
//         if (!empty($emailErr)) $check = false;

//         // mat khau
//         $passErr = validation_pass($_POST["mk_nd"]);
//         if (!empty($passErr)) $check = false;

//         // chuc vu
//         $selectErr = validation_select($_POST["id_cv"]);
//         if (!empty($selectErr)) $check = false;

//         // ngay sinh
//         $dateErr = validation_date_birthday($_POST["ngaysinh_nd"]);
//         if (!empty($dateErr)) $check = false;

//         // sdt
//         $phoneErr = validation_phone($_POST["sdt_nd"]);
//         if (!empty($phoneErr)) $check = false;

//         // dia chi
//         $adressErr = validation_adress($_POST["diachi_nd"]);
//         if (!empty($adressErr)) $check = false;

//         // NEU DUNG TAT CA
//         if ($check) {
//             $tmp = __DIR__ . "./../../../public/image/anhnguoidung/";
//             $anh_nd = time() . $_FILES["anh_nd"]["name"];

//             if (move_uploaded_file($_FILES["anh_nd"]["tmp_name"], $tmp . $anh_nd)) {
//                 add_nv(trim($_POST["ten_nd"]), $anh_nd, trim(($_POST["sdt_nd"])), $_POST["ngaysinh_nd"], trim($_POST["diachi_nd"]), trim($_POST["email_nd"]), $_POST["mk_nd"], $_POST["id_cv"]);
//                 $message = '<div class="alert alert-success" role="alert">
//                                     <strong>Thêm thành công!</strong>
//                                 </div>';
//                 unset($_POST["ten_nd"], $anh_nd, $_POST["sdt_nd"], $_POST["ngaysinh_nd"], $_POST["diachi_nd"], $_POST["email_nd"], $_POST["mk_nd"], $_POST["id_cv"]);
//             } else {
//                 $message = '<div class="alert alert-danger" role="alert">
//                                     <strong>Thêm ảnh không thành công!</strong>
//                                 </div>';
//             }
//         }
//     }

//     // update nhan vien
//     if (isset($_POST["updatenv"]) && !empty($_POST["updatenv"])) {
//         $list = list_nv($_GET["id"]);
//         $check = true;

//         // ten
//         $tenErr = validation_name($_POST["ten_nd"]);
//         if (!empty($tenErr)) $check = false;

//         // anh
//         if ($_FILES["anh_nd"]["size"] !== 0) {
//             // co anh
//             $bool = true;
//             $anhErr = validation_img($_FILES["anh_nd"]);
//             if (!empty($anhErr)) $check = false;
//         } else {
//             // k co anh
//             $bool = false;
//         }

//         // mat khau
//         $passErr = validation_pass($_POST["mk_nd"]);
//         if (!empty($passErr)) $check = false;

//         // chuc vu
//         $selectErr = validation_select($_POST["id_cv"]);
//         $id_cv = $_POST["id_cv"];
//         if (!empty($selectErr)) $check = false;

//         // ngay sinh
//         $dateErr = validation_date_birthday($_POST["ngaysinh_nd"]);
//         if (!empty($dateErr)) $check = false;

//         // sdt
//         $phoneErr = validation_phone_update($_POST["sdt_nd"], $_GET["id"]);
//         if (!empty($phoneErr)) $check = false;

//         // dia chi
//         $adressErr = validation_adress($_POST["diachi_nd"]);
//         if (!empty($adressErr)) $check = false;

//         if ($check) {
//             // co anh
//             if ($bool) {
//                 $tmp = __DIR__ . "./../../../public/image/anhnguoidung/";
//                 $anh_nd = time() . $_FILES["anh_nd"]["name"];

//                 if (move_uploaded_file($_FILES["anh_nd"]["tmp_name"], $tmp . $anh_nd)) {
//                     update_nv($_GET["id"], trim($_POST["ten_nd"]), $anh_nd, trim($_POST["sdt_nd"]), $_POST["ngaysinh_nd"], trim($_POST["diachi_nd"]), $_POST["mk_nd"], $id_cv);
//                     $message = '<div class="alert alert-success" role="alert">
//                                         <strong>Cập nhật thành công!</strong>
//                                     </div>';
//                     delete_img($list["anh_nd"], "anhnguoidung");
//                 } else {
//                     $message = '<div class="alert alert-danger" role="alert">
//                                         <strong>Cập nhật ảnh không thành công!</strong>
//                                     </div>';
//                 }
//             } else {
//                 // k co anh
//                 $anh_nd = $list["anh_nd"];
//                 update_nv($_GET["id"], $_POST["ten_nd"], $anh_nd, $_POST["sdt_nd"], $_POST["ngaysinh_nd"], $_POST["diachi_nd"], $_POST["mk_nd"], $id_cv);
//                 $message = '<div class="alert alert-success" role="alert">
//                                 <strong>Cập nhật thành công!</strong>
//                             </div>';
//             }
//             unset($_POST["ten_nd"], $anh_nd, $_POST["sdt_nd"], $_POST["ngaysinh_nd"], $_POST["diachi_nd"], $_POST["mk_nd"], $id_cv);
//         }
//     }

//     // update profile
//     if (isset($_POST["updatepr"]) && !empty($_POST["updatepr"])) {
//         $list = list_nv($_GET["id"]);
//         $check = true;

//         // ten
//         $tenErr = validation_name($_POST["ten_nd"]);
//         if (!empty($tenErr)) $check = false;

//         // anh
//         if ($_FILES["anh_nd"]["size"] !== 0) {
//             // co anh
//             $bool = true;
//             $anhErr = validation_img($_FILES["anh_nd"]);
//             if (!empty($anhErr)) $check = false;
//         } else {
//             // k co anh
//             $bool = false;
//         }

//         // mat khau
//         $passErr = validation_pass($_POST["mk_nd"]);
//         if (!empty($passErr)) $check = false;

//         // ngay sinh
//         $dateErr = validation_date_birthday($_POST["ngaysinh_nd"]);
//         if (!empty($dateErr)) $check = false;

//         // sdt
//         $phoneErr = validation_phone_update($_POST["sdt_nd"], $_GET["id"]);
//         if (!empty($phoneErr)) $check = false;

//         // dia chi
//         $adressErr = validation_adress($_POST["diachi_nd"]);
//         if (!empty($adressErr)) $check = false;

//         // var_dump($bool);

//         if ($check) {
//             // co anh
//             if ($bool) {
//                 $tmp = __DIR__ . "./../../../public/image/anhnguoidung/";
//                 $anh_nd = time() . $_FILES["anh_nd"]["name"];

//                 if (move_uploaded_file($_FILES["anh_nd"]["tmp_name"], $tmp . $anh_nd)) {
//                     update_nv($_GET["id"], trim($_POST["ten_nd"]), $anh_nd, trim($_POST["sdt_nd"]), $_POST["ngaysinh_nd"], trim($_POST["diachi_nd"]), $_POST["mk_nd"], $list["id_cv"]);
//                     $message = '<div class="alert alert-success" role="alert">
//                                         <strong>Cập nhật thành công!</strong>
//                                     </div>';
//                     delete_img($list["anh_nd"], "anhnguoidung");
//                     // var_dump($list["anh_nd"]);

//                 } else {
//                     $message = '<div class="alert alert-danger" role="alert">
//                                         <strong>Cập nhật ảnh không thành công!</strong>
//                                     </div>';
//                 }
//             } else {
//                 // k co anh
//                 $anh_nd = $list["anh_nd"];
//                 // var_dump($list);
//                 update_nv($_GET["id"], $_POST["ten_nd"], $anh_nd, $_POST["sdt_nd"], $_POST["ngaysinh_nd"], $_POST["diachi_nd"], $_POST["mk_nd"], $list["id_cv"]);
//                 $message = '<div class="alert alert-success" role="alert">
//                                     <strong>Cập nhật thành công!</strong>
//                                 </div>';
//             }
//             unset($_POST["ten_nd"], $anh_nd, $_POST["sdt_nd"], $_POST["ngaysinh_nd"], $_POST["diachi_nd"], $_POST["mk_nd"], $id_cv);
//         }
//     }
// }
