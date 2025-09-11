
-- --------------------------------------------------------

--
-- Table structure for table `penalty_protect_item`
--

CREATE TABLE `penalty_protect_item` (
  `itemId` int(10) NOT NULL DEFAULT 0,
  `name` varchar(45) DEFAULT NULL,
  `desc_kr` varchar(45) NOT NULL,
  `type` enum('have','equip') DEFAULT 'have',
  `itemPanalty` enum('false','true') DEFAULT 'false',
  `expPanalty` enum('false','true') DEFAULT 'false',
  `dropItemId` int(10) DEFAULT 0,
  `msgId` int(5) DEFAULT NULL,
  `mapIds` text DEFAULT NULL,
  `remove` enum('false','true') DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `penalty_protect_item`
--

INSERT INTO `penalty_protect_item` (`itemId`, `name`, `desc_kr`, `type`, `itemPanalty`, `expPanalty`, `dropItemId`, `msgId`, `mapIds`, `remove`) VALUES
(21095, 'Halloween Gloves', '아놀드의 장갑', 'equip', 'true', 'true', 30145, 3802, NULL, 'true'),
(90010, 'Advanced Immortal Protect', '고급 불멸의 가호', 'have', 'true', 'true', 90012, 3803, NULL, 'true'),
(90011, 'Immortal Protection', '불멸의 가호', 'have', 'false', 'true', 90013, 3803, NULL, 'true'),
(900004, 'Succubus Contract', '서큐버스의 계약', 'equip', 'false', 'true', 131152, 3802, NULL, 'true'),
(900005, 'Succubus Queen Contract', '서큐버스 퀸의 계약', 'equip', 'true', 'true', 31152, 3802, NULL, 'true'),
(900022, 'Ancient Blessings', '고대의 가호', 'equip', 'true', 'true', 3000122, 3802, '1700,1701,1702,1703,1704,1705,1706,1707,1708,1709,1710', 'true');
