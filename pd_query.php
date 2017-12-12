<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);

// GET protags = null => 全部種類
// GET protags = 1 => 新品
// GET protags = 2 => 促銷
// GET order = 1 => 低到高排序
// GET order = 2 => 高到低排序
// all products
$products = [];
$productsSql = 'SELECT products.proid, products.proname, products.price, products.PV, products.bonuce, products.uptime, products.downtime, products.status, products.protags, products.promo_price, products.promo_PV, products.promo_bonuce, protags.name, protags.pic, protags.color, productclass.pcno1, productclass.pcno2, productclass.pcno3 FROM (SELECT * FROM products WHERE status=3 OR status=8) products LEFT JOIN protags ON products.protags=protags.no LEFT JOIN productclass ON products.proid=productclass.proid';

$productsRes = mysqli_query($conn, $productsSql);
while ($productsRow = mysqli_fetch_assoc($productsRes)) {
    $products[] = $productsRow;
}

// status=8 依時間上架過濾
$tmpArray = [];
foreach ($products as $product) {
    if ($product['status'] == 8) {
        if (!(time() > strtotime($product['uptime']) && time() < strtotime($product['downtime']))) {

        } else {
            $tmpArray[] = $product;
        }
    } else {
        $tmpArray[] = $product;
    }
}
$products = $tmpArray;

// sort
$tmpArray = [];
foreach ($products as $k => $v) {
    if ($v['protags'] == 2) {
        $tmpArray[$k] = $v['promo_price'];
    } else {
        $tmpArray[$k] = $v['price'];
    }
}

if (!isset($_GET['order'])) {
    asort($tmpArray);
} else {
    $_GET['order'] = (int)trim($_GET['order']);
    switch ($_GET['order']) {
        case 1:
            asort($tmpArray);
            break;
        case 2:
            arsort($tmpArray);
            break;
        default:
            asort($tmpArray);
            break;
    }
}

$sortArray = [];
foreach ($tmpArray as $k => $v) {
    $sortArray[] = $products[$k];
}
$products = $sortArray;

if (isset($_GET['protags'])) {
    $_GET['protags'] = (int)trim($_GET['protags']);
    $tmpProducts = [];
    foreach ($products as $product) {
        if ($_GET['protags'] == $product['protags']) {
            $tmpProducts[] = $product;
        }
    }
    $products = $tmpProducts;
}

