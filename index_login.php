<?php
include 'db.php';
session_start();
?>
<?php
// 產品分類
$sql = "select * from proclass where parent = 0 order by no";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $proclass[] = array(
            'no' => "{$row['no']}",
            'pcname' => "{$row['pcname']}"
        );
    }
} else {
    // 錯誤 查詢結果
    echo 'E1';
    return;
}
// TODO: 待補側邊攔，目前是 hard code
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>珍菌王商城</title>

    <link href="css/reset.css" rel="stylesheet" type="text/css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">


    <link href="css/layout.css" rel="stylesheet" type="text/css">


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <!-- owl.carousel -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <script src="scripts/owl.carousel.min.js"></script>

    <style>

        .owl-carousel .owl-dot {
            background-color: #CBCBCB;
            border-radius: 50%;
            display: inline-block;
            height: 15px;
            margin: 0 5px;
            width: 15px;
            opacity: .7;
        }

        .owl-dots > .active {
            background-color: white;
        }

        .owl-carousel .active {
            opacity: 1;
        }

        .owl-carousel {
            position: relative;
        }

        .owl-carousel .owl-dots {
            display: block;
            text-align: center;
            width: 100%;
            position: absolute;
            bottom: 14px;
        }


    </style>

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

                    <li><a href="index.php">
                            <div class="index-icon"></div>
                        </a></li>

                    <li><a href="login.php">
                            <div class="member-icon"></div>
                        </a></li>

                    <li><a href="cart_1.php">
                            <div class="cart-icon"></div>
                        </a></li>

                </ul>

            </div>

        </div>

    </div>

    <div class="topbar">

        <div class="top-content">

            <ul>

                <li><a href="index.php">首頁
                        <div class="index-icon"></div>
                    </a></li>

                <li><a href="login.php">會員登入
                        <div class="member-icon"></div>
                    </a></li>

                <li><a href="cart_1.php">購物車
                        <div class="cart-icon"></div>
                    </a></li>

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

                <div class="bigbanner" style="">

                    <div class="owl-carousel fadeOut" style="">

                        <a href=''>
                            <img src='img/br_01.jpg' style="" alt=''/>
                        </a>

                        <a href=''>
                            <img src='img/br_01.jpg' style="" alt=''/>
                        </a>

                    </div>

                </div>

                <div class="product-area">

                    <div class="tag hot-pd">

                        <div class="tag-name">新品上市</div>

                        <div class="more"><a href="pd_query.php">more</a></div>

                    </div>

                    <div id="sildes-portfolio" class="owl-carousel owl-theme " style="padding:0 8px;">

                        <div class="item ">

                            <div class="pd-carousel ">

                                <a href="pd_page.php">

                                    <div class="pd-pic"><img src="img/pd_01.jpg" alt=""/></div>

                                    <div class="pd-name">養生專利滴粒</div>

                                    <div class="pd-type">滴丸</div>

                                    <div class="pd-pv">PV值</div>

                                    <div class="pd-price">價格$3,999元</div>

                                    <div class="tag-type"><img src="img/tag_new.png" alt=""></div>

                                </a>

                            </div>

                        </div>

                        <div class="item ">

                            <div class="pd-carousel">

                                <a href="pd_page.php">

                                    <div class="pd-pic"><img src="img/pd_02.jpg" alt=""/></div>

                                    <div class="pd-name">專利牛樟芝微脂純液</div>

                                    <div class="pd-type">萃取液</div>

                                    <div class="pd-pv">PV值</div>

                                    <div class="pd-price">價格$3,999元</div>

                                    <div class="tag-type"><img src="img/tag_new.png" alt=""></div>

                                </a>

                            </div>

                        </div>

                        <div class="item ">

                            <div class="pd-carousel">
                                <a href="pd_page.php">
                                    <div class="pd-pic"><img src="img/pd_03.jpg" alt=""/></div>
                                    <div class="pd-name">專利牛樟芝微脂浸膏</div>
                                    <div class="pd-type">萃取液</div>
                                    <div class="pd-pv">PV值</div>
                                    <div class="pd-price">價格$3,999元</div>
                                    <div class="tag-type"><img src="img/tag_new.png" alt=""></div>
                                </a>
                            </div>

                        </div>

                        <div class="item ">

                            <div class="pd-carousel">

                                <a href="pd_page.php">

                                    <div class="pd-pic"><img src="img/pd_04.jpg" alt=""/></div>

                                    <div class="pd-name">牛樟芝耐胃酸膠囊</div>

                                    <div class="pd-type">膠囊</div>

                                    <div class="pd-pv">PV值</div>

                                    <div class="pd-price">價格$3,999元</div>

                                    <div class="tag-type"><img src="img/tag_new.png" alt=""></div>

                                </a>

                            </div>

                        </div>

                    </div>

                    <div class="product-area ">

                        <div class="tag promo-pd">
                            <div class="tag-name">促銷專區</div>
                            <div class="more"><a href="pd_query.php">more</a></div>
                        </div>

                        <div id="sildes-promote" class="owl-carousel owl-theme" style="padding:0 8px;">

                            <div class="item ">

                                <div class="pd-carousel ">
                                    <a href="pd_page.php">
                                        <div class="pd-pic"><img src="img/pd_05.jpg" alt=""/></div>
                                        <div class="pd-name">黃金膠囊</div>
                                        <div class="pd-type">套裝組合</div>
                                        <div class="pd-pv">PV值</div>
                                        <div class="pd-price">促銷價$3,999元</div>
                                        <div class="tag-type"><img src="img/tag_promot.png" alt=""></div>
                                    </a>
                                </div>
                            </div>

                            <div class="item ">
                                <div class="pd-carousel ">
                                    <a href="pd_page.php">
                                        <div class="pd-pic"><img src="img/pd_06.jpg" alt=""/></div>
                                        <div class="pd-name">黃金滴粒</div>
                                        <div class="pd-type">套裝組合</div>
                                        <div class="pd-pv">PV值</div>
                                        <div class="pd-price">促銷價$3,999元</div>
                                        <div class="tag-type"><img src="img/tag_promot.png" alt=""></div>
                                    </a>
                                </div>
                            </div>

                            <div class="item ">
                                <div class="pd-carousel ">
                                    <a href="pd_page.php">
                                        <div class="pd-pic"><img src="img/pd_07.jpg" alt=""/></div>
                                        <div class="pd-name">固態膠囊</div>
                                        <div class="pd-type">套裝組合</div>
                                        <div class="pd-pv">PV值</div>
                                        <div class="pd-price">促銷價$3,999元</div>
                                        <div class="tag-type"><img src="img/tag_promot.png" alt=""></div>
                                    </a>
                                </div>
                            </div>

                            <div class="item ">
                                <div class="pd-carousel ">
                                    <a href="pd_page.php">
                                        <div class="pd-pic"><img src="img/pd_08.jpg" alt=""/></div>
                                        <div class="pd-name">牛樟之萃取液</div>
                                        <div class="pd-type">套裝組合</div>
                                        <div class="pd-pv">PV值</div>
                                        <div class="pd-price">促銷價$3,999元</div>
                                        <div class="tag-type"><img src="img/tag_promot.png" alt=""></div>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="product-area ">

                        <div class="tag normal-pd">

                            <div class="tag-name">普通商品</div>

                            <div class="more"><a href="pd_query.php">more</a></div>

                        </div>

                        <div class="product-list ">

                            <div class="pd">
                                <a href="pd_page.php">
                                    <div class="pd-pic"><img src="img/pd_09.jpg" alt=""/></div>
                                    <div class="pd-name">A組靶向養生</div>
                                    <div class="pd-type">滴丸</div>
                                    <div class="pd-pv">PV值</div>
                                    <div class="pd-price">價格$3,999元</div>
                                </a>
                            </div>

                            <div class="pd">
                                <a href="pd_page.php">
                                    <div class="pd-pic"><img src="img/pd_10.jpg" alt=""/></div>
                                    <div class="pd-name">B組精準輔療</div>
                                    <div class="pd-type">套裝組合</div>
                                    <div class="pd-pv">PV值</div>
                                    <div class="pd-price">價格$3,999元</div>
                                </a>
                            </div>
                            <div class="pd">
                                <a href="pd_page.php">
                                    <div class="pd-pic"><img src="img/pd_11.jpg" alt=""/></div>
                                    <div class="pd-name">A組靶向養生</div>
                                    <div class="pd-type">套裝組合</div>
                                    <div class="pd-pv">PV值</div>
                                    <div class="pd-price">價格$3,999元</div>
                                </a>
                            </div>
                            <div class="pd">
                                <a href="pd_page.php">
                                    <div class="pd-pic"><img src="img/pd_12.jpg" alt=""/></div>
                                    <div class="pd-name">B組精準輔療列</div>
                                    <div class="pd-type">套裝組合</div>
                                    <div class="pd-pv">PV值</div>
                                    <div class="pd-price">價格$3,999元</div>
                                </a>
                            </div>
                            <div class="pd">
                                <a href="pd_page.php">
                                    <div class="pd-pic"><img src="img/pd_13.jpg" alt=""/></div>
                                    <div class="pd-name">C組黃金系列</div>
                                    <div class="pd-type">套裝組合</div>
                                    <div class="pd-pv">PV值</div>
                                    <div class="pd-price">價格$3,999元</div>
                                </a>
                            </div>
                            <div class="pd">
                                <a href="pd_page.php">
                                    <div class="pd-pic"><img src="img/pd_14.jpg" alt=""/></div>
                                    <div class="pd-name">D組黃金系列</div>
                                    <div class="pd-type">套裝組合</div>
                                    <div class="pd-pv">PV值</div>
                                    <div class="pd-price">價格$3,999元</div>
                                </a>
                            </div>
                            <div class="pd">
                                <a href="pd_page.php">
                                    <div class="pd-pic"><img src="img/pd_14.jpg" alt=""/></div>
                                    <div class="pd-name">D組黃金系列</div>
                                    <div class="pd-type">套裝組合</div>
                                    <div class="pd-pv">PV值</div>
                                    <div class="pd-price">價格$3,999元</div>
                                </a>
                            </div>
                            <div class="pd">
                                <a href="pd_page.php">
                                    <div class="pd-pic"><img src="img/pd_14.jpg" alt=""/></div>
                                    <div class="pd-name">商品名稱</div>
                                    <div class="pd-type">套裝組合</div>
                                    <div class="pd-pv">PV值</div>
                                    <div class="pd-price">價格$3,999元</div>
                                </a>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <footer>

            <div class="foot-area">

                <div class="foot-menu">

                    <div class="ft-logo"><a href="index.php"><br><br><br><img src="img/logo_foot.png" alt=""></a></div>

                    <div class="ft-menu-list">

                        <ul>

                            <li><a href="ftmenu_about.php">關於我們</a></li>

                            <li>│</li>

                            <li><a href="ftmenu_privacy.php">隱私權條款</a></li>

                            <li>│</li>

                            <li><a href="ftmenu_policy.php">服務政策</a></li>

                            <li>│</li>

                            <li><a href="ftmenu_refund.php">退貨需知</a></li>

                            <li>│</li>

                            <li><a href="ftmenu_goods.php">商品寄送</a></li>

                            <li>│</li>

                            <li><a href="ftmenu_supplier.php">供應商資訊</a></li>

                            <li>│</li>

                            <li><a href="ftmenu_process.php">購物流程說明</a></li>

                            <li>│</li>

                            <li><a href="ftmenu_warranty.php">鑑賞期說明</a></li>

                            <li>│</li>

                            <li><a href="ftmenu_service.php">客服中心</a></li>

                        </ul>

                    </div>

                </div>

            </div>

            <div class="copyright"><br><br>客服時間：AM 10:00 - PM 18:00(網路部門星期六、日公休)
                快速客服專線：02-22XX-XXXX轉XX<br><br><br><br><br><br></div>

        </footer>

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
