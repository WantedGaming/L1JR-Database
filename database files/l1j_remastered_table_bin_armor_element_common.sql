
-- --------------------------------------------------------

--
-- Table structure for table `bin_armor_element_common`
--

CREATE TABLE `bin_armor_element_common` (
  `type` int(2) NOT NULL DEFAULT 0,
  `enchant` int(2) NOT NULL DEFAULT 0,
  `fr` int(2) NOT NULL DEFAULT 0,
  `wr` int(2) NOT NULL DEFAULT 0,
  `ar` int(2) NOT NULL DEFAULT 0,
  `er` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `bin_armor_element_common`
--

INSERT INTO `bin_armor_element_common` (`type`, `enchant`, `fr`, `wr`, `ar`, `er`) VALUES
(0, 1, 2, 2, 2, 2),
(0, 2, 4, 4, 4, 4),
(0, 3, 6, 6, 6, 6),
(0, 4, 8, 8, 8, 8),
(1, 1, 2, 0, 0, 0),
(1, 2, 4, 0, 0, 0),
(1, 3, 6, 0, 0, 0),
(1, 4, 8, 0, 0, 0),
(2, 1, 0, 2, 0, 0),
(2, 2, 0, 4, 0, 0),
(2, 3, 0, 6, 0, 0),
(2, 4, 0, 8, 0, 0),
(3, 1, 0, 0, 2, 0),
(3, 2, 0, 0, 4, 0),
(3, 3, 0, 0, 6, 0),
(3, 4, 0, 0, 8, 0),
(4, 1, 0, 0, 0, 2),
(4, 2, 0, 0, 0, 4),
(4, 3, 0, 0, 0, 6),
(4, 4, 0, 0, 0, 8);
