
-- --------------------------------------------------------

--
-- Table structure for table `weapon_damege`
--

CREATE TABLE `weapon_damege` (
  `item_id` int(10) NOT NULL,
  `name` varchar(40) NOT NULL,
  `addDamege` int(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `weapon_damege`
--

INSERT INTO `weapon_damege` (`item_id`, `name`, `addDamege`) VALUES
(12, '바람칼날의 단검', 10),
(61, '진명황의 집행검', 10),
(86, '붉은 그림자의 이도류', 10),
(134, '수정 결정체 지팡이', 10),
(202011, '가이아의 격노', 10),
(202012, '히페리온의 절망', 10),
(202013, '크로노스의 공포', 10),
(202014, '타이탄의 분노', 10),
(203041, '사신의 검', 10),
(203049, '지배자의 처형', 10);
