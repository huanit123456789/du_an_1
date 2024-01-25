<?php
    function list_shop($id){
        if(empty($id)){
            $sql = "SELECT * FROM shop";
            return pdo_qr($sql);
        }else{
            $sql = "SELECT * FROM shop WHERE id_shop = $id";
            return pdo_qr_one($sql);
        }
    }

    function update_shop($id_shop,$sdt_shop,$email_shop,$diachi_shop,$anh_shop){
        $sql = "UPDATE `shop` SET 
                sdt_shop = '$sdt_shop',
                email_shop = '$email_shop',
                diachi_shop = '$diachi_shop',
                anh_shop = '$anh_shop'
                WHERE id_shop = $id_shop";
        pdo_exe($sql);
    }

    // if($_SERVER["REQUEST_METHOD"] == "POST"){
    //     // update
    //     if(isset($_POST["shop"]) && !empty($_POST["shop"])){
            
    //         $list = list_shop($_GET["id"]);
    //         $check = true;
    
    
    //         // anh
    //         if($_FILES["anh_shop"]["size"] != 0){
    //             // co anh
    //             $bool = true;
    //             $anhErr = validation_img($_FILES["anh_shop"]);
    //             if(!empty($anhErr)) $check = false;
    //         }else{
    //             // k co anh
    //             $bool = false;
    //         }
    
    //         // sdt
    //         if(empty($_POST["sdt_shop"])){
    //             $check = false;
    //             $sdtErr = " * Số điện thoại không được bỏ trống";
    //         }elseif(strlen($_POST["sdt_shop"]) > 20 || strlen($_POST["sdt_shop"]) < 8 ){
    //             $check = false;
    //             $sdtErr = " * Độ dài điện thoại không đúng";
    //         }elseif(!preg_match("/^[0-9]+$/", $_POST["sdt_shop"])){
    //             $check = false;
    //             $sdtErr = " * Sai định dạng số điện thoại";
    //         }
    
    //         // email
    //         if(empty($_POST["email_shop"])){
    //             $emailErr =  " * Email không được bỏ trống";
    //             $check = false;
    //         }elseif(!filter_var($_POST["email_shop"],FILTER_VALIDATE_EMAIL)){
    //             $emailErr = " * Email không đúng định dạng";
    //             $check = false;
    //         }elseif(strlen($_POST["email_shop"]) > 100){
    //             $emailErr = " * Độ dài Email không vượt quá 100 ký tự";
    //             $check = false;
    //         }
          
    //         // dia chi
    //         if(empty($_POST["diachi_shop"])){
    //             $diachiErr =  " * Địa chỉ không được bỏ trống";
    //             $check = false;
    //         }

    //         if($check){
    //             if($bool){
    //                 $tmp = __DIR__ . "./../../../public/image/anhsanpham/";
    //                 $anh_shop = time() . $_FILES["anh_shop"]["name"] ;
                    
    //                 if(move_uploaded_file($_FILES["anh_shop"]["tmp_name"], $tmp . $anh_shop)){
    //                     update_shop($list["id_shop"],$_POST["sdt_shop"],$_POST["email_shop"],$_POST["diachi_shop"],$anh_shop);
    //                     $message = '<div class="alert alert-success" role="alert">
    //                                     <strong>Cập nhật địa chỉ thành công!</strong>
    //                                 </div>';
    //                     delete_img($list["anh_shop"],"anhsanpham");
    //                 }else{
    //                     $message = '<div class="alert alert-danger" role="alert">
    //                                     <strong>Cập nhật ảnh không thành công!</strong>
    //                                 </div>';
    //                 }
                        
    //             }else{
    //                 // k co anh
    //                 $anh_shop = $list["anh_shop"];
    //                 update_shop($list["id_shop"],$_POST["sdt_shop"],$_POST["email_shop"],$_POST["diachi_shop"],$anh_shop);
    //                 $message = '<div class="alert alert-success" role="alert">
    //                                 <strong>Cập nhật địa chỉ thành công!</strong>
    //                             </div>';
    //             }
    //             unset($_POST["sdt_shop"],$_POST["email_shop"],$_POST["diachi_shop"],$anh_shop);
    //         }
    //     }
    // }
?>