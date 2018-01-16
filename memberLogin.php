<?php
include 'db.php';
session_start();

$errorMessage = '';
foreach ($_POST as $k => $v) {
    $_POST[$k] = trim($_POST[$k]);
}
checkData($_POST, $errorMessage);

if (empty($errorMessage)) {

    //檢查驗證碼
    if ($_POST['validate_code'] !== $_SESSION['check_word']) {
        echo 2;
//        echo "驗證碼錯誤，3秒後跳轉回登入頁...";
//        header("Refresh:3;url=login.php");
        exit;
    }

    $insertData = encodeLoginData($_POST);

    switch ($_POST['type']) {
        case 1:
            loginType1($conn, $insertData);
            break;
        case 2:
            // 珍菌堂會員/直銷會員 串接 API
            loginType2($conn, $insertData);
            break;
    }

    exit;
} else {
    echo "登入資料有誤:\n" . $errorMessage;
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

function f3($ks, $vs)
{
    $str = "";
    foreach ($ks as $v) {
        $str .= $v . "=" . $vs[$v] . ",";
    }
    return substr($str, 0, -1);
}

function checkData($post, &$msg)
{
    foreach ($post as $k => $v) {
        switch ($k) {
            case 'email':
                checkEmpty($k, $msg);
                checkSpace($k, $msg);
                if ($post["type"] == "1") {
                    chechEmail($k, $msg);
                }
                break;
            case 'password':
                checkEmpty($k, $msg);
                checkSpace($k, $msg);
                if ($post["type"] == "1") {
                    chechLengthBetweenTwoValue($k, $msg, 20, 8);
                    checkOneEngAndOneNum($k, $msg);
                }
                break;
            case 'type':
                checkEmpty($k, $msg);
                checkSpace($k, $msg);
                checkType($k, $msg);
                break;
            case 'validate_code':
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

function encodeLoginData($rawDataArray)
{
    $dataArray = [
        "email" => "\"\"",
        "password" => "\"\"",
        "type" => "\"\"",
    ];

    foreach ($dataArray as $k => $v) {
        if (!empty($rawDataArray[$k])) {
            $dataArray[$k] = "\"" . $rawDataArray[$k] . "\"";
        }
    }
    return $dataArray;
}

function encodeRegisterData($rawDataArray, $apiData)
{
    $dataArray = [
        'id' => "\"zjttw_" . date("YmdHis", time()) . "\"",
        "password" => "\"\"",
        "name" => "\"$apiData->MemberName\"",
        "gender" => "\"\"",
        "level" => "\"$apiData->MemberClass\"",
        "levelname" => "\"$apiData->ClassName\"",
        "referral" => "\"\"",
        "birthday" => "\"\"",
        "email" => "\"\"",
        "phone" => "\"$apiData->MbCellTel\"",
        "mobile" => "\"\"",
        "company_no" => "\"\"",
        "invoice_title" => "\"\"",
        "city" => "\"\"",
        "area" => "\"\"",
        "address" => "\"$apiData->RecAddress\"",
        "constore" => "\"\"",
        "bonuscoin" => "\"$apiData->BonusCoin\"",
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

function encodeUpdateData($rawDataArray, $apiData)
{
    $dataArray = [
        "name" => "\"$apiData->MemberName\"",
        "level" => "\"$apiData->MemberClass\"",
        "levelname" => "\"$apiData->ClassName\"",
        "phone" => "\"$apiData->MbCellTel\"",
//        "city" => "\"\"",
//        "area" => "\"\"",
        "address" => "\"$apiData->RecAddress\"",
        "bonuscoin" => "\"$apiData->BonusCoin\"",
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

function loginType1($conn, $insertData)
{
    $sql = 'SELECT * FROM members WHERE email=' . $insertData['email'] . ' AND type=' . $insertData['type'];

    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs, MYSQLI_NUM);

    $rs2 = mysqli_query($conn, $sql);
    $row2 = mysqli_fetch_assoc($rs2);

    if ($row2['email'] === $_POST['email'] && password_verify($_POST['password'], $row2['password'])) {

        //SESSION 設定
        $_SESSION['user'] = $row;
        $_SESSION['user2'] = $row2;

        //常用取貨便利商店資料(要unerialize)
        $_SESSION['user2']['constore'] = unserialize($row2["constore"]);

        echo 1;
        //        echo "登入成功，3秒後跳轉回首頁...";
        //        header("Refresh:3;url=index.php");
        //        header('Location:index.php');
    } else {
        echo 0;
        //        echo "帳號或密碼錯誤，3秒後跳轉回登入頁...";
        //        header("Refresh:3;url=login.php");
    }
    $rs->close();
    $rs2->close();
}

function loginType2($conn, $insertData)
{
    $ClienIP = $_SERVER['REMOTE_ADDR'];
    $MemberNo = $_POST['email'];
    $MbPassword = $_POST['password'];
    $Timestemp = time();
    $secString1 = 've6t5io371tqda8';
    $secString2 = '49dqf1gyuk1y2jr';
    $Token = MD5($ClienIP . $MemberNo . $Timestemp . $MbPassword . $secString1) .
        substr(MD5($ClienIP . $MemberNo . $Timestemp . $MbPassword . $secString2), 0, 8);

    $url = "https://api.zjt-taiwan.com/API/MemberLogin";
//            $url = "https://www.google.com";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
//            curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(
        array(
            'MemberNo' => $MemberNo,
            'MbPassword1' => $MbPassword,
            'Ip' => $ClienIP,
            'LoginTime' => $Timestemp,
            'Token' => $Token,
        )
    ));
    if ($output = curl_exec($ch)) {
//                echo $output;
        $apiRes = json_decode($output);
        if ($apiRes === null) {
            echo 'decode fail';
        } else {
            switch ($apiRes->RetVal) {
                case 0://執行成功
                    $checkSql = 'SELECT * FROM members WHERE email=' . $insertData['email'] . ' AND type=' . $insertData['type'];

                    $checkRes = mysqli_query($conn, $checkSql);
                    $checkRow = mysqli_fetch_assoc($checkRes);

                    if ($checkRow === null) {
                        //insert
                        $data = encodeRegisterData($_POST, $apiRes);
                        $keys = array_keys($data);
                        $sqlSetStr = f1($keys);
                        $sqlValueStr = f2($keys, $data);
                        $insertSql = 'INSERT INTO members ' . $sqlSetStr . ' VALUES ' . $sqlValueStr . ';';
                        $result = mysqli_query($conn, $insertSql);
                        if ($result === true) {

                        } else {
                            echo "發生未預期錯誤...";
                        }
                    } else if ($checkRow['email'] === $_POST['email'] && password_verify($_POST['password'], $checkRow['password'])) {
                        //update
                        $data = encodeUpdateData($_POST, $apiRes);
                        $keys = array_keys($data);
                        $sqlStr = f3($keys, $data);
                        $updateSql = 'UPDATE members SET ' . $sqlStr . ' WHERE email=' . $insertData['email'];
                        $result = mysqli_query($conn, $updateSql);
                        if ($result === true) {

                        } else {
                            echo "發生未預期錯誤...";
                        }
                    } else {
                        echo 0;
                        //        echo "帳號或密碼錯誤，3秒後跳轉回登入頁...";
                        //        header("Refresh:3;url=login.php");
                        exit;
                    }

                    $sql = 'SELECT * FROM members WHERE email=' . $insertData['email'] . ' AND type=' . $insertData['type'];

                    $rs = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($rs, MYSQLI_NUM);

                    $rs2 = mysqli_query($conn, $sql);
                    $row2 = mysqli_fetch_assoc($rs2);

                    //SESSION 設定
                    $_SESSION['user'] = $row;
                    $_SESSION['user2'] = $row2;

                    //常用取貨便利商店資料(要unerialize)
                    $_SESSION['user2']['constore'] = unserialize($row2["constore"]);

                    //多埋一個password放登入密碼，串API會用到
                    $_SESSION['user2']['password1'] = $_POST['password'];

                    echo 1;
                    break;
                case 1://帳號或密碼不正確
//                    var_dump($apiRes);
                    echo 0;
                    break;
                case 2://帳號未激活
//                    var_dump($apiRes);
                    break;
                case 3://帳號已凍結
//                    var_dump($apiRes);
                    echo '帳號已凍結或停用';
                    break;
                case 99://Token錯誤
//                    var_dump($apiRes);
                    break;
            }
        }

    } else {
        echo 'curl fail';
    }

    curl_close($ch);
}