<?php

session_start();

require_once __DIR__ . "./../../../models/pdo.php";
require_once __DIR__ . "./../../../models/client/client.php";
$list_bl = list_bl($_POST["id"]);


?>

<ul id="comment-list" class="list-unstyled">
  <?php

  if (!empty($list_bl)) {
    foreach ($list_bl as $temp) {
      echo "
                    <li>
                      <img src='./public/image/anhnguoidung/{$temp['anh_nd']}' style='width:5%'>
                      <span>
                        <b>{$temp['ten_nd']}</b>
                        <span class='col-6 ml-auto'>" . date('d/m/Y', strtotime($temp['ngay_bl'])) . "</span>";

                        if(!empty($_SESSION["khachhang"])){
                          if($temp['id_nd'] == $_SESSION["khachhang"]){
                            echo "<button class='btn btn-danger' onclick='xoabinhluan({$temp['id_bl']},{$temp['id_sp']})'>Xóa</button>";
                          }
                        }

                        echo "<p class='mt-2'>{$temp['noidung_bl']}</p>
                        <hr>
                      </span>
                    </li>
                  ";
    }
  }
  ?>
</ul>