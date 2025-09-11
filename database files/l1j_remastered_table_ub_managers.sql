
-- --------------------------------------------------------

--
-- Table structure for table `ub_managers`
--

CREATE TABLE `ub_managers` (
  `ub_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `ub_manager_npc_id` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `ub_managers`
--

INSERT INTO `ub_managers` (`ub_id`, `ub_manager_npc_id`) VALUES
(1, 50037),
(1, 50038),
(2, 50041),
(2, 50042),
(3, 50028),
(3, 50029),
(4, 50018),
(4, 50019),
(5, 50061),
(5, 50062),
(1, 150030),
(1, 150031),
(1, 150032),
(1, 150033),
(1, 150034);
