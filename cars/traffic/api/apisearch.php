<?php
header("Content-Type: JSON");
  include_once '../database.php';
  $db = new Database();

  $plate_number = $_POST['plate_number'];
  $search = [];

  if(isset($plate_number)){
  
  $rs = $db->GetData("select rq.* ,st.description as status_name ,us.name as user_name from request rq ,status st, users us where rq.plate_number like '%".$plate_number."%' and rq.user_id = us.id and rq.status_id=st.id");

  while($row = mysqli_fetch_array($rs)) {
      $search[] = $row['id'];
      $search[] = $row['created_at'];
      $search[] = $row['status_name'];
      $search[] = $row['user_name'];
      $search[] = $row['plate_number'];
}
   //print_r($search);
  echo json_encode($search,JSON_PRETTY_PRINT);
}else echo"error";


//$_POST['plate_number'];
?>
