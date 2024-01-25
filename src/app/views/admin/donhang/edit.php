<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cập nhật trạng thái đơn hàng</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">QLĐH</li>
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
                        <form action="index.php?act=dh&type=edit&id=<?= $_GET["id"] ?>" method="POST">

                            <div class="form-group">
                                <label>Trạng thái đơn hàng</label>
                                <select class="form-control" name="trangthai_dh">
                                    <?php
                                        switch ($trangthai) {
                                            case 1:
                                                echo "  
                                                    <option value='1'>Chờ xử lý</option>
                                                    <option value='2'>Đồng ý</option>
                                                    <option value='3'>Chờ giao hàng</option>
                                                    <option value='4'>Đang giao hàng</option>
                                                    ";

                                                    if($_SESSION["admin"]["id_cv"] == 1){
                                                        echo "<option value='6'>Hủy</option>";
                                                    }
                                                break;
                                            case 2:
                                                echo "  
                                                    <option value='2'>Đồng ý</option>
                                                    <option value='3'>Chờ giao hàng</option>
                                                    <option value='4'>Đang giao hàng</option>";
                                                break;
                                            case 3:
                                                echo "
                                                    <option value='3'>Chờ giao hàng</option>
                                                    <option value='4'>Đang giao hàng</option>";
                                                break;
                                            case 4:
                                                echo "
                                                    <option value='4'>Đang giao hàng</option>";
                                                break;
                                            case 5:
                                                echo "
                                                    <option value='5'>Đã nhận hàng</option>";
                                                break;
                                            case 6:
                                                echo "
                                                    <option value='6'>Đã hủy</option>";
                                                break;
                                        }
                                    ?>
                                </select>
                            </div>

                            <?= $message??"" ?>
                            <button type="submit" name="updatedh" value="updatedh" class="btn btn-primary mb-3">Cập nhật trạng thái</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>