<?php

// Lấy ID của brand cần xóa
$delid = $_GET['id'];

// Kiểm tra và làm sạch dữ liệu đầu vào
if (!filter_var($delid, FILTER_VALIDATE_INT)) {
    die("ID không hợp lệ");
}

// Kết nối cơ sở dữ liệu
require('../db/conn.php');

// Sử dụng câu lệnh chuẩn bị để ngăn chặn SQL injection
$sql_str = "DELETE FROM brands WHERE id = ?";
$stmt = $conn->prepare($sql_str);

if ($stmt) {
    $stmt->bind_param("i", $delid);

    if ($stmt->execute()) {
        // Chuyển hướng về trang danh sách brands sau khi xóa thành công
        header("Location: listbrands.php");
        exit();
    } else {
        // Lỗi khi thực thi câu lệnh
        echo "Lỗi xóa bản ghi: " . $stmt->error;
    }

    $stmt->close();
} else {
    // Lỗi khi chuẩn bị câu lệnh
    echo "Lỗi chuẩn bị câu lệnh: " . $conn->error;
}

$conn->close();
?>
