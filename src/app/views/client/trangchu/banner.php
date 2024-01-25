<!-- ============================BANNER============================== -->
<section class="hero">
  <div class="container mt-5">
  <?php
      if(!empty($list_bn)){
        echo "
          <div id='myCarousel' class='carousel slide' data-ride='carousel'>
            <div class='carousel-inner'>
        ";
        
        $i = 0;

        foreach($list_bn as $temp){
          if($i== 0){
            $class = "active";
          }else{
            $class = "";
          }

          echo "
            <div class='carousel-item "  . $class  . "'>
              <a href='" . $temp["link_banner"]   . "' target='_blank'>
                <img src='./public/image/anhsanpham/" .$temp["anh_banner"] .  "' class='d-block w-100' style='height: 400px;'>
              </a>
            </div>
          ";

          $i++;
        }

        echo "
          </div>


        <a class='carousel-control-prev' href='#myCarousel' role='button' data-slide='prev'>
          <span class='carousel-control-prev-icon' aria-hidden='true'></span>
          <span class='sr-only'>Previous</span>
        </a>
        <a class='carousel-control-next' href='#myCarousel' role='button' data-slide='next'>
          <span class='carousel-control-next-icon' aria-hidden='true'></span>
          <span class='sr-only'>Next</span>
        </a>
        </div>
        ";
        
      }
    ?>
  </div>
</section>