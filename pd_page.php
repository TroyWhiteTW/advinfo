<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);

$hasProid = !empty($_GET['proid']);// 從 GET 取得產品 id
$hasPreview = !empty($_GET['preview']);
$showProduct = false;
if ($hasProid == true && $hasPreview == false) {
    $showProduct = true;
} else if ($hasProid == true && $hasPreview == true) {
    if (md5($_GET['proid']) == $_GET['preview']) {
        $showProduct = true;
    }
}

$proid = 0;

if ($showProduct) {

    // product
    $proid = trim($_GET['proid']);// 產品 id 處理

    $productSql = 'SELECT products.proid, products.proname, products.prointro, products.price, products.PV, products.bonuce, products.stock, products.prodetail, products.protags, products.weight, products.size, products.promo_price, products.promo_PV, products.promo_bonuce, protags.name, protags.pic, protags.color, productclass.pcno1, productclass.pcno2, productclass.pcno3 FROM (SELECT * FROM products WHERE status=3';
    $productSql .= ' AND proid=\'' . $proid . '\'';
    $productSql .= ') products LEFT JOIN protags ON products.protags=protags.no LEFT JOIN productclass ON products.proid=productclass.proid';

    $productRes = mysqli_query($conn, $productSql);

    if (mysqli_num_rows($productRes) > 0) {
        // 撈該筆資料的全部欄位資料
        $product = mysqli_fetch_assoc($productRes);
    } else {
        // 錯誤
        $hasProid = false;
    }

    // protags
//    $protags = [];
//    $protagsSql = 'SELECT no, name, pic, color FROM protags';
//    $protagsRes = mysqli_query($conn, $protagsSql);
//    while ($protagsRow = mysqli_fetch_assoc($protagsRes)) {
//        $protags[] = $protagsRow;
//    }

    // proclass
    $proclass = [];
    $proclassSql = 'SELECT no, parent, pcname FROM proclass WHERE status=1 ORDER BY sort ASC';
    $proclassRes = mysqli_query($conn, $proclassSql);
    while ($proclassRow = mysqli_fetch_assoc($proclassRes)) {
        $proclass[] = $proclassRow;
    }

    // pics
    $pics = [];
    $picSql = 'SELECT proid, picname, picfile, sort FROM productpics WHERE proid=\'' . $product['proid'] . '\' ORDER BY sort ASC';
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

                    <ul>

                        <li><a href="index.php">首頁</a></li>
                        <li><img src="img/process_icon.png" alt=""></li>

                        <?php if ($showProduct): ?>
                            <?php
                            foreach ($proclass as $item) {
                                if ($item['no'] == $product['pcno1']) {
                                    echo '<li><a href="pd_query.php?first=' . $product['pcno1'] . '&second=0&third=0">' . $item['pcname'] . '</a></li>';
                                    break;
                                }
                            }
                            echo '<li><img src="img/process_icon.png" alt=""></li>';
                            foreach ($proclass as $item) {
                                if ($item['no'] == $product['pcno2']) {
                                    echo '<li><a href="pd_query.php?first=' . $product['pcno1'] . '&second=' . $product['pcno2'] . '&third=0">' . $item['pcname'] . '</a></li>';
                                    break;
                                }
                            }
                            echo '<li><img src="img/process_icon.png" alt=""></li>';
                            foreach ($proclass as $item) {
                                if ($item['no'] == $product['pcno3']) {
                                    echo '<li><a href="pd_query.php?first=' . $product['pcno1'] . '&second=' . $product['pcno2'] . '&third=' . $product['pcno3'] . '">' . $item['pcname'] . '</a></li>';
                                    break;
                                }
                            }
                            echo '<li><img src="img/process_icon.png" alt=""></li>';
                            echo '<li><a>' . $product['proname'] . '</a></li>';
                            ?>
                        <?php else: ?>
                            <li class="active">商品資訊錯誤</li>
                        <?php endif; ?>

                    </ul>

                </div>

                <?php if ($showProduct): ?>

                    <div class="content-area">

                        <div class="content-article">

                            <div class="product-pic-area ">

                                <div class="product-pic">

                                    <?php
                                    foreach ($pics as $pic) {
                                        if ($pic['sort'] == 1) {
                                            echo '<img src="upload/product/' . $pic['picfile'] . '" id="prod_img" alt="" style="width:100%;">';
                                            break;
                                        }
                                    }
                                    ?>

                                    <div class="tag-type">
                                        <?php
                                        if ($product['protags'] != '0') {
                                            echo '<img src="upload/product/' . $product['pic'] . '" alt="">';
                                        }
                                        ?>
                                    </div>

                                </div>

                                <div class="pic-small " style="">
                                    <?php
                                    foreach ($pics as $pic) {
                                        $html = '';
                                        $html .= '<div onclick="changeImg(this)" class="pic-s contentbtn';
                                        if ($pic['sort'] == 1) {
                                            $html .= ' thumb_selected';
                                        }
                                        $html .= ' " style="background-image:url(\'upload/product/';
                                        $html .= $pic['picfile'];
                                        $html .= '\');">';
                                        echo $html;
                                        echo '</div>';
                                    }
                                    ?>
                                </div>

                                <script>
                                    function changeImg(e) {
                                        document.getElementById('prod_img').src = e.style.backgroundImage.slice(5, -2);
                                        var divs = document.getElementsByClassName('pic-small')[0].getElementsByTagName('div');
                                        for (var i = 0; i < divs.length; i++) {
                                            divs[i].classList.remove('thumb_selected');
                                        }
                                        e.classList.add('thumb_selected');
                                    }
                                </script>

                            </div>

                            <div class="product-info-area">

                                <div class="product-tittle"><?php echo $product['proname']; ?></div>

                                <div class="product-info"><?php echo $product['prointro']; ?></div>

                                <div style="margin-top:10px;">
                                    <div class="price-unit">NT$</div>
                                    <div class="price-big"><?php echo $product['price']; ?></div>
                                    <div class="goods">庫存數量：<?php echo $product['stock']; ?></div>
                                </div>

                                <?php
                                if ($isLogin) {
                                    switch ($_SESSION['user2']['type']) {
                                        case 1:
                                            echo '<div class="pv-number">紅利：' . $product['bonuce'] . '</div>';
                                            break;
                                        case 2:
                                            echo '<div class="pv-number">PV：' . $product['PV'] . '</div>';
                                            break;
                                    }
                                } else {
                                    echo '<div class="pv-number">請登入後查看</div>';
                                }
                                ?>

                                <div class="goods-number">商品編號：<?php echo $product['proid']; ?></div>

                                <div style="margin-top:10px;">

                                    <div class="number">數量
                                        <?php
                                        if ($product['stock'] > 0) {
                                            echo '<select name="" id="sc" >';
                                            for ($i = 1; $i <= $product['stock']; $i++) {
                                                echo '<option value="' . $i . '">' . $i . '</option>';
                                                if ($i == 10) {
                                                    break;
                                                }
                                            }
                                            echo '</select >';
                                        } else {
                                            echo '<span style="color: red">商品暫時缺貨</span>';
                                        }
                                        ?>
                                    </div>

                                    <?php if ($product['stock'] > 0) { ?>
                                        <div class="buy-btn-area">

                                            <div id="addCart" class="buy-btn">加入購物車</div>

                                            <script>
                                                $('#addCart').click(function () {
                                                    $.ajax({
                                                        url: "./add_cart.php",
                                                        type: 'POST',
                                                        data: {
                                                            proid:<?= '\'' . $proid . '\''?>,
                                                            count: $('#sc').val()
                                                        },
                                                        error: function () {
                                                            alert('發生錯誤');
                                                        },
                                                        success: function (response) {
                                                            alert(response);
                                                            //更新top_bar購物車數量
                                                            $.post('./add_cart.php', {act: 'getCount'}, function (response) {
                                                                eval(response);
                                                            });
                                                        }
                                                    });
                                                });
                                            </script>

                                            <?php if ($isLogin): ?>

                                                <form id="directPurchase" method="post" action="purchase.php">
                                                    <input id="" name="proid" value="<?= $proid ?>" hidden="hidden">
                                                    <input id="purchaseCount" name="count" value="1" hidden="hidden">
                                                    <div id="directPurchaseDiv" class="buy-btn" value="直接購買">直接購買</div>
                                                </form>

                                                <script>
                                                    $('#sc').change(function () {
                                                        $('#purchaseCount').val($('#sc').val());
                                                    });
                                                    $('#directPurchaseDiv').click(function () {
                                                        document.getElementById("directPurchase").submit()
                                                    });
                                                </script>

                                            <?php else: ?>

                                            <input id="" name="proid" value="<?= $proid ?>" hidden="hidden">
                                            <input id="purchaseCount" name="count" value="1" hidden="hidden">
                                                <div id="directPurchaseDiv" class="buy-btn" value="直接購買">直接購買</div>

                                                <script>
                                                    $('#sc').change(function () {
                                                        $('#purchaseCount').val($('#sc').val());
                                                    });
                                                    $('#directPurchaseDiv').click(function () {
                                                        alert('請先登入');
                                                    });
                                                </script>

                                            <?php endif; ?>

                                        </div>
                                    <?php } ?>

                                    <div class="pay-way">可付款方式：</div>

                                    <div class="pay-icon"><img src="img/visa.png" alt=""></div>

                                </div>

                            </div>

                        </div>

                        <div class="content-article">

                            <div class="form-tittle">
                                <div class="pd-intro-tittle">商品介紹</div>
                                <div><?php echo $product['prodetail']; ?></div>
                            </div>

                            <hr/>

                        </div>

                        <div class="content-article">

                            <table width="100%" border="1" cellspacing="1" cellpadding="1"
                                   style="border-color:#3E3E3E;">
                                <tbody>
                                <tr class="tb-02">
                                    <th>商品規格</th>
                                    <th>注意事項</th>
                                </tr>
                                <tr>
                                    <td class="td-03">
                                        <p>規格：<?php
                                            $a = $product['size'];
                                            $regex = '/[^(0-9\.)]+/';
                                            $b = preg_split($regex, $a);
                                            $c = array_filter($b, function ($i) {
                                                return $i != "";
                                            });
                                            echo '長：' . $c[1] . '公分，';
                                            echo '寬：' . $c[2] . '公分，';
                                            echo '高：' . $c[3] . '公分。';
                                            ?></p>
                                        <p>重量：<?php echo $product['weight'] . '公斤。'; ?></p>
                                    </td>
                                    <td class="td-03"><?php echo $product['memo']; ?></td>
                                </tr>
                                </tbody>
                            </table>

                        </div>

                        <div class="content-article">

                            <table width="100%" border="1" cellspacing="1" cellpadding="1"
                                   style="border-color:#3E3E3E;">
                                <tbody>
                                <tr class="tb-02">
                                    <td>滿意服務</td>
                                </tr>
                                <tr>
                                    <td class="td-03">
                                        <ul>
                                            <li>據消保法規定，凡購買之消費者均享有商品到貨7天(包含假日)鑑賞期之權益(※鑑賞期非試用期)。</li>
                                            <li>據消保法規定，凡購買之消費者均享有商品到貨7天(包含假日)鑑賞期之權益(※鑑賞期非試用期)。</li>
                                            <li>據消保法規定，凡購買之消費者均享有商品到貨7天(包含假日)鑑賞期之權益(※鑑賞期非試用期)。</li>
                                        </ul>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                        </div>

                    </div>

                <?php else: ?>

                    <h3>商品資訊錯誤</h3>

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

    //新增側邊欄
</script>

</body>

</html>
