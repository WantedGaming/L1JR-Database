
-- --------------------------------------------------------

--
-- Table structure for table `dungeon_timer_account`
--

CREATE TABLE `dungeon_timer_account` (
  `account` varchar(50) NOT NULL,
  `timerId` int(10) NOT NULL DEFAULT 0,
  `remainSecond` int(10) NOT NULL DEFAULT 0,
  `chargeCount` int(2) NOT NULL DEFAULT 0,
  `resetTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `dungeon_timer_account`
--

INSERT INTO `dungeon_timer_account` (`account`, `timerId`, `remainSecond`, `chargeCount`, `resetTime`) VALUES
('cckiss', 1, 59, 0, '2024-04-05 16:08:58'),
('cckiss', 2, 0, 0, NULL),
('cckiss', 3, 0, 0, NULL),
('cckiss', 4, 5, 0, '2024-02-28 22:37:36'),
('cckiss', 5, 5, 0, '2024-04-05 16:55:48'),
('cckiss', 6, 0, 0, NULL),
('cckiss', 7, 386, 0, '2024-03-22 11:12:21'),
('cckiss', 8, 0, 0, '2024-03-26 11:58:06'),
('cckiss', 9, 0, 0, NULL),
('cckiss', 10, 0, 0, NULL),
('cckiss', 11, 29, 0, '2024-03-19 11:19:35'),
('cckiss', 12, 0, 1, '2024-04-05 16:36:03'),
('cckiss', 13, 0, 0, '2023-04-19 21:01:23'),
('test1111@test.com', 1, 722, 0, '2024-08-15 17:04:10'),
('test1111@test.com', 2, 366, 0, '2024-08-15 20:22:14'),
('test1111@test.com', 3, 100, 0, '2024-08-15 17:20:32'),
('test1111@test.com', 4, 96, 0, '2025-01-02 13:36:54'),
('test1111@test.com', 5, 5, 0, '2024-10-08 18:03:29'),
('test1111@test.com', 6, 97, 0, '2024-08-16 07:47:39'),
('test1111@test.com', 7, 137, 0, '2024-08-15 20:19:55'),
('test1111@test.com', 8, 0, 0, '2024-12-11 02:31:23'),
('test1111@test.com', 9, 2400, 0, '2024-10-01 10:07:28'),
('test1111@test.com', 10, 5, 0, '2024-01-25 19:19:18'),
('test1111@test.com', 11, 54, 0, '2024-08-15 17:22:47'),
('test1111@test.com', 12, 2899, 0, '2024-08-15 17:49:53'),
('test1111@test.com', 13, 320, 1, '2024-12-09 20:01:11'),
('test2222@test.com', 1, 0, 0, NULL),
('test2222@test.com', 2, 0, 0, NULL),
('test2222@test.com', 3, 0, 0, NULL),
('test2222@test.com', 4, 0, 0, NULL),
('test2222@test.com', 5, 0, 0, NULL),
('test2222@test.com', 6, 0, 0, NULL),
('test2222@test.com', 7, 0, 0, NULL),
('test2222@test.com', 8, 0, 0, '2024-06-05 22:58:14'),
('test2222@test.com', 9, 0, 0, NULL),
('test2222@test.com', 10, 0, 0, NULL),
('test2222@test.com', 11, 153, 0, '2024-02-01 07:15:58'),
('test2222@test.com', 12, 0, 0, NULL),
('test2222@test.com', 13, 0, 0, '2024-06-05 22:58:16'),
('test3333@test.com', 1, 12600, 0, '2023-10-23 21:05:14'),
('test3333@test.com', 2, 9000, 0, '2023-10-23 21:05:14'),
('test3333@test.com', 3, 7200, 0, '2023-10-23 21:05:14'),
('test3333@test.com', 4, 7200, 0, '2023-10-23 21:05:14'),
('test3333@test.com', 5, 7200, 0, '2023-10-23 21:05:14'),
('test3333@test.com', 6, 7200, 0, '2023-10-23 21:05:14'),
('test3333@test.com', 7, 3600, 0, '2023-10-23 21:05:14'),
('test3333@test.com', 8, 0, 0, '2023-10-23 21:05:14'),
('test3333@test.com', 9, 2400, 0, '2023-10-23 21:05:14'),
('test3333@test.com', 10, 399, 0, '2023-10-26 22:10:03'),
('test3333@test.com', 11, 3600, 0, '2023-10-23 21:05:14'),
('test3333@test.com', 12, 10800, 0, '2023-10-23 21:05:14'),
('test3333@test.com', 13, 0, 0, '2023-10-23 21:05:14'),
('test6666@test.com', 1, 0, 0, NULL),
('test6666@test.com', 2, 0, 0, NULL),
('test6666@test.com', 3, 0, 0, NULL),
('test6666@test.com', 4, 0, 0, NULL),
('test6666@test.com', 5, 0, 0, NULL),
('test6666@test.com', 6, 0, 0, NULL),
('test6666@test.com', 7, 0, 0, NULL),
('test6666@test.com', 8, 0, 0, NULL),
('test6666@test.com', 9, 0, 0, NULL),
('test6666@test.com', 10, 0, 0, NULL),
('test6666@test.com', 11, 0, 0, NULL),
('test6666@test.com', 12, 0, 0, NULL),
('test6666@test.com', 13, 0, 0, NULL);
