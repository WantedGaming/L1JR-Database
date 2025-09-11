
-- --------------------------------------------------------

--
-- Table structure for table `item_selector_warehouse`
--

CREATE TABLE `item_selector_warehouse` (
  `itemId` int(11) NOT NULL DEFAULT 0,
  `name` varchar(45) DEFAULT NULL,
  `desc_kr` varchar(45) NOT NULL,
  `selectItemId` int(11) NOT NULL DEFAULT 0,
  `selectName` varchar(45) DEFAULT NULL,
  `select_desc_kr` varchar(45) NOT NULL,
  `index` int(3) NOT NULL DEFAULT 0,
  `enchantLevel` int(2) NOT NULL DEFAULT 0,
  `attrLevel` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `item_selector_warehouse`
--

INSERT INTO `item_selector_warehouse` (`itemId`, `name`, `desc_kr`, `selectItemId`, `selectName`, `select_desc_kr`, `index`, `enchantLevel`, `attrLevel`) VALUES
(51110, 'Class Change: Monarch', '올 클래스 체인지 상자', 51093, 'Class Change: Monarch', '클래스 변경: 군주', 0, 0, 0),
(51110, 'Class Change: Knight', '올 클래스 체인지 상자', 51094, 'Class Change: Knight', '클래스 변경: 기사', 1, 0, 0),
(51110, 'Class Changed: Elf', '올 클래스 체인지 상자', 51095, 'Class Changed: Elf', '클래스 변경: 요정', 2, 0, 0),
(51110, 'Class Change: Wizard', '올 클래스 체인지 상자', 51096, 'Class Change: Wizard', '클래스 변경: 마법사', 3, 0, 0),
(51110, 'Class Change: Dark Elf', '올 클래스 체인지 상자', 51097, 'Class Change: Dark Elf', '클래스 변경: 다크엘프', 4, 0, 0),
(51110, 'Class Change: Dragon Knight', '올 클래스 체인지 상자', 51098, 'Class Change: Dragon Knight', '클래스 변경: 용기사', 5, 0, 0),
(51110, 'Class Change: Illusionist', '올 클래스 체인지 상자', 51099, 'Class Change: Illusionist', '클래스 변경: 환술사', 6, 0, 0),
(51110, 'Class Changed: Warrior', '올 클래스 체인지 상자', 51100, 'Class Changed: Warrior', '클래스 변경: 전사', 7, 0, 0),
(51110, 'Class Change: Fencer', '올 클래스 체인지 상자', 51101, 'Class Change: Fencer', '클래스 변경: 검사', 8, 0, 0),
(51110, 'Class Change: Lancer', '올 클래스 체인지 상자', 51102, 'Class Change: Lancer', '클래스 변경: 창기사', 9, 0, 0);
