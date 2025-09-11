
-- --------------------------------------------------------

--
-- Table structure for table `serverinfo`
--

CREATE TABLE `serverinfo` (
  `id` varchar(255) NOT NULL DEFAULT '',
  `adenmake` bigint(30) DEFAULT 0,
  `adenconsume` bigint(30) DEFAULT 0,
  `adentax` int(10) DEFAULT 0,
  `bugdividend` float(10,0) DEFAULT 0,
  `accountcount` int(10) DEFAULT 0,
  `charcount` int(10) DEFAULT 0,
  `pvpcount` int(10) DEFAULT 0,
  `penaltycount` int(10) DEFAULT 0,
  `clanmaker` int(10) DEFAULT 0,
  `maxuser` int(10) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `serverinfo`
--

INSERT INTO `serverinfo` (`id`, `adenmake`, `adenconsume`, `adentax`, `bugdividend`, `accountcount`, `charcount`, `pvpcount`, `penaltycount`, `clanmaker`, `maxuser`) VALUES
('2022-01-02', 0, 2569, 0, 0, 0, 0, 0, 0, 0, 1),
('2022-01-07', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('2022-01-08', 0, 2902, 0, 0, 0, 0, 0, 0, 0, 1),
('2022-01-09', 3208415, 1727, 0, 0, 0, 0, 0, 0, 0, 1),
('2022-01-21', 0, 300, 0, 0, 0, 0, 0, 0, 0, 1),
('2022-01-22', 0, 758, 0, 0, 0, 0, 0, 0, 0, 1),
('2022-01-29', 382075, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('2022-01-31', 0, 762, 0, 0, 0, 0, 0, 0, 0, 1),
('2022-02-02', 0, 266, 0, 0, 0, 0, 0, 0, 0, 1),
('2022-02-05', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
('2022-02-08', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
('2022-02-09', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
('2022-02-10', 0, 100, 0, 0, 0, 0, 0, 0, 0, 1),
('2022-02-11', 0, 100, 0, 0, 0, 0, 0, 0, 0, 1),
('2022-02-12', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
('2022-02-13', 0, 552, 0, 0, 0, 0, 0, 0, 0, 1),
('2022-02-14', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
