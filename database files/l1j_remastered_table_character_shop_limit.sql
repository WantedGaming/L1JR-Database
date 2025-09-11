
-- --------------------------------------------------------

--
-- Table structure for table `character_shop_limit`
--

CREATE TABLE `character_shop_limit` (
  `characterId` int(10) NOT NULL DEFAULT 0,
  `buyShopId` int(9) NOT NULL DEFAULT 0,
  `buyItemId` int(9) NOT NULL DEFAULT 0,
  `buyCount` int(9) NOT NULL DEFAULT 0,
  `buyTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `limitTerm` enum('WEEK','DAY','NONE') NOT NULL DEFAULT 'DAY'
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `character_shop_limit`
--

INSERT INTO `character_shop_limit` (`characterId`, `buyShopId`, `buyItemId`, `buyCount`, `buyTime`, `limitTerm`) VALUES
(299879861, 81018, 500150, 1, '2023-12-22 14:34:58', 'NONE'),
(332131047, 81018, 500150, 1, '2023-12-23 14:25:14', 'NONE'),
(334766233, 81018, 500150, 1, '2024-08-06 21:01:10', 'NONE');
