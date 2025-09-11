
-- --------------------------------------------------------

--
-- Table structure for table `app_board_pitch`
--

CREATE TABLE `app_board_pitch` (
  `id` int(10) NOT NULL,
  `name` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'NULL',
  `date` datetime DEFAULT NULL,
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `content` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `readcount` int(10) DEFAULT 0,
  `chatype` int(2) DEFAULT 0,
  `chasex` int(1) DEFAULT 0,
  `likenames` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `mainImg` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `top` enum('true','false') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `app_board_pitch`
--

INSERT INTO `app_board_pitch` (`id`, `name`, `date`, `title`, `content`, `readcount`, `chatype`, `chasex`, `likenames`, `mainImg`, `top`) VALUES
(1, 'Metis', '2021-04-24 19:54:57', 'Guide on How to Use the Promotion Board', '<h1><b>Promotion Board Usage Guide</b></h1><p><br></p><h3><span style=\"background-color: rgb(255, 0, 0);\"><font color=\"#ffffff\">If you promote once a day, we will provide useful rewards for playing the game.</font></span></h3><p><br></p><p><b>- Promotion Methods -</b></p><p>Method 1. Register a server promotion post on the free board and promotion board of Lineage Free Server, a total of 3 places.</p><p>Method 2. Conduct a minimum of 1-hour live broadcast on YouTube.</p><p><br></p><p><b>- After Completion -</b></p><p>Attach the character name and link to receive the reward on this promotion board.</p><p>(For YouTube broadcasts, if you delete the video before receiving the reward, it cannot be confirmed. Therefore, please delete it after receiving the reward.)</p><p><br></p><p><b>- Rewards -</b></p><h2><font color=\"#ffffff\" style=\"background-color: rgb(255, 0, 0);\">Ainhasad Points 5,000 or 100 Promotion Coins</font></h2>', 152, 2, 1, NULL, NULL, 'true');
