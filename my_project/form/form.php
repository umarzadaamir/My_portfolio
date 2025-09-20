<?php
// DB connection
$conn = new mysqli("localhost", "root", "", "my_project");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// Get count for departments
$sql = "SELECT COUNT(id) AS total_departments FROM department";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_departments = $row['total_departments'];
// get count for teachers
$sql = "SELECT COUNT(id) AS total_teachers FROM teacher";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_teachers = $row['total_teachers'];

// get cout for students
$sql = "SELECT COUNT(id) AS total_students FROM registration";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_students = $row['total_students'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>University — Animated Demo</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="form.css" />
  <link rel="stylesheet" href="salider.css">
</head>
<style>

</style>

<body>
  <nav class="nav glass">
    <div class="brand">
      <img src="Agricultural_University_Peshawar_logo.png" alt="Logo" class="logo" height="130px" width="150px" />
      <span> University of <span> Agriculture</span> Peshawar</span>
    </div>
    <div class="nav-links">
      <a href="#about">About</a>
      <a href="#departments">Departments</a>
      <a href="#campus">Faculty</a>
      <a href="#stats">Stats</a>
    </div>
  </nav>
  <header class="hero" id="hero">
    <div class="hero-bg" style="background-image: url('uni.jpg');"></div>
    <div class="hero-overlay"></div>
    <div class="hero-inner">
      <h1 class="hero-title">
        University of Agriculture Peshawar
        <div class="typewriter-container">
          <span class="typewriter-text accent" id="typewriter-text"></span>
          <span class="typewriter-cursor">|</span>
        </div>
      </h1>
      <div class="type-wrap">
        <span id="typed-text"></span><span class="caret">|</span>
      </div>
      <p class="hero-sub">
        Inspiring knowledge · shaping futures · leading research
      </p>
      <div class="hero-ctas">
        <button class="btn registration"><a href="../registration_from/registor.php" class="btn">registration </a></button>
        <button class="btn login"> <a href="../login/log.php" class="btn">login </a></button>
      </div>
    </div>
    <svg
      class="hero-wave"
      xmlns="http://www.w3.org/2000/svg"
      viewBox="0 0 1440 200">
      <path
        fill="#fff"
        fill-opacity="1"
        d="M0,128L60,112C120,96,240,64,360,69.3C480,75,600,117,720,138.7C840,160,960,160,1080,144C1200,128,1320,96,1380,80L1440,64V200H0Z"></path>
    </svg>
  </header>
  <div class="salider_full_div">
    <div class="box box1">
      <h1>Basic and Applied Agricultural Research</h1>
      <br>
      <p> To provide instructions, trainings, research and outreach; in agriculture, animal husbandry and other such disciplines of learning.</p>
    </div>
    <div class="box box2">
      <h1>Education to Rural Communities</h1>
      <br>
      <p>Imparting Agricultural Education and Conducting basic and Applied Agricultural Research throughout the Province
      </p>
    </div>
    <div class="box box3">
      <h1>The University of Agriculture, Peshawar</h1>
      <br>
      <p>Imparting Agricultural Education and Conducting basic and Applied Agricultural Research throughout the Province</p>
    </div>
    <div class="box box4">
      <h1>Basic and Applied Agricultural Research</h1>
      <br>
      <p>Producing Quality Graduates having strong moral and ethical values deeply rooted in the Culture of Pakistan</p>
    </div>
    <div class="box box5">
      <h1>The University of Agriculture, Peshawar</h1>
      <br>
      <p>To provide instructions, trainings, research and outreach; in agriculture, animal husbandry and other such disciplines of learning.</p>
    </div>
  </div>
  <!-- about -->
  <!-- ksldksldks -->
  <section id="about" class="section about">
    <div class="container grid-2">
      <div class="about-text">
        <h2>About University of Excellence</h2>
        <p>
          The University of Agriculture, Peshawar (UAP) is a leading institution in Pakistan, dedicated to excellence in agricultural education, research, and rural development. Established in 1981, UAP has played a pivotal role in advancing agricultural sciences and addressing the challenges faced by the agricultural sector in the region
        </p>
        <ul class="bullets">
          <li>World-class faculty: Experts in crop science, animal husbandry, biotechnology, and environmental management.</li>
          <li>Hands-on learning: Modern laboratories, research farms, and practical training for real-world skills.</li>
          <li>Global partnerships: Collaborations with international universities and organizations for research and exchange programs.</li>
          <li>Focus on sustainable agriculture: Training students to contribute to food security and rural development.</li>
          <li>Innovation and research: Cutting-edge research in agriculture, biotechnology, and environmental sustainability.</li>
        </ul>
      </div>
      <div class="about-media">
        <img
          src="compus_life.jpg"
          alt="Campus life" />
      </div>
    </div>
  </section>
  <!-- department -->

  <section id="departments" class="section departments">
    <div class="container">
      <h2>Departments</h2>
      <div class="dept-grid">
        <article class="dept-card" data-dept="Computer Science">
          <h3>Computer Science</h3>
          <p>AI, Systems, Software Engineering</p>
        </article>
        <article class="dept-card" data-dept="Engineering">
          <h3>Engineering</h3>
          <p>Civil, Electrical, Mechanical</p>
        </article>
        <article class="dept-card" data-dept="Business">
          <h3>Business</h3>
          <p>Management, Finance, Innovation</p>
        </article>
        <article class="dept-card" data-dept="Medicine">
          <h3>Medicine</h3>
          <p>Clinical & Research Programs</p>
        </article>
        <article class="dept-card" data-dept="Medicine">
          <h3>Agriculture</h3>
          <p>Crop Science, Horticulture, Soil Science </p>
        </article>
        <article class="dept-card" data-dept="Medicine">
          <h3>Animal Science</h3>
          <p>Dairy, Poultry, Veterinary</p>
        </article>
        <article class="dept-card" data-dept="Medicine">
          <h3>Biotechnology</h3>
          <p>Genetics, Molecular Biology, Bioinformatics</p>
        </article>
        <article class="dept-card" data-dept="Medicine">
          <h3>Environmental Science</h3>
          <p>Ecology, Conservation, Sustainability</p>
        </article>
        <article class="dept-card" data-dept="Medicine">
          <h3>Management</h3>
          <p>Business, Economics, Project Management</p>
        </article>
        <article class="dept-card" data-dept="Medicine">
          <h3>Physics</h3>
          <p>Quantum, Mechanics, Astrophysics</p>
        </article>
        <article class="dept-card" data-dept="Medicine">
          <h3>Chemistry</h3>
          <p>Organic, Inorganic, Physical Chemistry</p>
        </article>
        <article class="dept-card" data-dept="Medicine">
          <h3>Mathematics</h3>
          <p>Algebra, Calculus, Statistics</p>
        </article>
      </div>
    </div>
  </section>
  <!-- campus galray -->
  <section id="campus" class="section campus">
    <div class="container my-5" id="gallery-container">
      <h1>Faculty Deans</h1>
      <div class="row g-3 gallery">
        <div class="col-md-3">
          <div class="img-container">
            <img src="faculty_deans.jpg" alt="Faculty Dean 1">
          </div>
        </div>
        <div class="col-md-3">
          <div class="img-container">
            <img src="faculty_deans1.jpg" alt="Faculty Dean 2">
          </div>
        </div>
        <div class="col-md-3">
          <div class="img-container">
            <img src="faculty_deans2.jpg" alt="Faculty Dean 3">
          </div>
        </div>
        <div class="col-md-3">
          <div class="img-container">
            <img src="per1.jpg" alt="Faculty Dean 4">
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- stats-->
  <section id="stats" class="section stats">
    <div class="container stats-grid">
      <div class="stat">
        <div class="num" data-target="24000"><span id="studentCount">0</span></div>
        <div class="label">Students</div>
      </div>
      <div class="stat">
        <div class="num" data-target="1500"> <span id="teacherCount">0</span></div>
        <div class="label">Faculty</div>
      </div>
      <div class="stat">
        <div class="num" data-target="320"> <span id="deptCount">0</span></div>
        <div class="label">Programs</div>
      </div>
    </div>
  </section>
  <footer class="footer">
    <div class="container">© 2025 University of agricultural</div>
  </footer>
  <script src="salider.js"></script>

  <!-- Typewriter Effect JavaScript -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const text = "Excellence in Education";
      const textElement = document.getElementById('typewriter-text');
      const cursor = document.querySelector('.typewriter-cursor');
      let index = 0;

      function typeWriter() {
        if (index < text.length) {
          textElement.textContent = text.slice(0, index + 1);
          index++;
          setTimeout(typeWriter, 100); // Adjust speed here (100ms per character)
        } else {
          // Start the movement animation after typing is complete
          setTimeout(() => {
            textElement.style.animation = 'typewriterMove 6s ease-in-out infinite alternate';
          }, 500);
        }
      }

      // Start the typewriter effect after a short delay
      setTimeout(typeWriter, 1000);
    });
  </script>

  <!-- Rotating Text Effect JavaScript -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const rotatingTexts = [
        "Scholarships and Global Programs",
        "Research and Innovation Hub",
        "Academic Excellence Center",
        "Student Success Stories",
        "Faculty Development Programs"
      ];

      const typedTextElement = document.getElementById('typed-text');
      let currentTextIndex = 0;

      function showNextText() {
        // Fade out current text
        typedTextElement.classList.add('rotating-text-fade-out');

        setTimeout(() => {
          // Change text and fade in
          currentTextIndex = (currentTextIndex + 1) % rotatingTexts.length;
          typedTextElement.textContent = rotatingTexts[currentTextIndex];
          typedTextElement.classList.remove('rotating-text-fade-out');
          typedTextElement.classList.add('rotating-text-fade-in');

          // Remove fade-in class after animation completes
          setTimeout(() => {
            typedTextElement.classList.remove('rotating-text-fade-in');
          }, 500);
        }, 500); // Wait for fade out to complete
      }

      // Start rotating text after 3 seconds (after typewriter effect)
      setTimeout(() => {
        // Set initial text
        typedTextElement.textContent = rotatingTexts[0];
        // Start rotation cycle
        setInterval(showNextText, 4000); // Change text every 4 seconds
      }, 3000);
    });
  </script>
