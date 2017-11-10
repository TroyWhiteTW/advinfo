<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);
?>
<?php
require __DIR__ . '/OrdersDAO.php';

/** @var OrdersDAO $orders */
$orders = unserialize($_SESSION['orders']);

//(POST) 訂購人資料
$orders->sub_account = '';
$orders->sub_name = '';
$orders->sub_level = '';
$orders->sub_phone = '';
$orders->sub_mobile = '';
$orders->sub_email = '';
$orders->sub_address = '';

//(POST) 收件人資料
$orders->rec_name = '';
$orders->rec_phone = '';
$orders->rec_mobile = '';
$orders->rec_email = '';
$orders->rec_zip = '';
$orders->rec_city = '';
$orders->rec_area = '';
$orders->rec_address = '';

//(POST) 取貨門市
$orders->store_name = '';
$orders->store_addr = '';

$_SESSION['orders'] = serialize($orders);

//echo $orders->ordid;
//echo '<hr/>';

// 跳轉到 cart_3.php
header('Location:cart_3.php');
exit;
