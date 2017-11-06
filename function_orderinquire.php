<?php
include 'db.php';
session_start();
?>
<?php
// 產品分類
$sql = "select * from proclass where parent = 0 order by no";
$result = mysqli_query($conn, $sql);
//if (mysqli_num_rows($result) > 0) {
//    while ($row = mysqli_fetch_assoc($result)) {
//        $proclass[] = array(
//            'no' => "{$row['no']}",
//            'pcname' => "{$row['pcname']}"
//        );
//    }
//} else {
//    // 錯誤 查詢結果
//    echo 'E1';
//    return;
//}
// TODO: 待補側邊攔，目前是 hard code
?>
<!doctype html>
<html>

<head>

    <?php include 'http_head.php'; ?>

</head>

<body>

<div class="wrap">

    <!-- 新增側邊欄 -->
    <div class="sidebar visible-sm visible-xs ">
        <ul class="fullheight" style="overflow:auto;">
            <?php
            // 左側分類
            foreach ($proclass as $class) {
                echo '<li>';
                echo '<a class="sidebar-menu">';

                echo $class['pcname'];
                echo '<i class="fa fa-angle-right angle-right" aria-hidden="true"></i>';

                echo '</a>';
                echo '<li>';
            }
            ?>

        </ul>
    </div>
    <!-- 新增側邊欄 -->

    <div class="topbar-mobile">

        <div class="mobile-content">

            <input type="image" src="img/open_btn.png" name="lo" class="left-open">

            <div class="icon-area">

                <ul>

                    <li><a href="index.php"><div class="index-icon"></div></a></li>

                    <li><a href="login.php"><div class="member-icon"></div></a></li>

                    <li><a href="cart_1.php"><div class="cart-icon"></div></a></li>

                </ul>

            </div>

        </div>

    </div>

    <div class="topbar">

        <div class="top-content">

            <ul>

                <li><a href="index.php">首頁<div class="index-icon"></div></a></li>

                <li><a href="login.php">會員登入<div class="member-icon"></div></a></li>

                <li><a href="cart_1.php">購物車<div class="cart-icon"></div></a></li>

            </ul>

            <div class="search">

                <div class="search-input">

                    <input type="text" name="input-1" id="input-1" class="input-1" placeholder="搜尋商品">

                </div>

                <div class="search-btn"></div>

            </div>

        </div>

    </div>

    <div class="ft-search">

        <div class="search">

            <div class="search-input">

                <input type="text" name="" id="" class="input-1" placeholder="搜尋商品"></div>

            <div class="search-btn"></div>

        </div>

    </div>

    <div class="container main">

        <div class="row content no-margin-rl">

            <div class="col-sm-2 left-area hidden-xs ">

                <div class="left-move ">

                    <div class="logo">

                        <a href="index.php">

                            <img src="img/logo.jpg" style="" alt="">

                        </a>

                    </div>

                    <div class="menu-area">

                        <ul class="fullheight" style="overflow:auto;">

                            <li>
                                <a class="sidebar-menu">
                                    套裝組合
                                    <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>
                                </a>
                                <ul class="sidebar-sub">
                                    <li>
                                        <a class="sidebar-level2" href="#">
                                            次類別一
                                            <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>
                                        </a>
                                        <ul class="sidebar-sub3 ">
                                            <li>
                                                <a href="#">
                                                    第三層類別一
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    第三層類別二
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li>
                                        <a class="sidebar-level2" href="#">
                                            次類別二
                                            <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>
                                        </a>
                                        <ul class="sidebar-sub3 ">
                                            <li>
                                                <a href="#">
                                                    第三層類別一
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    第三層類別二
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a class="sidebar-menu">
                                    膠囊類
                                    <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>
                                </a>
                                <ul class="sidebar-sub">
                                    <li>
                                        <a class="sidebar-level2" href="#">
                                            次類別一
                                            <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>
                                        </a>
                                        <ul class="sidebar-sub3 ">
                                            <li>
                                                <a href="#">
                                                    第三層類別一
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    第三層類別二
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                </ul>
                            </li>

                            <li>
                                <a class="sidebar-menu">
                                    萃取液
                                    <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>
                                </a>
                                <ul class="sidebar-sub">
                                    <li>
                                        <a class="sidebar-level2" href="#">
                                            次類別一
                                            <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>
                                        </a>
                                        <ul class="sidebar-sub3 ">
                                            <li>
                                                <a href="#">
                                                    第三層類別一
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    第三層類別二
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                </ul>
                            </li>

                            <li>
                                <a class="sidebar-menu">
                                    健康器材
                                    <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>
                                </a>
                                <ul class="sidebar-sub">
                                    <li>
                                        <a class="sidebar-level2" href="#">
                                            次類別一
                                            <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>
                                        </a>
                                        <ul class="sidebar-sub3 ">
                                            <li>
                                                <a href="#">
                                                    第三層類別一
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    第三層類別二
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                </ul>
                            </li>

                            <li>
                                <a class="sidebar-menu">
                                    養身食品
                                    <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>
                                </a>
                                <ul class="sidebar-sub">
                                    <li>
                                        <a class="sidebar-level2" href="#">
                                            次類別一
                                            <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>
                                        </a>
                                        <ul class="sidebar-sub3 ">
                                            <li>
                                                <a href="#">
                                                    第三層類別一
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    第三層類別二
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                </ul>
                            </li>

                            <li>
                                <a class="sidebar-menu">
                                    滴丸
                                    <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>
                                </a>
                                <ul class="sidebar-sub">
                                    <li>
                                        <a class="sidebar-level2" href="#">
                                            次類別一
                                            <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>
                                        </a>
                                        <ul class="sidebar-sub3 ">
                                            <li>
                                                <a href="#">
                                                    第三層類別一
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    第三層類別二
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                </ul>
                            </li>

                        </ul>

                    </div>

                </div>

            </div>

            <div class="col-sm-10">

                <div class="beard">
                    <ul>
                        <li><a href="index.php">首頁</a></li>
                        <li><img src="img/process_icon.png" alt=""></li>
                        <li><a href="function_member.php">會員專區</a></li>
                    </ul>
                </div>
                
                <div class="content-area">
                    <div class="function-area">
                        <ul>
                            <li><a href="function_member.php"><input type="button" id="" name="" class="" value="個人資料"></a></li>
                            <li><a href="function_orderquery.php"><input type="button" id="" name="" class="tag-value-select" value="訂單查詢"></a></li>
                            <li><a href="function_bonusquery.php"><input type="button" id="" name="" class="" value="重銷獎金查詢/規則"></a></li>
                        </ul>
                    </div>
                    <div class="content-article">
                        <table width="100%" border="1">
                            <tbody>
                            <tr class="tb-tittle">
                                <td>訂單編號</td>
                            </tr>
                            <tr class="td-02">
                                <td>xxxxxxxxxxxxx</td>
                            </tr>
                            <tr class="tb-tittle">
                                <td>訂單日期</td>
                            </tr>
                            <tr class="td-02">
                                <td>xxxxxxxxxxxxx</td>
                            </tr>
                            </tbody>
                        </table>
                        <table width="100%" border="1">
                            <tbody>
                            <tr class="tb-tittle">
                                <td>編號</td>
                                <td>商品名稱</td>
                                <td>訂單狀態</td>
                                <td>數量</td>
                                <td>PV</td>
                                <td>價格</td>
                                <td>其他</td>
                            </tr>
                            <tr class="td-02">
                                <td>1</td>
                                <td>xxxxxxxxxxx<br><span style="color:#B80609">(產品編號)</span></td>
                                <td>訂單成立</td>
                                <td>1</td>
                                <td>20</td>
                                <td>$100</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr class="td-02">
                                <td>2</td>
                                <td>xxxxxxxxxxx<br><span style="color:#B80609">(產品編號)</span></td>
                                <td>訂單成立</td>
                                <td>1</td>
                                <td>60</td>
                                <td>$300</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr class="td-02">
                                <td colspan="3">&nbsp;</td>
                                <td style="background-color:black;color:#fff;text-align:right;">運費</td>
                                <td></td>
                                <td>$80</td>
                            </tr>
                            <tr class="td-02">
                                <td colspan="3">&nbsp;</td>
                                <td style="background-color:#B80609;color:#fff;text-align:right;">訂單總額</td>
                                <td>80</td>
                                <td>$480</td>
                            </tr>
                            <tr class="td-02">
                                <td colspan="3">&nbsp;</td>
                                <td style="background-color:#E3770C;color:#fff;text-align:right;">折抵</td>
                                <td>紅利/電子錢包</td>
                                <td>$x,xxx</td>
                            </tr>
                            <tr class="td-02">
                                <td colspan="3">&nbsp;</td>
                                <td  style="background-color:#B80609;color:#fff;text-align:right;">應付金額</td>
                                <td></td>
                                <td>$x,xxx</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="btn-area">
                        <a href="function_orderquery.php"><input type="submit" value="返回" ></a>
                    </div>
                </div>

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
