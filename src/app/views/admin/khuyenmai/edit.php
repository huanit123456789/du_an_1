<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sửa mã khuyến mãi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">QLKM</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="container">
                        <form action="index.php?act=km&type=edit&id=<?= $list["id_km"] ?>" method="POST">
                            <div class="form-group">
                                <label for="ma_km">Mã khuyến mãi</label>
                                <span class="error"><?= $maErr??"" ?></span>
                                <input type="text" class="form-control" id="ma_km" name="ma_km" placeholder="Nhập mã khuyến mãi" value="<?php if(isset($_POST["ma_km"])){echo $_POST["ma_km"];}else{ echo $list["ma_km"];} ?>">
                            </div>

                            <div class="form-group">
                                <label for="ngaybd_km">Ngày bắt đầu</label>
                                <span class="error"><?= $ngaybdErr??"" ?></span>
                                <input type="date" id="ngaybd_km" name="ngaybd_km" class="form-control" value="<?php if(isset($_POST["ngaybd_km"])){echo $_POST["ngaybd_km"];}else{ echo $list["ngaybd_km"];} ?>">
                            </div>

                            <div class="form-group">
                                <label for="ngaykt_km">Ngày kết thúc</label>
                                <span class="error"><?= $ngayktErr??"" ?></span>
                                <input type="date" id="ngaykt_km" name="ngaykt_km" class="form-control" value="<?php if(isset($_POST["ngaykt_km"])){echo $_POST["ngaykt_km"];}else{ echo $list["ngaykt_km"];} ?>">
                            </div>

                            <div class="form-group">
                                <label for="phantram_km">Phần trăm (%)</label>
                                <span class="error"><?= $phantramErr??"" ?></span>
                                <input type="number" min=0 max=100 class="form-control" id="phantram_km" name="phantram_km" placeholder="Nhập giá trị" value="<?php if(isset($_POST["phantram_km"])){echo $_POST["phantram_km"];}else{ echo $list["phantram_km"];} ?>">
                            </div>

                            <?= $message??"" ?>
                            <button type="submit" name="updatekm" value="updatekm" class="btn btn-primary mb-3">Cập nhật mã khuyến mãi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

