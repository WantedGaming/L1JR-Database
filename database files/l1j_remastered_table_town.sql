
-- --------------------------------------------------------

--
-- Table structure for table `town`
--

CREATE TABLE `town` (
  `town_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(45) NOT NULL DEFAULT '',
  `leader_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `leader_name` varchar(45) DEFAULT NULL,
  `tax_rate` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `tax_rate_reserved` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `sales_money` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `sales_money_yesterday` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `town_tax` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `town_fix_tax` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `town`
--

INSERT INTO `town` (`town_id`, `name`, `leader_id`, `leader_name`, `tax_rate`, `tax_rate_reserved`, `sales_money`, `sales_money_yesterday`, `town_tax`, `town_fix_tax`) VALUES
(1, 'Talking Island', 0, NULL, 0, 0, 0, 0, 0, 0),
(2, 'Silver Knight Village', 0, NULL, 0, 0, 0, 0, 0, 0),
(3, 'Gludio', 0, NULL, 0, 0, 0, 0, 0, 0),
(4, 'Fire Field Village', 0, NULL, 0, 0, 0, 0, 0, 0),
(5, 'Windawood', 0, NULL, 0, 0, 0, 0, 0, 0),
(6, 'Kent', 0, NULL, 0, 0, 0, 0, 0, 0),
(7, 'Giran', 0, NULL, 0, 0, 0, 0, 0, 0),
(8, 'Heine', 0, NULL, 0, 0, 0, 0, 0, 0),
(9, 'Werldern', 0, NULL, 0, 0, 0, 0, 0, 0),
(10, 'Oren', 0, NULL, 0, 0, 0, 0, 0, 0),
(11, 'Elven Forest', 0, NULL, 0, 0, 0, 0, 0, 0),
(12, 'Aden', 0, NULL, 0, 0, 0, 0, 0, 0),
(13, 'Silent Cavern', 0, NULL, 0, 0, 0, 0, 0, 0),
(14, 'Oum Dungeon', 0, NULL, 0, 0, 0, 0, 0, 0),
(19, 'Claudia', 0, NULL, 0, 0, 0, 0, 0, 0),
(36, 'Ruun Castle Village', 0, NULL, 0, 0, 0, 0, 0, 0);
