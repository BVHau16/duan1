<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <!-- nhập content -->
                <div class="row formtitle">
                    <h1>THÊM MỚI SẢN PHẨM</h1>
                </div>
                <div class="row formcontent">
                    <form action="index.php?act=addsp" method="post" enctype="multipart/form-data" id="addProductForm">
                        <div class=" mb-3  ">
                        <label for="exampleFormControlInput1" class="form-label">Danh Mục</label>
                            <select name="ma_danh_muc" class="form-select">
                                <?php
                                foreach ($listdanhmuc as $danhmuc) {
                                    extract($danhmuc);
                                    echo '<option value="' . $ma_danh_muc . '" style="width: auto;">' . $ten_danh_muc . '</option>';
                                }
                                ?>

                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="ten_san_pham" class="form-label">Tên Sản Phẩm</label>
                            <input type="text" class="form-control" name="ten_san_pham" id="ten_san_pham" value="<?php echo isset($ten_san_pham) ? htmlspecialchars($ten_san_pham) : ''; ?>">
                            <p class="text-danger" id="error-ten_san_pham"><?php echo isset($errors['ten_san_pham']) ? $errors['ten_san_pham'] : ''; ?></p>
                        </div>
                        <div class="mb-3">
                            <label for="gia" class="form-label">Giá</label>
                            <input type="number" class="form-control" name="gia" id="gia" value="<?php echo isset($gia) ? htmlspecialchars($gia) : ''; ?>">
                            <p class="text-danger" id="error-gia"></p>
                        </div>
                        <div class="mb-3">
                            <label for="hinh" class="form-label">Hình Ảnh</label>
                            <input type="file" class="form-control" name="hinh" id="hinh">
                            <p class="text-danger" id="error-hinh"></p>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Mô tả</label>
                            <textarea class="form-control" id="" rows="3" name="mo_ta"></textarea>
                            <p class="text-danger" id="error-mo_ta"></p>
                        </div>
                        <div id="variations">
                            <!-- Vùng này sẽ chứa các biến thể -->
                            <div class="row mb10 input-group mb-3">
                            <label for="" class="form-label">Màu Sắc</label>
                                <label><input class="form-check-input"  type="checkbox" name="mau_sac[]" value="black"> Đen</label><br>
                                <label><input class="form-check-input" type="checkbox" name="mau_sac[]" value="white"> Trắng</label><br>
                                <label><input class="form-check-input" type="checkbox" name="mau_sac[]" value="yellow"> Vàng</label><br>
                                <label><input class="form-check-input" type="checkbox" name="mau_sac[]" value="blue"> Xanh</label><br>
                            </div>
                            <p class="text-danger" id="error-mau_sac"></p>

                            <div class="mb-3">
                            <label for="" class="form-label">Số Lượng</label>
                                <input type="text" class="form-control" name="so_luong">
                                <p class="text-danger" id="error-so_luong"></p>
                            </div>

                            <div class="flex mt-3">
                                <input class="btn btn-success" type="submit" name="themmoi" value="Thêm mới" style="width: auto;">
                                <input class="btn btn-warning" type="reset" value="Nhập lại" style="width: auto;">
                                <a href="index.php?act=listsp"><input  class="btn btn-primary" type="button" value="Danh sách"></a>
                            </div>
                            <?php
                                if (isset($thongbao) && ($thongbao != "")) echo $thongbao;
                            ?>
                    </form>
                </div>
            </div>
        </div>
        <!-- nhập content -->
    </div>
</div>
</div>
</div>

