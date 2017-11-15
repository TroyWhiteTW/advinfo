<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);
?>
<?php
$isSearch = !empty($_GET['search']);
if ($isSearch) {
    $search = trim($_GET['search']);

    $sql = 'SELECT * FROM products,protags WHERE protags.no=products.protags AND products.status=3';
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

                <div class="beard">
                    <ul>
                        <li><a href="index.php">首頁</a></li>
                        <li><img src="img/process_icon.png" alt=""></li>
                        <li><h3>商品查詢</h3></li>
                    </ul>
                </div>

                <?php if ($isSearch): ?>

                    <?php

                    $panelSql = 'SELECT * FROM proclass WHERE status=1 ORDER BY sort ASC';
                    $panelRows = [];
                    $panelRes = mysqli_query($conn, $panelSql);
                    while ($row = mysqli_fetch_assoc($panelRes)) {
                        $panelRows[] = $row;
                    }

                    foreach ($panelRows as $one) {
                        if ($one['parent'] == 0) {
                            echo '<div class="panel panel-default">';
                            echo '<div class="panel-heading">' . $one['pcname'] . '</div>';
                            echo '<div class="panel-body">';

                            foreach ($products as $product) {
                                if ($one['no'] == $product['pcno']) {

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

                                    echo '</a>';
                                    echo '</div>';
                                }
                            }

                            foreach ($panelRows as $two) {
                                if ($two['parent'] == $one['no'] && $one['parent'] == 0) {

                                    foreach ($products as $product) {
                                        if ($two['no'] == $product['pcno']) {

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

                                            echo '</a>';
                                            echo '</div>';
                                        }
                                    }

                                    foreach ($panelRows as $three) {
                                        if ($three['parent'] == $two['no'] && $two['parent'] != 0) {

                                            foreach ($products as $product) {
                                                if ($three['no'] == $product['pcno']) {

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

                                                    echo '</a>';
                                                    echo '</div>';
                                                }
                                            }

                                        }
                                    }
                                }
                            }

                            echo '</div>';
                            echo '</div>';
                        }
                    }

//                    foreach ($products as $product) {
//
//                        echo '<div class="pd">';
//                        echo "<a href='pd_page.php?proid=" . $product['proid'] . "'>";
//                        echo '<div class="pd-pic"><img src="img/pd_01.jpg" alt=""/></div>';
//                        echo "<div class='pd-name'>{$product['proname']}</div>";
//                        echo "<div class='pd-type'>{$product['name']}</div>";
//                        if ($isLogin) {
//                            echo "<div class='pd-pv'>PV/紅利：{$product['PV']}</div>";
//                        }
//
//                        // 促銷商品
//                        if ($product['protags'] == 2) {
//                            echo "<div class='pd-price'>促銷價$ {$product['price']}元</div>";
//                        } else {
//                            echo "<div class='pd-price'>價格$ {$product['promo_price']}元</div>";
//                        }
//
//                        // 左上方的圖標
//                        if ($product['protags'] == 1) {
//                            // 新品上市
//                            echo '<div class="tag-type"><img src="img/tag_new.png" alt=""></div>';
//                        } else if ($product['protags'] == 2) {
//                            // 促銷商品
//                            echo '<div class="tag-type"><img src="img/tag_promot.png" alt=""></div>';
//                        }
//
//                        echo '</a>';
//                        echo '</div>';
//                    }

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
