<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);

$cstypes = [];
$cstypesSql = 'SELECT no,name FROM cstypes ORDER BY no ASC';
$cstypesRes = mysqli_query($conn, $cstypesSql);
while ($cstypesRow = mysqli_fetch_assoc($cstypesRes)) {
    $cstypes[] = $cstypesRow;
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

                    <ol class="breadcrumb">

                        <li><a href="index.php">首頁</a></li>
                        <li class="active">客服中心</li>

                    </ol>

                </div>

                <div class="content-area">

                    <div class="content-article">

                        <form id="service_form" method="post" action="service.php">

                            <div class="form-tittle">
                                請選擇問題類型：
                                <select name="cstype" id="cstype">
                                    <?php
                                    foreach ($cstypes as $cstype) {
                                        if ($cstype['no'] == 0) {
                                            echo '<option selected="selected" value="' . $cstype['no'] . '">' . $cstype['name'] . '</option>';
                                        } else {
                                            echo '<option value="' . $cstype['no'] . '">' . $cstype['name'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select></div>

                            <div class="form-tittle">姓名：
                                <div class="input-area"><input name="name" id="name" type="text"></div>
                            </div>

                            <div class="form-tittle">電話：
                                <div class="input-area"><input name="phone" id="phone" type="text"></div>
                            </div>

                            <div class="form-tittle">電子郵件：
                                <div class="input-area"><input name="email" id="email" type="text"></div>
                            </div>

                            <div class="form-tittle">問題內容</div>

                            <div class="form-tittle">
                                <div class="input_area">
                                    <textarea name="content" id="content" cols="35" rows="10"></textarea>
                                </div>
                            </div>

                            <input type="submit" value="送出" class="btn btn-success">

                        </form>

                    </div>

                    <div class="btn-area">
                        <a href="index.php" class="btn btn-default">返回首頁</a>
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

    //表單提交檢查
    var form = document.getElementById('service_form');

    form.addEventListener('submit', function (e) {
        var isDataCorrect = true;
        var errorMessage = "";

        var name = $('input[name="name"]').val().trim();
        var phone = $('input[name="phone"]').val().trim();
        var email = $('input[name="email"]').val().trim();
        var content = $('textarea[name="content"]').val().trim();

        if (name.length === 0) {
            isDataCorrect = false;
            errorMessage += '請輸入姓名。\n';
        }

        if (phone.length === 0) {
            isDataCorrect = false;
            errorMessage += '請輸入電話。\n';
        }

        var email_regex = /[a-zA-Z0-9._%-]+@[a-zA-Z0-9._%-]+\.[a-zA-Z]{2,4}/;
        if (!email.match(email_regex)) {
            isDataCorrect = false;
            errorMessage += '電子信箱格式錯誤，請輸入電子信箱。\n';
        }
        if (email.match(/\s/)) {
            isDataCorrect = false;
            errorMessage += '電子信箱格式錯誤，請勿包含空白鍵。\n';
        }
        if (email.length === 0) {
            isDataCorrect = false;
            errorMessage += '請輸入電子信箱。\n';
        }

        if (content.length === 0) {
            isDataCorrect = false;
            errorMessage += '請輸入問題內容。\n';
        }

        if (isDataCorrect === false) {
            alert(errorMessage);
            e.preventDefault();
        }
    });
    //表單提交檢查
</script>

</body>

</html>
