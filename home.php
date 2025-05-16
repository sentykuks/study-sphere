<?php include __DIR__ . "/conn/check_session.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <link rel="stylesheet" href="css/home_style.css">
</head>

<body>
  <?php include __DIR__ . "/common/navbar.php" ?>

  <br>
  <!-----upload section fo study material  -------->

  <!-- <div class="upload-image">
  <div class="upload-section container" >
  <img src="image/upload_section.png" >
        <h1 class="">Upload a New Note</h1>
        <form action="home.php" method="POST" enctype="multipart/form-data" class="">
            <div class="input">
                <label for="title" >Note Title</label>
                <input type="text" name="title" id="title" required class="file">
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="4" class="w-full p-2 border rounded-md"></textarea>
            </div>
            <div class="input">
                <label for="file" >Upload PDF File</label>
                <input type="file" name="file" id="file" accept=".pdf" class="file">
            </div>
            <button type="submit" class="submit " id="">Upload </button>
        </form>
      </div>
    </div> -->









  <!-- ........................................................................................................................... -->

  <br>
  <div class="study-section">
    <h1>Your One stop study companion</h1>
    <span class="bottom-line"></span>
    <hr />
    <div class="flex study-content container">
      <div class="box flex">
        <div class="img-section">
          <img src="image/books.png" width="450px" height="300px" />
        </div>
        <div class="font-section">
          <h3>Study material crafted for your syllabus</h3>
          <p>
            Previous year question papers, solutions, notes, audio & video
            notes, slides, recommended books and much more. Everything curated
            specifically as per your syllabus.
          </p>
        </div>
      </div>
      <div class="box flex">
        <div class="img-section">
          <img src="image/icon1.png" width="450px" height="300px" />
        </div>
        <div class="font-section">
          <h3>Exam tomorrow? No worries</h3>
          <p>
            Enough of stressing about gathering content for exams and spending
            hours to get your notes photocopied. Access preparation material
            anywhere on your phone, tablet or computer
          </p>
        </div>
      </div>
      <div class="box flex">
        <div class="img-section">
          <img src="image/notes.png" width="450px" height="300px" />
        </div>
        <div class="font-section">
          <h3>Providing hand written notes</h3>
          <p>
            Providing handwritten notes on websites adds a personal touch,
            enhances understanding through visual aids, improves retention,
            and offers unique insights that complement digital content,
            benefiting diverse learning styles.
          </p>
        </div>
      </div>
      <div class="box flex">
        <div class="img-section">
          <img src="image/syllabus.png" width="450px" height="300px" />
        </div>
        <div class="font-section">
          <h3>Study material crafted for your syllabus</h3>
          <p>
            Previous year question papers, solutions, notes, audio & video
            notes, slides, recommended books and much more. Everything curated
            specifically as per your syllabus.
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="collage-section">
    <div class="collage-container container">
      <div class="header-section">
        <h1>Colleges</h1>
        <p>
          Explore a wide range of colleges that are part of the Study Sphere project.
          Whether you are looking for top-tier universities or specialized institutes,
          our collection includes everything you need to make informed decisions about your education.
        </p>
      </div>

      <div class="collage-area flex">
        <!-- College Cards -->
        <a href="#" class="collage-card" style="background-image: url('image/srhujpg.jpg');">
          <h3>SRHU</h3>
          <div class="img-text">
            <p>
              Swami Rama Himalayan University (SRHU) offers excellent academic programs in medical, engineering,
              and management fields, focusing on holistic development and hands-on learning.
            </p>
          </div>
        </a>

        <a href="#" class="collage-card" style="background-image: url('image/mitjpeg.jpeg');">
          <h3>MIT</h3>
          <div class="img-text">
            <p>
              Modern Institute of Technology (MIT) is known for its dynamic teaching approach and commitment
              to shaping skilled professionals in computer applications, science, and more.
            </p>
          </div>
        </a>

        <a href="#" class="collage-card" style="background-image: url('image/ditjpeg.jpeg');">
          <h3>DIT</h3>
          <div class="img-text">
            <p>
              Dehradun Institute of Technology (DIT) is a prestigious institute providing top-notch
              education in engineering, management, and allied sciences, fostering innovation and research.
            </p>
          </div>
        </a>

        <a href="#" class="collage-card" style="background-image: url('image/graphicjpeg.jpeg');">
          <h3>Graphic Era</h3>
          <div class="img-text">
            <p>
              Graphic Era University is a hub for technological and managerial excellence,
              offering a vibrant campus and a future-focused curriculum.
            </p>
          </div>
        </a>
      </div>
    </div>
  </div>
  <!-- <..........................................................................> -->
  <div class="resource-feature">

    <div class="resource-container container flex">
      <div class="about-section">
        <h2>Add your courses and ace every lecture, seminar and test</h2>
        <p>Study sphere connects students and encourages them to help each other. Together we master every exam.

        </p>
      </div>
      <div class="img-section">
        <img src="image/teamwork.png" />
      </div>
    </div>
  </div>

  <!-- ......................................................footer..................................................... -->

  <?php include __DIR__ . "/common/footer.php" ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>