<?php

// Lấy id từ yêu cầu GET
$delid = $_GET['id'];

// Kết nối cơ sở dữ liệu
require('../db/conn.php');

// Xóa các bản ghi liên quan trong bảng order_details
$deleteOrderDetailsQuery = "DELETE FROM order_details WHERE product_id IN (SELECT id FROM products WHERE category_id = $delid)";
if (mysqli_query($conn, $deleteOrderDetailsQuery)) {
    // Nếu xóa thành công các bản ghi liên quan, tiến hành xóa các sản phẩm thuộc danh mục
    $deleteProductsQuery = "DELETE FROM products WHERE category_id = $delid";
    if (mysqli_query($conn, $deleteProductsQuery)) {
        // Nếu xóa sản phẩm thành công, tiến hành xóa danh mục
        $deleteCategoryQuery = "DELETE FROM categories WHERE id = $delid";
        if (mysqli_query($conn, $deleteCategoryQuery)) {
            // Trở về trang danh sách các danh mục
            header("location: listcats.php");
        } else {
            echo "Lỗi khi xóa danh mục: " . mysqli_error($conn);
        }
    } else {
        echo "Lỗi khi xóa sản phẩm: " . mysqli_error($conn);
    }
} else {
    echo "Lỗi khi xóa bản ghi trong bảng order_details: " . mysqli_error($conn);
}

?>
