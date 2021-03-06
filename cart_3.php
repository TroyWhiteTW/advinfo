<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);
if (!$isLogin) {
    header('Location:index.php');
    exit;
}
if (!preg_match("/cart_2.php$/", $_SERVER['HTTP_REFERER'])) {
    header('Location:index.php');
    exit;
}

// 引入訂單的 DAO class
require __DIR__ . '/OrdersDAO.php';

//判斷 SESSION 裡是否有訂單資訊，若無代表是初次進入；若有代表是從後面的頁面返回，幫使用者填入訂單中已有的值
if (empty($_SESSION['orders'])) {
    $_SESSION['orders'] = serialize(new OrdersDAO());
}
$orders = $_SESSION['orders'];
/** @var OrdersDAO $orders */
$orders = unserialize($orders);
//var_dump(unserialize($orders));
//return;

//從購物車取得商品資訊
$recordArray = [];

if (isset($_SESSION['shop_cart']) && count($_SESSION['shop_cart']) > 0) {
    $keys = array_keys($_SESSION['shop_cart']);
    $sql_pk = "(";
    foreach ($keys as $v) {
        $sql_pk .= "'$v'" . ",";
    }
    $sql_pk = substr($sql_pk, 0, -1);
    $sql_pk .= ")";
    $sql_pro_cart = "SELECT * FROM products WHERE proid IN " . $sql_pk;
    $rs_cart = mysqli_query($conn, $sql_pro_cart);
//    var_dump($sql_pro_cart);
//    var_dump(mysqli_num_rows($rs_cart));
    while ($record = mysqli_fetch_assoc($rs_cart)) {
        $recordArray[] = $record;
    }
}

$total = 0;
$tPV = 0;
$fare = 0;
$discount = 0;

// 配送方式
// 名稱
$chooseShipType = $orders->ship_no;
if ($chooseShipType == 0) {
    $chooseShipName = '營業據點取貨';
    $chooseShipWay = 1;
} else {
    $chooseShipTypeSql = "SELECT name FROM shiptypes WHERE no = $chooseShipType";
    $chooseShipTypeRs = mysqli_query($conn, $chooseShipTypeSql);
    $chooseShipData = mysqli_fetch_assoc($chooseShipTypeRs);
    $chooseShipName = $chooseShipData['name'];
    $chooseShipWay = $chooseShipData['type'];
    if ($chooseShipName == "" || $chooseShipName == null) { //value 有誤
        var_dump("配送方式有誤");
//    header('Location:index.php');
        exit;
    }
    $chooseShipTypeRs->close();
}

// 價格
$shipAmount = 0;//營業據點取貨的錢
if ($chooseShipType == 0) {

} else {
    $shipAmountSql = "SELECT * FROM shippings WHERE shiptype = $chooseShipType";
//var_dump($shipAmountSql);
    $shipAmountRs = mysqli_query($conn, $shipAmountSql);
    $shipAmountRows = [];
    while ($shipAmountRow = mysqli_fetch_assoc($shipAmountRs)) {
        $shipAmountRows[] = $shipAmountRow;
    }
    if (count($shipAmountRows) >= 2) {
        foreach ($shipAmountRows as $k => $v) {
            if ($v["units"] == $_SESSION["units"]) {
                $shipAmount = $v["freight"];
            }
        }
    } else if (count($shipAmountRows) == 1) {
        $shipAmount = $shipAmountRows[0]["freight"];
    }
}

// 付款方式
$payments = [];
$paymentsSql = 'SELECT no, name, platform, type FROM payments WHERE status=1';
$paymentsRes = mysqli_query($conn, $paymentsSql);
while ($paymentsRow = mysqli_fetch_assoc($paymentsRes)) {
    $payments[] = $paymentsRow;
}

