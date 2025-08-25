<?php
session_start();
require_once __DIR__ . '/../../config/db.php'; // memuat BASE_PATH, koneksi DB, dll
require_once BASE_PATH . '/includes/header.php';

redirectIfNotLogged();
?>

Selamat Datang <?= $_SESSION['name'] ?>
<form action="../auth/logout.php" method="post">
    <button type="submit">Log Out</button>
</form>

<?php
require_once BASE_PATH . '/includes/footer.php';
?>
