<?php
session_start();
ob_start();

// if ($_SESSION['user']['loai_nguoi_dung'] === 'NhanVien') {
  
// } else {
//     // Xóa session nếu không phải nhân viên
//     unset($_SESSION['user']);
//     $_SESSION['thongbao'] = 'Bạn không có quyền truy cập!';
//     header("Location:../index.php?act=dangnhap"); // Quay lại trang đăng nhập
//     exit();
// }

include "../models/pdo.php";
include "../admin/views/layouts/header.php";
include "../admin/views/layouts/siderbar.php";
// //controller


ob_end_flush();