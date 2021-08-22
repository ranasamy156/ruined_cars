<?php
    session_start();
    include 'dictionary.php';
    
    if(!isset($_SESSION['current_lang'])){
    $_SESSION['current_lang'] = $default_language;
    }
    $current_lang = $_SESSION['current_lang'];
    $expr = $dictionary[$current_lang];

    if(isset($_GET['change'])){
        if(isset($dictionary[$_GET['change']])){
        $_SESSION['current_lang'] = $_GET['change'];
    }
    header("location: " .$_SERVER['HTTP_REFERER']);
}


?>