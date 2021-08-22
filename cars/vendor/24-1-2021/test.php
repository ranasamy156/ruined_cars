<?php

include_once '../database.php';
    $db = new Database();
    $img = $_GET['img'];
    if(file_exists($img))
    {
        $rs= $db->RunDML("delete from lifting_images where location='".$img."' ");
        unlink($img);
        header('location:edit_lifting_request.php?n='.$_GET['n'].'&r='.$_GET['r']);
    }else echo 'error';
// echo $_GET['n'];
?>