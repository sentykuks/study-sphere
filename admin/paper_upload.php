<?php
// Database Connection
$conn = new mysqli("localhost", "root", "", "base");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// University Data with Courses & Subjects (Simulating University Hub)
$universityData = [
    'SRHU' => [
        'MCA' => ['Data Structures', 'Java Programming', 'Web Development'],
        'BCA' => ['Computer Networks', 'Operating Systems', 'Python Programming'],
    ],
    'Graphic_Era' => [
        'MCA' => ['Cloud Computing', 'Cyber Security'],
        'BCA' => ['Java', 'Database Management'],
    ],
    'DIT' => [
        'Civil Engineering' => ['Construction Materials', 'Geotechnical Engineering'],
        'Electrical Engineering' => ['Power Systems', 'Circuit Theory'],
    ],
    'MIT' => [
        'BCA' => ['Web Programming', 'AI & ML'],
        'BSc IT' => ['Cybersecurity', 'Networking'],
    ]
];

// Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $university = $_POST['university'];
    $course = $_POST['course'];
    $subject = $_POST['subject'];
    $paper_year = $_POST['paper_year'];

    // File upload handling
    $target_dir = "uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $file_name = basename($_FILES["exam_paper"]["name"]);
    $target_file = $target_dir . time() . "_" . $file_name;
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if ($file_type != "pdf") {
        echo "<script>alert('Only PDF files are allowed!');</script>";
    } elseif (move_uploaded_file($_FILES["exam_paper"]["tmp_name"], $target_file)) {
        // Store in Database
        $stmt = $conn->prepare("INSERT INTO paper (university_name, course, subject, paper_year, file_path) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $university, $course, $subject, $paper_year, $target_file);
        $stmt->execute();
        echo "<script>alert('Paper uploaded successfully!');</script>";
    } else {
        echo "<script>alert('Error uploading file!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload University Paper</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h2 class="text-center mb-4">📄 Upload University Paper</h2>
        
        <form action="" method="POST" enctype="multipart/form-data" class="p-4 bg-white shadow rounded">
            <div class="mb-3">
                <label class="form-label">University Name:</label>
                <select id="university" name="university" class="form-select" required>
                    <option disabled selected>Select University</option>
                    <?php foreach ($universityData as $uni => $courses) { echo "<option value='$uni'>$uni</option>"; } ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Course:</label>
                <select id="course" name="course" class="form-select" required>
                    <option disabled selected>Select Course</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Subject:</label>
                <select id="subject" name="subject" class="form-select" required>
                    <option disabled selected>Select Subject</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Paper Year:</label>
                <select name="paper_year" class="form-select" required>
                    <option disabled selected>Select Year</option>
                    <?php for ($year = date("Y"); $year >= 2000; $year--) { echo "<option value='$year'>$year</option>"; } ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Upload Paper (PDF Only):</label>
                <input type="file" name="exam_paper" class="form-control" accept=".pdf" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Upload Paper</button>
        </form>
    </div>

    <script>
        // JavaScript for Dynamic Course & Subject Selection
        const universityData = <?= json_encode($universityData); ?>;
        const universitySelect = document.getElementById("university");
        const courseSelect = document.getElementById("course");
        const subjectSelect = document.getElementById("subject");

        universitySelect.addEventListener("change", function () {
            const selectedUniversity = this.value;
            courseSelect.innerHTML = '<option disabled selected>Select Course</option>';
            subjectSelect.innerHTML = '<option disabled selected>Select Subject</option>';

            if (universityData[selectedUniversity]) {
                for (const course in universityData[selectedUniversity]) {
                    const option = document.createElement("option");
                    option.textContent = course;
                    courseSelect.appendChild(option);
                }
            }
        });

        courseSelect.addEventListener("change", function () {
            const selectedUniversity = universitySelect.value;
            const selectedCourse = this.value;
            subjectSelect.innerHTML = '<option disabled selected>Select Subject</option>';

            if (universityData[selectedUniversity] && universityData[selectedUniversity][selectedCourse]) {
                universityData[selectedUniversity][selectedCourse].forEach(subject => {
                    const option = document.createElement("option");
                    option.textContent = subject;
                    subjectSelect.appendChild(option);
                });
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
