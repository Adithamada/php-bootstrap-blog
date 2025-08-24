<?php
session_start();
require_once __DIR__ . '/../../config/db.php';
require_once BASE_PATH . '/includes/header.php';

$errors = [];

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $errors = validateLoginInput($username, $password);

    if (empty($errors)) {
        $user = loginUser($username, $password);
        if ($user['status']) {
            $_SESSION['name'] = $user['user']['name'];
            header("Location: /../views/dashboard/");
            exit;
        } else {
            $errors[] = $user['error'];
        }
    }
}

?>

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

<?php
require_once BASE_PATH . '/includes/footer.php';
?>