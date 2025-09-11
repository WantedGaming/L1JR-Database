
-- --------------------------------------------------------

--
-- Table structure for table `polyitems`
--

CREATE TABLE `polyitems` (
  `itemId` int(10) NOT NULL DEFAULT 0,
  `name` varchar(50) DEFAULT NULL,
  `polyId` int(6) NOT NULL DEFAULT 0,
  `duration` int(6) NOT NULL DEFAULT 1800,
  `type` enum('domination','normal') NOT NULL DEFAULT 'normal',
  `delete` enum('false','true') NOT NULL DEFAULT 'true'
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `polyitems`
--

INSERT INTO `polyitems` (`itemId`, `name`, `polyId`, `duration`, `type`, `delete`) VALUES
(8000, 'Death Knight Polymorph Scroll', 12792, 1800, 'normal', 'true'),
(8001, 'Black Death Knight Polymorph Scroll', 15154, 1800, 'normal', 'true'),
(8002, 'Light Death Knight Polymorph Scroll', 12015, 1800, 'normal', 'true'),
(8005, 'Monarch Ball (Male)', 21817, 900, 'normal', 'true'),
(8006, 'Monarch Ball (Male)', 21789, 900, 'normal', 'true'),
(8007, 'Knight Ball (Male)', 15115, 900, 'normal', 'true'),
(8008, 'Knight Ball (Male)', 13721, 900, 'normal', 'true'),
(8009, 'Elf Ball (Male)', 13723, 900, 'normal', 'true'),
(8010, 'Elf Ball (Male)', 13725, 900, 'normal', 'true'),
(8011, 'Wizard Ball (Male)', 20263, 900, 'normal', 'true'),
(8012, 'Wizard Ball (Male)', 20270, 900, 'normal', 'true'),
(8013, 'Dark Elf Ball (Male)', 13731, 900, 'normal', 'true'),
(8014, 'Dark Elf Ball (Male)', 13733, 900, 'normal', 'true'),
(8015, 'Dragon Knight Ball (Male)', 21624, 900, 'normal', 'true'),
(8016, 'Dragon Knight Ball (Male)', 21653, 900, 'normal', 'true'),
(8017, 'Illusionist Ball (Male)', 21098, 900, 'normal', 'true'),
(8018, 'Illusionist Ball (Male)', 21094, 900, 'normal', 'true'),
(8019, 'Warrior Ball (Male)', 20619, 900, 'normal', 'true'),
(8020, 'Warrior Ball (Male)', 20612, 900, 'normal', 'true'),
(8021, 'Fencer Ball (Male)', 18555, 900, 'normal', 'true'),
(8022, 'Fencer Ball (Male)', 18551, 900, 'normal', 'true'),
(8023, 'Lancer Orb', 19824, 900, 'normal', 'true'),
(8024, 'Lancer Orb', 19825, 900, 'normal', 'true'),
(30057, 'Chibikko (Blue) Transformation Mace', 10429, 1800, 'normal', 'true'),
(30058, 'Chibikko (Yellow) Transformation Mace', 10431, 1800, 'normal', 'true'),
(30059, 'Chibikko (Pink) Transformation Mace', 10430, 1800, 'normal', 'true'),
(41143, 'Skeletal Pirate Captain Poly Potion', 6086, 1800, 'normal', 'true'),
(41144, 'Skeletal Pirate Soldier Poly Potion', 6087, 1800, 'normal', 'true'),
(41145, 'Skeletal Pirate Rogue Poly Potion', 6088, 1800, 'normal', 'true'),
(41154, 'Scale of Darkness', 3101, 600, 'normal', 'true'),
(41155, 'Scale of Flames', 3126, 600, 'normal', 'true'),
(41156, 'Scale of Immorality', 3888, 600, 'normal', 'true'),
(41157, 'Scale of Hatred', 3784, 600, 'normal', 'true'),
(220001, 'Psy Polymorph Scroll (Gangnam Style)', 11232, 600, 'normal', 'true'),
(220002, 'Psy Polymorph Scroll (Bird)', 11234, 600, 'normal', 'true'),
(220003, 'Psy Polymorph Scroll (Champion)', 11236, 600, 'normal', 'true'),
(3000066, 'New Polymorph Scroll', 12283, 1800, 'normal', 'true'),
(3000067, 'New Polymorph Scroll', 12280, 1800, 'normal', 'true'),
(3000068, 'New Polymorph Scroll', 12286, 1800, 'normal', 'true'),
(3000069, 'New Polymorph Scroll', 12314, 1800, 'normal', 'true');
