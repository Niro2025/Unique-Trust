<?php
// includes/db.php - Database connection

$host = 'localhost';
$db   = 'financial_db'; // Change to your database name
$user = 'root';        // Change if not using default XAMPP user
$pass = '';            // Change if you have a password set

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
// Usage: include this file and use $conn for queries
?> 