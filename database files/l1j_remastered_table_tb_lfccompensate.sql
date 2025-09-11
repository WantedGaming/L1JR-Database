
-- --------------------------------------------------------

--
-- Table structure for table `tb_lfccompensate`
--

CREATE TABLE `tb_lfccompensate` (
  `ID` int(10) NOT NULL,
  `LFCID` int(2) DEFAULT 0,
  `PARTITION` int(10) DEFAULT 0,
  `TYPE` varchar(20) DEFAULT NULL,
  `IDENTITY` int(10) DEFAULT 0,
  `QUANTITY` int(50) DEFAULT 0,
  `LEVEL` int(10) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `tb_lfccompensate`
--

INSERT INTO `tb_lfccompensate` (`ID`, `LFCID`, `PARTITION`, `TYPE`, `IDENTITY`, `QUANTITY`, `LEVEL`) VALUES
(1, 1, 1, 'item', 41159, 10, 0),
(2, 3, 1, 'item', 41159, 10, 0),
(3, 9, 1, 'item', 41159, 10, 0);
