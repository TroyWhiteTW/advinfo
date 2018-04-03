<?php
include 'db.php';
session_start();

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

    //判斷推薦碼是否正確(存在此推薦碼)，若有，則將此推薦碼 寫在 註冊會員資料的 referral 欄位
    $checkReferralExistSql = 'SELECT * FROM members WHERE myreferral=' . "\"" . $_POST['referral'] . "\"";
    $checkReferralExistRes = mysqli_query($conn, $checkReferralExistSql);
    $checkReferralExistRow = mysqli_fetch_assoc($checkReferralExistRes);
    if ($checkReferralExistRow == null) {
        $_POST['referral'] = '';
    }
    $checkReferralExistRes->close();

    //檢查通過 寫入資料庫
    $insertData = encodeRegisterData($_POST);
    $keys = array_keys($insertData);

    $sqlSetStr = f1($keys);

    $sqlValueStr = f2($keys, $insertData);

    $sql = 'INSERT INTO members ' . $sqlSetStr . ' VALUES ' . $sqlValueStr . ';';

    $result = mysqli_query($conn, $sql);
    if ($result === true) {

        //當商城會員註冊時要一併產生寫入資料表 myreferral 欄位
        $Directory = "23456789abcdefghjkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ";
        $rs2 = mysqli_query($conn, "SELECT * FROM members WHERE myreferral='' OR myreferral IS NULL");
        while ($rst = mysqli_fetch_assoc($rs2)) {
            $MyReferral = "";
            for ($i = 1; $i <= 8; $i++) {
                $MyReferral .= substr($Directory, rand(0, strlen($Directory)), 1);
            }
            mysqli_query($conn, "UPDATE members SET myreferral='" . $MyReferral . "' WHERE id='" . $rst["id"] . "'");
        }

        //參考test.php 裡的 findReferral function，主要是遞迴往上找出推薦者的推薦者，會產生insert資料到推薦表(recommendmap)的sql語法
        if ($_POST['referral'] != "") {
            foreach (explode(";", findReferral("zjttw_" . substr($insertData['id'], 1, -1), $_POST['referral'], 1)) as $recommendmapSql) {
                $recommendmapRes = mysqli_query($conn, $recommendmapSql);
            }
        }

        send2Mail($_POST['email'], 'service mail', '');
        echo "註冊成功，請至您的電子信箱點擊驗證連結，以使用更多會員功能！\n3秒後跳轉回首頁...";
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
//                chechEmail($k, $msg);
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
        "referral" => "\"admin\"",
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
        "status" => "\"9\""
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

function send2Mail($towhom, $title, $mesg)
{
    $to = 'service@taironlife.com';
    $subject = $title;
    $link = 'http://advinfo.taironlife.com/registerEmail.php?email=' . $_POST['email'] . '&hash_key=' . password_hash($_POST['email'], PASSWORD_DEFAULT);
    $message = '請點擊連結驗證您的電子信箱！<br/><a href="' . $link . '">' . $link . '</a>';
    $headers = 'From:  ' . 'service@taironlife.com' . "\r\n" .
        'Reply-To:  service@taironlife.com' . "\r\n" .
        'MIME-Version: 1.0' . "\r\n" .
        'Content-type:text/html;charset=UTF-8' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    mail($towhom, $subject, $message, $headers);
}

function findReferral($memid, $referral, $level)
{
    global $conn;

    $sql = "SELECT * FROM members WHERE myreferral='" . $referral . "'";
    $rs = mysqli_query($conn, $sql);
    while ($rst = mysqli_fetch_assoc($rs)) {
        if ($rst["referral"] != "" && $level < 13) {
            $referral_sql = findReferral($memid, $rst["referral"], $level + 1);
        }
    }

    return $referral_sql .
        "INSERT INTO recommendmap(memid, referral, leveldiff, addtime, updatetime) VALUES('" . $memid . "','" . $referral . "','" . ($level) . "',NOW(),NOW());";
}

exit;