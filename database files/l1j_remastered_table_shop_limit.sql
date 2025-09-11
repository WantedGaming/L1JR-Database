
-- --------------------------------------------------------

--
-- Table structure for table `shop_limit`
--

CREATE TABLE `shop_limit` (
  `shopId` int(9) NOT NULL DEFAULT 0,
  `itemId` int(9) NOT NULL DEFAULT 0,
  `itemName` varchar(50) DEFAULT NULL,
  `limitTerm` enum('WEEK','DAY','NONE') NOT NULL DEFAULT 'DAY',
  `limitCount` int(9) NOT NULL DEFAULT 0,
  `limitType` enum('ACCOUNT','CHARACTER') NOT NULL DEFAULT 'ACCOUNT'
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `shop_limit`
--

INSERT INTO `shop_limit` (`shopId`, `itemId`, `itemName`, `limitTerm`, `limitCount`, `limitType`) VALUES
(70017, 40074, 'Armor Enchant Scroll', 'DAY', 1, 'ACCOUNT'),
(70017, 210064, 'Scroll of Enchant Weapon: Wind', 'DAY', 1, 'ACCOUNT'),
(70017, 210065, 'Scroll of Enchant Weapon: Earth', 'DAY', 1, 'ACCOUNT'),
(70017, 210066, 'Scroll of Enchant Weapon: Water', 'DAY', 1, 'ACCOUNT'),
(70017, 210067, 'Scroll of Enchant Weapon: Fire', 'DAY', 1, 'ACCOUNT'),
(70017, 210068, 'Scroll of Enchant Accessory', 'DAY', 1, 'ACCOUNT'),
(70302, 30861, 'Silver Knight Dungeon Sandglass', 'DAY', 3, 'ACCOUNT'),
(81018, 500150, 'Special Starter Pack', 'NONE', 1, 'CHARACTER'),
(81021, 60413, 'Blessed Healing Potion', 'DAY', 1, 'ACCOUNT'),
(81021, 60414, 'Blessed Mana Potion', 'DAY', 1, 'ACCOUNT'),
(81021, 700029, 'Ivory Tower Magical Essence (10)', 'DAY', 1, 'ACCOUNT'),
(81021, 820018, 'Pure Elixir', 'DAY', 1, 'ACCOUNT'),
(81021, 900050, 'Misophia Spaulder', 'WEEK', 1, 'ACCOUNT'),
(81021, 900051, 'Boots of Misophia', 'WEEK', 1, 'ACCOUNT'),
(81021, 3000049, 'Petition Deed', 'DAY', 1, 'ACCOUNT'),
(81022, 30940, 'Proof of Protection', 'NONE', 1, 'ACCOUNT'),
(81026, 8025, 'Domination Transformation Scroll', 'DAY', 5, 'ACCOUNT'),
(81026, 31162, 'Decisive Battle Scroll', 'DAY', 5, 'ACCOUNT'),
(81026, 60415, 'Mana Saving Potion', 'DAY', 5, 'ACCOUNT'),
(81026, 840040, 'Spellbook of Talas', 'WEEK', 1, 'ACCOUNT'),
(90079, 43050, 'Keplisha\'s Accessory Scroll', 'DAY', 5, 'ACCOUNT'),
(90079, 43052, 'Keplisha Pure Elixir Box (EXP)', 'DAY', 1, 'ACCOUNT'),
(90079, 43053, 'Keplisha\'s Crystal of Chaos', 'DAY', 1, 'ACCOUNT'),
(90079, 43054, 'Keplisha\'s Mana Potion', 'DAY', 3, 'ACCOUNT'),
(90079, 43057, 'Keplisha\'s Mysterious Cube', 'DAY', 1, 'ACCOUNT'),
(90079, 420092, 'Dimension Key', 'DAY', 1, 'ACCOUNT'),
(90079, 810000, 'Unicorn Temple Key', 'WEEK', 5, 'ACCOUNT'),
(90079, 810003, 'Craftsman Weapon Scroll', 'DAY', 1, 'ACCOUNT'),
(90079, 850003, 'Craftman\'s Armor Enchant Scroll', 'DAY', 1, 'ACCOUNT');
