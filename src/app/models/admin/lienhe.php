<?php
    function list_lh(){
        $sql = "SELECT * FROM lien_he";
        return pdo_qr($sql);
    }

    function delete_lh($id){
        $sql = "DELETE FROM lien_he WHERE id_lh = $id";
        pdo_exe($sql);
    }


    function delete_lh_sl($array){
        foreach($array as $temp){
            delete_lh($temp);
        }
    }
?>