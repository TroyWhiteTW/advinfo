<?php
include 'db.php';
session_start();
//$isLogin = !empty($_SESSION['user']);
if (empty($_SESSION['user']) || empty($_SESSION['orders'])) {
    header('Location:index.php');
    exit;
}

//可能從金流轉回來，所以這邊判斷先註解了
if (!preg_match("/cart_3.php$/", $_SERVER['HTTP_REFERER'])) {
    //header('Location:index.php');
    //exit;
}

require __DIR__ . '/OrdersDAO.php';
require __DIR__ . '/OrderDetailDAO.php';

/** @var OrdersDAO $orders */
$orders = unserialize($_SESSION['orders']);

// 配送方式
$shiptype = [];
$shiptypesSql = 'SELECT shiptypes.no, shiptypes.name, shiptypes.type, logistics.name AS logname, shippings.* FROM shiptypes 
										LEFT JOIN shippings ON shiptypes.no=shippings.shiptype 
										LEFT JOIN logistics ON logistics.no=shippings.logno
										WHERE shippings.status=1 AND shippings.forSupplier=1';
$shiptypesRes = mysqli_query($conn, $shiptypesSql);
while ($shiptypesRow = mysqli_fetch_assoc($shiptypesRes)) {
    //$shiptypes[] = $shiptypesRow;
    if ($shiptypesRow["no"] == $orders->ship_no) {
        $shiptype = $shiptypesRow;
    }
}

// 付款方式
$payment = [];
$paymentsSql = 'SELECT * FROM payments WHERE status=1 AND forSupplier=1 ORDER BY type DESC,installment';
$paymentsRes = mysqli_query($conn, $paymentsSql);
while ($paymentsRow = mysqli_fetch_assoc($paymentsRes)) {
    //$payments[] = $paymentsRow;
    if ($paymentsRow["no"] == $orders->pay_no) {
        $payment = $paymentsRow;
    }
}

//完成付款
if ($_POST["buysafeno"] != "" && $_POST["web"] != "" && $_POST["Td"] == $orders->ordid) {
    if ($_POST["errcode"] != "00") {        //00 (數字 )表交易成功。其餘失敗！
        exit('<script>alert("交易失敗: ' . $_POST["errmsg"] . '"); location.href="cart3.php";</script>');
    }

    //$orders->sub_account = $_SESSION["user2"]["id"];
    //$orders->sub_level = $_SESSION["user2"]["level"];
    $orders->pay_time = date('Y-m-d H:i:s', time());
    $orders->pay_price = $orders->total_price + $orders->freight - $orders->discount_price;
    //$orders->total_price = 0;
    //$orders->freight = 0;
    //$orders->PV = 0;
    //$orders->bonuce = 0;
    $orders->ordstatus = 0;
    $orders->shipstatus = 0;
    $orders->appredate = '0000-00-00 00:00:00';
    $orders->shiptime = '0000-00-00 00:00:00';
    $orders->addtime = date('Y-m-d H:i:s', time());
    $orders->updatetime = date('Y-m-d H:i:s', time());
    $orders->returnapply = '0000-00-00 00:00:00';
    $orders->returntime = '0000-00-00 00:00:00';
    $orders->refundtime = '0000-00-00 00:00:00';

    $sql = "SELECT shippings.*,logistics.name AS logname FROM shippings 
            LEFT JOIN logistics ON logistics.no=shippings.logno WHERE shippings.no='$orders->ship_no'";
    $rs = mysqli_query($conn, $sql);
    $rst = mysqli_fetch_assoc($rs);

    if ($rst["logname"] == "便利達康" && $orders->ship_no == "2") {
        $orders->constore = serialize($_SESSION['user2']['constore']);
    }

    //金流回來的資訊
    $orders->cardno = $_POST["Card_NO"];
    $orders->approvecode = $_POST["ApproveCode"];
    $orders->moneyflow_no = $_POST["buysafeno"];
    $orders->ispay = 1;   //已付款

    //訂單請求API
    if ($_SESSION['user2']['type'] == 2) {
        if (orderApply($orders->ordid, $orders->total_price, $orders->total_price + $orders->freight, $orders->PV, $orders->discount_price, $orders->orddate) == 0) {

        } else {
            exit('<script>alert("電子錢包折抵失敗"); location.href="cart3.php";</script>');
        }
    }

    //for transition
    $odno = getMaxOdno($conn);

    $mysqli = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);
    mysqli_set_charset($mysqli, "UTF8");
    $errors = [];
    if ($mysqli->connect_errno) {
        echo "Sorry, this website is experiencing problems.";
        echo "Error: Failed to make a MySQL connection, here is why: \n";
        echo "Errno: " . $mysqli->connect_errno . "\n";
        echo "Error: " . $mysqli->connect_error . "\n";
        exit;
    }

    $mysqli->autocommit(false);
    $orders->save(@$mysqli, @$errors);

    //訂單子表
    foreach ($_SESSION['shop_cart'] as $k => $v) {
        $orderDetail = new OrderDetailDAO();

        $orderDetail->ordid = $orders->ordid;
        //    $orderDetail->odno = $odno++;
        //    $orderDetail->proname = '';
        $orderDetail->proid = $k;
        $orderDetail->qty = $v;
        //    $orderDetail->price = 0;
        //    $orderDetail->subtotal = 0;
        //    $orderDetail->PV = 0;
        //    $orderDetail->bonuce = 0;

        $orderDetail->save(@$mysqli, @$errors, ++$odno, @$conn);
    }

    $mergeSupp = [];
    foreach ($_SESSION['shop_cart'] as $k => $v) {
        $searchSuppSql = "SELECT suppid FROM products WHERE proid = '$k'";
        $searchSuppRes = mysqli_query($conn, $searchSuppSql);
        $searchSuppRow = mysqli_fetch_assoc($searchSuppRes);
        $mergeSupp[$searchSuppRow['suppid']][] = [$k => $v];
    }
    ksort($mergeSupp);

    $tempArray = [];
    foreach ($mergeSupp as $k => $v) {
        foreach ($v as $vv) {
            $tempArray[] = [$k => $vv];
        }
    }

    $mergeSupp = $tempArray;
