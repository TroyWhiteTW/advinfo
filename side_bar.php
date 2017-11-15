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

            foreach ($sideRows as $one) {
                if ($one['parent'] == 0) {
                    echo '<ul class="list-group">';
                    echo '<li class="list-group-item list-group-item-success">';
                    echo '<a href="pd_query.php?kind=' . $kind . '&class=' . 1 . '">';
                    echo $one['pcname'];//第一階
                    echo '</a>';
                    echo '</li>';

                    foreach ($sideRows as $two) {
                        if ($two['parent'] == $one['no'] && $one['parent'] == 0) {
                            echo '<li class="list-group-item list-group-item-info">';
                            echo '<a href="pd_query.php?kind=' . $kind . '&class=' . 2 . '">';
                            echo $two['pcname'];//第二階
                            echo '</a>';
                            echo '</li>';

                            foreach ($sideRows as $three) {
                                if ($three['parent'] == $two['no'] && $two['parent'] != 0) {
                                    echo '<li class="list-group-item list-group-item-warning"">';
                                    echo '<a href="pd_query.php?kind=' . $kind . '&class=' . 3 . '">';
                                    echo $three['pcname'];//第三階
                                    echo '</a>';
                                    echo '</li>';
                                }
                            }

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