<?php
// Server-side validation
$errors = [];
$thongbao = isset($thongbao) ? $thongbao : ''; // Ensure the success message persists

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ten_san_pham = trim($_POST['ten_san_pham']);
    $gia = trim($_POST['gia']);
    $hinh = $_FILES['hinh'];
    $mo_ta = trim($_POST['mo_ta']);
    $ma_danh_muc = $_POST['ma_danh_muc'];
    $mau_sac = isset($_POST['mau_sac']) ? $_POST['mau_sac'] : [];
    $so_luong = trim($_POST['so_luong']);

    if (empty($ten_san_pham)) {
        $errors['ten_san_pham'] = 'Tên sản phẩm không được để trống.';
    }

    if (empty($gia)) {
        $errors['gia'] = 'Giá không được để trống.';
    } elseif (!is_numeric($gia)) {
        $errors['gia'] = 'Giá phải là một số.';
    }

    if (empty($hinh['name'])) {
        $errors['hinh'] = 'Hình ảnh không được để trống.';
    } else {
        $target_dir = __DIR__ . '/../../../uploads/';
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $target_file = $target_dir . basename($hinh['name']);
        if (!move_uploaded_file($hinh['tmp_name'], $target_file)) {
            $errors['hinh'] = 'Không thể tải hình ảnh lên.';
        }
    }

    if (empty($mo_ta)) {
        $errors['mo_ta'] = 'Mô tả không được để trống.';
    }

    if (empty($mau_sac)) {
        $errors['mau_sac'] = 'Phải chọn ít nhất một màu sắc.';
    }

    if (empty($so_luong)) {
        $errors['so_luong'] = 'Số lượng không được để trống.';
    } elseif (!is_numeric($so_luong) || $so_luong <= 0) {
        $errors['so_luong'] = 'Số lượng phải là một số lớn hơn 0.';
    }

    if (empty($errors)) {
        require_once __DIR__ . '/../../../models/sanpham.php';
        insert_sanpham($ten_san_pham, $hinh['name'], $gia, $mo_ta, $ma_danh_muc, $mau_sac, $so_luong);
    }
}
?>

<script>
    // Hàm kiểm tra form
    function validateProductForm() {
        let isValid = true;

        const tenSanPham = document.querySelector('input[name="ten_san_pham"]').value;
        const gia = document.querySelector('input[name="gia"]').value;
        const hinh = document.querySelector('input[name="hinh"]').value;
        const moTa = document.querySelector('textarea[name="mo_ta"]').value;
        const mauSac = document.querySelectorAll('input[name="mau_sac[]"]:checked');
        const soLuong = document.querySelector('input[name="so_luong"]').value;

        document.getElementById('error-ten_san_pham').textContent = '';
        document.getElementById('error-gia').textContent = '';
        document.getElementById('error-hinh').textContent = '';
        document.getElementById('error-mo_ta').textContent = '';
        document.getElementById('error-mau_sac').textContent = '';
        document.getElementById('error-so_luong').textContent = '';

        if (tenSanPham.trim() === "") {
            document.getElementById('error-ten_san_pham').textContent = "Tên sản phẩm không được để trống.";
            isValid = false;
        }

        if (gia.trim() === "") {
            document.getElementById('error-gia').textContent = "Giá không được để trống.";
            isValid = false;
        } else if (isNaN(gia)) {
            document.getElementById('error-gia').textContent = "Giá phải là một số.";
            isValid = false;
        }

        if (hinh.trim() === "") {
            document.getElementById('error-hinh').textContent = "Hình ảnh không được để trống.";
            isValid = false;
        }

        if (moTa.trim() === "") {
            document.getElementById('error-mo_ta').textContent = "Mô tả không được để trống.";
            isValid = false;
        }

        if (mauSac.length === 0) {
            document.getElementById('error-mau_sac').textContent = "Phải chọn ít nhất một màu sắc.";
            isValid = false;
        }

        if (soLuong.trim() === "") {
            document.getElementById('error-so_luong').textContent = "Số lượng không được để trống.";
            isValid = false;
        } else if (isNaN(soLuong) || soLuong <= 0) {
            document.getElementById('error-so_luong').textContent = "Số lượng phải là một số lớn hơn 0.";
            isValid = false;
        }

        return isValid;
    }

    document.getElementById('addProductForm').addEventListener('submit', function(event) {
        const submitButton = document.querySelector('input[name="themmoi"]');

        if (!validateProductForm()) {
            event.preventDefault();
        } else {
            submitButton.disabled = true;
            submitButton.value = "Đang xử lý...";
        }
    });
</script>
