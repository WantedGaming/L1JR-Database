
-- --------------------------------------------------------

--
-- Table structure for table `shop_aden`
--

CREATE TABLE `shop_aden` (
  `id` int(10) NOT NULL,
  `itemid` int(10) DEFAULT NULL,
  `itemname` varchar(22) DEFAULT NULL,
  `price` int(10) DEFAULT NULL,
  `type` int(10) DEFAULT 0,
  `status` int(10) DEFAULT 0,
  `html` varchar(22) DEFAULT '',
  `pack` int(10) DEFAULT 0,
  `enchant` int(10) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `shop_aden`
--

INSERT INTO `shop_aden` (`id`, `itemid`, `itemname`, `price`, `type`, `status`, `html`, `pack`, `enchant`) VALUES
(3, 1000006, 'Dragon Treasure Chest', 100, 0, 1, '', 0, 0),
(4, 3000062, 'Growth Fishing Set', 100, 0, 1, '', 0, 0),
(5, 30105, 'Glowing Growth Potion', 5, 2, 1, '', 0, 0),
(6, 31159, 'Warrior Enchant Scroll', 5, 2, 1, '', 0, 0),
(7, 31160, 'Archer Enchant Scroll', 5, 2, 1, '', 0, 0),
(8, 31161, 'Wizard Enchant Scroll', 5, 2, 1, '', 0, 0),
(9, 2300072, 'Hero Relic Bag', 5, 3, 1, '', 0, 0),
(10, 560029, 'Elephant Teleport Book', 100, 0, 1, '', 100, 0),
(11, 600226, 'Fruith of Growth (3d)', 100, 0, 1, '', 0, 0),
(12, 51160, 'Hero Protection (3d)', 100, 2, 1, '', 0, 0),
(15, 500220, 'Witch\'s Mana Potion', 300, 2, 1, '', 3, 0),
(16, 3110091, 'Bible of Atonement Box', 100, 0, 1, '', 0, 0),
(17, 200000, 'Candle of Reminiscence', 300, 0, 1, '', 0, 0),
(18, 1500214, 'Spartoi Magic Doll Box', 100, 1, 1, '', 0, 0),
(19, 1500215, 'Magic Doll: Scarecrow ', 100, 1, 1, '', 0, 0);
