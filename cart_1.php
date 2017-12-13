<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);
if (!$isLogin) {
    header('Location:login.php');
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

// 配送方式
$shiptypes = [];
$shiptypesSql = 'SELECT shiptypes.no, shiptypes.name, shiptypes.type, logistics.name as logname, shippings.* FROM shiptypes 
										LEFT JOIN shippings ON shiptypes.no=shippings.shiptype 
										LEFT JOIN logistics ON logistics.no=shippings.logno
										WHERE shippings.status=1 and shippings.forSupplier=1';
$shiptypesRes = mysqli_query($conn, $shiptypesSql);
while ($shiptypesRow = mysqli_fetch_assoc($shiptypesRes)) {
    $shiptypes[] = $shiptypesRow;
}

// 付款方式
$payments = [];
$paymentsSql = 'SELECT * FROM payments WHERE status=1 and forSupplier=1 order by type desc,installment';
$paymentsRes = mysqli_query($conn, $paymentsSql);
while ($paymentsRow = mysqli_fetch_assoc($paymentsRes)) {
    $payments[] = $paymentsRow;
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

                        <li><a href="index.php">首頁</a>
                        </li>
                        <li><img src="img/process_icon.png" alt="">
                        </li>
                        <li><a href="cart_1.php">購物車</a>
                        </li>
                        <li><img src="img/process_icon.png" alt="">
                        </li>
                        <li><a>確認商品</a>
                        </li>

                    </ul>

                </div>

                <?php if ($isLogin): ?>

                    <div class="content-area">

                        <div class="cart-area">

                            <ul>

                                <li class="btn btn-danger btn-sm disabled" style="margin-top: 10px">1.確認商品</li>

                                <li><img src="img/process_icon.png" alt="" style="margin-top: 10px"></li>

                                <li class="btn btn-default btn-sm disabled" style="margin-top: 10px">2.收件人資訊</li>

                                <li><img src="img/process_icon.png" alt="" style="margin-top: 10px"></li>

                                <li class="btn btn-default btn-sm disabled" style="margin-top: 10px">3.確認訂單資料</li>

                                <li><img src="img/process_icon.png" alt="" style="margin-top: 10px"></li>

                                <li class="btn btn-default btn-sm disabled" style="margin-top: 10px">4.完成確認</li>

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
                                        <td>刪除</td>
                                    </tr>

                                    <?php
                                    $size = 0;        //長度限制
                                    $maxsize = 0;    //單邊最大長度
                                    $weight = 0;    //重量限制
                                    $units = 0;        //才數限制(宅配: 新竹物流)

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
                                        $html[] = '\'' . $recordArray[$i]['proid'] . '\'';
                                        $html[] = '<span style="color:red;">';
                                        $html[] = '</span>';
                                        $html[] = '</td>';
                                        // 數量
                                        $html[] = '<td>';
                                        $html[] = '<select name="' . $recordArray[$i]['proid'] . '" class="prodCount" onchange="doTotal();doFedexTotal();" >';
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
                                        $html[] = '<td class="priceValue">';
                                        $html[] = $recordArray[$i]['price'];
                                        $html[] = '</td>';
                                        // PV
                                        $html[] = '<td class="pvValue">';
                                        switch ($_SESSION['user2']['type']) {
                                            case 1:
                                                $html[] = $recordArray[$i]['bonuce'];
                                                break;
                                            case 2:
                                                $html[] = $recordArray[$i]['PV'];
                                                break;
                                        }
                                        $html[] = '</td>';
                                        // 刪除
                                        $html[] = '<td>';
                                        $html[] = '<div style="cursor:pointer;" onclick="deleteProd(this,' . '\'' . $recordArray[$i]['proid'] . '\'' . ')" class="glyphicon glyphicon-trash"></div>';
                                        $html[] = '</td>';

                                        $html[] = '</tr>';

                                        $a = $recordArray[$i]['size'];
                                        $regex = '/[^(0-9\.)]+/';
                                        $b = preg_split($regex, $a);
                                        $c = array_filter($b, function ($i) {
                                            return $i != "";
                                        });

                                        //單邊最大長度
                                        if ($c[1] >= $maxsize) {
                                            $maxsize = $c[1];
                                        }        //長
                                        if ($c[2] >= $maxsize) {
                                            $maxsize = $c[2];
                                        }        //寬
                                        if ($c[3] >= $maxsize) {
                                            $maxsize = $c[3];
                                        }        //高

                                        //計算長度(長+寬+高)
                                        $size += $c[1] + $c[2] + $c[3];

                                        //計算重量
                                        $weight += $recordArray[$i]['weight'];

                                        //計算才數(長*寬*高/27000)
                                        $units += ceil(($c[1] * $c[2] * $c[3]) / 27000);
                                    }

                                    echo implode("\n", $html);

                                    ?>

                                    </tbody>

                                </table>

                                <script>
                                    function deleteProd(node, id) {
                                        if (confirm("確定從購物車移除此商品?")) {
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
                                                    //alert('成功刪除');
                                                    node.parentNode.parentNode.parentNode.removeChild(node.parentNode.parentNode);
                                                    doTotal();
                                                    doFedexTotal();
                                                    updateSubmitStatus();
                                                    //更新購物車數量
                                                    $.post('./add_cart.php', {act: 'getCount'}, function (response) {
                                                        eval(response);
                                                    });
                                                }
                                            });
                                        }
                                    }
                                </script>

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
                                    <div id="tpv" class="pv-textarea"></div>
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
                                    <div id="tpc" class="price-textarea"></div>
                                    <div class="price-textarea">元</div>
                                </div>

                                <script>
                                    var totalPvNode = $('#tpv')[0];
                                    var totalPriceNode = $('#tpc')[0];

                                    doTotal();

                                    function doTotal() {
                                        var totalPrice = 0;
                                        var totlaPV = 0;
                                        var tbody = document.getElementsByTagName("tbody")[0];
                                        var td02s = tbody.getElementsByClassName("td-02");
                                        for (var i = 0; i < td02s.length; i++) {
                                            var price = td02s[i].getElementsByClassName("priceValue")[0].innerHTML;
                                            var pv = td02s[i].getElementsByClassName("pvValue")[0].innerHTML;
                                            var count = getSelectedNode(td02s[i].getElementsByClassName("prodCount")[0]).value;
                                            totalPrice += parseInt(price) * parseInt(count);
                                            totlaPV += parseInt(pv) * parseInt(count);
                                        }
                                        totalPriceNode.innerHTML = totalPrice + "";
                                        totalPvNode.innerHTML = totlaPV + "";
                                    }

                                    function getSelectedNode(selectNode) {
                                        var selectedNode = (function (nodes) {
                                            for (var i in nodes) {
                                                if (nodes[i].selected === true) {
                                                    return nodes[i];
                                                }
                                            }
                                        })(selectNode);
                                        return selectedNode;
                                    }
                                </script>

                            </div>

                            <!-- 配送方式 -->
                            <div id="fedex_way" class="content-article">

                                <div class="form-name">
                                    配送方式
                                </div>

                                <?php
                                //print_r($shiptypes);
                                $_shiptypes = [];
                                //過濾不可用配送方式
                                foreach ($shiptypes as $k => $shiptype) {
                                    //便利達康條件(長+寬+高<90 and 單邊長<45 and 重量<5)
                                    if ($shiptype["logname"] == "便利達康") {
                                        if ($maxsize <= 45 && $size <= $shiptype["size"] && $weight <= $shiptype["weight"]) {
                                            //unset($shiptypes[$k]);
                                            $_shiptypes[] = $shiptype;
                                        }
                                    }
                                    //新竹物流條件(<=2才)
                                    if ($shiptype["logname"] == "新竹物流") {
                                        if ($units > 0 && $units == (int)$shiptype["units"]) {
                                            //unset($shiptypes[$k]);
                                            $_shiptypes[] = $shiptype;
                                        }
                                    }
                                }
                                $shiptypes = $_shiptypes;

                                foreach ($shiptypes as $k => $shiptype) {
                                    echo '<div class="form-tittle">';
                                    echo '<label>';
                                    //if ( $shiptype[ 'no' ] == 1 ) {
                                    if ($k == 0) {
                                        echo '<input type="radio" name="ship_no" value="' . $shiptype['no'] . '" checked="checked">';
                                    } else {
                                        echo '<input type="radio" name="ship_no" value="' . $shiptype['no'] . '">';
                                    }
                                    echo $shiptype['name'];
                                    switch ($shiptype['type']) {
                                        case 1:
                                            echo '(需先付款)';
                                            break;
                                        case 2:
                                            echo '(已付款)';
                                            break;
                                        case 3:
                                            echo '(貨到付款)';
                                            break;
                                    }
                                    echo ' <span>' . $shiptype['platform'] . '</span>元';
                                    echo '</label>';
                                    echo '</div>';
                                }
                                ?>

                                <div class="info-area">
                                    <div class="info-textarea">根據訂單商品及配送方式計算運費</div>
                                </div>

                                <div class="price-area">
                                    <div class="price-textarea">+運費：</div>
                                    <div id="fedex_price" class="price-textarea">--</div>
                                    <div class="price-textarea">元</div>
                                </div>

                                <div class="price-area">
                                    <div class="price-textarea">應付總金額：</div>
                                    <div id="tpc2" class="price-textarea">XXX</div>
                                    <div class="price-textarea">元</div>
                                </div>

                            </div>

                            <script>
                                var fedexPriceNode = $('#fedex_price')[0];
                                var totalPriceNode2 = $('#tpc2')[0];

                                doFedexTotal();

                                function doFedexTotal() {
                                    var fPrice = parseInt($('#fedex_way input:checked').next()[0].innerHTML);
                                    fedexPriceNode.innerHTML = fPrice + "";

                                    totalPriceNode2.innerHTML = (parseInt(totalPriceNode.innerHTML) + fPrice) + "";
                                }

                                var ships = document.getElementsByName('ship_no');
                                for (var i = 0; i < ships.length; i++) {
                                    ships[i].addEventListener('change', function () {
                                        doFedexTotal();
                                    });
                                }
                            </script>

                            <!-- 折抵方式 -->
                            <div class="content-article">

                                <div class="form-name">
                                    折抵方式
                                </div>

                                <div class="form-tittle">
                                    <label>
                                        <input type="radio" name="discount" value="0" checked="checked">
                                        不使用折抵
                                    </label>
                                </div>

                                <?php
                                switch ($_SESSION['user2']['type']) {
                                    case 1:
                                        echo '<div class="form-tittle"><label><input type="radio" name="discount" value="2">使用紅利折抵</label></div>';
                                        break;
                                    case 2:
                                        echo '<div class="form-tittle"><label><input type="radio" name="discount" value="1">使用電子錢包折抵</label></div>';
                                        break;
                                }
                                ?>

                                <!--                                <div class="form-tittle">-->
                                <!---->
                                <!--                                    <div class="price-textarea">-->
                                <!--                                        餘額-->
                                <!--                                    </div>-->
                                <!---->
                                <!--                                    <div class="price-textarea" style="color:blue;">-->
                                <!--                                        xxxx-->
                                <!--                                    </div>-->
                                <!---->
                                <!--                                    <div class="price-textarea unit">-->
                                <!--                                        元-->
                                <!--                                    </div>-->
                                <!---->
                                <!--                                </div>-->

                                <div class="form-tittle">
                                    折抵金額：
                                    <input type="text" name="discount_price" id="" class="input-6"> 元
                                </div>

                                <div class="price-area">
                                    <div class="price-textarea">應付總金額：</div>
                                    <div class="price-textarea">--</div>
                                    <div class="price-textarea">元</div>
                                </div>

                            </div>

                            <!-- 付款方式 -->
                            <div class="content-article">

                                <div class="form-name">付款方式</div>

                                <?php
                                foreach ($payments as $k => $payment) {
                                    //if ( $payment[ 'name' ] == 'ATM' ) {
                                    echo '<div class="form-tittle">';
                                    echo '<label>';
                                    if ($k == 0) {
                                        echo '<input type="radio" name="pay_no" checked value="' . $payment['no'] . '">';
                                    } else {
                                        echo '<input type="radio" name="pay_no" value="' . $payment['no'] . '">';
                                    }
                                    echo $payment['name'];
                                    echo '</label>';
                                    echo '</div>';
                                    //}
                                }
                                //								foreach ( $payments as $payment ) {
                                //									if ( $payment[ 'name' ] != 'ATM' ) {
                                //										echo '<div class="form-tittle">';
                                //										echo '<label>';
                                //										echo '<input type="radio" name="pay_no" value="' . $payment[ 'no' ] . '">';
                                //										echo $payment[ 'name' ];
                                //										echo '</label>';
                                //										echo '</div>';
                                //									}
                                //								}
                                ?>

                            </div>

                            <!-- 發票資訊-->
                            <div class="content-article">

                                <div class="form-name">發票資訊</div>

                                <div class="form-tittle">
                                    <label>
                                        <input type="radio" name="invoice" value="1" checked="checked">
                                        個人發票
                                    </label>

                                </div>

                                <div class="form-tittle">
                                    <label>
                                        <input type="radio" name="invoice" value="2">
                                        公司戶頭票
                                    </label>

                                </div>

                                <div class="form-tittle">
                                    統一編號：
                                    <input name="company_no" id="" type="text" class="input-2" disabled="disabled">
                                </div>

                                <div class="form-tittle">
                                    公司抬頭：
                                    <input name="invoice_title" id="" type="text" class="input-2" disabled="disabled">
                                </div>

                            </div>

                            <script>
                                var personalInvNode = document.getElementsByName('invoice')[0];
                                var componyInvNode = document.getElementsByName('invoice')[1];

                                personalInvNode.addEventListener('change', allowInvInput.bind(null, true));
                                componyInvNode.addEventListener('change', allowInvInput.bind(null, false));

                                function allowInvInput(allow) {
                                    document.getElementsByName('company_no')[0].disabled = allow;
                                    document.getElementsByName('invoice_title')[0].disabled = allow;
                                }
                            </script>

                            <div class="btn-area">

                                <?php
                                if (empty($_SESSION['shop_cart']) || count($_SESSION['shop_cart']) === 0) {
                                    echo '<input id="cart1submit" type="submit" class="btn btn-success" value="確認，下一步" disabled="disabled">';
                                } else {
                                    echo '<input id="cart1submit" type="submit" class="btn btn-success" value="確認，下一步">';
                                }
                                ?>

                                <script>
                                    function updateSubmitStatus() {
                                        var count = document.getElementsByClassName('td-02').length;
                                        if (count === 0) {
                                            document.getElementById('cart1submit').disabled = true;
                                        }
                                    }
                                </script>

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
</script>

</body>

</html>