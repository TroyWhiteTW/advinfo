<?php

class OrdersDAO
{
    public $ordid = null;//訂單編號(PK)
    public $orddate = null;//訂單日期
    public $sub_account = null;//訂購者帳號
    public $sub_name = null;//訂購者姓名
    public $sub_level = null;//訂購者聘級
    public $sub_phone = null;//訂購者聯繫電話
    public $sub_mobile = null;//訂購者手機號碼
    public $sub_email = null;//訂購者Email
    public $sub_address = null;//訂購者地址
    public $rec_name = null;//收件者姓名
    public $rec_phone = null;//收件者聯繫電話
    public $rec_mobile = null;//收件者手機號碼
    public $rec_email = null;//收件者Email
    public $rec_zip = null;//配送地址(郵遞區號)
    public $rec_city = null;//配送地址(縣市)
    public $rec_area = null;//	配送地址(區域)
    public $rec_address = null;//配送地址
    public $invoice = null;//發票號碼
    public $company_no = null;//統一編號
    public $invoice_title = null;//發票抬頭
    public $discount = null;//折抵方式(0:不使用折抵,1:使用電子錢包折抵,2:使用紅利折抵)
    public $discount_price = null;//折抵金額
    public $pay_no = null;//付款方式(編號)
    public $pay_price = null;//付款金額
    public $ispay = null;//付款狀態(0:未付款, 1:已付款)
    public $installment = null;//分期期數(0:無分期一次付清,3,6,12,18,24: 分期期數)
    public $pay_time = null;//結帳時間
    public $ship_no = null;//配送方式(編號)
    public $store_name = null;//便利商店取貨門市名稱
    public $store_addr = null;//便利商店取貨門市地址
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


        //insert to DB


    }
}