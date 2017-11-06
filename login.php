<?php
include 'db.php';
session_start();
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
                    <li><a href="index.php">
                            <div class="index-icon"></div>
                        </a></li>
                    <li><a href="login.php">
                            <div class="member-icon"></div>
                        </a></li>
                    <li><a href="cart_1.php">
                            <div class="cart-icon"></div>
                        </a></li>
                </ul>
            </div>
        </div>

    </div>

    <div class="topbar">

        <div class="top-content">
            <ul>
                <li><a href="index.php">首頁
                        <div class="index-icon"></div>
                    </a></li>
                <li><a href="login.php">會員登入
                        <div class="member-icon"></div>
                    </a></li>
                <li><a href="cart_1.php">購物車
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

                    <div class="logo">
                        <a href="index.php">
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
                        <li><a href="index.php">首頁</a></li>
                        <li><img src="img/process_icon.png" alt=""></li>
                        <li><a href="login.php">會員登入</a></li>
                    </ul>
                </div>

                <div class="content-area">

                    <div class="content-article">

                        <div class="login-area">

                            <div class="login-tittle">會員登入</div>

                            <form id="login_form" action="memberLogin.php" method="post">

                                <table width="100%" border="0">

                                    <tbody>

                                    <tr>
                                        <td class="td-04">會員帳號</td>
                                        <td><input type="text" name="account" class="input-4"><a href="login_forget1.php"><span> 忘記帳號</span></a></td>
                                    </tr>

                                    <tr>
                                        <td class="td-04">會員密碼</td>
                                        <td><input type="password" name="password" class="input-4"><a href="login_forget2.php"><span> 忘記密碼</span></a></td>
                                    </tr>

                                    <tr>
                                        <td class="td-04">驗證碼</td>
                                        <td><input type="text" name="validate_code" class="input-5"></td>
                                    </tr>

                                    <tr>
                                        <td colspan="2" style="text-align:center;">
                                            <input id="typeData" name="type" value="0" hidden="hidden">
                                            <input id="type1login" type="submit" class="login-btn2" value="商城會員登入">
                                            <input id="type2login" type="submit" class="login-btn2" value="珍菌堂會員登入">
                                            <script>
                                                document.getElementById('type1login').addEventListener('click', function () {
                                                    document.getElementById('typeData').value = "1";
                                                });
                                                document.getElementById('type2login').addEventListener('click', function () {
                                                    document.getElementById('typeData').value = "2";
                                                });
                                            </script>
                                        </td>
                                    </tr>

                                    </tbody>

                                </table>

                            </form>

                            <div class="login-info">
                                <a href="login_register.php"><input type="submit" class="login-btn2" value="加入會員"></a>
                            </div>

                            <div class="login-info">※請輸入您在本網的帳號及密碼以登入系統，您即可清楚查到您在本站所有的消費訂單明細及紀錄。</div>

                        </div>

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

    //登入表單提交檢查
    var form = document.getElementById('login_form');
    form.addEventListener('submit', function (e) {

        var isDataCorrect = true;

        var account = $('input[name="account"]').val().trim();
        var password = $('input[name="password"]').val().trim();
        var validate_code = $('input[name="validate_code"]').val().trim();

        //檢查帳號格式
        var email_regex = /[a-zA-Z0-9._%-]+@[a-zA-Z0-9._%-]+\.[a-zA-Z]{2,4}/;
        if (!account.match(email_regex)) {
            isDataCorrect = false;
            alert('帳號格式錯誤，請輸入電子信箱。');
        }
        if (account.match(/\s/)) {
            isDataCorrect = false;
            alert('帳號格式錯誤，請勿包含空白鍵。');
        }
        if (account.length === 0) {
            isDataCorrect = false;
            alert('請輸入帳號。');
        }
        //檢查密碼格式
        if (password.length < 8 || password.length > 20) {
            isDataCorrect = false;
            alert('密碼格式錯誤，字數必須在8-20之間');
        }
        if (!password.match(/[0-9]/) || !password.match(/[a-zA-Z]/)) {
            isDataCorrect = false;
            alert('密碼格式錯誤，必須至少擁有一個數字及英文');
        }
        if (password.match(/\s/)) {
            isDataCorrect = false;
            alert('密碼格式錯誤，請勿包含空白鍵。');
        }
        if (password.length === 0) {
            isDataCorrect = false;
            alert('請輸入密碼。');
        }
        if (isDataCorrect === false) {
            e.preventDefault();
        }
    })
    ;
    //登入表單提交檢查

</script>

</body>

</html>
