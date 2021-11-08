<?php
    session_start();
    include '../../database.php';

    $sql = "CALL deleteUser(?)";
    $userID = $_GET['n'];

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $userID, PDO::PARAM_INT);
    $stmt->execute();
     echo("<script> window.open('userlist.php' , '_self') </script>");
   
?>