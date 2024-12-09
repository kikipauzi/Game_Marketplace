<?php
session_start();
require 'db.php';  // Pastikan sudah terhubung ke database

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Ambil informasi user dari sesi
$user_id = $_SESSION['user_id'];

// Ambil username dari sesi yang sudah disimpan
$username = $_SESSION['username'];

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "marketplace");

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Logika pencarian
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
$category = isset($_GET['category']) ? $conn->real_escape_string($_GET['category']) : '';

// Query untuk mengambil produk
$query = "SELECT * FROM produk WHERE nama LIKE '%$search%'";
if (!empty($category)) {
    $query .= " AND kategori = '$category'";
}
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketplace Game Online</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Header -->
    <header>
    <div class="logo">
        <h1>Game Marketplace</h1>
    </div>
    <div class="search-bar">
        <form method="GET" action="">
            <input type="text" name="search" placeholder="Cari produk..." value="<?= htmlspecialchars($search) ?>">
            <button type="submit">Search</button>
        </form>
    </div>
    <div class="user-settings">
        <?php if (isset($_SESSION['user_id'])): ?>
            <!-- Tampilkan username dan tombol Logout -->
            <p>Welcome, <?= htmlspecialchars($username) ?></p>
            <a href="forgot_password.php">Ubah sandi</a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <!-- Tampilkan tombol Login jika belum login -->
            <a href="login.php">Login</a>
        <?php endif; ?>
    </div>
    </header>

    <!-- Kategori -->
    <nav class="categories">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="?category=akun">Akun</a></li>
            <li><a href="?category=item game">Item Game</a></li>
            <li><a href="?category=top up">Top Up</a></li>
            <li><a href="?category=game">Kategori Game</a></li>
        </ul>
    </nav>

    <!-- Produk -->
    <main class="products">
        <h2>Daftar Produk</h2>
        <div class="product-list">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="product-item">
                        <img src="images/<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['nama']) ?>" class="product-img">
                        <h3><?= htmlspecialchars($row['nama']) ?></h3>
                        <p>Kategori: <?= htmlspecialchars($row['kategori']) ?></p>
                        <p>Harga: Rp <?= number_format($row['harga'], 0, ',', '.') ?></p>
                        <p><?= htmlspecialchars($row['deskripsi']) ?></p>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Tidak ada produk ditemukan.</p>
            <?php endif; ?>
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
