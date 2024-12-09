<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "marketplace");

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil produk dari database
$query = "SELECT * FROM produk";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk - Game Marketplace</title>
    <link rel="stylesheet" href="produk.css">
</head>
<body>
    <header>
        <h1>Produk Marketplace</h1>
    </header>

    <!-- Daftar Produk -->
    <main class="products">
        <h2>Daftar Produk</h2>
        <div class="product-list">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="product-item">
                    <img src="images/<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['nama']) ?>" style="width: 150px; height: 150px;">
                    <h3><?= htmlspecialchars($row['nama']) ?></h3>
                    <p>Kategori: <?= htmlspecialchars($row['kategori']) ?></p>
                    <p>Harga: Rp <?= number_format($row['harga'], 0, ',', '.') ?></p>
                    <p><?= htmlspecialchars($row['deskripsi']) ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Game Marketplace</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>
