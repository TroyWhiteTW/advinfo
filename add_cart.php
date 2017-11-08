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

        echo '已加入購物車';
    } else {
        echo '加入購物車失敗';
    }

} else {
    echo '請先登入';
}

function haveSameProduct($id)
{
    return in_array($id, array_keys($_SESSION['shop_cart']));
}