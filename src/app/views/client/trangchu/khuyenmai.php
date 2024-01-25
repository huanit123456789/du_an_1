<!-- ======================================MÃ KHUYẾN MÃI================================================= -->
<section class="categories">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-title mt-3">
          <h2>MÃ KHUYẾN MÃI</h2>
        </div>
      </div>

      <div class="categories__slider owl-carousel">
        
        <?php
          if(!empty($list_km)){
            foreach($list_km as $temp){
              echo "
                <div class='col-lg-3'>
                  <div class='voucher' onclick='copyToClipboard(\"" . $temp["ma_km"] . "\")'>
                    <h2>Giảm giá {$temp['phantram_km']} %</h2>
                    <p class>Mã giảm giá: <strong>{$temp["ma_km"]}</strong></p>
                    <p>Thời gian hết hạn: {$temp["ngaykt_km"]}</p>
                  </div>
                </div>
              ";
            }  
          }
        ?>
        
      </div>
    </div>
  </div>
</section>