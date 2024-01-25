<?php

// khi thêm 1 sản phẩm thì sẽ tự động thêm 3 ảnh mô tả với link = ảnh mặc định ==> trigger
// ============================================================================================
// DELIMITER //

// CREATE TRIGGER them_hinh_anh
// AFTER INSERT
// ON san_pham FOR EACH ROW

// BEGIN
//     INSERT INTO hinh_anh (id_sp, anh_ha) VALUES (NEW.id_sp, 'anhmacdinh.jpg');
//     INSERT INTO hinh_anh (id_sp, anh_ha) VALUES (NEW.id_sp, 'anhmacdinh.jpg');
//     INSERT INTO hinh_anh (id_sp, anh_ha) VALUES (NEW.id_sp, 'anhmacdinh.jpg');
// END //

// DELIMITER ;
// ==========================================================================================


// triger cập nhật trạng thái 2 của sản phẩm hết hàng hay còn hàng so với biến thể khi ta thêm sửa xóa biến thể
// Khi mới thêm
// trangthai1: dựa vào trạng thái danh mục
// trangthai2: hết hàng
// trangthai3: chưa có trong giỏ




function add_sp($id_dm, $ten_sp, $mota_sp, $anh_sp, $gia_sp, $trangthai1_sp)
{
    $ngaynhap_sp = date("Y-m-d");
    $sql = "INSERT INTO san_pham(id_dm,ten_sp,mota_sp,ngaynhap_sp,anh_sp,gia_sp,trangthai1_sp,trangthai2_sp,trangthai3_sp)
                VALUES (?,?,?,?,?,?,?,?,?)";
    pdo_exe($sql, $id_dm, $ten_sp, $mota_sp, $ngaynhap_sp, $anh_sp, $gia_sp, $trangthai1_sp, 2, 2);
}

// CẬP NHẬT TRẠNG THÁI 2 SẢN PHẨM bằng 1 lênh sql khi ta lấy danh sachs sản phẩm Tương tự cách ta làm banner
function list_sp($id)
{
    if (empty($id)) {
        $sql = "SELECT * FROM san_pham";
        return pdo_qr($sql);
    } else {
        $sql = "SELECT * FROM san_pham WHERE id_sp = $id";
        return pdo_qr_one($sql);
    }
}

function list_sp_search($id_dm,$sp){
    // 2 cai trong 
    $sql = "SELECT * FROM san_pham WHERE 1";

    // neu co $sp
    if($sp !=""){
        $sql .= " AND ten_sp LIKE '%" .$sp. "%'";
    }

    // neu co danh muc
    if($id_dm != ""){
        $sql .= " AND id_dm = $id_dm";
    }

    return pdo_qr($sql);

}

function delete_sp($id_sp)
{
    if (list_sp($id_sp)["trangthai3_sp"] == 2) {
        // xoa bien the
        $sql = "DELETE FROM bien_the WHERE id_sp = $id_sp";
        pdo_exe($sql);
        // xoa hinh anh
        $listanh = hinh_anh($id_sp, "");
        foreach ($listanh as $temp) {
            if ($temp["anh_ha"] != "anhmacdinh.jpg") {
                delete_img($temp["anh_ha"], "anhsanpham");
            }
        }

        $sql = "DELETE FROM hinh_anh WHERE id_sp = $id_sp";
        pdo_exe($sql);

        $sql = "DELETE FROM binh_luan WHERE id_sp = $id_sp";
        pdo_exe($sql);

        // xóa sản phẩm
        $listsp = list_sp($id_sp);
        delete_img($listsp["anh_sp"], "anhsanpham");
        $sql = "DELETE FROM san_pham WHERE id_sp = $id_sp";
        pdo_exe($sql);
    } else {
        return "
                    <script>
                        alert('Không xóa được sản phẩm đang có trong đơn hàng');
                        window.location.href = `index.php?act=sp&type=list`;
                    </script>
                ";
    }
}

// =======================UPDATE=======================================
// CAP NHAT LAI TRANG THAI SAN PHAM KHI DOI DANH MUC 
// =====================================================================

function update_sp($id_sp, $id_dm, $ten_sp, $mota_sp, $anh_sp, $gia_sp)
{
    if ($_SESSION["admin"]["id_cv"] == 1) {

        $ngaynhap_sp = date("Y-m-d");
        $sql = "UPDATE san_pham 
                    SET id_dm = ?,
                        ten_sp = ?,
                        mota_sp = ?,
                        ngaynhap_sp = ?,
                        anh_sp = ?,
                        gia_sp = ?
                        WHERE id_sp = ?";
        pdo_exe($sql, $id_dm, $ten_sp, $mota_sp, $ngaynhap_sp, $anh_sp, $gia_sp, $id_sp);

        $sql = "UPDATE san_pham
                INNER JOIN danh_muc ON san_pham.id_dm = danh_muc.id_dm
                SET san_pham.trangthai1_sp = 
                CASE 
                WHEN danh_muc.trangthai_dm = 1 THEN 1
                ELSE 2
                END";
        pdo_exe($sql);
    } else {
        die();
    }
}

function validation_ten_sp($name)
{
    $name = trim($name);

    if (!empty(validation_name($name))) {
        return validation_name($name);
    }

    $sql = "SELECT ten_sp FROM san_pham";
    foreach (pdo_qr($sql) as $temp) {
        if ($name == $temp["ten_sp"]) {
            return " * Sản phẩm đã tồn tại";
        }
    }
}

function validation_ten_sp_update($name, $id)
{
    $name = trim($name);

    if (!empty(validation_name($name))) {
        return validation_name($name);
    }

    $sql = "SELECT ten_sp FROM san_pham WHERE id_sp <> $id";
    foreach (pdo_qr($sql) as $temp) {
        if ($name == $temp["ten_sp"]) {
            return " * Sản phẩm đã tồn tại";
        }
    }
}

