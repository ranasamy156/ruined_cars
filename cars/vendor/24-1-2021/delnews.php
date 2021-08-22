<?php
    session_start();
    include_once '../NewsClass.php';
    $new1= new News();
    $rs= $new1->delete();
     echo("<script> window.open('newslist.php' , '_self') </script>");
   
?>