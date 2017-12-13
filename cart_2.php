<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);
if (!$isLogin) {
    header('Location:index.php');
    exit;
}
if (!preg_match("/cart_1\.php$/", $_SERVER['HTTP_REFERER']) &&
    !preg_match("/cart_3\.php$/", $_SERVER['HTTP_REFERER']) &&
    !preg_match("/showstore\.asp/", $_SERVER['HTTP_REFERER'])) {
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
//echo serialize($orders);
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
                        <li><a href="cart_1.php">購物車</a></li>
                        <li><img src="img/process_icon.png" alt=""></li>
                        <li><a>收件人資訊</a></li>

                    </ul>

                </div>

                <?php if ($isLogin): ?>

                    <div class="content-area">

                        <div class="cart-area">

                            <ul>

                                <li class="btn btn-default btn-sm disabled" style="margin-top: 10px">1.確認商品</li>

                                <li><img src="img/process_icon.png" alt="" style="margin-top: 10px"></li>

                                <li class="btn btn-danger btn-sm disabled" style="margin-top: 10px">2.收件人資訊</li>

                                <li><img src="img/process_icon.png" alt="" style="margin-top: 10px"></li>

                                <li class="btn btn-default btn-sm disabled" style="margin-top: 10px">3.確認訂單資料</li>

                                <li><img src="img/process_icon.png" alt="" style="margin-top: 10px"></li>

                                <li class="btn btn-default btn-sm disabled" style="margin-top: 10px">4.完成確認</li>

                            </ul>

                        </div>

                        <form method="post" action="cart_2_to_3.php">

                            <!-- 訂購人資料 -->
                            <div class="content-article">

                                <div class="form-name">訂購人資料</div>

                                <div class="form-tittle">
                                    姓名：
                                    <input name="sub_name" id="" type="text" class="input-2"
                                           value="<?= $_SESSION['user2']['name'] ?>">
                                </div>

                                <div class="form-tittle">
                                    電子信箱：
                                    <input name="sub_email" id="" type="text" class="input-3" size="40"
                                           value="<?= $_SESSION['user2']['email'] ?>">
                                </div>

                                <div class="form-tittle">
                                    聯繫電話：
                                    <input name="sub_phone" id="" type="text" class="input-2"
                                           value="<?= $_SESSION['user2']['phone'] ?>">
                                </div>

                                <div class="form-tittle">
                                    <span style="color:red;">*</span>
                                    手機：
                                    <input name="sub_mobile" id="" type="text" class="input-2"
                                           value="<?= $_SESSION['user2']['mobile'] ?>">
                                </div>

                                <div class="form-tittle">
                                    <span style="color:red;">*</span>
                                    聯繫地址：
                                    <!--                                    <input type="checkbox" checked="checked">-->
                                    <!--                                    台澎金馬-->
                                    <!--                                    <span style="color:red; font-size:12px;">(預設勾選)</span>-->

                                    <div class="form-tittle">

                                        <!--                                        <select name="" id="">-->
                                        <!--                                            <option selected="selected" value="0">請選擇縣市</option>-->
                                        <!--                                            <option value="1">B</option>-->
                                        <!--                                            <option value="2">C</option>-->
                                        <!--                                        </select>-->
                                        <!---->
                                        <!--                                        <select name="" id="">-->
                                        <!--                                            <option selected="selected" value="0">請選擇區別</option>-->
                                        <!--                                            <option value="1">B</option>-->
                                        <!--                                            <option value="2">C</option>-->
                                        <!--                                        </select>-->

                                        <div class="form-tittle">
                                            <input size="40" name="sub_address" id="" type="text" class="input-3"
                                                   value="<?= $_SESSION['user2']['city'] . $_SESSION['user2']['area'] . $_SESSION['user2']['address'] ?>">
                                        </div>

                                    </div>

                                </div>

                            </div>

                            <!-- 收件人資料 -->
                            <div id="rec_set" class="content-article">

                                <div class="form-name">收件人資料</div>

                                <div class="form-tittle">
                                    <div class="check-box">
                                        <input name="rec_check" id="rec_check" type="checkbox" checked>
                                    </div>
                                    同步為訂購人資料
                                </div>

                                <div class="form-tittle">
                                    姓名：
                                    <input name="rec_name" id="" type="text" class="input-2"
                                           value="<?= $_SESSION['user2']['name'] ?>" disabled="disabled">
                                </div>

                                <div class="form-tittle">
                                    電子信箱：
                                    <input name="rec_email" id="" type="text" class="input-3" size="40"
                                           value="<?= $_SESSION['user2']['email'] ?>" disabled="disabled">
                                </div>

                                <div class="form-tittle">
                                    聯繫電話：
                                    <input name="rec_phone" id="" type="text" class="input-2"
                                           value="<?= $_SESSION['user2']['phone'] ?>" disabled="disabled">
                                </div>

                                <div class="form-tittle">
                                    <span style="color:red;">*</span>
                                    手機：
                                    <input name="rec_mobile" id="" type="text" class="input-2"
                                           value="<?= $_SESSION['user2']['mobile'] ?>" disabled="disabled">
                                </div>

                                <div class="form-tittle">
                                    <span style="color:red;">*</span>
                                    配送地址：
                                    <!--                                    <input type="checkbox" checked="checked">-->
                                    <!--                                    台澎金馬-->
                                    <!--                                    <span style="color:red; font-size:12px;">(預設勾選)</span>-->

                                    <div class="form-tittle">

                                        <!--                                        <select name="" id="">-->
                                        <!--                                            <option selected="selected" value="0">請選擇縣市</option>-->
                                        <!--                                            <option value="1">B</option>-->
                                        <!--                                            <option value="2">C</option>-->
                                        <!--                                        </select>-->
                                        <!---->
                                        <!--                                        <select name="" id="">-->
                                        <!--                                            <option selected="selected" value="0">請選擇區別</option>-->
                                        <!--                                            <option value="1">B</option>-->
                                        <!--                                            <option value="2">C</option>-->
                                        <!--                                        </select>-->

                                        <div class="form-tittle">
                                            <input size="40" disabled="disabled" name="rec_address" id="" type="text"
                                                   class="input-3"
                                                   value="<?= $_SESSION['user2']['city'] . $_SESSION['user2']['area'] . $_SESSION['user2']['address'] ?>">
                                        </div>

                                    </div>

                                </div>

                            </div>

                            <script>
                                var recCheck = $('#rec_check')[0];
                                recCheck.addEventListener('change', function () {
                                    enableRecInput(this.checked);
                                });

                                function enableRecInput(enable) {
                                    var nodes = document.getElementById('rec_set').getElementsByTagName('input');
                                    for (var n in nodes) {
                                        if (nodes[n].type === 'text') {
                                            nodes[n].disabled = enable;
                                            if (enable) {

                                            } else {
                                                nodes[n].value = '';
                                            }
                                        }
                                    }
                                    if (enable) {
                                        $('input[name="rec_name"]')[0].value = $('input[name="sub_name"]')[0].value;
                                        $('input[name="rec_email"]')[0].value = $('input[name="sub_email"]')[0].value;
                                        $('input[name="rec_phone"]')[0].value = $('input[name="sub_phone"]')[0].value;
                                        $('input[name="rec_mobile"]')[0].value = $('input[name="sub_mobile"]')[0].value;
                                        $('input[name="rec_address"]')[0].value = $('input[name="sub_address"]')[0].value;
                                    }
                                }
                            </script>

                            <!-- 取貨門市 -->
                            <?php
                            $sql = "select shippings.*,logistics.name as logname from shippings 
                                    LEFT JOIN logistics ON logistics.no=shippings.logno where shippings.no='" . $orders->ship_no . "'";
                            $rs = mysqli_query($conn, $sql);
                            $rst = mysqli_fetch_assoc($rs);
                            if ($rst["logname"] == "便利達康") {
                                ?>
                                <div class="content-article">

                                    <div class="form-name">取貨門市</div>

                                    <div class="function-area">

                                        <ul>

                                            <li>
                                                <a href="http://cvs.map.com.tw/default.asp?cvsname=advinfo.taironlife.com&cvstemp=cart">
                                                    <input type="button" id="" name="" class="" value="選擇取貨門市">
                                                </a>
                                            </li>

                                        </ul>

                                    </div>

                                    <div class="form-tittle">
                                        門市名稱：
                                        <div class="form-input-2">
                                            <?php
                                            if ($_SESSION['user2']['constore']['name'] != "") {
                                                echo $_SESSION['user2']['constore']['name'];;
                                            } else {
                                                echo $_SESSION['user2']['constore']['name'];
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-tittle">
                                        門市地址：
                                        <div class="form-input-2">
                                            <?php
                                            if ($_SESSION['user2']['constore']['addr'] != "") {
                                                echo $_SESSION['user2']['constore']['addr'];;
                                            } else {
                                                echo $_SESSION['user2']['constore']['addr'];
                                            }
                                            ?>
                                        </div>
                                    </div>

                                </div>
                            <?php } ?>

                            <div class="btn-area">

                                <a href="cart_1.php" class="btn btn-warning">返回上一步</a>

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
</script>

</body>

</html>