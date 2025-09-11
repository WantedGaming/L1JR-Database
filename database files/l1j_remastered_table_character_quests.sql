
-- --------------------------------------------------------

--
-- Table structure for table `character_quests`
--

CREATE TABLE `character_quests` (
  `char_id` int(10) UNSIGNED NOT NULL,
  `quest_id` int(3) UNSIGNED NOT NULL DEFAULT 0,
  `quest_step` int(3) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `character_quests`
--

INSERT INTO `character_quests` (`char_id`, `quest_id`, `quest_step`) VALUES
(268457033, 35, 100),
(268457033, 55, 1),
(268500218, 100, 1),
(299879861, 55, 1),
(299879861, 100, 1),
(299901509, 100, 1),
(299987977, 100, 1),
(331885929, 100, 1),
(332131047, 100, 1),
(332269748, 100, 1),
(333323734, 100, 1),
(334059223, 95, 1),
(334766233, 95, 1);
