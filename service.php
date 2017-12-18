<?php
include 'db.php';
session_start();

$errorMessage = "";
foreach ($_POST as $k => $v) {
    $_POST[$k] = trim($_POST[$k]);
}
//checkData($_POST, $errorMessage);

if (empty($errorMessage)) {

    //檢查通過 寫入資料庫
    $insertData = encodeRegisterData($_POST);
    $keys = array_keys($insertData);

    $sqlSetStr = f1($keys);

    $sqlValueStr = f2($keys, $insertData);

    $sql = 'INSERT INTO customerservices ' . $sqlSetStr . ' VALUES ' . $sqlValueStr . ';';

    $result = mysqli_query($conn, $sql);
//var_dump($result);return;
    if ($result == true) {
        send2Mail($_POST['email'], 'service mail', $_POST['content']);
        echo 1;
//        echo "感謝您的意見，我們將盡快與您聯繫答覆；3秒後跳轉回首頁...";
//        header("Refresh:3;url=index.php");
    } else {
        echo 0;
//        echo "發生未預期錯誤...";
    }
//    $result->close();
    exit;
} else {
    echo "資料有誤:\n" . $errorMessage;
    exit;
}

function f1($ks)
{
    $str = "(";
    foreach ($ks as $v) {
        $str .= $v . ",";
    }
    return substr($str, 0, -1) . ")";
}

function f2($ks, $vs)
{
    $str = "(";
    foreach ($ks as $v) {
        $str .= $vs[$v] . ",";
    }
    return substr($str, 0, -1) . ")";
}

function checkData($post, &$msg)
{
    foreach ($post as $k => $v) {
        switch ($k) {
            case 'email':
                checkEmpty($k, $msg);
                checkSpace($k, $msg);
                chechEmail($k, $msg);
                break;
            case 'password':
                checkEmpty($k, $msg);
                checkSpace($k, $msg);
                chechLengthBetweenTwoValue($k, $msg, 20, 8);
                checkOneEngAndOneNum($k, $msg);
                break;
            case 'password_c':
                checkEmpty($k, $msg);
                checkSamePassword($k, $msg);
                break;
            case 'name':
                checkEmpty($k, $msg);
                checkSpace($k, $msg);
                checkHasNum($k, $msg);
                break;
            case 'phone':
                checkSpace($k, $msg);
                checkOnlyNum($k, $msg);
                break;
            case 'mobile':
                checkEmpty($k, $msg);
                checkSpace($k, $msg);
                checkOnlyNum($k, $msg);
                checkLength($k, $msg, 10);
                break;
            case 'address':
                checkEmpty($k, $msg);
                break;
            case 'gender':
                checkEmpty($k, $msg);
                checkSpace($k, $msg);
                checkGender($k, $msg);
                break;
            case 'type':
                checkEmpty($k, $msg);
                checkSpace($k, $msg);
                checkType($k, $msg);
                break;
            case 'referral':
                checkSpace($k, $msg);
                chechEmail($k, $msg);
                break;
            case 'validate_code':
                checkEmpty($k, $msg);
                checkSpace($k, $msg);
                break;
            case 'birthday_y':
                checkEmpty($k, $msg);
                checkSpace($k, $msg);
                break;
            case 'birthday_m':
                checkEmpty($k, $msg);
                checkSpace($k, $msg);
                break;
            case 'birthday_d':
                checkEmpty($k, $msg);
                checkSpace($k, $msg);
                break;
        }
    }
}

function checkEmpty($k, &$msg)
{
    if (empty($_POST[$k])) {
        $msg .= "$k 為空\n";
    }
}

function checkSpace($k, &$msg)
{
    if (empty($_POST[$k])) {
        return;
    }
    if (preg_match('/\s/', $_POST[$k])) {
        $msg .= "$k 有空白鍵\n";
    }
}

