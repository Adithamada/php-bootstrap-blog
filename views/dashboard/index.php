<?php
session_start();
require_once __DIR__ . '/../../config/db.php'; // memuat BASE_PATH, koneksi DB, dll
require_once BASE_PATH . '/includes/dashboardHeader.php';

redirectIfNotLogged();
?>



<?php
require_once BASE_PATH . '/includes/dashboardFooter.php';
?>