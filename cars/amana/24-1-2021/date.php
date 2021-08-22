<?php
include_once '../database.php';
$db4 = new database();
$rs3 = $db4->GetData("select * from request where id = 13");
if($row1 = mysqli_fetch_assoc($rs3)){
  
  $date=date_create($row1['created_at']);
  date_add($date,date_interval_create_from_date_string("20 days"));
  $enddate = date_format($date,"Y-m-d");
  if($enddate <= date("Y-m-d")){
    $rs3 = $db4->RunDML("update request set status_id = 13  WHERE DATE(created_at) + INTERVAL 20 DAY <= DATE(NOW())");
  }
  // echo $row1['created_at']."</br>";
  //  echo $enddate."</br>"; 
  //  echo date("Y-m-d");

}
?>