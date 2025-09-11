
-- --------------------------------------------------------

--
-- Table structure for table `accounts_free_buff_shield`
--

CREATE TABLE `accounts_free_buff_shield` (
  `account_name` varchar(50) NOT NULL,
  `favor_locked_time` int(4) NOT NULL DEFAULT 0,
  `pccafe_favor_remain_count` int(1) NOT NULL DEFAULT 0,
  `free_favor_remain_count` int(1) NOT NULL DEFAULT 0,
  `event_favor_remain_count` int(1) NOT NULL DEFAULT 0,
  `pccafe_reward_item_count` int(3) NOT NULL DEFAULT 0,
  `reset_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `accounts_free_buff_shield`
--

INSERT INTO `accounts_free_buff_shield` (`account_name`, `favor_locked_time`, `pccafe_favor_remain_count`, `free_favor_remain_count`, `event_favor_remain_count`, `pccafe_reward_item_count`, `reset_time`) VALUES
('cckiss', 0, 3, 0, 0, 0, '2025-09-05 16:00:00'),
('test1111@test.com', 0, 3, 0, 0, 0, '2025-09-05 16:00:00'),
('test2222@test.com', 0, 3, 0, 0, 0, '2025-09-05 16:00:00'),
('test3333@test.com', 0, 3, 0, 0, 0, '2025-09-05 16:00:00'),
('test6666@test.com', 0, 3, 0, 0, 0, '2025-09-05 16:00:00');
