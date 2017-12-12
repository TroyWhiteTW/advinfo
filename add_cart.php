<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);

//更新購物車數量
if ($_POST["act"] == "getCount") {
    if (isset($_SESSION['shop_cart'])) {
        exit('$("#cartNum").html("' . count($_SESSION['shop_cart']) . '");');
    } else {
        exit('$("#cartNum").html("0");');
    }
}
?>
<?php
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
                $rs->close();
                return;

            } elseif ($_SESSION['shop_cart'][$_POST['proid']] + $_POST['count'] > 10) {

//                $_SESSION['shop_cart'][$_POST['proid']] = 10;
                echo '累計數量超過單次購買數量上限';
                $rs->close();
                return;

            }

            if ($_SESSION['shop_cart'][$_POST['proid']] > $row[0]) {

                echo '庫存數量不足';
                $rs->close();
                return;

            } else {

                $_SESSION['shop_cart'][$_POST['proid']] += $_POST['count'];
                echo '已加入購物車';
                $rs->close();
                return;

            }

        } else {
            // 第一次加入
            if ($_POST['count'] > 10) {

                echo '超過單次購買數量上限';
                $rs->close();
                return;

            } elseif ($_POST['count'] > $row[0]) {

                echo '庫存數量不足';
                $rs->close();
                return;

            } else {

                $_SESSION['shop_cart'][$_POST['proid']] = $_POST['count'];
                echo '已加入購物車';
                $rs->close();
                return;

            }

        }

    } else {
        echo '加入購物車失敗';
        return;
    }

} else {
    echo '請先登入';
    return;
}

function haveSameProduct($id)
{
    return in_array($id, array_keys($_SESSION['shop_cart']));
}