<?php
require_once('../../db.php');
require_once '../../response.php';
require_once '../../tables.php';


$table = Tables::$MANUFACTURES;
$conn->set_charset("utf8");

$sql = "SELECT * FROM $table";

$result = $conn->query($sql);


$num_rows = $result->num_rows;
$jsonArray = array();


while ($row = $result->fetch_assoc()) {
      extract($row);
    $response =
        array(
            "id" => $row['id'],
           
            "name" =>  $row['name'] 

        );

    array_push($jsonArray, $response);
    
}


echo json_encode([
    "success" => 1,
    "data" => $jsonArray
]);
