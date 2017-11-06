<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);
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

    <?php include 'top_bar.php'; ?>

    <div class="container main">

        <div class="row content no-margin-rl">

            <div class="col-sm-2 left-area hidden-xs " style="">

                <?php include 'side_bar.php'; ?>

            </div>

            <div class="col-sm-10">

                <div class="bigbanner" style="">
                    
                    <div class="owl-carousel fadeOut" style="">

                        <a href=''>
                            <img src='img/br_01.jpg' style="" alt='' />
                        </a>

                        <a href=''>
                            <img src='img/br_01.jpg' style="" alt='' />
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

                            <div class="pd-carousel " >
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

                                <div class="pd-carousel " >
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
                                <div class="pd-carousel " >
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
                                <div class="pd-carousel " >
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
                                <div class="pd-carousel " >
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
                        
                        <div class="product-list  ">

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
