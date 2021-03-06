<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);

if ($isLogin) {
    header('Location:index.php');
    exit;
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
                        <li><a href="login.php">會員登入</a></li>
                    </ul>
                </div>

                <div class="content-area">

                    <div class="content-article">

                        <div class="login-area">

                            <div class="login-tittle">會員登入</div>

                            <form id="login_form" method="post">

                                <table width="100%" border="0">

                                    <tbody>

                                    <tr>
                                        <td class="td-04">會員帳號</td>
                                        <td>
                                            <input id="email" type="text" name="email" class="input-4">
                                            <a href="login_forget1.php">
                                                <div style="display: inline-block;"> 忘記帳號</div>
                                            </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="td-04">會員密碼</td>
                                        <td>
                                            <input id="password" type="password" name="password" class="input-4">
                                            <a href="login_forget2.php">
                                                <div style="display: inline-block;"> 忘記密碼</div>
                                            </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="td-04">驗證碼</td>
                                        <td>
                                            <input onkeyup="ajaxForCheckCaptcha();" id="validate_code" type="text"
                                                   name="validate_code" class="input-5">
                                            <span id="captcha"><img src="captcha.php" width="100" height="25"/></span>
                                            <br/>
                                            <span id="captchaIcon" class="glyphicon glyphicon-remove"></span>
                                            <a style="cursor: pointer" id="change_captcha">換一張</a>
                                            <script>
                                                document.getElementById('change_captcha').addEventListener('click', function () {
                                                    document.getElementById('captcha').innerHTML = "<img src=\"captcha.php\" width=\"100\" height=\"25\"/>";
                                                });
                                            </script>
                                        </td>

                                    </tr>

                                    <tr>
                                        <td colspan="2" style="text-align:center;">
                                            <input id="typeData" name="type" value="0" hidden="hidden">
                                            <input id="type1login" type="submit" class="btn btn-default" value="商城會員登入">
                                            <input id="type2login" type="submit" class="btn btn-default"
                                                   value="珍菌堂會員登入">
                                            <script>

                                                function ajaxLogin() {
                                                    $.ajax({
                                                        url: "./memberLogin.php",
                                                        type: 'POST',
                                                        data: {
                                                            email: document.getElementById('email').value,
                                                            password: document.getElementById('password').value,
                                                            validate_code: document.getElementById('validate_code').value,
                                                            type: document.getElementById('typeData').value
                                                        },
                                                        error: function () {
                                                            alert('發生錯誤');
                                                        },
                                                        success: function (response) {
                                                            console.log(response);
                                                            switch (response) {
                                                                case '0':
                                                                    alert('帳號或密碼錯誤');
                                                                    break;
                                                                case '1':
                                                                    // alert('登入成功');
                                                                    window.location = './index.php';
                                                                    break;
                                                                case '2':
                                                                    alert('驗證碼錯誤');
                                                                    break;
                                                                default:
                                                                    alert(response);
                                                                    break;
                                                            }
                                                        }
                                                    });
                                                }

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

    //ajax檢查驗證碼
    function ajaxForCheckCaptcha() {
        $.ajax({
            url: "./check_captcha_ajax.php",
            type: 'POST',
            data: {
                validate_code: document.getElementById('validate_code').value
            },
            error: function () {
                alert('驗證過程發生錯誤');
            },
            success: function (response) {
                if (response === 's') {
                    if (document.getElementById('captchaIcon').classList.contains('glyphicon-remove')) {
                        document.getElementById('captchaIcon').classList.remove('glyphicon-remove');
                        document.getElementById('captchaIcon').classList.add('glyphicon-ok');
                    }
                } else {
                    if (document.getElementById('captchaIcon').classList.contains('glyphicon-ok')) {
                        document.getElementById('captchaIcon').classList.remove('glyphicon-ok');
                        document.getElementById('captchaIcon').classList.add('glyphicon-remove');
                    }
                }
            }
        });
    }

    //登入表單提交檢查
    var form = document.getElementById('login_form');

    form.addEventListener('submit', function (e) {
        var isDataCorrect = true;
        var errorMessage = "";

        var account = $('input[name="email"]').val().trim();
        var password = $('input[name="password"]').val().trim();
        var validate_code = $('input[name="validate_code"]').val().trim();
        var type = $('input[name="type"]').val().trim();

        //檢查帳號格式
        if (account.match(/\s/)) {
            isDataCorrect = false;
            errorMessage += '帳號格式錯誤，請勿包含空白鍵。\n';
        }
        if (account.length === 0) {
            isDataCorrect = false;
            errorMessage += '請輸入帳號。\n';
        }

        if (type === "1") {
            var email_regex = /[a-zA-Z0-9._%-]+@[a-zA-Z0-9._%-]+\.[a-zA-Z]{2,4}/;
            if (!account.match(email_regex)) {
                isDataCorrect = false;
                errorMessage += '帳號格式錯誤，請輸入電子信箱。\n';
            }
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
            if (password.length === 0) {
                isDataCorrect = false;
                errorMessage += '請輸入密碼。\n';
            }
        }
        //檢查驗證碼格式
        if (validate_code.length === 0) {
            isDataCorrect = false;
            errorMessage += '請輸入驗證碼。\n';
        }
        if (validate_code.match(/\s/)) {
            isDataCorrect = false;
            errorMessage += '驗證碼格式錯誤，請勿包含空白鍵。\n';
        }
        //
        if (isDataCorrect === false) {
            alert(errorMessage);
        } else {
            ajaxLogin();
        }
        e.preventDefault();
    });
    //

</script>

</body>

</html>
