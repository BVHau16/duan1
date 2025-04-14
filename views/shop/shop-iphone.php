<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Danh Sách Iphone</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- page main wrapper start -->
    <div class="shop-main-wrapper section-padding">
        <div class="container">
            <div class="row">
                <!-- filter sidebar start -->
                <div class="col-lg-3">
                    <div class="filter-sidebar">
                        <h5 class="filter-title">Bộ lọc tìm kiếm</h5>
                        <form action="index.php?act=shopiphone" method="post" id="filterForm">
                            <div class="filter-section">
                                <h6>Mức giá</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="price_range[]" value="all" id="all" onchange="selectAllRanges(this)">
                                    <label class="form-check-label" for="all">Tất cả</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="price_range[]" value="0-2000000" id="under2m" onchange="updateRanges()">
                                    <label class="form-check-label" for="under2m">Dưới 2 triệu</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="price_range[]" value="2000000-4000000" id="2to4m" onchange="updateRanges()">
                                    <label class="form-check-label" for="2to4m">Từ 2 - 4 triệu</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="price_range[]" value="4000000-7000000" id="4to7m" onchange="updateRanges()">
                                    <label class="form-check-label" for="4to7m">Từ 4 - 7 triệu</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="price_range[]" value="7000000-13000000" id="7to13m" onchange="updateRanges()">
                                    <label class="form-check-label" for="7to13m">Từ 7 - 13 triệu</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="price_range[]" value="13000000-20000000" id="13to20m" onchange="updateRanges()">
                                    <label class="form-check-label" for="13to20m">Từ 13 - 20 triệu</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="price_range[]" value="20000000+" id="above20m" onchange="updateRanges()">
                                    <label class="form-check-label" for="above20m">Trên 20 triệu</label>
                                </div>
                                <div class="mt-3">
                                    <label for="customPriceRange" class="form-label">Nhập khoảng giá phù hợp với bạn:</label>
                                    <div class="d-flex align-items-center">
                                        <input type="number" id="customMinPrice" name="custom_min_price" class="form-control me-2" placeholder="Từ" min="0" value="0" oninput="resetRanges()">
                                        <span>~</span>
                                        <input type="number" id="customMaxPrice" name="custom_max_price" class="form-control ms-2" placeholder="Đến" min="0" value="0" oninput="resetRanges()">
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary mt-3 filter-btn" onclick="submitFilterForm()">
                                    <i class="fa fa-filter me-2"></i>Lọc sản phẩm
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- filter sidebar end -->

                <!-- shop main wrapper start -->
                <div class="col-lg-9">
                    <div class="shop-product-wrapper">
                        <!-- shop product top wrap start -->
                        <div class="shop-top-bar">
                            <div class="row align-items-center">
                                <div class="col-lg-7 col-md-6 order-2 order-md-1">
                                    <div class="top-bar-left">
                                        <div class="product-view-mode">
                                            <a class="active" href="#" data-target="grid-view" data-bs-toggle="tooltip" title="Grid View"><i class="fa fa-th"></i></a>

                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-6 order-1 order-md-2">
                                    <div class="top-bar-right">
                                        <form action="index.php?act=shopiphone" method="post" class="header-search-box d-lg-none d-xl-block">
                                            <input type="text" name="kyw" placeholder="Search entire store hire" class="header-search-field">
                                            <button type="submit" name="timkiem" class="header-search-btn"><i class="pe-7s-search"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- shop product top wrap start -->

                        <!-- product item list wrapper start -->
                        <div class="shop-product-wrap grid-view row mbn-30">
                            <!-- product single item start -->
                            <?php


                            foreach ($product_shop_iphone as $product) {
                                extract($product);
                                $anh = "./uploads/" . $anh_san_pham;
                                $linksp = "index.php?act=chitietsanpham&ma_san_pham=" . $ma_san_pham;
                                // Chuyển đổi chuỗi màu sắc thành mảng
                                $mau_sac_arr = explode(',', $mau_sac);
                                echo '
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <!-- product grid start -->
                                    <div class="product-item">
                                        <figure class="product-thumb">
                                            <a href="' . $linksp . '">
                                                <img class="pri-img" src="' . $anh . '" alt="product">
                                                <img class="sec-img" src="' . $anh . '" alt="product">
                                            </a>
                                            <div class="product-badge">
                                                <div class="product-label new">
                                                    <span>new</span>
                                                </div>
                                              
                                            </div>
                                           
                                          
                                        </figure>
                                        <div class="product-caption text-center">
                                            <div class="product-identity">
                                             
                                            </div>
                                            <ul class="color-categories">';

                                // Đổ danh sách màu sắc
                                foreach ($mau_sac_arr as $mau) {
                                    echo '<li class="d-inline-block mx-1">
                                                        <a class="color-circle" href="#" style="background-color: ' . trim($mau) . ';" title="' . ucfirst(trim($mau)) . '"></a>
                                                    </li>';
                                }

                                echo ' </ul>
                                            <h6 class="product-name">
                                                <a href="' . $linksp . '">' . $ten_san_pham . '</a>
                                            </h6>
                                            <div class="price-box">
                                                <span class="price-regular">' . number_format($gia) . ' đ</span>
                                             
                                            </div>
                                        </div>
                                    </div>
                                    <!-- product grid end -->
                                    
                                </div>  ';
                            }
                            ?>
                        </div>

                    </div>
                </div>
                <!-- shop main wrapper end -->
            </div>
        </div>
    </div>
    <!-- page main wrapper end -->
    <script>
        function selectAllRanges(checkbox) {
            if (checkbox.checked) {
                document.querySelectorAll('.form-check-input[name="price_range[]"]').forEach(input => {
                    if (input.id !== 'all') input.checked = false;
                });
                document.getElementById('customMinPrice').value = 0;
                document.getElementById('customMaxPrice').value = 0;
            }
        }

        function updateRanges() {
            const allCheckbox = document.getElementById('all');
            allCheckbox.checked = false;
            document.getElementById('customMinPrice').value = 0;
            document.getElementById('customMaxPrice').value = 0;
        }

        function resetRanges() {
            document.querySelectorAll('.form-check-input[name="price_range[]"]').forEach(input => {
                input.checked = false;
            });
            document.getElementById('all').checked = true;
        }

        function submitFilterForm() {
            document.getElementById('filterForm').submit();
        }
    </script>
</main>