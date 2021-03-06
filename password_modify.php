<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);

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

                        <li><a href="">修改密碼</a></li>

                    </ul>

                </div>

                <?php if ($isLogin): ?>

                    <div class="content-area">

                        <div class="content-article">

                            <div class="login-area">

                                <div class="login-tittle">修改密碼</div>

                                <form id="password_modify_form" action="password_reset.php" method="post">

                                    <div class="login-input">
                                        請輸入新密碼<input type="password" name="password" class="input-4">
                                    </div>

                                    <div class="login-input">
                                        請確認新密碼<input type="password" name="password_c" class="input-4">
                                    </div>

                                    <div class="login-info">
                                        <input type="submit" class="login-btn" value="確認送出">
                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                <?php else: ?>

                    <h3>請先登入</h3>

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
    $('#left-open').click(function() {
        // 顯示隱藏側邊欄
        $('.sidebar').toggleClass('sidebar-view');
        // body畫面變暗+鎖住網頁滾輪
        $('body').toggleClass('body-back');
    });

    $(window).resize(function() {
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

    //註冊表單提交檢查
    var form = document.getElementById('password_modify_form');
    form.addEventListener('submit', function (e) {

        var isDataCorrect = true;

        var errorMessage = "";

        var password = $('input[name="password"]').val().trim();
        var password_c = $('input[name="password_c"]').val().trim();

        //檢查密碼格式
        if (password.length < 8 || password.length > 20) {
            isDataCorrect = false;
            errorMessage += '密碼格式錯誤，字數必須在8-20之間。\n';
        }
        if (!password.match(/[0-9]/) || !password.match(/[a-zA-Z]/)) {
            isDataCorrect = false;
            errorMessage += '密碼格式錯誤，必須至少擁有一個數字及英文。\n';
        }
        if (password.match(/\s/)) {
            isDataCorrect = false;
            errorMessage += '密碼格式錯誤，請勿包含空白鍵。\n';
        }
        if (password !== password_c) {
            isDataCorrect = false;
            errorMessage += '密碼確認必須與密碼相同。\n';
        }
        if (password.length === 0) {
            isDataCorrect = false;
            errorMessage += '請輸入密碼。\n';
        }
        if (isDataCorrect === false) {
            alert(errorMessage);
            e.preventDefault();
        }
    })
    ;
    //註冊表單提交檢查

</script>

</body>

</html>