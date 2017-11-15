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
// TODO: 待補側邊攔，目前是 hard code
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

                        <li><a href="">忘記帳號</a></li>

                    </ul>

                </div>

                <div class="content-area">

                    <div class="content-article">

                        <div class="login-area">

                            <div class="login-tittle">忘記帳號</div>

                            <div class="login-info">請輸入您註冊時登記的手機號碼，系統將會自動發送您的註冊帳號到您的手機中</div>

                            <div class="login-input">請輸入手機號碼<input type="text" name="" id="" class="input-4"></div>

                            <div class="login-info"><input type="submit" class="login-btn" value="確認送出"></div>

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
</script>

</body>

</html>
