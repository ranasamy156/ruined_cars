<?php
require_once('../../db.php');
require_once '../../response.php';
require_once '../../tables.php';


$table = Tables::$MODELS;
$conn->set_charset("utf8");

$sql = "SELECT * FROM $table";

$result = $conn->query($sql);


$num_rows = $result->num_rows;
$jsonArray = array();


while ($row = $result->fetch_assoc()) {
    $response =
        array(
            "id" => $row['id'],
            "manufacture_id" => $row['manufacture_id'],
            "name" => $row['name'],
            "en_name"=>$row['en_name']

        );

    array_push($jsonArray, $response);
}


echo json_encode([
    "success" => 1,
    "data" => $jsonArray
]);
