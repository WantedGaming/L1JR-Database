
-- --------------------------------------------------------

--
-- Table structure for table `marble`
--

CREATE TABLE `marble` (
  `marble_id` int(10) NOT NULL,
  `char_id` int(10) DEFAULT NULL,
  `char_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `marble`
--

INSERT INTO `marble` (`marble_id`, `char_id`, `char_name`) VALUES
(300378865, 299859425, 'Elfo'),
(300832776, 299903994, 'Pimiento');
