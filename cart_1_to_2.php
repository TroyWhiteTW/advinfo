<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);
if (!$isLogin) {
    header('Location:index.php');
    exit;
}
if(!preg_match("/cart_1.php$/",$_SERVER['HTTP_REFERER'])){
    header('Location:index.php');
    exit;
}
?>
<?php
require __DIR__ . '/OrdersDAO.php';

$errorMessage = "";
foreach ($_POST as $k => $v) {
    $_POST[$k] = trim($_POST[$k]);
}
//checkData($_POST, $errorMessage);

//var_dump($_POST);
//return;

/** @var OrdersDAO $orders */
$orders = unserialize($_SESSION['orders']);

//設定訂單 orders id date
$orders->ordid = time();
$orders->orddate = date('Y-m-d', time());
//(POST) 配送方式
$orders->ship_no = $_POST['ship_no'];
//(POST) 折扣方式
$orders->discount = $_POST['discount'];
$orders->discount_price = $_POST['discount_price'];
//(POST) 付款方式
$orders->pay_no = $_POST['pay_no'];
$orders->pay_price = 0;
$orders->ispay = 0;
$orders->installment = 0;
//(POST) 發票資訊
$orders->invoice = $_POST['invoice'];
$orders->company_no = $_POST['company_no'];
$orders->invoice_title = $_POST['invoice_title'];

$_SESSION['orders'] = serialize($orders);

//echo $orders->ordid;
//echo '<hr/>';

// 跳轉到 cart_2.php
header('Location:cart_2.php');
exit;