// if ($_SERVER["REQUEST_METHOD"] == "POST") {

//     // add
//     if (isset($_POST["addsp"]) && !empty($_POST["addsp"])) {

//         $listdm  = pdo_qr("SELECT * FROM danh_muc");
//         $check = true;

//         // danh muc
//         foreach ($listdm as $temp) {
//             // kiem neu k co danh muc trong bang danh_muc
//             if ($temp["id_dm"] == $_POST["id_dm"]) {
//                 $trangthai1_sp = $temp["trangthai_dm"];
//                 $check = true;
//                 break;
//             } else {
//                 $check = false;
//             }
//         }

//         if (!$check) {
//             $dmErr = " * Không tồn tại danh mục";
//         }


//         // ten sp
//         $tenErr = validation_ten_sp($_POST["ten_sp"]);
//         if (!empty($tenErr)) $check = false;

//         // anh sp
//         if ($_FILES["anh_sp"]["size"] == 0) {
//             $check = false;
//             $anhErr = " * Ảnh không được bỏ trống";
//         } else {
//             $anhErr = validation_img($_FILES["anh_sp"]);
//             if (!empty($anhErr)) $check = false;
//         }

//         // gia sp
//         $giaErr = validation_number($_POST["gia_sp"]);
//         if (!empty($giaErr)) $check = false;

//         // mota sp
//         $motaErr = validation_adress(trim($_POST["mota_sp"]));
//         if (!empty($motaErr)) $check = false;

//         if ($check) {
//             $tmp = __DIR__ . "./../../../public/image/anhsanpham/";
//             $anh_sp = time() . $_FILES["anh_sp"]["name"];

//             if (move_uploaded_file($_FILES["anh_sp"]["tmp_name"], $tmp . $anh_sp)) {
//                 add_sp($_POST["id_dm"], trim($_POST["ten_sp"]), trim($_POST["mota_sp"]), $anh_sp, $_POST["gia_sp"], $trangthai1_sp);
//                 $message = '<div class="alert alert-success" role="alert">
//                                         <strong>Thêm thành công!</strong>
//                                     </div>';
//                 unset($_POST["id_dm"], $_POST["ten_sp"], $_POST["mota_sp"], $anh_sp, $_POST["gia_sp"], $trangthai1_sp);
//             } else {
//                 $message = '<div class="alert alert-danger" role="alert">
//                                         <strong>Thêm ảnh không thành công!</strong>
//                                     </div>';
//             }
//         }
//     }

//     // update
//     if (isset($_POST["updatesp"]) && !empty($_POST["updatesp"])) {

//         $listsp = list_sp($_GET["id"]);
//         $listdm  = pdo_qr("SELECT * FROM danh_muc");
//         $check = true;

//         // danh muc
//         foreach ($listdm as $temp) {
//             // kiem neu k co danh muc trong bang danh_muc
//             if ($temp["id_dm"] == $_POST["id_dm"]) {
//                 $trangthai1_sp = $temp["trangthai_dm"];
//                 $check = true;
//                 break;
//             } else {
//                 $check = false;
//             }
//         }

//         if (!$check) {
//             $dmErr = " * Không tồn tại danh mục";
//         }


//         // ten sp
//         $tenErr = validation_ten_sp_update($_POST["ten_sp"], $listsp["id_sp"]);
//         if (!empty($tenErr)) $check = false;

//         // anh
//         if ($_FILES["anh_sp"]["size"] !== 0) {
//             // co anh
//             $bool = true;
//             $anhErr = validation_img($_FILES["anh_sp"]);
//             if (!empty($anhErr)) $check = false;
//         } else {
//             // k co anh
//             $bool = false;
//         }

//         // gia sp
//         $giaErr = validation_number($_POST["gia_sp"]);
//         if (!empty($giaErr)) $check = false;

//         // mota sp
//         $motaErr = validation_adress(trim($_POST["mota_sp"]));
//         if (!empty($motaErr)) $check = false;

//         if ($check) {
//             // co anh
//             if ($bool) {
//                 $tmp = __DIR__ . "./../../../public/image/anhsanpham/";
//                 $anh_sp = time() . $_FILES["anh_sp"]["name"];

//                 if (move_uploaded_file($_FILES["anh_sp"]["tmp_name"], $tmp . $anh_sp)) {

//                     update_sp($listsp["id_sp"], $_POST["id_dm"], trim($_POST["ten_sp"]), trim($_POST["mota_sp"]), $anh_sp, $_POST["gia_sp"]);

//                     $message = '<div class="alert alert-success" role="alert">
//                                             <strong>Cập nhật thành công!</strong>
//                                         </div>';
//                     delete_img($listsp["anh_sp"], "anhsanpham");
//                     // var_dump($list["anh_nd"]);

//                 } else {
//                     $message = '<div class="alert alert-danger" role="alert">
//                                             <strong>Cập nhật ảnh không thành công!</strong>
//                                         </div>';
//                 }
//             } else {
//                 // k co anh
//                 $anh_sp = $listsp["anh_sp"];
//                 // var_dump($list);
//                 update_sp($listsp["id_sp"], $_POST["id_dm"], trim($_POST["ten_sp"]), trim($_POST["mota_sp"]), $anh_sp, $_POST["gia_sp"]);
//                 $message = '<div class="alert alert-success" role="alert">
//                                         <strong>Cập nhật thành công!</strong>
//                                     </div>';
//             }
//             unset($_POST["id_dm"], $_POST["ten_sp"], $_POST["mota_sp"], $anh_sp, $_POST["gia_sp"]);
//         }
//     }
// }
