<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <!-- nhập content -->
                
                    <h2>Thống kê</h2>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Tổng số đơn hàng</h5>
                                    <p class="card-text"><?= $total_orders ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Doanh thu</h5>
                                    <p class="card-text"><?= number_format($total_revenue, 0, ',', '.') ?> VNĐ</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Tổng số sản phẩm đã bán</h5>
                                    <p class="card-text"><?= $total_products_sold ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="">Khách hàng mua hàng nhiều </h5>
                                    <p ><?php if($top_customer){
                                        echo 'Họ và tên :'. $top_customer['ten'];
                                        echo '<p>Số đơn hàng : '.$top_customer['total_orders'].'</p>';
                                    }else{
                                        echo 'chưa có khách hàng nào';
                                    }  ?> </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Thanh toán tiền mặt</h5>
                                    <p class="card-text"><?= $cash_orders ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Thanh toán chuyển khoản</h5>
                                    <p class="card-text"><?= $bank_orders ?></p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <h5>Sản phẩm bán chạy</h5>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Tên sản phẩm</th>
                                        <th>Số lượng bán</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($best_selling_products as $product): ?>
                                        <tr>
                                            <td><?= $product['ten_san_pham'] ?></td>
                                            <td><?= $product['total_quantity'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    
               

                <!-- nhập content -->
            </div>
        </div>
    </div>
</div>