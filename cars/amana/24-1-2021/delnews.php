<?php
    session_start();
    include '../../database.php';
    $itemID = $_GET['n'];
    $sql = "CALL deleteNews(?)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $itemID, PDO::PARAM_INT);
    $rs = $stmt->execute();
    echo("<script> window.open('newslist.php' , '_self') </script>");
   
?>