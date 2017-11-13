<div class=" left-move ">

    <div class="logo ">
        <a href="index.php"><img src="img/logo.jpg" style="" alt=""></a>
    </div>

    <div class="menu-area">

        <ul class="fullheight" style="overflow:auto;">

            <?php

            $sideBarSql = 'SELECT * FROM proclass WHERE status=1 ORDER BY sort ASC';
            $sideRows = [];
            $sideBarRes = mysqli_query($conn, $sideBarSql);
            while ($row = mysqli_fetch_assoc($sideBarRes)) {
                $sideRows[] = $row;
            }
            $sideRowsCount = count($sideRows);

            foreach ($sideRows as $one) {
                if ($one['parent'] == 0) {
                    echo '<li>';
                    echo '<a class="sidebar-menu">';
                    echo $one['pcname'];//第一階
                    echo '</a>';
                    echo '<ul class="sidebar-sub">';

                    foreach ($sideRows as $two) {
                        if ($two['parent'] == $one['no'] && $one['parent'] == 0) {
                            echo '<li>';
                            echo '<a class="sidebar-level2" href="#">';
                            echo $two['pcname'];//第二階
                            echo '</a>';
                            echo '<ul class="sidebar-sub3 ">';

                            foreach ($sideRows as $three) {
                                if ($three['parent'] == $two['no'] && $two['parent'] != 0) {
                                    echo '<li>';
                                    echo '<a href="#">';
                                    echo $three['pcname'];//第三階
                                    echo '</a>';
                                    echo '</li>';
                                }
                            }

                            echo '</ul>';
                            echo '</li>';
                        }
                    }

                    echo '</ul>';
                    echo '</li>';
                }
            }

            ?>

<!--            <hr/>-->
<!---->
<!--            <li>-->
<!---->
<!--                <a class="sidebar-menu">-->
<!--                    套裝組合-->
<!--                    <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>-->
<!--                </a>-->
<!---->
<!--                <ul class="sidebar-sub">-->
<!--                    <li>-->
<!--                        <a class="sidebar-level2" href="#">-->
<!--                            次類別一-->
<!--                            <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>-->
<!--                        </a>-->
<!--                        <ul class="sidebar-sub3 ">-->
<!--                            <li>-->
<!--                                <a href="#">-->
<!--                                    第三層類別一-->
<!--                                </a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="#">-->
<!--                                    第三層類別二-->
<!--                                </a>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a class="sidebar-level2" href="#">-->
<!--                            次類別二-->
<!--                            <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>-->
<!--                        </a>-->
<!--                        <ul class="sidebar-sub3 ">-->
<!--                            <li>-->
<!--                                <a href="#">-->
<!--                                    第三層類別一-->
<!--                                </a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="#">-->
<!--                                    第三層類別二-->
<!--                                </a>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                </ul>-->
<!---->
<!--            </li>-->
<!---->
<!--            <li>-->
<!--                <a class="sidebar-menu">-->
<!--                    膠囊類-->
<!--                    <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>-->
<!--                </a>-->
<!--                <ul class="sidebar-sub">-->
<!--                    <li>-->
<!--                        <a class="sidebar-level2" href="#">-->
<!--                            次類別一-->
<!--                            <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>-->
<!--                        </a>-->
<!--                        <ul class="sidebar-sub3 ">-->
<!--                            <li>-->
<!--                                <a href="#">-->
<!--                                    第三層類別一-->
<!--                                </a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="#">-->
<!--                                    第三層類別二-->
<!--                                </a>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </li>-->
<!---->
<!--                </ul>-->
<!--            </li>-->
<!---->
<!--            <li>-->
<!--                <a class="sidebar-menu">-->
<!--                    萃取液-->
<!--                    <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>-->
<!--                </a>-->
<!--                <ul class="sidebar-sub">-->
<!--                    <li>-->
<!--                        <a class="sidebar-level2" href="#">-->
<!--                            次類別一-->
<!--                            <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>-->
<!--                        </a>-->
<!--                        <ul class="sidebar-sub3 ">-->
<!--                            <li>-->
<!--                                <a href="#">-->
<!--                                    第三層類別一-->
<!--                                </a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="#">-->
<!--                                    第三層類別二-->
<!--                                </a>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </li>-->
<!---->
<!--                </ul>-->
<!--            </li>-->
<!---->
<!--            <li>-->
<!--                <a class="sidebar-menu">-->
<!--                    健康器材-->
<!--                    <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>-->
<!--                </a>-->
<!--                <ul class="sidebar-sub">-->
<!--                    <li>-->
<!--                        <a class="sidebar-level2" href="#">-->
<!--                            次類別一-->
<!--                            <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>-->
<!--                        </a>-->
<!--                        <ul class="sidebar-sub3 ">-->
<!--                            <li>-->
<!--                                <a href="#">-->
<!--                                    第三層類別一-->
<!--                                </a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="#">-->
<!--                                    第三層類別二-->
<!--                                </a>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </li>-->
<!---->
<!--                </ul>-->
<!--            </li>-->
<!---->
<!--            <li>-->
<!--                <a class="sidebar-menu">-->
<!--                    養身食品-->
<!--                    <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>-->
<!--                </a>-->
<!--                <ul class="sidebar-sub">-->
<!--                    <li>-->
<!--                        <a class="sidebar-level2" href="#">-->
<!--                            次類別一-->
<!--                            <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>-->
<!--                        </a>-->
<!--                        <ul class="sidebar-sub3 ">-->
<!--                            <li>-->
<!--                                <a href="#">-->
<!--                                    第三層類別一-->
<!--                                </a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="#">-->
<!--                                    第三層類別二-->
<!--                                </a>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </li>-->
<!---->
<!--                </ul>-->
<!--            </li>-->
<!---->
<!--            <li>-->
<!--                <a class="sidebar-menu">-->
<!--                    滴丸-->
<!--                    <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>-->
<!--                </a>-->
<!--                <ul class="sidebar-sub">-->
<!--                    <li>-->
<!--                        <a class="sidebar-level2" href="#">-->
<!--                            次類別一-->
<!--                            <i class="fa fa-angle-right angle-right" aria-hidden="true"></i>-->
<!--                        </a>-->
<!--                        <ul class="sidebar-sub3 ">-->
<!--                            <li>-->
<!--                                <a href="#">-->
<!--                                    第三層類別一-->
<!--                                </a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="#">-->
<!--                                    第三層類別二-->
<!--                                </a>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </li>-->
<!---->
<!--                </ul>-->
<!--            </li>-->

        </ul>

    </div>

</div>