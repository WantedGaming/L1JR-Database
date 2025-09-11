
-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `login` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL,
  `lastactive` datetime DEFAULT NULL,
  `lastQuit` datetime DEFAULT NULL,
  `access_level` int(11) NOT NULL DEFAULT 0,
  `ip` varchar(20) NOT NULL DEFAULT '',
  `host` varchar(20) NOT NULL DEFAULT '',
  `banned` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `charslot` int(11) NOT NULL DEFAULT 6,
  `warehouse_password` int(11) NOT NULL DEFAULT 0,
  `notice` varchar(20) DEFAULT '0',
  `quiz` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `hddId` varchar(255) DEFAULT NULL,
  `boardId` varchar(255) DEFAULT NULL,
  `Tam_Point` int(11) NOT NULL DEFAULT 0,
  `Buff_DMG_Time` datetime DEFAULT NULL,
  `Buff_Reduc_Time` datetime DEFAULT NULL,
  `Buff_Magic_Time` datetime DEFAULT NULL,
  `Buff_Stun_Time` datetime DEFAULT NULL,
  `Buff_Hold_Time` datetime DEFAULT NULL,
  `BUFF_PCROOM_Time` datetime DEFAULT NULL,
  `Buff_FireDefence_Time` datetime DEFAULT NULL,
  `Buff_EarthDefence_Time` datetime DEFAULT NULL,
  `Buff_WaterDefence_Time` datetime DEFAULT NULL,
  `Buff_WindDefence_Time` datetime DEFAULT NULL,
  `Buff_SoulDefence_Time` datetime DEFAULT NULL,
  `Buff_Str_Time` datetime DEFAULT NULL,
  `Buff_Dex_Time` datetime DEFAULT NULL,
  `Buff_Wis_Time` datetime DEFAULT NULL,
  `Buff_Int_Time` datetime DEFAULT NULL,
  `Buff_FireAttack_Time` datetime DEFAULT NULL,
  `Buff_EarthAttack_Time` datetime DEFAULT NULL,
  `Buff_WaterAttack_Time` datetime DEFAULT NULL,
  `Buff_WindAttack_Time` datetime DEFAULT NULL,
  `Buff_Hero_Time` datetime DEFAULT NULL,
  `Buff_Life_Time` datetime DEFAULT NULL,
  `second_password` varchar(11) DEFAULT NULL,
  `Ncoin` int(11) NOT NULL DEFAULT 0,
  `Npoint` int(11) NOT NULL DEFAULT 0,
  `Shop_open_count` int(6) NOT NULL DEFAULT 0,
  `DragonRaid_Buff` datetime DEFAULT NULL,
  `Einhasad` int(11) NOT NULL DEFAULT 0,
  `EinDayBonus` int(2) NOT NULL DEFAULT 0,
  `IndunCheckTime` datetime DEFAULT NULL,
  `IndunCount` int(2) NOT NULL DEFAULT 0,
  `app_char` int(10) NOT NULL DEFAULT 0,
  `app_terms_agree` enum('false','true') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'false',
  `PSSTime` int(11) NOT NULL DEFAULT 1800
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`login`, `password`, `lastactive`, `lastQuit`, `access_level`, `ip`, `host`, `banned`, `charslot`, `warehouse_password`, `notice`, `quiz`, `phone`, `hddId`, `boardId`, `Tam_Point`, `Buff_DMG_Time`, `Buff_Reduc_Time`, `Buff_Magic_Time`, `Buff_Stun_Time`, `Buff_Hold_Time`, `BUFF_PCROOM_Time`, `Buff_FireDefence_Time`, `Buff_EarthDefence_Time`, `Buff_WaterDefence_Time`, `Buff_WindDefence_Time`, `Buff_SoulDefence_Time`, `Buff_Str_Time`, `Buff_Dex_Time`, `Buff_Wis_Time`, `Buff_Int_Time`, `Buff_FireAttack_Time`, `Buff_EarthAttack_Time`, `Buff_WaterAttack_Time`, `Buff_WindAttack_Time`, `Buff_Hero_Time`, `Buff_Life_Time`, `second_password`, `Ncoin`, `Npoint`, `Shop_open_count`, `DragonRaid_Buff`, `Einhasad`, `EinDayBonus`, `IndunCheckTime`, `IndunCount`, `app_char`, `app_terms_agree`, `PSSTime`) VALUES
('cckiss', 'cckiss', '2024-07-17 22:48:23', '2024-07-17 22:49:17', 1, '127.0.0.1', '119.203.61.208', 0, 10, 0, '5', NULL, '1234567890', 'SCSI\\DISK&VEN_NVME&PROD_ADATA_SX8200PNP\\5&D2A2058&0&000000', 'NUC8BEB\\BOXNUC8I7BEK', 20200000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-16 20:40:55', '2024-03-16 20:40:54', NULL, 6999800, 4000020, 0, NULL, 2509168, 1, '2023-12-12 19:15:40', 0, 0, 'false', 10800),
('test1111@test.com', 'test1111', '2025-09-04 04:07:36', '2025-09-04 04:07:46', 1, '127.0.0.1', '192.168.178.55', 0, 10, 0, '5', NULL, NULL, 'SCSI\\DISK&VEN_T-FORCE&PROD_1TB\\4&2C94BB78&0&000000', 'Z790 STEEL LEGEND WIFI\\TO BE FILLED BY O.E.M.', 920000, NULL, NULL, NULL, NULL, NULL, '2023-12-25 15:47:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-12-25 15:47:01', '2023-12-25 15:54:12', NULL, 6999800, 4000020, 0, NULL, 0, 1, '2024-12-14 21:07:51', 0, 0, 'false', 2400),
('test2222@test.com', 'test2222', '2024-12-09 18:20:11', '2024-12-09 18:25:47', 0, '127.0.0.1', '192.168.178.55', 0, 10, 0, '5', NULL, '1', 'SCSI\\DISK&VEN_NVME&PROD_ADATA_SX8200PNP\\5&D2A2058&0&000000', 'NUC8BEB\\BOXNUC8I7BEK', 0, NULL, NULL, NULL, NULL, NULL, '2024-01-07 10:13:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-07 10:17:54', '2024-01-07 10:13:36', NULL, 6999800, 4000020, 0, NULL, 0, 1, '2024-06-05 23:01:09', 0, 0, 'false', 10800),
('test3333@test.com', 'test3333', '2024-07-17 22:49:48', '2024-07-17 22:50:49', 0, '127.0.0.1', '127.0.0.1', 0, 6, 0, '5', NULL, NULL, 'SCSI\\DISK&VEN_NVME&PROD_ADATA_SX8200NP\\5&D2A2058&0&000000', 'NUC8BEB\\BOXNUC8I7BEK', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4000020, 0, NULL, 2000000, 1, NULL, 0, 0, 'false', 2400),
('test5555@test.com', 'test5555', '2024-03-14 19:23:59', NULL, 0, '127.0.0.1', '127.0.0.1', 0, 6, 0, '0', NULL, NULL, 'SCSI\\DISKK&VEN_NVME&PROD_ADATA_SX800PNP\\5&D2A2058&0&000000', 'NUCC8BEB\\BOXNUC8I7BEK', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6999800, 4000020, 0, NULL, 2000000, 1, NULL, 0, 0, 'false', 1800),
('test6666@test.com', 'test6666', '2024-07-17 22:52:07', '2024-07-17 22:58:02', 0, '127.0.0.1', '127.0.0.1', 0, 6, 0, '5', NULL, NULL, 'SCSI\\DISK&VEN_NVME&PROD_ADATA_SX8200PNP\\5&D2A2058&0&000000', 'NUC8BEB\\BOXNUC8I7BEK', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, 2000000, 1, NULL, 0, 0, 'false', 1800);
