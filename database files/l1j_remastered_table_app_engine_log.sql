
-- --------------------------------------------------------

--
-- Table structure for table `app_engine_log`
--

CREATE TABLE `app_engine_log` (
  `id` int(10) NOT NULL DEFAULT 0,
  `account` varchar(50) NOT NULL,
  `engine` varchar(100) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `app_engine_log`
--

INSERT INTO `app_engine_log` (`id`, `account`, `engine`, `time`) VALUES
(1, 'cckiss', 'PacketDecoder', '2022-05-10 19:19:03'),
(2, 'cckiss', 'PacketDecoder', '2022-05-10 19:21:04'),
(3, 'cckiss', 'PacketDecoder', '2022-10-17 18:18:10'),
(4, 'cckiss1', 'PacketDecoder', '2022-10-21 04:50:00'),
(5, 'test1111', 'vmware-usbarbitrator64', '2023-02-04 22:12:12'),
(6, 'cckiss', 'PacketDecoder', '2023-02-14 16:22:32');
