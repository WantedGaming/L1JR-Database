
-- --------------------------------------------------------

--
-- Table structure for table `tb_weekquest_updateinfo`
--

CREATE TABLE `tb_weekquest_updateinfo` (
  `id` int(3) NOT NULL,
  `lastTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `tb_weekquest_updateinfo`
--

INSERT INTO `tb_weekquest_updateinfo` (`id`, `lastTime`) VALUES
(1, '2020-08-26 16:51:45');
