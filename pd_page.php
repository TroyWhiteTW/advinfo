<?php
include 'db.php';
?>
<?php
// 產品分類
$sql = "select * from proclass where parent = 0 order by no";
$result = mysqli_query($conn, $sql);
//    if (mysqli_num_rows($result) > 0){
//        while ($row = mysqli_fetch_assoc($result)){
//            $proclass[] = array(
//                'no' => "{$row['no']}",
//                'pcname' => "{$row['pcname']}"
//            );
//        }
//    }else{
//        // 錯誤 查詢結果
//        echo 'E1';
//        return;
//    }
//
//    // 傳遞 proid
//    if (!isset($_REQUEST['proid'])) die ("Server Busy!");
//    $proid = $_REQUEST['proid'];
//
//    $sql = "select * from products where proid = '{$proid}'";
//    $result = mysqli_query($conn, $sql);
//    if (mysqli_num_rows($result) > 0){
//        // 撈該筆資料的全部欄位資料
//        $product = mysqli_fetch_assoc($result);
//    }else{
//        // 錯誤 查詢結果
//        echo 'E2';
//        return;
//    }

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

            <div class="col-sm-2 left-area hidden-xs">
                <div class="left-move ">


                    <div class="logo">
                        <a href="index.php">
                            <img src="img/logo.jpg" style="" alt="">
                        </a>
                    </div>

                    <div class="menu-area">
                        <ul>
                            <?php
                            // 左側分類
                            foreach ($proclass as $class) {
                                echo '<li>';
                                echo "<a href=pd_query.php?pcno1={$class['no']}>";
                                echo $class['pcname'];
                                echo '</a>';
                                echo '</li>';
                            }
                            ?>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="col-sm-10">
                <div class="beard">
                    <ul>
                        <li><a href="index.php">首頁</a></li>
                        <li><img src="img/process_icon.png" alt=""></li>
                        <li><a href="pd_query.php">類別</a></li>
                        <li><img src="img/process_icon.png" alt=""></li>
                        <li><a href="pd_page.php">商品頁</a></li>
                    </ul>
                </div>
                <div class="content-area">
                    <div class="content-article">

                        <div class="product-pic-area ">
                            <div class="product-pic">

                                <img src="img/pd_01.jpg" id="prod_img" alt="" style="width:100%;">

                                <div class="tag-type">
                                    <?php
                                    if ($product['pcno3'] == 1) {
                                        // 新品上市
                                        echo '<img src="img/tag_new.png">';
                                    } else if ($product['pcno3'] == 2) {
                                        // 促銷商品
                                        echo '<img src="img/tag_promot.png">';
                                    }
                                    ?>

                                </div>
                            </div>


                            <div class="pic-small " style="">
                                <div class="pic-s contentbtn thumb_selected "
                                     style="background-image:url('img/pd_01.jpg');">

                                </div>

                                <div class="pic-s contentbtn  "
                                     style="background-image:url('img/pd_02.jpg');">

                                </div>

                                <div class="pic-s contentbtn  "
                                     style="background-image:url('img/pd_03.jpg');">

                                </div>

                                <div class="pic-s contentbtn  "
                                     style="background-image:url('img/pd_04.jpg');">

                                </div>

                                <div class="pic-s contentbtn  "
                                     style="background-image:url('img/pd_05.jpg');">

                                </div>

                            </div>

                            <!--
                            <div class="pic-small">
                                <div class="pic-s"></div>
                                <div class="pic-s"></div>
                                <div class="pic-s"></div>
                                <div class="pic-s"></div>
                            </div>
                            -->

                        </div>

                        <div class="product-info-area">
                            <div class="product-tittle"><?php echo $product['proname']; ?></div>
                            <div class="product-info"><?php echo $product['prointro']; ?></div>
                            <div style="margin-top:10px;">
                                <div class="price-unit">NTS</div>
                                <div class="price-big"><?php echo $product['price']; ?></div>
                                <div class="goods">庫存數量：<?php echo $product['stock']; ?></div>
                            </div>
                            <div class="pv-number">PV值：<?php echo $product['PV']; ?></div>
                            <div class="goods-number">商品編號：<?php echo $product['proid']; ?></div>
                            <div style="margin-top:10px;">
                                <div class="number">數量
                                    <select name="" id="">
                                        <option selected="selected" value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="3">4</option>
                                        <option value="3">5</option>
                                    </select>
                                </div>
                                <div class="buy-btn-area">
                                    <div class="buy-btn">加入購物車</div>
                                    <div class="buy-btn">直接購買</div>
                                </div>
                                <div class="pay-way">可付款方式：</div>
                                <div class="pay-icon"><img src="img/visa.png" alt=""></div>
                            </div>
                        </div>
                    </div>
                    <div class="content-article">
                        <div class="form-tittle">
                            <div class="pd-intro-tittle">商品介紹</div>
                            <img src="img/pd_01.jpg" alt="" width="100%">
                        </div>
                        <div class="form-tittle">
                            <img src="img/pd_02.jpg" alt="" width="100%">
                        </div>

                        <div class="form-tittle">
                            <img src="img/pd_03.jpg" alt="" width="100%">
                        </div>
                    </div>
                    <div class="content-article">
                        <table width="100%" border="1" cellspacing="1" cellpadding="1" style="border-color:#3E3E3E;">
                            <tbody>
                            <tr class="tb-02">
                                <th>商品規格</th>
                                <th>注意事項</th>
                            </tr>
                            <tr>
                                <td class="td-03">
                                    <p>規格：<?php echo $product['size']; ?></p>
                                    <p>重量：<?php echo $product['weight']; ?></p>
                                </td>
                                <td class="td-03"><?php echo $product['memo']; ?></td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="content-article">
                        <table width="100%" border="1" cellspacing="1" cellpadding="1" style="border-color:#3E3E3E;">
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
            </div>
        </div>

        <?php include 'footer.php'; ?>

    </div>

</div>

<script>
    $('.contentbtn').click(function () {

        $('.contentbtn').removeClass('thumb_selected');

        var content = new Array();
        content[0] = 'img/pd_01.jpg';
        content[1] = 'img/pd_02.jpg';
        content[2] = 'img/pd_03.jpg';
        content[3] = 'img/pd_04.jpg';
        content[4] = 'img/pd_05.jpg';
        var self = $(this);
        var index = self.index();
        //console.log(index);
        $(this).addClass('thumb_selected');

        $('#prod_img').attr("src", content[index]);
    });
</script>
</body>

</html>
