<?php

require_once 'includes/db.php';



    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['register'])) {
echo"d";
        // Registation Form Validation

        if (! isset($_POST['username'], $_POST['password'], $_POST['email'])) {

            exit('Please complete the registation form!');
        }

        if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {

            exit('Please complete the registation form!');
        }

        // Registation feilds Validation

        if (! filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            exit('Email is not valid');
        }

        if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['username']) == 0) {
            exit('Username is not valid');
        }

        if (strlen($_POST['password']) < 4) {
            exit('Password must be long 5 Characters');
        }

        if ($query = $db->prepare('SELECT username FROM signup WHERE username = ?')) {

            $query->bind_param('s', $_POST['username']);
            $query->execute();
            $query->store_result();

            if ($query->num_rows > 0) {


                //sessions 27.30
                 
            } else {

                $password   = $_POST['password'];
                $username   = $_POST['username'];
                $email      = $_POST['email'];
                $role = $_POST['role'];
                
                echo($role);



                if ($query = $db->prepare('INSERT INTO signup (username, email, password, user_level) VALUES (?, ?, ?, ?)')) {
                    $query->bind_param('ssss', $username, $email, $password, $role);
                    $query->execute();

                    echo "Sucessfully data";
                    header("Location: login.php");
                } else {
                    echo "Prepare statement error";
                }
            }
            $query->close();
        } else {

            echo "Error in entering data"; // Prob with entering feild datas
        }
    }




    // Login Process


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

        if (password_verify($password, $password_db)) {

          echo "Inside password";
        }
      } else {
        // sessions 28.47
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