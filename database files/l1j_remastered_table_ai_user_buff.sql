
-- --------------------------------------------------------

--
-- Table structure for table `ai_user_buff`
--

CREATE TABLE `ai_user_buff` (
  `class` enum('lancer','fencer','warrior','illusionist','dragonknight','darkelf','wizard','elf','knight','crown') NOT NULL DEFAULT 'crown',
  `elfAttr` int(2) NOT NULL DEFAULT 0,
  `buff` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `ai_user_buff`
--

INSERT INTO `ai_user_buff` (`class`, `elfAttr`, `buff`) VALUES
('lancer', 0, '2,5052'),
('fencer', 0, '2'),
('warrior', 0, '2,230'),
('illusionist', 0, '200,205,210,215,217,221,222,245'),
('dragonknight', 0, '185,194,244'),
('darkelf', 0, '97,98,100,103,104,105,106,108,109,233'),
('wizard', 0, '2,13,20,25,41,47,49,51,55,5114'),
('elf', 0, '2,20,25,41,47,128,133,134,136,168,5112'),
('elf', 1, '20,25,41,128,133,134,136,147,151,167,178,5112'),
('elf', 2, '20,25,41,47,128,133,134,136,150,154,5112'),
('elf', 4, '2,20,25,41,47,128,133,134,136,148,157,159,176,5112'),
('elf', 8, '2,20,25,41,47,128,133,134,136,149,165,166,177,5112'),
('knight', 0, '2,87,88,90,93'),
('crown', 0, '113,114,116,121');
