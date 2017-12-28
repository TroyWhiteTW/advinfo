<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);

// 輪播資料
$sql = "select * from banners where status=1 order by sort";
$banners = array();
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $banners[] = array(
            'pic' => "{$row['pic']}",
            'url' => "{$row['url']}"
        );
    }
} else {
    // 錯誤 查詢結果
    echo 'E1';
    return;
}

// 商品標籤資料 -> 商品資料
$sql = "select * from protags order by sort";
$protags = array();
$products = array(); // $products[tag][product]
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $protags[] = array(
            'no' => "{$row['no']}",
            'name' => "{$row['name']}",
            'pic' => "{$row['pic']}",
            'color' => "{$row['color']}"
        );
        // 以下針對該標籤的商品取出
        $tagno = $row['no'];
        $products[$tagno] = array();
        $sql2 = "select * from products where protags = $tagno and status = 3";
        $result2 = mysqli_query($conn, $sql2);
        if (mysqli_num_rows($result2) > 0) {
            while ($row2 = mysqli_fetch_assoc($result2)) {
                $products[$tagno][] = array(
                    'proid' => "{$row2['proid']}",
                    'proname' => "{$row2['proname']}",
                    'prointro' => "{$row2['prointro']}",
                    'pcno' => "{$row2['pcno']}",
                    'price' => "{$row2['price']}",
                    'pv' => "{$row2['PV']}",
                    'bonuce' => "{$row2['bonuce']}",
                    'stock' => "{$row2['stock']}",
                    'prodetail' => "{$row2['prodetail']}",
                    'weight' => "{$row2['weight']}",
                    'size' => "{$row2['size']}",
                    'promo_price' => "{$row2['promo_price']}",
                    'promo_pv' => "{$row2['promo_PV']}",
                    'promo_bonuce' => "{$row2['promo_bonuce']}"
                );
            }
        }

    }
} else {
    // 錯誤 查詢結果
    echo 'E2';
    return;
}

// proclass
$proclass = [];
$proclassSql = 'SELECT no, pcname FROM proclass';
$proclassRes = mysqli_query($conn, $proclassSql);
while ($proclassRow = mysqli_fetch_assoc($proclassRes)) {
    $proclass[] = $proclassRow;
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

        <div class="row content no-margin-rl ">

            <div class="col-sm-2 left-area hidden-xs " style="">

                <?php include 'side_bar.php'; ?>

            </div>

            <div class="col-sm-10">

                <div class="bigbanner" style="">
                    <div class="owl-carousel fadeOut" style="">
                        <?php
                        foreach ($banners as $banner) {
                            echo "<a href='" . $banner['url'] . "'>";
                            echo "<img src='" . "upload/banners/{$banner['pic']}" . "' style='' alt='' />";
                            echo "</a>";
                        }

                        ?>
                    </div>

                </div>

                <?php
                // 開始該標籤的商品
                foreach ($protags as $protag) {
                    echo '<div class="product-area">';
                    echo '<div class="tag" style="background:' . $protag['color'] . '">';
                    echo '<div class="tag-name">' . $protag['name'] . '</div>';
                    echo '<div class="more"><a href="pd_query.php?protags=' . $protag['no'] . '">more</a></div>';
                    echo '</div>';

                    echo '<div id="sildes-portfolio" class="owl-carousel owl-theme " style="padding:0 8px;">';
                    $tagno = $protag['no'];
                    foreach ($products[$tagno] as $product) {
                        echo '<div class="item">';
                        echo '<div class="pd-carousel" >';
                        echo '<a href="pd_page.php?proid=' . $product['proid'] . '">';
                        // 搜尋該商品的主圖
                        $sql = "select * from productpics where proid='" . $product['proid'] . "' and sort=1";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            // 撈出主圖
                            $row = mysqli_fetch_assoc($result);
                            echo '<div class="pd-pic"><img src="upload/product/' . $row['picfile'] . '" alt=""/></div>';
                        } else {
                            echo '<div class="pd-pic"></div>';
                        }
                        echo '<div class="pd-name">' . $product['proname'] . '</div>';

                        foreach ($proclass as $item) {
                            if ($item['no'] == $product['pcno']) {
                                echo '<div class="pd-type">' . $item['pcname'] . '</div>';
                            }
                        }

                        echo '</a>';

                        if ($isLogin) {
                            switch ($_SESSION['user2']['type']) {
                                case 1:
                                    echo '<div class="pd-pv">紅利：' . $product['bonuce'] . '</div>';
                                    break;
                                case 2:
                                    echo '<div class="pd-pv">PV：' . $product['pv'] . '</div>';
                                    break;
                            }
                        } else {
                            echo '<div class="pd-pv">請登入後查看</div>';
                        }

                        echo '<div class="pd-price">價格$' . $product['price'] . '元</div>';

                        if ($protag['pic'] != '0') {
                            echo '<div class="tag-type"><img src="upload/product/' . $protag['pic'] . '" alt=""></div>';
                        }

                        echo '</div></div>';
                    }
                    echo '</div>';
                    echo '</div>';
                }
                ?>

                <div class="product-area">
                    <div class="tag normal-pd">
                        <div class="tag-name">普通商品</div>
                        <div class="more"><a href="pd_query.php?protags=0">more</a></div>
                    </div>
                    <div class="product-list">
                        <?php
                        $products = [];
                        $productsSql = 'SELECT * FROM products WHERE protags=0 AND status=3 OR status=8 ORDER BY uptime DESC LIMIT 8';
                        $productsRes = mysqli_query($conn, $productsSql);
                        while ($productsRow = mysqli_fetch_assoc($productsRes)) {
                            $products[] = $productsRow;
                        }
                        foreach ($products as $product) {
                            echo '<div class="pd">';
                            echo '<a href="pd_page.php?proid=' . $product['proid'] . '">';
                            // 搜尋該商品的主圖
                            $sql = "select * from productpics where proid='" . $product['proid'] . "' and sort=1";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                // 撈出主圖
                                $row = mysqli_fetch_assoc($result);
                                echo '<div class="pd-pic"><img src="upload/product/' . $row['picfile'] . '" alt=""/></div>';
                            } else {
                                echo '<div class="pd-pic"></div>';
                            }
                            echo '<div class="pd-name">' . $product['proname'] . '</div>';
                            foreach ($proclass as $item) {
                                if ($item['no'] == $product['pcno']) {
                                    echo '<div class="pd-type">' . $item['pcname'] . '</div>';
                                }
                            }
                            echo '</a>';
                            if ($isLogin) {
                                switch ($_SESSION['user2']['type']) {
                                    case 1:
                                        echo '<div class="pd-pv">紅利：' . $product['bonuce'] . '</div>';
                                        break;
                                    case 2:
                                        echo '<div class="pd-pv">PV：' . $product['pv'] . '</div>';
                                        break;
                                }
                            } else {
                                echo '<div class="pd-pv">請登入後查看</div>';
                            }
                            echo '<div class="pd-price">價格$' . $product['price'] . '元</div>';
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

    //新增側邊欄

    var w = ($(".pd-pic").width() * 6) / 5;
    $(".pd-pic").height(w);
</script>

</body>

</html>
