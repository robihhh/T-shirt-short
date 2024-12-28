<?php
session_start();

// Cek jika keranjang kosong
if (empty($_SESSION['cart'])) {
    echo "<p>Keranjang belanja Anda kosong.</p>";
} else {
    echo "<h1>Keranjang Belanja Anda</h1><table><tr><th>Produk</th><th>Harga</th><th>Kuantitas</th><th>Subtotal</th></tr>";
    $total = 0;

    // Looping untuk menampilkan setiap item dalam keranjang
    foreach ($_SESSION['cart'] as $item) {
        // Menghitung subtotal untuk setiap item
        $subtotal = $item['price'] * $item['quantity'];
        $total += $subtotal;  // Menambahkan subtotal ke total keseluruhan

        // Menampilkan data produk
        echo "<tr>
                <td>{$item['name']}</td>
                <td>\${number_format($item['price'], 2)}</td>  <!-- Format harga dengan dua desimal -->
                <td>{$item['quantity']}</td>  <!-- Menampilkan kuantitas produk -->
                <td>\${number_format($subtotal, 2)}</td>  <!-- Format subtotal dengan dua desimal -->
              </tr>";
    }

    // Menampilkan total akhir
    echo "<tr><td colspan='3'>Total</td><td>\${number_format($total, 2)}</td></tr></table>";
    echo "<a href='checkout.php'>Lanjutkan ke Pembayaran</a>";
}
?>
