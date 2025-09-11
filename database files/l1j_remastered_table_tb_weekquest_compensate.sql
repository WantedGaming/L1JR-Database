
-- --------------------------------------------------------

--
-- Table structure for table `tb_weekquest_compensate`
--

CREATE TABLE `tb_weekquest_compensate` (
  `button_no` int(3) NOT NULL,
  `ingredient_itemId` int(10) DEFAULT 0,
  `compen_exp` int(10) DEFAULT 0,
  `compen_exp_level` int(10) DEFAULT 0,
  `compen_itemId` int(10) DEFAULT 0,
  `compen_itemCount` int(10) DEFAULT 0,
  `compen_itemLevel` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `tb_weekquest_compensate`
--

INSERT INTO `tb_weekquest_compensate` (`button_no`, `ingredient_itemId`, `compen_exp`, `compen_exp_level`, `compen_itemId`, `compen_itemCount`, `compen_itemLevel`) VALUES
(1, 0, 10000, 0, 0, 0, 0),
(2, 1000007, 100000, 0, 410139, 2, 0),
(3, 1000009, 220000, 0, 820019, 2, 0);
