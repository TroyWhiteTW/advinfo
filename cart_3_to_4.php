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

$orders->pay_time = date('Y-m-d H:i:s', time());
$orders->appredate = '0000-00-00 00:00:00';
$orders->total_price = 0;
$orders->freight = 0;
$orders->PV = 0;
$orders->bonuce = 0;
$orders->ordstatus = 0;
$orders->shipstatus = 0;
$orders->shiptime = '0000-00-00 00:00:00';
$orders->addtime = date('Y-m-d H:i:s', time());
$orders->updatetime = date('Y-m-d H:i:s', time());
$orders->returnapply = '0000-00-00 00:00:00';
$orders->returntime = '0000-00-00 00:00:00';
$orders->refundtime = '0000-00-00 00:00:00';

//for transition
$mysqli = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);
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
    $orderDetail->odno = getMaxOdno(@$conn) + 1;
    $orderDetail->proname = '';
    $orderDetail->proid = $k;
    $orderDetail->qty = $v;
    $orderDetail->price = 0;
    $orderDetail->subtotal = 0;
    $orderDetail->PV = 0;
    $orderDetail->bonuce = 0;

    $orderDetail->save(@$mysqli, @$errors);
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

function getMaxOdno($conn)
{
    $rData = mysqli_query($conn, 'SELECT MAX(odno) as maxOdno FROM orderdetail;');
    $r = mysqli_fetch_assoc($rData);
    return intval($r['maxOdno']);
}
exit;
