<?php
require_once 'includes/db.php';
require_once 'includes/session.php';

$errors  = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    if (empty($name) || empty($email) || empty($message)) {
        $errors[] = 'All fields are required.';
    } elseif (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email address.';
    }

    if (empty($errors)) {
        $stmt = $conn->prepare('INSERT INTO messages (user_id, name, email, message) VALUES (?, ?, ?, ?)');
        $stmt->bind_param('isss', $user_id, $name, $email, $message);
        if ($stmt->execute()) {
            $success = 'Thank you for contacting us! We will get back to you soon.';
        } else {
            $errors[] = 'Failed to send your message. Please try again.';
        }
        $stmt->close();
    }
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unique Trust Investment - Home</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY&callback=myMap"></script>
</head>

<body>
    <header>
        <div class="container nav-container">
            <div class="logo">
                <img src="assets/img/logo.png" alt="Unique Trust Investment Logo" style="height:100px;">
                <span class="company-name">Unique Trust Investment</span>
            </div>
            <nav>
                <ul class="nav-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="services.php">Services</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="signup.php">Sign Up</a></li>
                </ul>
                <div class="hamburger" id="hamburger-menu">
                    <span></span><span></span><span></span>
                </div>
            </nav>
        </div>
    </header>
    <main>
        <section class="hero">
            <div class="container">

                <h1>Welcome to Unique Trust Investment</h1>
                <p>Your trusted partner for Leasing, Divimaga, Peramaga, and Speed financial solutions. We provide fast, secure, and reliable loans tailored to your needs.</p>
                <a href="contact.php" class="cta-btn">Contact Us</a>
            </div>
        </section>

        <!-- About Section -->
        <section class="about-section">
            <div class="container">
                <div class="about-header">
                    <h2>About Unique Trust Investment</h2>
                    <p>Building financial futures with trust and expertise</p>
                </div>

                <div class="about-main">
                    <div class="about-main-text">
                        <h3>Leading Financial Solutions Provider</h3>
                        <p>Unique Trust Investment is a premier financial company dedicated to providing innovative and reliable financial products. With years of experience in the industry, we have built a reputation for excellence and trustworthiness.</p>
                        <p>Our commitment to customer satisfaction and financial growth has made us a preferred choice for individuals and businesses seeking quality financial services.</p>
                    </div>
                    <div class="about-main-img">
                        <img src="assets/img/about-image.png" alt="About Unique Trust Investment">
                    </div>
                </div>

                <div class="about-stats">
                    <div class="about-stats-clients">
                        <h3>10,000+</h3>
                        <p>Satisfied Clients</p>
                    </div>
                    <div class="about-stats-years">
                        <h3>15+</h3>
                        <p>Years Experience</p>
                    </div>
                    <div class="about-stats-awards">
                        <h3>50+</h3>
                        <p>Awards Won</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Enhanced Stats & Company Info Section -->

        <section class="stats-company-section">
            <div class="container">

                <!-- Company History -->
                <div class="stats-company-info">
                    <h2>Our Journey</h2>
                    <p>Unique Trust Investment has been serving clients with reliable financial solutions for over a decade, specializing in loans, leasing, and innovative products like Divimaga and Peramaga.</p>
                </div>

                <!-- Mission, Vision, Values -->
                <div class="stats-company-missionvisionvalues">
                    <div class="stats-company-mission-item">
                        <div class="stats-company-mission-item-icon">
                            <div class="stats-company-mission-item-icon-circle">
                                <span>🎯</span>
                            </div>
                        </div>
                        <h3>Mission</h3>
                        <p>To provide fast, secure, and accessible financial services to individuals and businesses.</p>
                    </div>

                    <div class="stats-company-vision-item">
                        <div class="stats-company-vision-item-icon">
                            <div class="stats-company-vision-item-icon-circle">
                                <span>👁️</span>
                            </div>
                        </div>
                        <h3>Vision</h3>
                        <p>To be the most trusted financial partner in the region, known for integrity and customer focus.</p>
                    </div>

                    <div class="stats-company-values-item">
                        <div class="stats-company-values-item-icon">
                            <div class="stats-company-values-item-icon-circle">
                                <span style="color:#fff;font-size:1.5rem;">💎</span>
                            </div>
                        </div>
                        <h3>Values</h3>
                        <ul>
                            <li>✓ Integrity</li>
                            <li>✓ Innovation</li>
                            <li>✓ Customer Focus</li>
                            <li>✓ Transparency</li>
                        </ul>
                    </div>
                </div>

                <!-- Team Section -->
                <div class="team-section">
                    <h2>Meet Our Team</h2>
                    <div class="team-container">
                        <div class="team-member1">
                            <img src="assets/img/team1.png" alt="Jane Doe">
                            <h3>Jane Doe</h3>
                            <p class="para-main">CEO</p>
                            <p class="para-text">Leading our company with vision and expertise</p>
                        </div>
                        <div class="team-member2">
                            <img src="assets/img/team2.png" alt="John Smith">
                            <h3>John Smith</h3>
                            <p class="para-main">Head of Operations</p>
                            <p class="para-text">Ensuring smooth operations and client satisfaction</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--Services Hero Section -->
        <section class="services-hero">
            <div class="services-hero-main" style="position:absolute;top:0;left:0;right:0;bottom:0;">
            </div>

            <div class="container">
                <div class="services-hero-header">
                    <h1>Our Financial Services</h1>
                    <p>Discover our comprehensive range of trusted financial solutions designed to meet your unique needs and help you achieve your financial goals.</p>
                    <div class="services-item">
                        <div class="services-item-fast">
                            <span>✓ Fast Approval</span>
                        </div>
                        <div class="services-item-secure">
                            <span>✓ Secure & Reliable</span>
                        </div>
                        <div class="services-item-expert">
                            <span>✓ Expert Support</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Enhanced Services List Section -->
        <section class="service-list">
            <div class="container">
                <div class="service-list-grid">
                    <div class="service-card">
                        <div class="service-card-background-leasing">
                            <img src="assets/img/leasing.png" alt="Leasing">
                        </div>
                        <div class="service-card-leasing">
                            <h3>Leasing</h3>
                            <p>Flexible leasing options for vehicles and equipment to help you grow your business with minimal upfront costs.</p>
                            <ul>
                                <li>Equipment financing</li>
                                <li>Flexible payment terms</li>
                                <li>Quick approval process</li>
                                <li>Asset management support</li>
                            </ul>
                            <div class="service-card-more">
                                <a href="contact.php">Learn More</a>
                            </div>
                        </div>
                    </div>

                    <div class="service-card">
                        <div class="service-card-background-divimaga">
                            <img src="assets/img/divimaga.png" alt="Divimaga">
                        </div>
                        <div class="service-card-divimaga">
                            <h3>Divimaga</h3>
                            <p>Innovative Divimaga loans designed for your unique needs with fast approvals and competitive rates.</p>
                            <ul>
                                <li>High-yield investment opportunities</li>
                                <li>Professional portfolio management</li>
                                <li>Risk-adjusted returns</li>
                                <li>Regular performance reports</li>
                            </ul>
                            <div class="service-card-more">
                                <a href="contact.php">Learn More</a>
                            </div>
                        </div>
                    </div>

                    <div class="service-card">
                        <div class="service-card-background-peramaga">
                            <img src="assets/img/peramaga.png" alt="Peramaga">
                        </div>
                        <div class="service-card-peramaga">
                            <h3>Peramaga</h3>
                            <p>Peramaga financial solutions for personal and business growth with flexible terms and competitive rates.</p>
                            <ul>
                                <li>Flexible investment terms</li>
                                <li>Competitive interest rates</li>
                                <li>Goal-based planning</li>
                                <li>Easy withdrawal options</li>
                            </ul>
                            <div class="service-card-more">
                                <a href="contact.php">Learn More</a>
                            </div>
                        </div>
                    </div>

                    <div class="service-card">
                        <div class="service-card-background-sewana">
                            <img src="assets/img/sewana.png" alt="Sewana">
                        </div>
                        <div class="service-card-sewana">
                            <h3>Sewana</h3>
                            <p>Quick and easy Sewana loans to meet urgent financial requirements with instant approval process.</p>
                            <ul>
                                <li>Instant approval process</li>
                                <li>Minimal documentation</li>
                                <li>Quick disbursement</li>
                                <li>24/7 customer support</li>
                            </ul>
                            <div class="service-card-more">
                                <a href="contact.php">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Enhanced Testimonials Section -->
        <section class="testimonials-section">
            <div class="container">
                <div class="testimonials-header">
                    <h2>What Our Clients Say</h2>
                    <p>Real stories from satisfied customers who trust us with their financial future</p>
                </div>

                <div class="testimonials-body">
                    <div class="testimonial1">
                        <div class="testimonials-rating1">
                            ⭐⭐⭐⭐⭐
                        </div>
                        <p>"Unique Trust Investment helped me achieve my financial goals with their Divimaga product. The returns exceeded my expectations and the customer service was exceptional!"</p>
                        <div class="testimonials-text">
                            <img src="assets/img/client1.png" alt="Sarah Johnson">
                            <div>
                                <strong>Sarah Johnson</strong><br>
                                <small class="small-owner">Business Owner</small><br>
                                <small class="small-client">Divimaga Client</small>
                            </div>
                        </div>
                    </div>

                    <div class="testimonial2">
                        <div class="testimonials-rating2">
                            ⭐⭐⭐⭐⭐
                        </div>
                        <p>"The Peramaga savings plan is perfect for my needs. Flexible terms and great customer service make all the difference. Highly recommended!"</p>
                        <div class="testimonials-text">
                            <img src="assets/img/client2.png" alt="Michael Chen">
                            <div>
                                <strong>Michael Chen</strong><br>
                                <small class="small-owner">Software Engineer</small><br>
                                <small class="small-client">Peramaga Client</small>
                            </div>
                        </div>
                    </div>

                    <div class="testimonial3">
                        <div class="testimonials-rating3">
                            ⭐⭐⭐⭐⭐
                        </div>
                        <p>"Their leasing solutions helped our company expand without the heavy upfront costs. The process was smooth and the team was incredibly professional!"</p>
                        <div class="testimonials-text">
                            <img src="assets/img/client3.png" alt="Emily Rodriguez">
                            <div>
                                <strong>Emily Rodriguez</strong><br>
                                <small class="small-owner">Operations Manager</small><br>
                                <small class="small-client">Leasing Client</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="testimonials-end-text">
                    <p>Join thousands of satisfied customers</p>
                    <a href="contact.php">Start Your Journey Today</a>
                </div>
            </div>
        </section>

        <!-- Enhanced Contact Hero Section -->
        <section class="contactus-hero">
            <div class="contactus-section">
            </div>
            <div class="contactus-container">
                <div class="contactus-heading">
                    <div class="contactus-background">
                        <div class="contactus-header">
                            <i class="fa-regular fa-comments fa-2x"></i>
                        </div>
                        <h1>Get In Touch</h1>
                        <p class="contactus-header-info">Ready to start your financial journey with us? Contact our expert team for personalized financial solutions and expert guidance.</p>
                        <div class="contactus-info-section">
                            <div class="info-block email">
                                <div class="info-icon email">
                                    <i class="fa-regular fa-comments fa-2x"></i>
                                </div>
                                <div>
                                    <h3>Email Us</h3>
                                    <p>info@uniquetrustinvestment.com</p>
                                </div>
                            </div>
                            <div class="info-block phone">
                                <div class="info-icon phone">
                                    <i class="fa-solid fa-headset fa-2x"></i>
                                </div>
                                <div>
                                    <h3>Call Us</h3>
                                    <p>+94 11 234 5678</p>
                                </div>
                            </div>
                            <div class="info-block address">
                                <div class="info-icon address">
                                    <i class="fa-regular fa-map fa-2x"></i>
                                </div>
                                <div>
                                    <h3>Visit Us</h3>
                                    <p>123 Main Street, Colombo, Sri Lanka</p>
                                </div>
                            </div>
                        </div>
                        <div class="contactus-business" style="margin-top:3rem;padding:2rem;background:linear-gradient(135deg, #e3f2fd, #f3e5f5);border-radius:15px;text-align:center;">
                            <h3 style="">Business Hours</h3>
                            <p style=""><strong>Monday - Friday:</strong> 9:00 AM - 6:00 PM</p>
                            <p style=""><strong>Saturday:</strong> 9:00 AM - 2:00 PM</p>
                            <p style=""><strong>Sunday:</strong> Closed</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <!-- Contact Message Form Section -->
        <section class="contact-form-section">
            <div class="container">
                <div class="contact-form-main">
                    <!-- Contact Form -->
                    <div class="contact-form">
                        <h2>Send Us a Message</h2>

                        <?php if ($errors): ?>
                            <div class="contact-form-error">
                                <?php foreach ($errors as $error) {
                                    echo '<p style="margin:0.5rem 0;">' . htmlspecialchars($error) . '</p>';
                                }
                                ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($success): ?>
                            <div class="contact-form-success">
                                <p style="margin:0;"><?php echo $success ?></p>
                            </div>
                        <?php endif; ?>

                        <form method="post" action="">
                            <div class="contact-form-name">
                                <label>Full Name *</label>
                                <input type="text" name="name" required value="<?php echo htmlspecialchars($_POST['name'] ?? '') ?>"

                                    placeholder="Enter your full name">
                            </div>

                            <div class="contact-form-email">
                                <label>Email Address *</label>
                                <input type="email" name="email" required value="<?php echo htmlspecialchars($_POST['email'] ?? '') ?>"

                                    placeholder="Enter your email address">
                            </div>

                            <div class="contact-form-message">
                                <label>Message *</label>
                                <textarea name="message" rows="6" required

                                    placeholder="Tell us about your financial needs or any questions you have"><?php echo htmlspecialchars($_POST['message'] ?? '') ?></textarea>
                            </div>

                            <button class="contact-form-button" type="submit">
                                Send Message
                            </button>
                        </form>
                    </div>
                    <div class="contact-form-map" id="googleMap">
                            <h1>Location</h1>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d699.663363369387!2d79.90947112474417!3d7.252941149484347!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2slk!4v1753366501545!5m2!1sen!2slk" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                    </div>

                    <!-- Contact Information -->
                    <!--                    <div style="background:#fff;padding:3rem;border-radius:20px;box-shadow:0 8px 32px rgba(0,0,0,0.1);">
                        <h2 style="color:#1a237e;font-size:2rem;margin-bottom:2rem;text-align:center;">Get In Touch</h2>

                        <div style="display:flex;flex-direction:column;gap:2rem;">
                            <div class="info-block email">
                                <div class="info-icon email">
                                    <i class="fa-regular fa-comments fa-2x" style="color:#1976d2;"></i>
                                </div>
                                <div>
                                    <h3>Email Us</h3>
                                    <p>info@uniquetrustinvestment.com</p>
                                </div>
                            </div>
                            <div class="info-block phone">
                                <div class="info-icon phone">
                                    <i class="fa-solid fa-headset fa-2x" style="color:#1976d2;"></i>
                                </div>
                                <div>
                                    <h3>Call Us</h3>
                                    <p>+94 11 234 5678</p>
                                </div>
                            </div>
                            <div class="info-block address">
                                <div class="info-icon address">
                                    <i class="fa-regular fa-map fa-2x" style="color:#1976d2;"></i>
                                </div>
                                <div>
                                    <h3>Visit Us</h3>
                                    <p>123 Main Street, Colombo, Sri Lanka</p>
                                </div>
                            </div>
                        </div>

                        <div style="margin-top:3rem;padding:2rem;background:linear-gradient(135deg, #e3f2fd, #f3e5f5);border-radius:15px;text-align:center;">
                            <h3 style="color:#1a237e;margin-bottom:1rem;">Business Hours</h3>
                            <p style="color:#555;margin:0.5rem 0;"><strong>Monday - Friday:</strong> 9:00 AM - 6:00 PM</p>
                            <p style="color:#555;margin:0.5rem 0;"><strong>Saturday:</strong> 9:00 AM - 2:00 PM</p>
                            <p style="color:#555;margin:0.5rem 0;"><strong>Sunday:</strong> Closed</p>
                        </div>
                    </div>
                        -->

                </div>
            </div>
        </section>


        <!-- Call to Action Section -->
    </main>

    <footer class="site-footer">
        <div class="footer-top">
            <div class="container footer-social">
                <span>Follow us:</span>
                <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
        <div class="footer-middle">
            <div class="container footer-columns">
                <div class="footer-col">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="services.php">Services</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>About Us</h4>
                    <ul>
                        <li><a href="#">Our History</a></li>
                        <li><a href="#">Mission & Vision</a></li>
                        <li><a href="#">Team</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Support</h4>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Contact</h4>
                    <ul>
                        <li>123 Main Street, Colombo, Sri Lanka</li>
                        <li>info@uniquetrustinvestment.com</li>
                        <li>+94 11 234 5678</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <p>Unique Trust Investment PLC, 123 Main Street, Colombo, Sri Lanka.</p>
                <p>&copy; <?php echo date('Y'); ?> Unique Trust Investment. All rights reserved.</p>
                <p class="dev-credit">Design & Development by <a href="#">Niro</a></p>
            </div>
        </div>
    </footer>

    <script>
        function myMap() {
            var mapProp = {
                center: new google.maps.LatLng(7.252966, 79.909966),
                zoom: 5,
            };
            var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
        }
    </script>

    <script src="assets/js/main.js"></script>
</body>

</html>