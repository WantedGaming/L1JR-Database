
-- --------------------------------------------------------

--
-- Table structure for table `beginner_quest_drop`
--

CREATE TABLE `beginner_quest_drop` (
  `classId` int(10) NOT NULL DEFAULT 0,
  `desc` varchar(50) DEFAULT NULL,
  `desc_kr` varchar(50) NOT NULL,
  `mainQuestId` int(3) NOT NULL DEFAULT 0,
  `mainItemNameId` int(10) NOT NULL DEFAULT 0,
  `subQuestId` int(3) NOT NULL DEFAULT 0,
  `subItemNameId` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `beginner_quest_drop`
--

INSERT INTO `beginner_quest_drop` (`classId`, `desc`, `desc_kr`, `mainQuestId`, `mainItemNameId`, `subQuestId`, `subItemNameId`) VALUES
(11357, 'Skeleton', '해골', 263, 16644, 0, 0),
(11358, 'Skeleton Pikeman', '해골 창병', 263, 16644, 0, 0),
(11359, 'Skeleton Axeman', '해골 도끼병', 263, 16644, 0, 0),
(11360, 'Skeleton Archer', '해골 궁수', 263, 16644, 0, 0),
(11361, 'Zombie', '좀비', 263, 16644, 0, 0),
(11386, 'Ghost', '유령', 263, 16644, 0, 0),
(12010, 'Orc', '오크', 285, 17927, 305, 17973),
(12011, 'Orc Archer', '오크 궁수', 285, 17927, 305, 17973),
(12012, 'Orc Fighter', '오크 전사', 285, 17927, 305, 17973),
(12013, 'Orc Pikeman', '오크 창병', 285, 17927, 305, 17973),
(12014, 'Orc Wizard', '오크 마법사', 285, 17927, 305, 17973),
(14410, 'Dwarf Swordsman', '드워프 검사', 273, 17926, 304, 17979),
(14411, 'Dwarf Archer', '드워프 궁수', 273, 17926, 304, 17979),
(14412, 'Dwarf Pikeman', '드워프 창병', 273, 17926, 304, 17979),
(14413, 'Dwarf Shaman', '드워프 주술사', 273, 17926, 304, 17979),
(14422, 'Dread Spider', '웅골리언트', 289, 17929, 306, 17975),
(14423, 'Arachnevil', '셸로브', 289, 17929, 306, 17975),
(14424, 'Black Knight', '흑기사', 298, 17971, 307, 17977),
(14425, 'Dire Wolf', '다이어울프', 298, 17971, 307, 17977),
(14426, 'Corroded Skeleton Fighter', '부식된 해골 돌격병', 281, 17924, 0, 0),
(14427, 'Corroded Skeleton Marksman', '부식된 해골 저격병', 281, 17924, 0, 0),
(14428, 'Corroded Skeleton Guard', '부식된 해골 근위병', 281, 17924, 0, 0),
(14456, 'Violent Boar', '포악한 멧돼지', 258, 17923, 0, 0),
(14464, 'Ferocious Boar', '사나운 멧돼지', 258, 17923, 0, 0);
