<?php
session_start();
require_once __DIR__ . '/../../../config/db.php'; // memuat BASE_PATH, koneksi DB, dll
require_once BASE_PATH . '/includes/dashboardHeader.php';

redirectIfNotLogged();

$categories = getAllCategories();
$i = 1;

if (isset($_POST['createCategory'])) {
    $category = $_POST['category_name'];
    $userId = $_POST['user_id'];
    $result = createCategory($category, $userId);

    if ($result['status']) {
        $_SESSION['successCreate'] = $result['success'];
        header("Location ./index.php");
    }
}

if(isset($_POST['updateCategory'])){
    $id = $_POST['category_id'];
    $category = $_POST['category_name'];
    $status = $_POST['status'];

    $result = updateCategory($id,$category,$status);

    if($result['status']){
        $_SESSION['successUpdate'] = $result['success'];
        header("Location: ./index.php");
    }
}

if(isset($_POST['deleteCategory'])){
    $id = $_POST['category_id'];

    $result = deleteCategory($id);

    if($result['status']){
        $_SESSION['successDelete'] = $result['success'];
        header("Location: ./index.php");
    }
}

?>

<div class="container">
    <!-- <?php //if (isset($_SESSION['successCreate']) || isset($_SESSION['successUpdate'])): ?>
        <div class="container d-flex justify-content-center mt-4">
            <div class="alert alert-success w-25">
                <p><?php //if(){htmlspecialchars($_SESSION['successCreate']);} ?></p>
            </div>
            <?php unset($_SESSION['successCreate']); ?>
        </div>
    <?php //endif; ?> -->
    <div class="card mt-5">
        <div class="card-header d-flex justify-content-between">
            <h3>Category</h3>
            <!-- Modal Create -->
            <button type="button" class="btn btn-primary border" data-bs-toggle="modal" data-bs-target="#modalCreate">
                Create
            </button>
            <!-- Modal -->
            <?php include "modalCreate.php"; ?>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Status</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category): ?>
                        <tr>
                            <th scope="row"><?= $i++ ?></th>
                            <td><?= $category['category_name'] ?></td>
                            <td><?= $category['slug'] ?></td>
                            <td><span class="badge text-bg-danger border"><?= $category['status'] ?></span></td>
                            <td>
                                <!-- Modal Update -->
                                <button type="button" class="btn btn-success border" data-bs-toggle="modal" data-bs-target="#modalUpdate<?= $category['id'] ?>">
                                    Update
                                </button>
                                <!-- Modal -->
                                <?php include "modalUpdate.php"; ?>
                            </td>
                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="category_id" value="<?= $category['id'] ?>">
                                    <button type="submit" class="btn btn-danger" name="deleteCategory">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
require_once BASE_PATH . '/includes/dashboardFooter.php';
?>