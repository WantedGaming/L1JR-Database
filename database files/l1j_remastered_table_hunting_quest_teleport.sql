
-- --------------------------------------------------------

--
-- Table structure for table `hunting_quest_teleport`
--

CREATE TABLE `hunting_quest_teleport` (
  `action_string` varchar(50) NOT NULL DEFAULT '',
  `tel_mapid` int(6) NOT NULL DEFAULT 0,
  `tel_x` int(4) DEFAULT NULL,
  `tel_y` int(4) DEFAULT NULL,
  `tel_itemid` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `hunting_quest_teleport`
--

INSERT INTO `hunting_quest_teleport` (`action_string`, `tel_mapid`, `tel_x`, `tel_y`, `tel_itemid`) VALUES
('F_luun', 4, 34387, 32303, 140100),
('GD_ant cave', 4, 32855, 33267, 140100),
('GD_atuba', 4, 32805, 32268, 140100),
('GD_bitter cold', 4, 34085, 32270, 140100),
('GD_black ship', 9, 32669, 33250, 140100),
('GD_cam forest', 4, 33165, 33262, 140100),
('GD_chaoticD', 4, 32876, 32652, 140100),
('GD_desert', 4, 32858, 33256, 140100),
('GD_dragon valley', 4, 33337, 32466, 140100),
('GD_dry desert', 4, 32874, 33460, 140100),
('GD_elmor', 4, 34051, 32561, 140100),
('GD_elven', 4, 32937, 32277, 140100),
('GD_eva kingdom', 4, 33622, 33502, 140100),
('GD_gludio', 4, 32724, 32918, 140100),
('GD_halpas', 4, 33159, 32969, 140100),
('GD_heine', 4, 33408, 33192, 140100),
('GD_hidden dungeon', 4, 33426, 32797, 140100),
('GD_ivory tower', 4, 34041, 32162, 140100),
('GD_jibae tower', 4, 33928, 33349, 140100),
('GD_jungle', 4, 33795, 32774, 140100),
('GD_kiran prizon', 4, 33429, 32827, 140100),
('GD_lindvior', 4, 34122, 32804, 140100),
('GD_mirror', 4, 33768, 33312, 140100),
('GD_oman tower', 4, 33928, 33349, 140100),
('GD_orc forest', 4, 32718, 32265, 140100),
('GD_orenwall', 4, 34121, 32192, 140100),
('GD_pcbang', 622, 32778, 32829, 41921),
('GD_ruin of death', 4, 32874, 32653, 140100),
('GD_silver dungeon', 4, 33119, 33389, 140100),
('GD_siver field', 4, 33083, 33312, 140100),
('GD_talk island', 9, 32491, 32859, 140100),
('GD_tombs', 4, 32826, 32915, 140100),
('GD_tough desert', 4, 32987, 33386, 140100),
('GD_traning_dungeon', 0, 32586, 32937, 140100),
('GD_trash mans land', 4, 34054, 32279, 140100),
('GD_unicon', 4, 33470, 32821, 140100),
('GD_valakas', 4, 33640, 32422, 140100);
