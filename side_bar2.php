<div class=" left-move ">

    <div class="menu-area" style="font-size: 2em">

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
            echo '<ul class="list-group sbar2">';

            echo '<li class="list-group-item list-group-item-success cc1">';
            echo '<a href="pd_query.php?first=' . $item1['first_no'] . '&second=0&third=0">';
            echo $item1['first_name'].' ';
            echo '</a>';
            echo '</li>';

            foreach ($classTwo as $item2) {
                if ($item2['first_no'] == $item1['first_no']) {
                    echo '<li class="list-group-item list-group-item-info cc2" style="display:none">';
                    echo '<a href="pd_query.php?first=' . $item1['first_no'] . '&second=' . $item2['second_no'] . '&third=0">';
                    echo $item2['second_name'].' ';
                    echo '</a>';
                    echo '</li>';

                    foreach ($classThree as $item3) {
                        if ($item3['second_no'] == $item2['second_no']) {
                            echo '<li class="list-group-item list-group-item-warning cc3" style="display:none">';
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
            setCrossButton2();

            function setCrossButton2() {
                var sbar2s = document.getElementsByClassName('sbar2');
                for (var i = 0; i < sbar2s.length; i++) {
                    if (sbar2s[i].getElementsByClassName('cc2').length > 0) {
                        insertAfter2(getNewSpanElement2(), sbar2s[i].getElementsByClassName('cc1')[0].getElementsByTagName('a')[0]);
                    }
                }
                var cc2s = document.getElementsByClassName('cc2');
                for (var j = 0; j < cc2s.length; j++) {
                    if (cc2s[j].nextSibling !== null && cc2s[j].nextSibling.classList.contains('cc3')) {
                        insertAfter2(getNewSpanElement2(), cc2s[j].getElementsByTagName('a')[0]);
                    }
                }
            }

            function insertAfter2(newNode, referenceNode) {
                referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
            }

            function getNewSpanElement2() {
                var span = document.createElement('span');
                span.classList.add('glyphicon');
                span.classList.add('glyphicon-plus');
                span.style.cssText = 'cursor:pointer;';
                span.addEventListener('click', displayBar2);
                return span;
            }

            function displayBar2(e) {
                //變換符號
                if (e.target.classList.contains('glyphicon-plus')) {
                    e.target.classList.remove('glyphicon-plus');
                    e.target.classList.add('glyphicon-minus');
                } else {
                    e.target.classList.remove('glyphicon-minus');
                    e.target.classList.add('glyphicon-plus');
                }
                //拉伸
                toggleList2(e.target.parentNode);
            }

            function toggleList2(node) {
                if (node.classList.contains('cc1')) {
                    var cc2s = node.parentNode.getElementsByClassName('cc2');
                    for (var i = 0; i < cc2s.length; i++) {
                        cc2ToggleHidden2(cc2s[i]);
                    }
                } else if (node.classList.contains('cc2')) {
                    cc3ToggleHidden2(node.nextSibling);
                }
            }

            function cc2ToggleHidden2(node) {
                if (node.style.display === 'none') {
                    node.style.display = '';
                } else {
                    node.style.display = 'none';
                    var cc3s = node.parentNode.getElementsByClassName('cc3');
                    for (var i = 0; i < cc3s.length; i++) {
                        cc3s[i].style.display = 'none';
                    }
                    if (node.getElementsByTagName('span').length > 0 && node.getElementsByTagName('span')[0].classList.contains('glyphicon-minus')) {
                        node.getElementsByTagName('span')[0].classList.remove('glyphicon-minus');
                        node.getElementsByTagName('span')[0].classList.add('glyphicon-plus');
                    }
                }
            }

            function cc3ToggleHidden2(node) {
                if (node.style.display === 'none') {
                    node.style.display = '';
                } else {
                    node.style.display = 'none';
                }
                if (node.nextSibling !== null && !node.nextSibling.classList.contains('cc2')) {
                    cc3ToggleHidden2(node.nextSibling);
                }
            }

        </script>

    </div>

</div>