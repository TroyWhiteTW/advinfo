<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);
?>
<?php
// TODO: 待補側邊攔，目前是 hard code
//拿到所有訂單
$userEmail = $_SESSION['user'][7];
$sql = "SELECT * FROM orders WHERE sub_account = '" . $userEmail . "' ORDER BY ordid DESC";
$rs = mysqli_query($conn, $sql);
$orderDataArray = [];
while ($rowData = mysqli_fetch_assoc($rs)) {
    $orderDataArray[] = $rowData;
}
//var_dump($orderDataArray);
//return;
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
                        <li><a>會員專區</a></li>

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

                        <?php

                        function statusTranslate($num)
                        {
                            switch ($num) {
                                case '0':
                                    return '新訂單';
                                    break;
                                case '1':
                                    return '處理中';
                                    break;
                                case '9':
                                    return '訂單取消';
                                    break;
                                default:
                                    return $num;
                                    break;
                            }
                        }

                        function discountTranslate($num)
                        {
                            switch ($num) {
                                case '0':
                                    return '不使用折抵';
                                    break;
                                case '1':
                                    return '使用電子錢包折抵';
                                    break;
                                case '2':
                                    return '使用紅利折抵';
                                    break;
                                default:
                                    return $num;
                                    break;
                            }
                        }

                        for ($i = 0; $i < count($orderDataArray); $i++) {

//                            $nStatus = statusTranslate($orderDataArray[$i]['ordstatus']);

                            $a = statusTranslate(1);
                            echo '<div class="content-article"><table width="100%" border="1"><tbody><tr class="tb-tittle"><td colspan="2">訂單編號</td></tr>';
                            echo '<tr class="td-02"><td colspan="2"><a href="function_orderinquire.php?ordid='.$orderDataArray[$i]['ordid'].'">' . $orderDataArray[$i]['ordid'] . '</a></td></tr>';
                            echo '<tr class="tb-tittle"><td>日期</td><td>狀態</td></tr>';
                            echo '<tr class="td-02"><td>' . $orderDataArray[$i]['orddate'] . '</td><td>' . statusTranslate($orderDataArray[$i]['ordstatus']) . '</td></tr></tbody></table>';
                            echo '<table width="100%" border="1"><tbody><tr class="tb-tittle"><td>總金額</td><td>折抵</td><td>應付金額</td></tr>';
                            echo '<tr class="td-02"><td>$' . $orderDataArray[$i]['total_price'] . '</td><td>$' . $orderDataArray[$i]['discount_price'] . '</td><td>$' . $orderDataArray[$i]['pay_price'] . '</td></tr>';
                            echo '<tr class="tb-tittle"><td>PV值</td><td>折抵方式</td><td>付款方式</td></tr>';
                            echo '<tr class="td-02"><td>' . $orderDataArray[$i]['PV'] . '</td><td>' . discountTranslate($orderDataArray[$i]['discount']) . '</td><td>' . $orderDataArray[$i]['pay_no'] . '</td></tr></tbody></table>';
                            echo '<table width="100%" border="1"><tbody><tr class="tb-tittle"><td>退貨</td><td>明細</td></tr>';
                            echo '<tr class="td-02">';
                            echo '<td> -- </td>';
                            echo '<td><a href="function_orderinquire.php?ordid='.$orderDataArray[$i]['ordid'].'">明細</a></td>';
                            echo '</tr></tbody></table></div><br/>';
                        }



                        ?>
                        <!--                        <div class="content-article">-->
                        <!--                            <table width="100%" border="1">-->
                        <!--                                <tbody>-->
                        <!--                                <tr class="tb-tittle">-->
                        <!--                                    <td colspan="2">訂單編號</td>-->
                        <!--                                </tr>-->
                        <!--                                <tr class="td-02">-->
                        <!--                                    <td colspan="2"><a href="function_orderinquire.php">xxxxxxxxxxxx</a></td>-->
                        <!--                                </tr>-->
                        <!--                                <tr class="tb-tittle">-->
                        <!--                                    <td>日期</td>-->
                        <!--                                    <td>狀態</td>-->
                        <!--                                </tr>-->
                        <!--                                <tr class="td-02">-->
                        <!--                                    <td>2017/07/21</td>-->
                        <!--                                    <td>成立</td>-->
                        <!--                                </tr>-->
                        <!--                                </tbody>-->
                        <!--                            </table>-->
                        <!--                            <table width="100%" border="1">-->
                        <!--                                <tbody>-->
                        <!--                                <tr class="tb-tittle">-->
                        <!--                                    <td>總金額</td>-->
                        <!--                                    <td>折抵</td>-->
                        <!--                                    <td>應付金額</td>-->
                        <!--                                </tr>-->
                        <!--                                <tr class="td-02">-->
                        <!--                                    <td>$99,999</td>-->
                        <!--                                    <td>$99,999</td>-->
                        <!--                                    <td>$99,999</td>-->
                        <!--                                </tr>-->
                        <!--                                <tr class="tb-tittle">-->
                        <!--                                    <td>PV值</td>-->
                        <!--                                    <td>折抵方式</td>-->
                        <!--                                    <td>付款方式</td>-->
                        <!--                                </tr>-->
                        <!--                                <tr class="td-02">-->
                        <!--                                    <td>99,999</td>-->
                        <!--                                    <td>&nbsp;</td>-->
                        <!--                                    <td>&nbsp;</td>-->
                        <!--                                </tr>-->
                        <!--                                </tbody>-->
                        <!--                            </table>-->
                        <!--                            <table width="100%" border="1">-->
                        <!--                                <tbody>-->
                        <!--                                <tr class="tb-tittle">-->
                        <!--                                    <td>退貨</td>-->
                        <!--                                    <td>明細</td>-->
                        <!--                                </tr>-->
                        <!--                                <tr class="td-02">-->
                        <!--                                    <td>退貨</td>-->
                        <!--                                    <td><a href="function_orderinquire.php">明細</a></td>-->
                        <!--                                </tr>-->
                        <!--                                </tbody>-->
                        <!--                            </table>-->
                        <!--                        </div>-->
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
