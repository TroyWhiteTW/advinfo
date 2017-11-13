<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);
?>
<?php
$isSearch = !empty($_GET['search']);
if ($isSearch) {
    $search = trim($_GET['search']);

    $sql = 'SELECT * FROM products,protags WHERE protags.no=products.pcno AND products.status=3';
    $sql .= ' AND proname LIKE ' . '\'%' . $search . '%\'';

//var_dump($sql);return;
    $products = array();
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }

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

                <?php if ($isSearch): ?>

                    <div class="beard">
                        <ul>
                            <li><a href="index.php">首頁</a></li>
                            <li><img src="img/process_icon.png" alt=""></li>
                            <li><h3>商品查詢</h3></li>
                        </ul>
                    </div>

                    <?php

                    foreach ($products as $product) {

                        echo '<div class="pd">';
                        echo "<a href='pd_page.php?proid=" . $product['proid'] . "'>";
                        echo '<div class="pd-pic"><img src="img/pd_01.jpg" alt=""/></div>';
                        echo "<div class='pd-name'>{$product['proname']}</div>";
                        echo "<div class='pd-type'>{$product['name']}</div>";
                        if ($isLogin) {
                            echo "<div class='pd-pv'>PV/紅利：{$product['PV']}</div>";
                        }

                        // 促銷商品
                        if ($product['protags'] == 2) {
                            echo "<div class='pd-price'>促銷價$ {$product['price']}元</div>";
                        } else {
                            echo "<div class='pd-price'>價格$ {$product['promo_price']}元</div>";
                        }

                        // 左上方的圖標
                        if ($product['protags'] == 1) {
                            // 新品上市
                            echo '<div class="tag-type"><img src="img/tag_new.png" alt=""></div>';
                        } else if ($product['protags'] == 2) {
                            // 促銷商品
                            echo '<div class="tag-type"><img src="img/tag_promot.png" alt=""></div>';
                        }

                        echo '</a>';
                        echo '</div>';
                    }

                    ?>

                <?php else: ?>

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
