<body>
  <div class="container mt-5 mb-5">
    <div class="row">
      <div class="col-md-12">
        <!-- Comment Section -->
        <div class="card">
          <div class="card-header">
            <b>Bình luận</b>
          </div>

          <div class="card-body" id='huanbl'>
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

                  if (!empty($_SESSION["khachhang"])) {
                    if ($temp['id_nd'] == $_SESSION["khachhang"]) {
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
          </div>
        </div>


        <?php
        if (!empty($_SESSION["admin"]) || !empty($_SESSION["khachhang"])) {
          echo "
            <div id='comment-form' class='mt-3'>
              <div class='form-group'>
                  <label for='comment'>Comment:</label>
                  <textarea class='form-control' id='nd_bl' name='nd_bl' rows='4' required></textarea>
              </div>
              <button type='button' onclick='binhluan({$_GET['id']})' class='btn btn-primary'>Bình luận</button>
            </div>
      
  
          ";
        } else {
          echo "<div><a href='index.php?act=tk&type=dn&id={$_GET['id']}' class='error'>Đăng nhập để bình luận</a></div>";
        }
        ?>
      </div>
    </div>
  </div>
</body>

</html>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
  function binhluan(idsp) {
    var input = document.getElementById("nd_bl");

    if (input.value == "") {
      alert("Mời nhập bình luận");
    } else {
      $.ajax({
        type: "POST",
        url: "./app/models/client/bl.php",
        data: {
          id_sp: idsp,
          nd_bl: input.value
        },

        success: function(response) {
          // sau khi cap nhat thi ke thua 
          $.post("app/views/client/sanphamchitiet/binhluanform.php", {
            id: idsp
          }, function(data) {
            $("#huanbl").html(data);
          })
          input.value = " ";
        },

        error: function(error) {
          console.log(error);
        }
      });
    }
  }

  function xoabinhluan(idbl,idsp) {
    if (confirm("Bạn có muốn xóa không")) {
      $.ajax({
        type: "POST",
        url: "./app/models/client/xoabl.php",
        data: {
          id: idbl,
        },

        success: function(response) {
          // sau khi cap nhat thi ke thua 
          $.post("app/views/client/sanphamchitiet/binhluanform.php", {
            id: idsp
          }, function(data) {
            $("#huanbl").html(data);
          })

        },

        error: function(error) {
          console.log(error);
        }
      });
    }
  }
</script>