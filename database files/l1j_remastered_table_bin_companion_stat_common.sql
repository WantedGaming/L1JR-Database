
-- --------------------------------------------------------

--
-- Table structure for table `bin_companion_stat_common`
--

CREATE TABLE `bin_companion_stat_common` (
  `id` int(3) NOT NULL DEFAULT 0,
  `statType` enum('INT(2)','CON(1)','STR(0)') NOT NULL DEFAULT 'STR(0)',
  `value` int(3) NOT NULL DEFAULT 0,
  `meleeDmg` int(3) NOT NULL DEFAULT 0,
  `meleeHit` int(3) NOT NULL DEFAULT 0,
  `regenHP` int(3) NOT NULL DEFAULT 0,
  `ac` int(3) NOT NULL DEFAULT 0,
  `spellDmg` int(3) NOT NULL DEFAULT 0,
  `spellHit` int(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `bin_companion_stat_common`
--

INSERT INTO `bin_companion_stat_common` (`id`, `statType`, `value`, `meleeDmg`, `meleeHit`, `regenHP`, `ac`, `spellDmg`, `spellHit`) VALUES
(1, 'STR(0)', 20, 1, 1, 0, 0, 0, 0),
(2, 'STR(0)', 30, 1, 1, 0, 0, 0, 0),
(3, 'CON(1)', 20, 0, 0, 1, -1, 0, 0),
(4, 'CON(1)', 30, 0, 0, 1, -1, 0, 0),
(5, 'INT(2)', 20, 0, 0, 0, 0, 5, 1),
(6, 'INT(2)', 30, 0, 0, 0, 0, 5, 1);
