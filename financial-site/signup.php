<?php
// signup.php - Signup page for Unique Trust Investment

require_once 'includes/db.php';
require_once 'includes/session.php';

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Validate input
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $errors[] = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email address.';
    } elseif ($password !== $confirm_password) {
        $errors[] = 'Passwords do not match.';
    }

    // Check if username or email exists
    if (empty($errors)) {
        $stmt = $conn->prepare('SELECT id FROM users WHERE username = ? OR email = ?');
        $stmt->bind_param('ss', $username, $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $errors[] = 'Username or email already exists.';
        }
        $stmt->close();
    }

    // Register user
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)');
        $stmt->bind_param('sss', $username, $email, $hashed_password);
        if ($stmt->execute()) {
            $success = 'Registration successful! You can now <a href="login.php">login</a>.';
        } else {
            $errors[] = 'Registration failed. Please try again.';
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
    <title>Sign Up - Unique Trust Investment</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h2>Sign Up</h2>
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
    <form method="post" action="">
        <label>Username:<br><input type="text" name="username" required></label><br>
        <label>Email:<br><input type="email" name="email" required></label><br>
        <label>Password:<br><input type="password" name="password" required></label><br>
        <label>Confirm Password:<br><input type="password" name="confirm_password" required></label><br>
        <button type="submit">Sign Up</button>
    </form>
    <p>Already have an account? <a href="login.php">Login here</a>.</p>
</body>
</html> 