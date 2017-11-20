<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);

// 輪播資料
$sql = 'SELECT name,pic,url,sort FROM banners WHERE status=1 ORDER BY sort';
$banners = [];
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $banners[] = $row;
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

?>
<!doctype html>
<html>

<head>

    <?php include 'http_head.php'; ?>

    <!-- Custom styles for this template -->
    <link href="carousel.css" rel="stylesheet">

</head>

<body>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <a class="btn btn-default pull-left visible-xs" data-toggle="offcanvas" aria-label="Menu">
            <i class="fa fa-bars fa-2x" aria-hidden="true"></i>
        </a>
    </div><!-- /.container-fluid -->
</nav>

<div class="container">

    <div class="row row-offcanvas row-offcanvas-left">

        <div class="col-sm-2 sidebar-offcanvas" id="sidebar">

            <?php include 'side_bar.php'; ?>

        </div>

        <div class="col-sm-10">

            <!-- Carousel
            ================================================== -->
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">

                    <?php
                    foreach ($banners as $banner) {

                        if ($banner['sort'] == 1) {
                            echo '<li data-target="#myCarousel" data-slide-to="' . $banner['sort'] . '" class="active"></li>';
                        } else {
                            echo '<li data-target="#myCarousel" data-slide-to="' . $banner['sort'] . '"></li>';
                        }

                    }
                    ?>

                </ol>
                <div class="carousel-inner" role="listbox">

                    <!--                    <div class="item active">-->
                    <!--                        <img class="first-slide"-->
                    <!--                             src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="-->
                    <!--                             alt="First slide">-->
                    <!--                        <div class="container">-->
                    <!--                            <div class="carousel-caption">-->
                    <!--                                <h1>Example headline.</h1>-->
                    <!--                                <p>Note: If you're viewing this page via a <code>file://</code> URL, the "next" and-->
                    <!--                                    "previous" Glyphicon buttons on the left and right might not load/display properly-->
                    <!--                                    due to web browser security rules.</p>-->
                    <!--                                <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                    </div>-->

                    <?php
                    foreach ($banners as $banner) {

                        if ($banner['sort'] == 1) {
                            echo '<div class="item active">';
                        } else {
                            echo '<div class="item">';
                        }

//                        echo '<a href="' . $banner['url'] . '">';
                        echo '<img src="' . 'upload/banners/' . $banner['pic'] . '"/>';
//                        echo '</a>';

//                        echo '<div class="container">';
//                        echo '<div class="carousel-caption">';
//                        echo '<p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>';
//                        echo '</div>';
//                        echo '</div>';

                        echo '</div>';

                    }
                    ?>

                </div>
                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div><!-- /.carousel -->

            <?php
            // 開始該標籤的商品
            foreach ($protags as $protag) {
                echo '<div class="row" style="background:' . $protag['color'] . '">';
                echo '<div class="col-sm-2">' . $protag['name'] . '</div>';
                echo '<div class="col-sm-8"><br/><br/></div>';
                echo '<div class="col-sm-2"><a href="pd_query.php?protags=' . $protag['no'] . '">more</a></div>';
                echo '</div>';

                echo '<div class="row">';
                $tagno = $protag['no'];
                foreach ($products[$tagno] as $product) {
                    echo '<div class="col-sm-6 col-md-4">';
                    echo '<div class="thumbnail">';

                    echo '<a href="pd_page.php?proid=' . $product['proid'] . '">';

                    if ($protag['pic'] != '0') {
                        echo '<div class="tag-type"><img src="upload/product/' . $protag['pic'] . '" alt=""></div>';
                    }

                    // 搜尋該商品的主圖
                    $sql = "select * from productpics where proid='" . $product['proid'] . "' and sort=1";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        // 撈出主圖
                        $row = mysqli_fetch_assoc($result);
                        echo '<img src="upload/product/' . $row['picfile'] . '" alt=""/>';
                    } else {
                        echo '<img src="" alt="">';
                    }

                    echo '<div class="caption">';

                    echo '<p>' . $product['proname'] . '</p>';
                    echo '<p>滴丸</p>';

                    if ($isLogin) {
                        switch ($_SESSION['user'][20]) {
                            case 1:
                                echo '<p>紅利：' . $product['bonuce'] . '</p>';
                                break;
                            case 2:
                                echo '<p>PV：' . $product['pv'] . '</p>';
                                break;
                        }
                    } else {
                        echo '<p>請登入後查看</p>';
                    }

                    echo '<p>價格$' . $product['price'] . '元</p>';

                    echo '</div>';
                    echo '</a>';
                    echo '</div>';
                    echo '</div>';
                }
                echo '</div>';
            }
            ?>

        </div>

    </div>

</div>

<hr/>

<div class="container-fluid">
    <?php include 'footer.php'; ?>
</div>

<?php include 'cdnscript.php'; ?>
<script src="offcanvas.js"></script>

</body>

</html>
