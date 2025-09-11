
-- --------------------------------------------------------

--
-- Table structure for table `connect_reward`
--

CREATE TABLE `connect_reward` (
  `id` int(3) NOT NULL DEFAULT 0,
  `description` varchar(50) DEFAULT NULL,
  `desc_kr` varchar(50) NOT NULL,
  `reward_type` enum('NORMAL','STANBY_SERVER') NOT NULL DEFAULT 'NORMAL',
  `reward_item_id` int(10) NOT NULL DEFAULT 0,
  `reward_item_count` int(10) NOT NULL DEFAULT 0,
  `reward_interval_minute` int(6) NOT NULL DEFAULT 0,
  `reward_start_date` datetime DEFAULT NULL,
  `reward_finish_date` datetime DEFAULT NULL,
  `is_use` enum('true','false') NOT NULL DEFAULT 'true'
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `connect_reward`
--

INSERT INTO `connect_reward` (`id`, `description`, `desc_kr`, `reward_type`, `reward_item_id`, `reward_item_count`, `reward_interval_minute`, `reward_start_date`, `reward_finish_date`, `is_use`) VALUES
(1, 'Standby server reward', '오픈대기 접속 보상', 'STANBY_SERVER', 7021, 1, 10, NULL, NULL, 'true'),
(2, 'Stay connected reward', '접속 유지 보상', 'NORMAL', 40308, 5000, 60, NULL, NULL, 'true');
