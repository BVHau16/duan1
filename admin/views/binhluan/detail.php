<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <?php
                // Kiểm tra xem có bình luận nào không
                if ($listcomments) {
                    $ten_san_pham = $listcomments[0]['ten_san_pham'];
                ?>
                <div class="row formtitle mb">
                    <h1>DANH SÁCH BÌNH LUẬN CỦA SẢN PHẨM <?= strtoupper(htmlspecialchars($ten_san_pham)) ?></h1>
                </div>
                <table class="table table-hover" cellpadding="10">
                    <thead>
                        <tr>
                            <th>Số Thứ Tự</th>
                            <th>Tên Người Dùng</th>
                            <th>Nội Dung</th>
                            <th>Đánh Giá</th>
                            <th>Ngày Bình Luận</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($listcomments as $index => $comment) {
                                echo '<tr>';
                                echo '<td>' . ($index + 1) . '</td>';
                                echo '<td>' . htmlspecialchars($comment['ten']) . '</td>';
                                echo '<td>' . htmlspecialchars($comment['noi_dung']) . '</td>';
                                echo '<td>';
                                $danh_gia = $comment['danh_gia'];
                                for ($i = 1; $i <= 5; $i++) {
                                    echo ($i <= $danh_gia) ? '<i class="ri-star-fill" style="color: gold;"></i>' : '<i class="ri-star-line" style="color: gold;"></i>';
                                }
                                echo '</td>';
                                echo '<td>' . htmlspecialchars($comment['ngay_binh_luan']) . '</td>';
                                echo '<td><a class="btn btn-danger" href="index.php?act=xoa_binhluan&ma_san_pham=' . $comment['ma_san_pham'] . '&id=' . $comment['ma_binh_luan'] . '" onclick="return confirm(\'Bạn có chắc chắn muốn xóa bình luận này?\')">Xóa</a></td>';
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
                <?php
                } else {
                ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Số Thứ Tự</th>
                            <th>Tên Người Dùng</th>
                            <th>Nội Dung</th>
                            <th>Đánh Giá</th>
                            <th>Ngày Bình Luận</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td colspan="6">Không có bình luận</td></tr>
                    </tbody>
                </table>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>