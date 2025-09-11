
-- --------------------------------------------------------

--
-- Table structure for table `bin_indun_common`
--

CREATE TABLE `bin_indun_common` (
  `mapKind` int(3) NOT NULL DEFAULT 0,
  `keyItemId` int(5) NOT NULL DEFAULT 0,
  `minPlayer` int(2) NOT NULL DEFAULT 0,
  `maxPlayer` int(2) NOT NULL DEFAULT 0,
  `minAdena` int(6) NOT NULL DEFAULT 0,
  `maxAdena` int(6) NOT NULL DEFAULT 0,
  `minLevel` varchar(100) DEFAULT NULL,
  `bmkeyItemId` int(5) NOT NULL DEFAULT 0,
  `eventKeyItemId` int(5) NOT NULL DEFAULT 0,
  `dungeon_type` enum('UNDEFINED(0)','DEFENCE_TYPE(1)','DUNGEON_TYPE(2)') NOT NULL DEFAULT 'UNDEFINED(0)',
  `enable_boost_mode` enum('false','true') NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `bin_indun_common`
--

INSERT INTO `bin_indun_common` (`mapKind`, `keyItemId`, `minPlayer`, `maxPlayer`, `minAdena`, `maxAdena`, `minLevel`, `bmkeyItemId`, `eventKeyItemId`, `dungeon_type`, `enable_boost_mode`) VALUES
(202, 27487, 2, 4, 5000, 20000, '80,85,90', 27488, 27538, 'DEFENCE_TYPE(1)', 'false'),
(203, 27487, 1, 3, 5000, 20000, '80,85,90', 27488, 27538, 'UNDEFINED(0)', 'false'),
(204, 27487, 4, 8, 5000, 20000, '80,85,90', 27488, 27538, 'UNDEFINED(0)', 'false'),
(206, 27487, 4, 8, 5000, 20000, '83,85,90', 27488, 27538, 'UNDEFINED(0)', 'false');
