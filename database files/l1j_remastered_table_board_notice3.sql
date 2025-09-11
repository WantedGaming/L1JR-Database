
-- --------------------------------------------------------

--
-- Table structure for table `board_notice3`
--

CREATE TABLE `board_notice3` (
  `id` int(10) NOT NULL,
  `name` varchar(16) DEFAULT NULL,
  `date` varchar(16) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `content` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `board_notice3`
--

INSERT INTO `board_notice3` (`id`, `name`, `date`, `title`, `content`) VALUES
(0, 'Metis', '16/01/27', '● Server package information ●', '▶ Package Components ◀\r\n\r\n[Payment: 100,000 won]\r\n[Coin Reward upon purchase]\r\nThe displayed items are all,\r\nFor higher tiers, please contact \"Metis\" after use.\r\nPixie\'s Feather: 30,000 won (50,000 pieces)\r\nAfter the first purchase, it is available for repurchase due to equipment drop.');
