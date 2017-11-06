<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);
?>
<?php
// 產品分類
$sql = "select * from proclass where parent = 0 order by no";
$result = mysqli_query($conn, $sql);
//if (mysqli_num_rows($result) > 0) {
//    while ($row = mysqli_fetch_assoc($result)) {
//        $proclass[] = array(
//            'no' => "{$row['no']}",
//            'pcname' => "{$row['pcname']}"
//        );
//    }
//} else {
//    // 錯誤 查詢結果
//    echo 'E1';
//    return;
//}
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

                        <li><a href="cart_1.php">購物車</a></li>

                    </ul>

                </div>

                <div class="content-area">

                    <div class="cart-area">

                        <ul>

                            <li class="select"><a href="cart_1.php">1.確認商品</a></li>

                            <li><img src="img/process_icon.png" alt=""></li>

                            <li><a href="cart_2.php">2.收件人資訊</a></li>

                            <li><img src="img/process_icon.png" alt=""></li>

                            <li><a href="cart_3.php">3.確認訂單資料</a></li>

                            <li><img src="img/process_icon.png" alt=""></li>

                            <li><a href="cart_4.php">4.完成確認</a></li>

                        </ul>

                    </div>

                    <div class="content-article">

                        <div class="form-name">購物車</div>

                        <table width="100%" border="1" style="margin-top:10px;">

                            <tbody>

                            <tr class="tb-tittle">

                                <td>商品名稱</td>

                                <td>數量</td>

                                <td>價格</td>

                                <td>PV</td>

                                <td>刪除</td>

                            </tr>

                            <tr class="td-02">

                                <td>商品名稱商品名稱11字 <br>商品名稱商品名稱11字 <br><span style="color:red;">(產品編號)</span><br><br></td>

                                <td><select>
                                        <option value="1" selected>1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select></td>

                                <td>$200</td>

                                <td>199</td>

                                <td><img src="img/trash.png" alt=""></td>

                            </tr>

                            </tbody>

                        </table>

                        <div class="pv-area">

                            <div class="pv-textarea">商品總PV</div>

                            <div class="pv-textarea">XXXX</div>

                            <div class="pv-textarea">PV</div>

                        </div>

                        <div class="price-area">

                            <div class="price-textarea">商品總金額</div>

                            <div class="price-textarea">X,XXX</div>

                            <div class="price-textarea">元</div>

                        </div>

                    </div>

                    <div class="content-article">

                        <div class="form-name">配送方式</div>

                        <div class="form-input">便利商店取貨(須先付款) 60元</div>

                        <div class="price-area">

                            <div class="price-textarea">+運費：</div>

                            <div class="price-textarea">--</div>

                            <div class="price-textarea">元</div>

                        </div>

                        <div class="price-area">

                            <div class="price-textarea">訂單總金額：</div>

                            <div class="price-textarea">--</div>

                            <div class="price-textarea">元</div>

                        </div>

                    </div>

                    <div class="content-article">

                        <div class="form-name">折抵方式</div>

                        <div class="form-input">使用電子錢包折抵</div>

                        <div class="form-tittle">折抵金額：
                            <div class="form-input-2">資料填入</div>
                        </div>

                        <div class="price-area">

                            <div class="price-textarea">應付總金額</div>

                            <div class="price-textarea">X,XXX</div>

                            <div class="price-textarea">元</div>

                        </div>

                    </div>

                    <div class="content-article">

                        <div class="form-name">付款方式</div>

                        <div class="form-input">信用卡付款(一次付清)</div>

                    </div>

                </div>

                <div class="content-article">

                    <div class="form-name">取貨門市</div>

                    <div class="form-input">便利商店名稱(資料填入)</div>

                    <div class="form-tittle">門市名稱：
                        <div class="form-input-2">資料填入</div>
                    </div>

                    <div class="form-tittle">門市地址：
                        <div class="form-input-2">資料填入</div>
                    </div>

                </div>

                <div class="content-article">

                    <div class="form-name">訂購人資料</div>

                    <div class="form-tittle">姓名：
                        <div class="form-input-2">資料填入</div>
                    </div>

                    <div class="form-tittle">電子信箱：
                        <div class="form-input-2">資料填入</div>
                    </div>

                    <div class="form-tittle">聯繫電話：
                        <div class="form-input-2">資料填入</div>
                    </div>

                    <div class="form-tittle">手機：
                        <div class="form-input-2">資料填入</div>
                    </div>

                    <div class="form-tittle">聯繫地址：
                        <div class="form-input-2">資料填入</div>
                    </div>

                </div>

                <div class="content-article">

                    <div class="form-name">收件人資料</div>

                    <div class="form-tittle">姓名：
                        <div class="form-input-2">資料填入</div>
                    </div>

                    <div class="form-tittle">電子信箱：
                        <div class="form-input-2">資料填入</div>
                    </div>

                    <div class="form-tittle">聯繫電話：
                        <div class="form-input-2">資料填入</div>
                    </div>

                    <div class="form-tittle">手機：
                        <div class="form-input-2">資料填入</div>
                    </div>

                    <div class="form-tittle">聯繫地址：
                        <div class="form-input-2">資料填入</div>
                    </div>

                </div>

                <div class="content-article">

                    <div class="form-name">發票資訊</div>

                    <div class="form-tittle">個人發票</div>

                    <div class="form-tittle">統一編號：
                        <div class="form-input-2">資料填入</div>
                    </div>

                    <div class="form-tittle">公司抬頭：
                        <div class="form-input-2">資料填入</div>
                    </div>

                </div>

            </div>

            <div class="btn-area">

                <a href="cart_2.php"><input type="submit" value="返回上一步"></a>

                <a href="cart_4.php"><input type="submit" value="確認，下一步"></a>

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


    //下拉選單判斷
    $('.sidebar-menu').click(function () {
        console.log('L1 clicked');
        var display = $(this).next('.sidebar-sub').css('display');

        $('.sidebar-sub').css('display', 'none');

        if (display == "block") {
            //$(this).next('.sidebar-sub').css('display', 'none');
            $(this).next('.sidebar-sub').slideUp();
        } else if (display == "none") {
            //$(this).next('.sidebar-sub').css('display', 'block');
            $(this).next('.sidebar-sub').slideDown();
        }
    });

    $('.sidebar-level2').click(function () {
        console.log('L2 clicked');
        var display2 = $(this).next('.sidebar-sub3').css('display');
        console.log(display2);
        $('.sidebar-sub3').css('display', 'none');

        if (display2 == "block") {
            //$(this).next('.sidebar-sub3').css('display', 'none');
            $(this).next('.sidebar-sub3').slideUp();
        } else if (display2 == "none") {
            //$(this).next('.sidebar-sub3').css('display', 'block');
            $(this).next('.sidebar-sub3').slideDown();
        }
    });

    //新增側邊欄

</script>

</body>

</html>