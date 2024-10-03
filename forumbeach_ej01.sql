-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 03, 2024 at 05:33 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forumbeach_ej01`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int NOT NULL,
  `category_n` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_n`) VALUES
(3, 'ฟอรัมคำถาม'),
(4, 'ฟอรัมสนทนา'),
(5, 'ฟอรัมขายของ'),
(6, 'ฟอรัมข่าว'),
(23, 'ฟอรัมอาหาร');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `ment_id` int NOT NULL,
  `user_id` int NOT NULL,
  `f_id` int NOT NULL,
  `ment_detail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ment_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`ment_id`, `user_id`, `f_id`, `ment_detail`, `ment_datetime`) VALUES
(53, 9, 98, '<p>เหมือนจะเห็นว่ายืนคุยกับตำรวจหลังจากจับตัวเลยนะ</p>', '2024-10-03 17:38:08'),
(56, 10, 101, '<p>ต้องการหาเกี่ยวกับเตรียมสอบ สายวิศวะเลยค่ะ</p>', '2024-10-03 19:29:12'),
(57, 9, 98, '<p><span style=\"color: #262626; font-family: thongterm, sans-serif; font-size: 16px; letter-spacing: 0.25px;\">ผกก.สน.ห้วยขวางกล่าวว่าขณะนี้ได้สอบปากคำ</span></p>', '2024-10-03 19:30:57'),
(58, 9, 98, '<p><span style=\"color: #262626; font-family: thongterm, sans-serif; font-size: 16px; letter-spacing: 0.25px;\">ทั้งหมด 7 ปาก คือ ผู้เสียหายเจ้าของรถ</span></p>', '2024-10-03 19:31:40'),
(59, 9, 98, '<p><span style=\"color: #262626; font-family: thongterm, sans-serif; font-size: 16px; letter-spacing: 0.25px;\">เจ้าหน้าที่ รปภ.ที่อยู่ในเหตุการณ์ วันนี้จะสอบปากคำ</span></p>', '2024-10-03 19:32:38'),
(60, 9, 98, '<p><span style=\"color: #262626; font-family: thongterm, sans-serif; font-size: 16px; letter-spacing: 0.25px;\">เจ้าของรถที่ได้รับความเสียหายขณะผู้ต้องหาหลบหนี</span></p>', '2024-10-03 19:32:56'),
(61, 9, 98, '<p><span style=\"color: #262626; font-family: thongterm, sans-serif; font-size: 16px; letter-spacing: 0.25px;\">&nbsp;ทั้งนี้จากการตรวจสอบประวัติอาชญากร</span></p>', '2024-10-03 19:33:22'),
(62, 9, 98, '<p><span style=\"color: #262626; font-family: thongterm, sans-serif; font-size: 16px; letter-spacing: 0.25px;\">ไม่พบว่าผู้ก่อเหตุมีกระทำความผิดมาก่อน</span></p>', '2024-10-03 19:33:39'),
(63, 9, 98, '<p><span style=\"color: #262626; font-family: thongterm, sans-serif; font-size: 16px; letter-spacing: 0.25px;\">ส่วนแมวเจ้าของได้รับกลับไปดูแลแล้ว</span></p>', '2024-10-03 19:33:50'),
(64, 9, 98, '<p><span style=\"color: #262626; font-family: thongterm, sans-serif; font-size: 16px; letter-spacing: 0.25px;\">อาการป่วยทางจิตต้องมีการสอบสวนเพิ่ม</span></p>', '2024-10-03 19:34:09'),
(65, 9, 98, '<p><span style=\"color: #262626; font-family: thongterm, sans-serif; font-size: 16px; letter-spacing: 0.25px;\">และขอดูเอกสารจากทางครอบครัวอย่างละเอียด&nbsp;</span></p>', '2024-10-03 19:34:19');

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE `forum` (
  `f_id` int NOT NULL,
  `user_id` int NOT NULL,
  `category_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`f_id`, `user_id`, `category_id`) VALUES
