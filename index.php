<?php
// Include database connection
include 'koneksi.php';

// Fetch products from the database
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);

// Check for query success
if (!$result) {
    die('Error fetching products: ' . mysqli_error($conn));
}

// Close the connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            margin: 0 auto;
        }
        h1 {
            text-align: center;
            color: #333;
            padding: 20px 0;
        }
        .product-list {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }
        .product {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin: 10px;
            padding: 15px;
            width: 250px;
            text-align: center;
        }
        .product img {
            max-width: 100%;
            border-radius: 8px;
        }
        .product h3 {
            color: #333;
        }
        .product p {
            color: #555;
        }
        .product .price {
            font-size: 20px;
            color: #e74c3c;
            font-weight: bold;
        }
        .product button {
            padding: 10px 15px;
            background-color: #2ecc71;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .product button:hover {
            background-color: #27ae60;
        }
        .cart {
            margin-top: 30px;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Our Products</h1>
        
        <div class="product-list">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="product">
                    <img src="<?= htmlspecialchars($row['image_url']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
                    <h3><?= htmlspecialchars($row['name']) ?></h3>
                    <p><?= htmlspecialchars($row['description']) ?></p>
                    <p class="price">$<?= number_format($row['price'], 2) ?></p>
                    <form action="add_to_cart.php" method="POST">
                        <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                        <button type="submit">Add to Cart</button>
                    </form>
                </div>
            <?php endwhile; ?>
        </div>

        <div class="cart">
            <a href="cart.php">View Cart</a>
        </div>
    </div>

</body>
</html>
