<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/bb7fdf5ca5.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <section class="header">
            <div class="logo-header">
                <a href="index.php"><img src="img/fahasa-logo.webp" alt=""></a>
            </div>

            <div class="menu">
                <ul>
                    <li><a href="index.php">Trang Chủ</a></li>
                    <li><a href="index.php?ctl=store">Cửa Hàng</a></li>
                    <li><a href="index.php?ctl=baiviet">Bài Viết</a></li>
                    <li><a href="index.php?ctl=lienhe">Liên Hệ</a></li>
                    <li><a href="index.php?ctl=gioithieu">Giới Thiệu</a></li>
                </ul>
            </div>

            <div class="form-timkiem">
                <form action="">
                    <input type="search" placeholder="Tìm kiếm..." id="keyword">
                    <button type="button" id="search"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>

            <div class="item">
                <ul>
                    <?php if (isset($_SESSION['khachhang'])) : ?>
                        <li><a href="index.php?ctl=form_update_user"><i class="fa-solid fa-circle-user"></i></a></li>
                        <li><a href="index.php?ctl=logout"><i class="fa-solid fa-right-from-bracket"></i></a></li>
                        <li><a href="index.php?ctl=gio_hang" aria-label="Shopping Cart"><i class="fa-solid fa-cart-shopping"></i>(<?= $_SESSION['totalQuantity'] ?? '0' ?>)</a></li>
                    <?php else : ?>
                        <li><a href="index.php?ctl=form_dangnhap" aria-label="User Profile"><i class="fa-solid fa-user"></i></a></li>
                        <li><a href="index.php?ctl=gio_hang" aria-label="Shopping Cart"><i class="fa-solid fa-cart-shopping"></i>(<?= $_SESSION['totalQuantity'] ?? '0' ?>)</a></li>
                    <?php endif ?>
                </ul>
            </div>
        </section>
    </header>