<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);
?>
<?php

if (!empty($_POST['email'])) {

    $_POST['email'] = trim($_POST['email']);

    $sql = 'SELECT * FROM members WHERE email="' . $_POST['email'] . '"';

    $rs = mysqli_query($conn, $sql);

    $row = mysqli_fetch_array($rs, MYSQLI_NUM);

    if ($row === NULL) {
        echo '查無此帳號';
        return;
    }

    $link = 'http://localhost/advinfo/reset_password_email.php?email=' . $_POST['email'] . '&hash_key=' . $row[1];

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

