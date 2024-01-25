<?php
//===============================THONG TIN DIA CHI CUA SHOP=======================================
    function list_shop(){
        $sql = "SELECT * FROM shop";
        return pdo_qr_one($sql);
    }


//===================================DANH MUC=====================================
    function list_dm($id){
        if(empty($id)){
            $sql = "SELECT * FROM danh_muc WHERE trangthai_dm = 1";
            return pdo_qr($sql);
        }else{
            $sql = "SELECT * FROM danh_muc WHERE trangthai_dm = 1 AND id_dm = $id";
            return pdo_qr_one($sql);
        }
    }

// =============================================TRANG CHU=====================================================
// ================================LIST BANNER======================================
    function list_banner(){
        $sql = "SELECT * FROM banner WHERE trangthai_banner = 1";
        return pdo_qr($sql);
    }


// ================================ 4 SAN PHAM NOI BAT================================
    function list_nb(){
        $sql = "SELECT * FROM san_pham
                WHERE trangthai1_sp = 1
                ORDER BY luotxem_sp DESC
                LIMIT 4;";
        return pdo_qr($sql);
    }


// ================================MA KHUYEN MAI=======================================
    function list_km(){
        $sql = "SELECT * FROM khuyen_mai WHERE trangthai_km = 1";
        return pdo_qr($sql);
    }
  

// ================================ 6 SAN PHAM MOI RA MAT ===============================
    function list_new(){
        $sql = "SELECT * FROM san_pham
                WHERE trangthai1_sp = 1
                ORDER BY ngaynhap_sp DESC
                LIMIT 6;";
        return pdo_qr($sql);
    }
  
  

// ===================================SAN PHAM THEO DANH MUC===========================================
// =================================SAN PHAM THEO DANH MUC===============================
    function list_spdm($id,$type){
        if(empty($type)){
            $sql = "SELECT * FROM san_pham WHERE trangthai1_sp = 1 AND id_dm = $id";
            return pdo_qr($sql);
        }

        if($type == 1){
            $sql = "SELECT * FROM san_pham WHERE trangthai1_sp = 1 AND id_dm = $id ORDER by gia_sp DESC";
            return pdo_qr($sql);
        }

        if($type == 2){
            $sql = "SELECT * FROM san_pham WHERE trangthai1_sp = 1 AND id_dm = $id ORDER by gia_sp ASC";
            return pdo_qr($sql);
        }
    }


// ========================================SAN PHAM CHI TIET=============================================
// ===============================SAN PHAM CHI TIET================================
    function sanphamchitiet($id){
        $sql = "SELECT * FROM san_pham WHERE trangthai1_sp = 1 AND id_sp = $id";
        return pdo_qr_one($sql);
    }

// ==============================BIEN THE CUA SAN PHAM CHI TIET===========================
    function bienthe($id){
        $sql = "SELECT * FROM bien_the WHERE id_sp = $id ORDER BY size_bt ASC";
        return pdo_qr($sql);
    }

// ===============================HINH ANH PHU CUA SAN PHAM===============================
    function hinhanh($id){
        $sql = "SELECT * FROM hinh_anh WHERE id_sp = $id";
        return pdo_qr($sql);
    }

// ==================================BINH LUAN THEO SAN PHAM================================
    function list_bl($id){
        $sql = "SELECT binh_luan.*,nguoi_dung.ten_nd, nguoi_dung.anh_nd FROM binh_luan INNER JOIN nguoi_dung ON binh_luan.id_nd = nguoi_dung.id_nd WHERE binh_luan.id_sp = $id";
        return pdo_qr($sql);
    }

    function delete_bl($id){
        $sql = "DELETE FROM binh_luan WHERE id_bl = $id";
        pdo_exe($sql);
    }

// =========================================  ADD BINH LUAN ==================================
    function add_bl($id_sp,$id_nd,$nd_bl){
        $date = date("Y-m-d");
        $sql = "INSERT INTO binh_luan(id_nd,id_sp,noidung_bl,ngay_bl) VALUES (?,?,?,?)";
        pdo_exe($sql,$id_nd,$id_sp,$nd_bl,$date);
    }


// ====================================4 SAN PHAM CUNG LOAI==================================
    function sanphamcungloai($id){
        $sql = "SELECT * FROM san_pham WHERE id_dm = (SELECT id_dm FROM san_pham WHERE id_sp = $id) AND id_sp <> $id LIMIT 4";
        return pdo_qr($sql);
    }

// =======================================CAP NHAT LUOT XEM SAN PHAM KHI CO NGUOI CLICK VAO =========================
    function capnhatluotxem($id){
        if(empty($_SESSION["admin"])){
            $sql = "UPDATE san_pham SET luotxem_sp = luotxem_sp +1 WHERE id_sp = $id";
            pdo_exe($sql);
        }
    }

// =================================== TONG SO LUONG CUA BIEN THE ===================================
    function sum_bt($id){
        $sql = "SELECT SUM(soluong_bt) as 'tong' FROM bien_the WHERE id_sp = $id";
        return pdo_qr_one($sql);
    }




