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

                        <li><a href="">註冊成功</a></li>

                    </ul>

                </div>

                <div class="content-area">

                    <div class="content-article">

                        <div class="login-tittle">註冊成功</div>

                        <div class="form-content">
                            <br>您的會員已成功啟動，隨時可以開始購物囉!<br>
                        </div>

                        <div class="login-info">建議您驗證手機號碼，後續忘記帳號時可使用手機驗證查詢!</div>

                    </div>

                    <div class="content-article">

                        <div class="login-area">

                            <table width="100%" border="0">

                                <tbody>

                                <tr>

                                    <td class="td-04">請輸入手機號碼</td>

                                    <td>
                                        <input type="text" name="" id="mobile" class="input-4">
                                        <input id="sms" type="button" value="發送驗證簡訊">
                                    </td>

                                </tr>
                                <form method="post" action="verifyAccount.php">
                                    <tr>

                                        <td class="td-04">請輸入驗證碼</td>

                                        <td><input type="text" name="verifycode" id="verifycode" class="input-4"></td>

                                    </tr>

                                </tbody>

                            </table>

                            <div class="login-info">
                                <input id="submitBtn" type="submit" value="確認" class="login-btn">
                            </div>
                            </form>
                        </div>

                    </div>

                </div>

            </div>

            <div class="btn-area">
                <a href="index.php"><input type="submit" value="返回首頁" class="login-btn"></a>
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

    $('#sms').click(function () {
        var isDataCorrect = true;
        var errorMessage = "";

        var mobile = $('#mobile').val().trim();

        //檢查手機
        if (mobile.match(/\s/)) {
            isDataCorrect = false;
            errorMessage += '手機格式錯誤，請勿包含空白鍵。\n';
        }
        if (mobile.match(/[^\d]/)) {
            isDataCorrect = false;
            errorMessage += '手機格式錯誤，請輸入數字。\n';
        }
        if (mobile.length !== 10) {
            isDataCorrect = false;
            errorMessage += '請輸入正確手機號碼。\n';
        }

        if (isDataCorrect === false) {
            alert(errorMessage);
            e.preventDefault();
        }else {

            $.ajax({
                url: "./smstest.php",
                type: 'POST',
                data: {
                    mobile: $('#mobile')[0].value
                },
                error: function () {
                    alert('發生錯誤');
                },
                success: function (response) {
                    var pos = response.indexOf("statuscode=");
                    var s = response.slice(pos + 11, pos + 12);
                    switch (s) {
                        case "0":
                        case "1":
                        case "2":
                        case "3":
                        case "4":
                            alert("驗證碼已寄出，請自手機查看。");
                            break;
                        default:
                            alert('簡訊發送失敗請稍後再試。');
                            break;
                    }
                }
            });

        }

    });

    $('#submitBtn').click(function (e) {
        var isDataCorrect = true;
        var errorMessage = "";

        var verifycode = $('#verifycode').val().trim();

        if (verifycode.match(/\s/)) {
            isDataCorrect = false;
            errorMessage += '驗證碼格式錯誤，請勿包含空白鍵。\n';
        }
        if (verifycode.match(/[^\d]/)) {
            isDataCorrect = false;
            errorMessage += '驗證碼格式錯誤，請輸入數字。\n';
        }
        if (verifycode.length !== 10) {
            isDataCorrect = false;
            errorMessage += '請輸入正確長度的驗證碼。\n';
        }

        if (isDataCorrect === false) {
            alert(errorMessage);
            e.preventDefault();
        }

    });

</script>

</body>

</html>