//var_dump($mergeSupp);return;
    $c = count($mergeSupp);

    $suppid = 0;
//    $pay_price=0;
    $total_price = 0;
    $PV = 0;
    $bonuce = 0;

    for ($i = 0; $i < $c; $i++) {
        $k = array_keys($mergeSupp[$i])[0];
        $v = array_values($mergeSupp[$i])[0];

        if ($suppid === 0) {

            $suppid = $k;
//            $pay_price=0;
            $total_price = 0;
            $PV = 0;
            $bonuce = 0;

            $item1 = array_keys($v)[0];
            $item2 = array_values($v)[0];

            $sql78 = "SELECT * FROM products WHERE proid='$item1'";
            $result78 = mysqli_query($conn, $sql78);
            $row78 = mysqli_fetch_assoc($result78);
            $total_price += ($row78['price'] * $item2);
            $PV += ($row78['PV'] * $item2);
            $bonuce += ($row78['bonuce'] * $item2);

        } else if ($k === $suppid) {

            $item1 = array_keys($v)[0];
            $item2 = array_values($v)[0];

            $sql78 = "SELECT * FROM products WHERE proid='$item1'";
            $result78 = mysqli_query($conn, $sql78);
            $row78 = mysqli_fetch_assoc($result78);
            $total_price += ($row78['price'] * $item2);
            $PV += ($row78['PV'] * $item2);
            $bonuce += ($row78['bonuce'] * $item2);

        } else if ($k !== $suppid) {

            $sql5566 = "INSERT INTO supporders (ordid,orddate,suppid,discount,discount_price,pay_no,pay_price,ispay,installment,total_price,freight,PV,bonuce,profit)
 VALUES ('$orders->ordid','$orders->orddate','$suppid','$orders->discount','$orders->discount_price','$orders->pay_no','$orders->pay_price','$orders->ispay','$orders->installment','$total_price','$orders->freight','$PV','$bonuce','0');";

            $result5566 = $mysqli->query($sql5566);
            if ($result5566 === true) {
                echo '5566得第一';

                $suppid = $k;
//            $pay_price=0;
                $total_price = 0;
                $PV = 0;
                $bonuce = 0;

                $item1 = array_keys($v)[0];
                $item2 = array_values($v)[0];

                $sql78 = "SELECT * FROM products WHERE proid='$item1'";
                $result78 = mysqli_query($conn, $sql78);
                $row78 = mysqli_fetch_assoc($result78);
                $total_price += ($row78['price'] * $item2);
                $PV += ($row78['PV'] * $item2);
                $bonuce += ($row78['bonuce'] * $item2);

            } else {
                echo '5566不能亡';
            }

        }

        if ($i + 1 == $c) {
            $sql5566 = "INSERT INTO supporders (ordid,orddate,suppid,discount,discount_price,pay_no,pay_price,ispay,installment,total_price,freight,PV,bonuce,profit)
 VALUES ('$orders->ordid','$orders->orddate','$suppid','$orders->discount','$orders->discount_price','$orders->pay_no','$orders->pay_price','$orders->ispay','$orders->installment','$total_price','$orders->freight','$PV','$bonuce','0');";

            $result5566 = $mysqli->query($sql5566);
            if ($result5566 === true) {
                echo '5566得第一';

            } else {
                echo '5566不能亡';
            }
        }

    }

    if (empty($errors)) {

        //無錯誤 所有資料寫入成功
        $mysqli->commit();

        //訂單確認API
        if ($_SESSION['user2']['type'] == 2) {
            if (orderConfirm($orders->ordid, $orders->total_price, $orders->pay_no, $orders->pay_price, $orders->ispay == 1 ? 'Y' : 'N', $orders->pay_time) == 0) {

            } else {
                //error
            }
        }

        unset($_SESSION['orders']);
        unset($_SESSION['shop_cart']);
        header('Location:cart_4.php');

    } else {
        //有錯誤
        $mysqli->rollback();
        var_dump($errors);
        //    header('Location:cart_4.php');
    }

    // 跳轉到 cart_4.php
    $mysqli->close();
    //header('Location:cart_4.php');
} else {
    //先產生金流表單
    $item = array();
    foreach ($_SESSION['shop_cart'] as $proid => $qty) {
        $sql = "SELECT proname,price,PV,bonuce FROM products WHERE proid='$proid'";
        $rs = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($rs);
        $item[] = $row['proname'];
    }

    //訂單金額與檢查碼
    $total = $orders->total_price + $orders->freight - $orders->discount_price;

    if ($payment["type"] == "C") {        //刷卡
        //分期
        $Term = "";
        if ($payment["installment"] > 0) {
            $Term = $payment["installment"];
        }

        //檢查碼
        $ChkValue = strtoupper(sha1('S1708259161' . '1qazxsw2' . (int)$total . $Term));

        echo '
			<form name="form1" method="post" action="https://test.esafe.com.tw/Service/Etopm.aspx">
			<input type="hidden" name="web" value="S1708259161">
			<input type="hidden" name="MN" value="' . $total . '">
			<input type="hidden" name="OrderInfo" value="' . implode(",", $item) . '">
			<input type="hidden" name="Td" value="' . $orders->ordid . '">
			<input type="hidden" name="sna" value="' . $orders->sub_name . '">
			<input type="hidden" name="sdt" value="' . $orders->sub_mobile . '">
			<input type="hidden" name="email" value="' . $orders->sub_email . '">
			<input type="hidden" name="Card_Type" value="0">
			<input type="hidden" name="Term" value="' . $Term . '">
			<input type="hidden" name="ChkValue" value="' . $ChkValue . '">
			</form>';
    } elseif ($payment["type"] == "A") {        //WebATM
        $ChkValue = strtoupper(sha1('S1708259187' . '1qazxsw2' . (int)$total));   //檢查碼
        echo '
			<form name="form1" method="post" action="https://test.esafe.com.tw/Service/Etopm.aspx">
			<input type="hidden" name="web" value="S1708259187">
			<input type="hidden" name="MN" value="' . $total . '">
			<input type="hidden" name="OrderInfo" value="' . implode(",", $item) . '">
			<input type="hidden" name="Td" value="' . $orders->ordid . '">
			<input type="hidden" name="sna" value="' . $orders->sub_name . '">
			<input type="hidden" name="sdt" value="' . $orders->sub_mobile . '">
			<input type="hidden" name="email" value="' . $orders->sub_email . '">
			<input type="hidden" name="ChkValue" value="' . $ChkValue . '">
			</form>';
    }

    echo '<script>
			document.form1.submit();
		</script>';
    exit;
}

