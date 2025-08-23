<?php
session_start();

require_once __DIR__ . '/../../config/db.php';
require_once BASE_PATH . '/includes/header.php';

$errors = [];


if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $errors = validateRegisterInput($name, $email, $password);

    if (empty($errors)) {
        if (registerUser($name, $email, $password)) {
            $_SESSION['successRegister'] = "Register successful! Please login.";
            header("Location: login.php");
            exit;
        }
    }
}

?>

<?php if (!empty($errors)): ?>
    <div class="container d-flex justify-content-center mt-4">
        <div class="alert alert-danger w-25">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
<?php endif; ?>
<div class="d-flex justify-content-center align-items-center w-100 mt-5">
    <div class="card shadow-sm" style="width: 400px;">
        <div class="card-header text-center">
            <h4>Register</h4>
        </div>
        <div class="card-body">
            <form method="post" action="">

                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                    <div class="invalid-feedback">Name is required.</div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="text" class="form-control" id="email" name="email">
                    <div class="invalid-feedback">Valid email is required.</div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <div class="invalid-feedback">Password must be at least 8 characters.</div>
                </div>

                <button type="submit" class="btn btn-primary w-100" name="register">Register</button>
            </form>

            <p class="text-center mt-3">
                Already have an account? <a href="login.php">Login here</a>
            </p>

        </div>
    </div>
</div>

<?php
require_once BASE_PATH . '/includes/footer.php';
?>