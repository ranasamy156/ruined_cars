<?php
require_once '../lib.php';
require_once '../response.php';




$table = Tables::$USERS;
$sql = "SELECT * FROM $table ORDER BY CUSTOMER_ID DESC";
$s = oci_parse($conn, $sql);
oci_execute($s);

$jsonArray = array();

while ($row = oci_fetch_array($s, OCI_RETURN_NULLS + OCI_ASSOC)) {
    $response = 
        array(
            "id" => $row['CUSTOMER_ID'],
            "name" => $row['CUSTOMER_AR_NAME'],
            "email" => $row['EMAIL_ADDRESS'],
            "phone" => $row['TEL_NO'],
            "national_id" => $row['ID_NO'],
            "password"=>$row['PASSWORD']
        );
    
    array_push($jsonArray, $response);
}

echo json_encode([
    "success" => 1,
    "data" => $jsonArray
]);
