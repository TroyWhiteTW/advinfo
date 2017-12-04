<?php
include 'db.php';
session_start();

if (!empty($_GET['email']) && !empty($_GET['hash_key'])) {

    session_destroy();
    session_start();

    if (password_verify($_GET['email'], $_GET['hash_key'])) {

        $sql = 'UPDATE members SET status=0 WHERE email="' . $_GET['email'] . '"';

        $result = mysqli_query($conn, $sql);
        if ($result === true) {

            $newSql = 'SELECT * FROM members WHERE email=' . "\"" . $_GET['email'] . "\"";
            $rs = mysqli_query($conn, $newSql);
            $row = mysqli_fetch_array($rs, MYSQLI_NUM);

            $rs2 = mysqli_query($conn, $sql);
            $row2 = mysqli_fetch_assoc($rs2);

//            if ($row2['email'] === $_GET['email']) {
            //SESSION 設定
            $_SESSION['user'] = $row;
            $_SESSION['user2'] = $row2;

            echo '電子信箱驗證成功！3秒後跳轉至簡訊驗證...';
            header("Refresh:3;url=login_start.php");
//            } else {
//                echo '連結錯誤';
//                header("Refresh:3;url=index.php");
//            }

            $rs->close();
            $rs2->close();

        } else {
            echo "發生未預期錯誤...";
        }

    } else {

    }

}