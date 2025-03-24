<?php
session_start();
ob_start();


include "../models/pdo.php";
include "../admin/views/layouts/header.php";
include "../admin/views/layouts/siderbar.php";
include "../models/danhmuc.php";
include "../models/sanpham.php";

if (isset($_GET['act'])) {
    $act = $_GET['act'];
    switch ($act) {

        case 'lisdm':
            $listdanhmuc = loadall_danhmuc();
            include "views/danhmuc/list.php";
            break;
        case 'adddm':
            if (isset($_POST['themmoi']) && ($_POST['themmoi'])) {
                $tendanhmuc = $_POST['ten_danh_muc'];
                $mota = $_POST['mo_ta'];
                insert_danhmuc($tendanhmuc, $mota);
                $thongbao = "Thêm thành công";
            }
            include "views/danhmuc/add.php";
            break;
            case 'xoadm':
                if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                    $danhmuc_id = $_GET['id'];
            
                    // Kiểm tra danh mục có đang được sử dụng
                    if (is_danhmuc_in_use($danhmuc_id)) {
                        echo "<script>alert('Danh mục này chứa sản phẩm đang được sử dụng trong giỏ hàng hoặc đơn hàng, không thể xóa!');</script>";
                    } else {
                        delete_danhmuc($danhmuc_id);    
                    }
                    // Chuyển hướng để tránh lỗi refresh
                    echo "<script>window.location.href='index.php?act=lisdm';</script>";
                }
            
                $listdanhmuc = loadall_danhmuc();
                include "views/danhmuc/list.php";
                break;
            
        case 'suadm':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                $dm = loadone_danhmuc($_GET['id']);
            }
            include "views/danhmuc/update.php";
            break;
        case 'updatedm':
            if (isset($_POST['capnhat']) && ($_POST['capnhat'])) {
                $tendanhmuc = $_POST['ten_danh_muc'];
                $madanhmuc = $_POST['ma_danh_muc'];
                $mota = $_POST['mo_ta'];
                update_danhmuc($madanhmuc, $tendanhmuc, $mota);
                $thongbao = "Cập Nhật thành công";
            }
            $listdanhmuc = loadall_danhmuc();
            include "views/danhmuc/list.php";
            break;
            // san pham
            case 'listsp':
                if (isset($_POST['listok']) && ($_POST['listok'])) {
                    $kyw = $_POST['kyw']; // Từ khóa tìm kiếm
                    $iddm = $_POST['iddm']; // Mã danh mục
                    $sort_price = $_POST['sort_price']; // Lọc theo giá
                } else {
                    $kyw = '';
                    $iddm = 0; // Mặc định không có lọc danh mục
                    $sort_price = 'asc'; // Mặc định sắp xếp theo giá từ thấp đến cao
                }
                $listdanhmuc = loadall_danhmuc(); // Lấy danh sách danh mục
                $listsanpham = loadall_sanphamloc($kyw, $iddm, $sort_price); // Lọc sản phẩm theo từ khóa, danh mục, và cách sắp xếp giá
                include "views/sanpham/list.php"; // Hiển thị danh sách sản phẩm
                break;
        case 'addsp':
            if (isset($_POST['themmoi']) && ($_POST['themmoi'])) {
                $iddm = isset($_POST['ma_danh_muc']) ? $_POST['ma_danh_muc'] : 0;
                $tensp = isset($_POST['ten_san_pham']) ? $_POST['ten_san_pham'] : '';
                $hinh = isset($_FILES['anh_san_pham']['name']) ? $_FILES['anh_san_pham']['name'] : '';
                $giasp = isset($_POST['gia']) ? $_POST['gia'] : 0;
                $mota = isset($_POST['mo_ta']) ? $_POST['mo_ta'] : '';
                $so_luong = isset($_POST['so_luong']) ? $_POST['so_luong'] : 0;
                $mau_sac = isset($_POST['mau_sac']) ? $_POST['mau_sac'] : [];
            
                // Xử lý file upload
                $target_dir = "../uploads/";
                $target_file = $target_dir . basename($hinh);
                if (!empty($hinh) && move_uploaded_file($_FILES["anh_san_pham"]["tmp_name"], $target_file)) {
                    // File được tải lên thành công
                } else {
                    $hinh = ''; // Gán giá trị rỗng nếu không có hình được upload
                }
            
                insert_sanpham($tensp, $hinh, $giasp, $mota, $iddm, $mau_sac, $so_luong);
                $thongbao = "Thêm thành công";
            }            

            $listdanhmuc = loadall_danhmuc();
            include "views/sanpham/add.php";
            break;
       case 'xoasp':
    if (isset($_GET['id']) && ($_GET['id'] > 0)) {
        $sanpham_id = $_GET['id'];

        // Kiểm tra sản phẩm có đang được sử dụng
        if (is_sanpham_in_use($sanpham_id)) {
            echo "<script>alert('Sản phẩm đang được sử dụng trong giỏ hàng hoặc đơn hàng, không thể xóa!');</script>";
        } else {
            delete_sanpham($sanpham_id);
           
        }
    }

    $listdanhmuc = loadall_danhmuc();
    $listsanpham = loadall_sanpham();
    include "views/sanpham/list.php";
    break;

        case 'suasp':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                $sanpham = loadone_sanpham($_GET['id']);
                $colors = loadone_mausac($_GET['id']);
               
                $so_luong = array(); // Khởi tạo mảng số lượng rỗng
                
                foreach ($colors as $color) {
                    $mau_sac[] = $color['mau_sac']; // Lưu màu sắc vào mảng
                   
                }
               
            }else {
                $mau_sac = []; // Nếu không có mã sản phẩm thì khởi tạo mảng màu sắc rỗng
               
            }
            $listdanhmuc = loadall_danhmuc();
            include "views/sanpham/update.php";
            break;
        case 'updatesp':
            if (isset($_POST['capnhat']) && isset($_POST['ma_san_pham'])) {
                $ma_san_pham = $_POST['ma_san_pham'];
                $ten_san_pham = $_POST['ten_san_pham'];
                $gia = $_POST['gia'];
                $mo_ta = $_POST['mo_ta'];
                $mau_sac = isset($_POST['mau_sac']) ? $_POST['mau_sac'] : [];
                $so_luong = $_POST['so_luong'];
                $hinh = $_FILES['anh_san_pham']['name'];
                $ma_danh_muc=$_POST['ma_danh_muc'];
                
                // Xử lý upload hình ảnh
                if (!empty($hinh)) {
                    $target_dir = "../uploads/";
                    $target_file = $target_dir . basename($hinh);
                    if (move_uploaded_file($_FILES["anh_san_pham"]["tmp_name"], $target_file)) {
                        // Hình ảnh đã được tải lên thành công
                    } else {
                        echo "Lỗi: Không thể tải hình ảnh lên.";
                        $hinh = ''; // Giữ lại hình ảnh cũ nếu không tải lên được
                    }
                } else {
                    $hinh = $_POST['anh_san_pham_cu']; // Giữ lại hình ảnh cũ nếu không chọn file mới
                }
            
                // Cập nhật sản phẩm vào cơ sở dữ liệu
                update_sanpham($ma_san_pham, $ten_san_pham, $hinh, $gia, $mo_ta, $so_luong, $mau_sac,$ma_danh_muc);
            
                $thongbao = "Cập nhật thành công";
            }
            
            $listdanhmuc = loadall_danhmuc();
            $listsanpham = loadall_sanpham("", 0);
            include "views/sanpham/list.php";
            break;
                   
                  
        default:
            include "../admin/views/home.php";

            break;
    }
} else {
    include "../admin/views/home.php";
}

include "../admin/views/layouts/footer.php";
ob_end_flush();
