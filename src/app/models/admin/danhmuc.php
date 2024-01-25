<?php

    // trigger cap nhat trang thai 1 cua san pham khi update 1 danh muc

    // =======================UPDATE=======================================
        // CREATE TRIGGER capnhat_trangthai1_sp AFTER UPDATE ON danh_muc
        // FOR EACH ROW
        // BEGIN
        //     UPDATE san_pham
        //     SET trangthai1_sp = NEW.trangthai_dm
        //     WHERE san_pham.id_dm = NEW.id_dm;
        // END;;
    // =====================================================================


    function list_dm($id){
        if(empty($id)){
            $sql = "SELECT * FROM danh_muc";
            return pdo_qr($sql);
        }else{
            $sql = "SELECT * FROM danh_muc WHERE id_dm = " . $id;
            return pdo_qr_one($sql);
        }
    }

    function list_dm_search($trangthai_dm,$ten_dm){
        $sql = "SELECT * FROM danh_muc WHERE 1";

        if($trangthai_dm == 1){
            $sql .= " AND trangthai_dm = 1";
        }
        
        if($trangthai_dm == 2){
            $sql .= " AND trangthai_dm = 2";
        }

        if($ten_dm != ""){
            $sql .= " AND ten_dm LIKE '%". $ten_dm ."%'";
        }

        return pdo_qr($sql);
    }

    function delete_dm($id){
   
        $sql = "SELECT san_pham.id_sp, san_pham.trangthai3_sp FROM san_pham inner join danh_muc ON danh_muc.id_dm = san_pham.id_dm WHERE danh_muc.id_dm = $id";
        $listsp = pdo_qr($sql);

            
        foreach($listsp as $temp){
            if($temp["trangthai3_sp"] == 1){
                return "
                    <script>
                        alert('Không xóa được sản phẩm thuộc danh mục đang có trong đơn hàng');
                        window.location.href = `index.php?act=dm&type=list`;
                    </script>
                ";
                }
            }

            foreach($listsp as $temp){
                delete_sp($temp["id_sp"]);
            }

            $listdm = list_dm($id);
            delete_img($listdm["anh_dm"],"anhsanpham");

            $sql = "DELETE FROM danh_muc WHERE id_dm = " . $id;
            pdo_exe($sql);
    }

    function add_dm($ten_dm,$anh_dm,$trangthai_dm){
        $sql = "INSERT INTO danh_muc(ten_dm,anh_dm,trangthai_dm) VALUES ('$ten_dm','$anh_dm','$trangthai_dm')";
        pdo_exe($sql);
    }

    // NEU TAT BAT THI SE CAO NHAT TRANG THAI CUA SAN PHAM ==> DUNG O TRIIGER ROI CON NEU SAN PHAM DANG TON TAI O SESSION GIO HANG THI CHUA TIM CAC FIC DUOC 
    function update_dm($id_dm,$ten_dm,$anh_dm,$trangthai_dm){ 
        $sql = "UPDATE danh_muc SET 
            `ten_dm` = '$ten_dm',
            `trangthai_dm` = $trangthai_dm,
            `anh_dm` = '$anh_dm'
            WHERE `id_dm` = $id_dm";
        pdo_exe($sql);
    }

    function validation_ten_dm($name){
        $name = trim($name);
        $temp = validation_name($name);

        if(empty($temp)){
            $sql = "SELECT ten_dm FROM danh_muc";
            foreach(pdo_qr($sql) as $temp){
                if($temp["ten_dm"] == $name){
                    return " * Danh mục đã tồn tại";
                }
            }
        }else{
            return $temp;
        }
    }

    function validation_ten_dm_update($name,$id){
        $name = trim($name);
        $temp = validation_name($name);

        if(empty($temp)){
            $sql = "SELECT ten_dm FROM danh_muc WHERE id_dm <> " . $id;
            foreach(pdo_qr($sql) as $temp){
                if($temp["ten_dm"] == $name){
                    return " * Danh mục đã tồn tại";
                }
            }
        }else{
            return $temp;
        }
    }

    // if($_SERVER["REQUEST_METHOD"] == "POST"){

    //     // add dm
    //     if(isset($_POST["adddm"]) && !empty($_POST["adddm"])){
    //         $check = true;
    //         // ten
    //         $tenErr = validation_ten_dm($_POST["ten_dm"]);
    //         if(!empty($tenErr)) $check = false;

    //         // anh
    //         if($_FILES["anh_dm"]["size"] == 0){
    //             // do khi gui thi co anh hay k thi FILES van khoi tao 1 file chua anh
    //             $check = false;
    //             $anhErr = " * Ảnh không được bỏ trống";
    //         }else{
    //             $anhErr = validation_img($_FILES["anh_dm"]);
    //             if(!empty($anhErr)) $check = false;     
    //         }
    
    //         // select
    //         $selectErr = validation_select($_POST["trangthai_dm"]);
    //         if(!empty($selectErr)) $check = false;
    
    //         if($check){
    //             $tmp = __DIR__ . "./../../../public/image/anhsanpham/";
    //             $anh_dm = time() . $_FILES["anh_dm"]["name"] ;
                    
    //             if(move_uploaded_file($_FILES["anh_dm"]["tmp_name"], $tmp . $anh_dm)){
    //                 add_dm(trim($_POST["ten_dm"]),$anh_dm,$_POST["trangthai_dm"]);
    //                 $message = '<div class="alert alert-success" role="alert">
    //                                 <strong>Thêm thành công!</strong>
    //                             </div>';
    //                 unset($_POST["ten_dm"],$anh_dm,$_POST["trangthai_dm"]);
    //             }else{
    //                 $message = '<div class="alert alert-danger" role="alert">
    //                                 <strong>Thêm ảnh không thành công!</strong>
    //                             </div>';
    //             }
    //         }
    //     }
    
    //     // update dm
    //     if(isset($_POST["updatedm"]) && !empty($_POST["updatedm"])){
    //         $list = list_dm($_GET["id"]);
    
    //         $check = true;
    //         // ten
    
    //         $tenErr = validation_ten_dm_update($_POST["ten_dm"],$list["id_dm"]);
    //         if(!empty($tenErr)) $check = false;

    //         // anh
    //         if($_FILES["anh_dm"]["size"] !== 0){
    //             // co anh
    //             $bool = true;
    //             $anhErr = validation_img($_FILES["anh_dm"]);
    //             if(!empty($anhErr)) $check = false;
    //         }else{
    //             // k co anh
    //             $bool = false;
    //         }
    
    //         // select
    //         $selectErr = validation_select($_POST["trangthai_dm"]);
    //         if(!empty($selectErr)) $check = false;
    
    //         if($check){
    //             // co anh
    //             if($bool){
    //                 $tmp = __DIR__ . "./../../../public/image/anhsanpham/";
    //                 $anh_dm = time() . $_FILES["anh_dm"]["name"] ;
                
    //                 if(move_uploaded_file($_FILES["anh_dm"]["tmp_name"], $tmp . $anh_dm)){
    //                     update_dm($list["id_dm"],trim($_POST["ten_dm"]),$anh_dm,$_POST["trangthai_dm"]);
    //                     $message = '<div class="alert alert-success" role="alert">
    //                                     <strong>Cập nhật thành công!</strong>
    //                                 </div>';
    //                     delete_img($list["anh_dm"],"anhsanpham");
                        
    //                 }else{
    //                     $message = '<div class="alert alert-danger" role="alert">
    //                                     <strong>Cập nhật ảnh không thành công!</strong>
    //                                 </div>';
    //                 }
    //             }else{
    //                 // k co anh
    //                 $anh_dm = $list["anh_dm"];
    //                 update_dm($list["id_dm"],trim($_POST["ten_dm"]),$anh_dm,$_POST["trangthai_dm"]);
    //                 $message = '<div class="alert alert-success" role="alert">
    //                                 <strong>Cập nhật thành công!</strong>
    //                             </div>';
    //             }
    //             unset($_POST["ten_dm"],$anh_dm,$_POST["trangthai_dm"]);
    //         }
    //     }
    // }

?>