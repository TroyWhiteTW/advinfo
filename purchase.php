<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);

if ($isLogin) {

    if (!empty($_POST['proid']) && !empty($_POST['count'])) {

        $_POST['proid'] = trim($_POST['proid']);
        $_POST['count'] = (int)trim($_POST['count']);

        if (gettype($_SESSION['shop_cart']) !== 'array') {
            $_SESSION['shop_cart'] = [];
        }

        $sql = 'SELECT stock FROM products WHERE proid=' . "\"" . $_POST['proid'] . "\"";
        $rs = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($rs, MYSQLI_NUM);

//        if ($rs === false) {
//        }防止有人繞過驗證導致資料庫返回錯誤的判斷

        if (haveSameProduct($_POST['proid'])) {

            //重複加入
            if ($_POST['count'] > 10) {

                echo '超過單次購買數量上限';
                header("Refresh:3;url=pd_query.php");
                $rs->close();
                exit;

            } elseif ($_SESSION['shop_cart'][$_POST['proid']] + $_POST['count'] > 10) {

//                $_SESSION['shop_cart'][$_POST['proid']] = 10;
                echo '累計數量超過單次購買數量上限';
                header("Refresh:3;url=pd_query.php");
                $rs->close();
                exit;

            }

            if ($_SESSION['shop_cart'][$_POST['proid']] > $row[0]) {

                echo '庫存數量不足';
                header("Refresh:3;url=pd_query.php");
                $rs->close();
                exit;

            } else {

                $_SESSION['shop_cart'][$_POST['proid']] += $_POST['count'];
                header("Refresh:0;url=cart_1.php");
                $rs->close();
                exit;

            }

        } else {

            // 第一次加入
            if ($_POST['count'] > 10) {

                echo '超過單次購買數量上限';
                header("Refresh:3;url=pd_query.php");
                $rs->close();
                exit;

            } elseif ($_POST['count'] > $row[0]) {

                echo '庫存數量不足';
                header("Refresh:3;url=pd_query.php");
                $rs->close();
                exit;

            } else {

                $_SESSION['shop_cart'][$_POST['proid']] = $_POST['count'];
                header("Refresh:0;url=cart_1.php");
                $rs->close();
                exit;

            }

        }

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