
-- --------------------------------------------------------

--
-- Table structure for table `ai_user_drop`
--

CREATE TABLE `ai_user_drop` (
  `class` enum('lancer','fencer','warrior','illusionist','dragonknight','darkelf','wizard','elf','knight','crown','all') NOT NULL DEFAULT 'all',
  `itemId` int(10) NOT NULL DEFAULT 0,
  `name` varchar(100) DEFAULT NULL,
  `count` int(10) NOT NULL DEFAULT 1,
  `chance` int(3) NOT NULL DEFAULT 100
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `ai_user_drop`
--

INSERT INTO `ai_user_drop` (`class`, `itemId`, `name`, `count`, `chance`) VALUES
('lancer', 3013, 'Spear Thechnique (Recovery)', 1, 1),
('lancer', 20314, 'Ancient Giant Ring', 1, 1),
('lancer', 37082, 'Ring of Ancient Giant (Revival)', 1, 5),
('lancer', 37087, 'Ring of the Grim Reaper (Revival)', 1, 5),
('lancer', 37204, 'Spear (Recovery) (Revival)', 1, 5),
('lancer', 400107, 'Ring of the Grim Reaper', 1, 1),
('fencer', 2029, 'Fencer Tech (Phantom: Requiem)', 1, 1),
('fencer', 20314, 'Ancient Giant Ring', 1, 1),
('fencer', 37082, 'Ring of Ancient Giant (Revival)', 1, 5),
('fencer', 37087, 'Ring of the Grim Reaper (Revival)', 1, 1),
('fencer', 37214, 'Book of Fencer (Phantom: Requiem) (Revival)', 1, 5),
('fencer', 400107, 'Ring of the Grim Reaper', 1, 5),
('warrior', 5607, 'Warrior Seal (Desperado: Absolute)', 1, 1),
('warrior', 20314, 'Ancient Giant Ring', 1, 1),
('warrior', 37012, 'Warrior Seal (Desperado: Absolute) (Revival)', 1, 5),
('warrior', 37082, 'Ring of Ancient Giant (Revival)', 1, 5),
('warrior', 37087, 'Ring of the Grim Reaper (Revival)', 1, 5),
('warrior', 400107, 'Ring of the Grim Reaper', 1, 1),
('illusionist', 37088, 'Lich Ring (Revival)', 1, 5),
('illusionist', 37208, 'Lich Belt (Revival)', 1, 5),
('illusionist', 37219, 'Crystal of Memory (Bone Break: Last) (Revival)', 1, 5),
('illusionist', 90055, 'Lich Belt', 1, 1),
('illusionist', 300095, 'Crystal of Memory (Bone Break: Last)', 1, 1),
('illusionist', 400108, 'Lich Ring', 1, 1),
('dragonknight', 5610, 'Dragon Knight\'s Tablet (Foe Slayer: Brave)', 1, 1),
('dragonknight', 20314, 'Ancient Giant Ring', 1, 1),
('dragonknight', 37082, 'Ring of Ancient Giant (Revival)', 1, 5),
('dragonknight', 37087, 'Ring of the Grim Reaper (Revival)', 1, 5),
('dragonknight', 400107, 'Ring of the Grim Reaper', 1, 1),
('darkelf', 20314, 'Ancient Giant Ring', 1, 1),
('darkelf', 37082, 'Ring of Ancient Giant (Revival)', 1, 5),
('darkelf', 37087, 'Ring of the Grim Reaper (Revival)', 1, 5),
('darkelf', 37218, 'Black Spirit\'s Crystal (Moving Acceleration: Maximum) (Revival)', 1, 5),
('darkelf', 43016, 'Dark Spirit Crystal (Moving Acceleration: Maximum)', 1, 1),
('darkelf', 400107, 'Ring of the Grim Reaper', 1, 1),
('wizard', 37088, 'Lich Ring (Revival)', 1, 5),
('wizard', 37208, 'Lich Belt (Revival)', 1, 5),
('wizard', 43018, 'Spellbook (Disintegrate: Nemesis)', 1, 1),
('wizard', 90055, 'Lich Belt', 1, 1),
('wizard', 400108, 'Lich Ring', 1, 1),
('elf', 20314, 'Ancient Giant Ring', 1, 1),
('elf', 37082, 'Ring of Ancient Giant (Revival)', 1, 5),
('elf', 37087, 'Ring of the Grim Reaper (Revival)', 1, 5),
('elf', 37217, 'Spirit Crystal (Burning Shot) (Revival)', 1, 5),
('elf', 40295, 'Spirit Crystal (Burning Shot)', 1, 1),
('elf', 400107, 'Ring of the Grim Reaper', 1, 1),
('knight', 20314, 'Ancient Giant Ring', 1, 1),
('knight', 37082, 'Ring of Ancient Giant (Revival)', 1, 5),
('knight', 37087, 'Ring of the Grim Reaper (Revival)', 1, 5),
('knight', 42033, 'Tech Book (Counter Barrier: Master)', 1, 1),
('knight', 400107, 'Ring of the Grim Reaper', 1, 1),
('crown', 20314, 'Ancient Giant Ring', 1, 1),
('crown', 37082, 'Ring of Ancient Giant (Revival)', 1, 5),
('crown', 37087, 'Ring of the Grim Reaper (Revival)', 1, 5),
('crown', 37215, 'Spellbook (Empire: Overlord) (Revival)', 1, 5),
('crown', 40293, 'Spellbook (Empire: Overlord)', 1, 1),
('crown', 400107, 'Ring of the Grim Reaper', 1, 1),
('all', 20279, 'Leia\'s Ring', 1, 1),
('all', 37073, 'Leia\'s Ring (Revival)', 1, 5),
('all', 90012, 'Burnt High Class Immortal Protect', 1, 100),
('all', 90013, 'Burned Immortal Protection', 1, 100);
