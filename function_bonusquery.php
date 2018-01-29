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
                        <li><a>會員專區</a></li>

                    </ul>

                </div>

                <?php if ($isLogin): ?>

                    <div class="content-area">
                        <div class="function-area">
                            <ul>
                                <li>
                                    <a href="function_member.php">
                                        <input type="button" id="" name="" class="" value="個人資料">
                                    </a>
                                </li>
                                <li>
                                    <a href="function_orderquery.php">
                                        <input type="button" id="" name="" class="" value="訂單查詢">
                                    </a>
                                </li>
                                <li>
                                    <a href="function_bonusquery.php">
                                        <input type="button" id="" name="" class="tag-value-select" value="重銷獎金查詢/規則">
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <?php
                        //商城會員獎金自己顯示
                        if ($_SESSION['user2']["type"] == "1") {

                            $year = date('Y', time());
                            $month = date('m', time());
                            $date = date('d', time());
                            function getCBData($year, $month, $date, $isNow)
                            {
                                global $conn;
                                $returnData = [];
                                if ($date >= 21) {
                                    $cycle1 = $year . '/' . $month . '/21-' . $year . '/' . $month . '/' . $date;
                                    $startTime = $year . '-' . $month . '-21';
                                    $endTime = $year . '-' . $month . '-' . $date;
                                } else {
                                    if ($month == '01') {
                                        $preMonth = '12';
                                        $preYear = ($year - 1) . '';
                                    } else if ($month == '11' || $month == '12') {
                                        $preMonth = ($month - 1) . '';
                                        $preYear = $year;
                                    } else {
                                        $preMonth = '0' . $month - 1;
                                        $preYear = $year;
                                    }
                                    $cycle1 = $preYear . '/' . $preMonth . '/21-' . $year . '/' . $month . '/' . $date;
                                    $startTime = $preYear . '-' . $preMonth . '-21';
                                    $endTime = $year . '-' . $month . '-' . $date;
                                }
                                if (!$isNow) {
                                    if ($date >= 21) {
                                        if ($month == '12') {
                                            $cycle1 = $year . '/' . $month . '/21-' . ($year + 1) . '/' . '01' . '/' . '20';
                                            $startTime = $year . '-' . $month . '-21';
                                            $endTime = ($year + 1) . '-' . '01' . '-' . '20';
                                        } else {
                                            $cycle1 = $year . '/' . $month . '/21-' . $year . '/' . ($month + 1) . '/' . '20';
                                            $startTime = $year . '-' . $month . '-21';
                                            $endTime = $year . '-' . ($month + 1) . '-' . '20';
                                        }
                                    } else {
                                        if ($month == '01') {
                                            $cycle1 = ($year - 1) . '/' . '12' . '/21-' . $year . '/' . $month . '/' . '20';
                                            $startTime = ($year - 1) . '-' . '12' . '-21';
                                            $endTime = $year . '-' . $month . '-' . '20';
                                        } else {
                                            $cycle1 = $year . '/' . ($month - 1) . '/21-' . $year . '/' . $month . '/' . '20';
                                            $startTime = $year . '-' . ($month - 1) . '-21';
                                            $endTime = $year . '-' . $month . '-' . '20';
                                        }
                                    }
                                }
                                $bonusData = [];
                                $bonusSql = "SELECT * FROM checkout WHERE referral='{$_SESSION['user2']['id']}' AND checkout_date>'$startTime' AND checkout_date<'$endTime'";
                                $bonusRes = mysqli_query($conn, $bonusSql);
                                while ($bonusRow = mysqli_fetch_assoc($bonusRes)) {
                                    $bonusData[] = $bonusRow;
                                }
                                $returnData['cycle1'] = $cycle1;
                                $returnData['bonusData'] = $bonusData;
                                $bonusRes->close();
                                return $returnData;
                            }

                            $cbData = getCBData($year, $month, $date, true);


                            function bonusTable($cycle1, $bonusData, $isHidden)
                            {
//                                $id = preg_filter("/-|\//", "", $cycle1, -1);
                                if ($isHidden) {
                                    echo '<table width="100%" border="1" style="display:none;margin-top:10px;">';
                                } else {
                                    echo '<table width="100%" border="1" style="display:;margin-top:10px;">';
                                }
                                echo '<tbody>';
                                echo '<tr class="tb-tittle">';
                                echo '<td>週期</td>';
                                echo '<td>目前責任額</td>';
                                echo '<td>實際消費</td>';
                                echo '<td>達成與否</td>';
                                echo '<td>累積紅利</td>';
                                echo '</tr>';
                                echo '<tr class="td-02">';
                                echo "<td>$cycle1</td>";
                                $bonuce = 0;
                                foreach ($bonusData as $k => $v) {
                                    $bonuce += $v['bonuce'];
                                }
                                echo "<td>$bonuce</td>";
                                $check_money = 0;
                                foreach ($bonusData as $k => $v) {
                                    $check_money += $v['check_money'];
                                }
                                echo "<td>$check_money</td>";
                                echo $bonuce >= 500 ? '<td>是</td>' : '<td>否</td>';
                                $checkout_bonuce = 0;
                                foreach ($bonusData as $k => $v) {
                                    $checkout_bonuce += $v['checkout_bonuce'];
                                }
                                echo "<td>$checkout_bonuce</td>";
                                echo '</tr>';
                                echo '</tbody>';
                                echo '</table>';
                                if ($isHidden) {
                                    echo '<table width="100%" border="1" style="display:none;margin-top:10px;">';
                                } else {
                                    echo '<table width="100%" border="1" style="display:;margin-top:10px;">';
                                }
                                echo '<tbody>';
                                echo '<tr class="tb-tittle">';
                                echo '<td>代數</td>';
                                echo '<td>金額</td>';
                                echo '<td>代數</td>';
                                echo '<td>金額</td>';
                                echo '<td>代數</td>';
                                echo '<td>金額</td>';
                                for ($i = 0; $i < 5; $i++) {
                                    echo '<tr class="td-02">';
                                    for ($j = 0; $j < 3; $j++) {
                                        $generation = $i + 1 + $j * 5;
                                        echo '<td>';
                                        if ($generation <= 13) {
                                            echo $generation;
                                        }
                                        echo '</td>';
                                        echo '<td>';
                                        if ($generation <= 13) {
                                            $totalBonus = 0;
                                            foreach ($bonusData as $k => $v) {
                                                if ($v['generation'] == $generation - 1) {
                                                    $totalBonus += floatval($v['bonuce']);
                                                }
                                            }
                                            echo $totalBonus . '';
                                        }
                                        echo '</td>';
                                    }
                                    echo '</tr>';
                                }
                                echo '</tbody>';
                                echo '</table>';
                            }

                            ?>
                            <?php

                            function getPreYearDateData($y, $m, $d) //int
                            {
                                function formatMandD($int)
                                {
                                    if ($int < 10) {
                                        return '0' . $int;
                                    }
                                    return '' . $int;
                                }

                                $dateData = [];
                                $ny = $y - 1;
                                $nm = $m;
                                $nd = $d;

                                $dateData[] = ['y' => '' . $ny, 'm' => formatMandD($nm), 'd' => formatMandD($nd)];

                                for ($i = 0; $i < 11; $i++) {
                                    $nm += 1;
                                    if ($nm == 13) {
                                        $ny += 1;
                                        $nm = 1;
                                    }
                                    $dateData[] = ['y' => '' . $ny, 'm' => formatMandD($nm), 'd' => formatMandD($nd)];
                                }
                                return $dateData;
                            }

                            ?>
                            <div class="content-article">
                                <div class="text-1" style="display:inline-block;">本期重銷累積獎金資料(預估資料)
                                    <div style="display:inline-block;">
                                        <a href="#rule"><span style="color:blue;">重銷規則</span></a>
                                    </div>
                                </div>
                                <?= bonusTable($cbData['cycle1'], $cbData['bonusData'], false) ?>
                            </div>
                            <div class="content-article" id="tables">
                                <div class="text-1" style="display:inline-block;">歷史重銷累積獎金
                                    <select name="" id="choseCycle">
                                        <option selected="selected" value="0">週期選擇</option>
                                        <?php
                                        $yearDateData = getPreYearDateData(intval($year), intval($month), intval($date));
                                        $index = 0;
                                        foreach ($yearDateData as $k => $v) {
                                            $index++;
                                            $tCbData = getCBData($v['y'], $v['m'], $v['d'], false);
                                            echo '<option value="' . $index . '">' . $tCbData['cycle1'] . '</option>';
                                        }
                                        ?>
                                        <!--                                        <option value="1">20170620-20170720</option>-->
                                        <!--                                        <option value="2">20170520-20170620</option>-->
                                    </select>
                                </div>
                                <?php
                                //                                $yearDateData = getPreYearDateData(intval($year), intval($month), intval($date));

                                foreach ($yearDateData as $k => $v) {
//                                    var_dump($v);
                                    $tCbData = getCBData($v['y'], $v['m'], $v['d'], false);
                                    bonusTable($tCbData['cycle1'], $tCbData['bonusData'], true);
                                }

                                ?>
                                <!--                                <table width="100%" border="1" style="margin-top:10px;">-->
                                <!--                                    <tbody>-->
                                <!--                                    <tr class="tb-tittle">-->
                                <!--                                        <td>週期</td>-->
                                <!--                                        <td>目前責任額</td>-->
                                <!--                                        <td>實際消費</td>-->
                                <!--                                        <td>達成與否</td>-->
                                <!--                                        <td>累積獎金</td>-->
                                <!--                                    </tr>-->
                                <!--                                    <tr class="td-02">-->
                                <!--                                        <td>2017/7/20-2017/8/20</td>-->
                                <!--                                        <td>1000PV</td>-->
                                <!--                                        <td>1000PV</td>-->
                                <!--                                        <td>是</td>-->
                                <!--                                        <td>$14,443</td>-->
                                <!--                                    </tr>-->
                                <!--                                    </tbody>-->
                                <!--                                </table>-->
                                <!--                                <table width="100%" border="1" style="margin-top:10px;">-->
                                <!--                                    <tbody>-->
                                <!--                                    <tr class="tb-tittle">-->
                                <!--                                        <td>代數</td>-->
                                <!--                                        <td>金額</td>-->
                                <!--                                        <td>代數</td>-->
                                <!--                                        <td>金額</td>-->
                                <!--                                        <td>代數</td>-->
                                <!--                                        <td>金額</td>-->
                                <!--                                    </tr>-->
                                <!--                                    <tr class="td-02">-->
                                <!--                                        <td>1</td>-->
                                <!--                                        <td>$1,111</td>-->
                                <!--                                        <td>6</td>-->
                                <!--                                        <td>$1,111</td>-->
                                <!--                                        <td>11</td>-->
                                <!--                                        <td>$1,111</td>-->
                                <!--                                    </tr>-->
                                <!--                                    <tr class="td-02">-->
                                <!--                                        <td>2</td>-->
                                <!--                                        <td>$1,111</td>-->
                                <!--                                        <td>7</td>-->
                                <!--                                        <td>$1,111</td>-->
                                <!--                                        <td>12</td>-->
                                <!--                                        <td>$1,111</td>-->
                                <!--                                    </tr>-->
                                <!--                                    <tr class="td-02">-->
                                <!--                                        <td>3</td>-->
                                <!--                                        <td>$1,111</td>-->
                                <!--                                        <td>8</td>-->
                                <!--                                        <td>$1,111</td>-->
                                <!--                                        <td>13</td>-->
                                <!--                                        <td>$1,111</td>-->
                                <!--                                    </tr>-->
                                <!--                                    <tr class="td-02">-->
                                <!--                                        <td>4</td>-->
                                <!--                                        <td>$1,111</td>-->
                                <!--                                        <td>9</td>-->
                                <!--                                        <td>$1,111</td>-->
                                <!--                                        <td>&nbsp;</td>-->
                                <!--                                        <td>&nbsp;</td>-->
                                <!--                                    </tr>-->
                                <!--                                    <tr class="td-02">-->
                                <!--                                        <td>5</td>-->
                                <!--                                        <td>$1,111</td>-->
                                <!--                                        <td>10</td>-->
                                <!--                                        <td>$1,111</td>-->
                                <!--                                        <td>&nbsp;</td>-->
                                <!--                                        <td>&nbsp;</td>-->
                                <!--                                    </tr>-->
                                <!--                                    </tbody>-->
                                <!--                                </table>-->
                            </div>
                            <script>
                                function showHistoryBonusTable($cycle) {
                                    var tables = (document.getElementById('tables')).getElementsByTagName('table');
                                    for (var i = 0; i < tables.length; i++) {
                                        tables[i].style.display = 'none';
                                    }
                                    if ($cycle != 0) {
                                        tables[2 * $cycle - 1].style.display = '';
                                        tables[2 * $cycle - 2].style.display = '';
                                    }
                                }

                                (document.getElementById('choseCycle')).addEventListener('change', function (e) {
                                    showHistoryBonusTable(parseInt(e.target.value))
                                })

                            </script>
                            <div class="content-article"><a name="rule"></a>
                                <div class="text-1" style="display:inline-block;">重銷規則說明</div>
                                <div class="text-2">重銷規則說明區</div>
                            </div>
                        <?php } ?>
                        <?php
                        //直銷會員獎金iframe顯示
                        if ($_SESSION['user2']["type"] == "2") {
                            $ClienIP = $_SERVER['REMOTE_ADDR'];
                            $MemberNo = $_SESSION['user2']['email'];
                            $MbPassword = $_SESSION['user2']['password1'];
                            $Timestemp = time();
                            $secString1 = 've6t5io371tqda8';
                            $secString2 = '49dqf1gyuk1y2jr';
                            $Token = MD5($ClienIP . $MemberNo . $Timestemp . $MbPassword . $secString1) .
                                substr(MD5($ClienIP . $MemberNo . $Timestemp . $MbPassword . $secString2), 0, 8);

                            $param = array(
                                'MemberNo' => $MemberNo,
                                'Timestemp' => $Timestemp,
                                'Token' => $Token
                            );

                            $Url = 'https://vip.zjt-taiwan.com/Mall/MemberBonus?' . http_build_query($param);
                            ?>
                            <div class="content-article">
                                <iframe src="<?= $Url ?>" width="100%" height="1000" frameborder="0"
                                        scrolling="auto"></iframe>
                            </div>
                        <?php } ?>
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

    //新增側邊欄
</script>

</body>

</html>