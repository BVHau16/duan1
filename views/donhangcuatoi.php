<main>
    <?php
    // Kiểm tra nếu người dùng đã đăng nhập và có đơn hàng
    if (isset($_SESSION['user']['ma_nguoi_dung'])):
        $ma_nguoi_dung = $_SESSION['user']['ma_nguoi_dung'];  // Lấy mã người dùng từ session
        $donhangs = get_donhang_by_user($ma_nguoi_dung);  // Lấy danh sách đơn hàng của người dùng
    ?>
        <div class="cart-main-wrapper section-padding">
            <div class="container">
                <div class="section-bg-color">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cart-table table-responsive">
                                <h2 class="text-center mb-4">Danh sách đơn hàng của bạn</h2>

                                <?php if (isset($_SESSION['thongbao'])): ?>
                                    <div class="alert alert-success">
                                        <?= $_SESSION['thongbao']; unset($_SESSION['thongbao']); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($donhangs)): ?>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Mã đơn hàng</th>
                                                <th>Ngày đặt</th>
                                                <th>Tổng tiền</th>
                                                <th>Trạng thái</th>
                                                <th>Phương thức thanh toán</th>
                                                <th>Hành Động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($donhangs as $donhang): ?>
                                                <tr>
                                                    <td><?=  $donhang['ma_don_hang']; ?></td>
                                                    <td><?= date('d-m-Y', strtotime($donhang['ngay_dat'])); ?></td>
                                                    <td><?=  number_format($donhang['tong_tien'], 0, ',', '.'); ?> VND</td>
                                                    <td><?= $donhang['trang_thai']; ?></td>
                                                    <td><?= $donhang['pttt'] == 0 ? 'Thanh toán bằng chuyển khoản' : 'Thanh toán bằng tiền mặt'; ?></td>
                                                    <td>
                                                        <a class="btn btn-sqr" href="index.php?act=donhang_detail&id=<?= $donhang['ma_don_hang'] ?>">Xem chi tiết</a>
                                                        <?php if ($donhang['trang_thai'] != 'Hủy'): ?>
                                                            <a class="btn btn-sqr" href="index.php?act=huy_don&id=<?= $donhang['ma_don_hang'] ?>" onclick="return confirm('Bạn có chắc muốn hủy đơn hàng này?');">Hủy đơn</a>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php else: ?>
                                    <p>Bạn chưa có đơn hàng nào.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <p>Bạn cần đăng nhập để xem đơn hàng.</p>
    <?php endif; ?>
</main>