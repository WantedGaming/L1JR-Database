
-- --------------------------------------------------------

--
-- Table structure for table `free_pvp_region`
--

CREATE TABLE `free_pvp_region` (
  `worldNumber` int(6) NOT NULL DEFAULT 0,
  `desc` varchar(50) DEFAULT NULL,
  `desc_kr` varchar(50) NOT NULL,
  `isFreePvpZone` enum('true','false') NOT NULL DEFAULT 'true',
  `box_index` int(3) NOT NULL DEFAULT 0,
  `box_sx` int(5) NOT NULL DEFAULT 0,
  `box_sy` int(5) NOT NULL DEFAULT 0,
  `box_ex` int(5) NOT NULL DEFAULT 0,
  `box_ey` int(5) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `free_pvp_region`
--

INSERT INTO `free_pvp_region` (`worldNumber`, `desc`, `desc_kr`, `isFreePvpZone`, `box_index`, `box_sx`, `box_sy`, `box_ex`, `box_ey`) VALUES
(101, 'Arrogance Tower 1st Floor', '오만의 탑 1층', 'true', 0, 32704, 32704, 32895, 32895),
(102, 'Arrogance Tower 2nd Floor', '오만의 탑 2층', 'true', 0, 32704, 32704, 32895, 32895),
(103, 'Arrogance Tower 3rd Floor', '오만의 탑 3층', 'true', 0, 32704, 32704, 32895, 32895),
(104, 'Arrogance Tower 4th Floor', '오만의 탑 4층', 'true', 0, 32576, 32768, 32767, 32959),
(105, 'Arrogance Tower 5th Floor', '오만의 탑 5층', 'true', 0, 32576, 32768, 32767, 32959),
(106, 'Arrogance Tower 6th Floor', '오만의 탑 6층', 'true', 0, 32576, 32768, 32767, 32959),
(107, 'Arrogance Tower 7th Floor', '오만의 탑 7층', 'true', 0, 32576, 32768, 32767, 32959),
(108, 'Arrogance Tower 8th Floor', '오만의 탑 8층', 'true', 0, 32576, 32768, 32767, 32959),
(109, 'Arrogance Tower 9th Floor', '오만의 탑 9층', 'true', 0, 32576, 32768, 32767, 32959),
(110, 'Arrogance Tower 10th Floor', '오만의 탑 10층', 'true', 0, 32704, 32704, 32895, 32895),
(111, 'Arrogance Tower Summit', '오만의 탑 정상', 'true', 0, 32576, 32768, 32831, 33023);
