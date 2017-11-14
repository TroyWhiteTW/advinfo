<?php
session_start();//檢查SESSION是否啟動
//檢查驗證碼
if ($_POST['validate_code'] !== $_SESSION['check_word']) {
    echo 'f';
} else{
    echo 's';
}
exit;