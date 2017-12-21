<!-- mobile side bar -->
<div class="sidebar visible-sm visible-xs ">
    <ul class="fullheight" style="overflow:auto;">
        <?php include 'side_bar2.php'; ?>
    </ul>
</div>
<!-- mobile side bar -->

<!-- mobile top bar -->
<div class="topbar-mobile">

    <div class="mobile-content">

        <input type="image" src="img/open_btn.png" id="left-open" class="left-open">

        <div class="icon-area">

            <ul>

                <?php
                if ($isLogin) {
                    echo '<li>-- Hi! ' . $_SESSION['user'][2] . '-- </li>';
                }
                ?>

                <li>
                    <a href="index.php">
                        <div class="index-icon">
                        </div>
                    </a>
                </li>

                <?php
                if ($isLogin) {
                    echo '<li><a href="function_member.php"><div class="member-icon"></div></a></li>';
                } else {
                    echo '<li><a href="login.php"><div class="member-icon"></div></a></li>';
                }
                ?>

                <li>
                    <a href="cart_1.php">
                        <div class="cart-icon">
                        </div>
                    </a>
                </li>

                <?php
                if ($isLogin) {
                    echo '<li><a href="#" onclick="logout(); return false;">登出</a></li>';
                }
                ?>

            </ul>

        </div>

    </div>

</div>
<!-- mobile top bar -->

<!-- normal top bar -->
<div class="topbar">

    <div class="top-content ">

        <?php
        if ($isLogin) {
            echo '<ul>-- Hi! ' . $_SESSION['user'][2] . '-- </ul>';
        }
        ?>

        <ul>
            <li>
                <a href="index.php">
                    首頁
                    <div class="index-icon">
                    </div>
                </a>
            </li>

            <?php
            if ($isLogin) {
                echo '<li><a href="function_member.php">會員專區<div class="member-icon"></div></a></li>';
//                echo '<li><a href="cart_1.php">購物車<div class="cart-icon"></div></a></li>';
            } else {
                echo '<li><a href="login.php">會員登入<div class="member-icon"></div></a></li>';
            }
            ?>

            <li>
                <a href="cart_1.php">
										購物車(<span id="cartNum"><?=count($_SESSION['shop_cart'])?></span>)
                    <div class="cart-icon"></div>
                </a>
            </li>

            <?php
            if ($isLogin) {
                echo '<li><a href="#" onclick="logout(); return false;">登出</a></li>';
            }
            ?>

        </ul>

        <div class="search show_border">
            <form id="search_form1" method="get" action="pd_search.php">
                <div class="search-input">
                    <input type="text" name="search" id="" class="input-1" placeholder="搜尋商品">
                </div>
                <input type="submit" class="search-btn" value="">
            </form>
        </div>

        <script>
            document.getElementById('search_form1').addEventListener('submit', function (e) {
                var searchWord = e.target.getElementsByClassName('input-1')[0].value;
                if (searchWord.trim() === "") {
                    alert('請輸入欲搜索的商品名稱');
                    e.preventDefault();
                }
            });
        </script>

    </div>

</div>
<!-- normal top bar -->

<!-- mobile footer search bar -->
<div class="ft-search">
    <div class="search">
        <form id="search_form" method="get" action="pd_search.php">
            <div class="search-input">
                <input type="text" name="search" id="" class="input-1" placeholder="搜尋商品"></div>
            <input type="submit" class="search-btn" value="">
        </form>
    </div>
</div>
<script>
	document.getElementById('search_form').addEventListener('submit', function (e) {
			var searchWord = e.target.getElementsByClassName('input-1')[0].value;
			if (searchWord.trim() === "") {
					alert('請輸入欲搜索的商品名稱');
					e.preventDefault();
			}
	});
	
	function logout(){
			if(confirm("確定登出嗎?")){location.href="logout.php";}
	}
</script>
<!-- mobile footer search bar -->