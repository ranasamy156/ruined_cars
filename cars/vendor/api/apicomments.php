<?php
header("Content-Type: JSON");
  include_once '../database.php';
  $db = new Database();
   // echo "ppppp";
  $comments = [];

 
  
  $rs = $db->GetData("select com.* ,ustype.type as user_type, us.name from comments com, users_types ustype, users us where com.request_id = ".$_GET["n"]." and us.type_id = ustype.id and com.user_id = us.id");

  while($row = mysqli_fetch_array($rs)) {
      $com = array();
      $com["id"] = $row['id'];
      $com["name"] = $row['name'];
      $com["description"] = $row['description'];
      $com["user_type"] = $row['user_type'];
        array_push($comments, $com);
    }
  // print_r($comments);
  echo json_encode($comments);

?>
