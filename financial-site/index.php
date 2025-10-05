<?php
require_once 'includes/db.php';
require_once 'includes/session.php';

$errors  = [];
$success = '';
date_default_timezone_set('Asia/Colombo');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');
    $role = trim($_POST['role'] ?? '');
    $date = date('Y-m-d H:i:s');
    $reply_message = '';
    $handler = '';
    $reply_date = date('Y-m-d H:i:s');

    if (empty($name) || empty($email) || empty($message) || empty($role)) {
        $errors[] = 'All fields are required.';
    } elseif (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email address.';
    }

    if (empty($errors)) {
        $query = $db->prepare('INSERT INTO messages (customer_name, email, message, date, category,reply_message,handler,reply_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        $query->bind_param('ssssssss', $name, $email, $message, $date, $role, $reply_message, $handler, $reply_date);


        if ($query->execute()) {
            $success = 'Thank you for contacting us! We will get back to you soon.';
        } else {
            $errors[] = 'Failed to send your message. Please try again.';
        }
        $query->close();
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY&callback=myMap"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
    <header>
        <div class="container nav-container">
            <div class="logo">
                <img src="assets/img/logo.png" alt="Unique Trust Investment Logo">
                <span class="company-name">Unique Trust Investment</span>
            </div>
            <nav>
                <ul class="nav-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#contacts">Contact</a></li>
                    <li><a href="faq.php">FAQ</a></li>
                    <li><a href="policy.php">Privacy Policy</a></li>
                    <li><a href="login.php">Login</a></li>

                </ul>
                <div class="hamburger" id="hamburger-menu">
                    <span></span><span></span><span></span>
                </div>
            </nav>
        </div>
    </header>
    <main>
        <section id="home" class="hero">
            <div class="container">

                <h1>Welcome to Unique Trust Investment</h1>
                <p>Your trusted partner for Leasing, Divimaga, Peramaga, and Speed financial solutions. We provide fast, secure, and reliable loans tailored to your needs.</p>
                <a href="index.php#contact-form" class="cta-btn">Contact Us</a>
            </div>
            <button class="scroll-to-top" id="btn-scroll" onclick="scrollToTop()"><i class="fa-solid fa-arrow-up"></i></button>
        </section>

        <!-- About Section -->
        <section id="about" class="about-section">
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
                <div id="history" class="stats-company-info">
                    <h2>Our Journey</h2>
                    <p>Unique Trust Investment has been serving clients with reliable financial solutions for over a decade, specializing in loans, leasing, and innovative products like Divimaga and Peramaga.</p>
                </div>

                <!-- Mission, Vision, Values -->
                <div id="mission-vision" class="stats-company-missionvisionvalues">
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
                <div id="team" class="team-section">
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
        <section id="services" class="services-hero">
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

<!-- 

        <section>
            <div class="container">
                <div class="services-carousel">
                    <div class="carousel" aria-label="Gallery">



                        <ol class="carousel__viewport">
                            <li id="carousel__slide1"
                                tabindex="0"
                                class="carousel__slide">
                                <div class="carousel__snapper">
                                    <a href="#carousel__slide4"
                                        class="carousel__prev">Go to last slide</a>
                                    <a href="#carousel__slide2"
                                        class="carousel__next">Go to next slide</a>
                                </div>
                            </li>
                            <li id="carousel__slide2"
                                tabindex="0"
                                class="carousel__slide">
                                <div class="carousel__snapper"></div>
                                <a href="#carousel__slide1"
                                    class="carousel__prev">Go to previous slide</a>
                                <a href="#carousel__slide3"
                                    class="carousel__next">Go to next slide</a>
                            </li>
                            <li id="carousel__slide3"
                                tabindex="0"
                                class="carousel__slide">
                                <div class="carousel__snapper"></div>
                                <a href="#carousel__slide2"
                                    class="carousel__prev">Go to previous slide</a>
                                <a href="#carousel__slide4"
                                    class="carousel__next">Go to next slide</a>
                            </li>
                            <li id="carousel__slide4"
                                tabindex="0"
                                class="carousel__slide">
                                <div class="carousel__snapper"></div>
                                <a href="#carousel__slide3"
                                    class="carousel__prev">Go to previous slide</a>
                                <a href="#carousel__slide1"
                                    class="carousel__next">Go to first slide</a>
                            </li>
                        </ol>
                        <aside class="carousel__navigation">
                            <ol class="carousel__navigation-list">
                                <li class="carousel__navigation-item">
                                    <a href="#carousel__slide1"
                                        class="carousel__navigation-button">Go to slide 1</a>
                                </li>
                                <li class="carousel__navigation-item">
                                    <a href="#carousel__slide2"
                                        class="carousel__navigation-button">Go to slide 2</a>
                                </li>
                                <li class="carousel__navigation-item">
                                    <a href="#carousel__slide3"
                                        class="carousel__navigation-button">Go to slide 3</a>
                                </li>
                                <li class="carousel__navigation-item">
                                    <a href="#carousel__slide4"
                                        class="carousel__navigation-button">Go to slide 4</a>
                                </li>
                            </ol>
                        </aside>

                    </div>
                </div>
            </div>
        </section>

 -->
        
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
                                <!-- <a href="contact.php">Learn More</a> -->
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
                                <!-- <a href="contact.php">Learn More</a> -->
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
                                <!-- <a href="contact.php">Learn More</a> -->
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
                                <!-- <a href="contact.php">Learn More</a> -->
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
            <div id="contacts" class="contactus-container">
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
                            <h3>Business Hours</h3>
                            <p><strong>Monday - Friday:</strong> 9:00 AM - 6:00 PM</p>
                            <p><strong>Saturday:</strong> 9:00 AM - 2:00 PM</p>
                            <p><strong>Sunday:</strong> Closed</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <!-- Contact Message Form Section -->
        <section id="contact-form" class="contact-form-section">
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
                                <p style="margin:0;"><?php echo $success; ?></p>
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

                            <div class="contact-form-category">
                                <select name="role" id="">
                                    <option value="">- Select Category -</option>
                                    <option value="leasing">Leasing</option>
                                    <option value="divimaga">Divimaga</option>
                                    <option value="peramaga">Peramaga</option>
                                    <option value="sewana">Sewena</option>
                                </select>
                            </div>
                            <div class="g-recaptcha" data-sitekey="6LfAPM8rAAAAACYJ55z-ADquJVr9nRW8QvY5zGal"></div>
                            <button class="contact-form-button" type="submit">
                                Send Message
                            </button>
                        </form>
                    </div>
                    <div class="contact-form-map" id="googleMap">
                        <h1>Location</h1>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d699.663363369387!2d79.90947112474417!3d7.252941149484347!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2slk!4v1753366501545!5m2!1sen!2slk" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                    </div>

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
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>About Us</h4>
                    <ul>
                        <li><a href="#history">Our History</a></li>
                        <li><a href="#mission-vision">Mission & Vision</a></li>
                        <li><a href="#team">Team</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Support</h4>
                    <ul>
                        <li><a href="faq.php">FAQ</a></li>
                        <li><a href="policy.php">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Contact</h4>
                    <ul>
                        <li>123 Main Street, Katana, Sri Lanka</li>
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
    <script>
        function showForm(formId) {
            console.log("showForm function called with formId:", formId);
            document.querySelectorAll(".form-box").forEach(form => form.classList.remove("active"));
            document.getElementById(formId).classList.add("active");
        }
    </script>


    <script src="assets/js/main.js"></script>

</body>

</html>