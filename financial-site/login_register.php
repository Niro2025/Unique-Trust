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
