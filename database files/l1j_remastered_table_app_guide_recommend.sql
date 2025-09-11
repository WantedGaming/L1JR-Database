
-- --------------------------------------------------------

--
-- Table structure for table `app_guide_recommend`
--

CREATE TABLE `app_guide_recommend` (
  `id` int(1) NOT NULL DEFAULT 0,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `content` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `url` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `img` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `app_guide_recommend`
--

INSERT INTO `app_guide_recommend` (`id`, `title`, `content`, `url`, `img`) VALUES
(1, 'Guide for Novice Warriors', 'Complete Conquest of Remaster for New/Returning Warriors!', '/powerbook/search?searchType=4&query=Beginner%27s%20Guide', '/img/guide/guide-book.png'),
(2, 'Play Support System', 'Play Continues<br>Even Away from the PC!', '/powerbook/search?searchType=4&query=Play%20Support%20System', '/img/guide/contents-img1.png'),
(3, 'World Siege', 'Generous Rewards for the<br>Last Winner!', '/powerbook/search?searchType=4&query=World%20Siege', '/img/guide/4033.png'),
(4, 'PC Room Premium Service', 'Exclusive Buffs &amp; Exclusive Hunting Grounds<br>&amp; Transformation Benefits', '/powerbook/search?searchType=4&query=PC%20Room%20Premium', '/img/guide/contents-img3.png'),
(5, 'Instance Dungeon', 'Party Content<br>High Experience Points!', '/powerbook/search?searchType=4&query=Instance%20Dungeon', '/img/guide/contents-4.png'),
(6, 'Lineage N Shop', 'Full of Goodies<br>When Enjoyed Together!', '/goods', '/img/guide/contents-img6.png');
