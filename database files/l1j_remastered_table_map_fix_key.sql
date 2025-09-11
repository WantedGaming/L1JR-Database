
-- --------------------------------------------------------

--
-- Table structure for table `map_fix_key`
--

CREATE TABLE `map_fix_key` (
  `locX` smallint(6) UNSIGNED NOT NULL,
  `locY` smallint(6) UNSIGNED NOT NULL,
  `mapId` smallint(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `map_fix_key`
--

INSERT INTO `map_fix_key` (`locX`, `locY`, `mapId`) VALUES
(33314, 32413, 4),
(33358, 32308, 4),
(33359, 32307, 4),
(33411, 32351, 4),
(33412, 32352, 4),
(33413, 32351, 4),
(33433, 32792, 4),
(33434, 32792, 4),
(33435, 32792, 4),
(33436, 32792, 4),
(33437, 32792, 4),
(33438, 32792, 4);
