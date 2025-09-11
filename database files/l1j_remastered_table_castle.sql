
-- --------------------------------------------------------

--
-- Table structure for table `castle`
--

CREATE TABLE `castle` (
  `castle_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(45) NOT NULL DEFAULT '',
  `desc_kr` varchar(45) NOT NULL,
  `war_time` datetime DEFAULT NULL,
  `tax_rate` int(11) NOT NULL DEFAULT 0,
  `public_money` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `castle`
--

INSERT INTO `castle` (`castle_id`, `name`, `desc_kr`, `war_time`, `tax_rate`, `public_money`) VALUES
(1, 'Kent Castle', '켄트성', '2025-08-31 21:30:00', 10, 23247),
(2, 'Orc Fortress', '오크 요새', '2020-06-11 01:29:35', 10, 10800),
(3, 'Windawood Castle', '윈다우드성', '2008-10-18 17:00:00', 0, 0),
(4, 'Giran Castle', '기란성', '2021-05-17 03:01:35', 10, 254150066),
(5, 'Heine Castle', '하이네성', '2016-09-26 19:35:00', 0, 0),
(6, 'Dwarf Castle', '드워프성', '2008-10-18 17:00:00', 0, 0),
(7, 'Aden Castle', '아덴성', '2016-04-08 01:39:05', 0, 28242675),
(8, 'Diad Fortress', '디아드 요새', '2008-10-18 17:00:00', 0, 0);
