<?php
include 'db.php';
session_start();
$isLogin = !empty($_SESSION['user']);
?>
<?php
// 產品分類
$sql = "select * from proclass where parent = 0 order by no";
$result = mysqli_query($conn, $sql);
//	if (mysqli_num_rows($result) > 0){
//		while ($row = mysqli_fetch_assoc($result)){
//			$proclass[] = array(
//					'no' => "{$row['no']}",
//					'pcname' => "{$row['pcname']}"
//			);
//		}
//	}else{
//		// 錯誤 查詢結果
//		echo 'E1';
//		return;
//	}
//
//	// 輪播
//	$sql = "select * from banners where status = 1 order by sort";
//	$result = mysqli_query($conn, $sql);
//	if (mysqli_num_rows($result) > 0){
//		while ($row = mysqli_fetch_assoc($result)){
//			$banners[] = array(
//					'pic' => "{$row['pic']}",
//					'url' => "{$row['url']}"
//			);
//		}
//	}else{
//		// 錯誤 查詢結果
//		echo 'E2';
//		return;
//	}
//
//	$queryPcno1 = -1;  // 全部種類
//	if (isset($_REQUEST['pcno1'])) $queryPcno1 = $_REQUEST['pcno1'];
//	$queryPcno3 = -1; // 全部新品,促銷, 普通
//	if (isset($_REQUEST['pcno3'])) $queryPcno3 = $_REQUEST['pcno3'];
//	$queryOrder = -1; // -1 不排序; 1 低到高; 2 高到低
//	if (isset($_REQUEST['order'])) $queryOrder = $_REQUEST['order'];
//
//	// 商品資訊
//	$sql = "select * from products,proclass where proclass.no=products.pcno1 and products.status=3";
//    if ($queryPcno1!=-1){
//        $sql .= " and products.pcno1='{$queryPcno1}'";
//    }
//    if ($queryPcno3!=-1){
//        $sql .= " and products.pcno3='{$queryPcno3}'";
//    }
//    if ($queryOrder==1){
//        $sql .= " order by products.price desc";
//    }else if ($queryOrder==2){
//        $sql .= " order by products.price asc";
//    }
//
//    $products = array();
//	$result = mysqli_query($conn, $sql);
//    while ($row = mysqli_fetch_assoc($result)){
//        $products[] = $row;
//    }

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
                        <li><a href="">商品類別</a></li>
                    </ul>
                </div>

                <div class="content-area">
                    <div class="function-area">
                        <ul>
                            <li><input type="button" onclick="location.href='?pcno3=1';" class="tag-value-hot btn-1"
                                       value="新品上市"></li>
                            <li><input type="button" onclick="location.href='?pcno3=2';" class="tag-value-promot btn-1"
                                       value="促銷商品"></li>
                            <li><input type="button" onclick="location.href='?order=1';" class="tag-value-price btn-1"
                                       value="價格:低-高"></li>
                            <li><input type="button" onclick="location.href='?order=1';" class="tag-value-price btn-1"
                                       value="價格:高-低"></li>
                        </ul>
                    </div>
                </div>

                <div class="product-area">
                    <div class="product-list">
                        <?php
                        foreach ($products as $product) {
                            echo '<div class="pd">';
                            echo "<a href='pd_page.php?proid=" . $product['proid'] . "'>";
                            echo '<div class="pd-pic"><img src="img/pd_01.jpg" alt=""/></div>';
                            echo "<div class='pd-name'>{$product['proname']}</div>";
                            echo "<div class='pd-type'>{$product['pcname']}</div>";
                            echo "<div class='pd-pv'>{$product['PV']}</div>";

                            // 促銷商品
                            if ($product['pcno3'] == 2) {
                                echo "<div class='pd-price'>促銷價${$product['price']}元</div>";
                            } else {
                                echo "<div class='pd-price'>價格${$product['price']}元</div>";
                            }

                            // 左上方的圖標
                            if ($product['pcno3'] == 1) {
                                // 新品上市
                                echo '<div class="tag-type"><img src="img/tag_new.png" alt=""></div>';
                            } else if ($product['pcno3'] == 2) {
                                // 促銷商品
                                echo '<div class="tag-type"><img src="img/tag_promot.png" alt=""></div>';
                            }


                            echo '</a>';
                            echo '</div>';
                        }

                        ?>

                    </div>
                </div>
            </div>
        </div>


        <?php include 'footer.php'; ?>

    </div>

</div>
</body>

</html>
