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
     
  
      if($query -> num_rows>0){
        $query-> bind_result($id, $password_db);
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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
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
    </body>
</html>


<!-- 
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/login.css">
  <title>Sign Up</title>
</head>

<body>

  <div id="wrapper">
    <div class="main-content">
      <div class="header">
        <img src="assets/img/logo.png" />
      </div>
      <form action="" method="post" >
        <div class="l-part">
          <input type="text" placeholder="Username" class="input-1" />
          <div class="overlap-text">
            <input type="password" placeholder="Password" class="input-2" />
            <a href="#">Forgot?</a>
          </div>
          <input type="button" name="submit" value="Log in" class="btn" />

          

        </div>
      </form>
    </div>
    <div class="sub-content">
      <div class="s-part">
        Don't have an account?<a href="#"> Sign up</a>
      </div>
    </div>
  </div>
</body>

</html> -->