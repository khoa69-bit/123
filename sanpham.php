<?php
$is_homepage = false;
session_start();
?>
    <?php
    require_once ('./db/conn.php');
    if (isset($_POST['atcbtn'])){
        $id = $_POST['pid'];
        $qty = $_POST['qty'];
        $cart = [];
        if (isset($_SESSION['cart'])){
            $cart = $_SESSION['cart'];
        }
        $isFound = false;
        for ($i = 0; $i < count($cart); $i++){
            if ($cart[$i]['id'] == $id){
                $cart[$i]['qty']+= $qty;
                $isFound = true;
                break;
        }
       
    }
    if (!$isFound){
        $sql_str = "select * from products where id = $id";
        // echo $sql_str; exit;
        $result = mysqli_query($conn, $sql_str);
        $product = mysqli_fetch_assoc($result);
        $product['qty'] = $qty;
        $cart[] = $product;
    }
 
    $_SESSION['cart'] = $cart;
}
    require_once('components/header.php');



    $idsp = $_GET['id'];
    $sql_str = "SELECT * FROM products where id=$idsp";
    $result = mysqli_query($conn, $sql_str);
    $row = mysqli_fetch_assoc($result);
    $anh_arr = explode(';', $row['images']); 
    ?>
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2><?php echo $row['name'];?></h2>
                        <div class="breadcrumb__option">
                            <a href="./index.php">Trang chủ</a>
                            <a href="./shop.php">Sản phẩm</a>
                            <span><?php echo $row['name'];?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
            <?php
                            require_once ('./db/conn.php');
                            $idsp = $_GET['id'];
                            $sql_str = "SELECT * FROM products where id=$idsp";
                            $result = mysqli_query($conn, $sql_str);
                            $row = mysqli_fetch_assoc($result);
                            $anh_arr = explode(';', $row['images']); 
                            ?>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="<?php echo "quantri/".$anh_arr[0]; ?>" alt="<?php echo $row['name']; ?>">
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
    <?php
    // Giả sử $anh_arr đã được khởi tạo trước đó và chứa các đường dẫn đến ảnh
    for ($i = 0; $i < count($anh_arr); $i++) {
        ?>
        <img data-imgbigurl="<?php echo "quantri/" . $anh_arr[$i]; ?>"
             src="<?php echo "quantri/" . $anh_arr[$i]; ?>" alt="<?php echo $row['name']; ?>">
        <?php
    }
    ?>
</div>

                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3><?php echo $row['name'];?></h3>
                        <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <span>(18 reviews)</span>
                        </div>
                        <div class="product__details__price"><?php echo $row['disscounted_price'];?></div>
                        <p><?php echo $row['summary'];?></p>
                        <form method="post">
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" value="1">
                                    <input type="hidden" value="1" name="qty">
                                    
                                </div>
                                <input type="hidden" name="pid" value="<?=$idsp?>" >
                            </div>
                        </div>
                        <button class="primary-btn" name="atcbtn">Thêm vào giỏ hàng</button>
                        </form>
                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        <ul>
                            <li><b>Availability</b> <span>In Stock</span></li>
                            <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
                            <li><b>Weight</b> <span>0.5 kg</span></li>
                            <li><b>Share on</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Mô tả sản phẩm</a>
                            </li>
                           
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">Đánh giá <span>(1)</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Thông tin sản phẩm</h6>
                                  <p><?php echo $row['description'];?></p>
                                </div>
                            </div>
                            
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Đánh giá sản phẩm</h6>
                                    <p>(Đang hoàng thiện chức năng)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Sản phẩm liên quan</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
//tìm các sản phẩm liên quan cùng category_id với sản phẩm này
$dmid = $row['category_id'];
$sql2 = "select * from products where category_id=$dmid and id <> $idsp";
$result2 = mysqli_query($conn, $sql2);
while ($row2 = mysqli_fetch_assoc($result2)) {
    $arrs = explode(",", $row2["images"]);
                ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="<?= "quantri/". $arrs[0]?>">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="sanpham.php?id=<?=$row2['id']?>"><?=$row2['name']?></a></h6>
                            <h5><?=$row2['disscounted_price']?></h5>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->

    <!-- Footer Section Begin -->
    <?php

require_once('components/footer.php');
?>