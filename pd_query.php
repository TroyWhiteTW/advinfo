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
                        <li><a href="pd_query.php">商品類別</a></li>
                    </ul>
                </div>

                <!-- btn -->
                <div class="content-area">
                    <div class="row">
                        <div class="col-sm-12">
                            <a href="pd_query.php" class="btn btn-primary" role="button">全部商品</a>
                            <?php
                            $protagsSql = 'SELECT * FROM protags';
                            $tagsRes = mysqli_query($conn, $protagsSql);
                            while ($tagsRow = mysqli_fetch_assoc($tagsRes)) {
                                echo '<a href="pd_query.php?protags=' .
                                    $tagsRow['no'] .
                                    '" class="btn" role="button" style="color: white;background-color: ' .
                                    $tagsRow['color'] .
                                    ';">' .
                                    $tagsRow['name'] .
                                    '</a>' .
                                    "\n";
                            }
                            ?>
                            <a id="phtl" href="" class="btn btn-info" role="button">價格排序：低->高</a>
                            <a id="plth" href="" class="btn btn-info" role="button">價格排序：高->低</a>
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

                <?php

                //                $panelSql = 'SELECT * FROM proclass WHERE status=1 AND parent=0 ORDER BY sort ASC';
                //                $panelRes = mysqli_query($conn, $panelSql);
                //                while ($row = mysqli_fetch_assoc($panelRes)) {
                //                    echo '<div class="panel panel-default">';
                //                    echo '<div class="panel-heading">'.$row['pcname'].'</div>';
                //                    echo '<div class="panel-body">';
                //                    echo 'Basic panel example';
                //                    echo '</div>';
                //                    echo '</div>';
                //                }

                ?>

                <div class="product-area">

                    <div class="product-list">

                        <?php

                        $panelSql = 'SELECT * FROM proclass WHERE status=1 ORDER BY sort ASC';
                        $panelRows = [];
                        $panelRes = mysqli_query($conn, $panelSql);
                        while ($row = mysqli_fetch_assoc($panelRes)) {
                            $panelRows[] = $row;
                        }

                        $kind = 0;
                        $s = 1;
                        $t = 1;
                        $newProducts = [];

                        $getKind = null;
                        $getClass = null;
                        $getS = null;
                        $getT = null;
                        if (isset($_GET['kind']) && isset($_GET['class'])) {
                            $getKind = (int)trim($_GET['kind']);
                            $getClass = (int)trim($_GET['class']);
                            if (isset($_GET['s'])) $getS = (int)trim($_GET['s']);
                            if (isset($_GET['t'])) $getT = (int)trim($_GET['t']);

                            foreach ($panelRows as $one) {
                                if ($one['parent'] == 0) {

                                    sortProducts($one['no'], $kind, 1, $s, $t);

                                    foreach ($panelRows as $two) {
                                        if ($two['parent'] == $one['no'] && $one['parent'] == 0) {

                                            sortProducts($two['no'], $kind, 2, $s, $t);

                                            foreach ($panelRows as $three) {
                                                if ($three['parent'] == $two['no'] && $two['parent'] != 0) {

                                                    sortProducts($three['no'], $kind, 3, $s, $t);

                                                    $t++;
                                                }
                                            }
                                            $s++;
                                        }
                                    }

                                    $kind++;
                                }
                            }

                            if (isset($getKind) && isset($getClass)) {
                                echo '<div class="panel panel-default">';
                                $no = $_GET['no'];
                                $noSql = 'SELECT pcname FROM proclass WHERE no=' . $no;
                                $noRes = mysqli_query($conn, $noSql);
                                while ($row = mysqli_fetch_assoc($noRes)) {
                                    echo '<div class="panel-heading">' . $row['pcname'] . '</div>';
                                }
                                echo '<div class="panel-body">';
                            }

                            foreach ($newProducts as $product) {
                                if (isset($product['kind']) && isset($product['class']) &&
                                    $product['kind'] == $getKind) {

                                    switch ($getClass) {
                                        case 1:

                                            if ($getClass == 1) {
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
                                                    echo "<div class='pd-price'>促銷價$ {$product['price']}元</div>";
                                                } else {
                                                    echo "<div class='pd-price'>價格$ {$product['promo_price']}元</div>";
                                                }

                                                if ($product['protags'] != '0') {
                                                    echo '<div class="tag-type"><img src="upload/product/' . $product['pic'] . '" alt=""></div>';
                                                }

                                                echo '</a>';
                                                echo '</div>';
                                            }

                                            break;
                                        case 2:

                                            if ($getS == $product['s']) {

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
                                                    echo "<div class='pd-price'>促銷價$ {$product['price']}元</div>";
                                                } else {
                                                    echo "<div class='pd-price'>價格$ {$product['promo_price']}元</div>";
                                                }

                                                if ($product['protags'] != '0') {
                                                    echo '<div class="tag-type"><img src="upload/product/' . $product['pic'] . '" alt=""></div>';
                                                }

                                                echo '</a>';
                                                echo '</div>';

                                            }

                                            break;
                                        case 3:

                                            if ($getS != 0 && $getT != 0 && $getS == $product['s'] && $getT == $product['t']) {
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
                                                    echo "<div class='pd-price'>促銷價$ {$product['price']}元</div>";
                                                } else {
                                                    echo "<div class='pd-price'>價格$ {$product['promo_price']}元</div>";
                                                }

                                                if ($product['protags'] != '0') {
                                                    echo '<div class="tag-type"><img src="upload/product/' . $product['pic'] . '" alt=""></div>';
                                                }

                                                echo '</a>';
                                                echo '</div>';
                                            }

                                            break;
                                    }

                                }
                            }

                            if (isset($getKind) && isset($getClass)) {

                                echo '</div>';
                                echo '</div>';

                            }

                        } else {

                            foreach ($panelRows as $one) {
                                if ($one['parent'] == 0) {
                                    echo '<div class="panel panel-default">';
                                    echo '<div class="panel-heading">' . $one['pcname'] . '</div>';
                                    echo '<div class="panel-body">';

                                    searchProducts($one['no']);

                                    foreach ($panelRows as $two) {
                                        if ($two['parent'] == $one['no'] && $one['parent'] == 0) {

                                            searchProducts($two['no']);

                                            foreach ($panelRows as $three) {
                                                if ($three['parent'] == $two['no'] && $two['parent'] != 0) {

                                                    searchProducts($three['no']);

                                                }
                                            }
                                        }
                                    }

                                    echo '</div>';
                                    echo '</div>';
                                }
                            }


                        }


                        function sortProducts($no, $kind, $class, $s, $t)
                        {
                            global $products, $newProducts;
                            foreach ($products as $product) {
                                if ($no == $product['pcno']) {
                                    $product['kind'] = $kind;
                                    $product['class'] = $class;

                                    if ($class == 1) {
                                        $product['s'] = 0;
                                        $product['t'] = 0;
                                    } elseif ($class == 2) {
                                        $product['s'] = $s;
                                        $product['t'] = 0;
                                    } elseif ($class == 3) {
                                        $product['s'] = $s;
                                        $product['t'] = $t;
                                    }

                                    $newProducts[] = $product;
                                }
                            }
                        }

                        function searchProducts($no)
                        {
                            global $products, $conn, $isLogin;

                            foreach ($products as $product) {
                                if ($no == $product['pcno']) {

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
                                        echo "<div class='pd-price'>促銷價$ {$product['price']}元</div>";
                                    } else {
                                        echo "<div class='pd-price'>價格$ {$product['promo_price']}元</div>";
                                    }

                                    if ($product['protags'] != '0') {
                                        echo '<div class="tag-type"><img src="upload/product/' . $product['pic'] . '" alt=""></div>';
                                    }

                                    echo '</a>';
                                    echo '</div>';

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
</script>

</body>

</html>
