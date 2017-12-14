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

    private function beforeSave($conn)
    {
        $sql = 'SELECT proname,price,PV,bonuce FROM products WHERE proid=\'' . $this->proid . '\'';
        $rs = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($rs);
        $this->proname = $row['proname'];
        $this->price = $row['price'];
        $this->subtotal = (int)$this->qty * (int)$this->price;
        $this->PV = $row['PV'];
        $this->bonuce = $row['bonuce'];
        $rs->close();

    }

    public function save(mysqli $mysqli, $errors, $odno, $conn)
    {
        $this->beforeSave(@$conn);

        $this->odno = $odno;

        //check all data is null or not
//        foreach ($this as $k => $v) {
//            if ($v === null) {
//                echo "存入資料庫失敗 , 欄位 $k 為 null";
//                return;
//            }
//        }
        //check all data is null or not


        //insert to DB
        $sqlSetStr = '(';
        $sqlValueStr = '(';

        foreach ($this as $k => $v) {

            $sqlSetStr .= $k . ',';

            $sqlValueStr .= "'" . $v . "',";

        }

        $sqlSetStr = substr($sqlSetStr, 0, -1) . ")";
        $sqlValueStr = substr($sqlValueStr, 0, -1) . ")";

        $sql = 'INSERT INTO orderdetail ' . $sqlSetStr . ' VALUES ' . $sqlValueStr . ';';

//        var_dump($sql);
//        return;

//        $conn = @mysqli_connect('localhost', 'root', 'root', 'bradchao') or die("Server Busy");
//        mysqli_set_charset($conn, "UTF8");

        $result = $mysqli->query($sql);

        if ($result === true) {
            echo "訂單OK";
            $sql2 = "SELECT stock FROM products WHERE proid = '$this->proid'";
            $rs2 = $mysqli->query($sql2);
            $stock = (int)(mysqli_fetch_assoc($rs2)['stock']);
            if ($stock - $this->qty < 0) {
                array_push($errors, 'not enough stock for order.');
            } else {
                $sql3 = "UPDATE products SET stock=$stock - $this->qty WHERE proid='$this->proid'";
                $rs3 = $mysqli->query($sql3);
                if ($rs3 === false) {
                    array_push($errors, 'update error.');
                }
            }
//            $rs2->free();
            $rs2->close();
//            header("Refresh:3;url=index.php");

            $sql5566 = 'INSERT INTO supporderdetail ' . $sqlSetStr . ' VALUES ' . $sqlValueStr . ';';
            $result5566 = $mysqli->query($sql5566);
            if ($result5566 === true) {
                echo '5566得第一';
            } else {
                echo '5566不能亡';
            }

        } else {
            array_push($errors, 'OrderDetailDAO save error.');
            echo "發生未預期錯誤...";
        }
//        $result->close();

    }
}