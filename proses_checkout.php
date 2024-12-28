<?php
session_start();

// Simulate processing the checkout (saving order, etc.)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $total = 0;
    
    // Calculate total
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'];
    }

    // Simulate saving order in the database
    include 'checkout.php';
    $sql = "INSERT INTO orders (name, email, total) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssd", $name, $email, $total);
    $stmt->execute();

    // Clear cart after successful order
    $_SESSION['cart'] = [];

    echo "<h1>Order placed successfully!</h1>";
    echo "<p>Thank you for your purchase. A confirmation email has been sent to {$email}.</p>";
    echo "<a href='index.php'>Back to Products</a>";

    $stmt->close();
    mysqli_close($conn);
}
?>
