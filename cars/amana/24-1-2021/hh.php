<?php
include '../../database.php';
$reqID = 405;

    $reqQuery = "CALL getReqById(?)";
  try{

    $stmt = $conn->prepare($reqQuery);
    $stmt->bindParam(1, $reqID, PDO::PARAM_INT);
    $stmt->execute();
    $row2 = $stmt->fetch();
    print_r($row2);
  }catch(PDOException $e){
    print("Exception");
  };
  exit;
?>