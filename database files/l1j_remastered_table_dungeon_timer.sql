
-- --------------------------------------------------------

--
-- Table structure for table `dungeon_timer`
--

CREATE TABLE `dungeon_timer` (
  `timerId` int(3) NOT NULL DEFAULT 0,
  `desc` varchar(50) DEFAULT NULL,
  `desc_kr` varchar(50) NOT NULL,
  `descId` varchar(50) DEFAULT NULL,
  `useType` enum('ACCOUNT','CHARACTER') NOT NULL DEFAULT 'ACCOUNT',
  `mapIds` text DEFAULT NULL,
  `timerValue` int(9) NOT NULL DEFAULT 0,
  `bonusLevel` int(3) NOT NULL DEFAULT 0,
  `bonusValue` int(9) NOT NULL DEFAULT 0,
  `pccafeBonusValue` int(9) NOT NULL DEFAULT 0,
  `resetType` enum('DAY','WEEK','NONE') NOT NULL DEFAULT 'DAY',
  `minLimitLevel` int(3) NOT NULL DEFAULT 0,
  `maxLimitLevel` int(3) NOT NULL DEFAULT 0,
  `serialId` int(6) NOT NULL DEFAULT 0,
  `serialDescId` varchar(50) DEFAULT NULL,
  `maxChargeCount` int(3) NOT NULL DEFAULT 0,
  `group` enum('NONE','HIDDEN_FIELD','SILVER_KNIGHT_DUNGEON','HIDDEN_FIELD_BOOST') NOT NULL DEFAULT 'NONE'
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `dungeon_timer`
--

INSERT INTO `dungeon_timer` (`timerId`, `desc`, `desc_kr`, `descId`, `useType`, `mapIds`, `timerValue`, `bonusLevel`, `bonusValue`, `pccafeBonusValue`, `resetType`, `minLimitLevel`, `maxLimitLevel`, `serialId`, `serialDescId`, `maxChargeCount`, `group`) VALUES
(1, 'Common', '일반', '$31711', 'ACCOUNT', '59,60,61,282,283,284,285,491,492,493', 10800, 90, 1800, 0, 'DAY', 0, 0, 8, '$31711', 0, 'NONE'),
(2, 'PC Room', 'PC방', '$19375', 'ACCOUNT', '430,624', 7200, 90, 1800, 3600, 'DAY', 0, 0, 15, '$19375', 0, 'NONE'),
(3, 'Land of the Outcast (PC)', '버림받은 자들의 땅(PC)', '$31213', 'ACCOUNT', '778', 7200, 0, 0, 0, 'DAY', 0, 0, 9, '$31213', 0, 'NONE'),
(4, 'Talking Island Dungeon', '말하는 섬 던전', '$23478', 'ACCOUNT', '1,2', 7200, 0, 0, 0, 'DAY', 30, 80, 100, '$23478', 0, 'NONE'),
(5, 'Black Battleship', '검은 전함', '$27281', 'ACCOUNT', '10,11,12', 7200, 0, 0, 0, 'DAY', 55, 80, 99, '$27281', 0, 'NONE'),
(6, 'Pet Hunting Ground', '펫 사냥터', NULL, 'ACCOUNT', '623,2041,2047,2053,2059', 7200, 0, 0, 0, 'DAY', 0, 0, 0, NULL, 0, 'NONE'),
(7, 'Temple of the Old Gods', '고대 신의 사원', NULL, 'ACCOUNT', '1209', 3600, 0, 0, 0, 'DAY', 0, 0, 0, NULL, 0, 'NONE'),
(8, 'Hidden Hunting Ground', '숨겨진 사냥터', NULL, 'ACCOUNT', '293,779,62,494', 0, 0, 0, 0, 'WEEK', 0, 0, 0, NULL, 21, 'HIDDEN_FIELD'),
(9, 'Dragon Habitat', '드래곤 서식지', NULL, 'ACCOUNT', '140', 2400, 0, 0, 0, 'DAY', 0, 0, 0, NULL, 0, 'NONE'),
(10, 'Land of the Outcast (West) [Local]', '버림받은 자들의 땅(서쪽)[로컬]', '$36385', 'ACCOUNT', '777', 10800, 90, 1800, 0, 'DAY', 75, 92, 16, '$36385', 0, 'NONE'),
(11, 'Land of the Outcast (Interserver)', '버림받은 자들의 땅(인터서버)', '$37918', 'ACCOUNT', '11900,12900', 3600, 0, 0, 0, 'DAY', 0, 0, 30, '$37918', 0, 'NONE'),
(12, 'Silver Knight Dungeon', '은기사 던전', NULL, 'ACCOUNT', '7531,7532,7533,7534', 10800, 0, 0, 0, 'DAY', 0, 0, 0, NULL, 3, 'SILVER_KNIGHT_DUNGEON'),
(13, 'Hidden Hunting Ground BOOST', '숨겨진 사냥터 BOOST', NULL, 'ACCOUNT', '402,403,404,405', 0, 0, 0, 0, 'WEEK', 0, 0, 0, NULL, 12, 'HIDDEN_FIELD_BOOST');
