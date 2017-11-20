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

?>
<!doctype html>
<html>

<head>

    <?php include 'http_head.php'; ?>

</head>

<body>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Brand</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                <li><a href="#">Link</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
            </ul>
            <form class="navbar-form navbar-left">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Link</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<div class="container">

    <div class="row">

        <div class="col-md-2">

            <?php include 'side_bar.php'; ?>

        </div>

        <div class="col-md-10">

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
                    echo '<div class="pd-type">滴丸</div>';

                    if ($isLogin) {
                        switch ($_SESSION['user'][20]) {
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

                    echo '</a></div></div>';
                }
                echo '</div>';
                echo '</div>';
            }
            ?>

        </div>

    </div>

    <hr/>

    <?php include 'footer.php'; ?>

</div>

</body>

</html>
