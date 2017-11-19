<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);

if ($isLogin) {
    header('Location:index.php');
    exit;
}
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
                        <li><a href="">加入會員</a></li>
                    </ul>
                </div>
                <div class="content-area">
                    <div class="content-article">
                        <div class="login-area">

                            <div class="login-tittle">加入會員</div>

                            <form id="register_form" action="register.php" method="post">

                                <table width="100%" border="0">

                                    <tbody>

                                    <tr>
                                        <td class="td-04">帳號<span style="color:red;">*</span></td>
                                        <td><input type="text" name="email" class="input-4"></td>
                                    </tr>

                                    <tr>
                                        <td class="td-04"></td>
                                        <td class="td-05">請輸入電子郵件為往後登入帳號</td>
                                    </tr>

                                    <tr>
                                        <td class="td-04">密碼<span style="color:red;">*</span></td>
                                        <td><input type="password" name="password" class="input-4"></td>
                                    </tr>

                                    <tr>
                                        <td class="td-04"></td>
                                        <td class="td-05">
                                            8-20字元，至少1個英文與1個數字<br>
                                            不含空白、雙引號、單引號、星號<br>
                                            注意密碼不與其他網站相同，確保帳戶安全<br>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="td-04">確認密碼<span style="color:red;">*</span></td>
                                        <td><input type="password" name="password_c" class="input-4"></td>
                                    </tr>

<!--                                    <tr>-->
<!--                                        <td class="td-04">姓名<span style="color:red;">*</span></td>-->
<!--                                        <td><input type="text" name="name" class="input-4"></td>-->
<!--                                    </tr>-->
<!---->
<!--                                    <tr>-->
<!--                                        <td class="td-04">性別<span style="color:red;">*</span></td>-->
<!--                                        <td>-->
<!--                                            <select name="gender" class="input-4">-->
<!--                                                <option value="M">男</option>-->
<!--                                                <option value="F">女</option>-->
<!--                                            </select>-->
<!--                                        </td>-->
<!--                                    </tr>-->

                                    <!--                                    <tr hidden="hidden">-->
                                    <!--                                        <td class="td-04">聘級</td>-->
                                    <!--                                        <td><input type="text" name="level" class="input-4"></td>-->
                                    <!--                                    </tr>-->

                                    <tr>
                                        <td class="td-04">推薦者帳號</td>
                                        <td><input type="text" name="referral" class="input-4"></td>
                                    </tr>

<!--                                    <tr>-->
<!--                                        <td class="td-04">生日<span style="color:red;">*</span></td>-->
<!--                                        <td><select name="birthday_y" id="b_y"></select>年-->
<!--                                            <select name="birthday_m" id="b_m"></select>月-->
<!--                                            <select name="birthday_d" id="b_d"></select>日-->
<!--                                        </td>-->
<!--                                        <script>-->
<!--                                            var y = "";-->
<!--                                            for (var i = 1970; i <= 2017; i++) {-->
<!--                                                y += '<option value="' + i + '">' + i + '</option>';-->
<!--                                            }-->
<!--                                            document.getElementById('b_y').innerHTML = y;-->
<!---->
<!--                                            var m = "";-->
<!--                                            for (var i = 1; i <= 12; i++) {-->
<!--                                                m += '<option value="' + i + '">' + padLeft(i + "", 2) + '</option>';-->
<!--                                            }-->
<!--                                            document.getElementById('b_m').innerHTML = m;-->
<!---->
<!--                                            var d = "";-->
<!--                                            for (var i = 1; i <= 31; i++) {-->
<!--                                                d += '<option value="' + i + '">' + padLeft(i + "", 2) + '</option>';-->
<!--                                            }-->
<!--                                            document.getElementById('b_d').innerHTML = d;-->
<!---->
<!--                                            function padLeft(str, lenght) {-->
<!--                                                if (str.length >= lenght)-->
<!--                                                    return str;-->
<!--                                                else-->
<!--                                                    return padLeft("0" + str, lenght);-->
<!--                                            }-->
<!--                                        </script>-->
<!--                                    </tr>-->

