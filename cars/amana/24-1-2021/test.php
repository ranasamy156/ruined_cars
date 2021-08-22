<?php

    include_once '../database.php';
    $db = new Database();
    $img = $_GET['n'];
    if(file_exists($img))
    {
        $rs= $db->RunDML("delete from slider where userfile='".$img."' ");
        unlink($img);
        header('location:photolist.php');
    }else echo 'error';
// echo $_GET['n'];
?>