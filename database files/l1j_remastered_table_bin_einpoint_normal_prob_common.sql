
-- --------------------------------------------------------

--
-- Table structure for table `bin_einpoint_normal_prob_common`
--

CREATE TABLE `bin_einpoint_normal_prob_common` (
  `Normal_level` int(3) NOT NULL DEFAULT 0,
  `prob` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `bin_einpoint_normal_prob_common`
--

INSERT INTO `bin_einpoint_normal_prob_common` (`Normal_level`, `prob`) VALUES
(0, 100000000),
(1, 111111111),
(2, 125000000),
(3, 142857142),
(4, 166666666),
(5, 200000000),
(6, 250000000),
(7, 333333333),
(8, 500000000),
(9, 1000000000);
