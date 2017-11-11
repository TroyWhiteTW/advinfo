<?php

class OrdersDAO
{
    // string or int 請對照資料庫
    public $ordid = null;//訂單編號(PK)1
    public $orddate = null;//訂單日期1

    public $sub_account = null;//訂購者帳號2
    public $sub_name = null;//訂購者姓名2
    public $sub_level = null;//訂購者聘級2
    public $sub_phone = null;//訂購者聯繫電話2
    public $sub_mobile = null;//訂購者手機號碼2
    public $sub_email = null;//訂購者Email2
    public $sub_address = null;//訂購者地址2

    public $rec_name = null;//收件者姓名2
    public $rec_phone = null;//收件者聯繫電話2
    public $rec_mobile = null;//收件者手機號碼2
    public $rec_email = null;//收件者Email2

    public $rec_zip = null;//配送地址(郵遞區號)2
    public $rec_city = null;//配送地址(縣市)2
    public $rec_area = null;//配送地址(區域)2
    public $rec_address = null;//配送地址2

    public $invoice = null;//發票號碼1
    public $company_no = null;//統一編號1
    public $invoice_title = null;//發票抬頭1

    public $discount = null;//折抵方式(0:不使用折抵,1:使用電子錢包折抵,2:使用紅利折抵)1
    public $discount_price = null;//折抵金額1

    public $pay_no = null;//付款方式(編號)1
    public $pay_price = null;//付款金額1
    public $ispay = null;//付款狀態(0:未付款, 1:已付款)1
    public $installment = null;//分期期數(0:無分期一次付清,3,6,12,18,24: 分期期數)1

    public $pay_time = null;//結帳時間

    public $ship_no = null;//配送方式(編號)1

    public $store_name = null;//便利商店取貨門市名稱2
    public $store_addr = null;//便利商店取貨門市地址2

    public $appredate = null;//鑑賞期日期

    public $total_price = null;//訂單總金額
    public $freight = null;//運費金額
    public $PV = null;//總PV值
    public $bonuce = null;//總紅利

    public $ordstatus = null;//訂單狀態(0:新訂單,1:處理中….9:訂單取消)
    public $shipstatus = null;//是否出貨(0:否/1:是)

    public $shiptime = null;//出貨時間
    public $addtime = null;//建立時間
    public $updatetime = null;//修改時間
    public $returnapply = null;//申請退貨時間
    public $returntime = null;//實際退貨時間
    public $refundtime = null;//退款時間

    public function save()
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

        $sql = 'INSERT INTO orders ' . $sqlSetStr . ' VALUES ' . $sqlValueStr . ';';

//        var_dump($sql);
//        return;

        $conn = @mysqli_connect('localhost', 'root', 'root', 'bradchao') or die("Server Busy");
        mysqli_set_charset($conn, "UTF8");

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