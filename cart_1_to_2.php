<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);
?>
<?php
$orders = $_SESSION['orders'];
$orderdetail = $_SESSION['order_detail'];
