<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);

?>
<!doctype html>
<html>

<head>

    <?php include 'http_head.php'; ?>
    <!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

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
                                        <input type="button" id="" name="" class="tag-value-select" value="個人資料">
                                    </a>
                                </li>
                                <li>
                                    <a href="function_orderquery.php">
                                        <input type="button" id="" name="" class="" value="訂單查詢">
                                    </a>
                                </li>
                                <li>
                                    <a href="function_bonusquery.php">
                                        <input type="button" id="" name="" class="" value="重銷獎金查詢/規則">
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <form method="post" action="memberUpdate.php">

                            <div class="content-article">

                                <div class="form-tittle">
                                    帳號(同信箱)：
                                    <div class="form-input-2"><?php echo $_SESSION['user2']['email']; ?></div>
                                    <a class="btn btn-default btn-xs"
                                       href="<?= $_SESSION['user2']['type'] == 1 ? 'password_modify.php' : '#' ?>"<?php if ($_SESSION['user2']['type'] == 2) echo ' disabled="disabled"'; ?>>修改密碼</a>
                                </div>

                                <?php if ($_SESSION['user2']['type'] == 2):    //直銷會員?>

                                    <div class="form-tittle">
                                        聘級：
                                        <div class="form-input-2"><?php echo $_SESSION['user2']['levelname']; ?></div>
                                    </div>

                                <?php endif; ?>

                                <?php if ($_SESSION['user2']['type'] == 1):    //一般會員?>

                                    <div class="form-tittle">
                                        聘級：
                                        <div class="form-input-2">一般會員</div>
                                    </div>

                                    <div class="form-tittle">
                                        推薦ID：
                                        <div class="form-input-2"><?php echo $_SESSION['user2']['myreferral']; ?></div>
                                        <div id="recommendBtn" class="btn btn-default btn-xs" href="">推薦表</div>
                                    </div>

                                    <div class="form-tittle">
                                        推薦連結：
                                        <?php if ($_SESSION['user2']['myreferral'] != "") { ?>
                                            <div class="form-input-2">
                                                <span id="copyNode">
                                                    <?= "http://" . $_SERVER['HTTP_HOST'] . "/login_register.php?rf=" . $_SESSION['user2']['myreferral'] ?>
                                                </span>
                                            </div>
                                            <div id="copyBtn" class="btn btn-default btn-xs copy"
                                                 data-clipboard-text="資料填入">
                                                複製
                                            </div>
                                        <?php } ?>
                                    </div>

                                    <script>
                                        var copyNode = document.getElementById('copyNode');
                                        var copyBtn = document.getElementById('copyBtn');

                                        copyBtn.addEventListener('click', function () {
                                            if (copy(copyNode)) {
                                                alert('複製成功');
                                            } else {
                                                alert('複製失敗');
                                            }
                                        });

                                        function copy(node) {
                                            var range = document.createRange();
                                            range.selectNode(node);
                                            window.getSelection().addRange(range);
                                            var success = document.execCommand('copy');
                                            window.getSelection().removeAllRanges();
                                            return success;
                                        }
                                    </script>

                                <?php endif; ?>

                                <div class="form-tittle">
                                    姓名：
                                    <input name="name" type="text" id="name" class="c"
                                           value="<?php echo $_SESSION['user2']['name']; ?>"<?php if ($_SESSION['user2']['type'] == 2) echo ' disabled="disabled"'; ?>>
                                </div>

                                <div class="form-tittle">
                                    生日：
                                    <div class="form-input-2">
                                        <input name="birthday" value="<?= $_SESSION['user2']['birthday'] ?>"
                                               type="text" id="birthday" class="c"
                                               title="生日"<?php if ($_SESSION['user2']['type'] == 2) echo ' disabled="disabled"'; ?>/>
                                    </div>
                                </div>
                                <script>
                                    $("#birthday").datepicker({
                                        dateFormat: "yy-mm-dd",
                                        changeMonth: true,
                                        changeYear: true,
                                        showButtonPanel: true
                                    });
                                </script>

                                <div class="form-tittle">
                                    性別：
                                    <select id="gender"
                                            name="gender"<?php if ($_SESSION['user2']['type'] == 2) echo ' disabled="disabled"'; ?>>
                                        <?php
                                        switch ($_SESSION['user2']['gender']) {
                                            case 'M':
                                                echo '<option value="0">請選擇</option>';
                                                echo '<option value="M" selected>男</option>';
                                                echo '<option value="F">女</option>';
                                                break;
                                            case 'F':
                                                echo '<option value="0">請選擇</option>';
                                                echo '<option value="F" selected>女</option>';
                                                echo '<option value="M">男</option>';
                                                break;
                                            default:
                                                echo '<option value="0">請選擇</option>';
                                                echo '<option value="M">男</option>';
                                                echo '<option value="F">女</option>';
                                                break;
                                        }
                                        ?>
                                    </select>
                                </div>
                                <!--
                                <div class="form-tittle">
                                    電子信箱：
                                    <br/>
                                    <input name="email" id="" type="text" style="width: 50%;min-width: 200px;"
                                           value="<?= $_SESSION['user2']['email'] ?>"<?php if ($_SESSION['user2']['type'] == 2) echo ' disabled="disabled"'; ?>>
                                </div>
                                   -->
                                <div class="form-tittle">
                                    聯繫電話：
                                    <input name="phone" id="phone" type="text" class="input-2 c"
                                           value="<?= $_SESSION['user2']['phone'] ?>"<?php if ($_SESSION['user2']['type'] == 2) echo ' disabled="disabled"'; ?>>
                                </div>

                                <div class="form-tittle">
                                    <span style="color:red;">*</span>
                                    手機：
                                    <input name="mobile" id="mobile" type="text" class="input-2 c"
                                           value="<?= $_SESSION['user2']['mobile'] ?>"<?php if ($_SESSION['user2']['type'] == 2) echo ' disabled="disabled"'; ?>>
                                    <a class="btn btn-default btn-xs"
                                       href="<?= $_SESSION['user2']['type'] == 1 ? 'login_start.php' : '#' ?>"<?php if ($_SESSION['user2']['type'] == 2) echo ' disabled="disabled"'; ?>>驗證手機</a>
                                </div>

                                <div class="form-tittle">

                                    <span style="color:red;">*</span>
                                    聯繫地址：
                                    <!--                                    <input type="checkbox" checked="checked">台澎金馬-->
                                    <!--                                    <span style="color:red; font-size:12px;">(預設勾選)</span>-->
                                    <!--                                    <div class="form-tittle">-->
                                    <!--                                        <select name="" id="">-->
                                    <!--                                            <option selected="selected" value="0">請選擇縣市</option>-->
                                    <!--                                            <option value="1">B</option>-->
                                    <!--                                            <option value="2">C</option>-->
                                    <!--                                        </select>-->
                                    <!--                                        <select name="" id="">-->
                                    <!--                                            <option selected="selected" value="0">請選擇區別</option>-->
                                    <!--                                            <option value="1">B</option>-->
                                    <!--                                            <option value="2">C</option>-->
                                    <!--                                        </select>-->
                                    <!--                                    </div>-->
                                    <br/>
                                    <input name="address" id="address" type="text" style="width: 50%;min-width: 200px;"
                                           class="c"
                                           value="<?= $_SESSION['user2']['address'] ?>"<?php if ($_SESSION['user2']['type'] == 2) echo ' disabled="disabled"'; ?>>

                                </div>

                                <div class="form-tittle">
                                    統一編號：<input name="company_no" id="company_no" type="text" class="input-2"
                                                value="<?= $_SESSION['user2']['company_no'] ?>"<?php if ($_SESSION['user2']['type'] == 2) echo ' disabled="disabled"'; ?>>
                                </div>

                                <div class="form-tittle">
                                    公司抬頭：<input name="invoice_title" id="invoice_title" type="text" class="input-2"
                                                value="<?= $_SESSION['user2']['invoice_title'] ?>"<?php if ($_SESSION['user2']['type'] == 2) echo ' disabled="disabled"'; ?>>
                                </div>

                            </div>

                            <div class="content-article">
                                <div class="function-area">
                                    <ul>
                                        <li>
                                            <a href="<?= $_SESSION['user2']['type'] == 1 ? 'http://cvs.map.com.tw/default.asp?cvsname=advinfo.taironlife.com&cvstemp=member' : '#' ?>">
                                                <input type="button" id="" name="" class=""
                                                       value="選擇常用門市"<?php if ($_SESSION['user2']['type'] == 2) echo ' disabled="disabled"'; ?>>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="form-tittle">
                                    門市名稱：
                                    <div class="form-input-2">
                                        <?php
                                        echo $_SESSION['user2']['constore']['name'];
                                        ?>
                                    </div>
                                </div>
                                <div class="form-tittle">
                                    門市地址：
                                    <div class="form-input-2">
                                        <?php
                                        echo $_SESSION['user2']['constore']['addr'];
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div id="mesg" style="color: red;display:">
                                資料格式有誤,請確認
                            </div>

                            <div class="btn-area">
                                <input id="smt" type="submit" value="確認提交" disabled="disabled">
                            </div>

                        </form>
                        <script>

                            function ajaxCheckUpdate() {
                                $.ajax({
                                    url: "./checkMemberUpdate.php",
                                    type: 'POST',
                                    data: {
                                        name: document.getElementById("name").value,
                                        birthday: document.getElementById("birthday").value,
                                        gender: document.getElementById("gender").value,
                                        phone: document.getElementById("phone").value,
                                        mobile: document.getElementById("mobile").value,
                                        address: document.getElementById("address").value,
                                        company_no: document.getElementById("company_no").value,
                                        invoice_title: document.getElementById("invoice_title").value,
                                    },
                                    error: function () {
                                        alert('發生錯誤');
                                    },
                                    success: function (response) {
                                        if (response == '1') {
                                            document.getElementById("smt").disabled = "";
                                            document.getElementById("mesg").style.display = "none";
                                        } else {
                                            document.getElementById("smt").disabled = "disabled";
                                            document.getElementById("mesg").style.display = "";
                                            document.getElementById("mesg").innerHTML = response;
                                        }
                                    }
                                });
                            }

                            ajaxCheckUpdate();

                            var nodes = document.getElementsByClassName("c");
                            for (var i = 0; i < nodes.length; i++) {
                                nodes[i].addEventListener('keyup', ajaxCheckUpdate);
                            }

                        </script>

                    </div>

                    <div id="ajaxContent" style="position: fixed;top: 25%;left: 25%;right: 25%;width: 50%;height: 50%;"
                         hidden="hidden">

                    </div>

                <?php else: ?>

                    <h3>請先登入</h3>

                <?php endif; ?>

            </div>

        </div>

        <?php include 'footer.php'; ?>

    </div>

