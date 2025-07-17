<<<<<<< HEAD
<?php
require_once 'includes/db.php';
require_once 'includes/session.php';

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    if (empty($name) || empty($email) || empty($message)) {
        $errors[] = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
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
</head>
<body>
    <header>
        <div class="container nav-container">
            <div class="logo">
                <img src="assets/img/logo.png" alt="Unique Trust Investment Logo" class="logo-img" style="height:150px;">
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
        <section class="about-section" >
            <div class="container">
                <div class="about-header">
                    <h2>About Unique Trust Investment</h2>
                    <p>Building financial futures with trust and expertise</p>
                </div>
                
                <div class="about-main" >
                    <div class="about-main-text" >
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
                    <div class="about-stats-awards" >
                        <h3>50+</h3>
                        <p>Awards Won</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Enhanced Stats & Company Info Section -->

        <section class="stats-company-section" >
            <div class="container">

                <!-- Company History -->
                <div class="stats-company-info" >
                    <h2>Our Journey</h2>
                    <p>Unique Trust Investment has been serving clients with reliable financial solutions for over a decade, specializing in loans, leasing, and innovative products like Divimaga and Peramaga.</p>
                </div>

                <!-- Mission, Vision, Values -->
                <div class="stats-company-missionvisionvalues" >
                    <div class="stats-company-mission-item">
                        <div class="stats-company-mission-item-icon">
                            <div class="stats-company-mission-item-icon-circle" >
                                <span>🎯</span>
                            </div>
                        </div>
                        <h3>Mission</h3>
                        <p>To provide fast, secure, and accessible financial services to individuals and businesses.</p>
                    </div>
                    
                    <div class="stats-company-vision-item">
                        <div class="stats-company-vision-item-icon">
                            <div class="stats-company-vision-item-icon-circle">
                                <span >👁️</span>
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
                        <h3 >Values</h3>
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
                            <h3 >Jane Doe</h3>
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
        <section class="services-hero" style="background:linear-gradient(135deg, #e8f5e8 0%, #f3e5f5 100%);padding:4rem 0;position:relative;overflow:hidden;">
            <div class="services-hero-main" style="position:absolute;top:0;left:0;right:0;bottom:0;background:url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 100 100\"><defs><pattern id=\"grain\" width=\"100\" height=\"100\" patternUnits=\"userSpaceOnUse\"><circle cx=\"25\" cy=\"25\" r=\"1\" fill=\"%23ffffff\" opacity=\"0.1\"/><circle cx=\"75\" cy=\"75\" r=\"1\" fill=\"%23ffffff\" opacity=\"0.1\"/><circle cx=\"50\" cy=\"10\" r=\"0.5\" fill=\"%23ffffff\" opacity=\"0.1\"/></pattern></defs><rect width=\"100\" height=\"100\" fill=\"url(%23grain)\"/></svg></div>
            <div class="container" style="position:relative;z-index:2;">
                <div style="text-align:center;max-width:800px;margin:0 auto;">
                    <h1 style="font-size:3rem;color:#1a237e;margin-bottom:1.5rem;font-weight:700;text-shadow:0 2px 4px rgba(0,0,0,0.1);">Our Financial Services</h1>
                    <p style="font-size:1.3rem;color:#555;margin-bottom:2rem;line-height:1.6;">Discover our comprehensive range of trusted financial solutions designed to meet your unique needs and help you achieve your financial goals.</p>
                    <div style="display:flex;flex-wrap:wrap;gap:1rem;justify-content:center;margin-top:2rem;">
                        <div style="background:rgba(255,255,255,0.9);padding:0.5rem 1rem;border-radius:20px;box-shadow:0 2px 10px rgba(0,0,0,0.1);">
                            <span style="color:#1976d2;font-weight:bold;">✓ Fast Approval</span>
                        </div>
                        <div style="background:rgba(255,255,255,0.9);padding:0.5rem 1rem;border-radius:20px;box-shadow:0 2px 10px rgba(0,0,0,0.1);">
                            <span style="color:#388e3c;font-weight:bold;">✓ Secure & Reliable</span>
                        </div>
                        <div style="background:rgba(255,255,255,0.9);padding:0.5rem 1rem;border-radius:20px;box-shadow:0 2px 10px rgba(0,0,0,0.1);">
                            <span style="color:#f57c00;font-weight:bold;">✓ Expert Support</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Enhanced Services List Section -->
        <section class="services-list" style="padding:4rem 0;background:#fff;">
            <div class="container">
                <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(280px, 1fr));gap:2rem;margin-top:2rem;">
                    <div class="service-card" style="background:#fff;border-radius:20px;box-shadow:0 8px 32px rgba(0,0,0,0.1);overflow:hidden;transition:transform 0.3s ease, box-shadow 0.3s ease;position:relative;">
                        <div style="background:linear-gradient(135deg, #1976d2, #64b5f6);padding:1rem;text-align:center;">
                            <img src="assets/img/leasing.png" alt="Leasing" style="width:80px;height:80px;object-fit:cover;border-radius:15px;background:#fff;padding:0.5rem;">
                        </div>
                        <div style="padding:2rem;">
                            <h3 style="color:#1a237e;font-size:1.5rem;margin-bottom:1rem;text-align:center;">Leasing</h3>
                            <p style="color:#555;line-height:1.6;margin-bottom:1.5rem;text-align:center;">Flexible leasing options for vehicles and equipment to help you grow your business with minimal upfront costs.</p>
                            <ul style="color:#666;line-height:1.6;margin-bottom:1.5rem;padding-left:1.5rem;">
                                <li>Equipment financing</li>
                                <li>Flexible payment terms</li>
                                <li>Quick approval process</li>
                                <li>Asset management support</li>
                            </ul>
                            <div style="text-align:center;">
                                <a href="contact.php" style="background:linear-gradient(135deg, #1976d2, #64b5f6);color:#fff;padding:0.75rem 1.5rem;border-radius:25px;text-decoration:none;font-weight:bold;display:inline-block;transition:all 0.3s ease;">Learn More</a>
                            </div>
                        </div>
                    </div>

                    <div class="service-card" style="background:#fff;border-radius:20px;box-shadow:0 8px 32px rgba(0,0,0,0.1);overflow:hidden;transition:transform 0.3s ease, box-shadow 0.3s ease;position:relative;">
                        <div style="background:linear-gradient(135deg, #388e3c, #66bb6a);padding:1rem;text-align:center;">
                            <img src="assets/img/divimaga.png" alt="Divimaga" style="width:80px;height:80px;object-fit:cover;border-radius:15px;background:#fff;padding:0.5rem;">
                        </div>
                        <div style="padding:2rem;">
                            <h3 style="color:#1a237e;font-size:1.5rem;margin-bottom:1rem;text-align:center;">Divimaga</h3>
                            <p style="color:#555;line-height:1.6;margin-bottom:1.5rem;text-align:center;">Innovative Divimaga loans designed for your unique needs with fast approvals and competitive rates.</p>
                            <ul style="color:#666;line-height:1.6;margin-bottom:1.5rem;padding-left:1.5rem;">
                                <li>High-yield investment opportunities</li>
                                <li>Professional portfolio management</li>
                                <li>Risk-adjusted returns</li>
                                <li>Regular performance reports</li>
                            </ul>
                            <div style="text-align:center;">
                                <a href="contact.php" style="background:linear-gradient(135deg, #388e3c, #66bb6a);color:#fff;padding:0.75rem 1.5rem;border-radius:25px;text-decoration:none;font-weight:bold;display:inline-block;transition:all 0.3s ease;">Learn More</a>
                            </div>
                        </div>
                    </div>

                    <div class="service-card" style="background:#fff;border-radius:20px;box-shadow:0 8px 32px rgba(0,0,0,0.1);overflow:hidden;transition:transform 0.3s ease, box-shadow 0.3s ease;position:relative;">
                        <div style="background:linear-gradient(135deg, #f57c00, #ffb74d);padding:1rem;text-align:center;">
                            <img src="assets/img/peramaga.png" alt="Peramaga" style="width:80px;height:80px;object-fit:cover;border-radius:15px;background:#fff;padding:0.5rem;">
                        </div>
                        <div style="padding:2rem;">
                            <h3 style="color:#1a237e;font-size:1.5rem;margin-bottom:1rem;text-align:center;">Peramaga</h3>
                            <p style="color:#555;line-height:1.6;margin-bottom:1.5rem;text-align:center;">Peramaga financial solutions for personal and business growth with flexible terms and competitive rates.</p>
                            <ul style="color:#666;line-height:1.6;margin-bottom:1.5rem;padding-left:1.5rem;">
                                <li>Flexible investment terms</li>
                                <li>Competitive interest rates</li>
                                <li>Goal-based planning</li>
                                <li>Easy withdrawal options</li>
                            </ul>
                            <div style="text-align:center;">
                                <a href="contact.php" style="background:linear-gradient(135deg, #f57c00, #ffb74d);color:#fff;padding:0.75rem 1.5rem;border-radius:25px;text-decoration:none;font-weight:bold;display:inline-block;transition:all 0.3s ease;">Learn More</a>
                            </div>
                        </div>
                    </div>

                    <div class="service-card" style="background:#fff;border-radius:20px;box-shadow:0 8px 32px rgba(0,0,0,0.1);overflow:hidden;transition:transform 0.3s ease, box-shadow 0.3s ease;position:relative;">
                        <div style="background:linear-gradient(135deg, #7b1fa2, #ba68c8);padding:1rem;text-align:center;">
                            <img src="assets/img/sewana.png" alt="Sewana" style="width:80px;height:80px;object-fit:cover;border-radius:15px;background:#fff;padding:0.5rem;">
                        </div>
                        <div style="padding:2rem;">
                            <h3 style="color:#1a237e;font-size:1.5rem;margin-bottom:1rem;text-align:center;">Sewana</h3>
                            <p style="color:#555;line-height:1.6;margin-bottom:1.5rem;text-align:center;">Quick and easy Sewana loans to meet urgent financial requirements with instant approval process.</p>
                            <ul style="color:#666;line-height:1.6;margin-bottom:1.5rem;padding-left:1.5rem;">
                                <li>Instant approval process</li>
                                <li>Minimal documentation</li>
                                <li>Quick disbursement</li>
                                <li>24/7 customer support</li>
                            </ul>
                            <div style="text-align:center;">
                                <a href="contact.php" style="background:linear-gradient(135deg, #7b1fa2, #ba68c8);color:#fff;padding:0.75rem 1.5rem;border-radius:25px;text-decoration:none;font-weight:bold;display:inline-block;transition:all 0.3s ease;">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Enhanced Testimonials Section -->
        <section class="testimonials-section" style="background:linear-gradient(135deg, #1a237e 0%, #3949ab 100%);padding:4rem 0;margin-top:2rem;">
            <div class="container">
                <div style="text-align:center;margin-bottom:3rem;">
                    <h2 style="color:#fff;font-size:2.5rem;margin-bottom:1rem;">What Our Clients Say</h2>
                    <p style="color:#e3f2fd;font-size:1.1rem;max-width:600px;margin:0 auto;">Real stories from satisfied customers who trust us with their financial future</p>
                </div>
                
                <div style="display:flex;flex-wrap:wrap;gap:2rem;justify-content:center;">
                    <div class="testimonial" style="background:#fff;padding:2rem;border-radius:20px;box-shadow:0 8px 32px rgba(0,0,0,0.1);flex:1;min-width:280px;max-width:350px;position:relative;transition:transform 0.3s ease;">
                        <div style="position:absolute;top:-15px;left:20px;background:linear-gradient(135deg, #1976d2, #64b5f6);color:#fff;padding:0.5rem 1rem;border-radius:20px;font-size:0.9rem;font-weight:bold;">
                            ⭐⭐⭐⭐⭐
                        </div>
                        <p style="font-style:italic;margin:1rem 0 1.5rem 0;color:#555;line-height:1.6;font-size:1rem;">"Unique Trust Investment helped me achieve my financial goals with their Divimaga product. The returns exceeded my expectations and the customer service was exceptional!"</p>
                        <div style="display:flex;align-items:center;gap:1rem;border-top:1px solid #f0f0f0;padding-top:1rem;">
                            <img src="assets/img/client1.png" alt="Sarah Johnson" style="width:60px;height:60px;border-radius:50%;object-fit:cover;border:3px solid #1976d2;">
                            <div>
                                <strong style="color:#1a237e;font-size:1.1rem;">Sarah Johnson</strong><br>
                                <small style="color:#1976d2;font-weight:bold;">Business Owner</small><br>
                                <small style="color:#666;">Divimaga Client</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="testimonial" style="background:#fff;padding:2rem;border-radius:20px;box-shadow:0 8px 32px rgba(0,0,0,0.1);flex:1;min-width:280px;max-width:350px;position:relative;transition:transform 0.3s ease;">
                        <div style="position:absolute;top:-15px;left:20px;background:linear-gradient(135deg, #388e3c, #66bb6a);color:#fff;padding:0.5rem 1rem;border-radius:20px;font-size:0.9rem;font-weight:bold;">
                            ⭐⭐⭐⭐⭐
                        </div>
                        <p style="font-style:italic;margin:1rem 0 1.5rem 0;color:#555;line-height:1.6;font-size:1rem;">"The Peramaga savings plan is perfect for my needs. Flexible terms and great customer service make all the difference. Highly recommended!"</p>
                        <div style="display:flex;align-items:center;gap:1rem;border-top:1px solid #f0f0f0;padding-top:1rem;">
                            <img src="assets/img/client2.png" alt="Michael Chen" style="width:60px;height:60px;border-radius:50%;object-fit:cover;border:3px solid #388e3c;">
                            <div>
                                <strong style="color:#1a237e;font-size:1.1rem;">Michael Chen</strong><br>
                                <small style="color:#388e3c;font-weight:bold;">Software Engineer</small><br>
                                <small style="color:#666;">Peramaga Client</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="testimonial" style="background:#fff;padding:2rem;border-radius:20px;box-shadow:0 8px 32px rgba(0,0,0,0.1);flex:1;min-width:280px;max-width:350px;position:relative;transition:transform 0.3s ease;">
                        <div style="position:absolute;top:-15px;left:20px;background:linear-gradient(135deg, #f57c00, #ffb74d);color:#fff;padding:0.5rem 1rem;border-radius:20px;font-size:0.9rem;font-weight:bold;">
                            ⭐⭐⭐⭐⭐
                        </div>
                        <p style="font-style:italic;margin:1rem 0 1.5rem 0;color:#555;line-height:1.6;font-size:1rem;">"Their leasing solutions helped our company expand without the heavy upfront costs. The process was smooth and the team was incredibly professional!"</p>
                        <div style="display:flex;align-items:center;gap:1rem;border-top:1px solid #f0f0f0;padding-top:1rem;">
                            <img src="assets/img/client3.png" alt="Emily Rodriguez" style="width:60px;height:60px;border-radius:50%;object-fit:cover;border:3px solid #f57c00;">
                            <div>
                                <strong style="color:#1a237e;font-size:1.1rem;">Emily Rodriguez</strong><br>
                                <small style="color:#f57c00;font-weight:bold;">Operations Manager</small><br>
                                <small style="color:#666;">Leasing Client</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div style="text-align:center;margin-top:3rem;">
                    <p style="color:#e3f2fd;font-size:1.1rem;margin-bottom:1rem;">Join thousands of satisfied customers</p>
                    <a href="contact.php" style="background:#fff;color:#1a237e;padding:0.75rem 2rem;border-radius:30px;text-decoration:none;font-weight:bold;transition:all 0.3s ease;display:inline-block;">Start Your Journey Today</a>
                </div>
            </div>
        </section>
        <!-- Enhanced Contact Hero Section -->
        <section class="contact-hero" style="background:linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);padding:4rem 0;position:relative;overflow:hidden;">
            <div style="position:absolute;top:0;left:0;right:0;bottom:0;background:url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 100 100\"><defs><pattern id=\"contact-pattern\" width=\"50\" height=\"50\" patternUnits=\"userSpaceOnUse\"><circle cx=\"25\" cy=\"25\" r=\"2\" fill=\"%23ffffff\" opacity=\"0.3\"/><circle cx=\"10\" cy=\"10\" r=\"1\" fill=\"%23ffffff\" opacity=\"0.2\"/><circle cx=\"40\" cy=\"40\" r=\"1\" fill=\"%23ffffff\" opacity=\"0.2\"/></pattern></defs><rect width=\"100\" height=\"100\" fill=\"url(%23contact-pattern)\"/></svg></div>
            <div class="container" style="position:relative;z-index:2;">
                <div style="text-align:center;max-width:800px;margin:0 auto;">
                    <div style="background:rgba(255,255,255,0.9);padding:3rem;border-radius:25px;box-shadow:0 10px 40px rgba(0,0,0,0.1);backdrop-filter:blur(10px);">
                        <div style="width:80px;height:80px;background:linear-gradient(135deg, #1976d2, #64b5f6);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 2rem auto;">
                        <i class="fa-regular fa-comments fa-2x" style="color:#FFFFFF;"></i>
                        </div>
                        <h1 style="font-size:3rem;color:#1a237e;margin-bottom:1.5rem;font-weight:700;">Get In Touch</h1>
                        <p style="font-size:1.3rem;color:#555;margin-bottom:2rem;line-height:1.6;">Ready to start your financial journey with us? Contact our expert team for personalized financial solutions and expert guidance.</p>
                        <div style="display:flex;flex-wrap:wrap;gap:1.5rem;justify-content:center;margin-top:2rem;">
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
                    </div>
                </div>
            </div>
        </section>
        <!-- Enhanced Contact Form Section -->
        <section class="contact-form-section" style="padding:4rem 0;background:#f8f9fa;">
            <div class="container">
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:3rem;align-items:start;">
                    <!-- Contact Form -->
                    <div style="background:#fff;padding:3rem;border-radius:20px;box-shadow:0 8px 32px rgba(0,0,0,0.1);">
                        <h2 style="color:#1a237e;font-size:2rem;margin-bottom:2rem;text-align:center;">Send Us a Message</h2>
                        
                        <?php if ($errors): ?>
                            <div style="background:#ffebee;color:#c62828;padding:1rem;border-radius:10px;margin-bottom:2rem;border-left:4px solid #c62828;">
                                <?php foreach ($errors as $error) echo '<p style="margin:0.5rem 0;">' . htmlspecialchars($error) . '</p>'; ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($success): ?>
                            <div style="background:#e8f5e8;color:#2e7d32;padding:1rem;border-radius:10px;margin-bottom:2rem;border-left:4px solid #2e7d32;">
                                <p style="margin:0;"><?= $success ?></p>
                            </div>
                        <?php endif; ?>
                        
                        <form method="post" action="" style="display:flex;flex-direction:column;gap:1.5rem;">
                            <div>
                                <label style="display:block;color:#1a237e;font-weight:bold;margin-bottom:0.5rem;">Full Name *</label>
                                <input type="text" name="name" required value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" 
                                       style="width:100%;padding:1rem;border:2px solid #e0e0e0;border-radius:10px;font-size:1rem;transition:border-color 0.3s ease;box-sizing:border-box;"
                                       placeholder="Enter your full name">
                            </div>
                            
                            <div>
                                <label style="display:block;color:#1a237e;font-weight:bold;margin-bottom:0.5rem;">Email Address *</label>
                                <input type="email" name="email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" 
                                       style="width:100%;padding:1rem;border:2px solid #e0e0e0;border-radius:10px;font-size:1rem;transition:border-color 0.3s ease;box-sizing:border-box;"
                                       placeholder="Enter your email address">
                            </div>
                            
                            <div>
                                <label style="display:block;color:#1a237e;font-weight:bold;margin-bottom:0.5rem;">Message *</label>
                                <textarea name="message" rows="6" required 
                                          style="width:100%;padding:1rem;border:2px solid #e0e0e0;border-radius:10px;font-size:1rem;transition:border-color 0.3s ease;box-sizing:border-box;resize:vertical;font-family:inherit;"
                                          placeholder="Tell us about your financial needs or any questions you have"><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
                            </div>
                            
                            <button type="submit" style="background:linear-gradient(135deg, #1976d2, #64b5f6);color:#fff;padding:1rem 2rem;border:none;border-radius:25px;font-size:1.1rem;font-weight:bold;cursor:pointer;transition:all 0.3s ease;margin-top:1rem;">
                                Send Message
                            </button>
                        </form>
                    </div>

                    <!-- Contact Information -->
                    <div style="background:#fff;padding:3rem;border-radius:20px;box-shadow:0 8px 32px rgba(0,0,0,0.1);">
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
    <script src="assets/js/main.js"></script>
