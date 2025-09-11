
-- --------------------------------------------------------

--
-- Table structure for table `bin_portrait_common`
--

CREATE TABLE `bin_portrait_common` (
  `asset_id` int(5) NOT NULL DEFAULT 0,
  `desc_id` varchar(100) DEFAULT NULL,
  `desc_kr` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `bin_portrait_common`
--

INSERT INTO `bin_portrait_common` (`asset_id`, `desc_id`, `desc_kr`) VALUES
(3509, '$30265', '테온'),
(3510, '$30266', '라스'),
(3511, '$30267', '데포로쥬'),
(3512, '$30268', '라라'),
(3513, '$30269', '군터'),
(3514, '$30270', '이실로테'),
(3515, '$30271', '장로'),
(3516, '$30272', '질리언'),
(3517, '$30273', '케레니스');
