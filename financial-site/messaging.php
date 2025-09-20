<?php

require_once 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $role = trim($_POST['role']);
    $message = trim($_POST['message']);
    $date = date('Y-m-d H:i:s');

    if ($query = $db->prepare('INSERT INTO messages (customer_name, email,  message, date, category) VALUES (?, ?, ?, ?, ?)')) {
        $query->bind_param('sssss', $name, $email, $message, $date, $role);

        echo $name . $email . $role . $message . $date;


        if ($query->execute()) {
            echo "Message sent successfully.";
        } else {
            echo "Error: Could not execute the query.";
        }

        $query->close();
    } else {
        echo "Error: Could not prepare the query.";
    }

    mysqli_close($db);
}



?>