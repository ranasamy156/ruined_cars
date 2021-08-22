<?php
header("Content-Type: JSON");
header("Access-Control-Allow-Origin: *");

  include_once '../database.php';
  $db = new Database();

  $plate_number = $_GET['plate_number'];
  $search = [];

  if(isset($plate_number)){
  
  $rs = $db->GetData("select rq.* ,st.description as status_name ,sts.name as state_name, ct.name as city_name ,ar.name as area_name,us.name as user_name ,model.name as model_name , man.name as man_name from request rq ,status st, states sts, cities ct, areas ar,users us , models model , manufactures man  where (rq.plate_number = '".$plate_number."' or rq.en_platenum = '".$plate_number."') and rq.user_id = us.id and rq.status_id=st.id and sts.id=rq.state_id and ct.id=rq.city_id and ar.id=rq.area_id and model.id=rq.model_id and man.id = model.manufacture_id"  );
  while($row = mysqli_fetch_array($rs)) {
      $rowItem=array();
        $rowItem['id']=$row['id'];
        $rowItem['created_at']=$row['created_at'];
        $rowItem['status_name']=$row['status_name'];
        $rowItem['plate_number']=$row['plate_number'];
                $rowItem['en_platenum']=$row['en_platenum'];

         $rowItem['state_name']=$row['state_name'];
        $rowItem['city_name']=$row['city_name'];
        $rowItem['area_name']=$row['area_name'];
        $rowItem['color']=$row['color'];
        $rowItem['chassis']=$row['chassis'];
          $rowItem['model']=$row['model_name'];
        $rowItem['manu']=$row['man_name'];
        
       
    //   $search[] = $row['id'];
    //   $search[] = $row['created_at'];
    //   $search[] = $row['status_name'];
    //   $search[] = $row['user_name'];
    //   $search[] = $row['plate_number'];
    
    array_push($search,$rowItem);
}
   //print_r($search);
  echo json_encode($search,JSON_PRETTY_PRINT);
}else echo"error";


//$_POST['plate_number'];
?>
