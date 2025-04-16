<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <!-- nhập content -->
                <div class="row">
                    <div class="row formtitle mb">
                        <h1>DANH SÁCH SẢN PHẨM</h1>

                        <?php
                        $kyw = isset($kyw) ? $kyw : '';
                        $iddm = isset($iddm) ? $iddm : 0;
                        $sort_price = isset($sort_price) ? $sort_price : '';
                        ?>

                        <form action="index.php?act=listsp" method="POST" class="mb-4">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" name="kyw" placeholder="Tìm kiếm sản phẩm"
                                           value="<?php echo htmlspecialchars($kyw); ?>" class="form-control mb-2">
                                </div>

                                <div class="col-md-3">
                                    <select name="iddm" class="form-select mb-2">
                                        <option value="0">Tất cả danh mục</option>
                                        <?php
                                        foreach ($listdanhmuc as $danhmuc) {
                                            echo '<option value="' . $danhmuc['ma_danh_muc'] . '"'
                                                . ($iddm == $danhmuc['ma_danh_muc'] ? ' selected' : '') . '>'
                                                . htmlspecialchars($danhmuc['ten_danh_muc']) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <select name="sort_price" class="form-select mb-2">
                                        <option value="asc" <?php echo ($sort_price == 'asc') ? 'selected' : ''; ?>>
                                            Giá từ thấp đến cao
                                        </option>
                                        <option value="desc" <?php echo ($sort_price == 'desc') ? 'selected' : ''; ?>>
                                            Giá từ cao đến thấp
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-2 d-flex align-items-center">
                                    <input type="submit" name="listok" value="Tìm kiếm" class="btn btn-primary w-100">
                                </div>
                            </div>
                        </form>

                        <div class="text-end mb-3">
                            <a href="index.php?act=addsp">
                                <input class="btn btn-success" type="button" value="Thêm Sản Phẩm">
                            </a>
                        </div>
                    </div>

                    <div class="row formcontent">
                        <div class="row mb10 formdsloai">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Mã Sản Phẩm</th>
                                        <th>Tên Sản Phẩm</th>
                                        <th>Hình</th>
                                        <th>Giá</th>
                                        <th>Danh mục</th>
                                        <th>Số Lượng</th>
                                        <th>Hành Động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Tạo map danh mục cho tối ưu
                                    $mapDanhMuc = [];
                                    foreach ($listdanhmuc as $dm) {
                                        $mapDanhMuc[$dm['ma_danh_muc']] = $dm['ten_danh_muc'];
                                    }

                                    foreach ($listsanpham as $sanpham) {
                                        extract($sanpham);
                                        $suasp = "index.php?act=suasp&id=" . $ma_san_pham;
                                        $xoasp = "index.php?act=xoasp&id=" . $ma_san_pham;
                                        $img = isset($anh_san_pham) ? $anh_san_pham : '';
                                        $anh = "../uploads/" . $img;

                                        $hinh = (is_file($anh)) ? "<img src='{$anh}' height='80px'>" : "no photo";
                                        $ten_danh_muc = isset($mapDanhMuc[$ma_danh_muc]) ? $mapDanhMuc[$ma_danh_muc] : "Không rõ";
                                        $tong_so_luong = isset($mapSoLuong[$ma_san_pham]) ? $mapSoLuong[$ma_san_pham] : 0;

                                        echo '<tr>
                                                <td>' . $ma_san_pham . '</td>
                                                <td><a href="' . $suasp . '">' . htmlspecialchars($ten_san_pham) . '</a></td>
                                                <td>' . $hinh . '</td>
                                                <td>' . number_format($gia, 0, ',', '.') . ' đ</td>
                                                <td>' . htmlspecialchars($ten_danh_muc) . '</td>
                                                <td>' . $tong_so_luong . '</td>
                                                <td>
                                                    <a href="' . $suasp . '" class="btn btn-sm btn-primary">SỬA</a>
                                                    <a href="' . $xoasp . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Bạn có chắc muốn xóa?\');">XÓA</a>
                                                </td>
                                            </tr>';
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- nhập content -->
            </div>
        </div>
    </div>
</div>
