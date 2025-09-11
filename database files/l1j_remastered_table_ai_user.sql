
-- --------------------------------------------------------

--
-- Table structure for table `ai_user`
--

CREATE TABLE `ai_user` (
  `name` varchar(50) NOT NULL,
  `ai_type` enum('AI_BATTLE','COLOSEUM','HUNT','FISHING','TOWN_MOVE','SCARECROW_ATTACK') NOT NULL DEFAULT 'AI_BATTLE',
  `level` int(3) NOT NULL DEFAULT 0,
  `class` enum('lancer','fencer','warrior','illusionist','dragonknight','darkelf','wizard','elf','knight','crown') DEFAULT 'crown',
  `gender` enum('MALE(0)','FEMALE(1)') NOT NULL DEFAULT 'MALE(0)',
  `str` int(3) NOT NULL DEFAULT 0,
  `con` int(3) NOT NULL DEFAULT 0,
  `dex` int(3) NOT NULL DEFAULT 0,
  `inti` int(3) NOT NULL DEFAULT 0,
  `wis` int(3) NOT NULL DEFAULT 0,
  `cha` int(3) NOT NULL DEFAULT 0,
  `alignment` int(6) NOT NULL DEFAULT 0,
  `hit` int(3) NOT NULL DEFAULT 0,
  `bow_hit` int(3) NOT NULL DEFAULT 0,
  `dmg` int(3) NOT NULL DEFAULT 0,
  `bow_dmg` int(3) NOT NULL DEFAULT 0,
  `reduction` int(3) NOT NULL DEFAULT 0,
  `skill_hit` int(3) NOT NULL DEFAULT 0,
  `spirit_hit` int(3) NOT NULL DEFAULT 0,
  `dragon_hit` int(3) NOT NULL DEFAULT 0,
  `magic_hit` int(3) NOT NULL DEFAULT 0,
  `fear_hit` int(3) NOT NULL DEFAULT 0,
  `skill_regist` int(3) NOT NULL DEFAULT 0,
  `spirit_regist` int(3) NOT NULL DEFAULT 0,
  `dragon_regist` int(3) NOT NULL DEFAULT 0,
  `fear_regist` int(3) NOT NULL DEFAULT 0,
  `dg` int(3) NOT NULL DEFAULT 0,
  `er` int(3) NOT NULL DEFAULT 0,
  `me` int(3) NOT NULL DEFAULT 0,
  `mr` int(3) NOT NULL DEFAULT 0,
  `hp` int(4) NOT NULL DEFAULT 0,
  `mp` int(4) NOT NULL DEFAULT 0,
  `hpr` int(3) NOT NULL DEFAULT 0,
  `mpr` int(3) NOT NULL DEFAULT 0,
  `title` varchar(50) DEFAULT NULL,
  `clanId` int(2) NOT NULL DEFAULT 0,
  `clanname` varchar(50) DEFAULT NULL,
  `elfAttr` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `ai_user`
--

INSERT INTO `ai_user` (`name`, `ai_type`, `level`, `class`, `gender`, `str`, `con`, `dex`, `inti`, `wis`, `cha`, `alignment`, `hit`, `bow_hit`, `dmg`, `bow_dmg`, `reduction`, `skill_hit`, `spirit_hit`, `dragon_hit`, `magic_hit`, `fear_hit`, `skill_regist`, `spirit_regist`, `dragon_regist`, `fear_regist`, `dg`, `er`, `me`, `mr`, `hp`, `mp`, `hpr`, `mpr`, `title`, `clanId`, `clanname`, `elfAttr`) VALUES
('Alistair', 'AI_BATTLE', 91, 'illusionist', 'MALE(0)', 11, 18, 10, 55, 23, 8, -30000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2200, 1200, 0, 50, NULL, 3, 'Black Knights', 0),
('Aric', 'AI_BATTLE', 92, 'crown', 'MALE(0)', 55, 18, 12, 8, 23, 12, 32767, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2500, 600, 0, 0, NULL, 2, 'Red Knights', 0),
('Aveline', 'AI_BATTLE', 93, 'darkelf', 'FEMALE(1)', 55, 18, 15, 11, 23, 9, 32767, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2200, 800, 0, 0, NULL, 4, 'Golden Knights', 0),
('Beorn', 'AI_BATTLE', 91, 'warrior', 'MALE(0)', 55, 18, 12, 8, 23, 12, 32767, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3500, 500, 0, 0, NULL, 4, 'Golden Knights', 0),
('BOSS', 'AI_BATTLE', 94, 'darkelf', 'FEMALE(1)', 55, 18, 12, 8, 23, 12, 32767, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2500, 600, 0, 0, NULL, 4, 'Golden Knights', 0),
('Brienna', 'AI_BATTLE', 93, 'elf', 'FEMALE(1)', 11, 18, 55, 12, 23, 9, 32767, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2400, 1000, 0, 50, NULL, 2, 'Red Knights', 8),
('Corwin', 'AI_BATTLE', 90, 'elf', 'MALE(0)', 11, 18, 55, 12, 23, 9, -30000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2400, 1000, 0, 50, NULL, 4, 'Golden Knights', 8),
('Darian', 'AI_BATTLE', 94, 'fencer', 'MALE(0)', 55, 18, 13, 11, 23, 5, 32767, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3500, 500, 0, 0, NULL, 3, 'Black Knights', 0),
('Elara', 'AI_BATTLE', 92, 'dragonknight', 'FEMALE(1)', 55, 18, 11, 11, 23, 8, 32767, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2500, 500, 0, 0, NULL, 3, 'Black Knights', 0),
('Evander', 'AI_BATTLE', 90, 'warrior', 'MALE(0)', 55, 18, 12, 8, 23, 12, 32767, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3500, 500, 0, 0, NULL, 2, 'Red Knights', 0),
('Galahad', 'AI_BATTLE', 94, 'dragonknight', 'MALE(0)', 55, 18, 11, 11, 23, 8, 32767, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2500, 500, 0, 0, NULL, 2, 'Red Knights', 0),
('Gavriel', 'AI_BATTLE', 93, 'lancer', 'MALE(0)', 55, 18, 12, 9, 23, 6, 32767, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3800, 500, 0, 0, NULL, 3, 'Black Knights', 0),
('Gwendolyn', 'AI_BATTLE', 95, 'fencer', 'FEMALE(1)', 55, 18, 13, 11, 23, 5, 32767, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3500, 500, 0, 0, NULL, 3, 'Black Knights', 0),
('Isolde', 'AI_BATTLE', 92, 'warrior', 'FEMALE(1)', 55, 18, 12, 8, 23, 12, 32767, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3500, 500, 0, 0, NULL, 3, 'Black Knights', 0),
('Kaelen', 'AI_BATTLE', 93, 'knight', 'MALE(0)', 55, 18, 12, 8, 23, 12, 32767, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3100, 400, 0, 0, NULL, 2, 'Red Knights', 0),
('Lyanna', 'AI_BATTLE', 93, 'fencer', 'FEMALE(1)', 55, 18, 13, 11, 23, 5, 32767, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3500, 500, 0, 0, NULL, 2, 'Red Knights', 0),
('Morgana', 'AI_BATTLE', 91, 'crown', 'FEMALE(1)', 55, 18, 12, 8, 23, 12, 32767, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3100, 400, 0, 0, NULL, 3, 'Black Knights', 0),
('Rhys', 'AI_BATTLE', 95, 'knight', 'MALE(0)', 55, 18, 12, 8, 23, 12, -30000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3100, 400, 0, 0, NULL, 3, 'Black Knights', 0),
('Rowan', 'AI_BATTLE', 91, 'darkelf', 'FEMALE(1)', 55, 18, 15, 11, 23, 9, 32767, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2500, 800, 0, 0, NULL, 2, 'Red Knights', 0),
('Seraphina', 'AI_BATTLE', 91, 'knight', 'FEMALE(1)', 55, 18, 12, 8, 23, 12, 32767, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3100, 400, 0, 0, NULL, 4, 'Golden Knights', 0),
('Sirus', 'AI_BATTLE', 90, 'wizard', 'MALE(0)', 8, 18, 7, 55, 23, 8, 32767, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2200, 1600, 0, 50, NULL, 4, 'Golden Knights', 0),
('Thaddeus', 'AI_BATTLE', 96, 'darkelf', 'MALE(0)', 55, 18, 15, 11, 23, 9, 32767, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2500, 800, 0, 0, NULL, 3, 'Black Knights', 0),
('Thalassa', 'AI_BATTLE', 91, 'wizard', 'FEMALE(1)', 8, 18, 7, 55, 23, 8, 32767, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2200, 1600, 0, 50, NULL, 3, 'Black Knights', 0),
('Thorian', 'AI_BATTLE', 92, 'illusionist', 'MALE(0)', 11, 18, 10, 55, 23, 8, -30000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2200, 1200, 0, 50, NULL, 4, 'Golden Knights', 0),
('Torvald', 'AI_BATTLE', 92, 'lancer', 'MALE(0)', 55, 18, 12, 9, 23, 6, 32767, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3800, 500, 0, 0, NULL, 4, 'Golden Knights', 0),
('Tristan', 'AI_BATTLE', 93, 'dragonknight', 'MALE(0)', 55, 18, 11, 11, 23, 8, -30000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2500, 500, 0, 0, NULL, 4, 'Golden Knights', 0),
('Tyrus', 'AI_BATTLE', 92, 'wizard', 'MALE(0)', 8, 18, 7, 55, 23, 8, -30000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2200, 1600, 0, 50, NULL, 2, 'Red Knights', 0);
