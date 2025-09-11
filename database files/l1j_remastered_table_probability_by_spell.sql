
-- --------------------------------------------------------

--
-- Table structure for table `probability_by_spell`
--

CREATE TABLE `probability_by_spell` (
  `skill_id` int(10) NOT NULL,
  `description` varchar(64) DEFAULT NULL,
  `desc_kr` varchar(64) DEFAULT NULL,
  `skill_type` enum('MAGICHIT','ABILITY','SPIRIT','DRAGONSPELL','FEAR') NOT NULL DEFAULT 'MAGICHIT',
  `pierce_lv_weight` varchar(16) DEFAULT '0.0',
  `resis_lv_weight` varchar(16) DEFAULT '0.0',
  `int_weight` varchar(16) DEFAULT '0.0',
  `mr_weight` varchar(16) DEFAULT '0.0',
  `pierce_weight` varchar(16) DEFAULT '0.0',
  `resis_weight` varchar(16) DEFAULT '0.0',
  `default_probability` int(10) DEFAULT 5,
  `min_probability` int(10) DEFAULT 5,
  `max_probability` int(10) DEFAULT 80,
  `is_loggin` enum('false','true') DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `probability_by_spell`
--

INSERT INTO `probability_by_spell` (`skill_id`, `description`, `desc_kr`, `skill_type`, `pierce_lv_weight`, `resis_lv_weight`, `int_weight`, `mr_weight`, `pierce_weight`, `resis_weight`, `default_probability`, `min_probability`, `max_probability`, `is_loggin`) VALUES
(17, 'Turn Undead', '턴 언데드', 'MAGICHIT', '0.0', '0.0', '1.3', '0.5', '0.0', '0.0', 10, 20, 70, 'true'),
(19, 'Curse:Blind', '커스: 블라인드', 'MAGICHIT', '0.0', '2.0', '1.0', '1.0', '0.5', '0.0', 30, 20, 50, 'true'),
(26, 'Weapon Break', '웨폰 브레이크', 'MAGICHIT', '0.0', '2.0', '1.0', '1.0', '0.2', '0.0', 30, 20, 50, 'true'),
(28, 'Slow', '슬로우', 'MAGICHIT', '0.0', '1.0', '1.0', '1.0', '0.5', '0.0', 30, 20, 50, 'true'),
(32, 'Curse:Paralize', '엠파이어', 'ABILITY', '1.0', '2.0', '0.0', '0.0', '1.0', '0.5', 40, 50, 70, 'true'),
(38, 'Mana Drain', '마나 드레인', 'MAGICHIT', '0.0', '1.0', '1.0', '1.0', '0.5', '0.0', 70, 20, 70, 'true'),
(39, 'Darkness', '다크니스', 'MAGICHIT', '0.0', '2.0', '1.0', '1.0', '0.5', '0.0', 30, 20, 50, 'true'),
(43, 'Cancellation', '캔슬레이션', 'MAGICHIT', '0.0', '2.0', '1.0', '1.0', '0.5', '0.0', 30, 15, 70, 'true'),
(63, 'Silence', '사일런스', 'MAGICHIT', '0.0', '2.0', '1.0', '1.0', '0.3', '0.0', 30, 20, 50, 'true'),
(65, 'Fog of Sleeping', '포그 오브 슬리핑', 'MAGICHIT', '0.0', '2.0', '1.0', '1.0', '0.5', '0.0', 55, 15, 50, 'true'),
(66, 'Shape Change', '셰이프 체인지', 'MAGICHIT', '0.0', '2.0', '1.0', '1.0', '0.4', '0.0', 30, 15, 50, 'true'),
(70, 'Fatal Potion', '디케이 포션', 'MAGICHIT', '0.0', '2.0', '1.0', '1.0', '0.3', '0.0', 30, 10, 50, 'true'),
(86, 'Shock Stun', '쇼크 스턴', 'ABILITY', '1.0', '2.0', '0.0', '0.0', '1.0', '0.5', 40, 35, 70, 'true'),
(102, 'Shadow Sleep', '쉐도우 슬립', 'SPIRIT', '2.0', '2.0', '0.0', '0.0', '1.0', '0.5', 60, 35, 70, 'true'),
(111, 'Armor Break', '아머 브레이크', 'SPIRIT', '2.0', '2.0', '0.0', '0.0', '1.0', '0.5', 60, 50, 70, 'true'),
(152, 'Erase Magic', '이레이즈 매직', 'SPIRIT', '2.0', '2.0', '0.0', '0.0', '1.0', '0.5', 45, 30, 70, 'true'),
(156, 'EarthBind', '어스 바인드', 'SPIRIT', '2.0', '2.0', '0.0', '0.0', '1.0', '0.5', 45, 45, 70, 'true'),
(160, 'Area of Silence', '에어리어 오브 사일런스', 'SPIRIT', '2.0', '2.0', '0.0', '0.0', '1.0', '0.5', 50, 32, 70, 'true'),
(172, 'Polute Water', '폴루트 워터', 'SPIRIT', '2.0', '2.0', '0.0', '0.0', '1.0', '0.5', 40, 40, 70, 'true'),
(173, 'Striker Gayle', '스트라이커 게일', 'SPIRIT', '2.0', '2.0', '0.0', '0.0', '1.0', '0.5', 40, 40, 70, 'true'),
(5026, 'Tempest', '템페스트', 'ABILITY', '2.0', '2.0', '0.0', '0.0', '1.0', '0.5', 50, 20, 80, 'true'),
(5056, 'Behemoth', '베히모스', 'DRAGONSPELL', '2.0', '2.0', '0.0', '0.0', '1.0', '0.0', 50, 20, 80, 'true');
