<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);
?>
<?php
$isSearch = !empty($_GET['search']);
if ($isSearch) {
    $search = trim($_GET['search']);

// all products
    $products = [];
    $productsSql = 'SELECT products.proid, products.proname, products.price, products.PV, products.bonuce, products.protags, products.promo_price, products.promo_PV, products.promo_bonuce, protags.name, protags.pic, protags.color, productclass.pcno1, productclass.pcno2, productclass.pcno3 FROM (SELECT * FROM products WHERE status=3';
    $productsSql .= ' AND proname LIKE \'%' . $search . '%\'';
    $productsSql .= ') products LEFT JOIN protags ON products.protags=protags.no LEFT JOIN productclass ON products.proid=productclass.proid';

    if (!isset($_GET['order'])) {
        $productsSql .= ' ORDER BY products.price ASC';
    } else {
        switch ($_GET['order']) {
            case 1:
                $productsSql .= ' ORDER BY products.price ASC';
                break;
            case 2:
                $productsSql .= ' ORDER BY products.price DESC';
                break;
            default:
                $productsSql .= ' ORDER BY products.price ASC';
                break;
        }
    }

    $productsRes = mysqli_query($conn, $productsSql);
    while ($productsRow = mysqli_fetch_assoc($productsRes)) {
        $products[] = $productsRow;
    }

    if (isset($_GET['protags'])) {
        $tmpProducts = [];
        foreach ($products as $product) {
            if ($_GET['protags'] == $product['protags']) {
                $tmpProducts[] = $product;
            }
        }
        $products = $tmpProducts;
    }

    if (isset($_GET['first']) && isset($_GET['second']) && isset($_GET['third'])) {
        $tmpProducts = [];

        if ($_GET['second'] == 0 && $_GET['third'] == 0) {
            foreach ($products as $product) {
                if ($_GET['first'] == $product['pcno1']) {
                    $tmpProducts[] = $product;
                }
            }
        } elseif ($_GET['third'] == 0) {
            foreach ($products as $product) {
                if ($_GET['second'] == $product['pcno2']) {
                    $tmpProducts[] = $product;
                }
            }
        } else {
            foreach ($products as $product) {
                if ($_GET['third'] == $product['pcno3']) {
                    $tmpProducts[] = $product;
                }
            }
        }

        $products = $tmpProducts;
    }

// protags
    $protags = [];
    $protagsSql = 'SELECT no, name, pic, color FROM protags';
    $protagsRes = mysqli_query($conn, $protagsSql);
    while ($protagsRow = mysqli_fetch_assoc($protagsRes)) {
        $protags[] = $protagsRow;
    }

// proclass
    $proclass = [];
    $proclassSql = 'SELECT no, parent, pcname FROM proclass WHERE status=1 ORDER BY sort ASC';
    $proclassRes = mysqli_query($conn, $proclassSql);
    while ($proclassRow = mysqli_fetch_assoc($proclassRes)) {
        $proclass[] = $proclassRow;
    }

// main pic
    $pics = [];
    $picSql = 'SELECT proid, picname, picfile FROM productpics WHERE sort=1';
    $picRes = mysqli_query($conn, $picSql);
    while ($picsRow = mysqli_fetch_assoc($picRes)) {
        $pics[] = $picsRow;
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

                <div class="beard">

                    <ol class="breadcrumb">

                        <li><a href="index.php">首頁</a></li>
                        <!-- <li><a href="#">Library</a></li>-->
                        <!-- <li class="active">Data</li>-->

                        <?php if ($isSearch): ?>
                            <?php
                            if ($products == null) {
                                echo '<li class="active">查詢不到商品</li>';
                            } else {
                                echo '<li class="active">商品查詢結果</li>';
                            }
                            ?>
                        <?php else: ?>
                            <li class="active">查詢不到商品</li>
                        <?php endif; ?>

                    </ol>

                </div>

                <?php if ($isSearch): ?>

                    <?php

                    foreach ($proclass as $item) {
                        if ($item['parent'] == 0) {

                            foreach ($products as $product) {
                                if ($product['pcno1'] == $item['no']) {
                                    echo '<div class="panel panel-default">';
                                    echo '<div class="panel-heading">' . $item['pcname'] . '</div>';
                                    echo '<div class="panel-body">';
                                    break;
                                }
                            }

                            foreach ($products as $product) {
                                if ($product['pcno1'] == $item['no']) {

                                    echo '<div class="pd">';
                                    echo "<a href='pd_page.php?proid=" . $product['proid'] . "'>";

                                    // 搜尋該商品的主圖
                                    foreach ($pics as $pic) {
                                        if ($product['proid'] == $pic['proid']) {
                                            echo '<div class="pd-pic"><img src="upload/product/' . $pic['picfile'] . '" alt=""/></div>';
                                        }
                                    }

                                    echo '<div class="pd-name">' . $product['proname'] . '</div>';
                                    echo '<div class="pd-type">' . $product['name'] . '</div>';

                                    if ($isLogin) {
                                        switch ($_SESSION['user'][20]) {
                                            case 1:
                                                echo '<div class="pd-pv">紅利：' . $product['bonuce'] . '</div>';
                                                break;
                                            case 2:
                                                echo '<div class="pd-pv">PV：' . $product['PV'] . '</div>';
                                                break;
                                        }
                                    } else {
                                        echo '<div class="pd-pv">請登入後查看</div>';
                                    }

                                    // 促銷商品
                                    if ($product['protags'] == 2) {
                                        echo '<div class="d-price">促銷價$ ' . $product['promo_price'] . ' 元</div>';
                                    } else {
                                        echo '<div class="pd-price">價格$ ' . $product['price'] . ' 元</div>';
                                    }

                                    // 商品標籤
                                    if ($product['protags'] != '0') {
                                        echo '<div class="tag-type"><img src="upload/product/' . $product['pic'] . '" alt=""></div>';
                                    }

                                    echo '</a>';
                                    echo '</div>';

                                }
                            }

                            foreach ($products as $product) {
                                if ($product['pcno1'] == $item['no']) {
                                    echo '</div>';
                                    echo '</div>';
                                    break;
                                }
                            }
                        }
                    }


                    if ($products == null) {
                        echo '<h3>查詢不到商品</h3>';
                    }

                    ?>

                <?php else: ?>

                    <h3>查詢不到商品</h3>

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