<!--                                    <tr>-->
<!--                                        <td class="td-04">聯繫電話</td>-->
<!--                                        <td><input type="text" name="phone" class="input-4"></td>-->
<!--                                    </tr>-->

<!--                                    <tr>-->
<!--                                        <td class="td-04"></td>-->
<!--                                        <td class="td-05">-->
<!--                                            例:0298765432-->
<!--                                        </td>-->
<!--                                    </tr>-->

<!--                                    <tr>-->
<!--                                        <td class="td-04">手機<span style="color:red;">*</span></td>-->
<!--                                        <td><input type="text" name="mobile" class="input-4"></td>-->
<!--                                    </tr>-->

<!--                                    <tr>-->
<!--                                        <td class="td-04"></td>-->
<!--                                        <td class="td-05">-->
<!--                                            例:0123456789-->
<!--                                        </td>-->
<!--                                    </tr>-->

                                    <!--                                    <tr hidden="hidden">-->
                                    <!--                                        <td class="td-04">統一編號</td>-->
                                    <!--                                        <td><input type="text" name="company_no" class="input-4"></td>-->
                                    <!--                                    </tr>-->
                                    <!---->
                                    <!--                                    <tr hidden="hidden">-->
                                    <!--                                        <td class="td-04">發票抬頭</td>-->
                                    <!--                                        <td><input type="text" name="invoice_title" class="input-4"></td>-->
                                    <!--                                    </tr>-->

<!--                                    <tr>-->
<!--                                        <td class="td-04">縣市<span style="color:red;">*</span></td>-->
<!--                                        <td><select name="city" id="s_city"></select></td>-->
<!--                                    </tr>-->

