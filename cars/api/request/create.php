<?php
require_once('../../db.php');
require_once '../../response.php';
require_once '../../tables.php';
require_once 'upload_images.php';
require_once 'generate_qr.php';


$conn->set_charset("utf8");

$longitude = $_POST['longitude'];
$state = $_POST['state'];
$city = $_POST['city'];
$area = $_POST['area'];
$user = $_POST['user'];
$chassis=$_POST['chassis'];
$baladya=$_POST['baladya'];
$direct=$_POST['direct'];

$model_id = $_POST['model_id'];

$plate_number = $_POST['plate_number'];
$en_plate_number = $_POST['en_platenum'];
$plate_color = $_POST['plate_color'];


$color = $_POST['color'];

$lat = $_POST['lat'];


$status_id = 10;
date_default_timezone_set("Asia/Riyadh");
//date_default_timezone_set();

$created_at = date('Y-m-d H:i:s');
$updated_at = date('Y-m-d H:i:s');




//$_FILES['media']
//echo $_FILES['image'];
//print_r("Count:".count($_FILES));

if (true) {
    
    $table = Tables::$REQUESTS;
    $table2 = Tables::$NOTIFY;
           //print_r("BeforeInsert");

    $sql = "INSERT INTO $table(model_id, plate_number, color, lat, lng, state_id, city_id, area_id, user_id, created_at, updated_at, status_id,en_platenum,plate_color,chassis,baladya,direct) VALUES ($model_id,'$plate_number','$color',$lat,$longitude,$state,$city,$area,$user,'$created_at','$updated_at',$status_id,'$en_plate_number','$plate_color','$chassis','$baladya','$direct')";
    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
        uploadRequestImages($_FILES,$last_id);

        // send notification
        $message = "تم انشاء طلب جديد برقم ".$last_id;

        $sql2 = "INSERT INTO $table2(request_id, message, seen, type_id) VALUES ($last_id,'$message','0','1'), ($last_id,'$message','0','2'), ($last_id,'$message','0','3'), ($last_id,'$message','0','4')";
        $conn->query($sql2);

        //generateQR
        generateQR($last_id);
        echo json_encode([
            "success" => 1,
            "request_id" => $last_id
        ]);
        
    } else {
        // echo "Warinig:".error_reporting(E_ALL);

        errorMsg(mysqli_error($conn));
    }
}
