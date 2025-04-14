<?php
session_start();
ob_start();

if ($_SESSION['user']['loai_nguoi_dung'] === 'NhanVien') {
  
} else {
    // Xóa session nếu không phải nhân viên
    unset($_SESSION['user']);
    $_SESSION['thongbao'] = 'Bạn không có quyền truy cập!';
    header("Location:../index.php?act=dangnhap"); // Quay lại trang đăng nhập
    exit();
}

include "../models/pdo.php";
include "../admin/views/layouts/header.php";
include "../admin/views/layouts/siderbar.php";
include "../models/danhmuc.php";
include "../models/sanpham.php";
include "../models/nguoidung.php";
include "../models/binhluan.php";
include "../models/donhang.php";
// //controller

$total_orders = count_orders_by_status('Chờ xử lý') + count_orders_by_status('Đang giao') + count_orders_by_status('Hoàn thành');
$total_revenue = total_revenue();
$best_selling_products = best_selling_products();
$total_products_sold = get_total_products_sold();
$cash_orders = count_orders_by_payment_method(1); // Thanh toán tiền mặt
$bank_orders = count_orders_by_payment_method(0); // chuyển khoản
$top_customer = get_top_customer();
// var_dump($top_customer);
// die();
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
                if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                    $sanpham_id = intval($_GET['id']);
            
                    if (is_sanpham_in_use($sanpham_id)) {
                        echo "<script>alert('Sản phẩm đang được sử dụng trong đơn hàng hoặc giỏ hàng, không thể xóa!');</script>";
                    } else {
                        delete_sanpham($sanpham_id);
                        echo "<script>alert('Xóa sản phẩm thành công');</script>";
                    }
                } else {
                    echo "<script>alert('Không xác định được sản phẩm cần xóa.');</script>";
                }
            
                echo "<script>window.location.href='index.php?act=listsp';</script>";
                exit;
                break;
            
        

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

            case 'list_account':
                $list_account = load_all_account();
                include "views/nguoidung/list.php";
                break;

             case 'updatetrangthai':
                $id = $_POST['user_id']; // Lấy ID người dùng từ form
                $new_status = ($_POST['status'] == '1') ? '1' : '0'; // Nếu giá trị 'status' là 1, trạng thái sẽ là 'Hoạt động', nếu là 0 thì 'Khóa'

                // Cập nhật trạng thái trong cơ sở dữ liệu
                updatetrangthai($new_status, $id);
                $list_account = load_all_account();
                include "views/nguoidung/list.php";
                break;
                case 'listspcomment':
                    if (isset($_POST['listok']) && ($_POST['listok'])) {
                        $kyw = $_POST['kyw'];
                        $iddm = $_POST['iddm'];
                    } else {
                        $kyw = '';
                        $iddm = 0;
                    }
                    $listdanhmuc = loadall_danhmuc();
                    $listsanpham = loadall_sanpham();
                    include "views/binhluan/list.php";
                    break;
                case 'listdetailcomment':
                $id = $_GET['id'];
                
                $listcomments = loadone_binhluan($id) ;
                //var_dump($listcomments);
                include "views/binhluan/detail.php";
                break;
                case 'dangxuat';
                session_start();
                session_destroy();
                header('Location:../index.php');
                break;

                case 'admin_donhang':
                   
                    $donhangs = get_all_donhangs(); // Lấy tất cả đơn hàng
                    include 'views/donhang/donhang.php';
                    break;
                
                case 'admin_donhang_detail':
                    $id = $_GET['id'];
                    $donhang = get_donhang_by_id($id); // Lấy thông tin đơn hàng
                    $chitiets = get_chitiet_donhang_by_donhang($id); // Lấy chi tiết đơn hàng
                    include 'views/donhang/donhang_detail.php';
                    break;
                
                case 'admin_donhang_update':
                    $id = $_GET['id'];
                    $donhang = get_donhang_by_id($id); // Lấy thông tin đơn hàng
                    include 'views/donhang/donhang_update.php';
                    break;
                
                case 'admin_donhang_update_save':
                    $id = $_POST['ma_don_hang'];
                    $trang_thai = $_POST['trang_thai'];
                    update_trang_thai_donhang($id, $trang_thai); // Cập nhật trạng thái đơn hàng
                    $_SESSION['thongbao'] = "Sửa trạng thái thành công!";
                    header('Location: index.php?act=admin_donhang');
                    break;
                    case 'xoa_binhluan':
                        if (isset($_GET['id'])) {
                            $id = $_GET['id'];  // Lấy ID bình luận từ URL
                           
                            // Gọi hàm delete_binhluan() từ model để xóa bình luận
                            delete_binhluan($id);
                            $ma_san_pham = $_GET['ma_san_pham'];
                            // Chuyển hướng lại trang chi tiết bình luận (hoặc trang danh sách)
                          
                        }
                        $listcomments = loadone_binhluan($ma_san_pham) ;
                        include 'views/binhluan/detail.php';
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