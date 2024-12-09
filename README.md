# Game_Marketplace
marketplace simpe hanya dengan 2 bahasa pemrograman, hanya dengan php dan css. Mencangkup Login,register,index,reset password, dan produk.

1. bahasa yang digunakan php,css

2. aplikasi yang diperlukan VScode,Xampp,Chrome

3. aktifkan Apache dan mysql di Xampp

4. buka terminal di Xampp

5. mysql -u root

6. create Database marketplace;

7. use marketplace;

8. CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

9. CREATE TABLE produk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    kategori VARCHAR(50) NOT NULL,
    harga DECIMAL(10,2) NOT NULL,
    deskripsi TEXT,
    gambar VARCHAR(255)
);

10. INSERT INTO produk (nama, kategori, harga, deskripsi, gambar)
VALUES 
('Akun Game Legend', 'akun', 150000.00, 'Akun dengan level tinggi dan item premium.', 'akun1.jpg'),
('Item Pedang Sakti', 'item game', 50000.00, 'Pedang legendaris dengan kekuatan besar.', 'item1.jpg'),
('Top-Up 500 Diamonds', 'top up', 75000.00, 'Top-up 500 diamonds untuk game favorit Anda.', 'topup1.jpg'),
('Game Terbaik 2024', 'game', 300000.00, 'Game terbaru dengan grafis luar biasa.', 'game1.jpg');

11. struktur projek
marketplace
    css
        login.css
        produk.css
        style.css
    images
        akun1.jpg
        game1.jpg
        item1.jpg
        topup1.jpg
    db.php
    forgot_password.php
    index.php
    login.php
    logout.php
    produk.php
    register.php
    user_info.php

12. masukan code sesuai dengan struktur yang ada setelah Database dan table di buat, silahkan dicoba
