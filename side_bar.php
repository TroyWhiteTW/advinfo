<div class=" left-move ">

    <div class="logo ">
        <a href="index.php"><img src="img/logo.jpg" style="" alt=""></a>
    </div>

    <br/>
    <br/>

    <div class="menu-area">

        <!-- <ul class="fullheight" style="overflow:auto;"> -->

        <?php

        $classOne = [];
        $classOneSql = 'SELECT A.no AS first_no, A.pcname AS first_name FROM proclass A WHERE A.parent=0 AND A.status=1 ORDER BY A.sort ASC';
        $classOneRes = mysqli_query($conn, $classOneSql);
        while ($classOneRow = mysqli_fetch_assoc($classOneRes)) {
            $classOne[] = $classOneRow;
        }

        $classTwo = [];
        $classTwoSql = 'SELECT A.no AS first_no, A.pcname AS first_name, B.no AS second_no, B.pcname AS second_name FROM proclass A LEFT JOIN proclass B ON A.no=B.parent WHERE A.parent=0 AND A.status=1 ORDER BY A.sort ASC, B.sort ASC';
        $classTwoRes = mysqli_query($conn, $classTwoSql);
        while ($classTwoRow = mysqli_fetch_assoc($classTwoRes)) {
            $classTwo[] = $classTwoRow;
        }

        $classThree = [];
        $classThreeSql = 'SELECT A.no AS first_no, A.pcname AS first_name, B.no AS second_no, B.pcname AS second_name, C.no AS third_no, C.pcname AS third_name FROM proclass A LEFT JOIN proclass B ON A.no=B.parent LEFT JOIN proclass C ON B.no=C.parent WHERE A.parent=0 AND A.status=1 ORDER BY A.sort ASC, B.sort ASC, C.sort ASC';
        $classThreeRes = mysqli_query($conn, $classThreeSql);
        while ($classThreeRow = mysqli_fetch_assoc($classThreeRes)) {
            $classThree[] = $classThreeRow;
        }

        foreach ($classOne as $item1) {
            echo '<ul class="list-group sbar">';

            echo '<li class="list-group-item list-group-item-success c1">';
            echo '<a href="pd_query.php?first=' . $item1['first_no'] . '&second=0&third=0">';
            echo $item1['first_name'].' ';
            echo '</a>';
            echo '</li>';

            foreach ($classTwo as $item2) {
                if ($item2['first_no'] == $item1['first_no']) {
                    echo '<li class="list-group-item list-group-item-info c2" style="display:none">';
                    echo '<a href="pd_query.php?first=' . $item1['first_no'] . '&second=' . $item2['second_no'] . '&third=0">';
                    echo $item2['second_name'].' ';
                    echo '</a>';
                    echo '</li>';

                    foreach ($classThree as $item3) {
                        if ($item3['second_no'] == $item2['second_no']) {
                            echo '<li class="list-group-item list-group-item-warning c3" style="display:none">';
                            echo '<a href="pd_query.php?first=' . $item1['first_no'] . '&second=' . $item2['second_no'] . '&third=' . $item3['third_no'] . '">';
                            echo $item3['third_name'].' ';
                            echo '</a>';
                            echo '</li>';
                        }
                    }
                }
            }

            echo '</ul>';
        }

        ?>

        <!-- </ul> -->

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
                    if (node.getElementsByTagName('span').length > 0 && node.getElementsByTagName('span')[0].classList.contains('glyphicon-minus')) {
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