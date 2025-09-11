
-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `id` int(30) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`id`, `message`) VALUES
(1, '\\n\\n\\n\\nWelcome to Lineage Warrior Server.\r\n\r\nThis is the best and most updated english Lineage Emulator.\r\n\r\nPlease refer to the website for server information.'),
(2, '\\n\\n\\n\\n1st week: Axe, Insignia, Crest and Pendant are capped at +5\r\n\r\n2nd Week: Axe, Insignia, Crest and Pendant are capped at +6\r\n\r\n3rd Week: Axe, Insignia, Crest and Pendant are capped at +7\r\n\r\nNo restrictions from week 4\r\n\r\nRanking system will be activated 24 hours after account opening.'),
(3, '\\n\\n\\n\\nThe management team is not responsible or involved in anything related about the interaction between users.\r\n\r\nWe are not responsible for hacking and fraud between users.\r\n\r\nBugs and vulnerabilities can be discovered and quick repaired according to the comunity contribution.\r\n\r\nIf you help us to find and fix bugs and/or vulnerabilities, you can be compensated. \r\n\r\nMalicious behavior on the server will be sanctioned.\r\n'),
(4, '\\n\\n\\n\\nAll suspicious activity is monitored.\r\n\r\nIf a hack attempt is confirmed, all involved IPs will be blocked.'),
(5, '\\n\\n\\n\\nRanking reward information\r\n\r\nFrom time to time the characters positioned in the first places of the ranking will be\\nrewarded as follows:\r\n\r\nFrom 1st to  3rd place: 300 million adenas\r\nFrom 4th to  5th place: 200 million adenas\r\nFrom 6th to 10th place: 100 million adenas');
