<?php

if (!isset($_SESSION)) {
    session_start();
}
ob_start(); // Bắt đầu bộ đệm đầu ra

include './models/pdo.php';
include './views/header.php';
include './models/sanpham.php';
include './models/nguoidung.php';
include './models/danhmuc.php';
include './models/binhluan.php';



$product_new = loadall_product_home();
$product_iphone = loadall_product_iphone();
$product_samsung = loadall_product_samsung();
$product_top8_sale = loadall_top8_product();
$product_iphone_top8 =loadall_top8_iphone();


if (isset($_GET['act']) && ($_GET['act'] != "")) {
    $act = $_GET['act'];
    switch ($act) {
        case 'shopiphone':
            if (isset($_POST['kyw']) && ($_POST['kyw'] != "")) {
                $kyw = $_POST['kyw'];
            } else {
                $kyw = "";
            }
            $product_shop_iphone = loadall_shopiphone($kyw);
            include './views/shop/shop-iphone.php';
        break;

        case 'shopsamsung':
            if (isset($_POST['kyw']) && ($_POST['kyw'] != "")) {
                $kyw = $_POST['kyw'];
            } else {
                $kyw = "";
            }
            $product_shop_samsung = loadall_shopsamsung($kyw);
            include './views/shop/shop-samsung.php';
        break;

        case 'shopxiaomi':
            if (isset($_POST['kyw']) && ($_POST['kyw'] != "")) {
                $kyw = $_POST['kyw'];
            } else {
                $kyw = "";
            }
            $product_shop_xiaomi = loadall_shopxiaomi($kyw);
            include './views/shop/shop-xiaomi.php';
        break;

        case 'chitietsanpham':
            if (isset($_GET['ma_san_pham']) && ($_GET['ma_san_pham'] > 0)) {
                $ma_san_pham = $_GET['ma_san_pham'];
                $oneproduct = loadone_sanpham($ma_san_pham);
                extract($oneproduct);
                $product_cung_loai = load_product_cungloai($ma_danh_muc, $ma_san_pham);
                $load_all_binhluan = load_all_binhluan($ma_san_pham);
                // var_dump($product_cung_loai);

                // $list_variant = load_product_variant($product_id);

                // if (isset($_SESSION['username'])) {
                //     $list_img_cart = list_img_cart($_SESSION['username']['user_id']);
                // }
                include './views/chitietsanpham.php';
            } else {
                include './views/home.php';
            }
            break;

        case 'dangky':

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $ten = $_POST['ten'];
                $email = $_POST['email'];
                $so_dien_thoai = $_POST['so_dien_thoai'];
                $dia_chi = $_POST['dia_chi'];
                $mat_khau = password_hash($_POST['mat_khau'], PASSWORD_BCRYPT);
                $hinh = isset($_FILES['anh_dai_dien']['name']) ? $_FILES['anh_dai_dien']['name'] : '';
                $target_dir = "./uploads/";
                $target_file = $target_dir . basename($hinh);
                if (!empty($hinh) && move_uploaded_file($_FILES["anh_dai_dien"]["tmp_name"], $target_file)) {
                } else {
                    $hinh = '';
                }
                if (emailExists($email)) {
                    // var_dump(emailExists($email));
                    // die();
                    $thongbao = "Email này đã được sử dụng!";
                    require './views/account/dangky.php';
                    return;
                }
                insert_user($ten, $email, $mat_khau, $hinh, $so_dien_thoai, $dia_chi);
                header('Location:index.php?act=dangnhap');
                exit();
            }

            include './views/account/dangky.php';
            break;

        case 'dangnhap':

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $email = $_POST['email'];
                $password = $_POST['password'];

                $user = findByEmail($email);
                if ($user && password_verify($password, $user['mat_khau'])) {
                    $_SESSION['user'] = $user;
                    //  var_dump($_SESSION['user']['loai_nguoi_dung']);
                    //  die();

                    if ($_SESSION['user']['trang_thai'] == '0') {
                        $thongbao = "Tài khoản đã bị khóa.";
                        unset($_SESSION['user']);
                    } else {
                        if ($_SESSION['user']['loai_nguoi_dung'] == 'KhachHang') {
                            header('Location:index.php');
                        } else {
                            header('Location:./admin/index.php');
                        }
                    }
                } else {
                    $thongbao = "Email hoặc mật khẩu không đúng!";
                    require './views/account/dangnhap.php';
                }
            }

            include './views/account/dangnhap.php';
            break;

        case 'dangxuat';
            session_start();
            session_destroy();
            header('Location:index.php');
            break;
        

        case 'update_account':

            $ma_nguoi_dung = $_SESSION['user']['ma_nguoi_dung'];
            // var_dump($ma_nguoi_dung);
            // die();
            $user = get_user_by_id($ma_nguoi_dung);


            if (isset($_POST['ho_ten'], $_POST['email'], $_POST['so_dien_thoai'], $_POST['dia_chi'])) {
                $ma_nguoi_dung = $_SESSION['user']['ma_nguoi_dung'];
                $ho_ten = $_POST['ho_ten'];
                $email = $_POST['email'];
                $so_dien_thoai = $_POST['so_dien_thoai'];
                $dia_chi = $_POST['dia_chi'];
                $hinh = $_FILES['anh_dai_dien']['name'];

                // Xử lý upload hình ảnh
                if (!empty($hinh)) {
                    $target_dir = "./uploads/";
                    $target_file = $target_dir . basename($hinh);
                    if (move_uploaded_file($_FILES["anh_dai_dien"]["tmp_name"], $target_file)) {
                        // Hình ảnh đã được tải lên thành công
                    } else {
                        echo "Lỗi: Không thể tải hình ảnh lên.";
                        $hinh = ''; // Giữ lại hình ảnh cũ nếu không tải lên được
                    }
                } else {
                    $hinh = $_POST['anh_dai_dien_cu']; // Giữ lại hình ảnh cũ nếu không chọn file mới
                }
                update_user($ma_nguoi_dung, $ho_ten, $email, $so_dien_thoai, $dia_chi, $hinh);

                // Cập nhật thông tin session
                $_SESSION['user']['ten'] = $ho_ten;
                $_SESSION['user']['email'] = $email;
                $_SESSION['user']['so_dien_thoai'] = $so_dien_thoai;
                $_SESSION['user']['dia_chi'] = $dia_chi;
                $_SESSION['user']['anh_dai_dien'] = $hinh;

                $_SESSION['thongbao'] = "Cập nhật tài khoản thành công!";
                header("Location: index.php?act=update_account");
                exit();
            }
            include './views/account/capnhattaikhoan.php';
            break;

        default:
            include './views/home.php';
            break;
    }
} else {
    include './views/home.php';
}
include './views/footer.php';



ob_end_flush();
