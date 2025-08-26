<?php
session_start();
require_once __DIR__ . '/../../config/db.php';
require_once BASE_PATH . '/config/validationFunction.php';
require_once BASE_PATH . '/config/authFunction.php';
redirectIfLogged();

$errors = [];

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $errors = validateLoginInput($username, $password);

    if (empty($errors)) {
        $user = loginUser($username, $password);
        if ($user['status']) {
            $_SESSION['name'] = $user['user']['name'];
            $_SESSION['role'] = $user['user']['role'];
            $_SESSION['user_id'] = $user['user']['id'];
            header("Location: /../views/dashboard/");
            exit;
        } else {
            $errors[] = $user['error'];
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>
<body>

<?php if (isset($_SESSION['successRegister'])): ?>
    <div class="container d-flex justify-content-center mt-4">
        <div class="alert alert-success w-25">
            <p><?= htmlspecialchars($_SESSION['successRegister']); ?></p>
        </div>
        <?php unset($_SESSION['successRegister']); ?>
    </div>
<?php endif; ?>

<?php if (!empty($errors)): ?>
    <div class="container d-flex justify-content-center mt-4">
        <div class="alert alert-danger w-25">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li>
                        <p><?= htmlspecialchars($error); ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php unset($_SESSION['successRegister']); ?>
    </div>
<?php endif; ?>

<div class="d-flex justify-content-center align-items-center w-100 mt-5">
    <div class="card shadow-sm" style="width: 400px;">
        <div class="card-header text-center">
            <h4>Login</h4>
        </div>
        <div class="card-body">
            <form method="post" action="">

                <div class="mb-3">
                    <label for="name" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                <button type="submit" class="btn btn-primary w-100" name="login">Login</button>
            </form>

            <p class="text-center mt-3">
                Wanna be a writer? <a href="register.php">Register here</a>
            </p>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>