</body>

</html>
<!-- for teacher img anitmation -->
<script>
  const images = document.querySelectorAll(".img-container img");
  let currentIndex = 0;
  let visibleCount = 4;

  function showNextImages() {
    images.forEach(img => {
      img.style.opacity = 0;
      img.style.transform = "translateX(100%)";
    });
    for (let i = 0; i < visibleCount; i++) {
      const index = (currentIndex + i) % images.length;
      setTimeout(() => {
        images[index].style.opacity = 1;
        images[index].style.transform = "translateX(0)";
      }, i * 300);
    }
    currentIndex = (currentIndex + 1) % images.length;
    setTimeout(showNextImages, 3000);
  }
  setTimeout(showNextImages, 3000);
</script>
<!-- student Faculty program -->
<script>
  // for department
  let targetDepartments = <?php echo $total_departments; ?>;
  let counterDepartments = document.getElementById("deptCount");
  let durationDepartments = 3000;
  let stepTimeDepartments = Math.max(Math.floor(durationDepartments / targetDepartments), 20);

  let currentDepartments = 0;
  let timerDepartments = setInterval(() => {
    currentDepartments++;
    counterDepartments.textContent = currentDepartments;
    if (currentDepartments >= targetDepartments) {
      clearInterval(timerDepartments);
    }
  }, stepTimeDepartments);
  // for Teachers
  let targetTeachers = <?php echo $total_teachers; ?>;
  let counterTeachers = document.getElementById("teacherCount");
  let durationTeachers = 3000;
  let stepTimeTeachers = Math.max(Math.floor(durationTeachers / targetTeachers), 20);
  let currentTeachers = 0;
  let timerTeachers = setInterval(() => {
    currentTeachers++;
    counterTeachers.textContent = currentTeachers;
    if (currentTeachers >= targetTeachers) {
      clearInterval(timerTeachers);
    }
  }, stepTimeTeachers);
  // for students
  document.addEventListener("DOMContentLoaded", function() {
    let target = <?php echo $total_students; ?>;
    let counter = document.getElementById("studentCount");
    let duration = 3000;
    let stepTime = Math.max(Math.floor(duration / target), 20);
    let current = 0;
    let timer = setInterval(() => {
      current++;
      counter.textContent = current;
      if (current >= target) {
        clearInterval(timer);
      }
    }, stepTime);
  });
</script>