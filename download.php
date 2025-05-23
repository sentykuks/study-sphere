<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "base";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle search query if available
$search_query = '';
if (isset($_GET['search'])) {
    $search_query = $_GET['search'];
}

// SQL query to fetch notes with search functionality
$sql = "SELECT * FROM notes WHERE title LIKE ? OR description LIKE ? ORDER BY uploaded_at DESC";
$stmt = $conn->prepare($sql);
$search_param = "%" . $search_query . "%";
$stmt->bind_param("ss", $search_param, $search_param);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/enotes.css">
    <link rel="stylesheet" href="css/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Document</title>
</head>

<body>
    <div class="ebooks-header">
        <h1 class="header-title">Explore Our Free Ebooks & PDF Notes</h1>
        <p class="header-description">Access a wide range of notes, ebooks, and study materials to boost your learning. Download or view PDFs instantly!</p>
    </div>
    <!-- <div class="back-btn">
        <a href="home.php">Back <i class="fa-solid fa-chevron-right"></i></a>
    </div> -->

    <!-- Back button redirecting to a specific page -->
    <form action="home.php" method="get">
        <!-- <div class="back-button-container">
            <button class="btn-back" onclick="window.history.back();">← Back</button>
        </div> -->
    </form>

    <div id="card" class="notes-section">
        <h1 class="heading-main">Available Notes</h1>

        <!-- Search Bar -->
        <form action="download.php" method="GET" class="search-bar">
            <div class="search-wrapper">
                <input type="text" name="search" placeholder="Search by title or description" value="<?php echo htmlspecialchars($search_query); ?>" class="search-input">
                <button type="submit" class="btn-search">Search</button>
            </div>
        </form>

        <?php if ($result->num_rows > 0): ?>
            <div id="scroll" class="notes-list">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="note-card">
                        <h2 class="note-title"><?php echo htmlspecialchars($row['title']); ?></h2>
                        <p class="note-description"><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>

                        <div class="note-actions">
                            <!-- Static PDF preview icon -->
                            <img src="icon/icons8-pdf-80.png" alt="PDF Preview" class="pdf-icon">

                            <div class="note-links">
                                <!-- View PDF -->
                                <a href="<?php echo $row['file_path']; ?>" target="_blank" class="link-view">View PDF</a>

                                <!-- Download PDF -->
                                <a href="<?php echo $row['file_path']; ?>" download class="btn-download">Download</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p class="no-results">No notes found matching your search.</p>
        <?php endif; ?>
        <?php
    // Fetch question papers
    $qp_sql = "SELECT * FROM paper ORDER BY uploaded_at DESC";
    $qp_result = $conn->query($qp_sql);
    
    if (!$qp_result) {
        die("Query failed: " . $conn->error);  // Debug the error
    }
    
    ?>
        <h1 class="heading-main mt-5">Question Papers</h1>

<?php if ($qp_result->num_rows > 0): ?>
    <div class="d-flex flex-column gap-3">
        <?php while ($qp = $qp_result->fetch_assoc()): ?>
            <div class="card p-3 shadow-sm">
                <div class="d-flex align-items-center">

                    <!-- PDF Icon -->
                    <img src="icon/icons8-pdf-80.png" alt="PDF" class="me-4" style="width: 60px; height: auto;">

                    <!-- Paper Info -->
                    <div class="flex-grow-1">
                        <h5 class="mb-1"><?php echo htmlspecialchars($qp['subject']); ?></h5>
                        <p class="mb-1 text-muted">
                            <strong>University:</strong> <?= htmlspecialchars($qp['university']) ?> |
                            <strong>Course:</strong> <?= htmlspecialchars($qp['course']) ?> |
                            <strong>Year:</strong> <?= htmlspecialchars($qp['year']) ?>
                        </p>
                        <small class="text-muted">
                            Uploaded on <?= date("d M Y", strtotime($qp['uploaded_at'])) ?>
                        </small>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex flex-column ms-3">
                        <a href="admin/<?= htmlspecialchars(string: $qp['file_path']) ?>" target="_blank" class="btn btn-outline-primary btn-sm mb-2">View</a>
                        <a href="admin/?= htmlspecialchars($qp['file_path']) ?>" download class="btn btn-primary btn-sm">Download</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
<?php else: ?>
    <div class="alert alert-warning text-center">No question papers available at the moment.</div>
<?php endif; ?>

</div>


    <?php include __DIR__."/common/footer.php" ?>

</body>

</html>