<?php
require_once 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['login'])) {

  $username = trim($_POST['username']);
  $password = trim($_POST['password']);


  if ($query = $db->prepare('SELECT id, password FROM signup WHERE username = ? ')) {
    $query->bind_param('s', $username);
    $query->execute();
    $query->store_result();


    if ($query->num_rows > 0) {
      $query->bind_result($id, $password_db);
      $query->fetch();

      echo $id; 
      echo $password_db;
      echo $password;

      if ($password === $password_db) {
        header("Location: dashboard.php");
        exit();
      } else {
        $login_error = 'Incorrect username or password!';
      }
    } else {
      $login_error = 'Incorrect username or password!';
    }
  }
  $query->close();


  mysqli_close($db);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login</title>

  <link rel="stylesheet" href="assets/css/login.css">


</head>

<body>

  <div class="container">
    <div class="form-box active" id="login-form">
      <form action="login.php" method="post">
        <a class="a-home" href="index.php">Home</a>
        <h2>Login</h2>
         <?php if (!empty($login_error)): ?>
          <div class="error-message" >
            <?php echo $login_error; ?>
          </div>
        <?php endif; ?>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" name="login">Login</button>
        <p>Register an account <a href="register.php">Register</a></p>
      </form>
    </div>
  </div>


</body>

</html>