function getMaxOdno($conn)
{
    $rData = mysqli_query($conn, 'SELECT MAX(odno) as maxOdno FROM orderdetail;');
    $r = mysqli_fetch_assoc($rData);
    $rData->close();
    return intval($r['maxOdno']);
}

function orderApply($OrderNo, $OrderAmount, $TotalAmount, $PvValue, $DiscountCoin, $OrderTime)
{
    $ClienIP = $_SERVER['REMOTE_ADDR'];
    $MemberNo = $_SESSION['user2']['email'];
    $MbPassword = $_SESSION['user2']['password2'];
    $Timestemp = time();
    $secString1 = 've6t5io371tqda8';
    $secString2 = '49dqf1gyuk1y2jr';
    $Token = MD5($ClienIP . $MemberNo . $Timestemp . $MbPassword . $secString1) .
        substr(MD5($ClienIP . $MemberNo . $Timestemp . $MbPassword . $secString2), 0, 8);

    $url = "https://api.zjt-taiwan.com/API/OrderApply";
//            $url = "https://www.google.com";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
//            curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'MemberNo' => $MemberNo,
        'MbPassword2' => $MbPassword,
        'OrderNo' => $OrderNo,
        'OrderAmount' => $OrderAmount,
        'TotalAmount' => $TotalAmount,
        'PvValue' => $PvValue,
        'DiscountCoin' => $DiscountCoin,
        'OrderTime' => $OrderTime,
        'Ip' => $ClienIP,
        'Token' => $Token,
    ]));
    if ($output = curl_exec($ch)) {
//                echo $output;
        $apiRes = json_decode($output);
        if ($apiRes === null) {
            return 'decode fail';
        } else {
            switch ($apiRes->RetVal) {
                case 0://執行成功
                    $sql = "UPDATE members SET bonuscoin=$apiRes->BonusCoin WHERE id='{$_SESSION['user2']['id']}'";
                    global $conn;
                    $result = mysqli_query($conn, $sql);
                    if ($result === true) {

                        $newSql = "SELECT * FROM members WHERE email='{$_SESSION['user2']['email']}'";
                        $rs = mysqli_query($conn, $newSql);
                        $newRow = mysqli_fetch_array($rs, MYSQLI_NUM);;
                        unset($_SESSION['user']);
                        $_SESSION['user'] = $newRow;

                        $rs2 = mysqli_query($conn, $newSql);
                        $row2 = mysqli_fetch_assoc($rs2);
                        unset($_SESSION['user2']);
                        $_SESSION['user2'] = $row2;
                        $_SESSION['user2']['constore'] = unserialize($row2['constore']);

                    } else {
                        echo "發生未預期錯誤...";
                    }
                    return 0;
                    break;
                case 1://帳號或密碼不正確
//                    var_dump($apiRes);
                    return 1;
                    break;
                case 2://帳號未激活
//                    var_dump($apiRes);
                    return 2;
                    break;
                case 3://帳號已凍結
//                    var_dump($apiRes);
                    return 3;
                    break;
                case 4://付款方式錯誤
//                    var_dump($apiRes);
                    return 4;
                    break;
                case 5://訂單編號重複
//                    var_dump($apiRes);
                    return 5;
                    break;
                case 6://變更會員帳戶時發生錯誤
//                    var_dump($apiRes);
                    return 6;
                    break;
                case 7://新增訂單鍵值重複
//                    var_dump($apiRes);
                    return 7;
                    break;
                case 8://新增訂單鍵值未對應正確
//                    var_dump($apiRes);
                    return 8;
                    break;
                case 99://Token錯誤
//                    var_dump($apiRes);
                    return 99;
                    break;
                default:
                    return '';
                    break;
            }
        }

    } else {
        return 'curl fail';
    }
}

