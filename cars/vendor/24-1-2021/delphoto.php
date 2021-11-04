<?php
include_once '../../database.php';
$img = $_GET['img'];
if(file_exists($img))
{
    $sql = "CALL deleteLiftingProcedureImage(?)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $img, PDO::PARAM_LOB);
    $stmt->execute();
    unlink($img);
    header('location:edit_lifting_request.php?n='.$_GET['n'].'&r='.$_GET['r']);
}else echo 'error';
?>