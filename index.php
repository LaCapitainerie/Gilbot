<?php

session_start();

header('location: homepage');
exit;

if(isset($_SESSION['secure'])){
    header('location: ./Html/main.php');
    exit;
} else {
    header('location: ./Html/login.php');
    exit;
};

?>