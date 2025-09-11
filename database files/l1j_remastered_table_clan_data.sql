
-- --------------------------------------------------------

--
-- Table structure for table `clan_data`
--

CREATE TABLE `clan_data` (
  `clan_id` int(10) UNSIGNED NOT NULL,
  `clan_name` varchar(45) NOT NULL DEFAULT '',
  `leader_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `leader_name` varchar(45) NOT NULL DEFAULT '',
  `hascastle` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `hashouse` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `alliance` varchar(100) DEFAULT NULL,
  `clan_birthday` datetime NOT NULL,
  `bot` enum('true','false') NOT NULL DEFAULT 'false',
  `bot_style` tinyint(3) NOT NULL DEFAULT 0,
  `bot_level` tinyint(3) NOT NULL DEFAULT 0,
  `max_online_user` int(10) NOT NULL DEFAULT 0,
  `announcement` varchar(160) NOT NULL,
  `introductionMessage` varchar(160) NOT NULL,
  `enter_notice` varchar(160) NOT NULL,
  `emblem_id` int(10) NOT NULL DEFAULT 0,
  `emblem_status` tinyint(1) NOT NULL DEFAULT 0,
  `contribution` int(10) NOT NULL DEFAULT 0,
  `bless` int(45) NOT NULL DEFAULT 0,
  `bless_count` int(45) NOT NULL DEFAULT 0,
  `attack` int(45) NOT NULL DEFAULT 0,
  `defence` int(45) NOT NULL DEFAULT 0,
  `pvpattack` int(45) NOT NULL DEFAULT 0,
  `pvpdefence` int(45) NOT NULL DEFAULT 0,
  `under_dungeon` tinyint(3) NOT NULL DEFAULT 0,
  `ranktime` int(10) NOT NULL DEFAULT 0,
  `rankdate` datetime DEFAULT NULL,
  `War_point` int(10) NOT NULL DEFAULT 0,
  `enable_join` enum('true','false') NOT NULL DEFAULT 'true',
  `join_type` int(1) NOT NULL DEFAULT 1,
  `total_m` int(10) NOT NULL DEFAULT 0,
  `current_m` int(10) NOT NULL DEFAULT 0,
  `join_password` varchar(45) DEFAULT NULL,
  `EinhasadBlessBuff` int(10) DEFAULT NULL,
  `Buff_List1` int(10) DEFAULT NULL,
  `Buff_List2` int(10) DEFAULT NULL,
  `Buff_List3` int(10) DEFAULT NULL,
  `dayDungeonTime` datetime DEFAULT NULL,
  `weekDungeonTime` datetime DEFAULT NULL,
  `vowTime` datetime DEFAULT NULL,
  `vowCount` int(1) NOT NULL DEFAULT 0,
  `clanNameChange` enum('true','false') NOT NULL DEFAULT 'false',
  `storeAllows` text DEFAULT NULL,
  `limit_level` int(3) NOT NULL DEFAULT 30,
  `limit_user_names` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `clan_data`
--

INSERT INTO `clan_data` (`clan_id`, `clan_name`, `leader_id`, `leader_name`, `hascastle`, `hashouse`, `alliance`, `clan_birthday`, `bot`, `bot_style`, `bot_level`, `max_online_user`, `announcement`, `introductionMessage`, `enter_notice`, `emblem_id`, `emblem_status`, `contribution`, `bless`, `bless_count`, `attack`, `defence`, `pvpattack`, `pvpdefence`, `under_dungeon`, `ranktime`, `rankdate`, `War_point`, `enable_join`, `join_type`, `total_m`, `current_m`, `join_password`, `EinhasadBlessBuff`, `Buff_List1`, `Buff_List2`, `Buff_List3`, `dayDungeonTime`, `weekDungeonTime`, `vowTime`, `vowCount`, `clanNameChange`, `storeAllows`, `limit_level`, `limit_user_names`) VALUES
(2, 'Red Knights', 2, 'Deporage', 0, 0, NULL, '2021-08-16 20:50:53', 'true', 0, 0, 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 'true', 1, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'false', NULL, 30, NULL),
(268907394, 'Patatas', 268907316, 'Princesita', 0, 0, '', '2023-05-09 09:03:03', 'false', 0, 0, 0, '', '', '', 268907475, 1, 5, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 'true', 0, 1, 0, NULL, 0, 5258, 5259, 5250, NULL, NULL, '2023-10-23 11:57:14', 0, 'false', NULL, 30, NULL),
(299858324, 'TestPledge', 299858156, 'Princesa', 0, 0, '', '2023-10-07 11:45:52', 'false', 0, 0, 0, '', 'Test', '', 299859346, 1, 65688, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 'true', 0, 1, 0, NULL, 0, 5253, 5259, 5250, NULL, NULL, '2023-11-04 09:09:53', 0, 'false', 'Elfo', 30, NULL),
(3, 'Black Knights', 3, 'Kenrauhel', 0, 0, NULL, '2021-08-16 20:50:53', 'true', 0, 0, 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 'true', 1, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'false', NULL, 30, NULL),
(1, 'New Templar Pledge', 1, 'NewLord', 0, 0, '', '2015-12-10 14:12:12', 'false', 0, 0, 0, '', 'A pledge for new characters', '', 312699573, 1, 10064568, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 'true', 0, 0, 0, NULL, 0, 0, 0, 0, NULL, NULL, NULL, 0, 'false', NULL, 30, NULL),
(4, 'Golden Knights', 4, 'Gillian', 0, 0, NULL, '2021-08-16 20:52:22', 'true', 0, 0, 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 'true', 1, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'false', NULL, 30, NULL),
(331885652, 'Emperor', 299879861, 'Principe', 0, 0, '', '2023-11-27 11:29:26', 'false', 0, 0, 0, '', '', '', 334644802, 1, 1470157, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 'true', 0, 7, 0, NULL, 0, 5259, 5255, 5258, NULL, NULL, '2024-12-22 13:04:24', 0, 'false', NULL, 30, NULL);
