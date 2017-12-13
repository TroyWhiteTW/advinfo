<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);
if (!$isLogin) {
    header('Location:index.php');
    exit;
}
if (!preg_match("/cart_3.php$/", $_SERVER['HTTP_REFERER'])) {
    header('Location:index.php');
    exit;
}
?>
<?php
// 引入訂單的 DAO class
require __DIR__ . '/OrdersDAO.php';

//判斷 SESSION 裡是否有訂單資訊，若無代表是初次進入；若有代表是從後面的頁面返回，幫使用者填入訂單中已有的值
if (empty($_SESSION['orders'])) {
    $_SESSION['orders'] = serialize(new OrdersDAO());
}
$orders = $_SESSION['orders'];
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
                        <li><a>完成確認</a></li>

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

                                <li class="btn btn-default btn-sm disabled" style="margin-top: 10px">3.確認訂單資料</li>

                                <li><img src="img/process_icon.png" alt="" style="margin-top: 10px"></li>

                                <li class="btn btn-danger btn-sm disabled" style="margin-top: 10px">4.完成確認</li>

                            </ul>

                        </div>

                        <div class="content-article">

                            <div class="form-tittle">親愛的會員你好：</div>

                            <div class="form-content"><br><br>訂單已完成，感謝您的購買！<br><br><br></div>

                        </div>

                        <div class="btn-area">

                            <a href="index.php" class="btn btn-success">返回首頁</a>

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