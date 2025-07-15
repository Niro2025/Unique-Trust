<?php
// includes/auth.php - Authentication helpers
require_once 'session.php';

function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function is_admin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function get_current_user() {
    return [
        'id' => $_SESSION['user_id'] ?? null,
        'username' => $_SESSION['username'] ?? null,
        'role' => $_SESSION['role'] ?? null
    ];
}

function logout() {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit;
}
?> 