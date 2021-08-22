<?php
 $finalResult=new \stdClass();
 
function errorMsg($msg){
    global $finalResult;
   // global $conn;

    $finalResult ->success=0;
    $finalResult->message=$msg;
    echo json_encode($finalResult);
    // oci_close($connection);
    die();
}
