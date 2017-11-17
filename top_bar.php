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

            <?php
            if ($isLogin) {
                echo '<ul>-- Hi! ' . $_SESSION['user'][2] . '-- </ul>';
            }
            ?>

            <ul>

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
                    echo '<li><a href="login.php">登入<div class="member-icon"></div></a></li>';
                }
                ?>

<!--                <li>-->
<!--                    <a href="login.php">-->
<!--                        <div class="member-icon">-->
<!--                        </div>-->
<!--                    </a>-->
<!--                </li>-->

                <li>
                    <a href="cart_1.php">
                        <div class="cart-icon">
                        </div>
                    </a>
                </li>

                <?php
                if ($isLogin) {
                    echo '<li><a href="logout.php">登出<div class="glyphicon glyphicon-log-out"></div></a></li>';
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
                    購物車
                    <div class="cart-icon">
                    </div>
                </a>
            </li>
        </ul>

        <?php
        if ($isLogin) {
            echo '<ul><a href="logout.php">登出<div class="glyphicon glyphicon-log-out"></div></a></ul>';
        }
        ?>

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
</script>
<!-- mobile footer search bar -->