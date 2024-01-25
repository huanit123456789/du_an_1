<?php
    function list_kh($id){
        if(empty($id)){
            $sql = "SELECT * FROM nguoi_dung INNER JOIN chuc_vu ON chuc_vu.id_cv = nguoi_dung.id_cv WHERE nguoi_dung.id_cv = 3";
            return pdo_qr($sql);
        }else{
            $sql = "SELECT * FROM nguoi_dung INNER JOIN chuc_vu ON chuc_vu.id_cv = nguoi_dung.id_cv WHERE nguoi_dung.id_nd = $id";
            return pdo_qr_one($sql);  
        }
    }

    function add_kh($ten_nd,$anh_nd,$sdt_nd,$ngaysinh_nd,$diachi_nd,$email_nd,$mk_nd){
        $sql = "INSERT INTO nguoi_dung(ten_nd,anh_nd,sdt_nd,ngaysinh_nd,diachi_nd,email_nd,mk_nd,id_cv) VALUES ('$ten_nd','$anh_nd','$sdt_nd','$ngaysinh_nd','$diachi_nd','$email_nd','$mk_nd',3)";
        pdo_exe($sql);
    }

    function update_kh($id_nd,$ten_nd,$anh_nd,$sdt_nd,$ngaysinh_nd,$diachi_nd,$mk_nd){   
        $sql = "UPDATE `nguoi_dung` SET 
            `ten_nd` = '$ten_nd',
            `anh_nd` = '$anh_nd',
            `sdt_nd` = '$sdt_nd',
            `ngaysinh_nd` = '$ngaysinh_nd',
            `diachi_nd` = '$diachi_nd',
            `mk_nd` = '$mk_nd'
            WHERE `id_nd` = $id_nd";

        pdo_exe($sql);
    }

    function delete_kh($id){
        $sql = "DELETE FROM binh_luan WHERE id_nd = $id";
        pdo_exe($sql);
        $temp = list_kh($id);
        delete_img($temp["anh_nd"],"anhnguoidung");
        $sql = "DELETE FROM nguoi_dung WHERE id_nd = " . $id;
        pdo_exe($sql);
       
    }

    function delete_kh_sl($arr){
        foreach($arr as $id){
            delete_kh($id);
        }
    }

    // if($_SERVER["REQUEST_METHOD"] == "POST"){

    //     // add khach hang
    //     if(isset($_POST["addkh"]) && !empty($_POST["addkh"])){
    //         $check = true;
    
    //         $tenErr = validation_name($_POST["ten_nd"]);
    //         if(!empty($tenErr)) $check = false;
    
    //         // anh
    //         if($_FILES["anh_nd"]["size"] == 0){
    //             $anhErr = " * Không được bỏ trống ảnh";
    //             $check = false;
    //         }else{
    //             $anhErr = validation_img($_FILES["anh_nd"]);
    //             if(!empty($anhErr)) $check = false;
    //         }
    
    //         // email
    //         $emailErr = validation_email($_POST["email_nd"]);
    //         if(!empty($emailErr)) $check = false;
    
    //         // pass
    //         $passErr = validation_pass($_POST["mk_nd"]);
    //         if(!empty($passErr)) $check = false;
    
    //         // ngaysinh
    //         $dateErr = validation_date_birthday($_POST["ngaysinh_nd"]);
    //         if(!empty($dateErr)) $check = false;
    
    //         // sdt
    //         $phoneErr = validation_phone($_POST["sdt_nd"]);
    //         if(!empty($phoneErr)) $check = false;
    
    //         // dia chi
    //         $adressErr = validation_adress($_POST["diachi_nd"]);
    //         if(!empty($adressErr)) $check = false;
    
    //         if($check){
    //             $tmp = __DIR__ . "./../../../public/image/anhnguoidung/";
    //             $anh_nd = time() . $_FILES["anh_nd"]["name"] ;
                    
    //             if(move_uploaded_file($_FILES["anh_nd"]["tmp_name"], $tmp . $anh_nd)){
    //                 add_kh(trim($_POST["ten_nd"]),$anh_nd,trim($_POST["sdt_nd"]),$_POST["ngaysinh_nd"],trim($_POST["diachi_nd"]),$_POST["email_nd"],$_POST["mk_nd"]);
    //                 $message = '<div class="alert alert-success" role="alert">
    //                                 <strong>Thêm thành công!</strong>
    //                             </div>';
    //                 unset($_POST["ten_nd"],$anh_nd,$_POST["sdt_nd"],$_POST["ngaysinh_nd"],$_POST["diachi_nd"],$_POST["email_nd"],$_POST["mk_nd"]);
    //             }else{
    //                 $message = '<div class="alert alert-danger" role="alert">
    //                                 <strong>Thêm ảnh không thành công!</strong>
    //                             </div>';
    //             }
    //         }
    //     }
    
    //     // update khach hang
    //     if(isset($_POST["updatekh"]) && !empty($_POST["updatekh"])){
    //         $list = list_kh($_GET["id"]);
    //         $check = true;
    
    //         // ten
    //         $tenErr = validation_name($_POST["ten_nd"]);
    //         if(!empty($tenErr)) $check = false;
    
    //         // anh
    //         if($_FILES["anh_nd"]["size"] !== 0){
    //             // co anh
    //             $bool = true;
    //             $anhErr = validation_img($_FILES["anh_nd"]);
    //             if(!empty($anhErr)) $check = false;
    //         }else{
    //             // k co anh
    //             $bool = false;
    //         }
                
    //         // mat khau
    //         $passErr = validation_pass($_POST["mk_nd"]);
    //         if(!empty($passErr)) $check = false;
    
    //         // ngay sinh
    //         $dateErr = validation_date($_POST["ngaysinh_nd"]);
    //         if(!empty($dateErr)) $check = false;
    
    //         // sdt
    //         $phoneErr = validation_phone_update($_POST["sdt_nd"],$_GET["id"]);
    //         if(!empty($phoneErr)) $check = false;
    
    //         // dia chi
    //         $adressErr = validation_adress($_POST["diachi_nd"]);
    //         if(!empty($adressErr)) $check = false;
    
    //         if($check){
    //             // co anh
    //             if($bool){
    //                 $tmp = __DIR__ . "./../../../public/image/anhnguoidung/";
    //                 $anh_nd = time() . $_FILES["anh_nd"]["name"] ;
                    
    //                 if(move_uploaded_file($_FILES["anh_nd"]["tmp_name"], $tmp . $anh_nd)){
    //                     update_kh($_GET["id"],trim($_POST["ten_nd"]),$anh_nd,trim($_POST["sdt_nd"]),$_POST["ngaysinh_nd"],trim($_POST["diachi_nd"]),$_POST["mk_nd"]);
    //                     $message = '<div class="alert alert-success" role="alert">
    //                                     <strong>Cập nhật thành công!</strong>
    //                                 </div>';
    //                     delete_img($list["anh_nd"],"anhnguoidung");
                            
    //                 }else{
    //                     $message = '<div class="alert alert-danger" role="alert">
    //                                     <strong>Cập nhật ảnh không thành công!</strong>
    //                                 </div>';
    //                 }    
    //             }else{
    //                 // k co anh
    //                 $anh_nd = $list["anh_nd"];
    //                 update_kh($_GET["id"],$_POST["ten_nd"],$anh_nd,$_POST["sdt_nd"],$_POST["ngaysinh_nd"],$_POST["diachi_nd"],$_POST["mk_nd"]);
    //                 $message = '<div class="alert alert-success" role="alert">
    //                                 <strong>Cập nhật thành công!</strong>
    //                             </div>';
    //             }
    //             unset($_POST["ten_nd"],$anh_nd,$_POST["sdt_nd"],$_POST["ngaysinh_nd"],$_POST["diachi_nd"],$_POST["mk_nd"]);
    //         }
    //     }

    //         // dang ky
    //         // if(isset($_POST["dangky"]) && !empty($_POST["dangky"])){
    //         //     $check = true;
        
    //         //     $tenErr = validation_name($_POST["ten_nd"]);
    //         //     if(!empty($tenErr)) $check = false;
        
    //         //     // anh
    //         //     if($_FILES["anh_nd"]["size"] == 0){
    //         //         $anhErr = " * Không được bỏ trống ảnh";
    //         //         $check = false;
    //         //     }else{
    //         //         $anhErr = validation_img($_FILES["anh_nd"]);
    //         //         if(!empty($anhErr)) $check = false;
    //         //     }
        
    //         //     // email
    //         //     $emailErr = validation_email($_POST["email_nd"]);
    //         //     if(!empty($emailErr)) $check = false;
        
    //         //     // pass
    //         //     $passErr = validation_pass($_POST["mk_nd"]);
    //         //     if(!empty($passErr)) $check = false;

    //         //     if($check){
    //         //         $tmp = __DIR__ . "./../../../public/image/anhnguoidung/";
    //         //         $anh_nd = time() . $_FILES["anh_nd"]["name"] ;
                        
    //         //         if(move_uploaded_file($_FILES["anh_nd"]["tmp_name"], $tmp . $anh_nd)){
    //         //             add_kh(trim($_POST["ten_nd"]),$anh_nd,"","","",$_POST["email_nd"],$_POST["mk_nd"]);
    //         //             $message = '<div class="alert alert-success" role="alert">
    //         //                             <strong>Đăng ký thành công thành công!</strong>
    //         //                         </div>';
    //         //             unset($_POST["ten_nd"],$anh_nd,$_POST["email_nd"],$_POST["mk_nd"]);
    //         //         }else{
    //         //             $message = '<div class="alert alert-danger" role="alert">
    //         //                             <strong>Thêm ảnh không thành công!</strong>
    //         //                         </div>';
    //         //             }
    //         //         }
    //         // }
    // }
?>