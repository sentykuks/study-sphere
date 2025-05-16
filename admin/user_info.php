<?php include __DIR__ . "/../configs/path.php"; ?>
<?php include __DIR__ . "/../conn/conn.php"; ?>
<?php
try {
    $stmt = $pdo->prepare("SELECT * FROM users ORDER BY id DESC"); // Fetch all categories
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $_SESSION['errors'][] = "Database error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap & Tailwind CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="<?= $base_url ?>css/ruang-admin.min.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <style>
            .actives {
                color: #6e707e;
                background-color: #eee;
                font-weight: 600;
            }
        </style>



        <!-- Sidebar -->
        <?php include __DIR__ . "/../common/sidebar.php" ?>
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                <?php include __DIR__ . "/../common/admin_nav.php" ?>


                <!-- Topbar --><!-- Container Fluid-->
                <div class="container-fluid" id="container-wrapper">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <div class="d-flex my-2 flex-md-row flex-column">
                            <h1 class="h3 mb-0 text-gray-800">Users Information</h1>
                            <!-- <a href="http://localhost/project/admin/views/categories/add_category.php" class="btn btn-primary  mx-md-3 my-2 my-md-0">Add Category</a> -->
                        </div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="http://localhost/project/admin/views/dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Users Data</li>
                        </ol>
                    </div>
                    <div class="mb-2">
                        <div class="col-lg-12">
                            <?php if (!empty($_SESSION['success'])): ?>
                                <div class="alert alert-success alert-dismissible fade show custom-alert" role="alert">
                                    <?php echo ($_SESSION['success']); ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?php unset($_SESSION['success']); ?>
                            <?php endif; ?>
                            <div class="col-lg-12">
                                <div class="card mb-4">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                <h6 class="m-0 font-weight-bold text-primary">Manage Users Data</h6>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="table-responsive p-3">
                                        <table class="table align-items-center table-flush dataTable no-footer" id="categoryTable">

                                            <thead class="thead-light">
                                                <tr>
                                                    <th class="pl-1">S.No.</th>
                                                    <th class="pl-0">User Name</th>
                                                    <th class="pl-0"> Email</th>
                                                    <th class="pl-0">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php if (!empty($users)) {
                                                    foreach ($users as $index => $user) { ?>
                                                        <tr>
                                                            <td class="pl-1"><?= $index + 1; ?></td>
                                                            <td class="pl-1"><?= $user['name']; ?></td>
                                                            <td class="pl-1"><?= $user['email']; ?></td>
                                                            <td class="pl-0" style="overflow-wrap: break-word;">
                                                                <a href="<?= $base_url ?>views/categories/category_edit.php?id=<?= $user['id']; ?>" class="btn btn-success text-light">Edit</a>
                                                                <a href="<?= $base_url ?>delete_userinfo.php?id=<?= $user['id']; ?>" class="btn btn-danger text-light">Delete</a>
                                                                <!-- <a href="./category_edit.php?id=1" class="btn btn-primary text-light">Edit</a> -->
                                                            </td>
                                                        </tr>
                                                    <?php }
                                                } else { ?>
                                                    <tr>
                                                        <td colspan="4" class="text-center" style="color:red;">*No categories found</td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!---Container Fluid-->
                </div>
                <!-- Bootstrap Modal -->
                <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmModalLabel">Confirm Action</h5>

                            </div>
                            <div class="modal-body">
                                Are you sure you want to disable this record?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="canceldeactive">Cancel</button>
                                <button type="button" class="btn btn-primary" id="confirmDisable">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="activeModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmModalLabel">Confirm Action</h5>

                            </div>
                            <div class="modal-body">
                                Are you sure you want to enable this record?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancelactive">Cancel</button>
                                <button type="button" class="btn btn-primary" id="confirmactive">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>

                <?php include __DIR__ . "/../common/logout.php" ?>

                <!-- Scroll to top -->
                <a class="scroll-to-top rounded" href="#page-top">
                    <i class="fas fa-angle-up"></i>
                </a>

            </div>
        </div>
        <?php include __DIR__ . "/../common/js.php" ?>
</body>