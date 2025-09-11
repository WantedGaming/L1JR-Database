
-- --------------------------------------------------------

--
-- Table structure for table `robot_location`
--

CREATE TABLE `robot_location` (
  `uid` int(10) UNSIGNED NOT NULL,
  `istown` enum('true','false') NOT NULL DEFAULT 'false',
  `x` int(10) NOT NULL,
  `y` int(10) NOT NULL,
  `map` int(10) NOT NULL,
  `etc` text NOT NULL,
  `count` int(10) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `robot_location`
--

INSERT INTO `robot_location` (`uid`, `istown`, `x`, `y`, `map`, `etc`, `count`) VALUES
(1, 'false', 32809, 32732, 53, 'Giran Prison 1F', 1),
(2, 'false', 32800, 32774, 53, 'Giran Prison 1F', 1),
(3, 'false', 32784, 32731, 53, 'Giran Prison 1F', 1),
(9, 'false', 32807, 32726, 53, 'Giran Prison 1F', 1),
(5, 'false', 32736, 32788, 54, 'Giran Prison  2F', 1),
(7, 'false', 32942, 32774, 280, '4th floor of the ivory tower', 1),
(4, 'false', 32805, 32737, 53, 'Giran Prison 1F', 1),
(12, 'false', 32669, 32869, 33, 'Dragon Valley Caves 4F', 1),
(21, 'false', 32802, 32758, 31, 'Dragon Valley Caves 2F', 1),
(13, 'false', 32746, 32802, 35, 'Dragon Valley Caves 5F', 1),
(14, 'false', 32663, 32846, 36, 'Dragon Valley Caves 6F', 1),
(22, 'false', 32769, 32755, 30, 'Dragon Valley Caves 1F', 1),
(15, 'false', 32803, 32760, 31, 'Dragon Valley Caves 2F', 1),
(16, 'false', 32770, 32758, 30, 'Dragon Valley Caves 1F', 1),
(17, 'false', 32809, 32732, 53, 'Giran Prison 1F', 1),
(18, 'false', 32809, 32729, 53, 'Giran Prison 1F', 1),
(19, 'false', 32806, 32732, 53, 'Giran Prison 1F', 1),
(8, 'false', 32808, 32733, 53, 'Giran Prison 1F', 1),
(6, 'false', 32804, 32735, 53, 'Giran Prison 1F', 1),
(20, 'false', 32710, 32816, 32, 'Dragon Valley Caves 3F', 1),
(23, 'false', 32773, 32755, 30, 'Dragon Valley Caves 1F', 1),
(33, 'false', 32807, 32731, 25, 'Silver Knight Dungeon 1F', 1),
(26, 'false', 32802, 32730, 53, 'Giran Prison 1F', 1),
(27, 'false', 32642, 33015, 1700, 'No Forgotten Island', 1),
(28, 'false', 32650, 33010, 1700, 'No Forgotten Island', 1),
(10, 'false', 32804, 32722, 53, 'Giran Prison 1F', 1),
(11, 'false', 32801, 32721, 53, 'Giran Prison 1F', 1),
(29, 'false', 32806, 32730, 25, 'Silver Knight Dungeon 1F', 1),
(30, 'false', 32806, 32746, 26, 'Silver Knight Dungeon 2F', 1),
(31, 'false', 32808, 32766, 27, 'Silver Knight Dungeon 3F', 1),
(32, 'false', 32799, 32798, 28, 'Silver Knight Dungeon 4F', 1),
(34, 'false', 32808, 32732, 25, 'Silver Knight Dungeon 1F', 1),
(35, 'false', 32805, 32745, 26, 'Silver Knight Dungeon 2F', 1),
(36, 'false', 32805, 32745, 26, 'Silver Knight Dungeon 2F', 1),
(37, 'false', 32808, 32765, 27, 'Silver Knight Dungeon 3F', 1),
(38, 'false', 32809, 32764, 27, 'Silver Knight Dungeon 3F', 1),
(39, 'false', 32798, 32799, 28, 'Silver Knight Dungeon 4F', 1),
(40, 'false', 32797, 32797, 28, 'Silver Knight Dungeon 4F', 1);
