<?php
include 'db.php';
session_start();
?>
<?php

$errorMessage = "";
foreach ($_POST as $k => $v) {
    $_POST[$k] = trim($_POST[$k]);
}
checkData($_POST, $errorMessage);

if (empty($errorMessage)) {

    //組合生日字串
    $_POST['birthday'] = $_POST['birthday_y'] . '-' . $_POST['birthday_m'] . '-' . $_POST['birthday_d'];

    //檢查驗證碼
    if ($_POST['validate_code'] !== $_SESSION['check_word']) {
        echo "驗證碼錯誤，3秒後跳轉回註冊頁...";
        header("Refresh:3;url=login_register.php");
        exit;
    }

    //比對有無同帳號
    $sqlCheckAccountExist = 'SELECT * FROM members WHERE email=' . "\"" . $_POST['email'] . "\"";
    $rs = mysqli_query($conn, $sqlCheckAccountExist);
    $row = mysqli_fetch_array($rs, MYSQLI_NUM);
    if (count($row) !== 0) {
        echo "該帳號已被註冊，3秒後跳轉回註冊頁...";
        header("Refresh:3;url=login_register.php");
        $rs->close();
        exit;
    }
    $rs->close();


    //檢查通過 寫入資料庫
    $insertData = encodeRegisterData($_POST);
    $keys = array_keys($insertData);

    $sqlSetStr = f1($keys);

    $sqlValueStr = f2($keys, $insertData);

    $sql = 'INSERT INTO members ' . $sqlSetStr . ' VALUES ' . $sqlValueStr . ';';

    $result = mysqli_query($conn, $sql);
    if ($result === true) {
        echo "註冊成功，3秒後跳轉回首頁...";
        header("Refresh:3;url=index.php");
    } else {
        echo "發生未預期錯誤...";
    }
    $result->close();
} else {
    echo "註冊資料有誤:\n" . $errorMessage;
}

function f1($ks)
{
    $str = "(";
    foreach ($ks as $v) {
        $str .= $v . ",";
    }
    return substr($str, 0, -1) . ")";
}

;

function f2($ks, $vs)
{
    $str = "(";
    foreach ($ks as $v) {
        $str .= $vs[$v] . ",";
    }
    return substr($str, 0, -1) . ")";
}

;

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
        'id' => "\"zjttw_" . date("YmdHis", time()) . "\"",
        "password" => "\"\"",
        "name" => "\"\"",
        "gender" => "\"\"",
        "level" => "\"\"",
        "referral" => "\"\"",
        "birthday" => "\"\"",
        "email" => "\"\"",
        "phone" => "\"\"",
        "mobile" => "\"\"",
        "company_no" => "\"\"",
        "invoice_title" => "\"\"",
        "city" => "\"\"",
        "area" => "\"\"",
        "address" => "\"\"",
        "constore" => "\"\"",
        "regtime" => "\"" . date("Y-m-d H:i:s", time()) . "\"",
        "verifycode" => "\"\"",
        "verifytime" => "\"0\"",
        "type" => "\"1\"",
        "status" => "\"0\""
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

exit;