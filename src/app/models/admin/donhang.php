<?php

    // lay tat ca don hang hoac tat ca don hang chi tiet

    function list_dh($id){
            //  DANH SACH DON HANG
        if(empty($id)){
            $sql = "SELECT don_hang.*,nguoi_dung.ten_nd FROM don_hang INNER JOIN nguoi_dung ON nguoi_dung.id_nd = don_hang.id_nd ORDER BY id_dh DESC";
            return pdo_qr($sql);
        }else{
            // CHI TIET DON HANG
            $sql = "SELECT don_hang_chi_tiet.*, san_pham.ten_sp,san_pham.anh_sp, bien_the.size_bt FROM don_hang_chi_tiet INNER JOIN bien_the ON bien_the.id_bt = don_hang_chi_tiet.id_bt
                                                    INNER JOIN san_pham ON san_pham.id_sp = bien_the.id_sp
                                                    WHERE don_hang_chi_tiet.id_dh = $id";
            return pdo_qr($sql);
        }
    }

    function ttdonhang($id){
        $sql = "SELECT * FROM don_hang WHERE id_dh = $id";
        return pdo_qr_one($sql);
    }
    
    function trangthai_dh($id){
        $sql = "SELECT trangthai_dh FROM don_hang WHERE id_dh = $id";
        return pdo_qr_one($sql);
    }

    function update_dh($id,$trangthai){
        $sql = "UPDATE don_hang SET `trangthai_dh` = $trangthai WHERE `id_dh` = $id";
        pdo_exe($sql);
    }

    function delete_dh($id_dh){ 
        // CAP NHAT LAI TRANGTHAI3_SP  CHUA NEN LAM DO CO THE 1 SAN PHAM CO O NHIEU DON HANG ==> TRIGGER HOAC FUNCTION SQL
        // Xoa don hang chi tiet
        $sql = "DELETE FROM don_hang_chi_tiet WHERE id_dh = $id_dh";
        pdo_exe($sql);

        // Xoa don hang
        $sql = "DELETE FROM don_hang WHERE id_dh = $id_dh";
        pdo_exe($sql);
    }



// ====================================HAM CAP NHAT SO LUONG SAN PHAM =======================================
// DELIMITER 

// CREATE PROCEDURE capnhatsoluong(IN bienDH INT)
// BEGIN
//     -- Kiểm tra xem trạng thái của đơn hàng có phải là 2 không
//     DECLARE bienTT INT;

//     SELECT trangthai_dh INTO bienTT
//     FROM don_hang
//     WHERE id_dh = bienDH;

//     IF bienTT = 2 THEN
//         -- Cập nhật số lượng sản phẩm dựa trên biến thể đơn hàng chi tiết
//         UPDATE bien_the
//         INNER JOIN don_hang_chi_tiet ON bien_the.id_bt = don_hang_chi_tiet.id_bt
//         SET bien_the.soluong_bt = bien_the.soluong_bt - don_hang_chi_tiet.soluong_dhct
//         WHERE don_hang_chi_tiet.id_dh = bienDH;
//     END IF;
// END //

// DELIMITER ;



// =====================================CAP NHAT TRANG THAI 3 SAN PHAM ===========================

// DELIMITER //

// CREATE PROCEDURE capnhattrangthai3(IN bienDH INT)
// BEGIN
//     DECLARE bienTT INT;

//     -- Lấy trạng thái của đơn hàng
//     SELECT trangthai_dh INTO bienTT
//     FROM don_hang
//     WHERE id_dh = bienDH;

//     IF bienTT = 2 THEN
//         -- Cập nhật trạng thái của sản phẩm thành 1
//         UPDATE san_pham
//         SET trangthai3_sp = 1
//         WHERE id_sp IN (
//             SELECT bien_the.id_sp
//             FROM bien_the
//             INNER JOIN don_hang_chi_tiet ON bien_the.id_bt = don_hang_chi_tiet.id_bt
//             WHERE don_hang_chi_tiet.id_dh = bienDH
//         );
//     END IF;
// END //

// DELIMITER ;
?>