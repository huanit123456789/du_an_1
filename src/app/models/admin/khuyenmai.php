<?php
    // ==================================CHUA DUNG================================================
    // DELIMITER //
    // CREATE TRIGGER trangthaikm
    // BEFORE INSERT ON khuyen_mai
    // FOR EACH ROW
    // BEGIN
    //     IF NEW.ngaybd_km <= NOW() AND NEW.ngaykt_km >= NOW() THEN
    //         SET NEW.trangthai_km = 1;  hoat dong
    //     ELSE
    //         SET NEW.trangthai_km = 2; ngung hoat dong
    //     END IF;
    // END;
    // //
    // DELIMITER ;

    //     DELIMITER //
    // CREATE TRIGGER trangthaikmupdate
    // BEFORE UPDATE ON khuyen_mai
    // FOR EACH ROW
    // BEGIN
    //     IF NEW.ngaybd_km <= NOW() AND NEW.ngaykt_km >= NOW() THEN
    //         SET NEW.trangthai_km = 1; -- hoat dong
    //     ELSE
    //         SET NEW.trangthai_km = 2; -- ngung hoat dong
    //     END IF;
    // END //
    // DELIMITER ;

    // ==========================================FUNCTION SQL ========================================
    //     DELIMITER //
    // CREATE PROCEDURE capnhat_trangthai_km()
    // BEGIN
    //     UPDATE khuyen_mai
    //     SET trangthai_km = 
    //         CASE
    //             WHEN ngaybd_km <= NOW() AND ngaykt_km >= NOW() THEN 1
    //             ELSE 2
    //         END;
    // END //
    // DELIMITER ;
    // ================================================================================================

    // ta sẽ dùng hàm để cập nhật tất cả trạng thái của khuyến mãi và dùng khi ta dùng list khuyến mãi
    // và gọi hàm đó khi ta SELECT list khuyen mai ma k can dung trigger

    function list_km($id){
        if(empty($id)){
            $sql = "SELECT * FROM khuyen_mai";
            return pdo_qr($sql);
        }else{
            $sql = "SELECT * FROM khuyen_mai WHERE id_km = $id";
            return pdo_qr_one($sql);
        }
    }

    function list_km_search($trangthai_km){
        $sql = "SELECT * FROM khuyen_mai WHERE 1";

        if($trangthai_km == 1){
            $sql .= " AND trangthai_km = 1";
        }

        if($trangthai_km == 2){
            $sql .= " AND trangthai_km = 2";
        }

        return pdo_qr($sql);
    }

    function add_km($ma_km,$phantram_km,$ngaybd_km,$ngaykt_km){
        $sql = "INSERT INTO khuyen_mai(ma_km,phantram_km,ngaybd_km,ngaykt_km) VALUES ('$ma_km',$phantram_km,'$ngaybd_km','$ngaykt_km')";
        pdo_exe($sql);
    }

    function delete_km($id){
        $sql = "DELETE FROM khuyen_mai WHERE id_km = $id";
        pdo_exe($sql);
    }

    function delete_km_sl($arr){
        foreach($arr as $id){
            delete_km($id);
        }
    }

    function update_km($id_km,$ma_km,$phantram_km,$ngaybd_km,$ngaykt_km){
        $sql = "UPDATE khuyen_mai SET
                ma_km ='$ma_km',
                phantram_km = '$phantram_km',
                ngaybd_km = '$ngaybd_km',
                ngaykt_km = '$ngaykt_km'
                WHERE id_km = $id_km ";
        pdo_exe($sql);
    }

    function validation_makm($ma_km){
        if($ma_km == 0){
            return " * Mã khuyến mãi không hợp lệ";
        }elseif(empty($ma_km)){
            return " * Mã khuyến mãi không được bỏ trống";
        }elseif(preg_match("/[ ]/", $ma_km)){
            return " * Mã khuyến mãi không được chứa dấu cách";
        }elseif(strlen($ma_km) < 8 || strlen($ma_km)> 50){
            return " * Độ dài không hợp lệ";
        }

        $sql = "SELECT ma_km FROM khuyen_mai";
        foreach(pdo_qr($sql) as $temp){
            if($temp["ma_km"] == $ma_km){
                return " * Mã khuyến mãi đã tồn tại";
            }
        }
    }

    function validation_makm_update($ma_km,$id){
        if($ma_km == 0){
            return " * Mã khuyến mãi không hợp lệ";
        }elseif(empty($ma_km)){
            return " * Mã khuyến mãi không được bỏ trống";
        }elseif(preg_match("/[ ]/", $ma_km)){
            return " * Mã khuyến mãi không được chứa dấu cách";
        }elseif(strlen($ma_km) < 8 || strlen($ma_km)> 50){
            return " * Độ dài không hợp lệ";
        }

        $sql = "SELECT ma_km FROM khuyen_mai WHERE id_km <> $id";
        foreach(pdo_qr($sql) as $temp){
            if($temp["ma_km"] == $ma_km){
                return " * Mã khuyến mãi đã tồn tại";
            }
        }
    }

    // if($_SERVER["REQUEST_METHOD"] == "POST"){

    //     // add khuyen mai
    //     if(isset($_POST["addkm"]) && !empty($_POST["addkm"])){
    //         $check = true;
    
    //         // ma km
    //         $maErr = validation_makm($_POST["ma_km"]);
    //         if(!empty($maErr)) $check = false;
    
    //         // ngay bd
    //         $ngaybdErr = validation_date($_POST["ngaybd_km"]);
    //         if(!empty($ngaybdErr)) $check = false;
    
    //         // ngay kt
    //         $ngayktErr = validation_date($_POST["ngaykt_km"]);
    //         if(!empty($ngayktErr)) $check = false;
    
    //         // so sanh ngay
    //         if($_POST["ngaybd_km"] > $_POST["ngaykt_km"]){
    //             $check = false;
    //             $ngaybdErr = " * Ngày bắt đầu không hợp lệ";
    //         }
    
    //         // phantram
    //         if(empty($_POST["phantram_km"])){
    //             $phantramErr = " * Không được bỏ trống";
    //             $check = false;
    //         }elseif($_POST["phantram_km"] < 0 || $_POST["phantram_km"] >100){
    //             $phantramErr = " * Giá trị không hợp lệ";
    //             $check = false;
    //         }
    
    //         if($check){
    //             if($_POST["ngaybd_km"] > $_POST["ngaykt_km"]){
    //                 $message = '<div class="alert alert-danger" role="alert">
    //                                 <strong>Sai ngày</strong>
    //                             </div>';
    //             }else{
    //                 add_km($_POST["ma_km"],$_POST["phantram_km"],$_POST["ngaybd_km"],$_POST["ngaykt_km"]);
    //                 $message = '<div class="alert alert-danger" role="alert">
    //                                 <strong>Thêm mã thành công</strong>
    //                             </div>';
    //                 unset($_POST["ma_km"],$_POST["phantram_km"],$_POST["ngaybd_km"],$_POST["ngaykt_km"]);
    //             }
    //         }
    //     }
    
    //     // update khuyen mai
    //     if(isset($_POST["updatekm"]) && !empty($_POST["updatekm"])){
    //         $list = list_km($_GET["id"]);
    //         $check = true;
    
    //         // ma km
    //         $maErr = validation_makm_update($_POST["ma_km"],$list["id_km"]);
    //         if(!empty($maErr)) $check = false;
    
    //         // ngay bd
    //         $ngaybdErr = validation_date($_POST["ngaybd_km"]);
    //         if(!empty($ngaybdErr)) $check = false;
    
    //         // ngay kt
    //         $ngayktErr = validation_date($_POST["ngaykt_km"]);
    //         if(!empty($ngayktErr)) $check = false;
    
    //         // so sanh ngay
    //         if($_POST["ngaybd_km"] > $_POST["ngaykt_km"]){
    //             $check = false;
    //             $ngaybdErr = " * Ngày bắt đầu không hợp lệ";
    //         }
    
    //         // phantram
    //         if(empty($_POST["phantram_km"])){
    //             $phantramErr = " * Không được bỏ trống";
    //             $check = false;
    //         }elseif($_POST["phantram_km"] < 0 || $_POST["phantram_km"] >100){
    //             $phantramErr = " * Giá trị không hợp lệ";
    //             $check = false;
    //         }
    
    //         if($check){
    //             if($_POST["ngaybd_km"] > $_POST["ngaykt_km"]){
    //                 $message = '<div class="alert alert-danger" role="alert">
    //                                 <strong>Sai ngày</strong>
    //                             </div>';
    //             }else{
    //                 update_km($list["id_km"],$_POST["ma_km"],$_POST["phantram_km"],$_POST["ngaybd_km"],$_POST["ngaykt_km"]);
    //                 $message = '<div class="alert alert-danger" role="alert">
    //                                 <strong>Cập nhật mã thành công</strong>
    //                             </div>';
    //                 unset($_POST["ma_km"],$_POST["phantram_km"],$_POST["ngaybd_km"],$_POST["ngaykt_km"]);
    //             }
    //         }
    //     }
    // }
?>