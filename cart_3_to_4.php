<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);
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

$orders->save($conn);

foreach ($_SESSION['shop_cart'] as $k => $v) {
    $orderDetail = new OrderDetailDAO();

    $orderDetail->ordid = $orders->ordid;
    $orderDetail->odno = $k;
    $orderDetail->proname = '';
    $orderDetail->proid = $k;
    $orderDetail->qty = $v;
    $orderDetail->price = 0;
    $orderDetail->subtotal = 0;
    $orderDetail->PV = 0;
    $orderDetail->bonuce = 0;

    $orderDetail->save($conn);
}

// unset $_SESSION['orders']

// 跳轉到 cart_4.php
header('Location:cart_4.php');
exit;