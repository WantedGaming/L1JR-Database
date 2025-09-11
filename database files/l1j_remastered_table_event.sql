
-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `event_id` int(10) NOT NULL DEFAULT 0,
  `description` varchar(50) DEFAULT NULL,
  `desc_kr` varchar(50) NOT NULL,
  `desc_en` varchar(50) NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `finish_date` datetime DEFAULT NULL,
  `broadcast` enum('true','false') NOT NULL DEFAULT 'false',
  `event_flag` enum('SPAWN_NPC','DROP_ADENA','DROP_ITEM','POLY') NOT NULL DEFAULT 'SPAWN_NPC',
  `spawn_data` text DEFAULT NULL,
  `drop_rate` float NOT NULL DEFAULT 1,
  `finish_delete_item` text DEFAULT NULL,
  `finish_map_rollback` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_id`, `description`, `desc_kr`, `desc_en`, `start_date`, `finish_date`, `broadcast`, `event_flag`, `spawn_data`, `drop_rate`, `finish_delete_item`, `finish_map_rollback`) VALUES
(1, '$44062', '[이벤트] 아데나 드랍 확률 업!', '[Event] Adena drop rate increased!', '2022-10-01 06:00:00', '2022-10-05 06:00:00', 'true', 'DROP_ADENA', NULL, 1.5, NULL, NULL),
(2, '$44063', '[이벤트] 아이템 드랍 확률 업!', '[Event] Increased item drop rate!', '2022-10-01 06:00:00', '2022-10-05 06:00:00', 'true', 'DROP_ITEM', NULL, 1.5, NULL, NULL),
(3, '$44064', '[이벤트] 변신 레벨 완화!', '[Event] Transformation level eased!', '2022-10-01 06:00:00', '2022-10-05 06:00:00', 'true', 'POLY', NULL, 1, NULL, NULL),
(4, '$44065', '[이벤트] 붉은 오크의 마스크!', '[Event] Red Orc Mask!', '2022-10-01 06:00:00', '2022-10-31 06:00:00', 'true', 'SPAWN_NPC', 'X:33448, Y:32789, MAP:4, HEAD:4, NPC:81028\r\nX:34062, Y:32267, MAP:4, HEAD:4, NPC:81028', 1, '30437\r\n30438\r\n31519\r\n31520\r\n31521\r\n31522', NULL);
