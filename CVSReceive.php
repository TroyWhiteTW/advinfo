<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);

echo '常用門市選擇成功！3秒後跳轉回會員資料頁...';
header("Refresh:3;url=function_member.php");