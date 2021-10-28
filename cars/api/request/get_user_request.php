
<?php
require_once('../../db.php');
require_once '../../response.php';
require_once '../../tables.php';

$user_id = $_POST['user_id'];
$conn->set_charset("utf8");

$table = Tables::$REQUESTS;
$sql = "SELECT rq.* , st.description as status_name FROM $table rq ,statuses st WHERE rq.user_id=$user_id and rq.status_id = st.id ORDER BY  id DESC";
$result = $conn->query($sql);

$jsonArray = array();
while ($row = $result->fetch_assoc()) {
    $response =
        array(
            "id" => $row['id'],
            "model_id" => $row['model_id'],
            "plate_number" => $row['plate_number'],
            "color" => $row['color'],
            "lat" => $row['lat'],
            "lng" => $row['lng'],
            "state_id" => $row['state_id'],
            "city_id" => $row['city_id'],
            "area_id" => $row['area_id'],
            "user_id" => $row['user_id'],
            "created_at" => $row['created_at'],
            "status_id" => $row['status_id'],
            "status_name"=>$row['status_name'],
            "en_plate_number"=>$row['en_platenum'],
            "plate_color"=>$row['plate_color'],
            "chassis"=>$row['chassis'],
            "reason"=>$row['reason']
           
      
        );

    array_push($jsonArray, $response);
}

echo json_encode([
    "success" => 1,
    "data" => $jsonArray
]);
