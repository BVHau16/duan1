<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <!-- nhập content -->
                <div class="row formtitle"><h1>THÊM MỚI LOẠI HÀNG HÓA</h1></div>
                <div class="row formcontent">
                    <form action="index.php?act=adddm" method="post" id="addForm">
                        <div class="row mb10">
                            <label for="ten_danh_muc" class="form-label">Tên Danh Mục</label>
                            <input type="text" class="form-control" name="ten_danh_muc" id="ten_danh_muc" value="<?php echo isset($ten_danh_muc) ? htmlspecialchars($ten_danh_muc) : ''; ?>">
                            <p class="text-danger" id="error-ten_danh_muc"></p>
                        </div>
                        <div class="row mb10">
                            <label for="mo_ta" class="form-label">Mô Tả</label>
                            <input type="text" class="form-control" name="mo_ta" id="mo_ta" value="<?php echo isset($mo_ta) ? htmlspecialchars($mo_ta) : ''; ?>">
                            <p class="text-danger" id="error-mo_ta"></p>
                        </div>
                        <div class="flex mt-2 gap-2">
                            <input class="btn btn-success" type="submit" name="themmoi" value="Thêm mới" style="width: auto;">
                            <input type="reset" class="btn btn-warning" value="Nhập lại" style="width: auto;">
                            <a href="index.php?act=lisdm"><input class="btn btn-primary" type="button" value="Danh sách"></a>
                        </div>
                        <?php if (isset($thongbao) && $thongbao != "") echo $thongbao; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Server-side validation
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ten_danh_muc = trim($_POST['ten_danh_muc']);
    $mo_ta = trim($_POST['mo_ta']);

    if (empty($ten_danh_muc)) {
        $errors['ten_danh_muc'] = 'Tên danh mục không được để trống.';
    }

    if (empty($mo_ta)) {
        $errors['mo_ta'] = 'Mô tả không được để trống.';
    }

    if (empty($errors)) {
        // Insert into database
        // ...existing code...
    }
}
?>

<script>
    // Hàm kiểm tra form
    function validateForm() {
        let isValid = true;

        // Lấy giá trị từ các trường trong form
        const tenDanhMuc = document.querySelector('input[name="ten_danh_muc"]').value;
        const moTa = document.querySelector('input[name="mo_ta"]').value;

        // Xóa thông báo lỗi cũ
        document.getElementById('error-ten_danh_muc').textContent = '';
        document.getElementById('error-mo_ta').textContent = '';

        // Kiểm tra trường "Tên Danh Mục"
        if (tenDanhMuc.trim() === "") {
            document.getElementById('error-ten_danh_muc').textContent = "Tên danh mục không được để trống.";
            isValid = false;
        }

        // Kiểm tra trường "Mô Tả"
        if (moTa.trim() === "") {
            document.getElementById('error-mo_ta').textContent = "Mô tả không được để trống.";
            isValid = false;
        }

        // Trả về trạng thái hợp lệ
        return isValid;
    }

    // Gắn sự kiện submit cho form
    document.getElementById('addForm').addEventListener('submit', function(event) {
        if (!validateForm()) {
            event.preventDefault(); // Ngừng việc gửi form nếu kiểm tra không hợp lệ
        }
    });
</script>