<?php
session_start();
include __DIR__ . '/../configs/path.php';

// Debugging: Check session data
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    $_SESSION['error'] = "Unauthorized access!";
    header("Location: index.php");
    exit();
}

// Corrected path to the conn.php file
require __DIR__ . '/../conn/conn.php'; // Adjust the path based on the folder structure

// Make sure db.php contains the PDO connection
$stmt = $pdo->prepare("SELECT id, name, email, created_at FROM users");
$stmt->execute();
$users = $stmt->fetchAll();

// Display success or error messages (if any)
$successMessage = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle any admin actions like delete user
    if (isset($_POST['delete_user'])) {
        $userId = $_POST['delete_user'];

        // Delete the user from the database
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$userId]);

        $successMessage = "User deleted successfully!";
        header("refresh:2");
    }
}

// Fetching the notes from the database
try {
    $stmt = $pdo->prepare("SELECT * FROM notes");
    $stmt->execute();
    $notes = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results as an associative array
} catch (PDOException $e) {
    $_SESSION['error'] = "Database error: " . $e->getMessage();
    header("Location: admin.php");
    exit();
}

// Handle edit and delete actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Edit Note
    if (isset($_POST['edit_note'])) {
        $note_id = $_POST['note_id'];
        $title = $_POST['title'];

        try {
            $stmt = $pdo->prepare("UPDATE notes SET title = :title WHERE id = :id");
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':id', $note_id);
            $stmt->execute();

            $_SESSION['success'] = "Note updated successfully!";
        } catch (PDOException $e) {
            $_SESSION['error'] = "Database error: " . $e->getMessage();
        }
    }

    // Delete Note
    if (isset($_POST['delete_note'])) {
        $note_id = $_POST['note_id'];

        try {
            $stmt = $pdo->prepare("DELETE FROM notes WHERE id = :id");
            $stmt->bindParam(':id', $note_id);
            $stmt->execute();

            $_SESSION['success'] = "Note deleted successfully!";
        } catch (PDOException $e) {
            $_SESSION['error'] = "Database error: " . $e->getMessage();
        }
    }
    header("Location: admin.php");
    exit();
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/admin.css">

</head>
<style>
    body{
        
    }
.actives {
    color: #6e707e;
    background-color: #eee;
    font-weight: 600;

    .container {
        max-width: 1180px;
        margin-inline: auto;
        height: auto;
        animation: slideUp 2s ease-in-out;
    }
}
.container {
            width: 1000px; /* Set the width of the container */
            margin: 0 auto; /* Center the container horizontally */
        }
        .card, .table {
            width: 100%; /* Ensure they take full width of the container */
        }
        .dashboard-container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
        }
        .notification {
            margin-bottom: 20px;
        }
        table th, table td {
            text-align: center;
            vertical-align: middle;
        }
        table td {
            padding: 10px;
        }
        .btn-delete {
            background-color: #dc3545;
            color: white;
            border: none;
        }
        .btn-delete:hover {
            background-color: #c82333;
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
                <style>
                .sidebar .sidebar-brand .sidebar-brand-icon img {
                    max-height: 3.3rem;
                }
                </style>
                <!-- Container Fluid-->
                <div class="container-fluid p-3" id="container-wrapper">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <!-- <h1 class="h3 mb-0 text-gray-800">Upload Study Material</h1> -->
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Upload Study Material</li>
                        </ol>
                    </div>

                    <!-- New User Card Example -->
                    <!-----upload section fo study material  -------->
                    <div class="container p-3" style="max-width: 700px; justify-content: center;  margin: 0 auto;">

        <!-- Title Section -->
        <h1 class="text-center text-primary mb-5">Upload Study Material</h1>

        <!-- Display Success or Error Messages -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['success']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['error']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <!-- Upload Form -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h3 class="text-center">Upload a New Note</h3>
            </div>
            <div class="card-body">
                <form action="../upload2.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="title" class="form-label">Note Title</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="file" class="form-label">Upload PDF File</label>
                        <input type="file" name="file" id="file" accept=".pdf" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Upload</button>
                </form>
            </div>
        </div>

        <!-- Table to display notes -->
        <div class="card shadow-sm mb-3" style="max-width: 700px; justify-content: center;  margin: 0 auto;">
            <div class="card-header bg-secondary text-white">
                <h5>Uploaded Notes</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive" style="max-height: 400px; overflow-y: scroll;">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Title</th>
                                <th>Uploaded At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($notes)): ?>
                                <?php foreach ($notes as $note): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($note['title']); ?></td>
                                        <td><?php echo htmlspecialchars($note['uploaded_at']); ?></td>
                                        <td>
                                            <!-- Edit Button with Font Awesome Icon -->
                                            <button data-bs-toggle="modal" data-bs-target="#editModal" class="btn btn-warning btn-sm"
                                                    data-note-id="<?php echo $note['id']; ?>" data-note-title="<?php echo htmlspecialchars($note['title']); ?>">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <!-- Delete Button with Font Awesome Icon -->
                                            <form action="admin.php" method="POST" class="d-inline">
                                                <input type="hidden" name="note_id" value="<?php echo $note['id']; ?>">
                                                <button type="submit" name="delete_note" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this note?');">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" class="text-center">No notes uploaded yet.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Note</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="admin.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="note_id" id="note_id">
                            <div class="mb-3">
                                <label for="title" class="form-label">Note Title</label>
                                <input type="text" class="form-control" name="title" id="edit_title" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="edit_note" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
                    <!---Container Fluid-->
                </div>
                <?php include __DIR__ . "/../common/logout.php" ?>
                <!-- Scroll to top -->
                <a class="scroll-to-top rounded" href="#page-top">
                    <i class="fas fa-angle-up"></i>
                </a>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

        <script>
            // Pass the note data into the modal when the Edit button is clicked
            const editModal = document.getElementById('editModal');
            editModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget; // Button that triggered the modal
                const noteId = button.getAttribute('data-note-id');
                const noteTitle = button.getAttribute('data-note-title');

                // Update the modal's content
                const noteIdInput = editModal.querySelector('#note_id');
                const noteTitleInput = editModal.querySelector('#edit_title');

                noteIdInput.value = noteId;
                noteTitleInput.value = noteTitle;
            });
        </script>

    <?php include __DIR__ . "/../common/js.php" ?>
</body>

</html>