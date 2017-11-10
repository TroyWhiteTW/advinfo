<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);
?>
<?php
require __DIR__ . '/OrdersDAO.php';

/** @var OrdersDAO $orders */
$orders = unserialize($_SESSION['orders']);

//設定訂單 orders id date
$orders->ordid = time();
$orders->orddate = date('Y-m-d', time());
//(POST) 配送方式
$orders->ship_no = 0;
//(POST) 折扣方式
$orders->discount = '';
$orders->discount_price = 0;
//(POST) 付款方式
$orders->pay_no = 0;
$orders->pay_price = 0;
$orders->ispay = 0;
$orders->installment = 0;
//(POST) 發票資訊
$orders->invoice = '';
$orders->company_no = '';
$orders->invoice_title = '';

$_SESSION['orders'] = serialize($orders);

//echo $orders->ordid;
//echo '<hr/>';

// 跳轉到 cart_2.php
header('Location:cart_2.php');
exit;