<?php
// Konfigurasi koneksi database
$host     = "localhost";   // atau IP server database
$dbname   = "blog";
$username = "root";        // default XAMPP biasanya 'root'
$password = "";            // default XAMPP kosong

try {
    // Buat koneksi menggunakan PDO
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Set mode error agar PDO lempar exception kalau ada masalah
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Kalau koneksi berhasil, bisa hapus ini di production
    // echo "Koneksi database berhasil!";
} catch (PDOException $e) {
    // Jika gagal koneksi
    die("Koneksi database gagal: " . $e->getMessage());
}