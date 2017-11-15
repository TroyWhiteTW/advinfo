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

                        <li><a href="login.php">會員登入</a></li>

                    </ul>

                </div>

                <div class="content-area">

                    <div class="content-article">

                        <form method="post" action="service.php">

                            <div class="form-tittle">請選擇問題類型：<select name="" id="">
                                    <option selected="selected" value="0">請選擇</option>
                                    <option value="1">B</option>
                                    <option value="2">C</option>
                                </select></div>

                            <div class="form-tittle">姓名：
                                <div class="input-area"><input name="" id="" type="text"></div>
                            </div>

                            <div class="form-tittle">電話：
                                <div class="input-area"><input name="" id="" type="text"></div>
                            </div>

                            <div class="form-tittle">電子郵件：
                                <div class="input-area"><input name="" id="" type="text"></div>
                            </div>

                            <div class="form-tittle">問題內容</div>

                            <div class="form-tittle">
                                <div class="input_area"><textarea cols="35" rows="10"></textarea></div>
                            </div>

                            <input type="submit" value="送出">

                        </form>

                    </div>

                    <div class="btn-area">
                        <a href="index.php">返回首頁</a>
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
