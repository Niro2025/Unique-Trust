<?php
require_once '../includes/db.php';
require_once '../includes/auth.php';
if (!is_logged_in() || !is_admin()) {
    header('Location: ../login.php');
    exit;
}
// Fetch all users
$result = $conn->query('SELECT id, username, email, role, created_at FROM users ORDER BY created_at DESC');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users - Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .admin-table { width: 100%; border-collapse: collapse; margin-top: 2rem; }
        .admin-table th, .admin-table td { border: 1px solid #ddd; padding: 0.5rem; text-align: left; }
        .admin-table th { background: #1976d2; color: #fff; }
        .admin-table tr:nth-child(even) { background: #f2f2f2; }
        .admin-header { display: flex; justify-content: space-between; align-items: center; margin-top: 1rem; }
    </style>
</head>
<body>
    <div class="container">
        <div class="admin-header">
            <h1>View Users</h1>
            <nav>
                <a href="index.php">Messages</a> |
                <a href="services.php">Services</a> |
                <a href="users.php">Users</a> |
                <a href="../index.php">View Site</a> |
                <a href="../logout.php" style="color:#d32f2f;">Logout</a>
            </nav>
        </div>
        <h2>All Users</h2>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Registered</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['username']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['role']) ?></td>
                    <td><?= $row['created_at'] ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html> 