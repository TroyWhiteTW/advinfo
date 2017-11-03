<?php
include 'db.php';
session_start();
?>
<?php
$account = $_REQUEST['account'];
$password = $_REQUEST['password'];
$password_c = $_REQUEST['password_c'];
$name = $_REQUEST['name'];
$gender = "\"" . $_REQUEST['gender'] . "\"";
$level = "\"\"";
$referral = $_REQUEST['referral'];
$email = $_REQUEST['email'];
$phone = $_REQUEST['phone'];
$mobile = $_REQUEST['mobile'];
$company_no = "\"\"";
$invoice_title = "\"\"";
$address = $_REQUEST['address'];
$constore = "\"\"";
$regtime = 0;
$verifycode = $_REQUEST['verifycode'];
$verifytime = 0;
$type = $_REQUEST['type'];
$status = 0;

if ($password == $password_c) {
    $password = md5($password);

    $sql = 'INSERT INTO members ' .
        '(account, password, name, gender, level, referral, email, phone, mobile, company_no, invoice_title, address, constore, regtime, verifycode, verifytime, type, status) ' .
        "VALUES ($account, $password, $name, $gender, $level, $referral, $email, $phone, $mobile, $company_no, $invoice_title, $address, $constore, $regtime, $verifycode, $verifytime, $type, $status);";

    $result = mysqli_query($conn, $sql);

    if ($result == 1) {
        header("Location:index.php");
        exit;
    }
}

header("Location:login_register.php");
exit;