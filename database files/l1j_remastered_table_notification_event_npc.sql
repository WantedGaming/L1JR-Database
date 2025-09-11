
-- --------------------------------------------------------

--
-- Table structure for table `notification_event_npc`
--

CREATE TABLE `notification_event_npc` (
  `notification_id` int(6) NOT NULL DEFAULT 0,
  `is_use` enum('true','false') NOT NULL DEFAULT 'true',
  `order_id` int(2) NOT NULL DEFAULT 0,
  `npc_id` int(10) NOT NULL DEFAULT 0,
  `displaydesc` varchar(50) NOT NULL,
  `displaydesc_en` varchar(50) NOT NULL,
  `displaydesc_kr` varchar(50) DEFAULT NULL,
  `rest_gauge_bonus` int(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `notification_event_npc`
--

INSERT INTO `notification_event_npc` (`notification_id`, `is_use`, `order_id`, `npc_id`, `displaydesc`, `displaydesc_en`, `displaydesc_kr`, `rest_gauge_bonus`) VALUES
(18, 'true', 1, 700050, '$30785', 'Sports Day', '인형 경주', 0),
(19, 'true', 1, 81010, '$41739', 'Other Shop', '기타 상점', 0),
(19, 'false', 2, 81011, '$41740', 'Skill Shop', '스킬 상점', 0),
(19, 'true', 3, 81012, '$41741', 'Weapon Shop', '무기 상점', 0),
(19, 'true', 4, 81013, '$41742', 'Armor Shop', '방어구 상점', 0),
(19, 'true', 5, 81014, '$41743', 'Accessory Shop', '장신구 상점', 0),
(19, 'true', 6, 81015, '$41744', 'Hunting Shop', '사냥터 상점', 0),
(19, 'true', 7, 81018, '$41745', 'Lineage N Shop', '리니지 N샵', 0),
(19, 'true', 8, 5, '$41746', 'Aden Shop', 'C아덴 상점', 0),
(25, 'false', 1, 81024, '$33554', 'Clan Piece Merchant', '혈맹 조각 상인', 0),
(101, 'true', 1, 81026, '$39494', 'Medal of Valor Trade', '용맹의 메달 교환', 0),
(101, 'true', 2, 81025, '$39495', 'Medal of Valor Craft', '용맹의 메달 제작', 0);
