<?php
require_once '../includes/db.php';
require_once '../includes/auth.php';
if (!is_logged_in() || !is_admin()) {
    header('Location: ../login.php');
    exit;
}
// Handle add service
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_service'])) {
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $icon = trim($_POST['icon'] ?? '');
    if (empty($name)) {
        $errors[] = 'Service name is required.';
    }
    if (empty($errors)) {
        $stmt = $conn->prepare('INSERT INTO services (name, description, icon) VALUES (?, ?, ?)');
        $stmt->bind_param('sss', $name, $description, $icon);
        $stmt->execute();
        $stmt->close();
        header('Location: services.php');
        exit;
    }
}
// Handle delete service
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $sid = (int)$_GET['delete'];
    $stmt = $conn->prepare('DELETE FROM services WHERE id = ?');
    $stmt->bind_param('i', $sid);
    $stmt->execute();
    $stmt->close();
    header('Location: services.php');
    exit;
}
// Fetch all services
$result = $conn->query('SELECT * FROM services ORDER BY id DESC');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Services - Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="admin-header">
            <h1>Manage Services</h1>
            <nav>
                <a href="index.php">Messages</a> |
                <a href="services.php">Services</a> |
                <a href="users.php">Users</a> |
                <a href="../index.php">View Site</a> |
                <a href="../logout.php" style="color:#d32f2f;">Logout</a>
            </nav>
        </div>
        <h2>All Services</h2>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Icon</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['description']) ?></td>
                    <td><?= htmlspecialchars($row['icon']) ?></td>
                    <td><a href="?delete=<?= $row['id'] ?>" class="delete-btn" onclick="return confirm('Delete this service?');">Delete</a></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <div class="add-form">
            <h2>Add New Service</h2>
            <?php if ($errors): ?>
                <div class="error">
                    <?php foreach ($errors as $error) echo '<p>' . htmlspecialchars($error) . '</p>'; ?>
                </div>
            <?php endif; ?>
            <form method="post" action="">
                <label>Name:<br><input type="text" name="name" required></label><br>
                <label>Description:<br><textarea name="description" rows="3"></textarea></label><br>
                <label>Icon Path:<br><input type="text" name="icon" placeholder="assets/img/service.png"></label><br>
                <button type="submit" name="add_service">Add Service</button>
            </form>
        </div>
    </div>
</body>
</html> 