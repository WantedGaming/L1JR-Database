
-- --------------------------------------------------------

--
-- Table structure for table `bin_charged_time_map_common`
--

CREATE TABLE `bin_charged_time_map_common` (
  `id` int(1) NOT NULL DEFAULT 0,
  `groups` text DEFAULT NULL,
  `multi_group_list` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `bin_charged_time_map_common`
--

INSERT INTO `bin_charged_time_map_common` (`id`, `groups`, `multi_group_list`) VALUES
(0, 'GROUP: 1, MAX_CHARGED_COUNT: 21, MAX_CHARGED_TIME: 21, COST_PER_TIME: 1, STR_INDEX: 9380 [숨겨진 사냥터 시간 충전]\r\nGROUP: 2, MAX_CHARGED_COUNT: 3, MAX_CHARGED_TIME: 3, COST_PER_TIME: 1, STR_INDEX: -1 [NULL]\r\nGROUP: 3, MAX_CHARGED_COUNT: 2, MAX_CHARGED_TIME: 2, COST_PER_TIME: 4, STR_INDEX: 9381 [숨겨진 사냥터 (Boost) 시간 충전]', 'GROUP: 1, COMPONENTS: [1, 3]\r\nGROUP: 2, COMPONENTS: [2]');
