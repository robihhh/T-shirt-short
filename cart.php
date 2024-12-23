<?php
session_start();

// Check if the cart is empty
if (empty($_SESSION['cart'])) {
    echo "<p>Your cart is empty.</p>";
} else {
    echo "<h1>Your Cart</h1><table><tr><th>Product</th><th>Price</th><th>Quantity</th></tr>";
    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        echo "<tr>
                <td>{$item['name']}</td>
                <td>\${$item['price']}</td>
                <td>1</td> <!-- Assuming one quantity per product for simplicity -->
              </tr>";
        $total += $item['price'];
    }
    echo "<tr><td colspan='2'>Total</td><td>\${$total}</td></tr></table>";
    echo "<a href='checkout.php'>Proceed to Checkout</a>";
}
?>
