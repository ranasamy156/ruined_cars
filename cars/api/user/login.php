<?php
require_once('../../db.php');
require_once '../../response.php';
require_once '../../tables.php';
header("Access-Control-Allow-Origin: *");

$user_name = $_POST['user_name'];
$password = $_POST['password'];

if (isset($user_name) && isset($password)) {
$conn->set_charset("utf8");

    $table = Tables::$USERS;
    $sql = "SELECT us.*, t.type as type_name FROM $table us ,users_types t WHERE user_name='$user_name' and password ='$password' and us.type_id = t.id";

    $result = $conn->query($sql);


    $num_rows = $result->num_rows;
    if ($num_rows > 0) {
        if ($row = $result->fetch_assoc()) {
            echo json_encode([
                "success" => 1,
                "data" => [
                    "id" => $row['id'],
                    "name" => $row['name'],
                    "phone" => $row['phone'],
                    "type_id" => $row['type_id'],
                    "user_name" => $row['user_name'],
                    "type_name"=>$row['type_name']
                ]
            ]);
           
        }
    } else {
        // echo "Warinig:".error_reporting(E_ALL);

        errorMsg("اسم المستخدم غير صحيح");
    }
}
