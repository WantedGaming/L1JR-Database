
-- --------------------------------------------------------

--
-- Table structure for table `character_teleport`
--

CREATE TABLE `character_teleport` (
  `id` int(10) UNSIGNED NOT NULL,
  `num_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `speed_id` int(10) NOT NULL DEFAULT -1,
  `char_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `locx` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `locy` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `mapid` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `randomX` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `randomY` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `item_obj_id` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `character_teleport`
--

INSERT INTO `character_teleport` (`id`, `num_id`, `speed_id`, `char_id`, `name`, `locx`, `locy`, `mapid`, `randomX`, `randomY`, `item_obj_id`) VALUES
(299679280, 0, -1, 268500218, 'test', 32579, 32940, 0, 0, 0, 0),
(299679282, 0, -1, 268457033, 'Juvid', 32613, 32745, 4, 0, 0, 0),
(299679283, 1, -1, 268457033, 'aanon', 33108, 33356, 4, 0, 0, 0),
(299679284, 2, -1, 268457033, 'Kuen', 32630, 32801, 4, 0, 0, 0),
(299679285, 0, -1, 299879861, 'Patata', 34042, 32287, 4, 0, 0, 0),
(299679286, 0, -1, 334059223, 'Door_Not_Working', 32775, 32806, 2, 0, 0, 0),
(299679287, 1, -1, 334059223, 'Door_Working', 32664, 32808, 2, 0, 0, 0);
