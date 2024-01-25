<?php
    function list_banner($id){
        if(empty($id)){
            $sql = "SELECT * FROM banner";
            return pdo_qr($sql);
        }else{
            $sql = "SELECT * FROM banner WHERE id_banner = $id";
            return pdo_qr_one($sql);
        }
    }

    function list_banner_search($trangthai_banner){
        $sql = "SELECT * FROM banner WHERE 1";

        if($trangthai_banner == 1){
            $sql .= " AND trangthai_banner = 1";
        }

        if($trangthai_banner == 2){
            $sql .= " AND trangthai_banner = 2";
        }

        return pdo_qr($sql);
    }

    function delete_banner($id){
        $sql = "SELECT * FROM banner WHERE id_banner = $id";
        $temp = pdo_qr_one($sql);
        delete_img($temp["anh_banner"],"anhsanpham");

        $sql = "DELETE FROM banner WHERE id_banner = $id";
        pdo_exe($sql);
    }

    function delete_banner_sl($arr){
        foreach($arr as $id){
            delete_banner($id);
        }
    }

    function add_banner($anh_banner,$link_banner,$mota_banner,$trangthai_banner){
        $sql = "INSERT INTO banner(anh_banner,link_banner,mota_banner,trangthai_banner) VALUES ('$anh_banner','$link_banner','$mota_banner',$trangthai_banner)";
        pdo_exe($sql);
    }

    function update_banner($id_banner,$anh_banner,$link_banner,$mota_banner,$trangthai_banner){ 
        $sql = "UPDATE banner SET
                anh_banner = '$anh_banner',
                link_banner = '$link_banner',
                mota_banner = '$mota_banner',
                trangthai_banner = '$trangthai_banner'
                WHERE id_banner = $id_banner";
        pdo_exe($sql);
    }

    function turn_banner($id){
        $sql = "UPDATE banner SET trangthai_banner = 
                CASE 
                    WHEN trangthai_banner = 1 THEN 2 
                    WHEN trangthai_banner = 2 THEN 1
                    ELSE trangthai_banner
                END
                WHERE id_banner = $id";
        pdo_exe($sql);
    }

    // if($_SERVER["REQUEST_METHOD"] == "POST"){

    //     // add banner
    //     if(isset($_POST["addbn"]) && !empty($_POST["addbn"])){
    //         $check = true;
    
    //         // anh
    //         if($_FILES["anh_banner"]["size"] == 0){
    //             // do khi gui thi co anh hay k thi FILES van khoi tao 1 file chua anh
    //             $check = false;
    //             $anhErr = " * Ảnh không được bỏ trống";
    //         }else{
    //             $anhErr = validation_img($_FILES["anh_banner"]);
    //             if(!empty($anhErr)) $check = false;
    //         }
    
    //         // link banner
    //         if($_POST["link_banner"] == 0){
    //             $linkErr = " * Sai đường dẫn";
    //             $check = false;
    //         }elseif(empty($_POST["link_banner"])){
    //             $linkErr = " * Link không được bỏ trống";
    //             $check = false;
    //         }
    
    //         // mo ta co duoc khong co duoc
    
    //         // trang thai
    //         $trangthaiErr = validation_select($_POST["trangthai_banner"]);
    //         if(!empty($trangthaiErr)) $check = false;
    
    //         if($check){
    //             $tmp = __DIR__ . "./../../../public/image/anhsanpham/";
    //             $anh_banner = time() . $_FILES["anh_banner"]["name"] ;
                    
    //             if(move_uploaded_file($_FILES["anh_banner"]["tmp_name"], $tmp . $anh_banner)){
    //                 add_banner($anh_banner,$_POST["link_banner"],$_POST["mota_banner"],$_POST["trangthai_banner"]);
    //                 $message = '<div class="alert alert-success" role="alert">
    //                                 <strong>Thêm banner thành công!</strong>
    //                             </div>';
    //                 unset($anh_banner,$_POST["link_banner"],$_POST["mota_banner"],$_POST["tranngthai_banner"]);
    //             }else{
    //                 $message = '<div class="alert alert-danger" role="alert">
    //                                 <strong>Thêm ảnh không thành công!</strong>
    //                             </div>';
    //             }
    //         }
    //     }
            
    //     // update banner
    //     if(isset($_POST["updatebn"]) && !empty($_POST["updatebn"])){
    //         $list = list_banner($_GET["id"]);
    //         $check = true;
    
    //         // anh
    //         if($_FILES["anh_banner"]["size"] !== 0){
    //             // co anh
    //             $bool = true;
    //             $anhErr = validation_img($_FILES["anh_banner"]);
    //             if(!empty($anhErr)) $check = false;
    //         }else{
    //             // k co anh
    //             $bool = false;
    //         }
    
    //         // link banner
    //         if($_POST["link_banner"] == 0){
    //             $linkErr = " * Sai đường dẫn";
    //             $check = false;
    //         }elseif(empty($_POST["link_banner"])){
    //             $linkErr = " * Link không được bỏ trống";
    //             $check = false;
    //         }
    
    //         // trang thai
    //         $trangthaiErr = validation_select($_POST["trangthai_banner"]);
    //         if(!empty($trangthaiErr)) $check = false;
    
    //         if($check){
    //             if($bool){
    //                 $tmp = __DIR__ . "./../../../public/image/anhsanpham/";
    //                 $anh_banner = time() . $_FILES["anh_banner"]["name"] ;
                    
    //                 if(move_uploaded_file($_FILES["anh_banner"]["tmp_name"], $tmp . $anh_banner)){
    //                     update_banner($list["id_banner"],$anh_banner,$_POST["link_banner"],$_POST["mota_banner"],$_POST["trangthai_banner"]);
    //                     $message = '<div class="alert alert-success" role="alert">
    //                                     <strong>Cập nhật banner thành công!</strong>
    //                                 </div>';
    //                     delete_img($list["anh_banner"],"anhsanpham");    
    //                 }else{
    //                     $message = '<div class="alert alert-danger" role="alert">
    //                                     <strong>Cập nhật ảnh không thành công!</strong>
    //                                 </div>';
    //                 }
                        
    //             }else{
    //                 // k co anh
    //                 $anh_banner = $list["anh_banner"];
    //                 update_banner($list["id_banner"],$anh_banner,$_POST["link_banner"],$_POST["mota_banner"],$_POST["trangthai_banner"]);
    //                 $message = '<div class="alert alert-success" role="alert">
    //                                 <strong>Cập nhật thành công!</strong>
    //                             </div>';
    //             }
    //             unset($list["id_banner"],$anh_banner,$_POST["link_banner"],$_POST["mota_banner"],$_POST["trangthai_banner"]);
    //         }
    //     }
    // }
?>