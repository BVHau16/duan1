<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Đăng Ký</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- login register wrapper start -->
    <div class="login-register-wrapper section-padding">
        <div class="container">
            <div class="member-area-from-wrap">
                <div class="row">
                <?php
if (isset($thongbao)) {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Thông báo:</strong> ' . $thongbao . '
            
          </div>';
}
?>

                    <!-- Register Content Start -->
                    <div class="col-lg-12">
                        <div class="login-reg-form-wrap sign-up-form">
                            <h5 class="text-center">Đăng Ký</h5>
                            <form method="POST" enctype="multipart/form-data">
                                <div class="single-input-item">
                                    <input type="text" name="ten" placeholder="Tên" required />
                                </div>
                                <div class="single-input-item">
                                    <input type="email" name="email" placeholder="Nhập Email" required />
                                </div>
                                <div class="single-input-item">
                                    <label for="exampleFormControlInput1" class="form-label">Ảnh đại diện</label>
                                    <input type="file" name="anh_dai_dien" />
                                </div>
                                <div class="single-input-item">
                                    <input type="number" name="so_dien_thoai" placeholder="Nhập Số Điện Thoại" required />
                                </div>
                                <div class="single-input-item">
                                    <input type="text" name="dia_chi" placeholder="Nhập Địa Chỉ" required />
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="single-input-item">
                                            <input type="password" name="mat_khau" placeholder="Nhập Mật Khẩu" required />
                                        </div>
                                    </div>

                                </div>
                                <div class="single-input-item">
                                        <div class="login-reg-form-meta d-flex align-items-center ">
                                            <a href="index.php?act=dangnhap" class=" p-2">Bạn đã có tài khoản ?</a>
                                           
                                        </div>
                                       
                                    </div>

                                <div class="single-input-item">
                                    <button type="submit" class="btn btn-sqr">Đăng Ký</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Register Content End -->
                </div>
            </div>
        </div>
    </div>
    <!-- login register wrapper end -->
</main>