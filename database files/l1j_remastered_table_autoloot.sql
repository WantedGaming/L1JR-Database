
-- --------------------------------------------------------

--
-- Table structure for table `autoloot`
--

CREATE TABLE `autoloot` (
  `item_id` int(11) NOT NULL DEFAULT 0,
  `note` varchar(50) DEFAULT NULL,
  `desc_kr` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `autoloot`
--

INSERT INTO `autoloot` (`item_id`, `note`, `desc_kr`) VALUES
(7022, 'Totem of Phonos', '포노스의 토템'),
(7023, 'Gold Coin Bag (Phonos)', '금화주머니(포노스)'),
(30861, 'Silver Knight Dungeon Sandglass', '은기사 던전 모래 시계'),
(40131, 'Totem', '토템'),
(40132, 'Totem', '토템'),
(40133, 'Totem', '토템'),
(40134, 'Totem', '토템'),
(40135, 'Totem', '토템'),
(40710, 'Friend\'s Bag', '친구의 가방'),
(41921, 'Golden Feather', '금빛깃털'),
(60716, 'Knight Coins', '기사단의 주화'),
(140050, 'Chef\'s Snack Bag', '요리사의 간식 주머니'),
(202016, 'Earth Crystal', '대지의 결정체'),
(410047, 'Dwarf Mushroom', '난쟁이 버섯'),
(410048, 'Dwarf Charm', '난쟁이 부적'),
(410049, 'Old Water Pearl', '낡은 물결의 진주'),
(410050, 'Old White Crystal', '낡은 하얀 수정'),
(410051, 'Water Dragon Dry Tears', '수룡의 메마른 눈물'),
(410052, 'Earth Dragon Dry Tears', '지룡의 메마른 눈물'),
(410053, 'Wind Dragon Dry Tears', '풍룡의 메마른 눈물'),
(410054, 'Fire Dragon Dry Tears', '화룡의 메마른 눈물'),
(410093, 'Spirit of the Full Moon', '만월의 정기'),
(410507, 'Soul Fragment', '영혼 조각'),
(410555, 'Frozen Heart', '얼어붙은 심장'),
(600249, 'Padora Receipt', '판도라의 증서'),
(700015, 'Tears of a Frozen Woman', '얼어붙은 여인의 눈물'),
(810007, 'Purification Rod', '정화막대'),
(810008, 'Evil Spirit Seed', '악령의씨앗');
