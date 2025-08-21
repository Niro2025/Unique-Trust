<?php

define('DBSERVER','localhost');
define('DBUSERNAME','root');
define('DBPASSWORD','');
define('DBNAME','financial_db');

$db = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME);
if ($db === false) {
    die("Error: connection error. " .mysqli_connect_error());
}



// $host = 'localhost';
// $db   = 'financial_db'; 
// $user = 'root';        
// $pass = '1234';       



// // Create connection
// $conn = new mysqli($host, $user, $pass,$db,3307);

// // Check connection
// if ($conn->connect_error) {
//     die('Connection failed: ' . $conn->connect_error);
// }


?>