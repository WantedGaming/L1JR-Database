
-- --------------------------------------------------------

--
-- Table structure for table `ub_settings`
--

CREATE TABLE `ub_settings` (
  `ub_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `ub_name` varchar(45) NOT NULL DEFAULT '',
  `ub_mapid` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `ub_area_x1` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `ub_area_y1` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `ub_area_x2` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `ub_area_y2` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `min_lvl` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `max_lvl` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `max_player` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `enter_royal` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `enter_knight` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `enter_mage` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `enter_elf` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `enter_darkelf` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `enter_dragonknight` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `enter_illusionist` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `enter_Warrior` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `enter_Fencer` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `enter_Lancer` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `enter_male` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `enter_female` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `use_pot` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `hpr_bonus` int(10) NOT NULL DEFAULT 0,
  `mpr_bonus` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `ub_settings`
--

INSERT INTO `ub_settings` (`ub_id`, `ub_name`, `ub_mapid`, `ub_area_x1`, `ub_area_y1`, `ub_area_x2`, `ub_area_y2`, `min_lvl`, `max_lvl`, `max_player`, `enter_royal`, `enter_knight`, `enter_mage`, `enter_elf`, `enter_darkelf`, `enter_dragonknight`, `enter_illusionist`, `enter_Warrior`, `enter_Fencer`, `enter_Lancer`, `enter_male`, `enter_female`, `use_pot`, `hpr_bonus`, `mpr_bonus`) VALUES
(1, 'Giran Colosseum', 5557, 33512, 32679, 33557, 32727, 65, 99, 50, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0);
