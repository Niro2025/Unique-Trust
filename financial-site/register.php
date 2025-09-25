<?php

require_once 'includes/db.php';



if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['register'])) {

  // Registation Form Validation

  if (! isset($_POST['username'], $_POST['password'], $_POST['email'])) {

    $register_error = 'Please complete the registation form!';
  }

  else if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {

    $register_error = 'Please complete the registation form!';
  }

  // Registation feilds Validation

 else if (! filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $register_error = 'Email is not valid';
  }

 else if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['username']) == 0) {
    $register_error = 'Username is not valid';
  }

  else if (strlen($_POST['password']) < 4) {
    $register_error = 'Password must be long, at least 4 Characters';
  }
  else if (empty($_POST['role'])) {
    $register_error = 'Role must be selected';
  }
else{
  // Check username exists

  if ($query = $db->prepare('SELECT username FROM signup WHERE username = ?')) {

    $query->bind_param('s', $_POST['username']);
    $query->execute();
    $query->store_result();

    if ($query->num_rows > 0) {
      $register_error = 'Username exists, please choose another!';
    } else {

      $password   = $_POST['password'];
      $username   = $_POST['username'];
      $email      = $_POST['email'];
      $role       = $_POST['role'];

    
      if ($query = $db->prepare('INSERT INTO signup (username, email, password, user_level) VALUES (?, ?, ?, ?)')) {
        $query->bind_param('ssss', $username, $email, $password, $role);
        $query->execute();

        $success_message = "Registration Successful";
        // header("Location: login.php");
      } else {
        $register_error = "Error in entering data";
      }
    }
    $query->close();
  } else {

    $register_error = "Error in entering data"; // Prob with entering feild datas
  }
}
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="assets/css/login.css">

</head>

<body>
  <div class="container">
    <div class="form-box active" id="register-form">
      <form action="register.php" method="post">
        <a class="a-home" href="index.php">Home</a>
        <h2>Register</h2>
        <?php if (!empty($register_error)): ?>
          <div class="error-message" style="color: red; margin-bottom: 10px; font-size: 1.1em;">
            <span>Registation Fails!</span></br>
            <?php echo $register_error; ?>
          </div>
        <?php endif; ?>
        <?php if (!empty($success_message)): ?>
          <div class="success-message" style="color: green; margin-bottom: 10px; font-size: 1em;">
            <?php echo $success_message; ?>
          </div>
        <?php endif; ?>
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <select name="role" id="">
          <option value="">- Select Role -</option>
          <option value="employee">Employee</option>
          <option value="executive">Executive</option>
          <option value="admin">Admin</option>
        </select>
        <button type="submit" name="register">Register</button>
        <p>Already have an account <a href="login.php">Login</a></p>
      </form>
    </div>
  </div>
</body>

</html>