//促銷判斷
function isPromo($product)
{
    if (!(time() > strtotime($product['promo_start']) && time() < strtotime($product['promo_end']))) {
        return false;
    } else {
        return true;
    }
}

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
                            <li><a href="cart_1.php">購物車</a></li>
                            <li><img src="img/process_icon.png" alt=""></li>
                            <li><a>確認訂單資料</a></li>

                        </ul>

                    </div>

                    <?php if ($isLogin): ?>

                        <div class="content-area">

                            <div class="cart-area">

                                <ul>

                                    <li class="btn btn-default btn-sm disabled" style="margin-top: 10px">1.確認商品</li>

                                    <li><img src="img/process_icon.png" alt="" style="margin-top: 10px"></li>

                                    <li class="btn btn-default btn-sm disabled" style="margin-top: 10px">2.收件人資訊</li>

                                    <li><img src="img/process_icon.png" alt="" style="margin-top: 10px"></li>

                                    <li class="btn btn-danger btn-sm disabled" style="margin-top: 10px">3.確認訂單資料</li>

                                    <li><img src="img/process_icon.png" alt="" style="margin-top: 10px"></li>

                                    <li class="btn btn-default btn-sm disabled" style="margin-top: 10px">4.完成確認</li>

                                </ul>

                            </div>

                            <form method="post" action="cart_3_to_4.php">

                                <!-- 購物內容 -->
                                <div class="content-article">

                                    <div class="form-name">購物車</div>

                                    <table width="100%" border="1" style="margin-top:10px;">

                                        <tbody>

                                        <tr class="tb-tittle">
                                            <td>商品名稱</td>
                                            <td>數量</td>
                                            <td>單位價格</td>
                                            <?php
                                            switch ($_SESSION['user2']['type']) {
                                                case 1:
                                                    echo '<td>單位紅利</td>';
                                                    break;
                                                case 2:
                                                    echo '<td>單位PV</td>';
                                                    break;
                                            }
                                            ?>
                                        </tr>

                                        <?php

                                        $html = [];
                                        $count = count($recordArray);
                                        for ($i = 0; $i < $count; $i++) {
                                            $html[] = '<tr class="td-02">';
                                            // 商品名稱
                                            $html[] = '<td>';
                                            $html[] = $recordArray[$i]['proname'];
                                            $html[] = "<br/>\n";
                                            $html[] = '<span style="color:red;">';
                                            $html[] = '產品編號：';
                                            $html[] = $recordArray[$i]['proid'];
                                            $html[] = '<span style="color:red;">';
                                            $html[] = '</span>';
                                            $html[] = '</td>';
                                            // 數量
                                            $html[] = '<td class="prodCount">';
                                            $html[] = $_SESSION['shop_cart'][$recordArray[$i]['proid']];
                                            $html[] = '</td>';
                                            // 價格
                                            $html[] = '<td class="priceValue">';
                                            if (isPromo($recordArray[$i])) {
                                                $html[] = $recordArray[$i]['promo_price'];
                                            } else {
                                                $html[] = $recordArray[$i]['price'];
                                            }
                                            $html[] = '</td>';
                                            // PV
                                            $html[] = '<td class="pvValue">';
                                            switch ($_SESSION['user2']['type']) {
                                                case 1:
                                                    if (isPromo($recordArray[$i])) {
                                                        $html[] = $recordArray[$i]['promo_bonuce'];
                                                    } else {
                                                        $html[] = $recordArray[$i]['bonuce'];
                                                    }
                                                    break;
                                                case 2:
                                                    if (isPromo($recordArray[$i])) {
                                                        $html[] = $recordArray[$i]['promo_PV'];
                                                    } else {
                                                        $html[] = $recordArray[$i]['PV'];
                                                    }
                                                    break;
                                            }
                                            $html[] = '</td>';

                                            $html[] = '</tr>';

                                            if (isPromo($recordArray[$i])) {
                                                $total += $_SESSION['shop_cart'][$recordArray[$i]['proid']] * $recordArray[$i]['promo_price'];
                                            } else {
                                                $total += $_SESSION['shop_cart'][$recordArray[$i]['proid']] * $recordArray[$i]['price'];
                                            }

                                            switch ($_SESSION['user2']['type']) {
                                                case 1:
                                                    if (isPromo($recordArray[$i])) {
                                                        $tPV += $_SESSION['shop_cart'][$recordArray[$i]['proid']] * $recordArray[$i]['promo_bonuce'];
                                                    } else {
                                                        $tPV += $_SESSION['shop_cart'][$recordArray[$i]['proid']] * $recordArray[$i]['bonuce'];
                                                    }
                                                    break;
                                                case 2:
                                                    if (isPromo($recordArray[$i])) {
                                                        $tPV += $_SESSION['shop_cart'][$recordArray[$i]['proid']] * $recordArray[$i]['promo_PV'];
                                                    } else {
                                                        $tPV += $_SESSION['shop_cart'][$recordArray[$i]['proid']] * $recordArray[$i]['PV'];
                                                    }
                                                    break;
                                            }
                                        }

                                        echo implode("\n", $html);

                                        ?>

                                        </tbody>

                                    </table>

                                    <div class="pv-area">
                                        <?php
                                        switch ($_SESSION['user2']['type']) {
                                            case 1:
                                                echo '<div class="pv-textarea">商品總紅利</div>';
                                                break;
                                            case 2:
                                                echo '<div class="pv-textarea">商品總PV</div>';
                                                break;
                                        }
                                        ?>
                                        <div class="pv-textarea"><?= $tPV ?></div>
                                        <?php
                                        switch ($_SESSION['user2']['type']) {
                                            case 1:
                                                echo '<div class="pv-textarea">紅利</div>';
                                                break;
                                            case 2:
                                                echo '<div class="pv-textarea">PV</div>';
                                                break;
                                        }
                                        ?>
                                    </div>

                                    <div class="price-area">
                                        <div class="price-textarea">商品總金額</div>
                                        <div class="price-textarea"><?= $total ?></div>
                                        <div class="price-textarea">元</div>
                                    </div>

                                </div>

                                <!-- 訂購人資料 -->
                                <div class="content-article">

                                    <div class="form-name">訂購人資料</div>

                                    <div class="form-tittle">姓名：
                                        <div class="form-input-2"><?= $orders->sub_name ?></div>
                                    </div>

                                    <div class="form-tittle">電子信箱：
                                        <div class="form-input-2"><?= $orders->sub_email ?></div>
                                    </div>

                                    <div class="form-tittle">聯繫電話：
                                        <div class="form-input-2"><?= $orders->sub_phone ?></div>
                                    </div>

                                    <div class="form-tittle">手機：
                                        <div class="form-input-2"><?= $orders->sub_mobile ?></div>
                                    </div>

                                    <div class="form-tittle">聯繫地址：
                                        <div class="form-input-2"><?= $orders->sub_address ?></div>
                                    </div>

                                </div>

                                <!-- 收件人資料 -->
                                <?php if ($orders->ship_no == 1): ?>
                                    <div class="content-article">

                                        <div class="form-name">收件人資料</div>

                                        <div class="form-tittle">姓名：
                                            <div class="form-input-2"><?= $orders->rec_name ?></div>
                                        </div>

                                        <div class="form-tittle">電子信箱：
                                            <div class="form-input-2"><?= $orders->rec_email ?></div>
                                        </div>

                                        <div class="form-tittle">聯繫電話：
                                            <div class="form-input-2"><?= $orders->rec_phone ?></div>
                                        </div>

                                        <div class="form-tittle">手機：
                                            <div class="form-input-2"><?= $orders->rec_mobile ?></div>
                                        </div>

                                        <div class="form-tittle">聯繫地址：
                                            <div class="form-input-2"><?= $orders->rec_address ?></div>
                                        </div>

                                    </div>
                                <?php endif; ?>

                                <!-- 配送方式 -->
                                <div class="content-article">

                                    <div class="form-name">配送方式</div>

                                    <?php
                                    $fare = $shipAmount;
                                    echo '<div class="form-input">';
                                    echo $chooseShipName;
                                    switch ($chooseShipWay) {
                                        case 1:
                                            echo '(需先付款)';
                                            break;
                                        case 2:
                                            echo '(已付款)';
                                            break;
                                        case 3:
                                            echo '(貨到付款)';
                                            break;
                                        default:
                                            break;
                                    }
                                    echo " {$shipAmount}元";
                                    echo '</div>';
                                    ?>

                                    <div class="price-area">

                                        <div class="price-textarea">+運費：</div>

                                        <div class="price-textarea"><?= $fare ?></div>

                                        <div class="price-textarea">元</div>

                                    </div>

                                    <div class="price-area">

                                        <div class="price-textarea">訂單總金額：</div>

                                        <div class="price-textarea"><?= $total + $fare ?></div>

                                        <div class="price-textarea">元</div>

                                    </div>

                                </div>

                                <!-- 折抵方式 -->
                                <div class="content-article">

                                    <div class="form-name">折抵方式</div>

                                    <?php
                                    switch ($orders->discount) {
                                        case 0:
                                            $discount = 0;
                                            echo '<div class="form-input">不使用折抵</div>';
                                            break;
                                        case 1:
                                            $discount = $orders->discount_price;
                                            echo '<div class="form-input">使用電子錢包折抵</div>';
                                            echo '<div class="form-tittle">折抵金額：<div class="form-input-2">' . $orders->discount_price . '</div></div>';
                                            break;
                                        case 2:
                                            $discount = $orders->discount_price;
                                            echo '<div class="form-input">使用紅利折抵</div>';
                                            echo '<div class="form-tittle">折抵金額：<div class="form-input-2">' . $orders->discount_price . '</div></div>';
                                            break;
                                    }
                                    ?>

                                    <div class="price-area">

                                        <div class="price-textarea">應付總金額</div>

                                        <div class="price-textarea"><?= $total + $fare - $discount ?></div>

                                        <div class="price-textarea">元</div>

                                    </div>

                                </div>

                                <!-- 付款方式 -->
                                <div class="content-article">

                                    <div class="form-name">付款方式</div>

                                    <?php
                                    foreach ($payments as $payment) {
                                        if ($payment['no'] == $orders->pay_no) {
                                            echo '<div class="form-input">';
                                            echo $payment['name'];
                                            echo '</div>';
                                        }
                                    }
                                    ?>

                                </div>

                                <!-- 取貨門市 -->
                                <?php
                                $sql = "select shippings.*,logistics.name as logname from shippings 
                                    LEFT JOIN logistics ON logistics.no=shippings.logno where shippings.shiptype='" . $orders->ship_no . "'";
                                $rs = mysqli_query($conn, $sql);
                                $rst = mysqli_fetch_assoc($rs);
                                if ($rst["logname"] == "便利達康" && $orders->ship_no == "2") {
                                    echo '<div class="content-article">';

                                    echo '<div class="form-name">取貨門市</div>';

                                    echo '<!--<div class="form-input">便利商店名稱(資料填入)</div>-->';

                                    echo '<div class="form-tittle">門市名稱：';
                                    echo '<div class="form-input-2">' . $_SESSION['user2']['constore']['name'] . '</div>';
                                    echo '</div>';

                                    echo '<div class="form-tittle">門市地址：';
                                    echo '<div class="form-input-2">' . $_SESSION['user2']['constore']['addr'] . '</div>';
                                    echo '</div>';

                                    echo '</div>';
                                }
                                ?>

                                <!-- 發票資訊-->
                                <div class="content-article">

                                    <div class="form-name">發票資訊</div>

                                    <?php
                                    switch ($orders->invoice) {
                                        case 1:
                                            echo '<div class="form-tittle">個人發票</div>';
                                            break;
                                        case 2:
                                            echo '<div class="form-tittle">公司戶頭票</div>';

                                            echo '<hr/>';

                                            echo '<div class="form-tittle">統一編號：';
                                            echo '<div class="form-input-2">' . $orders->company_no . '</div>';
                                            echo '</div>';

                                            echo '<div class="form-tittle">公司抬頭：';
                                            echo '<div class="form-input-2">' . $orders->invoice_title . '</div>';
                                            echo '</div>';

                                            break;
                                    }
                                    ?>

                                </div>

                                <div class="btn-area">

                                    <a href="cart_2.php" class="btn btn-warning">返回上一步</a>

                                    <input type="submit" class="btn btn-success" value="確認，下一步">

                                </div>

                            </form>

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

        //新增側邊欄

        //側邊欄滑動
        $('#left-open').click(function () {
            // 顯示隱藏側邊欄
            $('.sidebar').toggleClass('sidebar-view');
            // body畫面變暗+鎖住網頁滾輪
            $('body').toggleClass('body-back');
        });

        $(window).resize(function () {
            //減去tobar 高度
            var bh = $(window).height() - 51;
            $('.fullheight').height(bh);

            var bw = $(window).width();
            if (bw >= 768) {
                $('.sidebar').removeClass('sidebar-view');
                $('body').removeClass('body-back');
            }
        }).resize();

        //新增側邊欄
    </script>

    </body>

    </html>
<?php
$orders->total_price = $total;
$orders->freight = $fare;
$orders->PV = $tPV;
$orders->bonuce = 0;
$_SESSION['orders'] = serialize($orders);