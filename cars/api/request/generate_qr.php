
<?php
require_once('phpqrcode/qrlib.php');

require_once('../../db.php');
require_once '../../response.php';
require_once '../../tables.php';

function generateQR($reqID){
    $path="../../images/req_$reqID";
    $file=$path.".png";
    
    $text="http://alsaifit.com/cars/amana/24-1-2021/apirequest.php?n=$reqID";
    
    QRcode::png($text,$file,'',12,2);
    updateRequestQrPath($reqID,$file);
  
  
}


function updateRequestQrPath($reqID,$qrPath)
{   
    global $conn;
    
    $table = Tables::$REQUESTS;
    $sql = "update $table set qr_path='$qrPath' where id=$reqID";
    
    
    if ($conn->query($sql) === TRUE) {
        // $last_id = $conn->insert_id;
        // echo json_encode([
        //     "success" => 1,
        //     "request_id" => $last_id
        // ]);
    } else {
       // echo "Warinig:".error_reporting(E_ALL);

        errorMsg(mysqli_error($conn));
    }
}