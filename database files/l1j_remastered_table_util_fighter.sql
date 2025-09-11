
-- --------------------------------------------------------

--
-- Table structure for table `util_fighter`
--

CREATE TABLE `util_fighter` (
  `Num` int(10) UNSIGNED NOT NULL,
  `WinCount` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `LoseCount` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `util_fighter`
--

INSERT INTO `util_fighter` (`Num`, `WinCount`, `LoseCount`) VALUES
(1, 6867, 7009),
(2, 7125, 7112),
(3, 7299, 7019),
(4, 7124, 7169),
(5, 6977, 7136),
(6, 7174, 7066),
(7, 6935, 7074),
(8, 7172, 6983),
(9, 7029, 7141),
(10, 0, 0),
(11, 7023, 7112),
(12, 7040, 7072),
(13, 7069, 7025),
(14, 7096, 7058);
