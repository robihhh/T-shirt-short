<?php
session_start();

// If the cart is empty, redirect to the product page
if (empty($_SESSION['cart'])) {
    header('Location: index.php');
    exit;
}

$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'];
}

echo "<h1>Checkout</h1>";
echo "<p>Total amount: \${$total}</p>";
echo "<form method='POST' action='process_checkout.php'>
        <input type='text' name='name' placeholder='Enter your name' required>
        <input type='email' name='email' placeholder='Enter your email' required>
        <button type='submit'>Place Order</button>
      </form>";
?>
