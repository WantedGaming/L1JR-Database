
-- --------------------------------------------------------

--
-- Table structure for table `bin_einpoint_prob_table_common`
--

CREATE TABLE `bin_einpoint_prob_table_common` (
  `isLastChance` enum('true','false') NOT NULL DEFAULT 'false',
  `bonusPoint` int(3) NOT NULL DEFAULT 0,
  `prob` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `bin_einpoint_prob_table_common`
--

INSERT INTO `bin_einpoint_prob_table_common` (`isLastChance`, `bonusPoint`, `prob`) VALUES
('true', 1, 696500000),
('true', 2, 202150000),
('true', 3, 99850000),
('true', 4, 900000),
('true', 6, 550000),
('true', 9, 50000),
('false', 1, 984825000),
('false', 2, 10107500),
('false', 3, 4992500),
('false', 4, 45000),
('false', 6, 27500),
('false', 9, 2500);
