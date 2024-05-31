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
                        <h2>Hoàn tất</h2>
                        <div class="breadcrumb__option">
                            <a href="../index.php">Home</a>
                            <span>Hoàn tất</span>
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
            <h4 style="text-align:center";>Cảm ơn bạn đã đặt hàng trên hệ thống của chúng tôi <br>Chúng tôi sẽ liên hệ với bạn để chốt đơn hàng</h4>
            
            
        </div>
    </div>
</section>

    <!-- Checkout Section End -->

    <!-- Footer Section Begin -->
    <?php

require_once('components/footer.php');
?>