<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);
?>
<?php
// 產品分類
$sql = "select * from proclass where parent = 0 order by no";
$result = mysqli_query($conn, $sql);
//	if (mysqli_num_rows($result) > 0){
//		while ($row = mysqli_fetch_assoc($result)){
//			$proclass[] = array(
//					'no' => "{$row['no']}",
//					'pcname' => "{$row['pcname']}"
//			);
//		}
//	}else{
//		// 錯誤 查詢結果
//		echo 'E1';
//		return;
//	}
//
//	// 輪播
//	$sql = "select * from banners where status = 1 order by sort";
//	$result = mysqli_query($conn, $sql);
//	if (mysqli_num_rows($result) > 0){
//		while ($row = mysqli_fetch_assoc($result)){
//			$banners[] = array(
//					'pic' => "{$row['pic']}",
//					'url' => "{$row['url']}"
//			);
//		}
//	}else{
//		// 錯誤 查詢結果
//		echo 'E2';
//		return;
//	}
//
//	// 商品資訊
//	$sql = "select * from products,proclass where proclass.no=products.pcno1 and products.status = 3";
//	$result = mysqli_query($conn, $sql);
//	if (mysqli_num_rows($result) > 0){
//	    while ($row = mysqli_fetch_assoc($result)){
//	        $product = array(
//	            'proid' => "{$row['proid']}",
//	            'proname' => "{$row['proname']}",
//	            'pcname' => "{$row['pcname']}",
//	            'pcno1' => "{$row['pcno1']}",
//	            'pcno2' => "{$row['pcno2']}",
//	            'pcno3' => "{$row['pcno3']}",
//	            'price' => "{$row['price']}",
//	            'PV' => "{$row['PV']}",
//	        );
//	        if ($row['pcno3']==1){
//        	        $product1[] = $product;
//	        }else if ($row['pcno3']==2){
//	            $product2[] = $product;
//	        }else if ($row['pcno3']==0){
//	            $product0[] = $product;
//	        }
//	    }
//	}else{
//	    // 錯誤 查詢結果
//	    echo 'E3' . mysqli_error($conn);
//	    return;
//	}

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

        <div class="row content no-margin-rl ">
            <div class="col-xs-2 left-area hidden-xs " style="">
                <div class=" left-move ">


                    <div class="logo ">
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

                <!--  輪播 -->
                <div class="bigbanner" style="">
                    <div class="owl-carousel fadeOut" style="">
                        <?php
                        foreach ($banners as $banner) {
                            echo "<a href={$banner['url']}>";
                            echo "<img src=img/{$banner['pic']} style='' alt='' />";
                            echo "</a>";
                        }
                        ?>
                        <!--
                        <a href=''>
                            <img src='img/br_01.jpg' style="" alt='' />
                        </a>

                        <a href=''>
                            <img src='img/br_01.jpg' style="" alt='' />
                        </a>
                        -->
                    </div>

                </div>


                <!-- 新品上市 -->
                <div class="product-area">
                    <div class="tag hot-pd">
                        <div class="tag-name">新品上市</div>
                        <div class="more"><a href="pd_query.php?pcno3=1">more</a></div>
                    </div>

                    <div id="sildes-portfolio" class="owl-carousel owl-theme " style="padding:0 8px;">
                        <?php
                        foreach ($product1 as $product) {
                            echo '<div class="item ">';
                            echo '<div class="pd-carousel" >';

                            echo "<a href='pd_page.php?proid=" . $product['proid'] . "'>";

                            echo '<div class="pd-pic"><img src="img/pd_01.jpg" alt=""/></div>';
                            echo "<div class='pd-name'>{$product['proname']}</div>";
                            echo "<div class='pd-type'>{$product['pcname']}</div>";
                            echo "<div class='pd-pv'>{$product['PV']}</div>";
                            echo "<div class='pd-price'>價格$" . $product['price'] . "元</div>";
                            echo '<div class="tag-type"><img src="img/tag_new.png" alt=""></div>';
                            echo '</a>';
                            echo '</div>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>

                <div class="product-area ">
                    <div class="tag promo-pd">
                        <div class="tag-name">促銷專區</div>
                        <div class="more"><a href="pd_query.php?pcno3=2">more</a></div>
                    </div>

                    <div id="sildes-promote" class="owl-carousel owl-theme" style="padding:0 8px;">
                        <?php
                        foreach ($product2 as $product) {
                            echo '<div class="item ">';
                            echo '<div class="pd-carousel" >';
                            echo "<a href='pd_page.php?proid=" . $product['proid'] . "'>";
                            echo '<div class="pd-pic"><img src="img/pd_01.jpg" alt=""/></div>';
                            echo "<div class='pd-name'>{$product['proname']}</div>";
                            echo "<div class='pd-type'>{$product['pcname']}</div>";
                            echo "<div class='pd-pv'>{$product['PV']}</div>";
                            echo "<div class='pd-price'>價格$" . $product['price'] . "元</div>";
                            echo '<div class="tag-type"><img src="img/tag_promot.png" alt=""></div>';
                            echo '</a>';
                            echo '</div>';
                            echo '</div>';
                        }
                        ?>

                    </div>
                </div>

                <div class="product-area ">
                    <div class="tag normal-pd">
                        <div class="tag-name">普通商品</div>
                        <div class="more"><a href="pd_query.php?pcno3=0">more</a></div>
                    </div>
                    <div class="product-list  ">

                        <?php

                        foreach ($product0 as $product) {
                            echo '<div class="pd">';
                            echo "<a href='pd_page.php?proid=" . $product['proid'] . "'>";
                            echo '<div class="pd-pic"><img src="img/pd_01.jpg" alt=""/></div>';
                            echo "<div class='pd-name'>{$product['proname']}</div>";
                            echo "<div class='pd-type'>{$product['pcname']}</div>";
                            echo "<div class='pd-pv'>{$product['PV']}</div>";
                            echo "<div class='pd-price'>價格$" . $product['price'] . "元</div>";
                            echo '</a>';
                            echo '</div>';
                        }
                        ?>


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
