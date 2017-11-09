<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);
?>
<?php

if (!empty($_POST['proid'])) {
    unset($_SESSION['shop_cart'][$_POST['proid']]);
}
