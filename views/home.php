<?php include_once "header.php" ?>

<main>
    <div class="banner">
        <div class="banner-left">
            <img src="" alt="" id="slideshow">
            <button id="prev"><img src="./img/arrow-previous-left-icon.png" alt=""></button>
            <button id="next"><img src="./img/arrow-next-right-icon.png" alt=""></button>
        </div>
        <div class="banner-right">
            <div class="banner-right-top">
                <img src="img/banner2.webp" alt="">
            </div>
            <div class="banner-right-bottom">
                <img src="img/banner3.webp" alt="">
            </div>
        </div>
    </div>

    <div class="category">
        <h2>DANH MỤC SẢN PHẨM</h2>
        <hr>

        <ul>
            <?php foreach ($danhmuc as $danhmuc) : ?>
                <div class="img-danhmuc">
                    <a href="index.php?ctl=danhmuc_sach&id_dm=<?= $danhmuc['id_dm'] ?>">
                        <img src="img/<?= $danhmuc['img_dm'] ?>" alt="">
                        <li><?= $danhmuc['name_dm'] ?></li>
                    </a>

                </div>
            <?php endforeach ?>
        </ul>

    </div>


    <article>
        <h2>SẢN PHẨM</h2>
        <hr>
        <div class="books">
            <?php foreach ($sach as $sach) : ?>
                <div class="book">
                    <a href="index.php?ctl=chi_tiet&id_sp=<?= $sach['id_sp'] ?>">
                        <img src="img/<?= $sach['img_sp'] ?>" alt="">
                        <h4><?= $sach['name_sp'] ?></h4>
                        <p><?= number_format($sach['price_sp'], 0, '', '.') ?>đ</p>
                        <p>-20%</p>
                        <p><del>50.000đ</del></p>
                    </a>
                </div>
            <?php endforeach ?>

        </div>

    </article>

    <div class="new-products">
        <h2>Sản phẩm mới</h2>
        <hr>

        <ul>
            <?php foreach ($new_sp as $sach) : ?>
                <div class="new-product-item">
                    <a href="index.php?ctl=chi_tiet&id_sp=<?= $sach['id_sp'] ?>">
                        <p class="new">NEW</p>
                        <img src="img/<?= $sach['img_sp'] ?>" alt="">
                        <li><?= $sach['name_sp'] ?></li>
                    </a>
                </div>
            <?php endforeach ?>
        </ul>
    </div>

    <div class="top-products">
        <h2>TOP SẢN PHẨM YÊU THÍCH</h2>
        <hr>

        <ul>
            <?php foreach ($top_sp as $index => $sach) : ?>
                <div class="top-product-item">
                    <a href="index.php?ctl=chi_tiet&id_sp=<?= $sach['id_sp'] ?>">
                        <div class="rank"><?= $index + 1 ?></div> <!-- Hiển thị thứ tự (index bắt đầu từ 0) -->
                        <img src="img/<?= $sach['img_sp'] ?>">
                        <li><?= $sach['name_sp'] ?></li>
                    </a>

                </div>
            <?php endforeach ?>
        </ul>

    </div>


</main>
<script src="./javaScript/javaBannerHome.js"></script>
<?php include_once "footer.php" ?>