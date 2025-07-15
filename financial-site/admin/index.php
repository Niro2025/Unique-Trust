<?php
// admin/index.php - Admin Dashboard for Unique Trust Investment

require_once '../includes/db.php';
require_once '../includes/auth.php';

if (!is_logged_in() || !is_admin()) {
    header('Location: ../login.php');
    exit;
}

// Handle message deletion
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $msg_id = (int)$_GET['delete'];
    $stmt = $conn->prepare('DELETE FROM messages WHERE id = ?');
    $stmt->bind_param('i', $msg_id);
    $stmt->execute();
    $stmt->close();
    header('Location: index.php');
    exit;
}

// Fetch messages
$result = $conn->query('SELECT m.id, m.name, m.email, m.message, m.created_at, u.username FROM messages m LEFT JOIN users u ON m.user_id = u.id ORDER BY m.created_at DESC');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Unique Trust Investment</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .admin-table { width: 100%; border-collapse: collapse; margin-top: 2rem; }
        .admin-table th, .admin-table td { border: 1px solid #ddd; padding: 0.5rem; text-align: left; }
        .admin-table th { background: #1976d2; color: #fff; }
        .admin-table tr:nth-child(even) { background: #f2f2f2; }
        .delete-btn { color: #d32f2f; text-decoration: none; font-weight: bold; }
        .delete-btn:hover { text-decoration: underline; }
        .admin-header { display: flex; justify-content: space-between; align-items: center; margin-top: 1rem; }
    </style>
</head>
<body>
    <div class="container">
        <div class="admin-header">
            <h1>Admin Dashboard</h1>
            <nav>
                <a href="index.php">Messages</a> |
                <a href="services.php">Services</a> |
                <a href="users.php">Users</a> |
                <a href="../index.php">View Site</a> |
                <a href="../logout.php" style="color:#d32f2f;">Logout</a>
            </nav>
        </div>
        <h2>Contact Messages</h2>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['username'] ?? '-') ?></td>
                    <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>
                    <td><?= $row['created_at'] ?></td>
                    <td><a href="?delete=<?= $row['id'] ?>" class="delete-btn" onclick="return confirm('Delete this message?');">Delete</a></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html> 