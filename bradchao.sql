-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- 主機: localhost:3306
-- 產生時間： 2017 年 11 月 06 日 15:52
-- 伺服器版本: 5.6.36-cll-lve
-- PHP 版本： 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `bradchao_ bradchao`
--

-- --------------------------------------------------------

--
-- 資料表結構 `banners`
--

CREATE TABLE `banners` (
  `no` int(11) NOT NULL COMMENT '流水號(PK)',
  `name` varchar(29) NOT NULL COMMENT '輪播名稱',
  `pic` varchar(50) NOT NULL COMMENT '圖片檔名',
  `url` varchar(200) NOT NULL COMMENT '連結URL',
  `sort` int(11) NOT NULL DEFAULT '1' COMMENT '順序(1最小)',
  `status` char(1) NOT NULL COMMENT '狀態(0:下架，1:上架)',
  `lang` varchar(10) NOT NULL COMMENT '語系代碼',
  `addtime` datetime NOT NULL COMMENT '建立時間',
  `updatetime` datetime NOT NULL COMMENT '修改時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='輪播橫幅';

-- --------------------------------------------------------

--
-- 資料表結構 `members`
--

CREATE TABLE `members` (
  `id` varchar(20) NOT NULL COMMENT '會員編號(zjttw_xxxxxxxxx) (PK)',
  `password` varchar(100) NOT NULL COMMENT '密碼(MD5編碼後存放)',
  `name` varchar(20) NOT NULL COMMENT '姓名',
  `gender` varchar(1) NOT NULL COMMENT '性別(M/F)',
  `level` varchar(10) NOT NULL COMMENT '聘級',
  `referral` varchar(20) NOT NULL COMMENT '推薦者帳號',
  `birthday` date NOT NULL COMMENT '會員生日',
  `email` varchar(50) NOT NULL COMMENT '電子信箱 (為會員帳號)',
  `phone` varchar(10) NOT NULL COMMENT '聯繫電話',
  `mobile` varchar(10) NOT NULL COMMENT '手機',
  `company_no` varchar(10) NOT NULL COMMENT '統一編號',
  `invoice_title` varchar(100) NOT NULL COMMENT '發票抬頭',
  `city` varchar(20) NOT NULL COMMENT '聯繫地址(縣市)',
  `area` varchar(20) NOT NULL COMMENT '聯繫地址(鄉鎮區)',
  `address` varchar(200) NOT NULL COMMENT '聯繫地址',
  `constore` varchar(50) NOT NULL COMMENT '常用便利商店門市',
  `regtime` datetime NOT NULL COMMENT '註冊時間',
  `verifycode` varchar(10) NOT NULL COMMENT '手機驗證碼',
  `verifytime` datetime NOT NULL COMMENT '驗證時間',
  `resaletime` datetime NOT NULL COMMENT '完成重銷時間',
  `type` char(1) NOT NULL COMMENT '會員類別(1:一般會員,2:直銷會員)',
  `status` char(1) NOT NULL COMMENT '會員狀態(0:未驗證,1:已驗證,9:停用)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='會員資料';

-- --------------------------------------------------------

--
-- 資料表結構 `orderdetail`
--

CREATE TABLE `orderdetail` (
  `ordid` varchar(20) NOT NULL COMMENT '訂單編號(PK)',
  `odno` int(11) NOT NULL COMMENT '項目流水號(PK)',
  `proname` varchar(50) NOT NULL COMMENT '商品名稱',
  `proid` varchar(20) NOT NULL COMMENT '產品編號',
  `qty` int(11) NOT NULL COMMENT '數量',
  `price` int(11) NOT NULL COMMENT '售價',
  `subtotal` int(11) NOT NULL COMMENT '小計',
  `PV` int(11) NOT NULL DEFAULT '0' COMMENT 'PV值',
  `bonuce` int(11) NOT NULL DEFAULT '0' COMMENT '紅利值'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='訂單子表';

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE `orders` (
  `ordid` varchar(20) NOT NULL COMMENT '訂單編號(PK)',
  `orddate` date NOT NULL COMMENT '訂單日期',
  `sub_account` varchar(20) NOT NULL COMMENT '訂購者帳號',
  `sub_name` varchar(20) NOT NULL COMMENT '訂購者姓名',
  `sub_level` varchar(10) NOT NULL COMMENT '訂購者聘級',
  `sub_phone` varchar(10) NOT NULL COMMENT '訂購者聯繫電話',
  `sub_mobile` varchar(10) NOT NULL COMMENT '訂購者手機號碼',
  `sub_email` varchar(50) NOT NULL COMMENT '訂購者Email',
  `sub_address` varchar(250) NOT NULL COMMENT '訂購者地址',
  `rec_name` varchar(20) NOT NULL COMMENT '收件者姓名',
  `rec_phone` varchar(10) NOT NULL COMMENT '收件者聯繫電話',
  `rec_mobile` varchar(10) NOT NULL COMMENT '收件者手機號碼',
  `rec_email` varchar(50) NOT NULL COMMENT '收件者Email',
  `rec_zip` varchar(5) NOT NULL COMMENT '配送地址(郵遞區號)',
  `rec_city` varchar(10) NOT NULL COMMENT '配送地址(縣市)',
  `rec_area` varchar(10) NOT NULL COMMENT '配送地址(區域)',
  `rec_address` varchar(100) NOT NULL COMMENT '配送地址',
  `invoice` varchar(20) NOT NULL COMMENT '發票號碼',
  `company_no` varchar(10) NOT NULL COMMENT '統一編號',
  `invoice_title` varchar(100) NOT NULL COMMENT '發票抬頭',
  `discount` varchar(20) NOT NULL COMMENT '折抵方式(0:不使用折抵,1:使用電子錢包折抵,2:使用紅利折抵)',
  `discount_price` int(11) NOT NULL COMMENT '折抵金額',
  `pay_no` int(11) NOT NULL COMMENT '付款方式(編號)',
  `pay_price` int(11) NOT NULL COMMENT '付款金額',
  `ispay` char(1) NOT NULL COMMENT '付款狀態(0:未付款, 1:已付款)',
  `installment` smallint(6) NOT NULL COMMENT '分期期數(0:無分期一次付清,3,6,12,18,24: 分期期數)',
  `pay_time` datetime NOT NULL COMMENT '結帳時間',
  `ship_no` int(11) NOT NULL COMMENT '配送方式(編號)',
  `store_name` varchar(50) NOT NULL COMMENT '便利商店取貨門市名稱',
  `store_addr` varchar(200) NOT NULL COMMENT '便利商店取貨門市地址',
  `appredate` datetime NOT NULL COMMENT '鑑賞期日期',
  `total_price` int(11) NOT NULL COMMENT '訂單總金額',
  `freight` int(11) NOT NULL COMMENT '運費金額',
  `PV` int(11) NOT NULL COMMENT '總PV值',
  `bonuce` int(11) NOT NULL COMMENT '總紅利',
  `ordstatus` char(1) NOT NULL COMMENT '訂單狀態(0:新訂單,1:處理中….9:訂單取消)',
  `shipstatus` char(1) NOT NULL COMMENT '是否出貨(0:否/1:是)',
  `shiptime` datetime NOT NULL COMMENT '出貨時間',
  `addtime` datetime NOT NULL COMMENT '建立時間',
  `updatetime` datetime NOT NULL COMMENT '修改時間',
  `returnapply` datetime NOT NULL COMMENT '申請退貨時間',
  `returntime` datetime NOT NULL COMMENT '實際退貨時間',
  `refundtime` datetime NOT NULL COMMENT '退款時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='訂單主表';

-- --------------------------------------------------------

--
-- 資料表結構 `proclass`
--

CREATE TABLE `proclass` (
  `no` int(11) NOT NULL COMMENT '類別編號 (PK)',
  `parent` int(11) NOT NULL COMMENT '上層編號(0:主類別，>0: 次類別)',
  `pcname` varchar(50) NOT NULL COMMENT '類別名稱',
  `sort` int(11) NOT NULL DEFAULT '1' COMMENT '類別順序(1最小)',
  `status` char(1) NOT NULL COMMENT '類別狀態(0:下架，1:上架)',
  `lang` varchar(10) NOT NULL COMMENT '語系代碼',
  `addtime` datetime NOT NULL COMMENT '建立時間',
  `updatetime` datetime NOT NULL COMMENT '修改時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品類別';

-- --------------------------------------------------------

--
-- 資料表結構 `productclass`
--

CREATE TABLE `productclass` (
  `no` int(11) NOT NULL COMMENT '圖片流水號(PK)',
  `proid` varchar(10) NOT NULL COMMENT '商品編號',
  `pcno1` int(11) NOT NULL COMMENT '商品類別編號(第1層)',
  `pcno2` int(11) NOT NULL COMMENT '商品類別編號(第2層)',
  `pcno3` int(11) NOT NULL COMMENT '商品類別編號(第3層)',
  `addtime` datetime NOT NULL COMMENT '建立時間',
  `updatetime` datetime NOT NULL COMMENT '修改時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `products`
--

CREATE TABLE `products` (
  `proid` varchar(20) NOT NULL COMMENT '商品編號 (PK)',
  `suppid` varchar(20) NOT NULL COMMENT '供應商ID',
  `proname` varchar(50) NOT NULL COMMENT '商品名稱',
  `prointro` varchar(100) NOT NULL COMMENT '商品簡短說明',
  `pcno` int(11) NOT NULL COMMENT '商品主類別',
  `price` int(11) NOT NULL COMMENT '價格',
  `PV` int(11) NOT NULL COMMENT 'PV值',
  `bonuce` int(11) NOT NULL COMMENT '紅利',
  `stock` int(11) NOT NULL COMMENT '庫存量',
  `prodetail` text NOT NULL COMMENT '商品詳細說明',
  `protags` int(11) NOT NULL COMMENT '標籤編號(單選、標記效果) ',
  `weight` varchar(20) NOT NULL COMMENT '商品重量',
  `size` varchar(50) NOT NULL COMMENT '商品長寬高',
  `promo_start` datetime NOT NULL COMMENT '促銷起始時間',
  `promo_end` datetime NOT NULL COMMENT '促銷結束時間',
  `promo_price` int(11) NOT NULL COMMENT '促銷價格',
  `promo_PV` int(11) NOT NULL COMMENT '促銷PV值',
  `promo_bonuce` int(11) NOT NULL COMMENT '促銷紅利值',
  `uptime` datetime NOT NULL COMMENT '上架時間',
  `downtime` datetime NOT NULL COMMENT '下架時間',
  `memo` varchar(250) NOT NULL COMMENT '備註',
  `checkmemo` varchar(250) NOT NULL COMMENT '審核說明',
  `checktime` datetime NOT NULL COMMENT '審核時間',
  `status` char(1) NOT NULL DEFAULT '1' COMMENT '商品狀態(0:審核未通過,1:待審核,2:審核通過,3:上架,9:下架)',
  `lang` varchar(10) NOT NULL COMMENT '語系代碼',
  `viewcounts` int(11) NOT NULL DEFAULT '0' COMMENT '瀏覽次數',
  `addtime` datetime NOT NULL COMMENT '建立時間',
  `updatetime` datetime NOT NULL COMMENT '修改時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品資料';

-- --------------------------------------------------------

--
-- 資料表結構 `protags`
--

CREATE TABLE `protags` (
  `no` int(11) NOT NULL COMMENT '標籤編號(流水號) ',
  `name` varchar(20) NOT NULL COMMENT '標籤名稱',
  `pic` varchar(50) NOT NULL COMMENT '圖片檔名',
  `color` varchar(10) NOT NULL COMMENT '標籤色碼',
  `sort` int(11) NOT NULL DEFAULT '1' COMMENT '標籤順序(1最小)',
  `lang` varchar(10) NOT NULL COMMENT '語系代碼',
  `addtime` datetime NOT NULL COMMENT '建立時間',
  `updatetime` datetime NOT NULL COMMENT '修改時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`no`);

--
-- 資料表索引 `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`ordid`,`odno`);

--
-- 資料表索引 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ordid`);

--
-- 資料表索引 `proclass`
--
ALTER TABLE `proclass`
  ADD PRIMARY KEY (`no`);

--
-- 資料表索引 `productclass`
--
ALTER TABLE `productclass`
  ADD PRIMARY KEY (`no`);

--
-- 資料表索引 `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`proid`);

--
-- 資料表索引 `protags`
--
ALTER TABLE `protags`
  ADD PRIMARY KEY (`no`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `banners`
--
ALTER TABLE `banners`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號(PK)', AUTO_INCREMENT=4;
--
-- 使用資料表 AUTO_INCREMENT `proclass`
--
ALTER TABLE `proclass`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT COMMENT '類別編號 (PK)', AUTO_INCREMENT=13;
--
-- 使用資料表 AUTO_INCREMENT `productclass`
--
ALTER TABLE `productclass`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT COMMENT '圖片流水號(PK)', AUTO_INCREMENT=3;
--
-- 使用資料表 AUTO_INCREMENT `protags`
--
ALTER TABLE `protags`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT COMMENT '標籤編號(流水號) ', AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
