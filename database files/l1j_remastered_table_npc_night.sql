
-- --------------------------------------------------------

--
-- Table structure for table `npc_night`
--

CREATE TABLE `npc_night` (
  `npcId` int(9) NOT NULL DEFAULT 0,
  `name` varchar(50) DEFAULT NULL,
  `targetMapId` int(5) NOT NULL DEFAULT 0,
  `targetId` int(9) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `npc_night`
--

INSERT INTO `npc_night` (`npcId`, `name`, `targetMapId`, `targetId`) VALUES
(72010, 'Minotaur', 70, 72052),
(72011, 'Minotaur', 70, 72053),
(72012, 'Bugbear', 70, 72039),
(72013, 'King Bugbear', 70, 72040),
(72016, 'Ettin', 70, 72048),
(72019, 'Cyclops', 70, 72049),
(72020, 'Ramia', 70, 72046),
(72021, 'Ramia', 70, 72047),
(72022, 'Werewolf', 70, 72041),
(72023, 'Lycanthrope', 70, 72042),
(72027, 'Alligator', 70, 72045),
(72028, 'Ghast', 70, 72043),
(72029, 'Ghast Lord', 70, 72044);
