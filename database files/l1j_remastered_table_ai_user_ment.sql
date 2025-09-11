
-- --------------------------------------------------------

--
-- Table structure for table `ai_user_ment`
--

CREATE TABLE `ai_user_ment` (
  `id` int(3) NOT NULL,
  `ment` varchar(100) DEFAULT NULL,
  `type` enum('login','logout','kill','death') DEFAULT 'login'
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `ai_user_ment`
--

INSERT INTO `ai_user_ment` (`id`, `ment`, `type`) VALUES
(1, 'Hi', 'login'),
(2, 'Hi Hi', 'login'),
(3, 'The guys are here!', 'login'),
(4, 'Bros here!', 'login'),
(5, 'Let\'s go, guys!', 'logout'),
(6, 'See you next time!', 'logout'),
(7, 'Bye-bye', 'logout'),
(8, 'Thank you', 'kill'),
(9, 'Thank you for your hard work', 'kill'),
(10, 'Thanks for your efforts', 'kill'),
(11, 'Sorry', 'death'),
(12, 'Sorry bro', 'death'),
(13, 'My apologies', 'death');
