
-- --------------------------------------------------------

--
-- Table structure for table `tb_bookquest_compensate`
--

CREATE TABLE `tb_bookquest_compensate` (
  `id` int(10) NOT NULL,
  `difficulty` int(3) DEFAULT 1,
  `type` varchar(20) NOT NULL,
  `num1` int(10) DEFAULT NULL,
  `num2` int(10) DEFAULT NULL,
  `id1` int(10) DEFAULT NULL,
  `id2` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `tb_bookquest_compensate`
--

INSERT INTO `tb_bookquest_compensate` (`id`, `difficulty`, `type`, `num1`, `num2`, `id1`, `id2`) VALUES
(1, 1, 'exp', 10000, 0, 0, 0),
(2, 1, 'buff', 1800, 6841, 1541, 1426),
(4, 2, 'exp', 10000, 0, 0, 0),
(5, 2, 'buff', 1800, 6841, 1541, 1426),
(7, 3, 'exp', 10000, 0, 0, 0),
(8, 3, 'buff', 1800, 6841, 1541, 1426);
