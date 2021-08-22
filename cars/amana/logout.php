<?php 
session_start();
$_SESSION = array();
session_destroy();
// echo("<script> window.open('login.php' , '_self') </script>");
header('location:http://alsaifit.com/');

?>