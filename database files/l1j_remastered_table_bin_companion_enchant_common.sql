
-- --------------------------------------------------------

--
-- Table structure for table `bin_companion_enchant_common`
--

CREATE TABLE `bin_companion_enchant_common` (
  `tier` int(3) NOT NULL,
  `enchantCost` text DEFAULT NULL,
  `openCost` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `bin_companion_enchant_common`
--

INSERT INTO `bin_companion_enchant_common` (`tier`, `enchantCost`, `openCost`) VALUES
(1, 'FRIEND_SHIP: 3 OR 4 OR 5 OR 7 OR 10 OR 15 OR 25 OR 50 OR 100 OR 200\r\nCATALYST_ITEM: : 25678', 'LEVEL: 1\r\nMIN_ENCHANT: 0\r\nFRIENSHIP: 0\r\nADENA: 0\r\n'),
(2, 'FRIEND_SHIP: 13 OR 24 OR 35 OR 47 OR 60 OR 75 OR 95 OR 130 OR 190 OR 300\r\nCATALYST_ITEM: : 25678', 'LEVEL: 41\r\nMIN_ENCHANT: 4\r\nFRIENSHIP: 0\r\nADENA: 100000\r\n'),
(3, 'FRIEND_SHIP: 28 OR 54 OR 80 OR 107 OR 135 OR 165 OR 200 OR 250 OR 325 OR 450\r\nCATALYST_ITEM: : 25678', 'LEVEL: 51\r\nMIN_ENCHANT: 4\r\nFRIENSHIP: 0\r\nADENA: 500000\r\n'),
(4, 'FRIEND_SHIP: 48 OR 94 OR 140 OR 187 OR 235 OR 285 OR 340 OR 410 OR 505 OR 650\r\nCATALYST_ITEM: : 25678', 'LEVEL: 61\r\nMIN_ENCHANT: 4\r\nFRIENSHIP: 0\r\nADENA: 1000000\r\n'),
(5, 'FRIEND_SHIP: 73 OR 144 OR 215 OR 287 OR 360 OR 435 OR 515 OR 610 OR 730 OR 900\r\nCATALYST_ITEM: : 25678', 'LEVEL: 71\r\nMIN_ENCHANT: 4\r\nFRIENSHIP: 0\r\nADENA: 5000000\r\n');
