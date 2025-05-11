<?php include __DIR__ . "/conn/check_session.php" ?>

<?php
require 'conn/conn.php';
// University Data
$universityData = [
    'SRHU' => [
        'images' => ['image/srhu1.jfif', 'image/srhu2.jfif', 'image/srhu3.jpeg'],
        'courses' => [
            'MCA' => ['Data Structures', 'Java Programming', 'Web Development', 'Database Management'],
            'BCA' => ['Computer Networks', 'Operating Systems', 'Python Programming', 'C Programming']
        ]
    ],
    'Graphic_Era' => [
        'images' => ['image/graphic1.jpg', 'image/graphic2.jfif', 'image/graphic3.jfif'],
        'courses' => [
            'MCA' => ['Cloud Computing', 'Cyber Security'],
            'BCA' => ['Java', 'Database Management', 'Networking']
        ]
    ]
];

$selectedUniversity = $_POST['universityType'] ?? 'SRHU';
$selectedCourse = $_POST['course'] ?? '';
$selectedSubject = $_POST['subject'] ?? '';
$selectedData = $universityData[$selectedUniversity];

// Fetch Papers
$papers = [];
if (!empty($selectedSubject)) {
    $stmt = $pdo->prepare("SELECT * FROM paper WHERE university_name = :university AND subject = :subject");
    $stmt->execute(['university' => $selectedUniversity, 'subject' => $selectedSubject]);
    $papers = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home_style.css">
    <link rel="stylesheet" href="css/university_upload.css">
    <title>University page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .carousel-inner img {
            height: 400px;
            object-fit: cover;
        }

        .form-select {
            border-radius: 5px;
            font-size: 1.1rem;
        }

        .card {
            box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1);
        }

        .card .remove-paper {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            font-size: 1.2rem;
            color: red;
        }

        .paper-card {
            margin-bottom: 20px;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: black;
        }

        .card-body {
            padding: 20px;
        }

        .btn {
            font-size: 0.9rem;
        }
    </style>
</head>

<?php include __DIR__ . "/common/navbar.php" ?>

<body>
    <div class="container py-5">
        <header class="text-center mt-4">
            <h1 class="fw-bold">🎓 University Hub</h1>
        </header>

        <!-- University Selection Form -->
        <form action="" method="POST" class="mb-4">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <label class="form-label">Select University:</label>
                    <select class="form-select" name="universityType" onchange="this.form.submit()">
                        <?php foreach ($universityData as $university => $data): ?>
                            <option value="<?= $university; ?>" <?= ($selectedUniversity == $university) ? 'selected' : ''; ?>>
                                <?= str_replace('_', ' ', $university); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </form>

        <!-- Carousel of University Images -->
        <div id="imageCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php foreach ($selectedData['images'] as $index => $image): ?>
                    <div class="carousel-item <?= ($index === 0) ? 'active' : ''; ?>">
                        <img src="<?= $image; ?>" class="d-block w-100" alt="University Image">
                    </div>
                <?php endforeach; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>

        <!-- Course and Subject Selection Form -->
        <form action="" method="POST" class="row mb-4">
            <input type="hidden" name="universityType" value="<?= $selectedUniversity; ?>">
            <div class="col-md-4">
                <label class="form-label">Available Courses:</label>
                <select id="courses" class="form-select" name="course" onchange="this.form.submit()" required>
                    <option disabled selected>Select a course</option>
                    <?php foreach ($selectedData['courses'] as $course => $subjects): ?>
                        <option value="<?= htmlspecialchars($course); ?>" <?= ($selectedCourse == $course) ? 'selected' : ''; ?>><?= $course; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">Subjects:</label>
                <select id="subjects" class="form-select" name="subject" required>
                    <option disabled selected>Select a subject</option>
                    <?php if ($selectedCourse): ?>
                        <?php foreach ($selectedData['courses'][$selectedCourse] as $subject): ?>
                            <option value="<?= htmlspecialchars($subject); ?>" <?= ($selectedSubject == $subject) ? 'selected' : ''; ?>><?= $subject; ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="col-md-4 text-end mt-4">
                <button class="btn btn-primary w-100">Submit</button>
            </div>
        </form>

        <!-- Papers Display Section -->
        <div class="row" id="papers-container">
            <?php foreach ($papers as $paper): ?>
                <div class="col-md-4 paper-card" data-id="<?= $paper['id']; ?>">
                    <div class="card shadow">
                        <button class="btn remove-paper">❌</button>
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($paper['paper_year']); ?> Paper</h5>
                            <p class="card-text"><strong>Course:</strong> <?= htmlspecialchars($paper['course']); ?></p>
                            <p class="card-text"><strong>University:</strong> <?= htmlspecialchars($paper['university_name']); ?></p>
                            <p class="card-text"><strong>Subject:</strong> <?= htmlspecialchars($paper['subject']); ?></p>
                            <div>
                                <a href="<?= $paper['file_path']; ?>" target="_blank" class="btn btn-success btn-sm">View</a>
                                <a href="<?= $paper['file_path']; ?>" download class="btn btn-primary btn-sm">Download</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>

    <script>
        const coursesData = <?= json_encode($selectedData['courses']); ?>;
        const courseSelect = document.getElementById("courses");
        const subjectSelect = document.getElementById("subjects");

        function populateSubjects() {
            subjectSelect.innerHTML = '<option disabled selected>Select a subject</option>';
            if (coursesData[courseSelect.value]) {
                coursesData[courseSelect.value].forEach(subject => {
                    const option = document.createElement("option");
                    option.textContent = subject;
                    option.value = subject;
                    subjectSelect.appendChild(option);
                });
            }
        }

        courseSelect.addEventListener("change", populateSubjects);
        if ("<?= $selectedCourse; ?>") populateSubjects();

        // Paper removal functionality
        document.addEventListener("click", function (event) {
            if (event.target.classList.contains("remove-paper")) {
                event.target.closest(".paper-card").remove();
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
