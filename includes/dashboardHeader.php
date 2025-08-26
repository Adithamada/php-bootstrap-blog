<?php
require_once __DIR__ . '/../config/db.php'; // memuat BASE_PATH, koneksi DB, dll
require_once BASE_PATH . '/config/validationFunction.php';
require_once BASE_PATH . '/config/authFunction.php';
require_once BASE_PATH . '/config/categoriesFunction.php';

$currentDir = basename(dirname($_SERVER['SCRIPT_NAME']));

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - 
        <?php if($currentDir == 'dashboard'){echo "dashboard";}
        elseif($currentDir == 'categories'){echo "categories";}
        else{echo "";}?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary border">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Blog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?= ($currentDir == "dashboard") ? 'active' : '' ?>" aria-current="page" href="../dashboard/index.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($currentDir == "blog") ? 'active' : '' ?>" href="../dashboard/blog/index.php">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($currentDir == "categories") ? 'active' : '' ?>" href="../dashboard/categories/index.php">Category</a>
                    </li>
                    <?php if ($_SESSION['role'] == "Admin"): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#">User</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= $_SESSION['name'] . " - " . $_SESSION['role'] ?>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/../../views/auth/logout.php">Log Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>