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
                        <li><a href="function_member.php">會員專區</a></li>
                    </ul>
                </div>

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

                    <div class="content-article">

                        <div class="form-tittle">帳號：
                            <div class="form-input-2"><?php echo $_SESSION['user'][7]; ?></div>
                            <a href="password_modify.php"><input type="submit" value="修改密碼"></a>
                        </div>

                        <div class="form-tittle">聘級：
                            <div class="form-input-2"><?php echo $_SESSION['user'][4]; ?></div>
                        </div>

                        <div class="form-tittle">推薦ID：
                            <div class="form-input-2"><?php echo $_SESSION['user'][5]; ?></div>
                            <input type="submit" value="推薦表">
                        </div>

                        <div class="form-tittle">推薦連結：
                            <div class="form-input-2">資料填入</div>
                            <input type="submit" value="複製">
                        </div>

                        <div class="form-tittle">姓名：<input name="" id="" type="text" class="input-2"></div>

                        <div class="form-tittle">生日：
                            <select name="" id="">
                                <option selected="selected" value="0">請選擇年</option>
                                <option value="1">2000</option>
                                <option value="2">1999</option>
                                <option value="3">1998</option>
                                <option value="4">1997</option>
                                <option value="5">1996</option>
                                <option value="6">1995</option>
                                <option value="7">1994</option>
                                <option value="8">1993</option>
                                <option value="9">1992</option>
                                <option value="10">1991</option>
                                <option value="11">1990</option>
                                <option value="12">1989</option>
                                <option value="13">1988</option>
                                <option value="14">1987</option>
                                <option value="15">1986</option>
                                <option value="16">1985</option>
                                <option value="17">1984</option>
                                <option value="18">1983</option>
                                <option value="19">1982</option>
                                <option value="20">1981</option>
                                <option value="21">1980</option>
                            </select>
                            <select name="" id="">
                                <option selected="selected" value="0">請選擇月</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                            <select name="" id="">
                                <option selected="selected" value="0">請選擇日</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                            </select>
                        </div>

                        <div class="form-tittle">性別：：<input type="radio" value="male" name="sex">男<input type="radio"
                                                                                                         value="femal"
                                                                                                         name="sex">女
                        </div>

                        <div class="form-tittle">電子信箱：<input name="" id="" type="text" class="input-2"></div>

                        <div class="form-tittle">聯繫電話：<input name="" id="" type="text" class="input-2"></div>

                        <div class="form-tittle"><span style="color:red;">*</span>手機：
                            <input name="" id="" type="text" class="input-2">
                            <input type="submit" value="驗證手機">
                        </div>

                        <div class="form-tittle"><span style="color:red;">*</span>聯繫地址：<input type="checkbox"
                                                                                              checked="checked">台澎金馬<span
                                    style="color:red; font-size:12px;">(預設勾選)</span>
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
                            <div class="form-tittle">統一編號：<input name="" id="" type="text" class="input-2"></div>
                            <div class="form-tittle">公司抬頭：<input name="" id="" type="text" class="input-2"></div>
                        </div>

                    </div>

                    <div class="content-article">
                        <div class="function-area">
                            <ul>
                                <li><a href=""><input type="button" id="" name="" class="" value="全家取貨門市"></a></li>
                                <li><a href=""><input type="button" id="" name="" class="" value="OK取貨門市"></a></li>
                                <li><a href=""><input type="button" id="" name="" class="" value="萊爾富取貨門市"></a></li>
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
                        <a href=""><input type="submit" value="確認提交"></a>
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
