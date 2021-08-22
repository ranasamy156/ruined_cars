
<?php
require_once('../../db.php');
require_once '../../response.php';
require_once '../../tables.php';

$request_id = $_POST['request_id'];

$table = Tables::$IMAGES;
$sql = "SELECT * FROM $table WHERE request_id=$request_id";
$result = $conn->query($sql);

$jsonArray = array();
while ($row = $result->fetch_assoc()) {
    $response =
        array(
            "id" => $row['id'],
            "path" => $row['path'],
            "request_id" => $row['request_id'],
           );

    array_push($jsonArray, $response);
}

echo json_encode([
    "success" => 1,
    "data" => $jsonArray
]);
