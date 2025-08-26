<?php
session_start();
require_once __DIR__ . '/../../../config/db.php'; // memuat BASE_PATH, koneksi DB, dll
require_once BASE_PATH . '/includes/dashboardHeader.php';

redirectIfNotLogged();


if (isset($_POST['createCategory'])) {
    $category = $_POST['category_name'];
    $userId = $_POST['user_id'];
    $result = createCategory($category, $userId);

    if ($result['status']) {
        $_SESSION['successCreate'] = $result['success'];
    }
}

?>

<div class="container">
    <?php if (isset($_SESSION['successCreate'])): ?>
        <div class="container d-flex justify-content-center mt-4">
            <div class="alert alert-success w-25">
                <p><?= htmlspecialchars($_SESSION['successCreate']); ?></p>
            </div>
            <?php unset($_SESSION['successCreate']); ?>
        </div>
    <?php endif; ?>
    <div class="card mt-5">
        <div class="card-header d-flex justify-content-between">
            <h3>Category</h3>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Create
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Category</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="">
                                <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
                                <div class="mb-3">
                                    <label for="category_name" class="form-label">Category Name</label>
                                    <input type="text" class="form-control" id="category_name" name="category_name">
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" name="createCategory">Submit</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
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
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td><button>adasd</button></td>
                        <td><button>adasd</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
require_once BASE_PATH . '/includes/dashboardFooter.php';
?>