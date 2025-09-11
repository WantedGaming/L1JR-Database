
-- --------------------------------------------------------

--
-- Table structure for table `clan_bless_buff`
--

CREATE TABLE `clan_bless_buff` (
  `number` int(10) UNSIGNED NOT NULL,
  `buff_id` int(10) NOT NULL DEFAULT -1,
  `map_name` varchar(45) NOT NULL DEFAULT '',
  `teleport_map_id` int(6) UNSIGNED DEFAULT 0,
  `teleport_x` int(6) UNSIGNED DEFAULT 0,
  `teleport_y` int(6) UNSIGNED DEFAULT 0,
  `buff_map_list` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `clan_bless_buff`
--

INSERT INTO `clan_bless_buff` (`number`, `buff_id`, `map_name`, `teleport_map_id`, `teleport_x`, `teleport_y`, `buff_map_list`) VALUES
(1, 5250, 'Wind Dragon\'s Lair', 4, 34122, 32797, '15410'),
(2, 5251, 'Oren Snow Mountain', 4, 34120, 32193, '15420'),
(3, 5252, 'Dragon Valley', 4, 33331, 32463, '15430'),
(4, 5253, 'Fire Dragon\'s Lair', 4, 33639, 32423, '15440'),
(5, 5254, 'Training dungeon (all floors)', 4, 33143, 33358, '25,26,27,28'),
(6, 5255, 'Gludio Dungeon (all floors)', 4, 32727, 32922, '807,808,809,810,811,812,813'),
(7, 5256, 'Eva Kingdom (all floors)', 4, 33618, 33505, '59,60,61,63,65'),
(8, 5257, 'Dragon Valley Dungeon (all floors)', 4, 33331, 32463, '30,31,32,33,35,36,37'),
(9, 5258, 'Domination Barrier (all floors)', 4, 33698, 32495, '15403,15404'),
(10, 5259, 'Tower of Arrogance (Local) 1st to 3rd floors', 4, 34251, 33453, '101,102,103'),
(11, 5260, 'Tower of Arrogance (Local) 4th to 6th floors', 4, 34251, 33453, '104,105,106'),
(12, 5261, 'Tower of Arrogance (Local) 7th to 10th floors', 4, 34251, 33453, '107,108,109,110');
