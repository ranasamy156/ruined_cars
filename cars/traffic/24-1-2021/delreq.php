<?php
    session_start();
    include_once 'RequestClass.php';
    $req1= new Requests();
    $rs= $req1->delete();

    if($rs=="ok"){
        echo("<script> window.open('index.php' , '_self') </script>");
    }else{
           echo("<div class='alert alert-danger'> ".$rs."</div>");
    }
?>