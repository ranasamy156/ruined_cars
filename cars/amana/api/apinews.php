<?php
header("Content-Type: JSON");
  include_once '../database.php';
  $db = new Database();

  $news = [];
  $rs = $db->GetData("select * from news");

  while($row = mysqli_fetch_array($rs)) {
      $com = array();
      $com["id"] = $row['id'];
      $com["description"] = $row['description'];
        array_push($news, $com);
    }
  // print_r($news);
  echo json_encode($news,JSON_PRETTY_PRINT);

?>
