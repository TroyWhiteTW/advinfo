<?php
include 'db.php';
session_start();

$isLogin = !empty($_SESSION['user']);
if (!$isLogin) {
    header('Location:index.php');
    exit;
}

switch ($_GET['cvstemp']) {

    case 'member':

        //$constore = "addr={$_GET['addr']} name={$_GET['name']}";
        $constore = array(
            "no" => $_GET['cvsspot'],        //商店代號
            "name" => $_GET['name'],        //商店名稱
            "tel" => $_GET['tel'],            //商店電話
            "addr" => $_GET['addr'],        //商店地址
            "cvs" => $_GET['cvsnum']        //商店路順編碼
        );

        $sql = 'UPDATE members SET constore=\'' . serialize($constore) . '\' WHERE id=\'' . $_SESSION['user2']['id'] . "'";

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
            $_SESSION['user2']['constore'] = unserialize($row2['constore']);

            header("Location:function_member.php");


        } else {

            echo "發生未預期錯誤...";

        }

        $result->close();

        break;

    case 'cart':

        /*$constore = "addr={$_GET['addr']} name={$_GET['name']}";

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

        $result->close();*/

        $constore = array(
            "no" => $_GET['cvsspot'],        //商店代號
            "name" => $_GET['name'],        //商店名稱
            "tel" => $_GET['tel'],            //商店電話
            "addr" => $_GET['addr'],        //商店地址
            "cvs" => $_GET['cvsnum']        //商店路順編碼
        );

        $sql = 'UPDATE members SET constore=\'' . serialize($constore) . '\' WHERE id=\'' . $_SESSION['user2']['id'] . "'";

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
            $_SESSION['user2']['constore'] = unserialize($row2['constore']);

            header("Location:cart_2.php");


        } else {

            echo "發生未預期錯誤...";

        }

        $result->close();

        break;

    default:

        break;

}

exit;