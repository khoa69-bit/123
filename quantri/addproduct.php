<?php

// Include the database connection
require('../db/conn.php');

// Get data from the form
$name = $_POST['name'];
$sumary = $_POST['sumary'];
$description = $_POST['description'];
$stock = $_POST['stock'];
$giagoc = $_POST['giagoc'];
$giaban = $_POST['giaban'];
$danhmuc = $_POST['danhmuc'];
$thuonghieu = $_POST['thuonghieu'];

// Function to generate a unique slug
function generateUniqueSlug($baseSlug, $conn) {
    $slug = $baseSlug;
    $counter = 1;
    while (true) {
        $query = "SELECT COUNT(*) FROM products WHERE slug = '$slug'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_row($result);
        if ($row[0] == 0) {
            break;
        }
        $slug = $baseSlug . '-' . $counter;
        $counter++;
    }
    return $slug;
}

// Generate the initial slug
$baseSlug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
$slug = generateUniqueSlug($baseSlug, $conn);

// Handle image upload
$countfiles = count($_FILES['anhs']['name']);
$imgs = '';

for ($i = 0; $i < $countfiles; $i++) {
    $filename = $_FILES['anhs']['name'][$i];
    $location = "uploads/" . uniqid() . $filename;
    $extension = strtolower(pathinfo($location, PATHINFO_EXTENSION));
    $valid_extensions = array("jpg", "jpeg", "png");

    if (in_array($extension, $valid_extensions)) {
        if (move_uploaded_file($_FILES['anhs']['tmp_name'][$i], $location)) {
            $imgs .= $location . ";";
        }
    }
}
$imgs = rtrim($imgs, ';');

// SQL query to insert into the products table
$sql_str = "INSERT INTO `products` (`id`, `name`, `slug`, `description`, `summary`, `stock`, `price`, `disscounted_price`, `images`, `category_id`, `brand_id`, `status`, `created_at`, `updated_at`) VALUES 
    (NULL, '$name', 
    '$slug', 
    '$description', '$sumary', $stock, $giagoc, $giaban, '$imgs', $danhmuc, $thuonghieu, 'Active', NULL, NULL);";

// Execute the query
if (mysqli_query($conn, $sql_str)) {
    // Redirect to the products list page
    header("location: ./listsanpham.php");
} else {
    echo "Error: " . mysqli_error($conn);
}

?>
