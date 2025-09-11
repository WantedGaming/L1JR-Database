
-- --------------------------------------------------------

--
-- Table structure for table `beginner_addteleport`
--

CREATE TABLE `beginner_addteleport` (
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
-- Dumping data for table `beginner_addteleport`
--

INSERT INTO `beginner_addteleport` (`id`, `num_id`, `speed_id`, `char_id`, `name`, `locx`, `locy`, `mapid`, `randomX`, `randomY`, `item_obj_id`) VALUES
(18, 18, -1, 0, '\\aH[Dungeon] Talking Island Dungeon', 32492, 32856, 9, 0, 0, 700024),
(14, 14, -1, 0, '\\aH[Dungeon] Ivory Tower', 34041, 32162, 4, 0, 0, 700024),
(15, 15, -1, 0, '\\aH[Dungeon] Gludio', 32730, 32922, 4, 0, 0, 700024),
(24, 24, -1, 0, '\\aD[Field] Oasis', 32862, 33250, 4, 0, 0, 700024),
(16, 16, -1, 0, '\\aH[Dungeon] Giran Dungeon', 33431, 32826, 4, 0, 0, 700024),
(23, 23, -1, 0, '\\aD[Field] Chaotic Temple', 32882, 32652, 4, 0, 0, 700024),
(22, 22, -1, 0, '\\aD[Field] Lawfull Temple', 33137, 32949, 4, 0, 0, 700024),
(20, 20, -1, 0, '\\aD[Field] Dragon Valley Entrance', 33337, 32466, 4, 0, 0, 700024),
(3, 3, -1, 0, '\\aL[Town] Giran', 33436, 32813, 4, 0, 0, 700024),
(7, 7, -1, 0, '\\aL[Town] Oren', 34052, 32285, 4, 0, 0, 700024),
(11, 11, -1, 0, '\\aL[Town] Weldern', 33721, 32493, 4, 0, 0, 700024),
(5, 5, -1, 0, '\\aL[Town] Kent', 33062, 32777, 4, 0, 0, 700024),
(4, 4, -1, 0, '\\aL[Town] Aden', 34086, 33147, 4, 0, 0, 700024),
(8, 8, -1, 0, '\\aL[Town] Silver Knight Town', 33081, 33397, 4, 0, 0, 700024),
(2, 2, -1, 0, '\\aL[Town] Gludin', 32618, 32796, 4, 0, 0, 700024),
(10, 10, -1, 0, '\\aL[Town] Woodbeck', 32616, 33186, 4, 0, 0, 700024),
(6, 6, -1, 0, '\\aL[Town] Heine', 33602, 33238, 4, 0, 0, 700024),
(9, 9, -1, 0, '\\aL[Town] Fire Field', 32744, 32444, 4, 0, 0, 700024),
(13, 13, -1, 0, '\\aL[Town] Pandora', 32637, 32952, 0, 0, 0, 700024),
(21, 21, -1, 0, '\\aD[Field] Dream Island', 33468, 32820, 4, 0, 0, 700024),
(1, 1, -1, 0, '\\aL[Town] Talking Island', 32575, 32942, 0, 0, 0, 700024),
(12, 12, -1, 0, '\\aL[Town] Vineyard', 32881, 32798, 4, 0, 0, 700024),
(19, 19, -1, 0, '\\aH[Dungeon] Elf Forest Dungeon', 32937, 32277, 4, 0, 0, 700024),
(17, 17, -1, 0, '\\aH[Dungeon] Ice Crystal Cave', 34087, 32269, 4, 0, 0, 700024),
(25, 25, -1, 0, '\\fV[Special] \\fWCenter of Ice Lake', 34002, 32329, 4, 0, 0, 700025),
(26, 26, -1, 0, '\\fV[Special] \\fWOutside of Ice Lake', 33994, 32332, 4, 0, 0, 700025),
(27, 27, -1, 0, '\\fV[Special] \\fWIce Cliff', 34089, 32163, 4, 0, 0, 700025),
(28, 28, -1, 0, '\\fV[Special] \\fWAden Small Boat', 34194, 33135, 4, 0, 0, 700025),
(29, 29, -1, 0, '\\fV[Special] \\fWDragon Valley Cliff', 33469, 32381, 4, 0, 0, 700025),
(30, 30, -1, 0, '\\fV[Special] \\fWHidden Turtle Island', 33343, 33163, 4, 0, 0, 700025),
(31, 31, -1, 0, '\\fV[Special] \\fWIsland of Spirit and Time', 32555, 32979, 4, 0, 0, 700025);
