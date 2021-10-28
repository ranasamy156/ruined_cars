<?php
header('Content-type: application/json; charset=UTF-8');
  include_once '../database.php';
  $db = new Database();
  $rs = $db->GetData("select * from slider");
  $photos = [];
  while($row = mysqli_fetch_array($rs)) {
      $photos[] = $row['userfile'];
}
  // print_r($photos);
  echo json_encode($photos,JSON_PRETTY_PRINT);
  
?>