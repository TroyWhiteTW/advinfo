<?php


$data = $_POST;
$message = "";

$checkFlag = 1;
if (count($data) != 8) {
    $checkFlag = 0;
}

if (isset($data['name']) == false) {
    $checkFlag = 0;
}
checkSpace("name", $message, "姓名");
checkHasNum("name", $message, "姓名");

if (isset($data['birthday']) == false) {
    $checkFlag = 0;
}
//checkEmpty("birthday", $message, "生日");
checkSpace("birthday", $message, "生日");

if (isset($data['gender']) == false) {
    $checkFlag = 0;
}
checkSpace("gender", $message, "性別");
checkGender("gender", $message, "性別");

if (isset($data['phone']) == false) {
    $checkFlag = 0;
}
checkSpace("phone", $message, "聯繫電話");
checkOnlyNum("phone", $message, "聯繫電話");

if (isset($data['mobile']) == false) {
    $checkFlag = 0;
}
checkEmpty("mobile", $message, "手機");
checkOnlyNum("mobile", $message, "手機");
checkLength("mobile", $message, 10, "手機");
checkSpace("mobile", $message, "手機");

if (isset($data['address']) == false) {
    $checkFlag = 0;
}
checkEmpty("address", $message, "聯繫地址");

if (isset($data['company_no']) == false) {
    $checkFlag = 0;
}

if (isset($data['invoice_title']) == false) {
    $checkFlag = 0;
}

if ($message != "") {
    $checkFlag = 0;
}

if ($checkFlag != 1) {
    echo $message;
} else {
    echo $checkFlag;
}


function checkSpace($k, &$msg, $n)
{
    if (empty($_POST[$k])) {
        return;
    }
    if (preg_match('/\s/', $_POST[$k])) {
        $msg .= "$n 有空白鍵<br>";
    }
}

function checkOnlyNum($k, &$msg, $n)
{
    if (empty($_POST[$k])) {
        return;
    }
    if (preg_match('/[^0-9]/', $_POST[$k])) {
        $msg .= "$n 只能是數字<br>";
    }
}

function checkLength($k, &$msg, $l, $n)
{
    if (empty($_POST[$k])) {
        return;
    }
    if (strlen($_POST[$k]) !== $l) {
        $msg .= "$n 長度不符<br>";
    }
}

function checkHasNum($k, &$msg, $n)
{
    if (empty($_POST[$k])) {
        return;
    }
    if (preg_match('/[0-9]/', $_POST[$k])) {
        $msg .= "$n 不得有數字<br>";
    }
}

function checkEmpty($k, &$msg, $n)
{
    if (empty($_POST[$k])) {
        $msg .= "$n 為空<br>";
    }
}

function checkGender($k, &$msg, $n)
{
    if (empty($_POST[$k])) {
        return;
    }

    if ($_POST[$k] !== "M" && $_POST[$k] !== "F" && $_POST[$k] != "0") {
        $msg .= "$n 錯誤<br>";
    }
}
