<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);
?>
<?php
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

                    </ul>

                </div>

                <?php if ($isLogin): ?>

                    <div class="content-area">

                        <div class="cart-area">

                            <ul>

                                <li class="btn btn-default disabled">1.確認商品</li>

                                <li><img src="img/process_icon.png" alt=""></li>

                                <li class="btn btn-default disabled">2.收件人資訊</li>

                                <li><img src="img/process_icon.png" alt=""></li>

                                <li class="btn btn-danger disabled">3.確認訂單資料</li>

                                <li><img src="img/process_icon.png" alt=""></li>

                                <li class="btn btn-default disabled">4.完成確認</li>

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
                                        <td>價格</td>
                                        <td>PV</td>
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
                                        $html[] = $recordArray[$i]['price'];
                                        $html[] = '</td>';
                                        // PV
                                        $html[] = '<td class="pvValue">';
                                        $html[] = $recordArray[$i]['PV'];
                                        $html[] = '</td>';

                                        $html[] = '</tr>';

                                    }

                                    echo implode("\n", $html);

                                    ?>

                                    </tbody>

                                </table>

                                <div class="pv-area">
                                    <div class="pv-textarea">商品總PV</div>
                                    <div class="pv-textarea"></div>
                                    <div class="pv-textarea">PV</div>
                                </div>

                                <div class="price-area">
                                    <div class="price-textarea">商品總金額</div>
                                    <div class="price-textarea"></div>
                                    <div class="price-textarea">元</div>
                                </div>

                                <script>
                                    var totalPvNode = $('.pv-area > .pv-textarea:nth-child(2)')[0];
                                    var totalPriceNode = $('.price-area > .price-textarea:nth-child(2)')[0];

                                    doTotal();

                                    function doTotal() {
                                        var totalPrice = 0;
                                        var totlaPV = 0;
                                        var tbody = document.getElementsByTagName("tbody")[0];
                                        var td02s = tbody.getElementsByClassName("td-02");
                                        for (var i = 0; i < td02s.length; i++) {
                                            var price = td02s[i].getElementsByClassName("priceValue")[0].innerHTML;
                                            var pv = td02s[i].getElementsByClassName("pvValue")[0].innerHTML;
                                            var count = td02s[i].getElementsByClassName("prodCount")[0].innerHTML;
                                            totalPrice += parseInt(price) * parseInt(count);
                                            totlaPV += parseInt(pv) * parseInt(count);
                                        }
                                        totalPriceNode.innerHTML = totalPrice + "";
                                        totalPvNode.innerHTML = totlaPV + "";
                                    }

                                </script>

                            </div>

                            <!-- 配送方式 -->
                            <div class="content-article">

                                <div class="form-name">配送方式</div>

                                <?php

                                switch ($orders->ship_no) {
                                    case 1:
                                        echo '<div class="form-input">便利商店取貨(須先付款) 60元</div>';
                                        break;
                                    case 2:
                                        echo '<div class="form-input">宅配/快遞 60元</div>';
                                        break;
                                    case 3:
                                        echo '<div class="form-input">宅配/快遞(貨到付款) 60元</div>';
                                        break;
                                    case 4:
                                        echo '<div class="form-input">營業據點取貨(須先付款) 60元</div>';
                                        break;
                                }

                                ?>

                                <div class="price-area">

                                    <div class="price-textarea">+運費：</div>

                                    <div class="price-textarea">--</div>

                                    <div class="price-textarea">元</div>

                                </div>

                                <div class="price-area">

                                    <div class="price-textarea">訂單總金額：</div>

                                    <div class="price-textarea">--</div>

                                    <div class="price-textarea">元</div>

                                </div>

                            </div>

                            <!-- 折抵方式 -->
                            <div class="content-article">

                                <div class="form-name">折抵方式</div>

                                <?php
                                switch ($orders->discount) {
                                    case 0:
                                        echo '<div class="form-input">不使用折抵</div>';
                                        break;
                                    case 1:
                                        echo '<div class="form-input">使用電子錢包折抵</div>';
                                        echo '<div class="form-tittle">折抵金額：<div class="form-input-2">' . $orders->discount_price . '</div></div>';
                                        break;
                                    case 2:
                                        echo '<div class="form-input">使用紅利折抵</div>';
                                        echo '<div class="form-tittle">折抵金額：<div class="form-input-2">' . $orders->discount_price . '</div></div>';
                                        break;
                                }
                                ?>

                                <div class="price-area">

                                    <div class="price-textarea">應付總金額</div>

                                    <div class="price-textarea">--</div>

                                    <div class="price-textarea">元</div>

                                </div>

                            </div>

                            <!-- 付款方式 -->
                            <div class="content-article">

                                <div class="form-name">付款方式</div>

                                <?php

                                switch ($orders->pay_no) {
                                    case 1:
                                        echo '<div class="form-input">信用卡付款(一次付清)</div>';
                                        break;
                                    case 2:
                                        echo '<div class="form-input">信用卡付款(分期)</div>';
                                        break;
                                    case 3:
                                        echo '<div class="form-input">貨到付款(宅配)</div>';
                                        break;
                                }
                                ?>

                            </div>

                            <!-- 取貨門市 -->
                            <div class="content-article">

                                <div class="form-name">取貨門市</div>

                                <!--<div class="form-input">便利商店名稱(資料填入)</div>-->

                                <div class="form-tittle">門市名稱：
                                    <div class="form-input-2"><?= $orders->store_name ?></div>
                                </div>

                                <div class="form-tittle">門市地址：
                                    <div class="form-input-2"><?= $orders->store_addr ?></div>
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
                                        break;
                                }
                                ?>

                                <hr/>

                                <div class="form-tittle">統一編號：
                                    <div class="form-input-2"><?= $orders->company_no ?></div>
                                </div>

                                <div class="form-tittle">公司抬頭：
                                    <div class="form-input-2"><?= $orders->invoice_title ?></div>
                                </div>

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


    //下拉選單判斷
    $('.sidebar-menu').click(function () {
        console.log('L1 clicked');
        var display = $(this).next('.sidebar-sub').css('display');

        $('.sidebar-sub').css('display', 'none');

        if (display == "block") {
            //$(this).next('.sidebar-sub').css('display', 'none');
            $(this).next('.sidebar-sub').slideUp();
        } else if (display == "none") {
            //$(this).next('.sidebar-sub').css('display', 'block');
            $(this).next('.sidebar-sub').slideDown();
        }
    });

    $('.sidebar-level2').click(function () {
        console.log('L2 clicked');
        var display2 = $(this).next('.sidebar-sub3').css('display');
        console.log(display2);
        $('.sidebar-sub3').css('display', 'none');

        if (display2 == "block") {
            //$(this).next('.sidebar-sub3').css('display', 'none');
            $(this).next('.sidebar-sub3').slideUp();
        } else if (display2 == "none") {
            //$(this).next('.sidebar-sub3').css('display', 'block');
            $(this).next('.sidebar-sub3').slideDown();
        }
    });

    //新增側邊欄

</script>

</body>

</html>