function orderConfirm($OrderNo, $OrderAmount, $PaymentType, $PaymentAmount, $PaymentStatus, $PaymentTime)
{
    $ClienIP = $_SERVER['REMOTE_ADDR'];
    $MemberNo = $_SESSION['user2']['email'];
    $MbPassword = $_SESSION['user2']['password2'];
    $Timestemp = time();
    $secString1 = 've6t5io371tqda8';
    $secString2 = '49dqf1gyuk1y2jr';
    $Token = MD5($ClienIP . $MemberNo . $Timestemp . $MbPassword . $secString1) .
        substr(MD5($ClienIP . $MemberNo . $Timestemp . $MbPassword . $secString2), 0, 8);

    $url = "https://api.zjt-taiwan.com/API/OrderConfirm";
//            $url = "https://www.google.com";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
//            curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'MemberNo' => $MemberNo,
        'OrderNo' => $OrderNo,
        'OrderAmount' => $OrderAmount,
        'PaymentType' => $PaymentType,
        'PaymentAmount' => $PaymentAmount,
        'PaymentStatus' => $PaymentStatus,
        'PaymentTime' => $PaymentTime,
        'MbPassword2' => $MbPassword,
        'Ip' => $ClienIP,
        'Token' => $Token,
    ]));
    if ($output = curl_exec($ch)) {
//                echo $output;
        $apiRes = json_decode($output);
        if ($apiRes === null) {
            return 'decode fail';
        } else {
            switch ($apiRes->RetVal) {
                case 0://執行成功
                    return 0;
                    break;
                case 1://帳號或密碼不正確
//                    var_dump($apiRes);
                    return 1;
                    break;
                case 2://帳號未激活
//                    var_dump($apiRes);
                    return 2;
                    break;
                case 3://帳號已凍結
//                    var_dump($apiRes);
                    return 3;
                    break;
                case 4://付款方式錯誤
//                    var_dump($apiRes);
                    return 4;
                    break;
                case 5://訂單編號重複
//                    var_dump($apiRes);
                    return 5;
                    break;
                case 6://變更會員帳戶時發生錯誤
//                    var_dump($apiRes);
                    return 6;
                    break;
                case 7://新增訂單鍵值重複
//                    var_dump($apiRes);
                    return 7;
                    break;
                case 8://新增訂單鍵值未對應正確
//                    var_dump($apiRes);
                    return 8;
                    break;
                case 99://Token錯誤
//                    var_dump($apiRes);
                    return 99;
                    break;
                default:
                    return '';
                    break;
            }
        }

    } else {
        return 'curl fail';
    }
}

exit;
