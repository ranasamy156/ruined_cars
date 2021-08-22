<?php
require_once '../lib.php';
require_once '../response.php';

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$national_id = $_POST['national_id'];

$nationality_type = $_POST['nationality_type']; //1->EG 2->KSA
$sql;
if (
    true
) {
    
    $table = Tables::$USERS;
    if(!empty($national_id)){
        $sql = "UPDATE  $table set CUSTOMER_EN_NAME='$name' , CUSTOMER_AR_NAME='$name',
        EMAIL_ADDRESS='$email' , NATIONALITY_ID =$nationality_type , ID_NO=$national_id WHERE TEL_NO='$phone' ";
    }else{
        $sql = "UPDATE  $table set CUSTOMER_EN_NAME='$name' , CUSTOMER_AR_NAME='$name',
        EMAIL_ADDRESS='$email' , NATIONALITY_ID =null , ID_NO=null WHERE TEL_NO='$phone' ";
    }
  
    $s = oci_parse($conn, $sql);
    oci_execute($s);

    $num_rows = oci_num_rows($s);

    if ($num_rows > 0) {
        echo json_encode([
            "success" => 1,
            "data" => [
               
                "name" => $name,
                "email" => $email,
                "phone" => $phone,
                "national_id" => $national_id
            ]
        ]);
    } else {
        // echo "Warinig:".error_reporting(E_ALL);

        errorMsg(oci_error()['message']);
    }
} else {
    errorMsg('Fill all parameters');
}
