<!-- mobile side bar -->
<div class="sidebar visible-sm visible-xs ">
    <ul class="fullheight" style="overflow:auto;">
        <?php
        // 左側分類
        foreach ($proclass as $class) {
            echo '<li>';
            echo '<a class="sidebar-menu">';

            echo $class['pcname'];
            echo '<i class="fa fa-angle-right angle-right" aria-hidden="true"></i>';

            echo '</a>';
            echo '<li>';
        }
        ?>

    </ul>
</div>
<!-- mobile side bar -->

<!-- mobile top bar -->
<div class="topbar-mobile">

    <div class="mobile-content">

        <input type="image" src="img/open_btn.png" id="left-open" class="left-open">

        <div class="icon-area">

            <ul>

                <li><a href="index.php"><div class="index-icon"></div></a></li>

                <li><a href="login.php"><div class="member-icon"></div></a></li>

                <li><a href="cart_1.php"><div class="cart-icon"></div></a></li>

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
            <li><a href="index.php">首頁<div class="index-icon"></div></a></li>

            <?php

            if ($isLogin) {
                echo '<li><a href="function_member.php">會員專區<div class="member-icon"></div></a></li>';
                echo '<li><a href="cart_1.php">購物車<div class="cart-icon"></div></a></li>';
            } else {
                echo '<li><a href="login.php">會員登入<div class="member-icon"></div></a></li>';
            }

            ?>

        </ul>

        <?php

        if ($isLogin) {
            echo '<ul><a href="logout.php"> 登出 </a></ul>';
        }

        ?>

        <div class="search show_border">
            <div class="search-input">
                <input type="text" name="input-1" id="input-1" class="input-1" placeholder="搜尋商品">
            </div>
            <div class="search-btn"></div>
        </div>

    </div>

</div>
<!-- normal top bar -->

<!-- mobile footer search bar -->
<div class="ft-search">
    <div class="search">
        <div class="search-input">
            <input type="text" name="search_input" id="search_input" class="input-1" placeholder="搜尋商品"></div>
        <div class="search-btn"></div>
    </div>
</div>
<!-- mobile footer search bar -->