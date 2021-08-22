<?php
require_once '../response.php';
require_once '../cars/db.php';

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$national_id = $_POST['national_id'];
$password = $_POST['password'];
$nationality_type=$_POST['nationality_type']; //1->EG 2->KSA

if (isset($name) && isset($email) && isset($phone) && isset($national_id) && isset($password)
&&isset($nationality_type)
) {
   // $user_id = getRandomID("SAR_CUSTOMERS");
    $table = Tables::$USERS;
    $sql = "INSERT INTO $table (CUSTOMER_ID,CUSTOMER_CODE,CUSTOMER_EN_NAME,CUSTOMER_AR_NAME,TEL_NO,EMAIL_ADDRESS,NATIONALITY_ID,CUSTOMER_STATUS,PASSWORD,ID_NO) values($user_id,$user_id,'$name','$name','$phone','$email',$nationality_type,'NRM','$password',$national_id)";
    $s = oci_parse($conn, $sql);
    oci_execute($s);

    $num_rows = oci_num_rows($s);
   
    if ($num_rows > 0) {
        echo json_encode([
            "success" => 1,
            "data" => [
                "id" => $user_id,
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
