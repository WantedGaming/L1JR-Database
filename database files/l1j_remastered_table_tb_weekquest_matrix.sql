
-- --------------------------------------------------------

--
-- Table structure for table `tb_weekquest_matrix`
--

CREATE TABLE `tb_weekquest_matrix` (
  `difficulty` int(10) NOT NULL,
  `col1` int(10) DEFAULT NULL,
  `col2` int(10) DEFAULT NULL,
  `col3` int(10) DEFAULT NULL,
  `stamp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `tb_weekquest_matrix`
--

INSERT INTO `tb_weekquest_matrix` (`difficulty`, `col1`, `col2`, `col3`, `stamp`) VALUES
(0, 143, 170, 168, '2020-08-26 16:51:45'),
(1, 195, 248, 132, '2020-08-26 16:51:45'),
(2, 402, 325, 323, '2020-08-26 16:51:45');
