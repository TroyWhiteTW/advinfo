<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);
?>
<?php
// GET protags = null => 全部種類
// GET protags = 1 => 新品
// GET protags = 2 => 促銷
// GET order = 1 => 低到高排序
// GET order = 2 => 高到低排序

$sql = 'SELECT * FROM products,protags WHERE protags.no=products.protags AND products.status=3';

if (!isset($_GET['protags'])) {

    if (!isset($_GET['order'])) {
        $sql .= ' order by products.price desc';
    } else {
        switch ($_GET['order']) {
            case 1:
                $sql .= ' order by products.price desc';
                break;
            case 2:
                $sql .= ' order by products.price asc';
                break;
            default:
                $sql .= ' order by products.price desc';
                break;
        }
    }

} else {

    $sql .= ' and products.protags=' . $_GET['protags'];

    if (!isset($_GET['order'])) {
        $sql .= ' order by products.price desc';
    } else {
        switch ($_GET['order']) {
            case 1:
                $sql .= ' order by products.price desc';
                break;
            case 2:
                $sql .= ' order by products.price asc';
                break;
            default:
                $sql .= ' order by products.price desc';
                break;
        }
    }

}
//var_dump($sql);return;
$products = array();
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
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
                        <li><a href="">商品類別</a></li>
                    </ul>
                </div>

                <div class="content-area">
                    <div class="row">
                        <div class="col-sm-12">
                            <a href="pd_query.php" class="btn btn-primary" role="button">全部商品</a>
                            <?php
                            $protagsSql = 'SELECT * FROM protags';
                            $tagsRes = mysqli_query($conn, $protagsSql);
                            while ($row = mysqli_fetch_assoc($tagsRes)) {
                                echo '<a href="pd_query.php?protags=' .
                                    $row['no'] .
                                    '" class="btn" role="button" style="color: white;background-color: ' .
                                    $row['color'] .
                                    ';">' .
                                    $row['name'] .
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

                <div class="product-area">

                    <div class="product-list">

                        <?php

                        foreach ($products as $product) {

                            echo '<div class="pd">';
                            echo "<a href='pd_page.php?proid=" . $product['proid'] . "'>";

                            //echo '<div class="pd-pic"><img src="img/pd_01.jpg" alt=""/></div>';

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

                            if ($protag['pic'] != '0') {
                                echo '<div class="tag-type"><img src="upload/product/' . $protag['pic'] . '" alt=""></div>';
                            }


//                             // 左上方的圖標
//                             if ($product['protags'] == 1) {
//                                 // 新品上市
//                                 echo '<div class="tag-type"><img src="img/tag_new.png" alt=""></div>';
//                             } else if ($product['protags'] == 2) {
//                                 // 促銷商品
//                                 echo '<div class="tag-type"><img src="img/tag_promot.png" alt=""></div>';
//                             }

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
</script>

</body>

</html>
