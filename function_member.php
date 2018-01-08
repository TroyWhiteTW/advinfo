<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);

?>
<!doctype html>
<html>

<head>

    <?php include 'http_head.php'; ?>
    <link rel="stylesheet" href="dist/themes/default/style.min.css"/>

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
                                    帳號：
                                    <div class="form-input-2"><?php echo $_SESSION['user2']['email']; ?></div>
                                    <a class="btn btn-default btn-xs" href="password_modify.php">修改密碼</a>
                                </div>

                                <?php if ($_SESSION['user2']['type'] == 2):    //直銷會員?>

                                    <div class="form-tittle">
                                        聘級：
                                        <div class="form-input-2"><?php echo $_SESSION['user2']['level']; ?></div>
                                    </div>

                                <?php endif; ?>

                                <?php if ($_SESSION['user2']['type'] == 1):    //一般會員?>

                                    <div class="form-tittle">
                                        推薦ID：
                                        <div class="form-input-2"><?php echo $_SESSION['user2']['myreferral']; ?></div>
                                        <a id="testBtn" class="btn btn-default btn-xs" href="">推薦表</a>
                                    </div>

                                    <script src="./dist/jstree.min.js"></script>
                                    <script>
                                        var testBtn = document.getElementById('testBtn');
                                        testBtn.addEventListener('click', function () {
                                            $.ajax({
                                                url: "./Web_Manage/members/service.php",
                                                cache: false,
                                                type: "GET",
                                                data: {
                                                    'id': '<?=$_SESSION['user2']['id']?>',
                                                    'level': '<?=$_SESSION['user2']['level']?>',
                                                    'referral': '<?=$_SESSION['user2']['referral']?>',
                                                    'name': '<?=$_SESSION['user2']['name']?>',
                                                    'birthday': '<?=$_SESSION['user2']['birthday']?>',
                                                    'email': '<?=$_SESSION['user2']['email']?>',
                                                    'phone': '<?=$_SESSION['user2']['phone']?>',
                                                    'mobile': '<?=$_SESSION['user2']['mobile']?>',
                                                    'city': '<?=$_SESSION['user2']['city']?>',
                                                    'area': '<?=$_SESSION['user2']['area']?>',
                                                    'address': '<?=$_SESSION['user2']['address']?>',
                                                    'company_no': '<?=$_SESSION['user2']['company_no']?>',
                                                    'invoice_title': '<?=$_SESSION['user2']['invoice_title']?>',
                                                    'constore': '<?=$_SESSION['user2']['constore']['name']?>',
                                                },
                                                // data: {
                                                //     'keywordtype': '1',
                                                //     'keyword': 'zjttw_20171107205310',
                                                //     '_': '1515400556743'
                                                // },
                                                dataType: "json",
                                                success: function (data) {
                                                    // if (data) {
                                                    //     if (data['result'] == true) {
                                                    //         $('#jstree').jstree(true).settings.core.data = data.data;
                                                    //         $('#jstree').jstree(true).refresh();
                                                    //     }
                                                    //     else {
                                                    //         console.log(data['data']);
                                                    //     }
                                                    // }
                                                    // else {
                                                    //     alert("回傳資料錯誤");
                                                    // }
                                                    console.log(data);
                                                },
                                                error: function (xhr, ajaxOptions, thrownError) {
                                                    console.log("讀取資料時發生錯誤,請梢候再試" + thrownError, xhr);
                                                }
                                            });
                                        });
                                    </script>

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
                                    <input name="name" type="text" value="<?php echo $_SESSION['user2']['name']; ?>">
                                </div>

                                <div class="form-tittle">
                                    生日：
                                    <div class="form-input-2">
                                        <input name="birthday" value="<?= $_SESSION['user2']['birthday'] ?>" type="date"
                                               title="生日"/>
                                    </div>
                                </div>

                                <div class="form-tittle">
                                    性別：
                                    <select name="gender">
                                        <?php
                                        switch ($_SESSION['user2']['gender']) {
                                            case 'M':
                                                echo '<option value="M" selected>男</option>';
                                                echo '<option value="F">女</option>';
                                                break;
                                            case 'F':
                                                echo '<option value="F" selected>女</option>';
                                                echo '<option value="M">男</option>';
                                                break;
                                            default:
                                                echo '<option>請選擇</option>';
                                                echo '<option value="M">男</option>';
                                                echo '<option value="F">女</option>';
                                                break;
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-tittle">
                                    電子信箱：
                                    <br/>
                                    <input name="email" id="" type="text" style="width: 50%;min-width: 200px;"
                                           value="<?= $_SESSION['user2']['email'] ?>">
                                </div>

                                <div class="form-tittle">
                                    聯繫電話：
                                    <input name="phone" id="" type="text" class="input-2"
                                           value="<?= $_SESSION['user2']['phone'] ?>">
                                </div>

                                <div class="form-tittle">
                                    <span style="color:red;">*</span>
                                    手機：
                                    <input name="mobile" id="" type="text" class="input-2"
                                           value="<?= $_SESSION['user2']['mobile'] ?>">
                                    <a class="btn btn-default btn-xs" href="login_start.php">驗證手機</a>
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
                                    <input name="address" id="" type="text" style="width: 50%;min-width: 200px;"
                                           value="<?= $_SESSION['user2']['address'] ?>">

                                </div>

                                <div class="form-tittle">
                                    統一編號：<input name="company_no" id="company_no" type="text" class="input-2"
                                                value="<?= $_SESSION['user2']['company_no'] ?>">
                                </div>

                                <div class="form-tittle">
                                    公司抬頭：<input name="invoice_title" id="invoice_title" type="text" class="input-2"
                                                value="<?= $_SESSION['user2']['invoice_title'] ?>">
                                </div>

                            </div>

                            <div class="content-article">
                                <div class="function-area">
                                    <ul>
                                        <li>
                                            <a href="http://cvs.map.com.tw/default.asp?cvsname=advinfo.taironlife.com&cvstemp=member">
                                                <input type="button" id="" name="" class="" value="選擇常用門市">
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

                            <div class="btn-area">
                                <input type="submit" value="確認提交">
                            </div>

                        </form>

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
