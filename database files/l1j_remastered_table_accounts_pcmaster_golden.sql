
-- --------------------------------------------------------

--
-- Table structure for table `accounts_pcmaster_golden`
--

CREATE TABLE `accounts_pcmaster_golden` (
  `account_name` varchar(50) NOT NULL,
  `index_id` int(1) NOT NULL DEFAULT 0,
  `type` int(1) NOT NULL DEFAULT 1,
  `grade` blob DEFAULT NULL,
  `remain_time` int(6) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `accounts_pcmaster_golden`
--

INSERT INTO `accounts_pcmaster_golden` (`account_name`, `index_id`, `type`, `grade`, `remain_time`) VALUES
('cckiss', 0, 1, 0x000000, 0),
('cckiss', 1, 1, 0x000000, 0),
('test1111@test.com', 0, 2, 0x000000, 0),
('test1111@test.com', 1, 3, 0x000000, 0),
('test2222@test.com', 0, 2, 0x000000, 0),
('test2222@test.com', 1, 1, 0x000000, 0),
('test3333@test.com', 0, 1, 0x000000, 0),
('test3333@test.com', 1, 1, 0x000000, 0),
('test6666@test.com', 0, 1, 0x000000, 0),
('test6666@test.com', 1, 1, 0x000000, 0);
