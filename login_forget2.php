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

                        <li><a href="">忘記密碼</a></li>

                    </ul>

                </div>

                <div class="content-area">

                    <div class="content-article">

                        <div class="login-area">

                            <div class="login-tittle">忘記密碼</div>

                            <div class="login-info">按三個簡單的步驟找回並更改密碼</div>

                            <div class="form-content">
                                <table width="100%" border="0">
                                    <tbody>
                                    <tr>
                                        <td class="td-06">
                                            <ul>
                                                <li>1.在下面填寫您的電子信箱</li>
                                                <li>2.我們將會以電子郵件寄送給您一個連結</li>
                                                <li>3.使用連結，在我們的網站修改密碼</li>
                                            </ul>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>

                            <form id="forget2_form" action="reset_password_email.php" method="post">

                                <div class="login-input">請輸入電子信箱<input type="text" name="email" class="input-4"></div>

                                <div class="login-info"><input type="submit" class="login-btn" value="確認送出"></div>

                            </form>

                        </div>

                    </div>

                    <div class="btn-area">
                        <a href="login.php"><input type="submit" value="返回上一頁"></a>
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

    //表單提交檢查
    var form = document.getElementById('forget2_form');

    form.addEventListener('submit', function (e) {
        var isDataCorrect = true;
        var errorMessage = "";

        var email = $('input[name="email"]').val().trim();

        //檢查帳號格式
        var email_regex = /[a-zA-Z0-9._%-]+@[a-zA-Z0-9._%-]+\.[a-zA-Z]{2,4}/;
        if (!email.match(email_regex)) {
            isDataCorrect = false;
            errorMessage += '格式錯誤，請輸入電子信箱。\n';
        }
        if (email.match(/\s/)) {
            isDataCorrect = false;
            errorMessage += '格式錯誤，請勿包含空白鍵。\n';
        }
        if (email.length === 0) {
            isDataCorrect = false;
            errorMessage += '請輸入電子信箱。\n';
        }

        if (isDataCorrect === false) {
            alert(errorMessage);
            e.preventDefault();
        }
    });
    //

</script>

</body>

</html>