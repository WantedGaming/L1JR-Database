
-- --------------------------------------------------------

--
-- Table structure for table `shop_info`
--

CREATE TABLE `shop_info` (
  `npcId` int(9) NOT NULL DEFAULT 0,
  `name` varchar(50) DEFAULT NULL,
  `type` enum('clan','ein','ncoin','tam','berry','item') NOT NULL DEFAULT 'item',
  `currencyId` int(9) NOT NULL DEFAULT 0,
  `currencyDescId` int(6) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `shop_info`
--

INSERT INTO `shop_info` (`npcId`, `name`, `type`, `currencyId`, `currencyDescId`) VALUES
(4, 'Hyeongmaeng Store', 'clan', 0, 28377),
(20, 'Simon', 'item', 60716, 26532),
(21, 'Simon', 'item', 60716, 26532),
(22, 'Simon', 'item', 60716, 26532),
(23, 'Simon', 'item', 60716, 26532),
(24, 'Simon', 'item', 60716, 26532),
(25, 'Simon', 'item', 60716, 26532),
(26, 'Simon', 'item', 60716, 26532),
(27, 'Simon', 'item', 60716, 26532),
(28, 'Simon', 'item', 60716, 26532),
(29, 'Simon', 'item', 60716, 26532),
(30, 'Evans', 'item', 60716, 26532),
(31, 'Evans', 'item', 60716, 26532),
(32, 'Evans', 'item', 60716, 26532),
(33, 'Evans', 'item', 60716, 26532),
(34, 'Evans', 'item', 60716, 26532),
(35, 'Evans', 'item', 60716, 26532),
(36, 'Evans', 'item', 60716, 26532),
(37, 'Evans', 'item', 60716, 26532),
(38, 'Evans', 'item', 60716, 26532),
(39, 'Evans', 'item', 60716, 26532),
(5072, 'Suspicious Visiting Merchant^Clown', 'item', 41159, 2671),
(5073, 'Suspicious Toy Merchant^Donkey', 'item', 41159, 2671),
(18306, 'Treasure Merchant^Rukia', 'item', 31178, 29886),
(40000, 'Sponsor Merchant^Shilene', 'item', 40000, 25184),
(81008, 'Server^Test', 'item', 41159, 2671),
(81020, 'Pandora\'s Assistant^Elara', 'item', 31150, 27027),
(81024, 'Event Merchant^Apis', 'item', 6019, 27644),
(81026, 'Medal of Valor^Varga', 'item', 43300, 29908),
(90079, 'Einhasad Merchant^Keplisha', 'ein', 0, 27513),
(100555, 'Coin Exchange^Joua', 'item', 60716, 26532),
(100556, 'Equipment Merchant^Evans', 'item', 60716, 26532),
(100703, 'Pet Merchant^Chris', 'item', 3200012, 25678),
(100801, 'Magic Merchant^Simon', 'item', 60716, 26532),
(200003, 'Server^Full Enchants', 'item', 41159, 2671),
(200005, 'Test Server^Various Runes', 'item', 41159, 2671),
(200060, 'Questionable Merchandise shop', 'item', 41159, 2671),
(200061, 'Suspicious Weapon Merchant', 'item', 41159, 2671),
(200062, 'Suspicious Mail Merchant', 'item', 41159, 2671),
(200063, 'Suspicious Transformer', 'item', 41159, 2671),
(202056, 'General Merchant^Serene', 'item', 60716, 26532),
(900047, 'Suspicious Cook^Buff Merchant', 'item', 41159, 2671),
(900107, 'Tomb Shop^Luniar Guardian', 'item', 410093, 11272),
(5000000, 'Suspicious Japan Merchant^Pixie', 'item', 41159, 2671),
(5000006, 'Server^Bead Shop', 'item', 3000032, 0),
(6000002, 'Feather Researcher^Feather', 'item', 41921, 25754),
(7000031, 'Fishy Merchant^Coha', 'item', 41921, 25754),
(7000077, 'Berry Merchant^Hen Berry', 'berry', 41302, 14921),
(7200002, 'Unicorn Temple Merchant^Kruna', 'tam', 0, 0),
(7210055, 'Feather Shop 1', 'item', 41159, 2671),
(7210056, 'Feather Shop 2', 'item', 41159, 2671),
(7210057, 'Feather Shop 3', 'item', 41159, 2671),
(7210058, 'Feather Shop 4', 'item', 41159, 2671),
(7210059, 'Feather Shop 5', 'item', 41159, 2671),
(7210061, 'Check Shop 1', 'item', 400254, 0),
(7210062, 'Check Shop 2', 'item', 400254, 0),
(7210063, 'Check Shop 3', 'item', 400254, 0),
(7210064, 'Check Shop 4', 'item', 400254, 0),
(7210065, 'Check Shop 5', 'item', 400254, 0),
(7210066, 'Check Shop 6', 'item', 400254, 0),
(7210067, 'Check Shop 7', 'item', 400254, 0),
(7210068, 'Check Shop 8', 'item', 400254, 0),
(7210069, 'Check Shop 9', 'item', 400254, 0),
(7210070, 'Check Shop 10', 'item', 31108, 16163),
(7220072, 'Garnet Shop^Orim Statue', 'item', 31151, 16661),
(7230010, 'Garnet Shop^Hardin Statue', 'item', 31177, 17839),
(7311108, 'Coin Collector Award^Den', 'item', 41922, 16848);