</div>

<div id="recommendDiv"
     style="display: none;position: absolute;left: 25vw;top: 25vh;width: 50vw;height: 50vh;background: lightgrey;">
    <div id="recommendDivClose"
         style="position:absolute;right: 0;top: 0;" class="btn btn-default glyphicon glyphicon-remove"
         aria-hidden="true"></div>

    <?php
    $recommendSql = "CALL SP_RecomnendList('{$_SESSION['user2']['id']}','13')";
    $recommendRes = mysqli_query($conn, $recommendSql);
    $recommendRows = [];
    while ($row = mysqli_fetch_assoc($recommendRes)) {
        $recommendRows[] = $row;
    }
    //    print_r($recommendRows);
    $data = [];
    foreach ($recommendRows as $k => $v) {
        $text = "[" . $v['referral'] == '' ? '無' : $v['referral'] . "],[{$v['email']}],[{$v['levelname']}].{$v['regtime']}";
        $sdata = [];
        $sdata['id'] = $v['id'];
        $sdata['parent'] = $v['leveldiff'] == 0 ? '#' : $v['referral'];
        $sdata['text'] = $text;
        $sdata['state'] = ['opened' => true];
        $data[] = $sdata;
    }
    //        var_dump(json_encode($data));
    $data = json_encode($data);

    ?>
    <h4>推薦表</h4>
    <hr/>
    <div id="jstree_demo_div"></div>
    <script>

        $(function () {
            $('#jstree_demo_div').jstree();
            $('#jstree_demo_div').on("changed.jstree", function (e, data) {
                console.log(data.selected);
            });

            var data = <?=$data?>;
            $('#jstree_demo_div').jstree(true).settings.core.data = data;
            $('#jstree_demo_div').jstree(true).refresh();
        });

    </script>
</div>

<script>
    var recommendBtn = document.getElementById('recommendBtn');
    var recommendDiv = document.getElementById('recommendDiv');
    var recommendDivClose = document.getElementById('recommendDivClose');
    recommendBtn.addEventListener('click', function () {
        // recommendDiv.style.display = "inline-block";
        window.open('./recommend.php');
    });
    recommendDivClose.addEventListener('click', function () {
        recommendDiv.style.display = "none";
    });
</script>

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
