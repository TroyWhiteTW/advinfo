<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);
?>
<?php

// TODO: 寄送mail的連結地只需依照網域做修改
if (!empty($_POST['email'])) {

    $sql = 'SELECT * FROM members WHERE email=' . $_POST['email'];

    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs, MYSQLI_NUM);

    $link = 'http://advinfo.taironlife.com/reset_password_email.php?email=' . $_POST['email'] . '&hash_key=' . $row[1];

    $to = $_POST['email'];
    $subject = '珍菌堂密碼修改';
    $message = '請點擊連結重設您的密碼！<br/><a href="' . $link . '">' . $link . '</a>';
    if (mail($to, $subject, $message) === true) {
        echo '請至您的電子信箱收取重設密碼連結信';
    } else {
        echo '無法寄送電子信件至您填寫的電子信箱';
    }

    $rs->close();
}

if (!empty($_GET['email']) && !empty($_GET['hash_key'])) {

    session_destroy();
    session_start();

    $sql = 'SELECT * FROM members WHERE email=' . $_GET['email'];

    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs, MYSQLI_NUM);

    if ($row[7] === $_GET['email'] && $row[1] === $_GET['hash_key']) {
        //SESSION 設定
        $_SESSION['user'] = $row;

        echo '3秒後跳轉回重設密碼頁...';
        header("Refresh:3;url=password_modify.php");
    }else{
        echo '連結錯誤';
        header("Refresh:3;url=index.php");
    }

    $rs->close();
}

