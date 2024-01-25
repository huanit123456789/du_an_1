<?php

    session_start();

    if(isset($_SESSION["admin"]) && ($_SESSION["admin"]["id_cv"] == 1 || $_SESSION["admin"]["id_cv"] == 2)){
        // để dùng header
        ob_start();

        require_once __DIR__ . "./../../models/pdo.php";
        require_once __DIR__ . "./../../models/admin/nhanvien.php";
        require_once __DIR__ . "./../../models/admin/diachi.php";
        require_once __DIR__ . "./../../models/admin/donhang.php";

        
        // lay logo
        $shop = list_shop(1);
        
        // lay thong tin nguoi dang nhap
        $admin = list_nv($_SESSION["admin"]["id_nd"]);


        // CAP NHAT TRANGTHAI2_SP
        // Nói cách khác, nếu không có bản ghi nào trong bảng bien_the có id_sp khớp với 
        // san_pham.id_sp, hoặc nếu tổng số lượng (soluong_bt) của các bản ghi đó là 0, 
        // thì trangthai2_sp sẽ được đặt thành 2.
        $sql = "CALL capnhattrangthai2()";
        pdo_exe($sql);

        // CAP NHAT TRANG THAI KHUYEN MAI
        $sql = "CALL capnhat_trangthai_km()";
        pdo_exe($sql);

        // LAY SO DON HANG CO TRANG THAI = 1 ==> CHO XAC NHAN
        $sql = "SELECT * FROM don_hang WHERE trangthai_dh = 1";
        $donhang = pdo_qr($sql);


        // LAY SO LIEN HE CO TRONG BANG
        $sql = "SELECT * FROM lien_he";
        $lienhe = pdo_qr($sql);

        require_once __DIR__ . "./header/header.php";
        require_once __DIR__ . "./../../controllers/AdminController.php";
        require_once __DIR__ . "./footer/footer.php";

        ob_end_flush();
    }else{

        require_once __DIR__ . "./login/login.php";

    }

   
?>