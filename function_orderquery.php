<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);
?>
<?php
// TODO: 待補側邊攔，目前是 hard code
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
                                    <td colspan="2">訂單編號</td>
                                </tr>
                                <tr class="td-02">
                                    <td colspan="2"><a href="function_orderinquire.php">xxxxxxxxxxxx</a></td>
                                </tr>
                                <tr class="tb-tittle">
                                    <td>日期</td>
                                    <td>狀態</td>
                                </tr>
                                <tr class="td-02">
                                    <td>2017/07/21</td>
                                    <td>成立</td>
                                </tr>
                                </tbody>
                            </table>
                            <table width="100%" border="1">
                                <tbody>
                                <tr class="tb-tittle">
                                    <td>總金額</td>
                                    <td>折抵</td>
                                    <td>應付金額</td>
                                </tr>
                                <tr class="td-02">
                                    <td>$99,999</td>
                                    <td>$99,999</td>
                                    <td>$99,999</td>
                                </tr>
                                <tr class="tb-tittle">
                                    <td>PV值</td>
                                    <td>折抵方式</td>
                                    <td>付款方式</td>
                                </tr>
                                <tr class="td-02">
                                    <td>99,999</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                </tbody>
                            </table>
                            <table width="100%" border="1">
                                <tbody>
                                <tr class="tb-tittle">
                                    <td>退貨</td>
                                    <td>明細</td>
                                </tr>
                                <tr class="td-02">
                                    <td>退貨</td>
                                    <td><a href="function_orderinquire.php">明細</a></td>
                                </tr>
                                </tbody>
                            </table>
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
