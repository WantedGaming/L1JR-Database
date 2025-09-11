
-- --------------------------------------------------------

--
-- Table structure for table `beginner`
--

CREATE TABLE `beginner` (
  `id` int(10) NOT NULL,
  `item_id` int(6) NOT NULL DEFAULT 0,
  `count` int(10) NOT NULL DEFAULT 0,
  `charge_count` int(10) NOT NULL DEFAULT 0,
  `enchantlvl` int(6) NOT NULL DEFAULT 0,
  `item_name` varchar(50) NOT NULL DEFAULT '',
  `desc_kr` varchar(50) NOT NULL,
  `activate` enum('A','P','K','E','W','D','T','B','J','F','L') NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `beginner`
--

INSERT INTO `beginner` (`id`, `item_id`, `count`, `charge_count`, `enchantlvl`, `item_name`, `desc_kr`, `activate`) VALUES
(1, 40030, 10, 0, 0, 'Templar Haste Potion', '기사단의 속도향상 물약', 'A'),
(2, 35, 1, 0, 0, 'Templar Sword', '연습용 한손검', 'P'),
(3, 35, 1, 0, 0, 'Templar Sword', '연습용 한손검', 'K'),
(4, 35, 1, 0, 0, 'Templar Sword', '연습용 한손검', 'T'),
(5, 35, 1, 0, 0, 'Templar Sword', '연습용 한손검', 'F'),
(7, 174, 1, 0, 0, 'Templar Stone Bow', '연습용 석궁', 'E'),
(8, 120, 1, 0, 0, 'Templar Staff', '연습용 지팡이', 'W'),
(9, 156, 1, 0, 0, 'Templar Claw', '연습용 크로우', 'D'),
(10, 203001, 1, 0, 0, 'Initiate Kiringku', '연습용 키링크', 'B'),
(11, 203000, 1, 0, 0, 'Initiate Minor Axe', '연습용 낡은 도끼', 'J'),
(12, 105, 1, 0, 0, 'Templar Spear', '연습용 창', 'L'),
(20, 30088, 1000, 0, 0, 'Templar Arrows', '기사단의 화살', 'E'),
(50, 60723, 200, 0, 0, 'Templar Red Potion', '기사단의 농축 체력 회복제', 'A'),
(51, 40095, 10, 0, 0, 'Templar Escape Scroll', '기사단의 귀환 주문서', 'A');
