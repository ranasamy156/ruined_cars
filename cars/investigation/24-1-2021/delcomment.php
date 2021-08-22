<?php
    session_start();
    include_once '../database.php';
    $req1= new Database();
    $rs1= $req1->RunDML("delete from comments where id='".$_GET["n"]."' ");

     echo("<script> window.open('../index.php' , '_self') </script>");
   
?>

