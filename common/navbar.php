<nav>
    <div class="menu-bar d-flex justify-content-between align-items-center">
        <!-- Left: Logo -->
        <div class="logo">
            <a href="#">STUDY SPHERE</a>
        </div>

        <!-- Center: Navigation Links -->
        <div class="menu-center d-flex justify-content-center flex-grow-1">
            <ul class="d-flex list-unstyled mb-0">
                <li><a href="home.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="university.php">University</a></li>
                <li><a href="download.php">E-notes</a></li>
                <!-- <li><a href="upload_notes.php">Upload Notes</a></li> -->
            </ul>
        </div>

        <!-- Right: Profile Section & Logout Button -->
        <div class="menu-right d-flex align-items-center">
            <div class="navbar-nav">
            <a class="nav-link d-flex align-items-center" href="home.php">
                <i class="fa fa-user mr-2"></i> Welcome, <?php echo $user['name']; ?>
            </a>
            <div class="logout">
                <a class="nav-link secondary-button" href="logout.php">Logout</a>
            </div>
            </div>
            
        </div>
    </div>
</nav>
