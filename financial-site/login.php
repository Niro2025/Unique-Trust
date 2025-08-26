<?php
require_once 'includes/db.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {

  $username = trim($_POST['username']);
  $password = trim($_POST['password']);



  if (empty($username)) {
    $error = '<p class="error">Please enter User Name</p>';
  }
  if (empty($password)) {
    $error = '<p class="error">Please enter Password</p>';
  }

  if (empty($error)) {

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

        if (password_verify($password, $password_db)) {

          echo "Inside password";
        }
      }

      // $row = $query->fetch();
      // echo $row;





      //       if ($row) {
      //         if (password_verify($password, $row['password'])) {
      //           $_SESSION["userid"] = $row['id'];
      //           $_SESSION["user"] = $row;


      // echo "Working final ";

      //           // header("location: index.php");
      //           // exit;
      //         } else {
      //           $error = '<p class="error" The Password or Username is not valid!></>';
      //         }
      //       } else {
      //         $error = '<p class="error" The Password or Username is not valid!></>';
      //       }

    }
    $query->close();
  }


   
  mysqli_close($db);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"> -->

  <!-- new form css -->

  <link rel="stylesheet" href="assets/css/login.css">


</head>

<body>
  <!-- <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Login</h2>
                    <p>Please fill in your email and password.</p>
                    <?php echo $error; ?>
                    <form action="" method="post">
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="text" name="username" class="form-control" required />
                        </div>    
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                        </div>
                        <p>Don't have an account? <a href="register.php">Register here</a>.</p>
                    </form>
                </div>
            </div>
        </div>  
         -->
  <!-- New form -->


  <div class="container">
    <div class="form-box" id="login-form">
      <form action="login_register.php" method="post">
        <h2>Login</h2>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
        <p>Register an account <a href="#" onclick="showForm('register-form')" >Register</a></p>
      </form>
    </div>
  </div>

  <div class="container">
    <div class="form-box active" id="register-form">
      <form action="login_register.php" method="post">
        <h2>Register</h2>
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
        <p>Already have an account <a href="#" onclick="showForm('login-form')">Login</a></p>
      </form>
    </div>
  </div>

  <script src="assets/js/login.js"></script>
</body>

</html>