
-- --------------------------------------------------------

--
-- Table structure for table `spawnlist_npc_cash_shop`
--

CREATE TABLE `spawnlist_npc_cash_shop` (
  `id` int(10) UNSIGNED NOT NULL,
  `npc_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(40) NOT NULL,
  `locx` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `locy` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `mapid` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `heading` int(10) NOT NULL DEFAULT 0,
  `title` varchar(35) NOT NULL DEFAULT '',
  `shop_chat` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `spawnlist_npc_cash_shop`
--

INSERT INTO `spawnlist_npc_cash_shop` (`id`, `npc_id`, `name`, `locx`, `locy`, `mapid`, `heading`, `title`, `shop_chat`) VALUES
(1, 6100000, 'VIP^Weapon Shop', 32871, 32865, 631, 6, '', ''),
(2, 6100001, 'VIP^Helmet Shop', 32871, 32867, 631, 6, '', ''),
(3, 6100002, 'VIP^T-shirt Shop', 32871, 32869, 631, 6, '', ''),
(4, 6100003, 'VIP^Cloak Shop', 32871, 32871, 631, 6, '', ''),
(5, 6100004, 'VIP^Armor Shop', 32871, 32873, 631, 6, '', ''),
(6, 6100005, 'VIP^Shield Shop', 32871, 32875, 631, 6, '', ''),
(7, 6100006, 'VIP^Glove Shop', 32871, 32877, 631, 6, '', ''),
(8, 6100007, 'VIP^Boots Shop', 32871, 32879, 631, 6, '', ''),
(9, 6100008, 'VIP^Necklace Shop', 32871, 32881, 631, 6, '', ''),
(10, 6100009, 'VIP^Earring Shop', 32871, 32883, 631, 6, '', ''),
(11, 6100010, 'VIP^Ring Shop', 32871, 32885, 631, 6, '', ''),
(12, 6100011, 'VIP^Belt Shop', 32871, 32887, 631, 6, '', ''),
(15, 6100012, 'VIP^Doll Shop', 32868, 32865, 631, 6, '', ''),
(13, 6100013, 'VIP^Gaiter Shop', 32868, 32867, 631, 6, '', ''),
(14, 6100014, '2nd Merchant^ Weapons Shop', 33001, 32910, 631, 6, '', ''),
(16, 6100015, '2nd Merchant^Helmet Shop', 33001, 32912, 631, 6, '', ''),
(17, 6100016, '2nd Merchant^T-shirt shop', 33001, 32914, 631, 6, '', ''),
(18, 6100017, '2nd Merchant^Cloak Shop', 33001, 32916, 631, 6, '', ''),
(19, 6100018, '2nd Merchant^Armor Shop', 33001, 32918, 631, 6, '', ''),
(20, 6100019, '2nd Merchant^Shield Shop', 33001, 32920, 631, 6, '', ''),
(21, 6100020, '2nd Merchant^Glove Shop', 33001, 32922, 631, 6, '', ''),
(22, 6100021, '2nd Merchant^ Boots Shop', 33001, 32924, 631, 6, '', ''),
(23, 6100022, '2nd Shop^Necklace Shop', 33001, 32926, 631, 6, '', ''),
(24, 6100023, '2nd Merchant^Earring Shop', 33001, 32928, 631, 6, '', ''),
(26, 6100024, '2nd Merchant^Ring Shop', 33001, 32930, 631, 6, '', ''),
(27, 6100025, '2nd Merchant^Belt Shop', 33001, 32932, 631, 6, '', ''),
(25, 6100026, '2nd Merchant^Doll Shop', 33001, 32934, 631, 6, '', ''),
(28, 6100027, '2nd Merchant^Gaiter Shop', 32865, 32871, 631, 6, '', ''),
(29, 6100028, '3rd Merchant^Weapons Shop', 32865, 32873, 631, 6, '', ''),
(30, 6100029, '3rd Merchant^Helm Shop', 32865, 32875, 631, 6, '', ''),
(31, 6100030, '3rd Merchant^T-shirt Shop', 32865, 32877, 631, 6, '', ''),
(32, 6100031, '3rd Merchant^Cloak Shop', 32865, 32879, 631, 6, '', ''),
(33, 6100032, '3rd Merchant^Armor Shop', 32865, 32881, 631, 6, '', ''),
(34, 6100033, '3rd Merchant^Shield Shop', 32865, 32883, 631, 6, '', ''),
(35, 6100034, '3rd Merchant^Glove Shop', 32865, 32885, 631, 6, '', ''),
(36, 6100035, '3rd Merchant^Boots Shop', 32748, 32940, 631, 6, '', '');
