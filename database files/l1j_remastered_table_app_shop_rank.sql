
-- --------------------------------------------------------

--
-- Table structure for table `app_shop_rank`
--

CREATE TABLE `app_shop_rank` (
  `group_type` enum('1.All','2.Weapon','3.Armor','4.Accessory','5.Other') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '1.All',
  `shop_type` enum('1.Sell','2.Buy') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '1.Sell',
  `id` int(1) NOT NULL DEFAULT 0,
  `item_id` int(10) NOT NULL DEFAULT 0,
  `enchant` int(3) NOT NULL DEFAULT 0,
  `search_rank` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `app_shop_rank`
--

INSERT INTO `app_shop_rank` (`group_type`, `shop_type`, `id`, `item_id`, `enchant`, `search_rank`) VALUES
('1.All', '1.Sell', 1, 40074, 0, 0),
('1.All', '1.Sell', 2, 2300072, 0, 0),
('1.All', '1.Sell', 3, 203044, 7, 0),
('1.All', '1.Sell', 4, 751, 0, 0),
('1.All', '1.Sell', 5, 203047, 10, 0),
('1.All', '2.Buy', 1, 40074, 0, 0),
('1.All', '2.Buy', 2, 40087, 0, 0),
('1.All', '2.Buy', 3, 2300072, 0, 1),
('1.All', '2.Buy', 4, 222355, 8, 0),
('1.All', '2.Buy', 5, 830008, 0, 0),
('2.Weapon', '1.Sell', 1, 203044, 7, 0),
('2.Weapon', '1.Sell', 2, 203047, 10, 0),
('2.Weapon', '1.Sell', 3, 604, 9, 1),
('2.Weapon', '1.Sell', 4, 212, 9, -1),
('2.Weapon', '1.Sell', 5, 127, 9, 0),
('2.Weapon', '2.Buy', 1, 9, 9, 2),
('2.Weapon', '2.Buy', 2, 212, 9, -1),
('2.Weapon', '2.Buy', 3, 601, 9, 0),
('2.Weapon', '2.Buy', 4, 119, 0, 0),
('2.Weapon', '2.Buy', 5, 203047, 10, -1),
('3.Armor', '1.Sell', 1, 222342, 8, 0),
('3.Armor', '1.Sell', 2, 22263, 5, 0),
('3.Armor', '1.Sell', 3, 222324, 7, 0),
('3.Armor', '1.Sell', 4, 20168, 7, 0),
('3.Armor', '1.Sell', 5, 900041, 5, 0),
('3.Armor', '2.Buy', 1, 222355, 8, 0),
('3.Armor', '2.Buy', 2, 20187, 0, 0),
('3.Armor', '2.Buy', 3, 22208, 5, 0),
('3.Armor', '2.Buy', 4, 900028, 7, -2),
('3.Armor', '2.Buy', 5, 222351, 7, 0),
('4.Accessory', '1.Sell', 1, 222304, 7, 0),
('4.Accessory', '1.Sell', 2, 222350, 7, -1),
('4.Accessory', '1.Sell', 3, 493005, 0, 0),
('4.Accessory', '1.Sell', 4, 493004, 7, 0),
('4.Accessory', '1.Sell', 5, 20288, 0, 1),
('4.Accessory', '2.Buy', 1, 222304, 7, 0),
('4.Accessory', '2.Buy', 2, 222350, 7, 2),
('4.Accessory', '2.Buy', 3, 222346, 6, 2),
('4.Accessory', '2.Buy', 4, 493004, 7, -3),
('4.Accessory', '2.Buy', 5, 202811, 0, -1),
('5.Other', '1.Sell', 1, 40074, 0, 0),
('5.Other', '1.Sell', 2, 2300072, 0, 0),
('5.Other', '1.Sell', 3, 751, 0, 0),
('5.Other', '1.Sell', 4, 40087, 0, 0),
('5.Other', '1.Sell', 5, 140100, 0, 0),
('5.Other', '2.Buy', 1, 40074, 0, 0),
('5.Other', '2.Buy', 2, 40087, 0, 0),
('5.Other', '2.Buy', 3, 2300072, 0, 1),
('5.Other', '2.Buy', 4, 830008, 0, 0),
('5.Other', '2.Buy', 5, 830010, 0, 0);
