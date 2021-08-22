<?php
    session_start();
    include_once '../Status.php';
    $req1= new Status();
    $rs= $req1->delete();
     echo("<script> window.open('reqlist.php' , '_self') </script>");
   
?>