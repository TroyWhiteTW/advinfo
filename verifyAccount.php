<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);

if (!empty($_POST['verifycode'])) {
    $_POST['verifycode'] = (int)trim($_POST['verifycode']);

    $sql = 'SELECT verifycode FROM members WHERE id="' . $_SESSION['user2']['id'] . '"';
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($rs);
    if ($row['verifycode'] == $_POST['verifycode']) {

        $newSql = 'UPDATE members SET status=1 WHERE id="' . $_SESSION['user2']['id'] . '"';
        $rs2 = mysqli_query($conn, $newSql);

        if ($rs2 === true) {
            echo '簡訊驗證成功，三秒後跳轉回首頁...';
            header("Refresh:3;url=login.php");
        } else {
            echo '簡訊驗證失敗，三秒後跳轉回首頁...';
            header("Refresh:3;url=login.php");
        }

    } else {
        echo '簡訊驗證失敗，三秒後跳轉回首頁...';
        header("Refresh:3;url=login.php");
    }

    $rs->close();

} else {
    echo '簡訊驗證失敗，三秒後跳轉回首頁...';
    header("Refresh:3;url=login.php");
}
