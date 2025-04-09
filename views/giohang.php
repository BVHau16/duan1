<main>
    <?php if(!empty($_SESSION['cart'])) { ?> 
    <div class="cart-main-wrapper section-padding">
            <div class="container">
                <div class="section-bg-color">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cart-table table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th>Ảnh Sản Phẩm</th>
                                            <th>Màu</th>
                                            <th>Giá</th>
                                            <th>Số lượng</th>
                                            <th>Thành tiền</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $tong_tien_gio_hang = 0; // Tổng tiền của toàn giỏ hàng
                                        foreach ($_SESSION['cart'] as $item) {
                                            $tong_tien = $item['gia'] * $item['so_luong'];
                                            $tong_tien_gio_hang += $tong_tien;
                                            echo '<tr>';
                                            echo '<td>' . htmlspecialchars($item['ten']) . '</td>';
                                            echo '<td><img src="' . $item['anh_san_pham'] . '" alt="" width="220px" height="150px"></td>';
                                            echo '<td>' . htmlspecialchars($item['mau_sac']) . '</td>';
                                            echo '<td>' . number_format($item['gia']) . ' đ</td>';
                                            echo '<td>' . $item['so_luong'] . '</td>';
                                            echo '<td>' . number_format($tong_tien) . ' đ</td>';
                                            echo '<td class="pro-remove"><a href="index.php?act=removefromcart&id=' . $item['id'] . '&color=' . urlencode($item['mau_sac']) . '"><i class="fa fa-trash-o"></i></a></td>';
                                            echo '</tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 ml-auto">
                        <!-- Cart Calculation Area -->
                        <div class="cart-calculator-wrapper">
                            <div class="cart-calculate-items">
                                <h6>Cart Totals</h6>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <td>Tổng Tiền Giỏ Hàng</td>
                                            <td><?= number_format($tong_tien_gio_hang) ?> đ</td>
                                        </tr>
                                        <tr>
                                            <td>Phí Vận Chuyển</td>
                                            <td>30,000 đ</td>
                                        </tr>
                                        <tr class="total">
                                            <td>Tổng</td>
                                            <td class="total-amount"><?= number_format($tong_tien_gio_hang + 30000) ?> đ</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <a href="index.php?act=checkout" class="btn btn-sqr d-block">Thanh Toán</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } else { ?>
        <!-- Trường hợp giỏ hàng trống -->
        <div class="cart-main-wrapper section-padding">
            <div class="container">
                <div class="section-bg-color">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cart-table table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th>Ảnh Sản Phẩm</th>
                                            <th>Màu</th>
                                            <th>Giá</th>
                                            <th>Số lượng</th>
                                            <th>Thành tiền</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="7" class="text-center">
                                                <p>Chưa có sản phẩm trong giỏ hàng</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    <?php } ?>
</main>