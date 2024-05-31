<?php
$is_homepage = false;
session_start();
?>
    <?php
    require_once ('./db/conn.php');
   
    require_once('components/header.php');

    ?>
   

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Giỏ hàng</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Giỏ hàng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <h4>Giỏ hàng</h4>
            <form action="#">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="checkout__order">
                            <h4>Your Order</h4>
                            <div class="checkout__order__products">Products <span>Total</span></div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Đơn giá</th>
                                        <th>Số lượng</th>
                                        <th>Thành tiền</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
                                    $count = 0;
                                    $total = 0;
                                    foreach ($cart as $item) {
                                        $total += $item['qty'] * $item['disscounted_price'];
                                        ?>
                                        <tr>
                                            <form action="updatecart.php?id=<?= $item['id']?>" method="post">
                                                <td><?= ++$count ?></td>
                                                <td><?= htmlspecialchars($item['name']) ?></td>
                                                <td><?= number_format($item['disscounted_price'], 0, '', '.') . " VNĐ" ?></td>
                                                <td><input type="number" name="qty" value="<?= $item['qty'] ?>" min="1" /></td>
                                                <td><?= number_format(($item['disscounted_price'] * $item['qty']), 0, '', '.') . " VNĐ" ?></td>
                                                <td><button class="btn btn-warning">Cập nhật</button></td>
                                            </form>
                                            <td><a href='./deletecart.php?id=<?= $item['id']?>' class="btn btn-danger">Xóa</a></td>
                                        </tr>
                                        <?php 
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="checkout__order__total">Tổng tiền <span><?= number_format($total, 0, '', '.') . " VNĐ" ?></span></div>
                            <div class="d-flex justify-content-between">
                                <a href="shop.php" class="btn btn-primary">Tiếp tục mua sắm</a>
                                <a href="thanhtoan.php" class="btn btn-success">Thanh toán</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

    <!-- Checkout Section End -->

    <!-- Footer Section Begin -->
    <?php

require_once('components/footer.php');
?>