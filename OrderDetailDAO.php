<?php

class OrderDetailDAO
{
    // string or int 請對照資料庫
    public $ordid = null;//訂單編號(PK) 可重複
    public $odno = null;//項目流水號(PK) 不可重複

    public $proname = null;//商品名稱
    public $proid = null;//產品編號
    public $qty = null;//數量
    public $price = null;//售價
    public $subtotal = null;//小計
    public $PV = null;//PV值
    public $bonuce = null;//紅利值

    public function save($conn)
    {

        //check all data is null or not
        foreach ($this as $k => $v) {
            if ($v === null) {
                echo "存入資料庫失敗 , 欄位 $k 為 null";
                return;
            }
        }
        //check all data is null or not


        //insert to DB
        $sqlSetStr = '(';
        $sqlValueStr = '(';

        foreach ($this as $k => $v) {

            $sqlSetStr .= $k . ',';

            $sqlValueStr .= '"' . $v . '",';

        }

        $sqlSetStr = substr($sqlSetStr, 0, -1) . ")";
        $sqlValueStr = substr($sqlValueStr, 0, -1) . ")";

        $sql = 'INSERT INTO orderdetail ' . $sqlSetStr . ' VALUES ' . $sqlValueStr . ';';

//        var_dump($sql);
//        return;

//        $conn = @mysqli_connect('localhost', 'root', 'root', 'bradchao') or die("Server Busy");
//        mysqli_set_charset($conn, "UTF8");

        $result = mysqli_query($conn, $sql);
        if ($result === true) {
            echo "訂單OK";
//            header("Refresh:3;url=index.php");
        } else {
            echo "發生未預期錯誤...";
        }
//        $result->close();

    }
}