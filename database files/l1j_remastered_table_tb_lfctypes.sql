
-- --------------------------------------------------------

--
-- Table structure for table `tb_lfctypes`
--

CREATE TABLE `tb_lfctypes` (
  `ID` int(2) NOT NULL,
  `TYPE` int(2) DEFAULT 0,
  `NAME` varchar(50) DEFAULT NULL,
  `DESC_KR` varchar(50) NOT NULL,
  `USE` int(2) DEFAULT 0,
  `BUFF_SPAWN_TIME` int(10) DEFAULT 0,
  `POSSIBLE_LEVEL` int(10) DEFAULT 0,
  `MIN_PARTY` int(10) DEFAULT 0,
  `MAX_PARTY` int(10) DEFAULT 0,
  `NEED_ITEMID` int(10) DEFAULT 0,
  `NEED_ITEMCOUNT` int(10) DEFAULT 0,
  `PLAY_INST` varchar(50) DEFAULT NULL,
  `MAPRT_LEFT` int(10) DEFAULT 0,
  `MAPRT_TOP` int(10) DEFAULT 0,
  `MAPRT_RIGHT` int(10) DEFAULT 0,
  `MAPRT_BOTTOM` int(10) DEFAULT 0,
  `MAPID` int(10) DEFAULT 0,
  `STARTPOS_REDX` int(10) DEFAULT 0,
  `STARTPOS_REDY` int(10) DEFAULT 0,
  `STARTPOS_BLUEX` int(10) DEFAULT 0,
  `STARTPOS_BLUEY` int(10) DEFAULT 0,
  `PLAYTIME` int(10) DEFAULT 0,
  `READYTIME` int(10) DEFAULT 0,
  `RAND_WINNER_RATIO` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `tb_lfctypes`
--

INSERT INTO `tb_lfctypes` (`ID`, `TYPE`, `NAME`, `DESC_KR`, `USE`, `BUFF_SPAWN_TIME`, `POSSIBLE_LEVEL`, `MIN_PARTY`, `MAX_PARTY`, `NEED_ITEMID`, `NEED_ITEMCOUNT`, `PLAY_INST`, `MAPRT_LEFT`, `MAPRT_TOP`, `MAPRT_RIGHT`, `MAPRT_BOTTOM`, `MAPID`, `STARTPOS_REDX`, `STARTPOS_REDY`, `STARTPOS_BLUEX`, `STARTPOS_BLUEY`, `PLAYTIME`, `READYTIME`, `RAND_WINNER_RATIO`) VALUES
(1, 0, 'Final Showdown', '최후의 결판', 1, 120, 60, 1, 1, 40308, 1000000, 'MJLFCLastDuel', 32734, 32860, 32740, 32866, 13051, 32737, 32860, 32737, 32866, 300, 30, 55),
(2, 0, 'Arena', '아레나', 0, 120, 60, 1, 8, 40308, 1000000, 'MJLFCDummy', 32797, 32815, 32806, 32848, 13052, 32802, 32816, 32802, 32847, 600, 30, 55),
(3, 1, 'Wars Square - Trap Battle', '워스퀘어 - 트랩전', 1, 120, 60, 1, 8, 40308, 1000000, 'MJLFCWarSquareTrap', 32726, 32856, 32743, 32873, 13053, 32728, 32858, 32741, 32871, 600, 30, 55),
(4, 0, 'Wars Square - Monster Battle', '워스퀘어 - 몬스터전', 0, 120, 60, 1, 8, 40308, 1000000, 'MJLFCDummy', 32726, 32856, 32743, 32873, 13054, 32728, 32858, 32741, 32871, 600, 30, 55),
(5, 0, 'Wars Square - Tower of Insolence', '워스퀘어 - 오만의 탑', 0, 120, 60, 1, 8, 40308, 1000000, 'MJLFCDummy', 32726, 32856, 32743, 32873, 13055, 32728, 32858, 32741, 32871, 600, 30, 55),
(6, 0, 'Wars Square - Valley of the Dragon', '워스퀘어 - 용의 계곡', 0, 120, 60, 1, 8, 40308, 1000000, 'MJLFCDummy', 32726, 32856, 32743, 32873, 13056, 32728, 32858, 32741, 32871, 600, 30, 55),
(7, 0, 'Wars Square - Oman Summit', '워스퀘어 - 오만 정상', 0, 120, 60, 1, 8, 40308, 1000000, 'MJLFCDummy', 32726, 32856, 32743, 32873, 13057, 32728, 32858, 32741, 32871, 600, 30, 55),
(8, 0, 'Wars Square - Transformation', '워스퀘어 - 변신전', 0, 120, 60, 1, 8, 40308, 1000000, 'MJLFCDummy', 32726, 32856, 32743, 32873, 13058, 32728, 32858, 32741, 32871, 600, 30, 55),
(9, 1, 'Arena - Tower Defense', '아레나 - 타워', 1, 120, 60, 1, 8, 40308, 1000000, 'MJLFCArenaTower', 32797, 32815, 32806, 32848, 13059, 32802, 32816, 32802, 32847, 600, 30, 55);
