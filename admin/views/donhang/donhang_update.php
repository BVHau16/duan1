<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <!-- nhập content -->
                <h2>Sửa trạng thái đơn hàng: <?= $donhang['ma_don_hang'] ?></h2>
                <form action="index.php?act=admin_donhang_update_save" method="POST">
                    <input type="hidden" name="ma_don_hang" value="<?= $donhang['ma_don_hang'] ?>">
                    <label class="form-label" for="trang_thai">Trạng thái:</label>
                    <select class="form-select" name="trang_thai" id="trang_thai">
                        <option value="Chờ xử lý" <?= $donhang['trang_thai'] == 'Chờ xử lý' ? 'selected' : '' ?>>Chờ xử lý</option>
                        <option value="Đang giao" <?= $donhang['trang_thai'] == 'Đang giao' ? 'selected' : '' ?>>Đang giao</option>
                        <option value="Hoàn thành" <?= $donhang['trang_thai'] == 'Hoàn thành' ? 'selected' : '' ?>>Hoàn thành</option>
                        <option value="Hủy" <?= $donhang['trang_thai'] == 'Hủy' ? 'selected' : '' ?>>Hủy</option>
                    </select>
                    <div class="d-flex mt-3">
                        <button class="btn btn-success me-2" type="submit" <?= $donhang['trang_thai'] === 'Hủy' ? 'disabled' : '' ?>>Cập nhật</button>
                        <a class="btn btn-primary me-2" href="index.php?act=admin_donhang">Quay Lại</a>
                    </div>
                </form>

                <!-- nhập content -->
            </div>
        </div>
    </div>
</div>