
-- --------------------------------------------------------

--
-- Table structure for table `bin_ship_common`
--

CREATE TABLE `bin_ship_common` (
  `id` int(2) NOT NULL DEFAULT 0,
  `dockWorld` int(6) NOT NULL DEFAULT 0,
  `shipWorld` int(6) NOT NULL DEFAULT 0,
  `ticket` int(6) NOT NULL DEFAULT 0,
  `levelLimit` int(3) NOT NULL DEFAULT 0,
  `dock_startX` int(5) NOT NULL DEFAULT 0,
  `dock_startY` int(5) NOT NULL DEFAULT 0,
  `dock_endX` int(5) NOT NULL DEFAULT 0,
  `dock_endY` int(5) NOT NULL DEFAULT 0,
  `shipLoc_x` int(5) NOT NULL DEFAULT 0,
  `shipLoc_y` int(5) NOT NULL DEFAULT 0,
  `destWorld` int(6) NOT NULL DEFAULT 0,
  `destLoc_x` int(5) NOT NULL DEFAULT 0,
  `destLoc_y` int(5) NOT NULL DEFAULT 0,
  `destLoc_range` int(3) NOT NULL DEFAULT 0,
  `schedule_day` varchar(100) DEFAULT NULL,
  `schedule_time` blob DEFAULT NULL,
  `schedule_duration` int(2) NOT NULL DEFAULT 0,
  `schedule_ship_operating_duration` int(2) NOT NULL DEFAULT 0,
  `returnWorld` int(6) NOT NULL DEFAULT 0,
  `returnLoc_x` int(5) NOT NULL DEFAULT 0,
  `returnLoc_y` int(5) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `bin_ship_common`
--

INSERT INTO `bin_ship_common` (`id`, `dockWorld`, `shipWorld`, `ticket`, `levelLimit`, `dock_startX`, `dock_startY`, `dock_endX`, `dock_endY`, `shipLoc_x`, `shipLoc_y`, `destWorld`, `destLoc_x`, `destLoc_y`, `destLoc_range`, `schedule_day`, `schedule_time`, `schedule_duration`, `schedule_ship_operating_duration`, `returnWorld`, `returnLoc_x`, `returnLoc_y`) VALUES
(0, 4, 83, 653, 85, 33427, 33506, 33435, 33507, 32735, 32797, 70, 32937, 33042, 5, '1000001', 0x392c2031302c2031312c2031322c2031332c2031342c2031352c2031362c203137, 20, 10, 4, 33431, 33500),
(1, 70, 84, 665, 85, 32935, 33057, 32936, 33057, 32732, 32799, 4, 33431, 33500, 0, '1000001', 0x31302c2031312c2031322c2031332c2031342c2031352c2031362c203137, 20, 10, 70, 32936, 33047);
