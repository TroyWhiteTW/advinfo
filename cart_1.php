<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);
?>
<?php
//強制開啟 PHP 錯誤訊錫
ini_set('display_errors', '1');
error_reporting(E_ALL);

// 引入訂單的 DAO class
require __DIR__ . '/OrdersDAO.php';

//判斷 SESSION 裡是否有訂單資訊，若無代表是初次進入；若有代表是從後面的頁面返回，幫使用者填入訂單中已有的值
if (empty($_SESSION['orders'])) {
    $_SESSION['orders'] = serialize(new OrdersDAO());
}
$orders = $_SESSION['orders'];
//echo serialize($orders);
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

                                <li class="btn btn-danger disabled">1.確認商品</li>

                                <li><img src="img/process_icon.png" alt=""></li>

                                <li class="btn btn-default disabled">2.收件人資訊</li>

                                <li><img src="img/process_icon.png" alt=""></li>

                                <li class="btn btn-default disabled">3.確認訂單資料</li>

                                <li><img src="img/process_icon.png" alt=""></li>

                                <li class="btn btn-default disabled">4.完成確認</li>

                            </ul>

                        </div>

                        <form method="post" action="cart_1_to_2.php">

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
                                        <td>刪除</td>
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
                                        $html[] = '<td>';
                                        $html[] = '<select>';
                                        // select -> option
                                        $optionCount = ($recordArray[$i]['stock'] > 10 ? 10 : $recordArray[$i]['stock']);
                                        for ($j = 1; $j <= $optionCount; $j++) {
                                            if ($j == $_SESSION['shop_cart'][$recordArray[$i]['proid']]) {
                                                $html[] = '<option value="' . $j . '" selected>' . $j . '</option>';
                                            } else {
                                                $html[] = '<option value="' . $j . '">' . $j . '</option>';
                                            }
                                        }
                                        // select -> option
                                        $html[] = '</select>';
                                        $html[] = '</td>';
                                        // 價格
                                        $html[] = '<td>';
                                        $html[] = $recordArray[$i]['price'];
                                        $html[] = '</td>';
                                        // PV
                                        $html[] = '<td>';
                                        $html[] = $recordArray[$i]['PV'];
                                        $html[] = '</td>';
                                        // 刪除
                                        $html[] = '<td>';
                                        $html[] = '<button onclick="deleteProd(this,' . $recordArray[$i]['proid'] . ')" class="glyphicon glyphicon-trash"></button>';
                                        $html[] = '</td>';

                                        $html[] = '</tr>';
                                    }

                                    echo implode("\n", $html);

                                    ?>

                                    </tbody>

                                </table>
                                <script>
                                    function deleteProd(node, id) {
                                        $.ajax({
                                            url: "./delete_prod.php",
                                            type: 'POST',
                                            data: {
                                                proid: id
                                            },
                                            error: function () {
                                                alert('發生錯誤');
                                            },
                                            success: function (response) {
                                                alert('成功刪除');
                                                node.parentNode.parentNode.parentNode.removeChild(node.parentNode.parentNode);
                                            }
                                        });
                                    }
                                </script>

                                <div class="pv-area">
                                    <div class="pv-textarea">商品總PV</div>
                                    <div class="pv-textarea">XXXX</div>
                                    <div class="pv-textarea">PV</div>
                                </div>

                                <div class="price-area">
                                    <div class="price-textarea">商品總金額</div>
                                    <div class="price-textarea">XXXX</div>
                                    <div class="price-textarea">元</div>
                                </div>

                            </div>

                            <!-- 配送方式 -->
                            <div class="content-article">

                                <div class="form-name">
                                    配送方式
                                </div>

                                <div class="form-tittle">
                                    <label>
                                        <input type="radio" name="ship_no" value="1">
                                        便利商店取貨(須先付款)60元
                                    </label>
                                </div>

                                <div class="form-tittle">
                                    <label>
                                        <input type="radio" name="ship_no" value="2">
                                        宅配/快遞 60元
                                    </label>
                                </div>

                                <div class="form-tittle">
                                    <label>
                                        <input type="radio" name="ship_no" value="3">
                                        宅配/快遞(貨到付款)60元
                                    </label>
                                </div>

                                <div class="form-tittle">

                                    <label>
                                        <input type="radio" name="ship_no" value="4">
                                        營業據點取貨(須先付款)60元
                                    </label>

                                    <div class="form-tittle" style="margin-left:20px;">
                                        <select>
                                            <option selected="selected" value="0">請選擇營業據點</option>
                                            <option value="1">A</option>
                                            <option value="2">B</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="info-area">
                                    <div class="info-textarea">根據訂單商品及配送方式計算運費</div>
                                </div>

                                <div class="price-area">
                                    <div class="price-textarea">+運費：</div>
                                    <div class="price-textarea">--</div>
                                    <div class="price-textarea">元</div>
                                </div>

                                <div class="price-area">
                                    <div class="price-textarea">應付總金額：</div>
                                    <div class="price-textarea">XXX</div>
                                    <div class="price-textarea">元</div>
                                </div>

                            </div>

                            <!-- 折抵方式 -->
                            <div class="content-article">

                                <div class="form-name">
                                    折抵方式
                                </div>

                                <div class="form-tittle">
                                    <label>
                                        <input type="radio" name="discount" value="1">
                                        不使用折抵
                                    </label>
                                </div>

                                <div class="form-tittle">
                                    <label>
                                        <input type="radio" name="discount" value="2">
                                        使用電子錢包折抵
                                    </label>
                                </div>

                                <div class="form-tittle">
                                    <label>
                                        <input type="radio" name="discount" value="3">
                                        使用紅利折抵
                                    </label>
                                </div>

                                <div class="form-tittle">

                                    <div class="price-textarea">
                                        餘額
                                    </div>

                                    <div class="price-textarea" style="color:blue;">
                                        xxxx
                                    </div>

                                    <div class="price-textarea unit">
                                        元
                                    </div>

                                </div>

                                <div class="form-tittle">
                                    折抵金額：
                                    <input type="text" name="discount_price" id="" class="input-6">
                                    元
                                </div>

                                <div class="price-area">
                                    <div class="price-textarea">應付總金額：</div>
                                    <div class="price-textarea">XXX</div>
                                    <div class="price-textarea">元</div>
                                </div>

                            </div>

                            <!-- 付款方式 -->
                            <div class="content-article">

                                <div class="form-name">付款方式</div>

                                <div class="form-tittle">
                                    <label>
                                        <input type="radio" name="pay_no" value="1">
                                        信用卡一次付清
                                    </label>
                                </div>

                                <div class="form-tittle">
                                    <label>
                                        <input type="radio" name="pay_no" value="2">
                                        信用卡付款(分期)
                                    </label>
                                </div>

                                <div class="form-tittle">
                                    <label>
                                        <input type="radio" name="pay_no" value="3">
                                        貨到付款(宅配)
                                    </label>
                                </div>

                            </div>

                            <!-- 發票資訊-->
                            <div class="content-article">

                                <div class="form-name">發票資訊</div>

                                <div class="form-tittle">
                                    <label>
                                        <input type="radio" name="invoice" value="1">
                                        個人發票
                                    </label>
                                </div>

                                <div class="form-tittle">
                                    <label>
                                        <input type="radio" name="invoice" value="2">
                                        公司戶頭票
                                    </label>
                                </div>

                                <div class="form-tittle">統一編號：<input name="company_no" id="" type="text" class="input-2"></div>

                                <div class="form-tittle">公司抬頭：<input name="invoice_title" id="" type="text" class="input-2"></div>

                            </div>

                            <div class="btn-area"><input type="submit" value="確認，下一步"></a></div>

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
