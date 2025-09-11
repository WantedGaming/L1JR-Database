
-- --------------------------------------------------------

--
-- Table structure for table `droptype_npc`
--

CREATE TABLE `droptype_npc` (
  `mobId` int(11) NOT NULL DEFAULT 0,
  `name` varchar(45) DEFAULT NULL,
  `desc_kr` varchar(45) NOT NULL,
  `type` enum('map','share') NOT NULL DEFAULT 'map'
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `droptype_npc`
--

INSERT INTO `droptype_npc` (`mobId`, `name`, `desc_kr`, `type`) VALUES
(5100, 'Lindvior', '린드비오르', 'map'),
(81163, 'Girtas', '기르타스', 'map'),
(400016, 'Thebes Anubis', '테베 아누비스', 'share'),
(400017, 'Thebes Horus', '테베 호루스', 'share'),
(800552, 'Azur', '아주르', 'map'),
(800554, 'Trodon', '트로돈', 'map'),
(900013, 'Antharas', '안타라스', 'map'),
(900040, 'Fafurion', '파푸리온', 'map'),
(900519, 'Halpas', '할파스', 'map'),
(7311162, 'Valakas', '발라카스', 'map');
