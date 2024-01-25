<?php
    function list_bl($id_sp){
        $sql = "SELECT binh_luan.*, nguoi_dung.ten_nd FROM binh_luan inner join nguoi_dung ON binh_luan.id_nd = nguoi_dung.id_nd 
                WHERE binh_luan.id_sp = $id_sp";
        return pdo_qr($sql);
    }
?>