<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);

if ($isLogin) {
    $code = (time() + 300);

    //產生時間 +300後 寫入資料庫 (ID在SESSION)
    $sql = 'UPDATE members SET 	verifycode=' . $code . ' WHERE email="' . $_SESSION['user2']['email'] . '"';
    $result = mysqli_query($conn, $sql);
    if ($result === true) {

        $ch = curl_init("http://smexpress.mitake.com.tw:9600/SmSendGet.asp?username=52712698&password=34erdfCV&dstaddr=" . $_POST['mobile'] . "&DestName=" . $_SESSION['user2']['name'] . "&dlvtime=1&vldtime=3600&smbody=" . mb_convert_encoding('您的驗證碼為', "big5", "utf-8") . $code . "&response=");
        $res = curl_exec($ch);


    } else {

    }
    //


} else {

}


?>

