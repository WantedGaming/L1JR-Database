
-- --------------------------------------------------------

--
-- Table structure for table `bin_treasurebox_common`
--

CREATE TABLE `bin_treasurebox_common` (
  `id` int(2) NOT NULL DEFAULT 0,
  `name` varchar(45) DEFAULT NULL,
  `excavateTime` int(2) NOT NULL DEFAULT 0,
  `desc_id` varchar(45) DEFAULT NULL,
  `desc_kr` varchar(45) DEFAULT NULL,
  `grade` enum('Common(0)','Good(1)','Prime(2)','Legendary(3)') NOT NULL DEFAULT 'Common(0)'
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `bin_treasurebox_common`
--

INSERT INTO `bin_treasurebox_common` (`id`, `name`, `excavateTime`, `desc_id`, `desc_kr`, `grade`) VALUES
(0, 'treasure grade1', 15, '36223', '일반 보물', 'Common(0)'),
(1, 'treasure grade2', 30, '36224', '고급 보물', 'Good(1)'),
(2, 'treasure grade3', 40, '36225', '최고급 보물', 'Prime(2)'),
(3, 'treasure grade4', 50, '36226', '에바의 보물', 'Legendary(3)');
