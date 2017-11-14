<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);

if ($isLogin) {
    session_destroy();
    header('Location:index.php');
} else {
    header('Location:index.php');
}
exit;