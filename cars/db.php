<?php
header('Content-Type: application/json; charset=utf-8');
require_once 'response.php';
//error_reporting(0);
$servername = "localhost";
$username = "root";
$password = "";
$dbname="cars";
// $username = "alsaifit";
// $password = "M01008281513";
// $dbname="alsaifit_cars";
 $conn = new mysqli($servername,$username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    errorMsg('Connection failed');
  }