</body>
</html>
=======
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

                    <div class="service-card" >
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
                                <a href="contact.php" >Learn More</a>
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
                        <p style="">"Their leasing solutions helped our company expand without the heavy upfront costs. The process was smooth and the team was incredibly professional!"</p>
                        <div class="testimonials-text">
                            <img src="assets/img/client3.png" alt="Emily Rodriguez">
                            <div>
                                <strong>Emily Rodriguez</strong><br>
                                <small class="small-owner" >Operations Manager</small><br>
                                <small class="small-client" >Leasing Client</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="text-align:center;margin-top:3rem;">
                    <p style="color:#e3f2fd;font-size:1.1rem;margin-bottom:1rem;">Join thousands of satisfied customers</p>
                    <a href="contact.php" style="background:#fff;color:#1a237e;padding:0.75rem 2rem;border-radius:30px;text-decoration:none;font-weight:bold;transition:all 0.3s ease;display:inline-block;">Start Your Journey Today</a>
                </div>
            </div>
        </section>
        <!-- Enhanced Contact Hero Section -->
        <section class="contact-hero" style="background:linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);padding:4rem 0;position:relative;overflow:hidden;">
            <div style="position:absolute;top:0;left:0;right:0;bottom:0;" >
            </div>
            <div class="container" style="position:relative;z-index:2;">
                <div style="text-align:center;max-width:800px;margin:0 auto;">
                    <div style="background:rgba(255,255,255,0.9);padding:3rem;border-radius:25px;box-shadow:0 10px 40px rgba(0,0,0,0.1);backdrop-filter:blur(10px);">
                        <div style="width:80px;height:80px;background:linear-gradient(135deg, #1976d2, #64b5f6);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 2rem auto;">
                            <i class="fa-regular fa-comments fa-2x" style="color:#FFFFFF;"></i>
                        </div>
                        <h1 style="font-size:3rem;color:#1a237e;margin-bottom:1.5rem;font-weight:700;">Get In Touch</h1>
                        <p style="font-size:1.3rem;color:#555;margin-bottom:2rem;line-height:1.6;">Ready to start your financial journey with us? Contact our expert team for personalized financial solutions and expert guidance.</p>
                        <div style="display:flex;flex-wrap:wrap;gap:1.5rem;justify-content:center;margin-top:2rem;">
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
                    </div>
                </div>
            </div>
        </section>
        <!-- Enhanced Contact Form Section -->
        <section class="contact-form-section" style="padding:4rem 0;background:#f8f9fa;">
            <div class="container">
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:3rem;align-items:start;">
                    <!-- Contact Form -->
                    <div style="background:#fff;padding:3rem;border-radius:20px;box-shadow:0 8px 32px rgba(0,0,0,0.1);">
                        <h2 style="color:#1a237e;font-size:2rem;margin-bottom:2rem;text-align:center;">Send Us a Message</h2>

                        <?php if ($errors): ?>
                            <div style="background:#ffebee;color:#c62828;padding:1rem;border-radius:10px;margin-bottom:2rem;border-left:4px solid #c62828;">
                                <?php foreach ($errors as $error) {
                                    echo '<p style="margin:0.5rem 0;">' . htmlspecialchars($error) . '</p>';
                                }
                                ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($success): ?>
                            <div style="background:#e8f5e8;color:#2e7d32;padding:1rem;border-radius:10px;margin-bottom:2rem;border-left:4px solid #2e7d32;">
                                <p style="margin:0;"><?php echo $success ?></p>
                            </div>
                        <?php endif; ?>

                        <form method="post" action="" style="display:flex;flex-direction:column;gap:1.5rem;">
                            <div>
                                <label style="display:block;color:#1a237e;font-weight:bold;margin-bottom:0.5rem;">Full Name *</label>
                                <input type="text" name="name" required value="<?php echo htmlspecialchars($_POST['name'] ?? '') ?>"
                                    style="width:100%;padding:1rem;border:2px solid #e0e0e0;border-radius:10px;font-size:1rem;transition:border-color 0.3s ease;box-sizing:border-box;"
                                    placeholder="Enter your full name">
                            </div>

                            <div>
                                <label style="display:block;color:#1a237e;font-weight:bold;margin-bottom:0.5rem;">Email Address *</label>
                                <input type="email" name="email" required value="<?php echo htmlspecialchars($_POST['email'] ?? '') ?>"
                                    style="width:100%;padding:1rem;border:2px solid #e0e0e0;border-radius:10px;font-size:1rem;transition:border-color 0.3s ease;box-sizing:border-box;"
                                    placeholder="Enter your email address">
                            </div>

                            <div>
                                <label style="display:block;color:#1a237e;font-weight:bold;margin-bottom:0.5rem;">Message *</label>
                                <textarea name="message" rows="6" required
                                    style="width:100%;padding:1rem;border:2px solid #e0e0e0;border-radius:10px;font-size:1rem;transition:border-color 0.3s ease;box-sizing:border-box;resize:vertical;font-family:inherit;"
                                    placeholder="Tell us about your financial needs or any questions you have"><?php echo htmlspecialchars($_POST['message'] ?? '') ?></textarea>
                            </div>

                            <button type="submit" style="background:linear-gradient(135deg, #1976d2, #64b5f6);color:#fff;padding:1rem 2rem;border:none;border-radius:25px;font-size:1.1rem;font-weight:bold;cursor:pointer;transition:all 0.3s ease;margin-top:1rem;">
                                Send Message
                            </button>
                        </form>
                    </div>

                    <!-- Contact Information -->
                    <div style="background:#fff;padding:3rem;border-radius:20px;box-shadow:0 8px 32px rgba(0,0,0,0.1);">
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
                </div>
            </div>
        </section>
        <!-- Call to Action Section -->
    </main>
    <footer>
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Unique Trust Investment. All rights reserved.</p>
        </div>
    </footer>
    <script src="assets/js/main.js"></script>
</body>

</html>
>>>>>>> c59544b310e14e6ccf79e98b602f5c0e1286c5de
