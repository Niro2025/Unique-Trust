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
    <title>Contact Us - Unique Trust Investment</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header>
        <div class="container nav-container">
            <div class="logo">
                <img src="assets/img/logo.png" alt="Unique Trust Investment Logo" style="height:40px;">
                <span class="company-name">Unique Trust Investment</span>
            </div>
            <nav>
                <ul class="nav-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="services.php">Services</a></li>
                    <li><a href="contact.php" class="active">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <section class="contact-hero">
            <div class="container">
                <h1>Contact Us</h1>
                <p>We're here to help. Reach out to us for any inquiries or feedback.</p>
            </div>
        </section>
        <section class="contact-form-section container">
            <?php if ($errors): ?>
                <div class="error">
                    <?php foreach ($errors as $error) echo '<p>' . htmlspecialchars($error) . '</p>'; ?>
                </div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="success">
                    <p><?= $success ?></p>
                </div>
            <?php endif; ?>
            <form class="contact-form" method="post" action="">
                <label>Name:<br><input type="text" name="name" required value="<?= htmlspecialchars($_POST['name'] ?? '') ?>"></label><br>
                <label>Email:<br><input type="email" name="email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"></label><br>
                <label>Message:<br><textarea name="message" rows="5" required><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea></label><br>
                <button type="submit">Send Message</button>
            </form>
            <div class="contact-info">
                <h2>Contact Information</h2>
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
            <!-- Optional: Google Map Embed -->
            <!-- <div class="map">
                <iframe src="https://www.google.com/maps/embed?..." width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div> -->
        </section>
    </main>
    <footer>
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Unique Trust Investment. All rights reserved.</p>
        </div>
    </footer>
    <script src="assets/js/main.js"></script>
</body>
</html> 