// ===================================================TIM KIEM=========================================
// ========================================TIM KIEM THEO TU KHOA==========================
    function timkiem($tukhoa,$type){
        if(empty($type)){
            $sql = "SELECT * FROM san_pham WHERE ten_sp LIKE'%"  . $tukhoa . "%'";       
            return pdo_qr($sql);
        }

        if($type == 1){
            $sql = "SELECT * FROM san_pham WHERE ten_sp LIKE'%"  . $tukhoa . "%' ORDER BY gia_sp DESC";       
            return pdo_qr($sql);
        }

        if($type == 2){
            $sql = "SELECT * FROM san_pham WHERE ten_sp LIKE'%"  . $tukhoa . "%' ORDER BY gia_sp ASC";       
            return pdo_qr($sql);
        }
    }


// ================================================DANG NHAP===================================================
// ========================================CHECK DANG NHAP======================================
    function dangnhap($email_nd,$mk_nd){
        $sql = "SELECT * FROM nguoi_dung WHERE id_cv = 3";
        foreach(pdo_qr($sql) as $temp){
            if($temp["email_nd"] == $email_nd && $temp["mk_nd"] == $mk_nd){
                return $temp;
            }
        }
        return false;
    }



// ===========================================GIO HANG - DON HANG==================================
    // LAY DANH SACH DON HANG CUA NGUOI DUNG VA DON HANG CHI TIET CUA 1 DON HANG CUA NGUOI DUNG
function list_dh($id_nd,$id_dh){
    if(empty($id_dh)){
        //  các đơn hàng của nười dùng
        $sql = "SELECT * FROM don_hang WHERE id_nd = $id_nd ORDER BY id_dh DESC";
        return pdo_qr($sql);
    }else{
           // chi tiet don hang
           $sql = "SELECT don_hang_chi_tiet.*, san_pham.ten_sp,san_pham.anh_sp, bien_the.size_bt FROM don_hang_chi_tiet INNER JOIN bien_the ON bien_the.id_bt = don_hang_chi_tiet.id_bt
                    INNER JOIN san_pham ON san_pham.id_sp = bien_the.id_sp
                    WHERE don_hang_chi_tiet.id_dh = $id_dh";
        return pdo_qr($sql);
    }
}

function ttdonhang($id){
    $sql = "SELECT * FROM don_hang WHERE id_dh = $id";
    return pdo_qr_one($sql);
}


function list_gh_bt($array_idbt){
    $sql = "SELECT san_pham.*, bien_the.* FROM san_pham INNER JOIN bien_the ON bien_the.id_sp = san_pham.id_sp WHERE bien_the.id_bt IN (" . $array_idbt .  ")";
    return pdo_qr($sql);
}


// ==========================================DA NHAN DUOC HANG===============================================
function xacnhan($id){
    $sql = "UPDATE don_hang SET trangthai_dh = 5 WHERE id_dh = $id";
    pdo_exe($sql);
}

function huy($id){
    $sql = "UPDATE don_hang SET `trangthai_dh` = 6 WHERE `id_dh` = $id";
    pdo_exe($sql);
}



// =============================================================================================
// =============================================== ALL SAN PHAM==================================================
function all_sp($type){
    // THEO VIEW
    $sql = "SELECT * FROM san_pham WHERE trangthai1_sp = 1";

    if($type==1){
        $sql .= " ORDER BY gia_sp DESC";
    }

    if($type==2){
        $sql .= " ORDER BY gia_sp ASC";
    }

    return pdo_qr($sql);
}




// =====================================FOOTER EMAIL NHAN THONG BAO================================================
function add_lh($email){
    $sql = "INSERT INTO lien_he(email_lh) VALUE (?)";
    pdo_exe($sql,$email);
}



// ===========================================DAT HANG========================================
function addOrder($id_nd,$nguoinhan_dh,$sdt_dh, $diachi_dh, $ghichu_dh, $giagoc_dh, $giakm_dh, $km_dh) {
    $ngaydat_dh = date("Y-m-d");  // Định dạng ngày tháng năm để phù hợp với MySQL
    $sql = "INSERT INTO don_hang (id_nd,nguoinhan_dh, sdt_dh, diachi_dh, ghichu_dh, ngaydat_dh, giagoc_dh, giakm_dh, km_dh, trangthai_dh) VALUES ($id_nd,'$nguoinhan_dh', '$sdt_dh', '$diachi_dh', '$ghichu_dh', '$ngaydat_dh', $giagoc_dh, $giakm_dh, $km_dh, 1);";
    pdo_exe($sql);

    $sql = "SELECT id_dh FROM don_hang ORDER BY id_dh DESC LIMIT 1";

   
    return pdo_qr_one($sql);
}



function addOrderDetail($id_dh, $id_bt, $soluong_dhct, $gia_bt){
    $gia = $gia_bt * $soluong_dhct;
    $sql="INSERT INTO don_hang_chi_tiet (id_dh, id_bt, soluong_dhct,gia_bt, gia_dhct) VALUES ($id_dh,$id_bt,$soluong_dhct,$gia_bt,$gia);";
    pdo_exe($sql);
}
?>