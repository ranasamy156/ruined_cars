<?php
    include_once '../../database.php';
    $img = $_GET['n'];
    if(file_exists($img))
    {
        $sql = "CALL deleteSliderImage(?)";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $img, PDO::PARAM_LOB);
        $stmt->execute();
        unlink($img);
        header('location:photolist.php');
    }else echo 'error';
// echo $_GET['n'];
?>