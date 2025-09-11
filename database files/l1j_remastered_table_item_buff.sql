
-- --------------------------------------------------------

--
-- Table structure for table `item_buff`
--

CREATE TABLE `item_buff` (
  `item_id` int(10) NOT NULL DEFAULT 0,
  `name` varchar(100) DEFAULT NULL,
  `skill_ids` varchar(100) NOT NULL DEFAULT '',
  `delete` enum('false','true') NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `item_buff`
--

INSERT INTO `item_buff` (`item_id`, `name`, `skill_ids`, `delete`) VALUES
(9995, 'Naruto Thank You Candy', '3082', 'true'),
(30104, 'Blessed Coin of Koma', '50007', 'true'),
(31117, 'Full Buff Potion', '25, 41, 47, 167, 22000, 1029, 4914, 50007, 113, 116', 'true'),
(65648, 'Coin of BlackSnake', '4914', 'true'),
(500076, '[Melee] Buff Potion', '13, 25, 41, 47, 159, 205, 210, 215, 147, 157, 150', 'true'),
(500077, '[Ranged] Buff Potion', '13, 25, 41, 47, 159, 205, 210, 215, 148, 150', 'true'),
(500078, '[Basic] Buff Potion', '25, 36, 41, 47', 'true'),
(2300081, 'Great Hero Spellbook', '25, 41', 'true'),
(3000084, 'Great Warrior Spell', '25, 41', 'true'),
(3110120, 'Hearty Blessing Scroll', '3085', 'true');
