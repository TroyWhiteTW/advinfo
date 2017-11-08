<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);
?>
<?php
if ($isLogin) {

    if (!empty($_POST['proid']) && !empty($_POST['count'])) {

        $_POST['proid'] = (int)trim($_POST['proid']);
        $_POST['count'] = (int)trim($_POST['count']);

        if (gettype($_SESSION['shop_cart']) !== 'array') {
            $_SESSION['shop_cart'] = [];
        }
        if (haveSameProduct($_POST['proid'])) {
            $_SESSION['shop_cart'][$_POST['proid']] += $_POST['count'];
        } else {
            $_SESSION['shop_cart'][$_POST['proid']] = $_POST['count'];
        }

        header("Refresh:0;url=cart_1.php");
        exit;
    } else {
        echo '商品或數量錯誤';
        header("Refresh:3;url=index.php");
        exit;
    }

} else {
    echo '請先登入';
    header("Refresh:3;url=login.php");
    exit;
}

function haveSameProduct($id)
{
    return in_array($id, array_keys($_SESSION['shop_cart']));
}