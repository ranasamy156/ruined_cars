<?php

require_once('../../db.php');
require_once '../../response.php';
require_once '../../tables.php';



function uploadRequestImages($files,$request_id)
{     
   

     $total = count($files);
    // // Loop through each file
    for ($i = 0; $i < $total; $i++) {
        $tmpFilePath = $files[$i]['tmp_name'];
      //  echo "Temp:".$tmpFilePath;
     //Make sure we have a file path
     if ($tmpFilePath != "") {
         //Setup our new file path
         $newFilePath = "../../images/" . $files[$i]['name'];
     
         //Upload the file into the temp dir
         if (move_uploaded_file($tmpFilePath, $newFilePath)) {
           
             insertImagePath($newFilePath,$request_id);
             //Handle other code here

         }else{
         }
     }
    }
     //Get the temp file path
    
}

function insertImagePath($path,$request_id)
{   
    global $conn;
    
    $table = Tables::$IMAGES;
    $sql = "INSERT INTO $table(path, request_id) VALUES ('$path',$request_id)";
    
    
    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
        // echo json_encode([
        //     "success" => 1,
        //     "request_id" => $last_id
        // ]);
    } else {
       // echo "Warinig:".error_reporting(E_ALL);

        errorMsg(mysqli_error($conn));
    }
}
