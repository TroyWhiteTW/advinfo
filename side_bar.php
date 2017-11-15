<div class=" left-move ">

    <div class="logo ">
        <a href="index.php"><img src="img/logo.jpg" style="" alt=""></a>
    </div>

    <br/>
    <br/>

    <div class="menu-area">

        <ul class="fullheight" style="overflow:auto;">

            <?php

            $sideBarSql = 'SELECT * FROM proclass WHERE status=1 ORDER BY sort ASC';
            $sideRows = [];
            $sideBarRes = mysqli_query($conn, $sideBarSql);
            while ($row = mysqli_fetch_assoc($sideBarRes)) {
                $sideRows[] = $row;
            }

            $kind = 0;
            $s = 1;
            $t = 1;

            foreach ($sideRows as $one) {
                if ($one['parent'] == 0) {
                    echo '<ul class="list-group">';
                    echo '<li class="list-group-item list-group-item-success">';
                    echo '<a href="pd_query.php?no=' . $one['no'] . '&kind=' . $kind . '&class=' . 1 . '">';
                    echo $one['pcname'];//第一階
                    echo '</a>';
                    echo '</li>';

                    foreach ($sideRows as $two) {
                        if ($two['parent'] == $one['no'] && $one['parent'] == 0) {
                            echo '<li class="list-group-item list-group-item-info">';
                            echo '<a href="pd_query.php?no=' . $two['no'] . '&kind=' . $kind . '&class=' . 2 . '&s=' . $s . '">';
                            echo $two['pcname'];//第二階
                            echo '</a>';
                            echo '</li>';

                            foreach ($sideRows as $three) {
                                if ($three['parent'] == $two['no'] && $two['parent'] != 0) {
                                    echo '<li class="list-group-item list-group-item-warning"">';
                                    echo '<a href="pd_query.php?no=' . $three['no'] . '&kind=' . $kind . '&class=' . 3 . '&s=' . $s . '&t=' . $t . '">';
                                    echo $three['pcname'];//第三階
                                    echo '</a>';
                                    echo '</li>';
                                    $t++;
                                }
                            }

                            $s++;
                        }
                    }

                    echo '</ul>';
                    $kind++;
                }
            }

            ?>

        </ul>

    </div>

</div>