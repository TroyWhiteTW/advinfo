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
    <?php
			$setting = array();
			$sql = "select * from settings order by no";
			$rs = mysqli_query($conn, $sql);
			while($rst = mysqli_fetch_assoc($rs)){
				$setting[$rst["key"]] = $rst["value"];
			}
		?>
    <div class="copyright"><br><br>
    <?php
			echo '客服時間：' . $setting["serv_time"];
			echo '&nbsp;快速客服專線：' . $setting["cs_phone"];
		?>
    	<br><br><br><br><br><br>
    </div>
</footer>