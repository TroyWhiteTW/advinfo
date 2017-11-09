<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);
?>
<?php
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
                        <li><a href="">會員專區</a></li>
                    </ul>
                </div>

                <?php if ($isLogin): ?>

                    <div class="content-area">

                        <div class="function-area">
                            <ul>
                                <li><a href="function_member.php"><input type="button" id="" name=""
                                                                         class="tag-value-select" value="個人資料"></a></li>
                                <li><a href="function_orderquery.php"><input type="button" id="" name="" class=""
                                                                             value="訂單查詢"></a></li>
                                <li><a href="function_bonusquery.php"><input type="button" id="" name="" class=""
                                                                             value="重銷獎金查詢/規則"></a></li>
                            </ul>
                        </div>

                        <form method="post" action="memberUpdate.php">

                            <div class="content-article">

                                <div class="form-tittle">
                                    帳號：
                                    <div class="form-input-2"><?php echo $_SESSION['user'][7]; ?></div>
                                    <a class="btn btn-default btn-xs" href="password_modify.php">修改密碼</a>
                                </div>

                                <div class="form-tittle">
                                    聘級：
                                    <div class="form-input-2"><?php echo $_SESSION['user'][4]; ?></div>
                                </div>

                                <div class="form-tittle">
                                    推薦ID：
                                    <div class="form-input-2"><?php echo $_SESSION['user'][5]; ?></div>
                                    <a class="btn btn-default btn-xs" href="">推薦表</a>
                                </div>

                                <div class="form-tittle">
                                    推薦連結：
                                    <div class="form-input-2">資料填入</div>
                                    <a class="btn btn-default btn-xs" href="">複製</a>
                                </div>

                                <div class="form-tittle">
                                    姓名：
                                    <div class="form-input-2"><?php echo $_SESSION['user'][2]; ?></div>
                                </div>

                                <div class="form-tittle">
                                    生日：
                                    <div class="form-input-2"><?php echo $_SESSION['user'][6]; ?></div>
                                </div>

                                <div class="form-tittle">
                                    性別：
                                    <div class="form-input-2"><?php
                                        switch ($_SESSION['user'][3]) {
                                            case 'M':
                                                echo '男';
                                                break;
                                            case 'F':
                                                echo '女';
                                                break;
                                        }
                                        ?></div>
                                </div>

                                <div class="form-tittle">
                                    電子信箱：<input name="" id="" type="text" class="input-2">
                                </div>

                                <div class="form-tittle">
                                    聯繫電話：<input name="" id="" type="text" class="input-2">
                                </div>

                                <div class="form-tittle">
                                    <span style="color:red;">*</span>
                                    手機：<input name="" id="" type="text" class="input-2">
                                    <a class="btn btn-default btn-xs" href="">驗證手機</a>
                                </div>

                                <div class="form-tittle">

                                    <span style="color:red;">*</span>
                                    聯繫地址：
                                    <input type="checkbox" checked="checked">台澎金馬
                                    <span style="color:red; font-size:12px;">(預設勾選)</span>
                                    <div class="form-tittle">
                                        <select name="" id="">
                                            <option selected="selected" value="0">請選擇縣市</option>
                                            <option value="1">B</option>
                                            <option value="2">C</option>
                                        </select>
                                        <select name="" id="">
                                            <option selected="selected" value="0">請選擇區別</option>
                                            <option value="1">B</option>
                                            <option value="2">C</option>
                                        </select>
                                    </div>

                                    <div class="form-tittle"><input name="" id="" type="text" class="input-3"></div>

                                </div>

                                <div class="form-tittle">
                                    統一編號：<input name="" id="" type="text" class="input-2">
                                </div>

                                <div class="form-tittle">
                                    公司抬頭：<input name="" id="" type="text" class="input-2">
                                </div>

                            </div>

                            <div class="content-article">
                                <div class="function-area">
                                    <ul>
                                        <li><a href=""><input type="button" id="" name="" class="" value="全家取貨門市"></a>
                                        </li>
                                        <li><a href=""><input type="button" id="" name="" class="" value="OK取貨門市"></a>
                                        </li>
                                        <li><a href=""><input type="button" id="" name="" class="" value="萊爾富取貨門市"></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="form-tittle">門市名稱：
                                    <div class="form-input-2">資料填入</div>
                                </div>
                                <div class="form-tittle">門市地址：
                                    <div class="form-input-2">資料填入</div>
                                </div>
                            </div>

                            <div class="btn-area">
                                <input type="submit" value="確認提交">
                            </div>

                        </form>

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

</script>

</body>

</html>
