
-- --------------------------------------------------------

--
-- Table structure for table `bin_favorbook_common`
--

CREATE TABLE `bin_favorbook_common` (
  `category_id` int(2) NOT NULL DEFAULT 0,
  `desc_id` varchar(50) DEFAULT NULL,
  `desc_kr` varchar(100) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `sort` int(2) NOT NULL DEFAULT 0,
  `slot_id` int(2) NOT NULL DEFAULT 0,
  `state_infos` text DEFAULT NULL,
  `red_dot_notice` int(2) NOT NULL DEFAULT 0,
  `default_display_item_id` int(5) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `bin_favorbook_common`
--

INSERT INTO `bin_favorbook_common` (`category_id`, `desc_id`, `desc_kr`, `start_date`, `end_date`, `sort`, `slot_id`, `state_infos`, `red_dot_notice`, `default_display_item_id`) VALUES
(1, '38409', '[축복의 성물]', NULL, NULL, 1, 1, 'CRAFT_ID: 9029, AWAKENING: 0\r\nCRAFT_ID: 9030, AWAKENING: 2\r\nCRAFT_ID: 9035, AWAKENING: 3', 0, 29752),
(1, '38409', '[축복의 성물]', NULL, NULL, 1, 2, 'CRAFT_ID: 9266, AWAKENING: 0\r\nCRAFT_ID: 9267, AWAKENING: 2\r\nCRAFT_ID: 9268, AWAKENING: 3', 0, 29769),
(1, '38409', '[축복의 성물]', NULL, NULL, 1, 3, 'CRAFT_ID: 10635, AWAKENING: 0\r\nCRAFT_ID: 10636, AWAKENING: 2\r\nCRAFT_ID: 10637, AWAKENING: 3', 0, 30624),
(1, '38409', '[축복의 성물]', NULL, NULL, 1, 4, 'CRAFT_ID: 11466, AWAKENING: 0\r\nCRAFT_ID: 11467, AWAKENING: 2\r\nCRAFT_ID: 11468, AWAKENING: 3', 0, 31637),
(2, '38410', '[강화의 성물]', NULL, NULL, 2, 1, 'CRAFT_ID: 11005, AWAKENING: 0\r\nCRAFT_ID: 11006, AWAKENING: 1\r\nCRAFT_ID: 11007, AWAKENING: 1\r\nCRAFT_ID: 11008, AWAKENING: 1\r\nCRAFT_ID: 11009, AWAKENING: 1\r\nCRAFT_ID: 11010, AWAKENING: 1\r\nCRAFT_ID: 11011, AWAKENING: 1\r\nCRAFT_ID: 11012, AWAKENING: 1\r\nCRAFT_ID: 11013, AWAKENING: 1\r\nCRAFT_ID: 11014, AWAKENING: 1\r\nCRAFT_ID: 11015, AWAKENING: 1\r\nCRAFT_ID: 11016, AWAKENING: 1\r\nCRAFT_ID: 0, AWAKENING: 0', 0, 0),
(2, '38410', '[강화의 성물]', NULL, NULL, 2, 2, 'CRAFT_ID: 9418, AWAKENING: 0\r\nCRAFT_ID: 9385, AWAKENING: 1\r\nCRAFT_ID: 9386, AWAKENING: 1\r\nCRAFT_ID: 9387, AWAKENING: 1\r\nCRAFT_ID: 9388, AWAKENING: 1\r\nCRAFT_ID: 9389, AWAKENING: 1\r\nCRAFT_ID: 9390, AWAKENING: 1\r\nCRAFT_ID: 9391, AWAKENING: 1\r\nCRAFT_ID: 9392, AWAKENING: 1\r\nCRAFT_ID: 9393, AWAKENING: 1\r\nCRAFT_ID: 0, AWAKENING: 0', 0, 0),
(3, '39787', '[진귀한 전리품]', NULL, NULL, 3, 1, 'CRAFT_ID: 11842, AWAKENING: 0\r\nCRAFT_ID: 11843, AWAKENING: 1\r\nCRAFT_ID: 11844, AWAKENING: 1\r\nCRAFT_ID: 11845, AWAKENING: 1\r\nCRAFT_ID: 0, AWAKENING: 0', 0, 0),
(8, '40341', '[이벤트] 반격의 가호', '2023-01-25 06:00:00', '2023-05-17 06:00:00', 4, 1, 'CRAFT_ID: 12394, AWAKENING: 0\r\nCRAFT_ID: 0, AWAKENING: 0', 1, 0),
(8, '40341', '[이벤트] 반격의 가호', '2023-01-25 06:00:00', '2023-05-17 06:00:00', 4, 2, 'CRAFT_ID: 12395, AWAKENING: 0\r\nCRAFT_ID: 0, AWAKENING: 0', 1, 0),
(8, '40341', '[이벤트] 반격의 가호', '2023-01-25 06:00:00', '2023-05-17 06:00:00', 4, 3, 'CRAFT_ID: 12396, AWAKENING: 0\r\nCRAFT_ID: 0, AWAKENING: 0', 1, 0),
(8, '40341', '[이벤트] 반격의 가호', '2023-01-25 06:00:00', '2023-05-17 06:00:00', 4, 4, 'CRAFT_ID: 12397, AWAKENING: 0\r\nCRAFT_ID: 0, AWAKENING: 0', 1, 0);
