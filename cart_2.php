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

                    </ul>

                </div>

                <?php if ($isLogin): ?>

                    <div class="content-area">

                        <div class="cart-area">

                            <ul>

                                <li class="btn btn-default disabled">1.確認商品</li>

                                <li><img src="img/process_icon.png" alt=""></li>

                                <li class="btn btn-danger disabled">2.收件人資訊</li>

                                <li><img src="img/process_icon.png" alt=""></li>

                                <li class="btn btn-default disabled">3.確認訂單資料</li>

                                <li><img src="img/process_icon.png" alt=""></li>

                                <li class="btn btn-default disabled">4.完成確認</li>

                            </ul>

                        </div>

                        <form method="post" action="cart_2_to_3.php">

                            <!-- 訂購人資料 -->
                            <div class="content-article">

                                <div class="form-name">訂購人資料</div>

                                <div class="form-tittle">
                                    姓名：
                                    <input name="sub_name" id="" type="text" class="input-2">
                                </div>

                                <div class="form-tittle">
                                    電子信箱：
                                    <input name="sub_email" id="" type="text" class="input-2">
                                </div>

                                <div class="form-tittle">
                                    聯繫電話：
                                    <input name="sub_phone" id="" type="text" class="input-2">
                                </div>

                                <div class="form-tittle">
                                    <span style="color:red;">*</span>
                                    手機：
                                    <input name="sub_mobile" id="" type="text" class="input-2">
                                </div>

                                <div class="form-tittle">
                                    <span style="color:red;">*</span>
                                    聯繫地址：
                                    <input type="checkbox" checked="checked">
                                    台澎金馬
                                    <span style="color:red; font-size:12px;">(預設勾選)</span>

                                    <div class="form-tittle">

                                        <select name="" id="">
                                            <option selected="selected" value="0">請選擇縣市</option>
                                            <option value="1">B</option>
                                            <option value="2">C</option>
                                        </select>

                                        <select name="" id="">
                                            <option selected="selected" value="0">請選擇區別</option>
                                            <option value="1">B</option>
                                            <option value="2">C</option>
                                        </select>

                                        <div class="form-tittle">
                                            <input name="sub_address" id="" type="text" class="input-3">
                                        </div>

                                    </div>

                                </div>

                            </div>

                            <!-- 收件人資料 -->
                            <div class="content-article">

                                <div class="form-name">收件人資料</div>

                                <div class="form-tittle">
                                    <div class="check-box">
                                        <input type="checkbox">
                                    </div>
                                    同步為訂購人資料
                                </div>

                                <div class="form-tittle">
                                    姓名：
                                    <input name="rec_name" id="" type="text" class="input-2">
                                </div>

                                <div class="form-tittle">
                                    電子信箱：
                                    <input name="rec_email" id="" type="text" class="input-2">
                                </div>

                                <div class="form-tittle">
                                    聯繫電話：
                                    <input name="rec_phone" id="" type="text" class="input-2">
                                </div>

                                <div class="form-tittle">
                                    <span style="color:red;">*</span>
                                    手機：
                                    <input name="rec_mobile" id="" type="text" class="input-2">
                                </div>

                                <div class="form-tittle">
                                    <span style="color:red;">*</span>
                                    聯繫地址：
                                    <input type="checkbox" checked="checked">
                                    台澎金馬
                                    <span style="color:red; font-size:12px;">(預設勾選)</span>

                                    <div class="form-tittle">

                                        <select name="" id="">
                                            <option selected="selected" value="0">請選擇縣市</option>
                                            <option value="1">B</option>
                                            <option value="2">C</option>
                                        </select>

                                        <select name="" id="">
                                            <option selected="selected" value="0">請選擇區別</option>
                                            <option value="1">B</option>
                                            <option value="2">C</option>
                                        </select>

                                        <div class="form-tittle">
                                            <input name="rec_address" id="" type="text" class="input-3">
                                        </div>

                                    </div>

                                </div>

                            </div>

                            <!-- 取貨門市 -->
                            <div class="content-article">

                                <div class="form-name">取貨門市</div>

                                <div class="function-area">

                                    <ul>

                                        <li>
                                            <a href="">
                                                <input type="button" id="" name="" class="" value="全家取貨門市">
                                            </a>
                                        </li>

                                        <li>
                                            <a href="">
                                                <input type="button" id="" name="" class="" value="OK取貨門市">
                                            </a>
                                        </li>

                                        <li>
                                            <a href="">
                                                <input type="button" id="" name="" class="" value="萊爾富取貨門市">
                                            </a>
                                        </li>

                                    </ul>

                                </div>

                                <div class="form-tittle">
                                    門市名稱：
                                    <input name="store_name" id="" type="text" class="input-2">
                                </div>

                                <div class="form-tittle">
                                    門市地址：
                                    <input name="store_addr" id="" type="text" class="input-2">
                                </div>

                            </div>

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