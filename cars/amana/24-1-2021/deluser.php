<?php
    session_start();
    include_once '../users.php';
    $req1= new Users();
    $rs= $req1->delete();
     echo("<script> window.open('userlist.php' , '_self') </script>");
   
?>