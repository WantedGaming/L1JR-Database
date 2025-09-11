
-- --------------------------------------------------------

--
-- Table structure for table `bin_treasureboxreward_common`
--

CREATE TABLE `bin_treasureboxreward_common` (
  `nameid` int(6) NOT NULL DEFAULT 0,
  `desc_kr` varchar(50) DEFAULT NULL,
  `grade` enum('Common(0)','Good(1)','Prime(2)','Legendary(3)') NOT NULL DEFAULT 'Common(0)'
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `bin_treasureboxreward_common`
--

INSERT INTO `bin_treasureboxreward_common` (`nameid`, `desc_kr`, `grade`) VALUES
(30265, '일반 보물 상자', 'Common(0)'),
(30266, '고급 보물 상자', 'Good(1)'),
(30267, '최고급 보물 상자', 'Prime(2)'),
(30268, '에바의 보물 상자', 'Legendary(3)');
