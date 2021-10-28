<?php
header("Content-Type: JSON");
header("Access-Control-Allow-Origin: *");

  include_once '../database.php';
  $db = new Database();

  $plate_number = $_GET['plate_number'];
  $order_number = $_GET['order_number'];
  $chassis_number = $_GET['chassis_number'];

    
  $search = [];

  if(isset($plate_number)||isset($order_number)||isset($chassis_number)){
  
  if($plate_number!=null){
         $rs = $db->GetData("select rq.* ,st.description as status_name ,sts.name as state_name, ct.name as city_name ,ar.name as area_name,us.name as user_name  from request rq ,statuses st, states sts, cities ct, areas ar,users us  where true and rq.user_id = us.id and rq.status_id=st.id and sts.id=rq.state_id and ct.id=rq.city_id and ar.id=rq.area_id"  );
 
  }
  else if($order_number!=null)
    $rs = $db->GetData("select rq.* ,st.description as status_name ,sts.name as state_name, ct.name as city_name ,ar.name as area_name,us.name as user_name  from request rq ,statuses st, states sts, cities ct, areas ar,users us  where (rq.id = ".$order_number.") and rq.user_id = us.id and rq.status_id=st.id and sts.id=rq.state_id and ct.id=rq.city_id and ar.id=rq.area_id"  );
  else 
      $rs = $db->GetData("select rq.* ,st.description as status_name ,sts.name as state_name, ct.name as city_name ,ar.name as area_name,us.name as user_name  from request rq ,statuses st, states sts, cities ct, areas ar,users us  where (rq.chassis like  '%".$chassis_number."%') and rq.user_id = us.id and rq.status_id=st.id and sts.id=rq.state_id and ct.id=rq.city_id and ar.id=rq.area_id"  );
    

  while($row = mysqli_fetch_array($rs)) {
      if($plate_number!=null){
               

          $enNum=$row['en_platenum'];
          $enNum=str_replace(' ', '', $enNum);
          $enNum=str_replace('/', '', $enNum);

          $arNum=$row['plate_number'];
          $arNum=str_replace(' ', '', $arNum);
          $arNum=str_replace('/', '', $arNum);


          $plate_number= str_replace(' ', '', $plate_number);
         $plate_number= str_replace('/', '', $plate_number);
        
         
            // if(strlen($plate_number)!=7){
            //     die();
            // }
            
            // print_r($plate_number.'\n');
            // print_r($enNum.'\n');
            //             print_r($arNum.'\n');

           // die();
          $found=true;
          for($i=0;$i<strlen($plate_number);$i++){
                   
                     if (strpos($enNum, $plate_number[$i]) !== false||strpos($arNum, $plate_number[$i]) !== false)  {
                            //print_r("Found");
                        
                      }else{
                             $found=false;
                          break;
                                                    //  print_r("NotFound");

                      }
                    
          }
          
            if($found==false)
                continue;
      }
      $rowItem=array();
        $rowItem['id']=$row['id'];
        $rowItem['created_at']=$row['created_at'];
        $rowItem['status_name']=$row['status_name'];
        $rowItem['plate_number']=$row['plate_number'];
                $rowItem['en_platenum']=$row['en_platenum'];

                $rowItem['en_plate_number']=$row['en_platenum'];

         $rowItem['state_name']=$row['state_name'];
        $rowItem['city_name']=$row['city_name'];
        $rowItem['area_name']=$row['area_name'];
        
        $rowItem['city_id']=$row['city_id'];
        $rowItem['state_id']=$row['state_id'];
        $rowItem['area_id']=$row['area_id'];
       
        $rowItem['lat']=$row['lat'];
        $rowItem['lng']=$row['lng'];

        $rowItem['color']=$row['color'];
                $rowItem['plate_color']=$row['color'];

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
}


//$_POST['plate_number'];
?>
