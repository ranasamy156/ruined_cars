<?php
header('Content-Type: application/json;');
require_once 'response.php';
//error_reporting(0);
$servername = "localhost";
// $username = "root";
// $password = "";
// $dbname="cars";
$username = "ilcruumy_cars";
$password = "lcQeKA0SuFG";
$dbname="ilcruumy_cars";
 $conn = new mysqli($servername,$username, $password,$dbname);

    echo "dasdadas";



// Check connection
if ($conn->connect_error) {
    errorMsg('Connection failed');
  }
