<?php include __DIR__ . "/../configs/path.php"; ?>

<nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top d-flex justify-content-between">
    <!-- Sidebar Toggle Button -->
    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Navbar Right (Profile Dropdown) -->
    <ul class="navbar-nav ml-auto">

        <!-- Divider between navbar items (for spacing) -->
        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Profile Dropdown -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <!-- Profile Image -->
                <img class="img-profile rounded-circle" src="<?= $base_url ?>image/boy.png">
                <span class="ml-2 d-none d-lg-inline text-white small">Admin</span>
            </a>
            <!-- Dropdown Menu -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?= $base_url ?>admin/profile.php">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Admin Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?= $base_url ?>admin/change_password.php">
                    <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                    Change Password
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
