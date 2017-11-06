<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);

if ($isLogin) {
    session_destroy();
    echo "登出成功，3秒後跳轉回首頁...";
    header("Refresh:3;url=index.php");
}

?>