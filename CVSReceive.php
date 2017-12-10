<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);

switch ($_GET['cvstemp']) {
    case 'member':
        $constore = "addr={$_GET['addr']} name={$_GET['name']}";

        $sql = 'UPDATE members SET constore="' . $constore . '" WHERE id=' . '"' . $_SESSION['user2']['id'] . '"';
        $result = mysqli_query($conn, $sql);
        if ($result === true) {

            $newSql = 'SELECT * FROM members WHERE email=' . "\"" . $_SESSION['user2']['email'] . "\"";
            $rs = mysqli_query($conn, $newSql);
            $newRow = mysqli_fetch_array($rs, MYSQLI_NUM);;
            unset($_SESSION['user']);
            $_SESSION['user'] = $newRow;

            $rs2 = mysqli_query($conn, $newSql);
            $row2 = mysqli_fetch_assoc($rs2);
            unset($_SESSION['user2']);
            $_SESSION['user2'] = $row2;

            header("Location:function_member.php?addr={$_GET['addr']}&name={$_GET['name']}");

        } else {
            echo "發生未預期錯誤...";
        }
        $result->close();

        break;
    case 'cart':
    case 'cart':
        $constore = "addr={$_GET['addr']} name={$_GET['name']}";

        $sql = 'UPDATE members SET constore="' . $constore . '" WHERE id=' . '"' . $_SESSION['user2']['id'] . '"';
        $result = mysqli_query($conn, $sql);
        if ($result === true) {

            $newSql = 'SELECT * FROM members WHERE email=' . "\"" . $_SESSION['user2']['email'] . "\"";
            $rs = mysqli_query($conn, $newSql);
            $newRow = mysqli_fetch_array($rs, MYSQLI_NUM);;
            unset($_SESSION['user']);
            $_SESSION['user'] = $newRow;

            $rs2 = mysqli_query($conn, $newSql);
            $row2 = mysqli_fetch_assoc($rs2);
            unset($_SESSION['user2']);
            $_SESSION['user2'] = $row2;

            header("Location:cart_2.php");

        } else {
            echo "發生未預期錯誤...";
        }
        $result->close();

        break;
    default:
        break;
}
//echo '常用門市選擇成功！3秒後跳轉回會員資料頁...';
//header("Refresh:3;url=function_member.php");
exit;