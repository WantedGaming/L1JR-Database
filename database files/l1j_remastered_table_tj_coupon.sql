
-- --------------------------------------------------------

--
-- Table structure for table `tj_coupon`
--

CREATE TABLE `tj_coupon` (
  `objId` int(10) NOT NULL DEFAULT 0,
  `charId` int(10) NOT NULL DEFAULT 0,
  `itemId` int(10) NOT NULL DEFAULT 0,
  `count` int(10) NOT NULL DEFAULT 0,
  `enchantLevel` int(9) NOT NULL DEFAULT 0,
  `attrLevel` int(3) NOT NULL DEFAULT 0,
  `bless` int(3) NOT NULL DEFAULT 1,
  `lostTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `tj_coupon`
--

INSERT INTO `tj_coupon` (`objId`, `charId`, `itemId`, `count`, `enchantLevel`, `attrLevel`, `bless`, `lostTime`) VALUES
(332731746, 268457033, 20187, 1, 7, 0, 1, '2024-02-23 16:24:47'),
(332796598, 268457033, 22229, 1, 6, 0, 1, '2024-02-23 11:44:42'),
(332796601, 268457033, 22229, 1, 8, 0, 1, '2024-02-23 13:37:42'),
(332796603, 268457033, 22229, 1, 6, 0, 1, '2024-02-23 12:53:20'),
(332796604, 268457033, 22229, 1, 5, 0, 1, '2024-02-23 12:54:05'),
(332796605, 268457033, 22229, 1, 6, 0, 1, '2024-02-23 12:52:35');
