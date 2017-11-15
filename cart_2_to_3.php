<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);
if (!$isLogin) {
    header('Location:index.php');
    exit;
}
if(!preg_match("/cart_2.php$/",$_SERVER['HTTP_REFERER'])){
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

//(POST) 訂購人資料
$orders->sub_account = $_SESSION['user'][7];
$orders->sub_name = $_POST['sub_name'];
$orders->sub_level = $_SESSION['user'][4];
$orders->sub_phone = $_POST['sub_phone'];
$orders->sub_mobile = $_POST['sub_mobile'];
$orders->sub_email = $_POST['sub_email'];
$orders->sub_address = $_POST['sub_address'];

//(POST) 收件人資料
$orders->rec_name = $_POST['rec_name'];
$orders->rec_phone = $_POST['rec_phone'];
$orders->rec_mobile = $_POST['rec_mobile'];
$orders->rec_email = $_POST['rec_email'];
$orders->rec_zip = '';
$orders->rec_city = '';
$orders->rec_area = '';
$orders->rec_address = $_POST['rec_address'];

//(POST) 取貨門市
$orders->store_name = $_POST['store_name'];
$orders->store_addr = $_POST['store_addr'];

$_SESSION['orders'] = serialize($orders);

//echo $orders->ordid;
//echo '<hr/>';

// 跳轉到 cart_3.php
header('Location:cart_3.php');
exit;
