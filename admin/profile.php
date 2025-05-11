<?php include __DIR__ . "/../configs/path.php" ?>
<?php include __DIR__ . "/../conn/conn.php" ?>
<?php
try {
    $stmt = $pdo->prepare("SELECT * FROM admin_users");
    $stmt->execute();
    $adminUser = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $_SESSION["error"] = ["Database error :"] . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="<?= $base_url ?>css/ruang-admin.min.css">
</head>

<style>
    .actives {
        color: #6e707e;
        background-color: #eee;
        font-weight: 600;
    }
</style>

<body id="page-top">
    <div id="wrapper">



        <!-- Sidebar -->
        <?php include __DIR__ . "/../common/sidebar.php" ?>
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                <?php include __DIR__ . "/../common/admin_nav.php" ?>

                <!-- Topbar -->

                <div class="container-fluid" id="container-wrapper">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Profile</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= $base_url ?>admin/admin.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profile</li>
                        </ol>
                    </div>
                </div>

                <section>
                    <div class="container py-5">
                        <div class="row py-5">
                            <div class="col-lg-4">
                                <div class="card mb-4 shadow-sm">
                                    <div class="card-body text-center">
                                        <img src="<?= $base_url ?>/asset/img/boy.png" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                                        <h5 class="my-3">Admin</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-8">


                                <div class="card mb-4 shadow-sm">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <?php if (!empty($adminUser)) {
                                                foreach ($adminUser as  $user) { ?>

                                                    <div class="col-sm-3">
                                                        <p class="mb-0 fw-bold">name</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0">Anand paswan</p>
                                                    </div>
                                        </div>
                                        <hr>

                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <p class="mb-0 fw-bold">Email</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><?= $user['email'] ?></p>
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <p class="mb-0 fw-bold">password</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><?= $user['password'] ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                <?php }
                                            } ?>

                                <div class="text-center">
                                    <a href="#" class="btn btn-primary">Edit Profile</a>
                                </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>




                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to logout?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                                <a href="http://localhost/project/admin/views/profile/logout.php" class="btn btn-primary">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Scroll to top -->
                <a class="scroll-to-top rounded" href="#page-top" style="display: none;">
                    <i class="fas fa-angle-up"></i>
                </a>
            </div>
        </div>
    </div>
    <?php include __DIR__ . "/../common/js.php" ?>

</body>

</html>