(82, 20, 5),
(83, 20, 5),
(84, 20, 4),
(85, 20, 4),
(86, 20, 3),
(90, 20, 3),
(98, 1, 6),
(99, 9, 6),
(100, 10, 3),
(101, 10, 4),
(103, 3, 23);

-- --------------------------------------------------------

--
-- Table structure for table `forum_detail`
--

CREATE TABLE `forum_detail` (
  `fd_id` int NOT NULL,
  `fd_header` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fd_content` text COLLATE utf8mb4_general_ci NOT NULL,
  `fd_datetime` datetime NOT NULL,
  `f_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forum_detail`
--

INSERT INTO `forum_detail` (`fd_id`, `fd_header`, `fd_content`, `fd_datetime`, `f_id`) VALUES
(94, 'ขาย Rg sazabi 1/144 มือสองค่ะ แฟนแอบซื้อมาค่ะ', '<p>ยังไม่ได้ประกอบ สนใจสอบถามได้ค่ะ</p>', '2024-10-02 17:23:56', 82),
(95, 'ลาบูบู้ Labubu boxset ', '<p>มาแล้วค่ะ ลาบูบู้ ที่นิยมในช่วงนี้ กระแสอาร์ตทอยได้รับความนิยมอย่างท่วมท้น สะท้อนให้เห็นว่าของเล่นไม่ใช่แค่เรื่องของเด็กเท่านั้น แต่ยังเป็นผลงานศิลปะที่ดึงดูดใจเหล่านักสะสมที่หลงใหลในความน่ารักและสวยงามของตัวละครต่าง ๆ และหนึ่งในตัวละครอาร์ตทอยที่โดดเด่นเป็นอย่างมาก<br /><br />ราคา boxset ละ 1599- เท่านั้น สามารถกดสั่งซื้อได้เลยนะคะ</p>', '2024-10-02 17:27:38', 83),
(96, 'โหนกระแส+หนุ่ม กรรชัย = 🤣', '', '2024-10-02 17:29:23', 84),
(97, 'น้องหมูเด้งดังไปไกลเลย', '<p>ภาพมาจากรายกาย SNL ย่อมาจาก Saturday Night Live เป็นรายการโทรทัศน์แนวตลกสเก็ตช์ (sketch comedy) ที่ออกอากาศในคืนวันเสาร์ทางช่อง NBC ในสหรัฐอเมริกา</p>', '2024-10-02 17:34:30', 85),
(98, 'โลกเรากลมหรือแบนค่ะ?', '', '2024-10-02 17:37:48', 86),
(102, 'ถามผู้รู้ค่ะ แฟนซื้อโมเดลวันพีชมาค่ะ แฟนบอกซื้อมา 1000 เดียวเอง จริงมั้ยค่ะ', '', '2024-10-02 18:08:03', 90),
(110, 'หญิงขโมยรถป้ายแดง เคยรักษาอาการทางจิต อ้างทำเพราะมีคนสั่ง โดน 2 ข้อหา', '<p class=\"cvGsUA align-start para-style-body direction-ltr\" style=\"color: #ffffff; font-family: \'YACkoJtKJ38 0\', _fb_, auto; --cyv3zq: 29.333333333333336px; --gjplxq: 1.4; line-height: 41px;\"><span class=\"OYPEnA font-feature-liga-off font-feature-clig-off font-feature-calt-off text-decoration-none text-strikethrough-none\" style=\"font-kerning: none;\">ผกก.ห้วยขวางเผย หญิงวัย 40 ปี ก่อเหตุลักรถป้ายแดง เคยรักษาอาการทางจิต 2-3 ปี ยังให้การภาคเสธ อ้างมีคนสั่งให้มาขับรถออกไป เบื้องต้นตำรวจตั้ง 2 ข้อหา ลักทรัพย์ และทำให้เสียทรัพย์</span></p>\r\n<p class=\"cvGsUA direction-ltr align-start para-style-body\" style=\"color: #ffffff; font-family: \'YACkoJtKJ38 0\', _fb_, auto; --cyv3zq: 29.333333333333336px; --gjplxq: 1.4; line-height: 41px;\"><span class=\"OYPEnA font-feature-liga-off font-feature-clig-off font-feature-calt-off text-decoration-none text-strikethrough-none\" style=\"font-kerning: none;\">กรณี น.ส.กัฐกัญญ์ ปิติโชคโภคินนันท์ อายุ 40 ปี ก่อเหตุลักทรัพย์รถยนต์เอสยูวี ยี่ห้อฮอนด้า รุ่น HRV สีดำ ป้ายแดง ฮ-7086 กรุงเทพมหานคร ของผู้เสียหายจากลานจอดรถห้างสรรพสินค้าเดอะสตรีท รัชดาฯ โดยในรถมีแมวของผู้เสียหาย 1 ตัว เหตุเกิดเมื่อช่วงบ่ายวันที่ 2 ต.ค. ก่อนตำรวจตามจับกุม น.ส.กัฐกัญญ์ ได้พร้อมของที่บริเวณลานจอดรถหน้าอพาร์ตเมนต์ ในซอยนาคนิวาส 16 แขวงและเขตลาดพร้าว กรุงเทพฯ เมื่อเวลา 23.00 น.วันเดียวกัน แต่ยังให้การวกวน เนื่องจากผู้ก่อเหตุมีอาการป่วยทางจิตเวช</span></p>\r\n<p class=\"cvGsUA direction-ltr align-start para-style-body\" style=\"color: #ffffff; font-family: \'YACkoJtKJ38 0\', _fb_, auto; --cyv3zq: 29.333333333333336px; --gjplxq: 1.4; line-height: 41px;\"><span class=\"OYPEnA font-feature-liga-off font-feature-clig-off font-feature-calt-off text-decoration-none text-strikethrough-none\" style=\"font-kerning: none;\">ความคืบหน้าที่ สน.ห้วยขวาง เมื่อวันที่ 3 ตุลาคม 2567 พ.ต.อ.ประสพโชค เอี่ยมพินิจ ผกก.สน.ห้วยขวาง กล่าวว่า ได้เรียกประชุมชุดพนักงานสอบสวน เพื่อติดตามความคืบหน้าคดี ขณะนี้ได้รับการติดต่อจากญาติของผู้ก่อเหตุจะนำเอกสารยืนยันอาการป่วย ประวัติการรักษามาแสดงต่อเจ้าหน้าที่ จึงจะพิจารณาการดำเนินคดี เพราะตอนนี้ผู้ก่อเหตุยังให้การไม่รู้เรื่อง</span></p>\r\n<p class=\"cvGsUA direction-ltr align-start para-style-body\" style=\"color: #ffffff; font-family: \'YACkoJtKJ38 0\', _fb_, auto; --cyv3zq: 29.333333333333336px; --gjplxq: 1.4; line-height: 41px;\">&nbsp;</p>\r\n<p class=\"cvGsUA direction-ltr align-start para-style-body\" style=\"color: #ffffff; font-family: \'YACkoJtKJ38 0\', _fb_, auto; --cyv3zq: 29.333333333333336px; --gjplxq: 1.4; text-transform: none; line-height: 41px;\"><span class=\"OYPEnA font-feature-liga-off font-feature-clig-off font-feature-calt-off text-decoration-none text-strikethrough-none\" style=\"color: #ffffff; font-weight: 400; font-style: normal; font-kerning: none;\">พ.ต.อ.ประสพโชค กล่าวว่า หลังจากจับกุมตัวได้ผู้ก่อเหตุได้พร้อมรถของกลาง ตำรวจได้คุมตัวมาที่ สน.ห้วยขวาง ดำเนินการสอบปากคำในขั้นต้น ผู้ต้องหาให้การภาคเสธ อ้างว่ามีคนสั่งให้มาขับรถออกไป จากการสอบปากคำผู้ต้องหาสามารถตอบโต้กับเจ้าหน้าที่ได้ ขณะเดียวกันได้รับข้อมูลจากทางครอบครัวว่า ผู้ก่อเหตุเคยได้รับการรักษาอาการทางจิตที่โรงพยาบาลแห่งหนึ่งในจังหวัดขอนแก่นมาประมาณ 2-3 ปี หลังเริ่มมีอาการผิดปกติ มักพูดคนเดียวและมีอาการคล้ายองค์ลง และมักมีอาการมากขึ้นเมื่อถูกขัดใจ</span></p>', '2024-10-03 17:29:20', 98),
(111, 'ถูกถามตอนสัมภาษณ์งานว่า “ทำไมถึงลาออกจากงานล่าสุด?” ชาวเน็ตแห่แนะคำตอบ', '<p class=\"cvGsUA align-start para-style-body direction-ltr\" style=\"color: #ffffff; font-family: \'YACkoJtKJ38 0\', _fb_, auto; --cyv3zq: 29.333333333333336px; --gjplxq: 1.4; line-height: 41px;\"><strong><span class=\"OYPEnA font-feature-liga-off font-feature-clig-off font-feature-calt-off text-decoration-none text-strikethrough-none\" style=\"font-kerning: none;\">ถูกถามในการสัมภาษณ์งานว่า &ldquo;ทำไมถึงลาออกจากงานที่แล้ว?&rdquo; สงสัยบอกตรง ๆ ได้ไหมว่าเรื่องเงินเดือน ชาวเน็ตแห่แนะนำ คำตอบที่ห้ามตอบเด็ดขาด และตอบแบบไหนจะปัง</span></strong></p>\r\n<p class=\"cvGsUA direction-ltr align-start para-style-body\" style=\"color: #ffffff; font-family: \'YACkoJtKJ38 0\', _fb_, auto; --cyv3zq: 29.333333333333336px; --gjplxq: 1.4; line-height: 41px;\">&nbsp;</p>\r\n<p class=\"cvGsUA direction-ltr align-start para-style-body\" style=\"color: #ffffff; font-family: \'YACkoJtKJ38 0\', _fb_, auto; --cyv3zq: 29.333333333333336px; --gjplxq: 1.4; line-height: 41px;\"><span class=\"OYPEnA font-feature-liga-off font-feature-clig-off font-feature-calt-off text-decoration-none text-strikethrough-none\" style=\"font-kerning: none;\">เว็บไซต์ HK01 รายงานว่า เมื่อเร็ว ๆ นี้ มีผู้ใช้งานรายหนึ่งโพสต์ใน Dcard แพลตฟอร์มโซเชียลมีเดียของไต้หวัน หัวข้อว่า &ldquo;เงินเดือนต่ำเกินไปสามารถใช้เป็นเหตุผลลาออกได้ไหม?&rdquo;</span></p>\r\n<p class=\"cvGsUA direction-ltr align-start para-style-body\" style=\"color: #ffffff; font-family: \'YACkoJtKJ38 0\', _fb_, auto; --cyv3zq: 29.333333333333336px; --gjplxq: 1.4; line-height: 41px;\"><span class=\"OYPEnA font-feature-liga-off font-feature-clig-off font-feature-calt-off text-decoration-none text-strikethrough-none\" style=\"font-kerning: none;\">โดยเขาเน้นว่าตนต้องการลาออกเพราะเงินเดือนไม่เพียงพอ และสอบถามความคิดเห็นจากชาวเน็ตว่าหากเจอคำถามเกี่ยวกับสาเหตุการลาออกจากงานเก่าในการสัมภาษณ์งาน ควรตอบอย่างไรให้ดูสุภาพและไม่ตรงเกินไป</span></p>\r\n<p class=\"cvGsUA direction-ltr align-start para-style-body\" style=\"color: #ffffff; font-family: \'YACkoJtKJ38 0\', _fb_, auto; --cyv3zq: 29.333333333333336px; --gjplxq: 1.4; line-height: 41px;\"><strong><span class=\"OYPEnA font-feature-liga-off font-feature-clig-off font-feature-calt-off text-decoration-none text-strikethrough-none\" style=\"font-kerning: none;\">ห้ามพูด 2 เหตุผลนี้เด็ดขาด! ชาวเน็ตแนะนำให้ตอบแบบนี้แทน</span></strong></p>\r\n<p class=\"cvGsUA direction-ltr align-start para-style-body\" style=\"color: #ffffff; font-family: \'YACkoJtKJ38 0\', _fb_, auto; --cyv3zq: 29.333333333333336px; --gjplxq: 1.4; line-height: 41px;\"><span class=\"OYPEnA font-feature-liga-off font-feature-clig-off font-feature-calt-off text-decoration-none text-strikethrough-none\" style=\"font-kerning: none;\">ผู้โพสต์ กล่าวว่า แม้ว่างานที่ทำอยู่ตอนนี้จะสบาย แต่ก็ไม่ได้เรียนรู้อะไรจากงานมากนัก อีกทั้งถึงแม้หัวหน้าจะเป็นคนดีมาก แต่เพราะเงินเดือนค่อนข้างต่ำ จึงกำลังพิจารณาที่จะเปลี่ยนงาน โดยคาดหวังว่ารายได้จากงานใหม่จะสูงกว่าเดิมอย่างน้อย 5,000 ดอลลาร์ไต้หวันน</span>&nbsp;(ประมาณ 5,100 บาท)</p>\r\n<p class=\"cvGsUA direction-ltr align-start para-style-body\" style=\"color: #ffffff; font-family: \'YACkoJtKJ38 0\', _fb_, auto; --cyv3zq: 29.333333333333336px; --gjplxq: 1.4; line-height: 41px;\"><span class=\"OYPEnA font-feature-liga-off font-feature-clig-off font-feature-calt-off text-decoration-none text-strikethrough-none\" style=\"font-kerning: none;\">ผู้โพสต์กังวลว่า หากในสัมภาษณ์งานใหม่ ผู้สัมภาษณ์ถามถึง \"เหตุผลการลาออก\" ควรตอบตามความจริงหรือมีวิธีตอบที่สุภาพกว่านี้?</span></p>\r\n<p class=\"cvGsUA direction-ltr align-start para-style-body\" style=\"color: #ffffff; font-family: \'YACkoJtKJ38 0\', _fb_, auto; --cyv3zq: 29.333333333333336px; --gjplxq: 1.4; line-height: 41px;\"><span class=\"OYPEnA font-feature-liga-off font-feature-clig-off font-feature-calt-off text-decoration-none text-strikethrough-none\" style=\"font-kerning: none;\">ชาวเน็ตหลายคนให้คำแนะนำที่มีเหตุผลว่า \"บอกว่ามีแผนการอื่นก็พอ\" และ \"บอกว่าอยากเรียนรู้สิ่งใหม่ ๆ จะดีกว่า\"</span></p>\r\n<p class=\"cvGsUA direction-ltr align-start para-style-body\" style=\"color: #ffffff; font-family: \'YACkoJtKJ38 0\', _fb_, auto; --cyv3zq: 29.333333333333336px; --gjplxq: 1.4; line-height: 41px;\"><span class=\"OYPEnA font-feature-liga-off font-feature-clig-off font-feature-calt-off text-decoration-none text-strikethrough-none\" style=\"font-kerning: none;\">ชาวเน็ตบางคนยังเตือนผู้โพสต์ว่า เมื่อพูดถึงเหตุผลการลาออก ควรหลีกเลี่ยงการวิจารณ์บริษัทเก่าตรง ๆ หรือบอกแค่เรื่องเงินเดือน เพราะ \"เจ้านายคนใหม่อาจกลัวว่าคุณจะลาออกด้วยเหตุผลเดียวกัน\"</span></p>\r\n<p class=\"cvGsUA direction-ltr align-start para-style-body\" style=\"color: #ffffff; font-family: \'YACkoJtKJ38 0\', _fb_, auto; --cyv3zq: 29.333333333333336px; --gjplxq: 1.4; line-height: 41px;\"><strong><span class=\"OYPEnA font-feature-liga-off font-feature-clig-off font-feature-calt-off text-decoration-none text-strikethrough-none\" style=\"font-kerning: none;\">แต่ก็มีชาวเน็ตบางคนแนะนำให้ตอบตรงไปตรงมา</span></strong></p>\r\n<p class=\"cvGsUA direction-ltr align-start para-style-body\" style=\"color: #ffffff; font-family: \'YACkoJtKJ38 0\', _fb_, auto; --cyv3zq: 29.333333333333336px; --gjplxq: 1.4; line-height: 41px;\"><span class=\"OYPEnA font-feature-liga-off font-feature-clig-off font-feature-calt-off text-decoration-none text-strikethrough-none\" style=\"font-kerning: none;\">\"ถ้าหมาใหญ่ข้างบ้านคลอดลูกยังใช้เป็นเหตุผลลาออกได้ แล้วทำไมเงินเดือนต่ำถึงจะไม่ได้?\"</span></p>\r\n<p class=\"cvGsUA direction-ltr align-start para-style-body\" style=\"color: #ffffff; font-family: \'YACkoJtKJ38 0\', _fb_, auto; --cyv3zq: 29.333333333333336px; --gjplxq: 1.4; line-height: 41px;\"><span class=\"OYPEnA font-feature-liga-off font-feature-clig-off font-feature-calt-off text-decoration-none text-strikethrough-none\" style=\"font-kerning: none;\">\"ไม่ต้องพูดอ้อมค้อมหรอก งานก็ทำเพื่อเงินอยู่แล้ว แต่เธอควรคิดให้ดีว่าอะไรที่เธอต้องการ บางคนงานสบายๆ เงินพอใช้ก็พอแล้ว ไม่ต้องหวังว่าจะได้เรียนรู้อะไรมากมาย\"</span></p>\r\n<p class=\"cvGsUA direction-ltr align-start para-style-body\" style=\"color: #ffffff; font-family: \'YACkoJtKJ38 0\', _fb_, auto; --cyv3zq: 29.333333333333336px; --gjplxq: 1.4; line-height: 41px;\"><span class=\"OYPEnA font-feature-liga-off font-feature-clig-off font-feature-calt-off text-decoration-none text-strikethrough-none\" style=\"font-kerning: none;\">\"บอกไปเลยว่าเงินเดือนที่บริษัทเก่าต่ำกว่าเจ้าอื่น เค้าจะได้รู้ว่าห้ามใช้วิธีจ่ายเงินไม่พอ\"</span></p>\r\n<p class=\"cvGsUA direction-ltr align-start para-style-body\" style=\"color: #ffffff; font-family: \'YACkoJtKJ38 0\', _fb_, auto; --cyv3zq: 29.333333333333336px; --gjplxq: 1.4; line-height: 41px;\"><strong><span class=\"OYPEnA font-feature-liga-off font-feature-clig-off font-feature-calt-off text-decoration-none text-strikethrough-none\" style=\"font-kerning: none;\">ชาวเน็ตบางคนยังให้คำอธิบายที่ไม่เพียงแต่บอกเหตุผลที่แท้จริง แต่ยังฟังดูมีไหวพริบมากกว่า</span></strong></p>\r\n<p class=\"cvGsUA direction-ltr align-start para-style-body\" style=\"color: #ffffff; font-family: \'YACkoJtKJ38 0\', _fb_, auto; --cyv3zq: 29.333333333333336px; --gjplxq: 1.4; line-height: 41px;\"><span class=\"OYPEnA font-feature-liga-off font-feature-clig-off font-feature-calt-off text-decoration-none text-strikethrough-none\" style=\"font-kerning: none;\">\"เนื่องจากในตำแหน่งที่ทำอยู่ตอนนี้ การเติบโตด้านเงินเดือนมีข้อจำกัด จึงต้องการหางานที่มีโอกาสในการพัฒนามากขึ้น\"</span></p>', '2024-10-03 17:37:22', 99),
(112, 'อยากทราบว่า ความสัมพันธ์เวียนเกิดของ ข้อนี้ทำอย่างไรหรอคะ', '<p>อยากเข้าใจวิธีการทำของข้อนี้ค่ะ</p>', '2024-10-03 17:45:48', 100),
(113, 'อยากให้แนะนำหนังสือ📚 ที่เตรียมสอบเข้า มหาลัย สาขาวิศวะหน่อยคะ', '', '2024-10-03 17:48:36', 101),
(115, '🐔แจกสูตรลับ! ต้มไก่บ้าน🐔 ในตำนาน❗❗❗', '<p>ส่วนผสม</p>\r\n<p>ไก่บ้าน 1 ตัว</p>\r\n<p>ข่าหั่นแว่นหนาๆ &frac12; ถ้วยตวง</p>\r\n<p>ตะไคร้ 5 ต้น</p>\r\n<p>ใบมะกรูด 10 ใบ</p>\r\n<p>หอมแดง 5 &ndash; 7 หัว</p>\r\n<p>มะขามเปียก 2 ช้อนโต๊ะ</p>\r\n<p>น้ำมะนาว 3 ช้อนโต๊ะ</p>\r\n<p>เกลือป่น 1 ช้อนโต๊ะ</p>\r\n<p>น้ำปลา 3 ช้อนโต๊ะ</p>\r\n<p>พริกชี้ฟ้าแดง 10 เม็ด</p>\r\n<p>ใบมะขามอ่อน &frac12; ถ้วยตวง</p>\r\n<p>ต้นหอม ผักชี ผักชีฝรั่ง หั่นรวมกันหยาบๆ ประมาณ &frac12; ถ้วยตวง</p>\r\n<p>&nbsp;</p>\r\n<p>วิธีการทำ</p>\r\n<p>1. นำไก่บ้านที่ถอนขนแล้วมาลนไฟ เพื่อให้หนังตึงและกำจัดขนอ่อน</p>\r\n<p>2. สับไก่เป็นชิ้นใหญ่ๆ ล้างให้สะอาดพักไว้</p>\r\n<p>3. เผาหอมแดงให้สุกลอกเปลือกเตรียมไว้</p>\r\n<p>4. เทน้ำใส่หม้อยกขึ้นตั้งไฟ พอน้ำร้อนเริ่มเดือดปุดๆ ใส่ ตะไคร้ทุบ ใบมะกรูดฉีก หอมแดงเผา ข่าและพริกสดทุบนิดหน่อย พอเดือดไก่ใส่ลงไป ต้มให้ไก่สุกดี</p>\r\n<p>5. ปรุงรสด้วยเกลือ น้ำปลา มะขามเปียก ใบมะขามอ่อน รอให้เดือด ปิดไฟยกลงจากเตาปรุงรสเพิ่มด้วยน้ำมะนาวและผงชูรส ชิมดูให้รสพอดี ตักใส่ชาม โรยต้นหอมผักชี และผักชีฝรั่งที่หั่นไว้ รับประทานได้</p>', '2024-10-03 18:03:09', 103);

-- --------------------------------------------------------

--
-- Table structure for table `forum_image`
--

CREATE TABLE `forum_image` (
  `fpic_id` int NOT NULL,
  `fpic_image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_id` int NOT NULL,
  `f_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `forum_image`
--

INSERT INTO `forum_image` (`fpic_id`, `fpic_image`, `user_id`, `f_id`) VALUES
(16, 'img/p12-daily-labubu-02.jpg', 20, 83),
(17, 'img/461621735_496361406637949_4931797437757945636_n.jpg', 20, 84),
(18, 'img/461877317_122170230968092294_7482412400578604919_n.jpg', 20, 85),
(19, 'img/512e656cf0.jpg', 20, 90),
(24, 'img/Screenshot 2024-10-03 172857.png', 1, 98),
(25, 'img/Screenshot 2024-10-03 161941.png', 9, 99),
(26, 'img/1.png', 10, 100),
(28, 'img/3.png', 3, 103);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `user_n` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `image` text COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int NOT NULL,
  `p_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`user_n`, `image`, `user_id`, `p_id`) VALUES
('Snook', 'img/pngegg.png', 9, 6),
('Fah', 'img/Screenshot 2024-10-03 165337.png', 10, 7),
('BREAKNews', 'img/360_F_200401146_cNHcKZToONyw6t0pXDKXfgeFj8OBE23g.jpg', 1, 8),
('bank bank', '', 11, 9),
('k k ', '', 12, 10),
('yo', '', 13, 11),
('แอดมินโย่ๆ', 'img/1.jpg', 3, 16),
('deidara', '', 18, 17),
('chi', '', 19, 18),
('bb', 'img/458771610_533090455775921_3607845817279677908_n.jpg', 20, 19);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `pass` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `pass`, `role`) VALUES
(1, 'naphat.bo@gmail.com', '202cb962ac59075b964b07152d234b70', 1),
(3, 'admin@admin.admin', '21232f297a57a5a743894a0e4a801fc3', 2),
(9, 's@s.com', '81dc9bdb52d04dc20036dbd8313ed055', 1),
(10, 'm@com.th', '81dc9bdb52d04dc20036dbd8313ed055', 1),
(11, 'b@b.com', '81dc9bdb52d04dc20036dbd8313ed055', 1),
(12, 'k@k.com', '81dc9bdb52d04dc20036dbd8313ed055', 1),
(13, 'yo@yo.com', '81dc9bdb52d04dc20036dbd8313ed055', 1),
(18, 'deidara@naruto.com', '81dc9bdb52d04dc20036dbd8313ed055', 1),
(19, 'chi@chi.com', '81dc9bdb52d04dc20036dbd8313ed055', 1),
(20, 'atthachai.ar@rmuti.ac.th', '81dc9bdb52d04dc20036dbd8313ed055', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`ment_id`),
  ADD KEY `f_id` (`f_id`),
  ADD KEY `comment_ibfk_1` (`user_id`);

--
-- Indexes for table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`f_id`),
  ADD KEY `forum_ibfk_1` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `forum_detail`
--
ALTER TABLE `forum_detail`
  ADD PRIMARY KEY (`fd_id`),
  ADD KEY `f_id` (`f_id`);

--
-- Indexes for table `forum_image`
--
ALTER TABLE `forum_image`
  ADD PRIMARY KEY (`fpic_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `f_id` (`f_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `ment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `forum`
--
ALTER TABLE `forum`
  MODIFY `f_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `forum_detail`
--
ALTER TABLE `forum_detail`
  MODIFY `fd_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `forum_image`
--
ALTER TABLE `forum_image`
  MODIFY `fpic_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `p_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`f_id`) REFERENCES `forum` (`f_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `forum`
--
ALTER TABLE `forum`
  ADD CONSTRAINT `forum_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `forum_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `forum_detail`
--
ALTER TABLE `forum_detail`
  ADD CONSTRAINT `forum_detail_ibfk_1` FOREIGN KEY (`f_id`) REFERENCES `forum` (`f_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `forum_image`
--
ALTER TABLE `forum_image`
  ADD CONSTRAINT `forum_image_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `forum_image_ibfk_2` FOREIGN KEY (`f_id`) REFERENCES `forum` (`f_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
