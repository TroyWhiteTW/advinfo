<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);

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
                                <li>
                                    <a href="function_member.php">
                                        <input type="button" id="" name="" class="" value="個人資料">
                                    </a>
                                </li>
                                <li>
                                    <a href="function_orderquery.php">
                                        <input type="button" id="" name="" class="" value="訂單查詢">
                                    </a>
                                </li>
                                <li>
                                    <a href="function_bonusquery.php">
                                        <input type="button" id="" name="" class="tag-value-select" value="重銷獎金查詢/規則">
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <?php
                        //商城會員獎金自己顯示
                        if ($_SESSION['user2']["type"] == "1") {
                            ?>
                            <div class="content-article">
                                <div class="text-1" style="display:inline-block;">本期重銷累積獎金資料(預估資料)
                                    <div style="display:inline-block;"><a href="#rule"><span
                                                    style="color:blue;">重銷規則</span></a>
                                    </div>
                                </div>
                                <table width="100%" border="1" style="margin-top:10px;">
                                    <tbody>
                                    <tr class="tb-tittle">
                                        <td>週期</td>
                                        <td>目前責任額</td>
                                        <td>實際消費</td>
                                        <td>達成與否</td>
                                        <td>累積獎金</td>
                                    </tr>
                                    <tr class="td-02">
                                        <td>2017/7/20-2017/8/20</td>
                                        <td>1000PV</td>
                                        <td>1000PV</td>
                                        <td>是</td>
                                        <td>$14,443</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <table width="100%" border="1" style="margin-top:10px;">
                                    <tbody>
                                    <tr class="tb-tittle">
                                        <td>代數</td>
                                        <td>金額</td>
                                        <td>代數</td>
                                        <td>金額</td>
                                        <td>代數</td>
                                        <td>金額</td>
                                    </tr>
                                    <tr class="td-02">
                                        <td>1</td>
                                        <td>$1,111</td>
                                        <td>6</td>
                                        <td>$1,111</td>
                                        <td>11</td>
                                        <td>$1,111</td>
                                    </tr>
                                    <tr class="td-02">
                                        <td>2</td>
                                        <td>$1,111</td>
                                        <td>7</td>
                                        <td>$1,111</td>
                                        <td>12</td>
                                        <td>$1,111</td>
                                    </tr>
                                    <tr class="td-02">
                                        <td>3</td>
                                        <td>$1,111</td>
                                        <td>8</td>
                                        <td>$1,111</td>
                                        <td>13</td>
                                        <td>$1,111</td>
                                    </tr>
                                    <tr class="td-02">
                                        <td>4</td>
                                        <td>$1,111</td>
                                        <td>9</td>
                                        <td>$1,111</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr class="td-02">
                                        <td>5</td>
                                        <td>$1,111</td>
                                        <td>10</td>
                                        <td>$1,111</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="content-article">
                                <div class="text-1" style="display:inline-block;">歷史重銷累積獎金
                                    <select name="" id="">
                                        <option selected="selected" value="0">週期選擇</option>
                                        <option value="1">20170620-20170720</option>
                                        <option value="2">20170520-20170620</option>
                                    </select>
                                </div>
                                <table width="100%" border="1" style="margin-top:10px;">
                                    <tbody>
                                    <tr class="tb-tittle">
                                        <td>週期</td>
                                        <td>目前責任額</td>
                                        <td>實際消費</td>
                                        <td>達成與否</td>
                                        <td>累積獎金</td>
                                    </tr>
                                    <tr class="td-02">
                                        <td>2017/7/20-2017/8/20</td>
                                        <td>1000PV</td>
                                        <td>1000PV</td>
                                        <td>是</td>
                                        <td>$14,443</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <table width="100%" border="1" style="margin-top:10px;">
                                    <tbody>
                                    <tr class="tb-tittle">
                                        <td>代數</td>
                                        <td>金額</td>
                                        <td>代數</td>
                                        <td>金額</td>
                                        <td>代數</td>
                                        <td>金額</td>
                                    </tr>
                                    <tr class="td-02">
                                        <td>1</td>
                                        <td>$1,111</td>
                                        <td>6</td>
                                        <td>$1,111</td>
                                        <td>11</td>
                                        <td>$1,111</td>
                                    </tr>
                                    <tr class="td-02">
                                        <td>2</td>
                                        <td>$1,111</td>
                                        <td>7</td>
                                        <td>$1,111</td>
                                        <td>12</td>
                                        <td>$1,111</td>
                                    </tr>
                                    <tr class="td-02">
                                        <td>3</td>
                                        <td>$1,111</td>
                                        <td>8</td>
                                        <td>$1,111</td>
                                        <td>13</td>
                                        <td>$1,111</td>
                                    </tr>
                                    <tr class="td-02">
                                        <td>4</td>
                                        <td>$1,111</td>
                                        <td>9</td>
                                        <td>$1,111</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr class="td-02">
                                        <td>5</td>
                                        <td>$1,111</td>
                                        <td>10</td>
                                        <td>$1,111</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="content-article"><a name="rule"></a>
                                <div class="text-1" style="display:inline-block;">重銷規則說明</div>
                                <div class="text-2">重銷規則說明區</div>
                            </div>
                        <?php } ?>
                        <?php
                        //直銷會員獎金iframe顯示
                        if ($_SESSION['user2']["type"] == "2") {
                            $ClienIP = $_SERVER['REMOTE_ADDR'];
                            $MemberNo = $_SESSION['user2']['email'];
                            $MbPassword = $_SESSION['user2']['password2'];
                            $Timestemp = time();
                            $secString1 = 've6t5io371tqda8';
                            $secString2 = '49dqf1gyuk1y2jr';
                            $Token = MD5($ClienIP . $MemberNo . $Timestemp . $MbPassword . $secString1) .
                                substr(MD5($ClienIP . $MemberNo . $Timestemp . $MbPassword . $secString2), 0, 8);

                            $param = array(
                                'MemberNo' => $MemberNo,
                                'Timestemp' => $Timestemp,
                                'Token' => $Token
                            );

                            $Url = 'https://vip.zjt-taiwan.com/Mall/MemberBonus?' . http_build_query($param);
                            ?>
                            <div class="content-article">
                                <iframe src="<?= $Url ?>" width="100%" height="1000" frameborder="0"
                                        scrolling="auto"></iframe>
                            </div>
                        <?php } ?>
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