if (isset($_GET['first']) && isset($_GET['second']) && isset($_GET['third'])) {
    $_GET['first'] = (int)trim($_GET['first']);
    $_GET['second'] = (int)trim($_GET['second']);
    $_GET['third'] = (int)trim($_GET['third']);

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

                        <?php
                        if (!isset($_GET['protags'])) {
                            if (isset($_GET['first']) && isset($_GET['second']) && isset($_GET['third'])) {
                                if ($_GET['second'] == 0 && $_GET['third'] == 0) {
                                    foreach ($proclass as $item) {
                                        if ($_GET['first'] == $item['no']) {
                                            echo '<li><a href="pd_query.php?first=' . $_GET['first'] . '&second=' . $_GET['second'] . '&third=' . $_GET['third'] . '">' . $item['pcname'] . '</a></li>';
                                            break;
                                        }
                                    }
                                } elseif ($_GET['third'] == 0) {
                                    foreach ($proclass as $item) {
                                        if ($_GET['first'] == $item['no']) {
                                            echo '<li><a href="pd_query.php?first=' . $_GET['first'] . '&second=' . 0 . '&third=' . $_GET['third'] . '">' . $item['pcname'] . '</a></li>';
                                            break;
                                        }
                                    }
                                    echo '<li><img src="img/process_icon.png" alt=""></li>';
                                    foreach ($proclass as $item) {
                                        if ($_GET['second'] == $item['no']) {
                                            echo '<li><a href="pd_query.php?first=' . $_GET['first'] . '&second=' . $_GET['second'] . '&third=' . $_GET['third'] . '">' . $item['pcname'] . '</a></li>';
                                            break;
                                        }
                                    }
                                } else {
                                    foreach ($proclass as $item) {
                                        if ($_GET['first'] == $item['no']) {
                                            echo '<li><a href="pd_query.php?first=' . $_GET['first'] . '&second=' . 0 . '&third=' . 0 . '">' . $item['pcname'] . '</a></li>';
                                            break;
                                        }
                                    }
                                    echo '<li><img src="img/process_icon.png" alt=""></li>';
                                    foreach ($proclass as $item) {
                                        if ($_GET['second'] == $item['no']) {
                                            echo '<li><a href="pd_query.php?first=' . $_GET['first'] . '&second=' . $_GET['second'] . '&third=' . 0 . '">' . $item['pcname'] . '</a></li>';
                                            break;
                                        }
                                    }
                                    echo '<li><img src="img/process_icon.png" alt=""></li>';
                                    foreach ($proclass as $item) {
                                        if ($_GET['third'] == $item['no']) {
                                            echo '<li><a href="pd_query.php?first=' . $_GET['first'] . '&second=' . $_GET['second'] . '&third=' . $_GET['third'] . '">' . $item['pcname'] . '</a></li>';
                                            break;
                                        }
                                    }
                                }
                            } else {
                                echo '<li><a>全部商品</a></li>';
                            }
                        } else {
                            switch ($_GET['protags']) {
                                case 0:
                                    echo '<li><a>普通商品</a></li>';
                                    break;
                                case 1:
                                    echo '<li><a>新品上架</a></li>';
                                    break;
                                case 2:
                                    echo '<li><a>促銷商品</a></li>';
                                    break;
                                default:
                                    echo '<li><a>全部商品</a></li>';
                                    break;
                            }
                        }
                        ?>

                    </ul>

                </div>

                <!-- btn -->
                <div class="content-area">
                    <div class="row">
                        <div class="col-sm-12">
                            <a href="pd_query.php" class="btn btn-primary" role="button">全部商品</a>
                            <a href="pd_query.php?protags=0" class="btn btn-warning" role="button">普通商品</a>
                            <?php
                            foreach ($protags as $protag) {
                                echo '<a href="pd_query.php?protags=' .
                                    $protag['no'] .
                                    '" class="btn" role="button" style="color: white;background-color: ' .
                                    $protag['color'] .
                                    ';">' .
                                    $protag['name'] .
                                    '</a>' .
                                    "\n";
                            }
                            ?>
                            <a id="plth" href="" class="btn btn-info" role="button">價格排序：低->高</a>
                            <a id="phtl" href="" class="btn btn-info" role="button">價格排序：高->低</a>
                        </div>
                    </div>
                </div>

                <script>
                    updatePriceLink();

                    function updatePriceLink() {
                        var plth = $("#plth")[0];
                        var phtl = $("#phtl")[0];
                        var url = window.location.href;
                        var regex1 = /\?/;
                        if (url.match(regex1)) {
                            var regex2 = /order/;
                            if (url.match(regex2)) {
                                plth.href = url.slice(0, -1).concat('1');
                                phtl.href = url.slice(0, -1).concat('2');
                            } else {
                                plth.href = url.concat('&order=1');
                                phtl.href = url.concat('&order=2');
                            }
                        } else {
                            plth.href = url.concat('?order=1');
                            phtl.href = url.concat('?order=2');
                        }
                    }
                </script>
                <!-- btn -->

                <hr/>

                <div class="product-area">

                    <div class="product-list">

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
                                        //echo '<div class="pd-type">' . $product['name'] . '</div>';

                                        if ($isLogin) {
                                            switch ($_SESSION['user2']['type']) {
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
                                            echo '<div class="pd-price">促銷價$ ' . $product['promo_price'] . ' 元</div>';
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

    $(".pd-pic").height(($(".pd-pic").width() * 6) / 5);
</script>

</body>

</html>
