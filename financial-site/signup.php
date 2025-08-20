<?php
// signup.php - Signup page for Unique Trust Investment

require_once 'includes/db.php';

$success = false;
$errors = false;


// if ($query = $db->prepare('SELECT id FROM signup ORDER BY id DESC LIMIT 1')) {
//     $query->execute();
//    $row=$query->store_result();
//    echo $row;
//    $query->bind_result($id);
//    $query->fetch();
//    echo gettype($id);
// }



if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
   
// Registation Form Validation

if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {
    
    exit('Please complete the registation form!');
}

if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
    
    exit('Please complete the registation form!');
}

// Registation feilds Validation

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    exit('Email is not valid');
}

if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['username']) == 0) {
    exit('Username is not valid');
}

if (strlen($_POST['password']) < 4) {
    exit('Password must be long 5 Characters');
}

if($query = $db-> prepare('SELECT username FROM signup WHERE username = ?')){
    
    $query-> bind_param('s', $_POST['username']);
    $query-> execute();
    $query->store_result();

    if ($query-> num_rows>0) {
        echo "Username already exists!";
    } else{

        $password= $_POST['password'];
        $username=$_POST['username'];
        $email=$_POST['email'];
        $user_level= $_POST['user_level'];


if ($query=$db->prepare('INSERT INTO signup (username, email, password, user_level) VALUES (?, ?, ?, ?)')) {
   $query->bind_param('ssss', $username, $email, $password, $user_level);
   $query->execute();

   echo "Sucessfully data";
} else {
    echo "Prepare statement error";
}

    }
    $query->close();
} else {

    echo "Error in entering data"; // Prob with entering feild datas
}

}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Unique Trust Investment</title>
    <link rel="stylesheet" href="assets/css/signup.css">
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

    <div class="form">
    <form method="post" action="">
        
        <label>Username:</label><input type="text" name="username" required><br>
        <label>Email:</label><input type="email" name="email" required><br>
        <label>Password:<input type="password" name="password" required></label><br>
        <label>Confirm Password:<input type="password" name="confirm_password" required></label><br>
        <label>User Level:<input type="text" name="user_level" required></label><br>

        <button type="submit" name="submit">Sign Up</button>
    </form>

    </div>
    <p>Already have an account? <a href="login.php">Login here</a>.</p>
</body>

</html>