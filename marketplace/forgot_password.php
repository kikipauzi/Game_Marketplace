<?php
// Koneksi ke database menggunakan PDO
try {
    $conn = new PDO("mysql:host=localhost;dbname=marketplace", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validasi input
    if (empty($email) || empty($new_password) || empty($confirm_password)) {
        $error = "Semua kolom wajib diisi.";
    } elseif ($new_password !== $confirm_password) {
        $error = "Password dan konfirmasi password tidak cocok.";
    } else {
        // Cek apakah email ada di database
        $query = "SELECT id FROM users WHERE email = :email";
        $stmt = $conn->prepare($query);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Hash password baru
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Perbarui password di database
            $updateQuery = "UPDATE users SET password = :password WHERE email = :email";
            $updateStmt = $conn->prepare($updateQuery);
            $updateStmt->bindValue(':password', $hashed_password, PDO::PARAM_STR);
            $updateStmt->bindValue(':email', $email, PDO::PARAM_STR);
            $updateStmt->execute();

            $success = "Password berhasil diperbarui. Silakan login.";
        } else {
            $error = "Email tidak ditemukan.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="container">
        <h1>Reset Password</h1>
        <form method="POST" action="">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
            
            <label for="new_password">Password Baru:</label>
            <input type="password" name="new_password" id="new_password" required>
            
            <label for="confirm_password">Konfirmasi Password:</label>
            <input type="password" name="confirm_password" id="confirm_password" required>
            
            <button type="submit" class="btn">Reset Password</button>
        </form>
        <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <a href="login.php">Kembali ke Login</a>
    </div>
</body>
</html>