function chechEmail($k, &$msg)
{
    if (empty($_POST[$k])) {
        return;
    }
    if (!preg_match('/[a-zA-Z0-9._%-]+@[a-zA-Z0-9._%-]+\.[a-zA-Z]{2,4}/', $_POST[$k])) {
        $msg .= "$k 非電子信箱格式\n";
    }
}

function chechLengthBetweenTwoValue($k, &$msg, $b, $s)
{
    if (empty($_POST[$k])) {
        return;
    }
    if (!(strlen($_POST[$k]) <= $b && strlen($_POST[$k]) >= $s)) {
        $msg .= "$k 長度不符\n";
    }
}

function checkOneEngAndOneNum($k, &$msg)
{
    if (empty($_POST[$k])) {
        return;
    }
    if (!(preg_match('/[0-9]/', $_POST[$k]) && preg_match('/[a-zA-Z]/', $_POST[$k]))) {
        $msg .= "$k 必須至少擁有一個數字及英文";
    }
}

function checkSamePassword($k, &$msg)
{
    if (empty($_POST[$k])) {
        return;
    }
    if ($_POST[$k] !== $_POST['password']) {
        $msg .= "$k 密碼確認有誤";
    }
}

function checkHasNum($k, &$msg)
{
    if (empty($_POST[$k])) {
        return;
    }
    if (preg_match('/[0-9]/', $_POST[$k])) {
        $msg .= "$k 不得有數字";
    }
}

function checkOnlyNum($k, &$msg)
{
    if (empty($_POST[$k])) {
        return;
    }
    if (preg_match('/[^0-9]/', $_POST[$k])) {
        $msg .= "$k 只能是數字";
    }
}

function checkLength($k, &$msg, $l)
{
    if (empty($_POST[$k])) {
        return;
    }
    if (strlen($_POST[$k]) !== $l) {
        $msg .= "$k 長度不符";
    }
}

function checkGender($k, &$msg)
{
    if (empty($_POST[$k])) {
        return;
    }
    if ($_POST[$k] !== "M" && $_POST[$k] !== "F") {
        $msg .= "$k 錯誤";
    }
}

function checkType($k, &$msg)
{
    if (empty($_POST[$k])) {
        return;
    }
    if ($_POST[$k] !== "1" && $_POST[$k] !== "2") {
        $msg .= "$k 錯誤";
    }
}

function encodeRegisterData($rawDataArray)
{
    $dataArray = [
        'cstype_no' => "\"\"",
        "name" => "\"\"",
        "phone" => "\"\"",
        "email" => "\"\"",
        "content" => "\"\"",
        "addtime" => '"' . date('Y-m-d H:i:s', time()) . '"',
        "updatetime" => '"' . date('Y-m-d H:i:s', time()) . '"',
    ];

    foreach ($dataArray as $k => $v) {
        if (!empty($rawDataArray[$k])) {
            if ($k === "password") {
                $dataArray[$k] = "\"" . password_hash($rawDataArray[$k], PASSWORD_DEFAULT) . "\"";
            } else {
                $dataArray[$k] = "\"" . $rawDataArray[$k] . "\"";
            }
        }
    }

    return $dataArray;
}

function sendEmail()
{
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

    $mail->setFrom('service@taironlife.com', 'Mailer');
//$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
    $mail->addAddress($_POST['email']);               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = 'Reset Password!';
    $mail->Body = 'a';
//    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if (!$mail->send()) {
//        echo '無法寄送電子信件至您填寫的電子信箱';
//        echo '<br/>';
//        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo '感謝您的意見，我們將盡快與您聯繫答覆；3秒後跳轉回首頁...';
    }
}

function send2Mail($towhom, $title, $mesg)
{
    $to = 'service@taironlife.com';
    $subject = $title;
    $message = $mesg;
    $headers = 'From:  ' . $towhom . "\r\n" .
        'Reply-To:  service@taironlife.com' . "\r\n" .
        'MIME-Version: 1.0' . "\r\n" .
        'Content-type:text/html;charset=UTF-8' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    mail($to, $subject, $message, $headers);
}

exit;