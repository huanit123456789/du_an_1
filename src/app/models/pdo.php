<?php
// thu vien chung:
// cac ham thao truy van, thuc hien
// cac ham validate, cac ham chung


// =================HAM SQL========================
require_once __DIR__ . "./../../config.php";


function pdo_exe($sql){
    $sql_args=array_slice(func_get_args(),1);
    try{
        $conn=pdo_get_connection();
        $stmt=$conn->prepare($sql);
        $stmt->execute($sql_args);
    
    }
    catch(PDOException $e){
        throw $e;
        die();
    }
    finally{
        unset($conn);
    }
}


function pdo_qr($sql){
    $sql_args=array_slice(func_get_args(),1);
    
    try{
        $conn=pdo_get_connection();
        $stmt=$conn->prepare($sql);
        $stmt->execute($sql_args);
        // mang da chieu, cach thuc lay du lieu theo kieu nao
        $rows=$stmt->fetchAll();
        return $rows;
    }
    catch(PDOException $e){
        throw $e;
        die();
    }
    finally{
        unset($conn);
    }
}


function pdo_qr_one($sql){
    $sql_args=array_slice(func_get_args(),1);
        try{
            $conn=pdo_get_connection();
            $stmt=$conn->prepare($sql);
            $stmt->execute($sql_args);
            $row=$stmt->fetch(PDO::FETCH_ASSOC);
            // đọc và hiển thị giá trị trong danh sách trả về
            return $row;
            // tuong duong stmt[0];
    }
    catch(PDOException $e){
        throw $e;
        die();
    }
    finally{
        unset($conn);
    }
}


//HAM VALIDATE
function validation_name($name){
    // Loại bỏ khoảng trắng ở đầu và cuối chuỗi
    $name = trim($name);

    if($name == 0){

    }elseif(empty($name)){
        return " * Tên không được bỏ trống";
    }

    // if(strlen($name) > 50){
    //     return " * Độ dài tên không vượt quá 50 ký tự";
    // }
}

function validation_email($email){
    if($email == 0){

    }elseif(empty($email)){
        return " * Email không được bỏ trống";
    }

    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        return " * Email không đúng định dạng";
    }

    if(strlen($email) > 100){
        return " * Độ dài Email không vượt quá 100 ký tự";
    }

    $sql = "SELECT email_nd FROM nguoi_dung";
    foreach(pdo_qr($sql) as $temp){
        if($email == $temp["email_nd"]){
            return " * Email đã tồn tại";
        }
    } 
}

// function validation_email_update($email,$id){
//     if($email == 0){

//     }elseif(empty($email)){
//         return " * Email không được bỏ trống";
//     }

//     if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
//         return " * Email không đúng định dạng";
//     }

//     if(strlen($email) > 100){
//         return " * Độ dài Email không vượt quá 100 ký tự";
//     }

//     $sql = "SELECT email_nd FROM nguoi_dung WHERE id_nd <> " . $id;
//     foreach(pdo_qr($sql) as $temp){
//         if($email == $temp["email_nd"]){
//             return " * Email đã tồn tại";
//         }
//     } 
// }

function validation_pass($pass){
    // Kiểm tra độ dài của mật khẩu (ít nhất 8 ký tự)
    if (strlen($pass) < 8) {
        return " * Mật khẩu phải có ít nhất 8 ký tự";
    }

    if (preg_match("/[ ]/", $pass)) {
        return " * Mật khẩu không được chứa dấu cách";
    }
    
    // Kiểm tra xem mật khẩu có chứa ít nhất một chữ hoa
    if (!preg_match("/[A-Z]/", $pass)) {
        return " * Mật khẩu phải chứa ít nhất một chữ hoa";
    }
    
    // Kiểm tra xem mật khẩu có chứa ít nhất một chữ thường
    if (!preg_match("/[a-z]/", $pass)) {
        return  " * Mật khẩu phải chứa ít nhất một chữ thường";
    }
    
    // Kiểm tra xem mật khẩu có chứa ít nhất một số
    if (!preg_match("/[0-9]/", $pass)) {
        return " * Mật khẩu phải chứa ít nhất một số";
    }
}

function validation_select($select){
    if($select !== "1" && $select !== "2"){
        return " * Không được sửa mã nguồn";
    }
}

function validation_phone($phone){
    if(empty($phone)){
        return " * Số điện thoại không được bỏ trống";
    }

    if(strlen($phone) > 20 || strlen($phone) < 8 ){
        return " * Độ dài điện thoại không đúng";
    }

    if(!preg_match("/^[0-9]+$/", $phone)){
        return " * Sai định dạng số điện thoại";
    }

    $sql = "SELECT sdt_nd FROM nguoi_dung";
    foreach(pdo_qr($sql) as $temp){
        if($phone == $temp["sdt_nd"]){
            return " * Số điện thoại đã có người dùng";
        }
    } 
}

function validation_phone_update($phone,$id){
    if(empty($phone)){
        return " * Số điện thoại không được bỏ trống";
    }

    if(strlen($phone) > 20 || strlen($phone) < 8 ){
        return " * Độ dài điện thoại không đúng";
    }

    if(!preg_match("/^[0-9]+$/", $phone)){
        return " * Sai định dạng số điện thoại";
    }

    $sql = "SELECT sdt_nd FROM nguoi_dung WHERE id_nd <> " . $id;
    foreach(pdo_qr($sql) as $temp){
        if($phone == $temp["sdt_nd"]){
            return " * Số điện thoại đã có người dùng";
        }
    } 
} 

function validation_date($date){
    if(empty($date)){
        return " * Không được bỏ trống ngày sinh";
    }
    // explode(): Hàm này cắt chuỗi thành một mảng dựa trên một ký tự phân tách.
    // $date = explode("-",$date);
    // $temp = date("Y m d");
    // $temp = explode(" ",$temp);
    
    // if($date[0] > $temp[0]){
    //     return " * Ngày tháng năm không đúng";
    // }
}

function validation_date_birthday($date){
    $check = validation_date($date);

    if(!empty($check)){
        return $check;
    }

    if($date > date("Y-m-d")){
        return " * Ngày sinh không đúng";
    }else{
        // Ngày tháng năm đầu tiên
        $date = new DateTime("$date");

        // Ngày tháng năm thứ hai
        $check = new DateTime(date("Y-m-d"));

        // $khoangcach = $check->diff($date);

        // Tính khoảng cách
        // '%a ngày, %h giờ, %i phút, %s giây' thay vì '%a ngày'.
        if ($check->diff($date)->y < 18) {
            return " * Chưa đủ 18 tuổi";
        }
    }
}

function validation_adress($adress){
    if($adress == 0){
       
    }elseif(empty($adress)){
        return " * Địa chỉ không được bỏ trống";
    }


}

function validation_img($img){
    // getimagesize là một hàm trong PHP được sử dụng để lấy thông tin về kích thước và các 
    // thông số liên quan của một hình ảnh. Hàm này trả về một mảng chứa chiều rộng, chiều cao, loại hình
    //  ảnh và chuỗi có chứa chiều rộng và chiều cao từ đường dẫn của ảnh
    if(!getimagesize($img["tmp_name"])){
        return " * Sai định dạng file";
    }
}

function validation_number($number){
    if($number == 0){
        
    }elseif(empty($number)){
        return " * Số không được bỏ trống";
    }

    if($number <= 0){
        return " * Số không được âm";
    }
}

// DELETE IMG
function delete_img($img_path,$folder){
    $check = unlink( __DIR__ . "./../../public/image/" . $folder . "/" . $img_path);
}

?>