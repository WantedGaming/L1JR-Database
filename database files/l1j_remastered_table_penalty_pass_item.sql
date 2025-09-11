
-- --------------------------------------------------------

--
-- Table structure for table `penalty_pass_item`
--

CREATE TABLE `penalty_pass_item` (
  `itemId` int(10) NOT NULL DEFAULT 0,
  `desc` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `penalty_pass_item`
--

INSERT INTO `penalty_pass_item` (`itemId`, `desc`) VALUES
(40308, 'Adena');
