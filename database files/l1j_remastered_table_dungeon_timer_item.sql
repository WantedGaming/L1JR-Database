
-- --------------------------------------------------------

--
-- Table structure for table `dungeon_timer_item`
--

CREATE TABLE `dungeon_timer_item` (
  `itemId` int(10) NOT NULL DEFAULT 0,
  `desc` varchar(50) DEFAULT NULL,
  `desc_kr` varchar(50) NOT NULL,
  `timerId` int(3) NOT NULL DEFAULT 0,
  `groupId` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `dungeon_timer_item`
--

INSERT INTO `dungeon_timer_item` (`itemId`, `desc`, `desc_kr`, `timerId`, `groupId`) VALUES
(30861, 'Silver Knight Dungeon Hourglass', '은기사 던전 모래 시계', 12, 0),
(1000011, 'Dungeon Reset: Normal', '던전 초기화 : 일반', 1, 0),
(1000012, 'Dungeon Reset: PC Room', '던전 초기화 : PC방', 2, 0),
(1000013, 'Hourglass of Hidden Dimension', '숨겨진 차원의 모래시계', 0, 1);
