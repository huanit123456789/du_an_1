<?php

    session_start();
    
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // LAY DUU LIEU DUOC DAY TU AJAX
    
        $id_bt = $_POST["id_bt"];
    
        // KIEM TRA XEM LOAI SAN PHAM NAY DA CO TRONG GIO HANG HAY CHUA
        // NEU CO ROI THI CONG SO LuOG CHUA CO THI THEM MOI VAO GIO HANG
    
    
        // Tìm vị trí của sản phẩm trong giỏ hàng theo  id_bt
        $index = array_search($id_bt, array_column($_SESSION["cart"], "id_bt"));
    
    
    
        // Nếu bien the đã tồn tại trong giỏ hàng
        if ($index !== false) {
            // Xử lý tình huống khi sản phẩm đã tồn tại
            // Ví dụ: Tăng số lượng sản phẩm hoặc thực hiện hành động khác
    
            unset($_SESSION["cart"][$index]);
            $_SESSION["cart"] = array_values($_SESSION["cart"]);
    
            //  VÀ KHÔNG TỒN TẠI THÌ SẼ THÊM MỚI
        } else {
            echo "Sản phẩm không tồn tại";
        }
    
    
    
        echo count($_SESSION["cart"]);
    }
    
?>