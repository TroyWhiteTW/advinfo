<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);

?>
<head>

    <?php include 'http_head.php'; ?>
    <!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css"/>

</head>
<body>
<div id="recommendDiv">

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

</body>
