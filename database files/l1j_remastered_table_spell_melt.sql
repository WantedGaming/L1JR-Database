
-- --------------------------------------------------------

--
-- Table structure for table `spell_melt`
--

CREATE TABLE `spell_melt` (
  `skillId` int(5) NOT NULL DEFAULT -1,
  `skillName` varchar(50) DEFAULT NULL,
  `passiveId` int(3) NOT NULL DEFAULT 0,
  `classType` enum('lancer','fencer','warrior','illusionist','dragonknight','darkelf','wizard','elf','knight','crown') NOT NULL DEFAULT 'crown',
  `skillItemId` int(9) NOT NULL DEFAULT 0,
  `meltItemId` int(9) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `spell_melt`
--

INSERT INTO `spell_melt` (`skillId`, `skillName`, `passiveId`, `classType`, `skillItemId`, `meltItemId`) VALUES
(-1, '$28224', 10, 'knight', 5603, 32091),
(-1, '$28232', 11, 'darkelf', 5606, 32091),
(-1, '$28244', 13, 'warrior', 5607, 32091),
(-1, '$28238', 15, 'dragonknight', 5610, 32091),
(-1, '$29486', 16, 'dragonknight', 300092, 32091),
(-1, '$29488', 17, 'illusionist', 300094, 32091),
(-1, '$30683', 22, 'elf', 40286, 32092),
(-1, '$30892', 30, 'fencer', 2025, 32091),
(-1, '$30893', 31, 'fencer', 2027, 32092),
(-1, '$30905', 36, 'fencer', 2026, 32091),
(-1, '$32747', 52, 'lancer', 3016, 32091),
(-1, '$32748', 53, 'lancer', 3017, 32092),
(-1, '$33767', 69, 'illusionist', 300095, 32091),
(-1, '$34997', 76, 'wizard', 43018, 32091),
(-1, '$30906', 81, 'fencer', 2029, 32091),
(-1, '$35905', 82, 'crown', 40293, 32091),
(-1, '$35914', 86, 'knight', 42033, 32091),
(-1, '$35917', 89, 'elf', 40292, 32091),
(78, '$1485', 0, 'wizard', 40222, 32091),
(90, '$15501', 0, 'knight', 41148, 32091),
(111, '$13934', 0, 'darkelf', 5559, 32091),
(122, '$29247', 0, 'crown', 40285, 32091),
(135, '$29246', 0, 'elf', 40284, 32091),
(138, '$31467', 0, 'elf', 40288, 32091),
(229, '$19108', 0, 'warrior', 210125, 32091),
(240, '$30681', 0, 'crown', 40287, 32092),
(241, '$30682', 0, 'knight', 42000, 32092),
(242, '$30684', 0, 'wizard', 41500, 32092),
(243, '$30685', 0, 'darkelf', 40280, 32092),
(244, '$30686', 0, 'dragonknight', 220010, 32092),
(245, '$30687', 0, 'illusionist', 220050, 32092),
(5026, '$36459', 0, 'warrior', 210135, 32092),
(5112, '$33759', 0, 'elf', 40291, 32091),
(5114, '$33762', 0, 'wizard', 43014, 32091),
(5151, '$35000', 0, 'wizard', 43017, 32091),
(5156, '$35913', 0, 'knight', 42032, 32091),
(5157, '$35919', 0, 'elf', 40295, 32091);
