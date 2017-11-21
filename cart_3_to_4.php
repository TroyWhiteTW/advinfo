<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);
if (!$isLogin) {
    header('Location:index.php');
    exit;
}
if (!preg_match("/cart_3.php$/", $_SERVER['HTTP_REFERER'])) {
    header('Location:index.php');
    exit;
}
?>
<?php
require __DIR__ . '/OrdersDAO.php';
require __DIR__ . '/OrderDetailDAO.php';

/** @var OrdersDAO $orders */
$orders = unserialize($_SESSION['orders']);

//完成付款
if ($_POST["buysafeno"] != "" && $_POST["web"] != "" && $_POST["Td"] == $orders->ordid) {
    if ($_POST["errcode"] != "00") {        //00 (數字 )表交易成功。其餘失敗！
        exit('<script>alert("交易失敗: ' . $_POST["errmsg"] . '"); location.href="cart3.php";</script>');
    }

    $orders->pay_time = date('Y-m-d H:i:s', time());
    $orders->appredate = '0000-00-00 00:00:00';
    //$orders->total_price = 0;
    //$orders->freight = 0;
    //$orders->PV = 0;
    //$orders->bonuce = 0;
    $orders->ordstatus = 0;
    $orders->shipstatus = 0;
    $orders->shiptime = '0000-00-00 00:00:00';
    $orders->addtime = date('Y-m-d H:i:s', time());
    $orders->updatetime = date('Y-m-d H:i:s', time());
    $orders->returnapply = '0000-00-00 00:00:00';
    $orders->returntime = '0000-00-00 00:00:00';
    $orders->refundtime = '0000-00-00 00:00:00';

    //金流回來的資訊
    $orders->cardno = $_POST["Card_NO"];
    $orders->approvecode = $_POST["ApproveCode"];
    $orders->moneyflow_no = $_POST["buysafeno"];

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

    if (empty($errors)) {

        //無錯誤 所有資料寫入成功
        $mysqli->commit();

        unset($_SESSION['orders']);
        unset($_SESSION['shop_cart']);
        header('Location:cart_4.php');

    } else {
        //有錯誤
        $mysqli->rollback();
        var_dump($errors);
        //    header('Location:cart_4.php');
    }

    //
    // 跳轉到 cart_4.php
    $mysqli->close();
    //header('Location:cart_4.php');
} else {
    $item = array();
    foreach ($_SESSION['shop_cart'] as $proid => $qty) {
        $sql = 'SELECT proname,price,PV,bonuce FROM products WHERE proid=\'' . $proid . '\'';
        $rs = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($rs);
        $item[] = $row['proname'];
    }

    //分期
    $Term = "";

    //訂單金額與檢查碼
    $total = $orders->total_price + $orders->freight;
    $ChkValue = strtoupper(sha1('S1708259161' . '1qazxsw2' . (int)$total));   //檢查碼
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
		</form>
		<script>
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

exit;
