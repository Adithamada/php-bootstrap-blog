<?php
require_once __DIR__ . '/../../config/db.php';
require_once BASE_PATH . '/includes/header.php';

session_start();

if(isset($_POST['login'])){
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $user = loginUser($username,$password);

    if ($user) {
        $_SESSION['name']=$user['name'];
        header("Location: /../views/dashboard/");
        exit;
    }

}

?>

<div class="d-flex justify-content-center align-items-center w-100 mt-5">
    <div class="card shadow-sm" style="width: 400px;">
        <div class="card-header text-center">
            <h4>Login</h4>
        </div>
        <div class="card-body">
            <form method="post" action="">

                <div class="mb-3">
                    <label for="name" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                    <div class="invalid-feedback">Name is required.</div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required minlength="8">
                    <div class="invalid-feedback">Password must be at least 8 characters.</div>
                </div>

                <button type="submit" class="btn btn-primary w-100" name="login">Login</button>
            </form>

            <p class="text-center mt-3">
                Wanna be a writer? <a href="login.php">Register here</a>
            </p>

        </div>
    </div>
</div>

<?php
require_once BASE_PATH . '/includes/footer.php';
?>
