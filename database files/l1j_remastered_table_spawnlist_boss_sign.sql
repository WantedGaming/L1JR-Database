
-- --------------------------------------------------------

--
-- Table structure for table `spawnlist_boss_sign`
--

CREATE TABLE `spawnlist_boss_sign` (
  `id` int(10) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `desc_kr` varchar(100) NOT NULL,
  `bossId` int(10) NOT NULL DEFAULT 0,
  `npcId` int(10) NOT NULL DEFAULT 0,
  `locX` int(6) NOT NULL DEFAULT 0,
  `locY` int(6) NOT NULL DEFAULT 0,
  `locMapId` int(6) NOT NULL DEFAULT 0,
  `rndRange` int(3) NOT NULL DEFAULT 0,
  `aliveSecond` int(6) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `spawnlist_boss_sign`
--

INSERT INTO `spawnlist_boss_sign` (`id`, `name`, `desc_kr`, `bossId`, `npcId`, `locX`, `locY`, `locMapId`, `rndRange`, `aliveSecond`) VALUES
(1, 'Zenith Queen of Distortion', '제니스 거미알', 800144, 800173, 32826, 32808, 12852, 0, 1800),
(2, 'Zenith Queen of Distortion', '제니스 거미알', 800144, 800173, 32815, 32787, 12852, 0, 1800),
(3, 'Zenith Queen of Distortion', '제니스 거미알', 800144, 800174, 32817, 32809, 12852, 0, 1800),
(4, 'Zenith Queen of Distortion', '제니스 거미알', 800144, 800174, 32821, 32802, 12852, 0, 1800),
(5, 'Zenith Queen of Distortion', '제니스 거미알', 800144, 800174, 32822, 32790, 12852, 0, 1800),
(6, 'Zenith Queen of Distortion', '제니스 거미알', 800144, 800174, 32825, 32809, 12852, 0, 1800),
(7, 'Zenith Queen of Distortion', '제니스 거미알', 800144, 800174, 32828, 32793, 12852, 0, 1800),
(8, 'Zenith Queen of Distortion', '제니스 거미알', 800144, 800174, 32804, 32792, 12852, 0, 1800),
(9, 'Zenith Queen of Distortion', '제니스 거미알', 800144, 800175, 32806, 32810, 12852, 0, 1800),
(10, 'Zenith Queen of Distortion', '제니스 거미알', 800144, 800175, 32803, 32802, 12852, 0, 1800),
(11, 'Zenith Queen of Distortion', '제니스 거미알', 800144, 800175, 32807, 32796, 12852, 0, 1800),
(12, 'Zenith Queen of Distortion', '제니스 거미알', 800144, 800175, 32819, 32787, 12852, 0, 1800),
(13, 'Zenith Queen of Distortion', '제니스 거미알', 800144, 800175, 32824, 32785, 12852, 0, 1800),
(14, 'Zenith Queen of Distortion', '제니스 거미알', 800144, 800176, 32815, 32796, 12852, 0, 1800),
(15, 'Zenith Queen of Distortion', '제니스 거미알', 800144, 800176, 32809, 32804, 12852, 0, 1800),
(16, 'Zenith Queen of Distortion', '제니스 거미알', 800144, 800176, 32817, 32807, 12852, 0, 1800),
(17, 'Zenith Queen of Distortion', '제니스 거미알', 800144, 800176, 32826, 32797, 12852, 0, 1800),
(18, 'Distrust Seer', '시어 감시자', 800145, 800185, 32802, 32797, 12853, 5, 1800),
(19, 'Distrust Seer', '시어 감시자', 800145, 800177, 32805, 32789, 12853, 5, 1800),
(20, 'Distrust Seer', '시어 감시자', 800145, 800187, 32803, 32807, 12853, 5, 1800),
(21, 'Distrust Seer', '시어 감시자', 800145, 800188, 32807, 32796, 12853, 5, 1800),
(22, 'Horror Vampire', '뱀파이어 박쥐', 800158, 800186, 32802, 32794, 12854, 5, 1800),
(23, 'Horror Vampire', '뱀파이어 박쥐', 800158, 800178, 32809, 32791, 12854, 5, 1800),
(24, 'Horror Vampire', '뱀파이어 박쥐', 800158, 800178, 32793, 32790, 12854, 5, 1800),
(25, 'Immortal Mummy Lord', '머미로드 모래폭풍', 800149, 800184, 32672, 32853, 12857, 5, 1800),
(26, 'Immortal Mummy Lord', '머미로드 모래폭풍', 800149, 800171, 32672, 32859, 12857, 5, 1800),
(27, 'Immortal Mummy Lord', '머미로드 모래폭풍', 800149, 800171, 32668, 32859, 12857, 5, 1800),
(28, 'Dark Knightvald', '나이트발드의 검', 800151, 800161, 32669, 32838, 12859, 5, 1800),
(29, 'Dark Knightvald', '나이트발드의 검', 800151, 800162, 32667, 32840, 12859, 5, 1800),
(30, 'Dark Knightvald', '나이트발드의 검', 800151, 800163, 32671, 32841, 12859, 5, 1800),
(31, 'Dark Knightvald', '나이트발드의 검', 800151, 800170, 32661, 32839, 12859, 5, 1800),
(32, 'Dark Knightvald', '나이트발드의 검', 800151, 800170, 32678, 32839, 12859, 5, 1800),
(33, 'Arrogant Ugnus', '우그누스 구름', 800153, 800179, 32812, 32779, 12861, 5, 1800),
(34, 'Arrogant Ugnus', '우그누스 구름', 800153, 800179, 32795, 32778, 12861, 5, 1800),
(35, 'Arrogant Ugnus', '우그누스 구름', 800153, 800179, 32805, 32793, 12861, 5, 1800);
