
-- --------------------------------------------------------

--
-- Table structure for table `weapon_skill_spell_def`
--

CREATE TABLE `weapon_skill_spell_def` (
  `id` int(10) NOT NULL,
  `def_dmg` int(5) DEFAULT NULL,
  `def_ratio` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `weapon_skill_spell_def`
--

INSERT INTO `weapon_skill_spell_def` (`id`, `def_dmg`, `def_ratio`) VALUES
(0, 5, 5),
(1, 7, 10),
(2, 10, 15),
(3, 13, 20),
(4, 15, 25),
(5, 22, 30),
(6, 30, 32),
(7, 37, 34),
(8, 45, 36),
(9, 52, 38),
(10, 56, 43),
(11, 59, 50),
(12, 62, 60),
(13, 65, 72),
(14, 67, 82),
(15, 69, 84),
(16, 71, 86),
(17, 73, 88),
(18, 74, 90),
(19, 75, 92);
