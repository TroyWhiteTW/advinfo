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

                    <ul>

                        <li><a href="index.php">首頁</a></li>

                        <li><img src="img/process_icon.png" alt=""></li>

                        <li><a href="login.php">會員登入</a></li>

                    </ul>

                </div>

                <div class="content-area">

                    <div class="content-article">

                        <form method="post" action="service.php">

                            <div class="form-tittle">
                                請選擇問題類型：
                                <select name="cstype" id="">
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
                                <div class="input-area"><input name="name" id="" type="text"></div>
                            </div>

                            <div class="form-tittle">電話：
                                <div class="input-area"><input name="phone" id="" type="text"></div>
                            </div>

                            <div class="form-tittle">電子郵件：
                                <div class="input-area"><input name="email" id="" type="text"></div>
                            </div>

                            <div class="form-tittle">問題內容</div>

                            <div class="form-tittle">
                                <div class="input_area"><textarea name="content" cols="35" rows="10"></textarea></div>
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
</script>

</body>

</html>
