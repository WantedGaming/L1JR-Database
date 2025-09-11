
-- --------------------------------------------------------

--
-- Table structure for table `character_companion`
--

CREATE TABLE `character_companion` (
  `item_objId` int(10) UNSIGNED NOT NULL,
  `objid` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(50) NOT NULL,
  `npcId` int(10) UNSIGNED NOT NULL,
  `level` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `exp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `maxHp` int(5) UNSIGNED NOT NULL DEFAULT 160,
  `currentHp` int(5) UNSIGNED NOT NULL DEFAULT 160,
  `friend_ship_marble` int(3) UNSIGNED NOT NULL DEFAULT 0,
  `friend_ship_guage` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `add_str` int(3) NOT NULL DEFAULT 0,
  `add_con` int(3) NOT NULL DEFAULT 0,
  `add_int` int(3) NOT NULL DEFAULT 0,
  `remain_stats` int(3) UNSIGNED NOT NULL DEFAULT 0,
  `elixir_use_count` int(2) UNSIGNED NOT NULL DEFAULT 0,
  `dead` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `oblivion` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `tier` int(1) NOT NULL DEFAULT 1,
  `wild` blob NOT NULL,
  `lessExp` int(10) NOT NULL DEFAULT 0,
  `traningTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `character_companion`
--

INSERT INTO `character_companion` (`item_objId`, `objid`, `name`, `npcId`, `level`, `exp`, `maxHp`, `currentHp`, `friend_ship_marble`, `friend_ship_guage`, `add_str`, `add_con`, `add_int`, `remain_stats`, `elixir_use_count`, `dead`, `oblivion`, `tier`, `wild`, `lessExp`, `traningTime`) VALUES
(332467403, 332467404, '도베르만', 7500018, 14, 38560, 246, 227, 0, 63400, 0, 0, 0, 1, 0, 0, 0, 1, 0x010007000f001500, 0, NULL);
