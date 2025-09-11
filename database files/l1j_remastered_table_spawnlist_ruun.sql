
-- --------------------------------------------------------

--
-- Table structure for table `spawnlist_ruun`
--

CREATE TABLE `spawnlist_ruun` (
  `id` int(3) UNSIGNED NOT NULL,
  `stage` int(3) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(45) NOT NULL DEFAULT '',
  `npcId` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `locX` int(6) UNSIGNED NOT NULL DEFAULT 0,
  `locY` int(6) UNSIGNED NOT NULL DEFAULT 0,
  `mapId` int(6) UNSIGNED NOT NULL DEFAULT 0,
  `range` int(3) UNSIGNED NOT NULL DEFAULT 0,
  `count` int(3) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `spawnlist_ruun`
--

INSERT INTO `spawnlist_ruun` (`id`, `stage`, `name`, `npcId`, `locX`, `locY`, `mapId`, `range`, `count`) VALUES
(1, 1, 'Puppet Master', 70206, 32800, 32767, 4000, 0, 1),
(2, 2, 'Watcher Ruun Doll', 70203, 32858, 32766, 4001, 15, 5),
(3, 2, 'Executive Ruun Doll', 70204, 32858, 32766, 4001, 15, 5),
(4, 2, 'Scout Leader', 70207, 32888, 32766, 4001, 0, 1),
(5, 3, 'Watcher Ruun Doll', 70203, 32920, 32767, 4001, 10, 8),
(6, 3, 'Executive Ruun Doll', 70204, 32920, 32767, 4001, 10, 8),
(7, 3, 'Doctor Strange', 70208, 32934, 32767, 4001, 0, 1),
(8, 4, 'Stone Statue of Rune', 70205, 32844, 32800, 4002, 20, 15),
(9, 4, 'Funny Clown', 70209, 32867, 32801, 4002, 0, 1),
(10, 5, 'Stone Statue of Rune', 70205, 32954, 32799, 4002, 20, 15),
(11, 5, 'Swordmaster', 70210, 32969, 32799, 4002, 0, 1);
