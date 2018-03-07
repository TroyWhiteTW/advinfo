<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);

if (!empty($_POST['proid']) && !empty($_POST['count'])) {
    $_SESSION['shop_cart'][$_POST['proid']] = $_POST['count'];
}