<!--                                    <tr>-->
<!--                                        <td class="td-04">鄉鎮區<span style="color:red;">*</span></td>-->
<!--                                        <td><select name="area" id="s_area"></td>-->
<!--                                    </tr>-->
<!--                                    <script>-->
<!---->
<!--                                        document.getElementById('s_city').innerHTML =-->
<!--                                            '<option value="臺北市">臺北市</option>' +-->
<!--                                            '<option value="新北市">新北市</option>' +-->
<!--                                            '<option value="桃園市">桃園市</option>' +-->
<!--                                            '<option value="台中市">台中市</option>' +-->
<!--                                            '<option value="台南市">台南市</option>' +-->
<!--                                            '<option value="高雄市">高雄市</option>' +-->
<!--                                            '<option value="基隆市">基隆市</option>' +-->
<!--                                            '<option value="新竹市">新竹市</option>' +-->
<!--                                            '<option value="嘉義市">嘉義市</option>' +-->
<!--                                            '<option value="新竹縣">新竹縣</option>' +-->
<!--                                            '<option value="苗栗縣">苗栗縣</option>' +-->
<!--                                            '<option value="彰化縣">彰化縣</option>' +-->
<!--                                            '<option value="南投縣">南投縣</option>' +-->
<!--                                            '<option value="雲林縣">雲林縣</option>' +-->
<!--                                            '<option value="嘉義縣">嘉義縣</option>' +-->
<!--                                            '<option value="屏東縣">屏東縣</option>' +-->
<!--                                            '<option value="宜蘭縣">宜蘭縣</option>' +-->
<!--                                            '<option value="花蓮縣">花蓮縣</option>' +-->
<!--                                            '<option value="臺東縣">臺東縣</option>' +-->
<!--                                            '<option value="澎湖縣">澎湖縣</option>' +-->
<!--                                            '<option value="金門縣">金門縣</option>' +-->
<!--                                            '<option value="連江縣">連江縣</option>';-->
<!---->
<!--                                        document.getElementById('s_area').innerHTML =-->
<!--                                            '<option value="中正區">中正區</option>\n' +-->
<!--                                            '<option value="大同區">大同區</option>\n' +-->
<!--                                            '<option value="中山區">中山區</option>\n' +-->
<!--                                            '<option value="松山區">松山區</option>\n' +-->
<!--                                            '<option value="大安區">大安區</option>\n' +-->
<!--                                            '<option value="萬華區">萬華區</option>\n' +-->
<!--                                            '<option value="信義區">信義區</option>\n' +-->
<!--                                            '<option value="士林區">士林區</option>\n' +-->
<!--                                            '<option value="北投區">北投區</option>\n' +-->
<!--                                            '<option value="內湖區">內湖區</option>\n' +-->
<!--                                            '<option value="南港區">南港區</option>\n' +-->
<!--                                            '<option value="文山區">文山區</option>';-->
<!---->
<!--                                        var areaObj = {-->
<!--                                            "臺北市": ["中正區", "大同區", "中山區", "松山區", "大安區", "萬華區", "信義區", "士林區", "北投區", "內湖區", "南港區", "文山區"],-->
<!--                                            "新北市": ["板橋區", "新莊區", "中和區", "永和區", "土城區", "樹林區", "三峽區", "鶯歌區", "三重區", "蘆洲區", "五股區", "泰山區", "林口區", "八里區", "淡水區", "三芝區", "石門區", "金山區", "萬里區", "汐止區", "瑞芳區", "貢寮區", "平溪區", "雙溪區", "新店區", "深坑區", "石碇區", "坪林區", "烏來區"],-->
<!--                                            "桃園市": ["桃園區", "中壢區", "平鎮區", "八德區", "楊梅區", "蘆竹區", "大溪區", "龍潭區", "龜山區", "大園區", "觀音區", "新屋區", "復興區"],-->
<!--                                            "台中市": ["中區", "東區", "南區", "西區", "北區", "北屯區", "西屯區", "南屯區", "太平區", "大里區", "霧峰區", "烏日區", "豐原區", "后里區", "石岡區", "東勢區", "新社區", "潭子區", "大雅區", "神岡區", "大肚區", "沙鹿區", "龍井區", "梧棲區", "清水區", "大甲區", "外埔區", "大安區", "和平區"],-->
<!--                                            "台南市": ["中西區", "東區", "南區", "北區", "安平區", "安南區", "永康區", "歸仁區", "新化區", "左鎮區", "玉井區", "楠西區", "南化區", "仁德區", "關廟區", "龍崎區", "官田區", "麻豆區", "佳里區", "西港區", "七股區", "將軍區", "學甲區", "北門區", "新營區", "後壁區", "白河區", "東山區", "六甲區", "下營區", "柳營區", "鹽水區", "善化區", "大內區", "山上區", "新市區", "安定區"],-->
<!--                                            "高雄市": ["楠梓區", "左營區", "鼓山區", "三民區", "鹽埕區", "前金區", "新興區", "苓雅區", "前鎮區", "旗津區", "小港區", "鳳山區", "大寮區", "鳥松區", "林園區", "仁武區", "大樹區", "大社區", "岡山區", "路竹區", "橋頭區", "梓官區", "彌陀區", "永安區", "燕巢區", "田寮區", "阿蓮區", "茄萣區", "湖內區", "旗山區", "美濃區", "內門區", "杉林區", "甲仙區", "六龜區", "茂林區", "桃源區", "那瑪夏區"],-->
<!--                                            "基隆市": ["仁愛區", "中正區", "信義區", "中山區", "安樂區", "暖暖區", "七堵區"],-->
<!--                                            "新竹市": ["東區", "北區", "香山區"],-->
<!--                                            "嘉義市": ["東區", "西區"],-->
<!--                                            "新竹縣": ["竹北市", "竹東鎮", "新埔鎮", "關西鎮", "湖口鄉", "新豐鄉", "峨眉鄉", "寶山鄉", "北埔鄉", "芎林鄉", "橫山鄉", "尖石鄉", "五峰鄉"],-->
<!--                                            "苗栗縣": ["苗栗市", "頭份市", "竹南鎮", "後龍鎮", "通霄鎮", "苑裡鎮", "卓蘭鎮", "造橋鄉", "西湖鄉", "頭屋鄉", "公館鄉", "銅鑼鄉", "三義鄉", "大湖鄉", "獅潭鄉", "三灣鄉", "南庄鄉", "泰安鄉"],-->
<!--                                            "彰化縣": ["彰化市", "員林市", "和美鎮", "鹿港鎮", "溪湖鎮", "二林鎮", "田中鎮", "北斗鎮", "花壇鄉", "芬園鄉", "大村鄉", "永靖鄉", "伸港鄉", "線西鄉", "福興鄉", "秀水鄉", "埔心鄉", "埔鹽鄉", "大城鄉", "芳苑鄉", "竹塘鄉", "社頭鄉", "二水鄉", "田尾鄉", "埤頭鄉", "溪州鄉"],-->
<!--                                            "南投縣": ["南投市", "埔里鎮", "草屯鎮", "竹山鎮", "集集鎮", "名間鄉", "鹿谷鄉", "中寮鄉", "魚池鄉", "國姓鄉", "水里鄉", "信義鄉", "仁愛鄉"],-->
<!--                                            "雲林縣": ["斗六市", "斗南鎮", "虎尾鎮", "西螺鎮", "土庫鎮", "北港鎮", "林內鄉", "古坑鄉", "大埤鄉", "莿桐鄉", "褒忠鄉", "二崙鄉", "崙背鄉", "麥寮鄉", "臺西鄉", "東勢鄉", "元長鄉", "四湖鄉", "口湖鄉", "水林鄉"],-->
<!--                                            "嘉義縣": ["太保市", "朴子市", "布袋鎮", "大林鎮", "民雄鄉", "溪口鄉", "新港鄉", "六腳鄉", "東石鄉", "義竹鄉", "鹿草鄉", "水上鄉", "中埔鄉", "竹崎鄉", "梅山鄉", "番路鄉", "大埔鄉", "阿里山鄉"],-->
<!--                                            "屏東縣": ["屏東市", "潮州鎮", "東港鎮", "恆春鎮", "萬丹鄉", "長治鄉", "麟洛鄉", "九如鄉", "里港鄉", "鹽埔鄉", "高樹鄉", "萬巒鄉", "內埔鄉", "竹田鄉", "新埤鄉", "枋寮鄉", "新園鄉", "崁頂鄉", "林邊鄉", "南州鄉", "佳冬鄉", "琉球鄉", "車城鄉", "滿州鄉", "枋山鄉", "霧臺鄉", "瑪家鄉", "泰武鄉", "來義鄉", "春日鄉", "獅子鄉", "牡丹鄉", "三地門鄉"],-->
<!--                                            "宜蘭縣": ["宜蘭市", "頭城鎮", "羅東鎮", "蘇澳鎮", "礁溪鄉", "壯圍鄉", "員山鄉", "冬山鄉", "五結鄉", "三星鄉", "大同鄉", "南澳鄉"],-->
<!--                                            "花蓮縣": ["花蓮市", "鳳林鎮", "玉里鎮", "新城鄉", "吉安鄉", "壽豐鄉", "光復鄉", "豐濱鄉", "瑞穗鄉", "富里鄉", "秀林鄉", "萬榮鄉", "卓溪鄉"],-->
<!--                                            "臺東縣": ["臺東市", "成功鎮", "關山鎮", "長濱鄉", "池上鄉", "東河鄉", "鹿野鄉", "卑南鄉", "大武鄉", "綠島鄉", "太麻里鄉", "海端鄉", "延平鄉", "金峰鄉", "達仁鄉", "蘭嶼鄉"],-->
<!--                                            "澎湖縣": ["馬公市", "湖西鄉", "白沙鄉", "西嶼鄉", "望安鄉", "七美鄉"],-->
<!--                                            "金門縣": ["金城鎮", "金湖鎮", "金沙鎮", "金寧鄉", "烈嶼鄉", "烏坵鄉"],-->
<!--                                            "連江縣": ["南竿鄉", "北竿鄉", "莒光鄉", "東引鄉"]-->
<!--                                        };-->
<!---->
<!--                                        document.getElementById('s_city').addEventListener('change', function (e) {-->
<!--                                            var areaData = areaObj[e.target.value];-->
<!--                                            var html = "";-->
<!--                                            for (var i = 0; i < areaData.length; i++) {-->
<!--                                                html += '<option value="' + areaData[i] + '">' + areaData[i] + '</option>';-->
<!--                                            }-->
<!--                                            document.getElementById('s_area').innerHTML = html;-->
<!--                                        });-->
<!---->
<!--                                    </script>-->

