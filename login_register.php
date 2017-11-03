<?php
include 'db.php';
session_start();
?>
<?php
// 產品分類
$sql = "select * from proclass where parent = 0 order by no";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $proclass[] = array(
            'no' => "{$row['no']}",
            'pcname' => "{$row['pcname']}"
        );
    }
} else {
    // 錯誤 查詢結果
    echo 'E1';
    return;
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>珍菌王商城</title>

    <link href="css/reset.css" rel="stylesheet" type="text/css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">


    <link href="css/layout.css" rel="stylesheet" type="text/css">


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <!-- owl.carousel -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <script src="scripts/owl.carousel.min.js"></script>

    <style>

        .owl-carousel .owl-dot {
            background-color: #CBCBCB;
            border-radius: 50%;
            display: inline-block;
            height: 15px;
            margin: 0 5px;
            width: 15px;
            opacity: .7;
        }

        .owl-dots > .active {
            background-color: white;
        }

        .owl-carousel .active {
            opacity: 1;
        }

        .owl-carousel {
            position: relative;
        }

        .owl-carousel .owl-dots {
            display: block;
            text-align: center;
            width: 100%;
            position: absolute;
            bottom: 14px;
        }


    </style>

</head>

<body>
<div class="wrap">

    <!-- 新增側邊欄 -->
    <div class="sidebar visible-sm visible-xs ">
        <ul class="fullheight" style="overflow:auto;">
            <?php
            // 左側分類
            foreach ($proclass as $class) {
                echo '<li>';
                echo '<a class="sidebar-menu">';

                echo $class['pcname'];
                echo '<i class="fa fa-angle-right angle-right" aria-hidden="true"></i>';

                echo '</a>';
                echo '<li>';
            }
            ?>

        </ul>
    </div>
    <!-- 新增側邊欄 -->

    <div class="topbar-mobile">
        <div class="mobile-content">
            <input type="image" src="img/open_btn.png" name="lo" class="left-open">
            <div class="icon-area">
                <ul>
                    <li><a href="index.html">
                            <div class="index-icon"></div>
                        </a></li>
                    <li><a href="login.html">
                            <div class="member-icon"></div>
                        </a></li>
                    <li><a href="cart_1.html">
                            <div class="cart-icon"></div>
                        </a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="topbar">
        <div class="top-content">
            <ul>
                <li><a href="index.html">首頁
                        <div class="index-icon"></div>
                    </a></li>
                <li><a href="login.html">會員登入
                        <div class="member-icon"></div>
                    </a></li>
                <li><a href="cart_1.html">購物車
                        <div class="cart-icon"></div>
                    </a></li>
            </ul>
            <div class="search">
                <div class="search-input">
                    <input type="text" name="input-1" id="input-1" class="input-1" placeholder="搜尋商品">
                </div>
                <div class="search-btn"></div>
            </div>
        </div>
    </div>


    <div class="container main">

        <div class="row content no-margin-rl">

            <div class="col-xs-2 left-area hidden-xs " style="">
                <div class="left-move ">

                    <div class="logo ">
                        <a href="index.html">
                            <img src="img/logo.jpg" style="" alt="">
                        </a>
                    </div>

                    <div class="menu-area">

                        <ul class="fullheight" style="overflow:auto;">


                            <li>
                                <a class="sidebar-menu">
                                    套裝組合
                                    <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>
                                </a>
                                <ul class="sidebar-sub">
                                    <li>
                                        <a class="sidebar-level2" href="#">
                                            次類別一
                                            <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>
                                        </a>
                                        <ul class="sidebar-sub3 ">
                                            <li>
                                                <a href="#">
                                                    第三層類別一
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    第三層類別二
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li>
                                        <a class="sidebar-level2" href="#">
                                            次類別二
                                            <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>
                                        </a>
                                        <ul class="sidebar-sub3 ">
                                            <li>
                                                <a href="#">
                                                    第三層類別一
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    第三層類別二
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a class="sidebar-menu">
                                    膠囊類
                                    <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>
                                </a>
                                <ul class="sidebar-sub">
                                    <li>
                                        <a class="sidebar-level2" href="#">
                                            次類別一
                                            <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>
                                        </a>
                                        <ul class="sidebar-sub3 ">
                                            <li>
                                                <a href="#">
                                                    第三層類別一
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    第三層類別二
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                </ul>
                            </li>


                            <li>
                                <a class="sidebar-menu">
                                    萃取液
                                    <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>
                                </a>
                                <ul class="sidebar-sub">
                                    <li>
                                        <a class="sidebar-level2" href="#">
                                            次類別一
                                            <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>
                                        </a>
                                        <ul class="sidebar-sub3 ">
                                            <li>
                                                <a href="#">
                                                    第三層類別一
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    第三層類別二
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                </ul>
                            </li>

                            <li>
                                <a class="sidebar-menu">
                                    健康器材
                                    <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>
                                </a>
                                <ul class="sidebar-sub">
                                    <li>
                                        <a class="sidebar-level2" href="#">
                                            次類別一
                                            <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>
                                        </a>
                                        <ul class="sidebar-sub3 ">
                                            <li>
                                                <a href="#">
                                                    第三層類別一
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    第三層類別二
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                </ul>
                            </li>

                            <li>
                                <a class="sidebar-menu">
                                    養身食品
                                    <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>
                                </a>
                                <ul class="sidebar-sub">
                                    <li>
                                        <a class="sidebar-level2" href="#">
                                            次類別一
                                            <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>
                                        </a>
                                        <ul class="sidebar-sub3 ">
                                            <li>
                                                <a href="#">
                                                    第三層類別一
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    第三層類別二
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                </ul>
                            </li>

                            <li>
                                <a class="sidebar-menu">
                                    滴丸
                                    <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>
                                </a>
                                <ul class="sidebar-sub">
                                    <li>
                                        <a class="sidebar-level2" href="#">
                                            次類別一
                                            <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>
                                        </a>
                                        <ul class="sidebar-sub3 ">
                                            <li>
                                                <a href="#">
                                                    第三層類別一
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    第三層類別二
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                </ul>
                            </li>


                        </ul>
                    </div>

                </div>
            </div>

            <div class="col-sm-10">
                <div class="beard">
                    <ul>
                        <li><a href="index.html">首頁</a></li>
                        <li><img src="img/process_icon.png" alt=""></li>
                        <li><a href="">加入會員</a></li>
                    </ul>
                </div>
                <div class="content-area">
                    <div class="content-article">
                        <div class="login-area">
                            <div class="login-tittle">加入會員</div>
                            <form action="register.php" method="post">
                                <table width="100%" border="0">
                                    <tbody>
                                    <tr>
                                        <td class="td-04">帳號</td>
                                        <td><input type="text" name="account" class="input-4"></td>
                                    </tr>

                                    <tr>
                                        <td class="td-04"></td>
                                        <td class="td-05">請輸入電子郵件為往後登入帳號</td>
                                    </tr>

                                    <tr>
                                        <td class="td-04">密碼</td>
                                        <td><input type="password" name="password" class="input-4"></td>
                                    </tr>

                                    <tr>
                                        <td class="td-04"></td>
                                        <td class="td-05">
                                            8-20字元，至少1個英文與1個數字<br>
                                            不含空白、雙引號、單引號、星號<br>
                                            注意密碼不與其他網站相同，確保帳戶安全<br>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="td-04">確認密碼</td>
                                        <td><input type="password" name="password_c" class="input-4"></td>
                                    </tr>

                                    <tr>
                                        <td class="td-04">姓名</td>
                                        <td><input type="text" name="name" class="input-4"></td>
                                    </tr>

                                    <tr>
                                        <td class="td-04">性別</td>
                                        <td>
                                            <select name="gender" class="input-4">
                                                <option value="M">男</option>
                                                <option value="F">女</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="td-04">電子信箱</td>
                                        <td><input type="text" name="email" class="input-4"></td>
                                    </tr>

                                    <tr>
                                        <td class="td-04">聯繫電話</td>
                                        <td><input type="text" name="phone" class="input-4"></td>
                                    </tr>

                                    <tr>
                                        <td class="td-04">手機</td>
                                        <td><input type="text" name="mobile" class="input-4"></td>
                                    </tr>

                                    <tr>
                                        <td class="td-04">聯繫地址</td>
                                        <td><input type="text" name="address" class="input-4"></td>
                                    </tr>

                                    <tr>
                                        <td class="td-04">會員類別</td>
                                        <td>
                                            <select name="type" class="input-4">
                                                <option value="1">一般會員</option>
                                                <option value="2">直銷會員</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="td-04">推薦人帳號</td>
                                        <td><input type="text" name="referral" class="input-4"></td>
                                    </tr>

                                    <tr>
                                        <td class="td-04">輸入驗證碼</td>
                                        <td><input type="text" name="verifycode" class="input-5"></td>
                                    </tr>
                                    </tbody>
                                </table>

                                <div class="login-info">
                                    <input type="submit" class="login-btn" value="確認送出">
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <footer>
            <div class="foot-area">
                <div class="foot-menu">
                    <div class="ft-logo"><a href="index.html"><br><br><br><img src="img/logo_foot.png" alt=""></a></div>
                    <div class="ft-menu-list">
                        <ul>
                            <li><a href="ftmenu_about.html">關於我們</a></li>
                            <li>│</li>
                            <li><a href="ftmenu_privacy.html">隱私權條款</a></li>
                            <li>│</li>
                            <li><a href="ftmenu_policy.html">服務政策</a></li>
                            <li>│</li>
                            <li><a href="ftmenu_refund.html">退貨需知</a></li>
                            <li>│</li>
                            <li><a href="ftmenu_goods.html">商品寄送</a></li>
                            <li>│</li>
                            <li><a href="ftmenu_supplier.html">供應商資訊</a></li>
                            <li>│</li>
                            <li><a href="ftmenu_process.html">購物流程說明</a></li>
                            <li>│</li>
                            <li><a href="ftmenu_warranty.html">鑑賞期說明</a></li>
                            <li>│</li>
                            <li><a href="ftmenu_service.html">客服中心</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="copyright"><br><br>客服時間：AM 10:00 - PM 18:00(網路部門星期六、日公休)
                快速客服專線：02-22XX-XXXX轉XX<br><br><br><br><br><br></div>
        </footer>

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

