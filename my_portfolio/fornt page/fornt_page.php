<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;

require 'vendor/autoload.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = htmlspecialchars($_POST['name']);
    $email   = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'umarak47m@gmail.com';
        $mail->Password   = 'sqqg zyvw qybg zhbb';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;
        $mail->setFrom($email, $name);
        $mail->addAddress('umarak47m@gmail.com');
        $mail->addAddress('+923040024760@sms.gateway.com');
        $mail->isHTML(false);
        $mail->Subject = "New Contact Message from $name";
        $mail->Body    = "You have received a new message:\n\n" .
            "Name: $name\n" .
            "Email: $email\n" .
            "Message:\n$message\n";
        $mail->send();
        echo "✅ Message sent successfully!";
    } catch (PHPMailerException $e) {
        echo "❌ Sorry, message could not be sent. Error: {$mail->ErrorInfo}";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Portfolio Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="fornt_page.css" />
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
</head>
<style>
    canvas {
        position: fixed;
        top: 0;
        left: 0;
        width: 100% !important;
        height: 100%;
        z-index: -1;
    }
</style>

<body>

    <button id="theme-toggle">🌙</button>
    <nav>
        <ul>
            <li style="border: 3px solid black; padding: 8px 15px; border-radius: 8px;">Welcome</li>
            <li>Home</li>
            <li>
                <a href="#skills-section" class="text-decoration-none text-white">Skills</a>
            </li>
            <li>
                Services
                <ul>
                    <li>Service 1</li>
                    <li>Service 2</li>
                    <li>Service 3</li>
                </ul>
            </li>
            <li>
                Portfolio
                <ul>
                    <li>Project 1</li>
                    <li>Project 2</li>
                    <li>Project 3</li>
                </ul>
            </li>
        </ul>
    </nav>

    <section class="intro-section">
        <canvas id="rain"></canvas>
        <div class="intro-content">
            <h1 class="moving-name">Hi, It's <span class="highlight">Me umar zada amir</span></h1>
            <h2>I'm a <span id="typed"></span></h2>
            <p>
                With a strong focus on building reliable, scalable, and efficient server-side applications.
                I work with databases, APIs, and server logic to power modern web applications.
            </p>
            <div class="social-icons">
                <div class="footer-social">
                    <a href="https://www.linkedin.com/in/umar-zada-756655207/"><img src="https://cdn-icons-png.flaticon.com/512/174/174857.png" alt="LinkedIn"></a>
                    <a href="https://github.com/umarzadaamir"><img src="https://cdn-icons-png.flaticon.com/512/25/25231.png" alt="GitHub"></a>
                    <a href="https://x.com/UmarZada230547"><img src="https://cdn-icons-png.flaticon.com/512/733/733579.png" alt="Twitter"></a>
                    <a href="http://localhost/php/my_portfolio/fornt%20page/fornt_page.php#"><img src="https://cdn-icons-png.flaticon.com/512/732/732200.png" alt="Email"></a>
                </div>
            </div>
            <div class="intro-buttons">
                <button class="btn primary-btn"><a href="#footer" class="text-decoration-none">About Me</a></button>
                <button class="btn secondary-btn"><a href="#contact" class="text-decoration-none">Contact</a></button>
            </div>
        </div>
        <div class="intro-image">
            <img src="umar.jpeg" alt="Me umar" />
        </div>
    </section>
    <section class="skills-section">
        <h2>My Skills for Frontend & Backend</h2>
        <div class="skills-container">
            <div class="skill-box">
                <div class="skill"><span>HTML</span>
                    <div class="skill-bar">
                        <div class="skill-progress html"></div>
                    </div>
                </div>
                <div class="skill"><span>CSS</span>
                    <div class="skill-bar">
                        <div class="skill-progress css"></div>
                    </div>
                </div>
                <div class="skill"><span>JavaScript</span>
                    <div class="skill-bar">
                        <div class="skill-progress js"></div>
                    </div>
                </div>
                <div class="skill"><span>Bootstrap</span>
                    <div class="skill-bar">
                        <div class="skill-progress uiux"></div>
                    </div>
                </div>
            </div>
            <div class="skill-box">
                <div class="skill"><span>PHP</span>
                    <div class="skill-bar">
                        <div class="skill-progress php"></div>
                    </div>
                </div>
                <div class="skill"><span>Database</span>
                    <div class="skill-bar">
                        <div class="skill-progress db"></div>
                    </div>
                </div>
                <div class="skill"><span>Laravel</span>
                    <div class="skill-bar">
                        <div class="skill-progress laravel"></div>
                    </div>
                </div>
                <div class="skill"><span>jQuery</span>
                    <div class="skill-bar">
                        <div class="skill-progress jquery"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="projects">
        <h2>My Projects</h2>
        <div class="projects-container">
            <div class="project-card">
                <h3>Attendance</h3>
                <img src="attendance.png" alt="">
                <p> PHP, DB, and JavaScript functionality</p>
                <a href="../../my_project/form/form.php" class="btn project_btn">button</a>
            </div>
            <div class="project-card">
                <h3>Calculator for laptop and mobile</h3>
                <img src="simple_calculator.png" alt="">
                <p>A simple JavaScript calculator with memory functions.</p>
                <a href="../../my colculator\calculator simple\calculator for liptop\calculator.html" class="btn project_btn">button</a>
            </div>
            <div class="project-card">
                <h3> scientific calculator </h3>
                <img src="scientific_calculator.png" alt="">
                <p>A JavaScript , jquery plugin cientific calculator </p>
                <a href="../../my colculator\calculator sintific\index.html" class="btn project_btn">button</a>
            </div>
            <div class="project-card">
                <h3>Currency Converter</h3>
                <img src="currency.png" alt="">
                <p>Currency Converter its create on JavaScript</p>
                <a href="../../Currency Converter\Currency_Converter.html" class="btn project_btn">button</a>
            </div>
            <div class="project-card">
                <h3>Digital Clock</h3>
                <img src="clock.png" alt="">
                <p>JavaScript Digital Clock </p>
                <a href="../../clock\clock.php" class="btn project_btn">button</a>
            </div>
            <div class="project-card">
                <h3>Grade Program</h3>
                <img src="grade.png" alt="">
                <p> JavaScript grade program.</p>
                <a href="../../my grade program\grade.html" class="btn project_btn">button</a>
            </div>
            <!-- kldklskd -->
            <div class="project-card">
                <h3>clock</h3>
                <img src="line_clock.png" alt="">
                <p> JavaScript clock program.</p>
                <a href="../../line_clock\line_clock.html" class="btn project_btn">button</a>
            </div>
        </div>
        </div>
    </section>
    <section id="contact">
        <h2>Contact Me</h2>
        <form action="" method="POST">
            <label class="in">Your Name</label>
            <input type="text" name="name" placeholder="Your Name" required>

            <label class="in">Your Email</label>
            <input type="email" name="email" placeholder="Your Email" required>

            <label class="in">Your Message</label>
            <textarea name="message" placeholder="Your Message" rows="5" required></textarea>
            <button type="submit" class="btn">Send Message</button>
        </form>
    </section>
    <section id="footer">
        <footer class="footer">
            <div class="footer-container">
                <div class="footer-about">
                    <h2>Mian Umar Zada Amir</h2>
                    <p>Backend Developer passionate about building scalable and modern web applications with PHP, Laravel, Node.js, and databases.</p>
                </div>
                <div class="footer-links">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#projects">Services</a></li>
                        <li><a href="#">Portfolio</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-contact">
                    <h3>Contact</h3>
                    <p>Email: <a href="mailto:yourmail@example.com">umarak47m@gmail.com</a></p>
                    <p>Phone: +92 3040024760</p>
                </div>
                <div class="footer-newsletter">
                    <h3>Stay Updated</h3>
                    <div class="footer-social">
                        <a href="https://www.linkedin.com/in/umar-zada-756655207/"><img src="https://cdn-icons-png.flaticon.com/512/174/174857.png" alt="LinkedIn"></a>
                        <a href="https://github.com/umarzadaamir"><img src="https://cdn-icons-png.flaticon.com/512/25/25231.png" alt="GitHub"></a>
                        <a href="https://x.com/UmarZada230547"><img src="https://cdn-icons-png.flaticon.com/512/733/733579.png" alt="Twitter"></a>
                        <a href="http://localhost/php/my_portfolio/fornt%20page/fornt_page.php#"><img src="https://cdn-icons-png.flaticon.com/512/732/732200.png" alt="Email"></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Mian Umar Zada Amir | All Rights Reserved.</p>
            </div>
        </footer>
    </section>
    <script src="fornt_page.js"></script>
    <script>
        const canvas = document.getElementById("rain");
        const ctx = canvas.getContext("2d");

        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;


        class RainDrop {
            constructor() {
                this.x = Math.random() * canvas.width;
                this.y = Math.random() * -canvas.height;
                this.length = Math.random() * 20 + 10;
                this.speed = Math.random() * 5 + 4;
                this.opacity = Math.random() * 0.3 + 0.2;
            }

            draw() {
                ctx.beginPath();
                ctx.strokeStyle = `rgba(0, 200, 255, ${this.opacity})`;
                ctx.lineWidth = 2;
                ctx.moveTo(this.x, this.y);
                ctx.lineTo(this.x, this.y + this.length);
                ctx.stroke();
            }

            update() {
                this.y += this.speed;
                if (this.y > canvas.height) {
                    this.y = Math.random() * -100;
                    this.x = Math.random() * canvas.width;
                }
                this.draw();
            }
        }


        class Ripple {
            constructor(x, y) {
                this.x = x;
                this.y = y;
                this.radius = 1;
                this.maxRadius = 30;
                this.alpha = 1;
            }

            draw() {
                ctx.beginPath();
                ctx.strokeStyle = `rgba(0, 200, 255, ${this.alpha})`;
                ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
                ctx.stroke();
            }

            update() {
                if (this.radius < this.maxRadius) {
                    this.radius += 0.5;
                    this.alpha -= 0.02;
                    this.draw();
                }
            }
        }

        let drops = [];
        let ripples = [];

        for (let i = 0; i < 100; i++) {
            drops.push(new RainDrop());
        }

        function animate() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            drops.forEach((drop) => {
                drop.update();

                if (drop.y + drop.length >= canvas.height) {
                    ripples.push(new Ripple(drop.x, canvas.height - 2));
                }
            });

            ripples.forEach((r, index) => {
                r.update();
                if (r.alpha <= 0) {
                    ripples.splice(index, 1);
                }
            });

            requestAnimationFrame(animate);
        }

        animate();

        window.addEventListener("resize", () => {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        });
    </script>
</body>

</html>