<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);

if ($isLogin) {
    header('Location:index.php');
    exit;
}
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
                                        <td><input type="text" name="email" class="input-4"><a
                                                    href="login_forget1.php"><span> 忘記帳號</span></a></td>
                                    </tr>

                                    <tr>
                                        <td class="td-04">會員密碼</td>
                                        <td><input type="password" name="password" class="input-4"><a
                                                    href="login_forget2.php"><span> 忘記密碼</span></a></td>
                                    </tr>

                                    <tr>
                                        <td class="td-04">驗證碼</td>
                                        <td><input onkeyup="ajaxForCheckCaptcha();" id="validate_code" type="text" name="validate_code" class="input-5">
                                            <span id="captcha"><img src="captcha.php" width="100" height="25"/></span>
                                            <a style="cursor: pointer" id="change_captcha">換一張</a>
                                            <script>
                                                document.getElementById('change_captcha').addEventListener('click', function () {
                                                    document.getElementById('captcha').innerHTML = "<img src=\"captcha.php\" width=\"100\" height=\"25\"/>";
                                                    document.getElementById('type1login').disabled = true;
                                                    document.getElementById('type2login').disabled = true;
                                                });
                                            </script>
                                        </td>

                                    </tr>

                                    <tr>
                                        <td colspan="2" style="text-align:center;">
                                            <input id="typeData" name="type" value="0" hidden="hidden">
                                            <input id="type1login" type="submit" class="btn btn-default" value="商城會員登入" disabled="disabled">
                                            <input id="type2login" type="submit" class="btn btn-default" value="珍菌堂會員登入" disabled="disabled">
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

    //ajax檢查驗證碼
    function ajaxForCheckCaptcha() {
        $.ajax({
            url: "./check_captcha_ajax.php",
            type: 'POST',
            data: {
                validate_code:document.getElementById('validate_code').value
            },
            error: function () {
                alert('驗證過程發生錯誤');
            },
            success: function (response) {
                if(response === 's'){
                    document.getElementById('type1login').disabled = false;
                    document.getElementById('type2login').disabled = false;
                } else {
                    document.getElementById('type1login').disabled = true;
                    document.getElementById('type2login').disabled = true;
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

        //檢查帳號格式
        var email_regex = /[a-zA-Z0-9._%-]+@[a-zA-Z0-9._%-]+\.[a-zA-Z]{2,4}/;
        if (!account.match(email_regex)) {
            isDataCorrect = false;
            errorMessage += '帳號格式錯誤，請輸入電子信箱。\n';
        }
        if (account.match(/\s/)) {
            isDataCorrect = false;
            errorMessage += '帳號格式錯誤，請勿包含空白鍵。\n';
        }
        if (account.length === 0) {
            isDataCorrect = false;
            errorMessage += '請輸入帳號。\n';
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
            e.preventDefault();
        }
    });
    //

</script>

</body>

</html>
