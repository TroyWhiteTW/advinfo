-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- 主機: localhost:3306
-- 建立日期: 2017 年 11 月 01 日 00:57
-- 伺服器版本: 5.6.36-cll-lve
-- PHP 版本: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫: `bradchao`
--

-- --------------------------------------------------------

--
-- 資料表結構 `banners`
--

CREATE TABLE IF NOT EXISTS `banners` (
  `no` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號(PK)',
  `name` varchar(29) NOT NULL COMMENT '輪播名稱',
  `pic` varchar(50) NOT NULL COMMENT '圖片檔名',
  `url` varchar(200) NOT NULL COMMENT '連結URL',
  `sort` int(11) NOT NULL DEFAULT '1' COMMENT '順序(1最小)',
  `status` char(1) NOT NULL COMMENT '狀態(0:下架，1:上架)',
  `lang` varchar(10) NOT NULL COMMENT '語系代碼',
  `addtime` datetime NOT NULL COMMENT '建立時間',
  `updatetime` datetime NOT NULL COMMENT '修改時間',
  PRIMARY KEY (`no`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='輪播橫幅' AUTO_INCREMENT=4 ;

--
-- 資料表的匯出資料 `banners`
--

INSERT INTO `banners` (`no`, `name`, `pic`, `url`, `sort`, `status`, `lang`, `addtime`, `updatetime`) VALUES
(1, 'test1', 'br_01.jpg', 'http://www.bradchao.com', 1, '1', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'test2', 'br_02.jpg', 'http://www.bradchao.com', 1, '1', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'test3', 'br_03.jpg', 'http://www.bradchao.com', 1, '1', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 資料表結構 `cstypes`
--

CREATE TABLE IF NOT EXISTS `cstypes` (
  `no` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號(PK)',
  `name` varchar(20) NOT NULL COMMENT '問題類別名稱',
  `lang` varchar(10) NOT NULL COMMENT '語系代碼',
  `addtime` datetime NOT NULL COMMENT '建立時間',
  `updatetime` datetime NOT NULL COMMENT '修改時間',
  PRIMARY KEY (`no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='客服問題類別' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 資料表結構 `customerservices`
--

CREATE TABLE IF NOT EXISTS `customerservices` (
  `no` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號(PK)',
  `cstype_no` int(11) NOT NULL COMMENT '問題分類編號',
  `content` text NOT NULL COMMENT '問題內容',
  `name` varchar(50) NOT NULL COMMENT '姓名',
  `phone` varchar(20) NOT NULL COMMENT '電話',
  `email` varchar(50) NOT NULL COMMENT '電子信箱',
  `reply` text NOT NULL COMMENT '回電答覆內容',
  `status` char(1) NOT NULL COMMENT '單據狀態',
  `addtime` datetime NOT NULL COMMENT '建立時間',
  `updatetime` datetime NOT NULL COMMENT '修改時間',
  PRIMARY KEY (`no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='客服資料' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 資料表結構 `floginlogs`
--

CREATE TABLE IF NOT EXISTS `floginlogs` (
  `no` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號(PK)',
  `account` varchar(20) NOT NULL COMMENT '會員帳號',
  `action` varchar(20) NOT NULL COMMENT '動作',
  `addtime` datetime NOT NULL COMMENT '建立時間',
  PRIMARY KEY (`no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='前台會員登入紀錄' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 資料表結構 `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `no` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號(PK)',
  `lang` varchar(10) NOT NULL COMMENT '語系代碼',
  `name` varchar(10) NOT NULL COMMENT '語系名稱',
  `addtime` datetime NOT NULL COMMENT '建立時間',
  `updatetime` datetime NOT NULL COMMENT '修改時間',
  PRIMARY KEY (`no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='語系資料' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 資料表結構 `logistics`
--

CREATE TABLE IF NOT EXISTS `logistics` (
  `no` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號(PK)',
  `name` varchar(50) NOT NULL COMMENT '物流業者名稱',
  `pic` varchar(50) NOT NULL COMMENT '圖片檔名',
  `addtime` datetime NOT NULL COMMENT '建立時間',
  `updatetime` datetime NOT NULL COMMENT '修改時間',
  PRIMARY KEY (`no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='物流業者資料' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 資料表結構 `managerlogs`
--

CREATE TABLE IF NOT EXISTS `managerlogs` (
  `no` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號(PK)',
  `account` varchar(20) NOT NULL COMMENT '管理者帳號',
  `action` varchar(20) NOT NULL COMMENT '動作',
  `table` varchar(20) NOT NULL COMMENT '資料表名稱',
  `data` text NOT NULL COMMENT '寫入資料內容',
  `addtime` datetime NOT NULL COMMENT '建立時間',
  PRIMARY KEY (`no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='後台管理者操作紀錄' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 資料表結構 `managers`
--

CREATE TABLE IF NOT EXISTS `managers` (
  `no` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號(PK)',
  `name` varchar(20) NOT NULL COMMENT '管理者姓名',
  `account` varchar(20) NOT NULL COMMENT '帳號',
  `password` varchar(20) NOT NULL COMMENT '密碼',
  `rights` int(11) NOT NULL COMMENT '權限設定',
  `status` char(1) NOT NULL COMMENT '啟用(0:停用，1:啟用)',
  `addtime` datetime NOT NULL COMMENT '建立時間',
  `updatetime` datetime NOT NULL COMMENT '修改時間',
  PRIMARY KEY (`no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='後台管理員權限' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 資料表結構 `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `account` varchar(20) NOT NULL COMMENT '帳號(zjttw_xxxxxxxxx) (PK)',
  `password` varchar(20) NOT NULL COMMENT '密碼(MD5編碼後存放)',
  `name` varchar(20) NOT NULL COMMENT '姓名',
  `gender` varchar(1) NOT NULL COMMENT '性別(M/F)',
  `level` varchar(10) NOT NULL COMMENT '聘級',
  `referral` varchar(20) NOT NULL COMMENT '推薦者帳號',
  `email` varchar(50) NOT NULL COMMENT '電子信箱',
  `phone` varchar(10) NOT NULL COMMENT '聯繫電話',
  `mobile` varchar(10) NOT NULL COMMENT '手機',
  `company_no` varchar(10) NOT NULL COMMENT '統一編號',
  `invoice_title` varchar(100) NOT NULL COMMENT '發票抬頭',
  `address` varchar(200) NOT NULL COMMENT '聯繫地址',
  `constore` varchar(50) NOT NULL COMMENT '常用便利商店門市',
  `regtime` datetime NOT NULL COMMENT '註冊時間',
  `verifycode` varchar(10) NOT NULL COMMENT '手機驗證碼',
  `verifytime` datetime NOT NULL COMMENT '驗證時間',
  `type` char(1) NOT NULL COMMENT '會員類別(1:一般會員,2:直銷會員)',
  `status` char(1) NOT NULL COMMENT '會員狀態(0:未驗證,1:已驗證,9:停用)',
  PRIMARY KEY (`account`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='會員資料';

-- --------------------------------------------------------

--
-- 資料表結構 `moneyflows`
--

CREATE TABLE IF NOT EXISTS `moneyflows` (
  `no` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號(PK)',
  `name` varchar(50) NOT NULL COMMENT '金流業者名稱',
  `pic` varchar(50) NOT NULL COMMENT '圖片檔名',
  `addtime` datetime NOT NULL COMMENT '建立時間',
  `updatetime` datetime NOT NULL COMMENT '修改時間',
  PRIMARY KEY (`no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='金流業者資料' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 資料表結構 `orderdetail`
--

CREATE TABLE IF NOT EXISTS `orderdetail` (
  `ordid` varchar(20) NOT NULL COMMENT '訂單編號(PK)',
  `odno` int(11) NOT NULL COMMENT '項目流水號(PK)',
  `proname` varchar(50) NOT NULL COMMENT '商品名稱',
  `proid` varchar(20) NOT NULL COMMENT '產品編號',
  `qty` int(11) NOT NULL COMMENT '數量',
  `price` int(11) NOT NULL COMMENT '售價',
  `subtotal` int(11) NOT NULL COMMENT '小計',
  PRIMARY KEY (`ordid`,`odno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='訂單子表';

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `ordid` varchar(20) NOT NULL COMMENT '訂單編號(PK)',
  `orddate` date NOT NULL COMMENT '訂單日期',
  `sub_account` varchar(20) NOT NULL COMMENT '訂購者帳號',
  `sub_name` varchar(20) NOT NULL COMMENT '訂購者姓名',
  `sub_gender` varchar(1) NOT NULL COMMENT '訂購者性別(M/F)',
  `sub_level` varchar(10) NOT NULL COMMENT '訂購者聘級',
  `sub_phone` varchar(10) NOT NULL COMMENT '訂購者聯繫電話',
  `sub_mobile` varchar(10) NOT NULL COMMENT '訂購者手機號碼',
  `rec_name` varchar(20) NOT NULL COMMENT '收件者姓名',
  `rec_gender` varchar(1) NOT NULL COMMENT '收件者性別(M/F)',
  `rec_phone` varchar(10) NOT NULL COMMENT '收件者聯繫電話',
  `rec_mobile` varchar(10) NOT NULL COMMENT '收件者手機號碼',
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
  `ship_no` int(11) NOT NULL COMMENT '配送方式(編號)',
  `store_name` varchar(50) NOT NULL COMMENT '便利商店取貨門市名稱',
  `store_addr` varchar(200) NOT NULL COMMENT '便利商店取貨門市地址',
  `appredate` datetime NOT NULL COMMENT '鑑賞期日期',
  `total_price` int(11) NOT NULL COMMENT '訂單總金額',
  `freight` int(11) NOT NULL COMMENT '運費金額',
  `PV` int(11) NOT NULL COMMENT '總PV值',
  `bonuce` int(11) NOT NULL COMMENT '總紅利',
  `ordstatus` char(1) NOT NULL COMMENT '訂單狀態(0:新訂單,1:處理中….9:訂單取消)',
  `ship_status` char(1) NOT NULL COMMENT '物流狀態(0:未派車,1:已派車)',
  `addtime` datetime NOT NULL COMMENT '建立時間',
  `updatetime` datetime NOT NULL COMMENT '修改時間',
  `returntime` datetime NOT NULL COMMENT '申請退貨時間',
  `refundtime` datetime NOT NULL COMMENT '退款時間',
  PRIMARY KEY (`ordid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='訂單主表';

-- --------------------------------------------------------

--
-- 資料表結構 `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `no` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號(PK)',
  `name` varchar(20) NOT NULL COMMENT '頁面名稱',
  `content` text NOT NULL COMMENT '頁面內容',
  `lang` varchar(10) NOT NULL COMMENT '語系代碼',
  `addtime` datetime NOT NULL COMMENT '建立時間',
  `updatetime` datetime NOT NULL COMMENT '修改時間',
  PRIMARY KEY (`no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='靜態頁面' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 資料表結構 `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `no` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號(PK)',
  `mfno` int(11) NOT NULL COMMENT '金流業者編號',
  `name` varchar(20) NOT NULL COMMENT '付款方式名稱',
  `price` int(11) NOT NULL COMMENT '可用價格',
  `service` int(11) NOT NULL COMMENT '服務費用',
  `pic` int(11) NOT NULL COMMENT '圖片檔名',
  `forSupplier` char(1) NOT NULL COMMENT '供應商是否可用?(0:不可, 1:可用)',
  `status` char(1) NOT NULL COMMENT '狀態(0:停用, 1:啟用)',
  `addtime` datetime NOT NULL COMMENT '建立時間',
  `updatetime` datetime NOT NULL COMMENT '修改時間',
  PRIMARY KEY (`no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='付款方式' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 資料表結構 `proclass`
--

CREATE TABLE IF NOT EXISTS `proclass` (
  `no` int(11) NOT NULL AUTO_INCREMENT COMMENT '類別編號 (PK)',
  `parent` int(11) NOT NULL COMMENT '上層編號(0:主類別，>0: 次類別)',
  `pcname` varchar(50) NOT NULL COMMENT '類別名稱',
  `sort` int(11) NOT NULL DEFAULT '1' COMMENT '類別順序(1最小)',
  `status` char(1) NOT NULL COMMENT '類別狀態(0:下架，1:上架)',
  `lang` varchar(10) NOT NULL COMMENT '語系代碼',
  `addtime` datetime NOT NULL COMMENT '建立時間',
  `updatetime` datetime NOT NULL COMMENT '修改時間',
  PRIMARY KEY (`no`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='商品類別' AUTO_INCREMENT=7 ;

--
-- 資料表的匯出資料 `proclass`
--

INSERT INTO `proclass` (`no`, `parent`, `pcname`, `sort`, `status`, `lang`, `addtime`, `updatetime`) VALUES
(1, 0, '套裝組合', 1, '1', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 0, '膠囊類', 1, '1', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 0, '萃取液', 1, '1', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 0, '健康器材', 1, '1', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 0, '養身食品', 1, '1', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 0, '滴丸', 1, '1', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 資料表結構 `productpics`
--

CREATE TABLE IF NOT EXISTS `productpics` (
  `no` int(11) NOT NULL AUTO_INCREMENT COMMENT '圖片流水號(PK)',
  `proid` varchar(10) NOT NULL COMMENT '商品編號',
  `picname` varchar(50) NOT NULL COMMENT '圖片名稱',
  `picfile` varchar(50) NOT NULL COMMENT '圖片檔名',
  `addtime` datetime NOT NULL COMMENT '建立時間',
  `updatetime` datetime NOT NULL COMMENT '修改時間',
  PRIMARY KEY (`no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品圖片' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 資料表結構 `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `proid` varchar(20) NOT NULL COMMENT '商品編號 (PK)',
  `suppid` varchar(20) NOT NULL COMMENT '供應商ID',
  `proname` varchar(50) NOT NULL COMMENT '商品名稱',
  `prointro` varchar(100) NOT NULL COMMENT '商品簡短說明',
  `pcno1` int(11) NOT NULL COMMENT '商品主分類1',
  `pcno2` int(11) NOT NULL COMMENT '商品主分類2',
  `pcno3` int(11) NOT NULL COMMENT '商品次分類3',
  `price` int(11) NOT NULL COMMENT '價格',
  `PV` int(11) NOT NULL COMMENT 'PV值',
  `bonuce` int(11) NOT NULL COMMENT '紅利',
  `stock` int(11) NOT NULL COMMENT '庫存量',
  `prodetail` text NOT NULL COMMENT '商品詳細說明',
  `protags` varchar(100) NOT NULL COMMENT '標籤(標記效果) 標籤間以逗號(,)分隔',
  `weight` varchar(20) NOT NULL COMMENT '商品重量',
  `size` varchar(50) NOT NULL COMMENT '商品長寬高',
  `uptime` datetime NOT NULL COMMENT '上架時間',
  `downtime` datetime NOT NULL COMMENT '下架時間',
  `memo` varchar(250) NOT NULL COMMENT '備註',
  `checkmemo` varchar(250) NOT NULL COMMENT '審核說明',
  `checktime` datetime NOT NULL COMMENT '審核時間',
  `status` char(1) NOT NULL DEFAULT '1' COMMENT '商品狀態(0:審核未通過,1:待審核,2:審核通過,3:上架,9:下架)',
  `lang` varchar(10) NOT NULL COMMENT '語系代碼',
  `addtime` datetime NOT NULL COMMENT '建立時間',
  `updatetime` datetime NOT NULL COMMENT '修改時間',
  PRIMARY KEY (`proid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品資料';

--
-- 資料表的匯出資料 `products`
--

INSERT INTO `products` (`proid`, `suppid`, `proname`, `prointro`, `pcno1`, `pcno2`, `pcno3`, `price`, `PV`, `bonuce`, `stock`, `prodetail`, `protags`, `weight`, `size`, `uptime`, `downtime`, `memo`, `checkmemo`, `checktime`, `status`, `lang`, `addtime`, `updatetime`) VALUES
('XXX-1000-59-ABC', '', '養生專利滴粒', '榮獲製備抑制脂肪細胞蓄積油滴之藥物的用途等', 6, 0, 1, 9999, 100000, 0, 4, '商品詳細資料內容', '', '300g', '1 x 2 x 3', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '備註資料', '', '0000-00-00 00:00:00', '3', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('XXX-1000-60-ABC', '', '專利牛樟芝微脂純液', '榮獲製備抑制脂肪細胞蓄積油滴之藥物的用途等', 3, 0, 1, 9999, 100000, 0, 4, '商品詳細資料內容', '', '300g', '1 x 2 x 3', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '備註資料', '', '0000-00-00 00:00:00', '3', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('XXX-1000-61-ABC', '', '專利牛樟芝微脂浸膏', '榮獲製備抑制脂肪細胞蓄積油滴之藥物的用途等', 3, 0, 1, 9999, 100000, 0, 4, '商品詳細資料內容', '', '300g', '1 x 2 x 3', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '備註資料', '', '0000-00-00 00:00:00', '3', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('XXX-1000-62-ABC', '', '牛樟芝耐胃酸膠囊', '榮獲製備抑制脂肪細胞蓄積油滴之藥物的用途等', 2, 0, 1, 9999, 100000, 0, 4, '商品詳細資料內容', '', '300g', '1 x 2 x 3', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '備註資料', '', '0000-00-00 00:00:00', '3', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('XXX-1000-63-ABC', '', '黃金膠囊', '榮獲製備抑制脂肪細胞蓄積油滴之藥物的用途等', 1, 0, 2, 9999, 100000, 0, 4, '商品詳細資料內容', '', '300g', '1 x 2 x 3', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '備註資料', '', '0000-00-00 00:00:00', '3', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('XXX-1000-64-ABC', '', '黃金滴粒', '榮獲製備抑制脂肪細胞蓄積油滴之藥物的用途等', 1, 0, 2, 9999, 100000, 0, 4, '商品詳細資料內容', '', '300g', '1 x 2 x 3', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '備註資料', '', '0000-00-00 00:00:00', '3', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('XXX-1000-65-ABC', '', '固態膠囊', '榮獲製備抑制脂肪細胞蓄積油滴之藥物的用途等', 1, 0, 2, 9999, 100000, 0, 4, '商品詳細資料內容', '', '300g', '1 x 2 x 3', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '備註資料', '', '0000-00-00 00:00:00', '3', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('XXX-1000-66-ABC', '', '牛樟之萃取液', '榮獲製備抑制脂肪細胞蓄積油滴之藥物的用途等', 1, 0, 2, 9999, 100000, 0, 4, '商品詳細資料內容', '', '300g', '1 x 2 x 3', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '備註資料', '', '0000-00-00 00:00:00', '3', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('XXX-1000-67-ABC', '', 'A組靶向養生', '榮獲製備抑制脂肪細胞蓄積油滴之藥物的用途等', 6, 0, 0, 9999, 100000, 0, 4, '商品詳細資料內容', '', '300g', '1 x 2 x 3', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '備註資料', '', '0000-00-00 00:00:00', '3', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('XXX-1000-68-ABC', '', 'B組精準輔療', '榮獲製備抑制脂肪細胞蓄積油滴之藥物的用途等', 1, 0, 0, 9999, 100000, 0, 4, '商品詳細資料內容', '', '300g', '1 x 2 x 3', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '備註資料', '', '0000-00-00 00:00:00', '3', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 資料表結構 `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `no` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號(PK)',
  `key` varchar(10) NOT NULL COMMENT '設定鍵值',
  `name` varchar(20) NOT NULL COMMENT '設定名稱',
  `value` varchar(200) NOT NULL COMMENT '設定值',
  `lang` varchar(10) NOT NULL COMMENT '語系代碼',
  `updatetime` datetime NOT NULL COMMENT '修改時間',
  PRIMARY KEY (`no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='網站資料設定' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 資料表結構 `shippings`
--

CREATE TABLE IF NOT EXISTS `shippings` (
  `no` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號(PK)',
  `logno` int(11) NOT NULL COMMENT '物流業者編號',
  `name` varchar(20) NOT NULL COMMENT '配送方式名稱',
  `price` int(11) NOT NULL COMMENT '可用價格',
  `service` int(11) NOT NULL COMMENT '服務費用',
  `nocharge` int(11) NOT NULL COMMENT '免運費門檻',
  `pic` varchar(50) NOT NULL COMMENT '圖片檔名',
  `forSupplier` char(1) NOT NULL COMMENT '供應商是否可用?(0:不可, 1:可用)',
  `status` char(1) NOT NULL COMMENT '狀態(0:停用, 1:啟用)',
  `addtime` datetime NOT NULL COMMENT '建立時間',
  `updatetime` datetime NOT NULL COMMENT '修改時間',
  PRIMARY KEY (`no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='配送方式' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 資料表結構 `suppliers`
--

CREATE TABLE IF NOT EXISTS `suppliers` (
  `suppid` varchar(20) NOT NULL COMMENT '供應商ID(PK)',
  `account` varchar(20) NOT NULL COMMENT '主帳號',
  `password` varchar(20) NOT NULL COMMENT '密碼',
  `name` varchar(50) NOT NULL COMMENT '供應商名稱',
  `platform` varchar(50) NOT NULL COMMENT '平台名稱',
  `name_en` varchar(50) NOT NULL COMMENT '供應商英文簡稱',
  `company_no` varchar(10) NOT NULL COMMENT '統一編號',
  `principal` varchar(50) NOT NULL COMMENT '負責人',
  `tel` varchar(20) NOT NULL COMMENT '聯繫電話',
  `fax` varchar(20) NOT NULL COMMENT '傳真',
  `reg_address` varchar(200) NOT NULL COMMENT '登記地址',
  `con_address` varchar(200) NOT NULL COMMENT '聯繫地址',
  `contact` varchar(20) NOT NULL COMMENT '聯絡人',
  `contact_phone` varchar(20) NOT NULL COMMENT '聯絡人電話',
  `bank` varchar(20) NOT NULL COMMENT '收款銀行',
  `bank_branch` varchar(20) NOT NULL COMMENT '分行名稱',
  `bank_code` varchar(5) NOT NULL COMMENT '分行代碼',
  `bank_account` varchar(20) NOT NULL COMMENT '收款帳號',
  `management_ip` varchar(20) NOT NULL COMMENT '管理後台IP位置',
  `serviceP` smallint(6) NOT NULL COMMENT '平台服務費%數',
  `PV` int(11) NOT NULL COMMENT '預設PV值',
  `bonuceP` smallint(6) NOT NULL COMMENT '紅利顯示%數',
  `addtime` datetime NOT NULL COMMENT '建立時間',
  `updatetime` datetime NOT NULL COMMENT '修改時間',
  `logintime` datetime NOT NULL COMMENT '最近登入時間',
  PRIMARY KEY (`suppid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='供應商資料';

-- --------------------------------------------------------

--
-- 資料表結構 `supporderdetail`
--

CREATE TABLE IF NOT EXISTS `supporderdetail` (
  `ordid` varchar(20) NOT NULL COMMENT '訂單編號(PK)',
  `odno` int(11) NOT NULL COMMENT '項目流水號(PK)',
  `proname` varchar(50) NOT NULL COMMENT '商品名稱',
  `proid` varchar(20) NOT NULL COMMENT '產品編號',
  `qty` int(11) NOT NULL COMMENT '數量',
  `price` int(11) NOT NULL COMMENT '售價',
  `subtotal` int(11) NOT NULL COMMENT '小計',
  PRIMARY KEY (`ordid`,`odno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='供應商訂單子表';

-- --------------------------------------------------------

--
-- 資料表結構 `supporders`
--

CREATE TABLE IF NOT EXISTS `supporders` (
  `ordid` varchar(20) NOT NULL COMMENT '訂單編號(PK)',
  `orddate` date NOT NULL COMMENT '訂單日期',
  `suppid` varchar(20) NOT NULL COMMENT '供應商ID',
  `discount` varchar(20) NOT NULL COMMENT '折抵方式',
  `discount_price` int(11) NOT NULL COMMENT '折抵金額',
  `pay_no` int(11) NOT NULL COMMENT '付款方式(編號)',
  `pay_price` int(11) NOT NULL COMMENT '付款金額',
  `ispay` char(1) NOT NULL COMMENT '付款狀態(0:未付款, 1:已付款)',
  `installment` smallint(6) NOT NULL COMMENT '分期期數',
  `total_price` int(11) NOT NULL COMMENT '訂單金額',
  `freight` int(11) NOT NULL COMMENT '運費金額',
  `PV` int(11) NOT NULL COMMENT 'PV值',
  `bonuce` int(11) NOT NULL COMMENT '紅利',
  `profit` int(11) NOT NULL COMMENT '利潤'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='經銷商訂單';

-- --------------------------------------------------------

--
-- 資料表結構 `supppayments`
--

CREATE TABLE IF NOT EXISTS `supppayments` (
  `no` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號(PK)',
  `suppid` varchar(20) NOT NULL COMMENT '供應商ID',
  `mfno` int(11) NOT NULL COMMENT '金流業者編號',
  `price` int(11) NOT NULL COMMENT '可用價格',
  `service` int(11) NOT NULL COMMENT '服務費用',
  `status` char(1) NOT NULL COMMENT '狀態(0:停用, 1:啟用)',
  `addtime` datetime NOT NULL COMMENT '建立時間',
  `updatetime` datetime NOT NULL COMMENT '修改時間',
  PRIMARY KEY (`no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='經銷商付款方式' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 資料表結構 `suppshippings`
--

CREATE TABLE IF NOT EXISTS `suppshippings` (
  `no` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號(PK)',
  `suppid` varchar(20) NOT NULL COMMENT '供應商ID',
  `logno` int(11) NOT NULL COMMENT '物流業者編號',
  `price` int(11) NOT NULL COMMENT '可用價格',
  `service` int(11) NOT NULL COMMENT '服務費用',
  `nocharge` int(11) NOT NULL COMMENT '免運費門檻',
  `status` char(1) NOT NULL COMMENT '狀態(0:停用, 1:啟用)',
  `addtime` datetime NOT NULL COMMENT '建立時間',
  `updatetime` datetime NOT NULL COMMENT '修改時間',
  PRIMARY KEY (`no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='經銷商配送方式' AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
