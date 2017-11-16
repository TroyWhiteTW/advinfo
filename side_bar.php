<div class=" left-move ">

    <div class="logo ">
        <a href="index.php"><img src="img/logo.jpg" style="" alt=""></a>
    </div>

    <br/>
    <br/>

    <div class="menu-area">

<!--        <ul class="fullheight" style="overflow:auto;">-->

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
                    echo '<ul class="list-group sbar">';
                    echo '<li class="list-group-item list-group-item-success c1">';
                    echo '<a href="pd_query.php?no=' . $one['no'] . '&kind=' . $kind . '&class=' . 1 . '">';
                    echo $one['pcname'] . ' ';//第一階
                    echo '</a>';
                    echo '</li>';

                    foreach ($sideRows as $two) {
                        if ($two['parent'] == $one['no'] && $one['parent'] == 0) {
                            echo '<li class="list-group-item list-group-item-info c2" style="display:none">';
                            echo '<a href="pd_query.php?no=' . $two['no'] . '&kind=' . $kind . '&class=' . 2 . '&s=' . $s . '">';
                            echo $two['pcname'] . ' ';//第二階
                            echo '</a>';
                            echo '</li>';

                            foreach ($sideRows as $three) {
                                if ($three['parent'] == $two['no'] && $two['parent'] != 0) {
                                    echo '<li class="list-group-item list-group-item-warning c3" style="display:none">';
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

<!--        </ul>-->

        <script>
            setCrossButton();
            function setCrossButton() {
                var sbars = document.getElementsByClassName('sbar');
                for (var i = 0; i < sbars.length; i++) {
                    if (sbars[i].getElementsByClassName('c2').length > 0) {
                        insertAfter(getNewSpanElement(), sbars[i].getElementsByClassName('c1')[0].getElementsByTagName('a')[0]);
                    }
                }
                var c2s = document.getElementsByClassName('c2');
                for (var j = 0; j < c2s.length; j++) {
                    if (c2s[j].nextSibling !== null && c2s[j].nextSibling.classList.contains('c3')) {
                        insertAfter(getNewSpanElement(), c2s[j].getElementsByTagName('a')[0]);
                    }
                }
            }

            function insertAfter(newNode, referenceNode) {
                referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
            }

            function getNewSpanElement() {
                var span = document.createElement('span');
                span.classList.add('glyphicon');
                span.classList.add('glyphicon-plus');
                span.style.cssText = 'cursor:pointer;';
                span.addEventListener('click', displayBar);
                return span;
            }

            function displayBar(e) {
                //變換符號
                if (e.target.classList.contains('glyphicon-plus')) {
                    e.target.classList.remove('glyphicon-plus');
                    e.target.classList.add('glyphicon-minus');
                } else {
                    e.target.classList.remove('glyphicon-minus');
                    e.target.classList.add('glyphicon-plus');
                }
                //拉伸
                toggleList(e.target.parentNode);
            }

            function toggleList(node) {
                if (node.classList.contains('c1')) {
                    var c2s = node.parentNode.getElementsByClassName('c2');
                    for (var i = 0; i < c2s.length; i++) {
                        c2ToggleHidden(c2s[i]);
                    }
                } else if (node.classList.contains('c2')) {
                    c3ToggleHidden(node.nextSibling);
                }
            }

            function c2ToggleHidden(node) {
                if (node.style.display === 'none') {
                    node.style.display = '';
                } else {
                    node.style.display = 'none';
                    var c3s = node.parentNode.getElementsByClassName('c3');
                    for (var i = 0; i < c3s.length; i++) {
                        c3s[i].style.display = 'none';
                    }
                    if (node.getElementsByTagName('span').length > 0 && node.getElementsByTagName('span')[0].classList.contains('glyphicon-minus')){
                        node.getElementsByTagName('span')[0].classList.remove('glyphicon-minus');
                        node.getElementsByTagName('span')[0].classList.add('glyphicon-plus');
                    }
                }
            }

            function c3ToggleHidden(node) {
                if (node.style.display === 'none') {
                    node.style.display = '';
                } else {
                    node.style.display = 'none';
                }
                if (node.nextSibling !== null && !node.nextSibling.classList.contains('c2')) {
                    c3ToggleHidden(node.nextSibling);
                }
            }

        </script>

    </div>

</div>