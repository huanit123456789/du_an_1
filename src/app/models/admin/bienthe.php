<?php

// bien the
// do đã cập nhật trjang thái 2 ở list danh mục nên khi thêm sửa xóa size thì k cần trigger để cập nhật nữa


function soluong_bt($id)
{
    $sql = "SELECT SUM(soluong_bt) AS soluong_sp FROM bien_the WHERE id_sp = $id ORDER by id_sp";

    if (empty(pdo_qr_one($sql)["soluong_sp"])) {
        return 0;
    } else {
        return pdo_qr_one($sql)["soluong_sp"];
    }
}

function list_bt($idsp, $idbt)
{
    if (empty($idbt)) {
        $sql = "SELECT * FROM bien_the WHERE id_sp = $idsp ORDER BY size_bt ASC";
        return pdo_qr($sql);
    } else {
        $sql = "SELECT * FROM bien_the WHERE id_sp = $idsp AND id_bt = $idbt";
        return pdo_qr_one($sql);
    }
}

function add_bt($id, $size_bt, $soluong_bt)
{
    $sql = "INSERT INTO bien_the(id_sp,size_bt,soluong_bt) VALUES ($id,$size_bt,$soluong_bt)";
    pdo_exe($sql);
}

function update_bt($idsp, $idbt, $size_bt, $soluong_bt)
{
    $sql = "UPDATE bien_the SET
                `size_bt` = '$size_bt',
                `soluong_bt` = '$soluong_bt'
                WHERE `id_bt` = '$idbt' AND `id_sp` = '$idsp'";
    pdo_exe($sql);
}

function validation_size($id, $size_bt)
{

    if (empty($size_bt)) {
        return " * Size không được bỏ trống";
    } elseif ($size_bt <= 0) {
        return " * Size không được âm";
    }

    $sql = "SELECT size_bt FROM bien_the WHERE id_sp = $id";
    foreach (pdo_qr($sql) as $temp) {
        if ($size_bt == $temp["size_bt"]) {
            return " * Size đã tổn tại";
        }
    }
}

function validation_size_update($id, $size_bt, $id_bt)
{
    if (empty($size_bt)) {
        return " * Size không được bỏ trống";
    } elseif ($size_bt <= 0) {
        return " * Size không được âm";
    }

    $sql = "SELECT size_bt FROM bien_the WHERE id_sp = $id AND id_bt <> $id_bt";
    foreach (pdo_qr($sql) as $temp) {
        if ($size_bt == $temp["size_bt"]) {
            return " * Size đã tổn tại";
        }
    }
}

function delete_bt($idsp, $idbt)
{
    $sql = "DELETE FROM bien_the WHERE id_bt = $idbt AND id_sp = $idsp";
    pdo_exe($sql);
}

function hinh_anh($idsp, $idha)
{
    if (empty($idha)) {
        $sql = "SELECT * FROM hinh_anh WHERE id_sp = $idsp";
        return pdo_qr($sql);
    } else {
        $sql = "SELECT * FROM hinh_anh WHERE id_sp = $idsp AND id_ha = $idha";
        return pdo_qr_one($sql);
    }
}

function update_ha($idsp, $idha, $anh_ha)
{
    $sql = "UPDATE hinh_anh SET
            anh_ha = '$anh_ha'
            WHERE id_ha = $idha
            AND id_sp = $idsp";
    pdo_exe($sql);
}

// if ($_SERVER["REQUEST_METHOD"] == "POST") {

//     // add bt
//     if (isset($_POST["addbt"]) && !empty($_POST["addbt"])) {
//         $check = true;

//         // size
//         $sizeErr = validation_size($_GET["id"], $_POST["size_bt"]);
//         if (!empty($sizeErr)) $check = false;

//         // so luong
//         if (empty($_POST["soluong_bt"])) {
//             $soluongErr = " * Số lượng không được bỏ trống";
//             $check = false;
//         } elseif ($_POST["soluong_bt"] <= 0) {
//             $soluongErr = " * Số lượng không được âm";
//             $check = false;
//         }

//         if ($check) {
//             add_bt($_GET["id"], $_POST["size_bt"], $_POST["soluong_bt"]);
//             $message = '<div class="alert alert-success" role="alert">
//                                             <strong>Thêm biến thể thành công!</strong>
//                                         </div>';
//             unset($_POST["size_bt"], $_POST["soluong_bt"]);
//         }
//     }

//     // edit_bt
//     if (isset($_POST["editbt"]) && !empty($_POST["editbt"])) {
//         $listbt = list_bt($_GET["idsp"], $_GET["idbt"]);
//         $check = true;

//         // size
//         $sizeErr = validation_size_update($listbt["id_sp"], $_POST["size_bt"], $listbt["id_bt"]);
//         if (!empty($sizeErr)) $check = false;

//         // so luong
//         if (empty($_POST["soluong_bt"])) {
//             $soluongErr = " * Số lượng không được bỏ trống";
//             $check = false;
//         } elseif ($_POST["soluong_bt"] <= 0) {
//             $soluongErr = " * Số lượng không được âm";
//             $check = false;
//         }

//         if ($check) {
//             update_bt($listbt["id_sp"], $listbt["id_bt"], $_POST["size_bt"], $_POST["soluong_bt"]);
//             $message = '<div class="alert alert-success" role="alert">
//                                             <strong>Thêm biến thể thành công!</strong>
//                                         </div>';
//             unset($_POST["size_bt"], $_POST["soluong_bt"]);
//         }
//     }

//     // edit ha
//     if (isset($_POST["updateha"]) && !empty($_POST["updateha"])) {

//         $hinhanh = hinh_anh($_GET["idsp"], $_GET["idha"]);
//         if ($_FILES["anh_ha"]["size"] == 0) {
//             $anhErr = " * Ảnh không được bỏ trống";
//         } else {
//             $anhErr = validation_img($_FILES["anh_ha"]);
//             if (empty($anhErr)) {

//                 $tmp = __DIR__ . "./../../../public/image/anhsanpham/";
//                 $anh_ha = time() . $_FILES["anh_ha"]["name"];

//                 if ($hinhanh["anh_ha"] == "anhmacdinh.jpg") {
//                     move_uploaded_file($_FILES["anh_ha"]["tmp_name"], $tmp . $anh_ha);
//                     update_ha($hinhanh["id_sp"], $hinhanh["id_ha"], $anh_ha);
//                     $message = '<div class="alert alert-success" role="alert">
//                                             <strong>Cập nhật thành công!</strong>
//                                         </div>';
//                 } else {
//                     delete_img($hinhanh["anh_ha"], "anhsanpham");
//                     move_uploaded_file($_FILES["anh_ha"]["tmp_name"], $tmp . $anh_ha);
//                     update_ha($hinhanh["id_sp"], $hinhanh["id_ha"], $anh_ha);
//                     $message = '<div class="alert alert-success" role="alert">
//                                             <strong>Cập nhật thành công!</strong>
//                                         </div>';
//                 }
//             }
//         }
//     }
// }
