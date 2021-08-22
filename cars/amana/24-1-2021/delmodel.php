<?php
    session_start();
    include_once '../database.php';
    $req1= new Database();
    $rs1= $req1->RunDML("delete from models where id='".$_GET["n"]."' ");

     echo("<script> window.open('addcar.php' , '_self') </script>");
   
?>

