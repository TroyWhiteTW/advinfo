<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);

if (!empty($_POST['proid'])) {
    unset($_SESSION['shop_cart'][$_POST['proid']]);
}
