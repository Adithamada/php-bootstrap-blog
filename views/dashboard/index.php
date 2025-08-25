<?php
session_start();
require_once __DIR__ . '/../../config/db.php'; // memuat BASE_PATH, koneksi DB, dll
require_once BASE_PATH . '/includes/dashboardHeader.php';

redirectIfNotLogged();
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Blog - Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">BLog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Category</a>
                </li>
                <?php if ($_SESSION['role'] == "Admin"): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#">User</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
        <div class="">
            <p><?= $_SESSION['name'] . " - " . $_SESSION['role'] ?></p>
        </div>
    </div>
</nav>

<form action="../auth/logout.php" method="post">
    <button type="submit">Log Out</button>
</form>

<?php
require_once BASE_PATH . '/includes/dashboardFooter.php';
?>