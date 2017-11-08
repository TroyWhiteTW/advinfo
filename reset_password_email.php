<?php
include 'db.php';
session_start();
?>
<?php

//$errorMessage = "";
//foreach ($_POST as $k => $v) {
//    $_POST[$k] = trim($_POST[$k]);
//}
//checkData($_POST, $errorMessage);

if (!empty($_POST['email'])) {

    $_POST['email'] = trim($_POST['email']);

    $sql = 'SELECT * FROM members WHERE email="' . $_POST['email'] . '"';

    $rs = mysqli_query($conn, $sql);

    $row = mysqli_fetch_array($rs, MYSQLI_NUM);

    if ($row === NULL) {
        echo '查無此帳號';
        return;
    }

    // TODO: 聯結網域需修改!!!
    $link = 'http://advinfo.taironlife.com/reset_password_email.php?email=' . $_POST['email'] . '&hash_key=' . $row[1];

    require 'PHPMailer/PHPMailerAutoload.php';

    $mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    // TODO: 寄件者的 gmail 帳號
    $mail->Username = 'test@gmail.com';                 // SMTP username
    // TODO: 寄件者的 gmail 密碼
    $mail->Password = 'test';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->setFrom('from@example.com', 'Mailer');
//$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
    $mail->addAddress($_POST['email']);               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = 'Reset Password!';
    $mail->Body = '請點擊連結重設您的密碼！<br/><a href="' . $link . '">' . $link . '</a>';
//    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if (!$mail->send()) {
        echo '無法寄送電子信件至您填寫的電子信箱';
        echo '<br/>';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo '請至您的電子信箱收取重設密碼連結信';
    }

    $rs->close();
}

if (!empty($_GET['email']) && !empty($_GET['hash_key'])) {

    session_destroy();
    session_start();

    $sql = 'SELECT * FROM members WHERE email="' . $_GET['email'] . '"';

    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs, MYSQLI_NUM);

    if ($row === NULL) {
        echo '查無此帳號';
        return;
    }

    if ($row[7] === $_GET['email'] && $row[1] === $_GET['hash_key']) {
        //SESSION 設定
        $_SESSION['user'] = $row;

        echo '3秒後跳轉回重設密碼頁...';
        header("Refresh:3;url=password_modify.php");
    } else {
        echo '連結錯誤';
        header("Refresh:3;url=index.php");
    }

    $rs->close();
}

//function checkData($post, &$msg)
//{
//    foreach ($post as $k => $v) {
//        switch ($k) {
//            case 'email':
//                checkEmpty($k, $msg);
//                checkSpace($k, $msg);
//                chechEmail($k, $msg);
//                break;
//        }
//    }
//}
//
//function checkEmpty($k, &$msg)
//{
//    if (empty($_POST[$k])) {
//        $msg .= "$k 為空\n";
//    }
//}
//
//function checkSpace($k, &$msg)
//{
//    if (empty($_POST[$k])) {
//        return;
//    }
//    if (preg_match('/\s/', $_POST[$k])) {
//        $msg .= "$k 有空白鍵\n";
//    }
//}
//
//function chechEmail($k, &$msg)
//{
//    if (empty($_POST[$k])) {
//        return;
//    }
//    if (!preg_match('/[a-zA-Z0-9._%-]+@[a-zA-Z0-9._%-]+\.[a-zA-Z]{2,4}/', $_POST[$k])) {
//        $msg .= "$k 非電子信箱格式\n";
//    }
//}
//
//function chechLengthBetweenTwoValue($k, &$msg, $b, $s)
//{
//    if (empty($_POST[$k])) {
//        return;
//    }
//    if (!(strlen($_POST[$k]) <= $b && strlen($_POST[$k]) >= $s)) {
//        $msg .= "$k 長度不符\n";
//    }
//}
//
//function checkOneEngAndOneNum($k, &$msg)
//{
//    if (empty($_POST[$k])) {
//        return;
//    }
//    if (!(preg_match('/[0-9]/', $_POST[$k]) && preg_match('/[a-zA-Z]/', $_POST[$k]))) {
//        $msg .= "$k 必須至少擁有一個數字及英文";
//    }
//}
//
//function checkSamePassword($k, &$msg)
//{
//    if (empty($_POST[$k])) {
//        return;
//    }
//    if ($_POST[$k] !== $_POST['password']) {
//        $msg .= "$k 密碼確認有誤";
//    }
//}
//
//function checkHasNum($k, &$msg)
//{
//    if (empty($_POST[$k])) {
//        return;
//    }
//    if (preg_match('/[0-9]/', $_POST[$k])) {
//        $msg .= "$k 不得有數字";
//    }
//}
//
//function checkOnlyNum($k, &$msg)
//{
//    if (empty($_POST[$k])) {
//        return;
//    }
//    if (preg_match('/[^0-9]/', $_POST[$k])) {
//        $msg .= "$k 只能是數字";
//    }
//}
//
//function checkLength($k, &$msg, $l)
//{
//    if (empty($_POST[$k])) {
//        return;
//    }
//    if (strlen($_POST[$k]) !== $l) {
//        $msg .= "$k 長度不符";
//    }
//}
//
//function checkGender($k, &$msg)
//{
//    if (empty($_POST[$k])) {
//        return;
//    }
//    if ($_POST[$k] !== "M" && $_POST[$k] !== "F") {
//        $msg .= "$k 錯誤";
//    }
//}
//
//function checkType($k, &$msg)
//{
//    if (empty($_POST[$k])) {
//        return;
//    }
//    if ($_POST[$k] !== "1" && $_POST[$k] !== "2") {
//        $msg .= "$k 錯誤";
//    }
//}
//
//function encodeRegisterData($rawDataArray)
//{
//    $dataArray = [
//        "email" => "\"\"",
//    ];
//
//    foreach ($dataArray as $k => $v) {
//        if (!empty($rawDataArray[$k])) {
//            if ($k === "password") {
//                $dataArray[$k] = "\"" . password_hash($rawDataArray[$k], PASSWORD_DEFAULT) . "\"";
//            } else {
//                $dataArray[$k] = "\"" . $rawDataArray[$k] . "\"";
//            }
//        }
//    }
//    return $dataArray;
//}
//
//exit;