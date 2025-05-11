<?php include __DIR__ . "/../configs/path.php" ?>
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
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="http://localhost/project/admin/views/dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                        </ol>
                    </div>

                    <div class="row">
                        <div class="col-12">


                            <div class="card shadow-lg">
                                <!-- Card Header -->
                                <div class="card-header text-center" style="background-color:rgb(112, 182, 252); font-weight: bold;">
                                    <h4 class="mb-0 text-white">Change Password</h4>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body">
                                    <form class="row" method="post" action="" id="passwordForm" novalidate="novalidate">
                                        <div class="form-group col-lg-6">
                                            <label for="old_password">Old Password</label>
                                            <input id="old_password" type="password" class="form-control" name="old_password" autocomplete="on">
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="new_password">New Password</label>
                                            <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="on">
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="confirm_password">Confirm New Password</label>
                                            <input id="confirm_password" type="password" class="form-control" name="confirm_password" autocomplete="on">
                                        </div>

                                        <div class="col-12 text-center">
                                            <button type="submit" class="btn btn-success px-4">Change Password</button>
                                        </div>
                                    </form>
                                </div> <!-- End Card Body -->
                            </div> <!-- End Card -->
                        </div>
                    </div>
                </div>

                <?php include __DIR__ . "/../common/logout.php" ?>

                <!-- Scroll to top -->
                <a class="scroll-to-top rounded" href="#page-top" style="display: none;">
                    <i class="fas fa-angle-up"></i>
                </a>

            </div>
        </div>
    </div>
    <?php include __DIR__ . "/../common/js.php" ?>
</body>


<script>
    $(document).ready(function() {
        $("#passwordForm").validate({
            rules: {
                old_password: {
                    required: true,
                },
                new_password: {
                    required: true,
                    minlength: 8
                },
                confirm_password: {
                    required: true,
                    equalTo: "#new_password"
                }
            },
            messages: {
                old_password: {
                    required: "Please enter your old password",
                },
                new_password: {
                    required: "Please enter a new password",
                    minlength: "New Password must be at least 8 characters"
                },
                confirm_password: {
                    required: "Please enter a confirm password",
                    equalTo: "Password do not match"
                }
            },
            // submitHandler: function(form) {
            // //   alert("Password changed successfully!");
            //   form.submit();
            // }
        });
    });


    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

</html>