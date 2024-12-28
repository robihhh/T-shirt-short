<?php
session_start();

// Simulate a cart using session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Get product ID from the form
$product_id = $_POST['product_id'];

// Simulate fetching product details from the database
include 'checkout.php';
$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
    // Add product to cart
    $_SESSION['cart'][] = $product;
    echo "<script>alert('Product added to cart!'); window.location.href='index.php';</script>";
} else {
    echo "<script>alert('Product not found'); window.location.href='index.php';</script>";
}

$stmt->close();
mysqli_close($conn);
?>
