<!-- =====================LIST DANH MUC============================== -->
<div class="col-lg-3 col-md-5">
    <div class="sidebar">
        <div class="sidebar__item">
            <h4>DANH MỤC</h4>
            <ul>
                <?php
                    if(!empty($list_dm)){
                        foreach($list_dm as $temp){
                            echo "
                                <li><a href='index.php?act=spdm&id={$temp['id_dm']}'>{$temp['ten_dm']}</a></li>
                            ";
                        }
                    }
                ?>
            </ul>
        </div>
    </div>
</div>