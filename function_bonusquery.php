<?php
include 'db.php';
session_start();
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

            <div class="col-sm-2 left-area hidden-xs ">

                <div class="left-move ">

                    <div class="logo">

                        <a href="index.php">

                            <img src="img/logo.jpg" style="" alt="">

                        </a>

                    </div>

                    <div class="menu-area">

                        <ul class="fullheight" style="overflow:auto;">

                            <li>
                                <a class="sidebar-menu">
                                    套裝組合
                                    <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>
                                </a>
                                <ul class="sidebar-sub">
                                    <li>
                                        <a class="sidebar-level2" href="#">
                                            次類別一
                                            <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>
                                        </a>
                                        <ul class="sidebar-sub3 ">
                                            <li>
                                                <a href="#">
                                                    第三層類別一
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    第三層類別二
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li>
                                        <a class="sidebar-level2" href="#">
                                            次類別二
                                            <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>
                                        </a>
                                        <ul class="sidebar-sub3 ">
                                            <li>
                                                <a href="#">
                                                    第三層類別一
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    第三層類別二
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a class="sidebar-menu">
                                    膠囊類
                                    <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>
                                </a>
                                <ul class="sidebar-sub">
                                    <li>
                                        <a class="sidebar-level2" href="#">
                                            次類別一
                                            <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>
                                        </a>
                                        <ul class="sidebar-sub3 ">
                                            <li>
                                                <a href="#">
                                                    第三層類別一
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    第三層類別二
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                </ul>
                            </li>

                            <li>
                                <a class="sidebar-menu">
                                    萃取液
                                    <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>
                                </a>
                                <ul class="sidebar-sub">
                                    <li>
                                        <a class="sidebar-level2" href="#">
                                            次類別一
                                            <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>
                                        </a>
                                        <ul class="sidebar-sub3 ">
                                            <li>
                                                <a href="#">
                                                    第三層類別一
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    第三層類別二
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                </ul>
                            </li>

                            <li>
                                <a class="sidebar-menu">
                                    健康器材
                                    <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>
                                </a>
                                <ul class="sidebar-sub">
                                    <li>
                                        <a class="sidebar-level2" href="#">
                                            次類別一
                                            <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>
                                        </a>
                                        <ul class="sidebar-sub3 ">
                                            <li>
                                                <a href="#">
                                                    第三層類別一
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    第三層類別二
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                </ul>
                            </li>

                            <li>
                                <a class="sidebar-menu">
                                    養身食品
                                    <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>
                                </a>
                                <ul class="sidebar-sub">
                                    <li>
                                        <a class="sidebar-level2" href="#">
                                            次類別一
                                            <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>
                                        </a>
                                        <ul class="sidebar-sub3 ">
                                            <li>
                                                <a href="#">
                                                    第三層類別一
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    第三層類別二
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                </ul>
                            </li>

                            <li>
                                <a class="sidebar-menu">
                                    滴丸
                                    <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>
                                </a>
                                <ul class="sidebar-sub">
                                    <li>
                                        <a class="sidebar-level2" href="#">
                                            次類別一
                                            <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>
                                        </a>
                                        <ul class="sidebar-sub3 ">
                                            <li>
                                                <a href="#">
                                                    第三層類別一
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    第三層類別二
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                </ul>
                            </li>

                        </ul>

                    </div>

                </div>

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
                            <li><a href="function_member.php"><input type="button" id="" name="" class="" value="個人資料"></a></li>
                            <li><a href="function_orderquery.php"><input type="button" id="" name="" class="" value="訂單查詢"></a></li>
                            <li><a href="function_bonusquery.php"><input type="button" id="" name="" class="tag-value-select" value="重銷獎金查詢/規則"></a></li>
                        </ul>
                    </div>
                    <div class="content-article">
                        <div class="text-1" style="display:inline-block;">本期重銷累積獎金資料(預估資料)<div style="display:inline-block;"><a href="#rule"><span style="color:blue;">重銷規則</span></a></div></div>
                        <table width="100%" border="1" style="margin-top:10px;">
                            <tbody>
                            <tr class="tb-tittle">
                                <td>週期</td>
                                <td>目前責任額</td>
                                <td>實際消費</td>
                                <td>達成與否</td>
                                <td>累積獎金</td>
                            </tr>
                            <tr class="td-02">
                                <td>2017/7/20-2017/8/20</td>
                                <td>1000PV</td>
                                <td>1000PV</td>
                                <td>是</td>
                                <td>$14,443</td>
                            </tr>
                            </tbody>
                        </table>
                        <table width="100%" border="1" style="margin-top:10px;">
                            <tbody>
                            <tr class="tb-tittle">
                                <td>代數 </td>
                                <td>金額 </td>
                                <td>代數 </td>
                                <td>金額 </td>
                                <td>代數 </td>
                                <td>金額 </td>
                            </tr>
                            <tr class="td-02">
                                <td>1 </td>
                                <td>$1,111 </td>
                                <td>6 </td>
                                <td>$1,111 </td>
                                <td>11 </td>
                                <td>$1,111 </td>
                            </tr>
                            <tr class="td-02">
                                <td>2 </td>
                                <td>$1,111 </td>
                                <td>7 </td>
                                <td>$1,111 </td>
                                <td>12 </td>
                                <td>$1,111 </td>
                            </tr>
                            <tr class="td-02">
                                <td>3 </td>
                                <td>$1,111 </td>
                                <td>8 </td>
                                <td>$1,111 </td>
                                <td>13 </td>
                                <td>$1,111 </td>
                            </tr>
                            <tr class="td-02">
                                <td>4 </td>
                                <td>$1,111 </td>
                                <td>9 </td>
                                <td>$1,111 </td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr class="td-02">
                                <td>5 </td>
                                <td>$1,111 </td>
                                <td>10 </td>
                                <td>$1,111 </td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="content-article">
                        <div class="text-1" style="display:inline-block;">歷史重銷累積獎金
                            <select name="" id="">
                                <option selected="selected" value="0">週期選擇</option>
                                <option value="1">20170620-20170720</option>
                                <option value="2">20170520-20170620</option>
                            </select>
                        </div>
                        <table width="100%" border="1" style="margin-top:10px;">
                            <tbody>
                            <tr class="tb-tittle">
                                <td>週期</td>
                                <td>目前責任額</td>
                                <td>實際消費</td>
                                <td>達成與否</td>
                                <td>累積獎金</td>
                            </tr>
                            <tr class="td-02">
                                <td>2017/7/20-2017/8/20</td>
                                <td>1000PV</td>
                                <td>1000PV</td>
                                <td>是</td>
                                <td>$14,443</td>
                            </tr>
                            </tbody>
                        </table>
                        <table width="100%" border="1" style="margin-top:10px;">
                            <tbody>
                            <tr class="tb-tittle">
                                <td>代數 </td>
                                <td>金額 </td>
                                <td>代數 </td>
                                <td>金額 </td>
                                <td>代數 </td>
                                <td>金額 </td>
                            </tr>
                            <tr class="td-02">
                                <td>1 </td>
                                <td>$1,111 </td>
                                <td>6 </td>
                                <td>$1,111 </td>
                                <td>11 </td>
                                <td>$1,111 </td>
                            </tr>
                            <tr class="td-02">
                                <td>2 </td>
                                <td>$1,111 </td>
                                <td>7 </td>
                                <td>$1,111 </td>
                                <td>12 </td>
                                <td>$1,111 </td>
                            </tr>
                            <tr class="td-02">
                                <td>3 </td>
                                <td>$1,111 </td>
                                <td>8 </td>
                                <td>$1,111 </td>
                                <td>13 </td>
                                <td>$1,111 </td>
                            </tr>
                            <tr class="td-02">
                                <td>4 </td>
                                <td>$1,111 </td>
                                <td>9 </td>
                                <td>$1,111 </td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr class="td-02">
                                <td>5 </td>
                                <td>$1,111 </td>
                                <td>10 </td>
                                <td>$1,111 </td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="content-article"><a name="rule"></a>
                        <div class="text-1" style="display:inline-block;">重銷規則說明</div>
                        <div class="text-2">重銷規則說明區</div>
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
