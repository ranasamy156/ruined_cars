<?php
header("Content-Type: JSON");
  include_once '../database.php';
  $db = new Database();

  $chassis = $_POST['chassis'];
  $search = [];

  if(isset($chassis)){
  
  $rs = $db->GetData("select  rq.* ,sts.description as status_name,model.name as model_name ,man.name as man_name,us.name , ct.name as ct_name, ar.name as ar_name, st.name as st_name 
            
  from request rq ,models as model, manufactures man,users us ,areas ar ,cities ct,statuses sts,states st 
  
  where (rq.chassis like '%".$chassis."%') and rq.model_id=model.id and model.manufacture_id=man.id and rq.user_id = us.id and rq.city_id=ct.id and rq.area_id =ar.id and rq.state_id=st.id and rq.status_id=sts.id");

  while($row = mysqli_fetch_array($rs)) {
      $search[] = $row['id'];
      $search[] = $row['created_at'];
      $search[] = $row['status_name'];
      $search[] = $row['plate_number'];
      $search[] = $row['chassis'];

}
  echo json_encode($search,JSON_PRETTY_PRINT);
}else echo"error";


?>