<!--                                    <tr>-->
<!--                                        <td class="td-04">聯繫地址<span style="color:red;">*</span></td>-->
<!--                                        <td><input type="text" name="address" class="input-4"></td>-->
<!--                                    </tr>-->

                                    <!--                                    <tr hidden="hidden">-->
                                    <!--                                        <td class="td-04">常用便利商店門市</td>-->
                                    <!--                                        <td><input type="text" name="constore" class="input-4"></td>-->
                                    <!--                                    </tr>-->

                                    <!--                                    <tr hidden="hidden">-->
                                    <!--                                        <td class="td-04">會員類別<span style="color:red;">*</span></td>-->
                                    <!--                                        <td>-->
                                    <!--                                            <select name="type" class="input-4">-->
                                    <!--                                                <option value="1">一般會員</option>-->
                                    <!--                                                <option value="2">直銷會員</option>-->
                                    <!--                                            </select>-->
                                    <!--                                        </td>-->
                                    <!--                                    </tr>-->

                                    <tr>
                                        <td class="td-04">驗證碼<span style="color:red;">*</span></td>
                                        </td>
                                        <td><input onkeyup="ajaxForCheckCaptcha();" id="validate_code" type="text"
                                                   name="validate_code" class="input-5">
                                            <span id="captcha"><img src="captcha.php" width="100" height="25"/></span>
                                            <span id="captchaIcon" class="glyphicon glyphicon-remove"></span>
                                            <a style="cursor: pointer" id="change_captcha">換一張</a>
                                            <script>
                                                document.getElementById('change_captcha').addEventListener('click', function () {
                                                    document.getElementById('captcha').innerHTML = "<img src=\"captcha.php\" width=\"100\" height=\"25\"/>";
                                                });
                                            </script>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>

                                <div class="login-info">
                                    <input id="form_submit" type="submit" class="btn btn-default" value="確認送出">
                                </div>

                            </form>

                        </div>
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

    //ajax檢查驗證碼
    function ajaxForCheckCaptcha() {
        $.ajax({
            url: "./check_captcha_ajax.php",
            type: 'POST',
            data: {
                validate_code: document.getElementById('validate_code').value
            },
            error: function () {
                alert('驗證過程發生錯誤');
            },
            success: function (response) {
                if (response === 's') {
                    if (document.getElementById('captchaIcon').classList.contains('glyphicon-remove')) {
                        document.getElementById('captchaIcon').classList.remove('glyphicon-remove');
                        document.getElementById('captchaIcon').classList.add('glyphicon-ok');
                    }
                } else {
                    if (document.getElementById('captchaIcon').classList.contains('glyphicon-ok')) {
                        document.getElementById('captchaIcon').classList.remove('glyphicon-ok');
                        document.getElementById('captchaIcon').classList.add('glyphicon-remove');
                    }
                }
            }
        });
    }

    //註冊表單提交檢查
    var form = document.getElementById('register_form');
    form.addEventListener('submit', function (e) {

        var isDataCorrect = true;
        var errorMessage = "";

        var account = $('input[name="email"]').val().trim();
        var password = $('input[name="password"]').val().trim();
        var password_c = $('input[name="password_c"]').val().trim();
//        var name = $('input[name="name"]').val().trim();
//        var gender = $('select[name="gender"]').val().trim();
//        var level = $('input[name="level"]').val().trim();
        var referral = $('input[name="referral"]').val().trim();
//        var birthday_y = $('select[name="birthday_y"]').val().trim();
//        var birthday_m = $('select[name="birthday_m"]').val().trim();
//        var birthday_d = $('select[name="birthday_d"]').val().trim();
//        var phone = $('input[name="phone"]').val().trim();
//        var mobile = $('input[name="mobile"]').val().trim();
//        var company_no = $('input[name="company_no"]').val().trim();
//        var invoice_title = $('input[name="invoice_title"]').val().trim();
//        var city = $('select[name="city"]').val().trim();
//        var area = $('select[name="area"]').val().trim();
//        var address = $('input[name="address"]').val().trim();
//        var constore = $('input[name="constore"]').val().trim();
//        var type = $('select[name="type"]').val().trim();
//        var validate_code = $('input[name="validate_code"]').val().trim();

        //檢查帳號格式
        var email_regex = /[a-zA-Z0-9._%-]+@[a-zA-Z0-9._%-]+\.[a-zA-Z]{2,4}/;
        if (!account.match(email_regex)) {
            isDataCorrect = false;
            errorMessage += '帳號格式錯誤，請輸入電子信箱。\n';
        }
        if (account.match(/\s/)) {
            isDataCorrect = false;
            errorMessage += '帳號格式錯誤，請勿包含空白鍵。\n';
        }
        if (account.length === 0) {
            isDataCorrect = false;
            errorMessage += '請輸入帳號\n';
        }
        //檢查密碼格式
        if (password.length < 8 || password.length > 20) {
            isDataCorrect = false;
            errorMessage += '密碼格式錯誤，字數必須在8-20之間。\n';
        }
        if (!password.match(/[0-9]/) || !password.match(/[a-zA-Z]/)) {
            isDataCorrect = false;
            errorMessage += '密碼格式錯誤，必須至少擁有一個數字及英文。\n';
        }
        if (password.match(/\s/)) {
            isDataCorrect = false;
            errorMessage += '密碼格式錯誤，請勿包含空白鍵。\n';
        }
        if (password !== password_c) {
            isDataCorrect = false;
            errorMessage += '密碼確認必須與密碼相同。\n';
        }
        if (password.length === 0) {
            isDataCorrect = false;
            errorMessage += '請輸入密碼。\n';
        }
        //檢查姓名
//        if (name.match(/\s/)) {
//            isDataCorrect = false;
//            errorMessage += '姓名格式錯誤，請勿包含空白鍵。\n';
//        }
//        if (name.match(/\d/)) {
//            isDataCorrect = false;
//            errorMessage += '姓名格式錯誤，請勿包含數字。\n';
//        }
//        if (name.length === 0) {
//            isDataCorrect = false;
//            errorMessage += '請輸入姓名。\n';
//        }
        //檢查聯繫電話
//        if (phone.match(/\s/)) {
//            isDataCorrect = false;
//            errorMessage += '聯繫電話格式錯誤，請勿包含空白鍵。\n';
//        }
//        if (phone.match(/[^\d]/)) {
//            isDataCorrect = false;
//            errorMessage += '聯繫電話格式錯誤，請輸入數字。\n';
//        }
        //檢查手機
//        if (mobile.match(/\s/)) {
//            isDataCorrect = false;
//            errorMessage += '手機格式錯誤，請勿包含空白鍵。\n';
//        }
//        if (mobile.match(/[^\d]/)) {
//            isDataCorrect = false;
//            errorMessage += '手機格式錯誤，請輸入數字。\n';
//        }
//        if (mobile.length !== 10) {
//            isDataCorrect = false;
//            errorMessage += '請輸入正確手機號碼。\n';
//        }
        //檢查聯繫地址
//        if (address.length === 0) {
//            isDataCorrect = false;
//            errorMessage += '請輸入聯繫地址。\n';
//        }
        //檢查驗證碼格式
//        if (validate_code.length === 0) {
//            isDataCorrect = false;
//            errorMessage += '請輸入驗證碼。\n';
//        }
//        if (validate_code.match(/\s/)) {
//            isDataCorrect = false;
//            errorMessage += '驗證碼格式錯誤，請勿包含空白鍵。\n';
//        }
        //檢查聘級 level
//        if (level.match(/\s/)) {
//            isDataCorrect = false;
//            errorMessage += '聘級格式錯誤，請勿包含空白鍵。\n';
//        }
        //檢查性別 gender
//        if (gender.match(/\s/)) {
//            isDataCorrect = false;
//            errorMessage += '性別格式錯誤，請勿包含空白鍵。\n';
//        }
//        if (gender !== "F" && gender !== "M") {
//            isDataCorrect = false;
//            errorMessage += '性別格式錯誤。\n';
//        }
        //檢查推薦者帳號 referral
        if (referral !== "") {
            if (!referral.match(email_regex)) {
                isDataCorrect = false;
                errorMessage += '推薦者帳號格式錯誤，請輸入電子信箱。\n';
            }
            if (referral.match(/\s/)) {
                isDataCorrect = false;
                errorMessage += '推薦者帳號格式錯誤，請勿包含空白鍵。\n';
            }
        }
        //檢查生日 birthday ymd
//        if (birthday_y.match(/[^\d]/)) {
//            isDataCorrect = false;
//            errorMessage += '生日年份錯誤，請輸入數字。\n';
//        }
//        if (birthday_y.length === 0) {
//            isDataCorrect = false;
//            errorMessage += '請輸入生日年。\n';
//        }
//        if (birthday_m.match(/[^\d]/)) {
//            isDataCorrect = false;
//            errorMessage += '生日月份錯誤，請輸入數字。\n';
//        }
//        if (birthday_m.length === 0) {
//            isDataCorrect = false;
//            errorMessage += '請輸入生日月。\n';
//        }
//        if (birthday_d.match(/[^\d]/)) {
//            isDataCorrect = false;
//            errorMessage += '生日日期錯誤，請輸入數字。\n';
//        }
//        if (birthday_d.length === 0) {
//            isDataCorrect = false;
//            errorMessage += '請輸入生日日期。\n';
//        }
        //檢查統一編號 company_no
//        if (company_no.match(/[^\d]/)) {
//            isDataCorrect = false;
//            errorMessage += '統一編號格式錯誤，請輸入數字。\n';
//        }
//        if (company_no.match(/\s/)) {
//            isDataCorrect = false;
//            errorMessage += '統一編號格式錯誤，請勿包含空白鍵。\n';
//        }
//        //檢查發票抬頭 invoice_title
//        if (invoice_title.match(/\s/)) {
//            isDataCorrect = false;
//            errorMessage += '發票抬頭格式錯誤，請勿包含空白鍵。\n';
//        }
        //檢查縣市 city
//        if (city.match(/\s/)) {
//            isDataCorrect = false;
//            errorMessage += '縣市格式錯誤，請勿包含空白鍵。\n';
//        }
//        if (city.length === 0) {
//            isDataCorrect = false;
//            errorMessage += '請輸入縣市。\n';
//        }
        //檢查鄉鎮區 area
//        if (area.match(/\s/)) {
//            isDataCorrect = false;
//            errorMessage += '鄉鎮區格式錯誤，請勿包含空白鍵。\n';
//        }
//        if (area.length === 0) {
//            isDataCorrect = false;
//            errorMessage += '請輸入鄉鎮區。\n';
//        }
//        //檢查常用便利商店門市 constore
//        if (constore.match(/\s/)) {
//            isDataCorrect = false;
//            errorMessage += '常用便利商店門市格式錯誤，請勿包含空白鍵。\n';
//        }
//        //檢查會員類別 type
//        if (type !== "1" && type !== "2") {
//            isDataCorrect = false;
//            errorMessage += '會員類別格式錯誤。\n';
//        }
        if (isDataCorrect === false) {
            alert(errorMessage);
            e.preventDefault();
        }
    });
    //註冊表單提交檢查

</script>
</body>

</html>
