
-- --------------------------------------------------------

--
-- Table structure for table `beginner_box`
--

CREATE TABLE `beginner_box` (
  `itemid` int(20) NOT NULL,
  `count` int(20) NOT NULL DEFAULT 0,
  `enchantlvl` int(6) NOT NULL DEFAULT 0,
  `item_name` varchar(50) NOT NULL,
  `desc_kr` varchar(50) NOT NULL,
  `bless` int(10) NOT NULL DEFAULT 1,
  `activate` enum('lancer','fencer','warrior','illusionist','dragonknight','darkelf','wizard','elf','knight','crown','all') NOT NULL DEFAULT 'all'
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `beginner_box`
--

INSERT INTO `beginner_box` (`itemid`, `count`, `enchantlvl`, `item_name`, `desc_kr`, `bless`, `activate`) VALUES
(604, 1, 6, 'Cold Spear', '혹한의 창', 1, 'lancer'),
(22365, 1, 4, 'Helm of Warriors', '전사단 투구', 1, 'warrior'),
(20085, 1, 4, 'T-shirt', '티셔츠', 1, 'all'),
(20068, 1, 4, 'Cloak of Aden Knights', '아덴 기사단의 망토', 1, 'all'),
(20163, 1, 4, 'Iron Gloves', '강철 장갑', 1, 'all'),
(20194, 1, 4, 'Iron Boots', '강철 부츠', 1, 'all'),
(222300, 1, 0, 'Annihilator\'s Plate Armor', '멸마의 판금 갑옷', 1, 'warrior'),
(22337, 1, 0, 'Templar Belt', '수련자의 벨트', 1, 'all'),
(22338, 1, 0, 'Templar Ring', '수련자의 반지', 1, 'all'),
(22339, 1, 0, 'Amulet of Templar', '수련자의 목걸이', 1, 'all'),
(22073, 1, 0, 'Templar Earring', '수련자의 귀걸이', 1, 'all'),
(22338, 1, 0, 'Templar Ring', '수련자의 반지', 1, 'all'),
(203015, 1, 6, 'Gale Axe', '질풍의 도끼', 1, 'warrior'),
(191, 1, 6, 'Salcheon\'s Bow', '살천의 활', 1, 'elf'),
(120011, 1, 4, 'Helmet of Magic Resistance', '마법 방어 투구', 1, 'elf'),
(222302, 1, 0, 'Destroyer\'s Leather Armor', '멸마의 가죽 갑옷', 1, 'elf'),
(1125, 1, 6, 'Destruction Edoryu', '파괴의 이도류', 1, 'darkelf'),
(120011, 1, 4, 'Helmet of Magic Resistance', '마법 방어 투구', 1, 'darkelf'),
(222302, 1, 0, 'Destroyer\'s Leather Armor', '멸마의 가죽 갑옷', 1, 'darkelf'),
(1135, 1, 6, 'Resonance Kiringku', '공명의 키링크', 1, 'illusionist'),
(120011, 1, 4, 'Helmet of Magic Resistance', '마법 방어 투구', 1, 'illusionist'),
(222303, 1, 0, 'Annihilator\'s Robe', '멸마의 로브', 1, 'illusionist'),
(222301, 1, 0, 'Destroyer\'s Scale Armor', '멸마의 비늘 갑옷', 1, 'dragonknight'),
(501, 1, 6, 'Defiler\'s Chainsword', '파멸자의 체인소드', 1, 'dragonknight'),
(120011, 1, 4, 'Helmet of Magic Resistance', '마법 방어 투구', 1, 'dragonknight'),
(115, 1, 0, 'Crystal Staff', '수정 지팡이', 1, 'wizard'),
(120011, 1, 4, 'Helmet of Magic Resistance', '마법 방어 투구', 1, 'wizard'),
(222303, 1, 0, 'Annihilator\'s Robe', '멸마의 로브', 1, 'wizard'),
(603, 1, 6, 'Angel Staff', '천사의 지팡이', 1, 'wizard'),
(20055, 1, 4, 'Cloak of Mana', '마나 망토', 1, 'wizard'),
(600, 1, 6, 'Sword of Thunder', '뇌신검', 1, 'crown'),
(222301, 1, 0, 'Destroyer\'s Scale Armor', '멸마의 비늘 갑옷', 1, 'crown'),
(601, 1, 6, 'Greatsword of Doom', '파멸의 대검', 1, 'knight'),
(222300, 1, 0, 'Annihilator\'s Plate Armor', '멸마의 판금 갑옷', 1, 'knight'),
(222300, 1, 0, 'Annihilator\'s Plate Armor', '멸마의 판금 갑옷', 1, 'lancer'),
(120011, 1, 4, 'Helmet of Magic Resistance', '마법 방어 투구', 1, 'lancer');
