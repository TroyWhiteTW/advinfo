<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);
?>
<?php
// TODO: 待補側邊攔，目前是 hard code
//先取得該用戶持有的所有訂單id
$sql = "SELECT ordid FROM orders WHERE sub_account='" . $_SESSION['user'][7] . "'";
$rs = mysqli_query($conn, $sql);
$ordidArray = [];
while ($row = mysqli_fetch_assoc($rs)) {
    $ordidArray[] = $row['ordid'];
}
$rs->close();
//若該用戶無此訂單 導回首頁
if (!in_array($_REQUEST['ordid'], $ordidArray)) {
    header('Location:index.php');
    exit;
}
//取得該訂單明細
$sql2 = "SELECT * FROM orderdetail WHERE ordid='" . $_REQUEST['ordid'] . "'";
$rs2 = mysqli_query($conn, $sql2);
$orderDetailData = [];
while ($rowData = mysqli_fetch_assoc($rs2)) {
    $orderDetailData[] = $rowData;
}
var_dump($orderDetailData);
return;

?>
<!doctype html>
<html>

<head>

    <?php include 'http_head.php'; ?>

</head>

<body>

<div class="wrap">

    <?php include 'top_bar.php'; ?>

    <div class="container main">

        <div class="row content no-margin-rl">

            <div class="col-sm-2 left-area hidden-xs " style="">

                <?php include 'side_bar.php'; ?>

            </div>

            <div class="col-sm-10">

                <div class="beard">
                    <ul>
                        <li><a href="index.php">首頁</a></li>
                        <li><img src="img/process_icon.png" alt=""></li>
                        <li><a href="function_member.php">會員專區</a></li>
                    </ul>
                </div>

                <?php if ($isLogin): ?>

                    <div class="content-area">
                        <div class="function-area">
                            <ul>
                                <li><a href="function_member.php"><input type="button" id="" name="" class=""
                                                                         value="個人資料"></a></li>
                                <li><a href="function_orderquery.php"><input type="button" id="" name=""
                                                                             class="tag-value-select" value="訂單查詢"></a>
                                </li>
                                <li><a href="function_bonusquery.php"><input type="button" id="" name="" class=""
                                                                             value="重銷獎金查詢/規則"></a></li>
                            </ul>
                        </div>
                        <div class="content-article">
                            <table width="100%" border="1">
                                <tbody>
                                <tr class="tb-tittle">
                                    <td>訂單編號</td>
                                </tr>
                                <tr class="td-02">
                                    <td>xxxxxxxxxxxxx</td>
                                </tr>
                                <tr class="tb-tittle">
                                    <td>訂單日期</td>
                                </tr>
                                <tr class="td-02">
                                    <td>xxxxxxxxxxxxx</td>
                                </tr>
                                </tbody>
                            </table>
                            <table width="100%" border="1">
                                <tbody>
                                <tr class="tb-tittle">
                                    <td>編號</td>
                                    <td>商品名稱</td>
                                    <td>訂單狀態</td>
                                    <td>數量</td>
                                    <td>PV</td>
                                    <td>價格</td>
                                    <td>其他</td>
                                </tr>
                                <tr class="td-02">
                                    <td>1</td>
                                    <td>xxxxxxxxxxx<br><span style="color:#B80609">(產品編號)</span></td>
                                    <td>訂單成立</td>
                                    <td>1</td>
                                    <td>20</td>
                                    <td>$100</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr class="td-02">
                                    <td>2</td>
                                    <td>xxxxxxxxxxx<br><span style="color:#B80609">(產品編號)</span></td>
                                    <td>訂單成立</td>
                                    <td>1</td>
                                    <td>60</td>
                                    <td>$300</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr class="td-02">
                                    <td colspan="3">&nbsp;</td>
                                    <td style="background-color:black;color:#fff;text-align:right;">運費</td>
                                    <td></td>
                                    <td>$80</td>
                                </tr>
                                <tr class="td-02">
                                    <td colspan="3">&nbsp;</td>
                                    <td style="background-color:#B80609;color:#fff;text-align:right;">訂單總額</td>
                                    <td>80</td>
                                    <td>$480</td>
                                </tr>
                                <tr class="td-02">
                                    <td colspan="3">&nbsp;</td>
                                    <td style="background-color:#E3770C;color:#fff;text-align:right;">折抵</td>
                                    <td>紅利/電子錢包</td>
                                    <td>$x,xxx</td>
                                </tr>
                                <tr class="td-02">
                                    <td colspan="3">&nbsp;</td>
                                    <td style="background-color:#B80609;color:#fff;text-align:right;">應付金額</td>
                                    <td></td>
                                    <td>$x,xxx</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="btn-area">
                            <a href="function_orderquery.php"><input type="submit" value="返回"></a>
                        </div>
                    </div>

                <?php else: ?>

                    <h3>請先登入</h3>

                <?php endif; ?>

            </div>

        </div>

        <?php include 'footer.php'; ?>

    </div>

</div>

<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $('.fadeOut').owlCarousel({
            items: 1,
            loop: true,
            margin: 10,
            autoplay: true
        });
    });

    $('#sildes-portfolio, #sildes-promote').owlCarousel({
        items: 4,
        loop: true,
        margin: 5,
        autoplay: true,
        //navText:['<span class="fa fa-long-arrow-left fa-2x"></span>','<span class="fa fa-long-arrow-right fa-2x"></span>'],
        dots: false,
        responsive: {
            0: {
                nav: false,
                items: 2
            },
            768: {
                nav: false,
                items: 2
            },
            992: {
                nav: false,
                items: 3
            },
            1290: {
                nav: false,
                items: 4
            }
        }
    });
</script>

</body>

</html>
