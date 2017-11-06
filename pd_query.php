<?php 
	include 'db.php';
	session_start();
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
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <title>珍菌王商城</title>
        <link href="css/reset.css" rel="stylesheet" type="text/css">
        
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
         
        
        
        <link href="css/layout.css" rel="stylesheet" type="text/css">
        <link href="css/tmp_left_menu.css" rel="stylesheet" type="text/css">
        
        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        
        <!-- owl.carousel -->
        <link rel="stylesheet" href="css/owl.carousel.min.css">
        <script src="scripts/owl.carousel.min.js"></script>
    </head>
    <body>
        <div class="wrap">
            
            <div class="topbar-mobile">
                <div class="mobile-content">
                    <input type="image" src="img/open_btn.png" class="left-open">
                    <div class="icon-area">
                        <ul>
                            <li>Hi!王先生榮董您好!</li>
                            <li><a href="index.php"><div class="index-icon"></div></a></li>
                            <li><a href="function_member.php"><div class="member-icon"></div></a></li>
                            <li><a href="cart_1.php"><div class="cart-icon"></div></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="topbar">
                <div class="top-content">
                    <ul>
                        <li><a href="index.php">首頁<div class="index-icon"></div></a></li>
                        <li><a href="login.php">會員登入<div class="member-icon"></div></a></li>
                        <li><a href="cart_1.php">購物車<div class="cart-icon"></div></a></li>
                    </ul>
                    <div class="search">
                        <div class="search-input">
                            <input type="text" name="input-1" id="input-1" class="input-1" placeholder="搜尋商品">
                        </div>
                        <div class="search-btn"></div>
                    </div>
                </div>
            </div>
            
            <div class="ft-search">
                <div class="search">
                    <div class="search-input">
                        <input type="text" class="input-1" placeholder="搜尋商品"></div>
                    <div class="search-btn"></div>
                </div>
            </div>


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
                                <ul>
                                <?php 
                                    // 左側分類
                                    foreach ($proclass as $class){
                                        echo '<li>';
                                        echo "<a href=pd_query.php?pcno1={$class['no']}>";
                                        echo $class['pcname'];
                                        echo '</a>';
                                        echo '</li>';
                                    }
                                ?>
                                </ul>
                            </div>

                        </div>
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
                                    <li><input type="button" onclick="location.href='?pcno3=1';" class="tag-value-hot btn-1" value="新品上市"></li>
                                    <li><input type="button" onclick="location.href='?pcno3=2';" class="tag-value-promot btn-1" value="促銷商品"></li>
                                    <li><input type="button" onclick="location.href='?order=1';" class="tag-value-price btn-1" value="價格:低-高"></li>
                                    <li><input type="button" onclick="location.href='?order=1';" class="tag-value-price btn-1" value="價格:高-低"></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="product-area">
                            <div class="product-list">
                                <?php 
                                foreach ($products as $product){
                                    echo '<div class="pd">';
                                    echo "<a href='pd_page.php?proid=" . $product['proid'] . "'>";
                                    echo '<div class="pd-pic"><img src="img/pd_01.jpg" alt=""/></div>';
                                    echo "<div class='pd-name'>{$product['proname']}</div>";
                                    echo "<div class='pd-type'>{$product['pcname']}</div>";
                                    echo "<div class='pd-pv'>{$product['PV']}</div>";
                                    
                                    // 促銷商品
                                    if ($product['pcno3'] == 2){
                                        echo "<div class='pd-price'>促銷價${$product['price']}元</div>";
                                    }else{
                                        echo "<div class='pd-price'>價格${$product['price']}元</div>";
                                    }
                                    
                                    // 左上方的圖標
                                    if ($product['pcno3'] == 1){
                                        // 新品上市
                                        echo '<div class="tag-type"><img src="img/tag_new.png" alt=""></div>';
                                    }else if ($product['pcno3'] == 2) {
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
                
                
                <footer>
                    <div class="foot-area">  
                        <div class="foot-menu">
                            <div class="ft-logo"><a href="index.php"><br><br><br><img src="img/logo_foot.png" alt=""></a></div>
                            <div class="ft-menu-list">
                                <ul>
                                    <li><a href="ftmenu_about.php">關於我們</a></li>
                                    <li>│</li>
                                    <li><a href="ftmenu_privacy.php">隱私權條款</a></li>
                                    <li>│</li>
                                    <li><a href="ftmenu_policy.php">服務政策</a></li>
                                    <li>│</li>
                                    <li><a href="ftmenu_refund.php">退貨需知</a></li>
                                    <li>│</li>
                                    <li><a href="ftmenu_goods.php">商品寄送</a></li>
                                    <li>│</li>
                                    <li><a href="ftmenu_supplier.php">供應商資訊</a></li>
                                    <li>│</li>
                                    <li><a href="ftmenu_process.php">購物流程說明</a></li>
                                    <li>│</li>
                                    <li><a href="ftmenu_warranty.php">鑑賞期說明</a></li>
                                    <li>│</li>
                                    <li><a href="ftmenu_service.php">客服中心</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="copyright"><br><br>客服時間：AM 10:00 - PM 18:00(網路部門星期六、日公休) 快速客服專線：02-22XX-XXXX轉XX<br><br><br><br><br><br></div>
                </footer>
                
            </div>
            
        </div>
    </body>
</html>
