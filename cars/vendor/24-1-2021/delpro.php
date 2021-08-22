<?php
    session_start();
    include_once '../Procedures.php';
    $pro1= new Procedures();
    $rs= $pro1->delete();
     echo("<script> window.open('procedureslist.php' , '_self') </script>");
   
?>