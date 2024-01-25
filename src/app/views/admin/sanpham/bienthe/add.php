<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thêm biến thể</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">QLBT</li>
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
                        <form action="index.php?act=sp&type=addbt&id=<?= $_GET["id"] ?>" method="POST">

                            <div class="form-group">
                                <label for="size_bt">Size</label>
                                <span class="error"><?= $sizeErr??"" ?></span>
                                <input type="number" min = 0 class="form-control" id="size_bt" name="size_bt" placeholder="Nhập size" value="<?= $_POST["size_bt"]??"" ?>">
                            </div>

                            <div class="form-group">
                                <label for="soluong_bt">Số lượng</label>
                                <span class="error"><?= $soluongErr??"" ?></span>
                                <input type="number" min = 0 class="form-control" id="soluong_bt" name="soluong_bt" placeholder="Nhập số lượng" value="<?= $_POST["soluong_bt"]??"" ?>">
                            </div>
                            
                            
                            <?= $message??"" ?>
                            <button type="submit" name="addbt" value="addbt" class="btn btn-primary mb-3">Thêm biến thể</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
