
-- --------------------------------------------------------

--
-- Table structure for table `character_hunting_quest`
--

CREATE TABLE `character_hunting_quest` (
  `id` int(10) NOT NULL DEFAULT 0,
  `objID` int(10) NOT NULL DEFAULT 0,
  `map_number` int(6) DEFAULT 0,
  `location_desc` int(3) DEFAULT 0,
  `quest_id` int(3) DEFAULT NULL,
  `kill_count` int(3) DEFAULT NULL,
  `complete` enum('true','false') DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `character_hunting_quest`
--

INSERT INTO `character_hunting_quest` (`id`, `objID`, `map_number`, `location_desc`, `quest_id`, `kill_count`, `complete`) VALUES
(2, 332269748, 491, 0, 44, 0, 'false'),
(3, 336314493, 3000, 0, 101, 0, 'false');
