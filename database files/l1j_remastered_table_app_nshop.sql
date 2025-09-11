
-- --------------------------------------------------------

--
-- Table structure for table `app_nshop`
--

CREATE TABLE `app_nshop` (
  `id` int(10) NOT NULL,
  `itemid` int(10) NOT NULL DEFAULT 0,
  `itemname` varchar(50) NOT NULL,
  `price` int(10) NOT NULL DEFAULT 0,
  `price_type` enum('NCOIN','NPOINT') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'NCOIN',
  `saved_point` int(10) NOT NULL DEFAULT 0,
  `pack` int(10) NOT NULL DEFAULT 0,
  `enchant` int(10) NOT NULL DEFAULT 0,
  `limitCount` int(10) NOT NULL DEFAULT 50,
  `flag` enum('NONE','DISCOUNT','ESSENTIAL','HOT','LIMIT','LIMIT_MONTH','LIMIT_WEEK','NEW','REDKNIGHT') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'NONE',
  `iteminfo` varchar(700) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `app_nshop`
--

INSERT INTO `app_nshop` (`id`, `itemid`, `itemname`, `price`, `price_type`, `saved_point`, `pack`, `enchant`, `limitCount`, `flag`, `iteminfo`) VALUES
(1, 400254, '100m Adena Check', 10000, 'NCOIN', 1000, 0, 0, 10, 'HOT', 'Double-click to obtain 100 million Adena.'),
(2, 31162, 'Decisive Battle Scroll', 2000, 'NCOIN', 200, 5, 0, 50, 'NEW', 'Duration: 300 seconds. AC-5, Close/Long-range accuracy +5, Magic accuracy +2, PvP damage reduction +5, PvP additional damage +5.'),
(3, 1000006, 'Dragon Treasure Chest', 1000, 'NCOIN', 100, 10, 0, 50, 'NONE', 'Upon purchase, acquire Dragon\'s Diamond and bonus items.'),
(4, 3000062, 'Growth Fishing Set', 200, 'NCOIN', 20, 0, 0, 50, 'NONE', 'Obtain Growth Scroll (100) x1.'),
(5, 820018, 'Pure Elixir', 1500, 'NCOIN', 150, 0, 0, 50, 'HOT', 'Items required for Elixir crafting.'),
(6, 820019, 'Pure Elixir (EXP)', 2000, 'NPOINT', 0, 0, 0, 50, 'NEW', 'Crafting materials for Elixir (EXP).'),
(7, 30105, 'Glowing Growth Potion', 100, 'NCOIN', 10, 10, 0, 50, 'HOT', 'Experience bonus +20% for 1,800 seconds.'),
(8, 31159, 'Warrior Enchant Scroll', 100, 'NCOIN', 10, 10, 0, 50, 'HOT', 'Close-range accuracy +5, Close-range damage +3, PvP damage reduction +3.'),
(9, 31160, 'Archer Enchant Scroll', 100, 'NCOIN', 10, 10, 0, 50, 'HOT', 'Long-range damage +3, Long-range accuracy +5, PvP damage reduction +3.'),
(10, 31161, 'Wizard Enchant Scroll', 100, 'NCOIN', 10, 10, 0, 50, 'HOT', 'SP +3, Magic accuracy +5, PvP damage reduction +3.'),
(11, 2300072, 'Hero Relic Bag', 100, 'NCOIN', 10, 10, 0, 50, 'NEW', 'Obtain 1 Hero\'s Artifact upon use.'),
(12, 560029, 'Elephant Teleport Book', 100, 'NCOIN', 10, 100, 0, 50, 'NONE', 'Teleport to the town/field/dungeon set in the Memory Book.'),
(13, 600226, 'Fruith of Growth (3d)', 300, 'NCOIN', 30, 0, 0, 10, 'NONE', 'Applicable to one character per account, with a maximum of 5 connections.'),
(14, 51160, 'Hero Protection (3d)', 3000, 'NPOINT', 0, 0, 0, 10, 'HOT', 'Apply effects: STR+1, DEX+1, INT+1, Close-range accuracy/damage +3, Long-range accuracy/damage +3, Magic accuracy/damage +3, Skill accuracy +3, Elemental accuracy +3, Attribute accuracy +3, Fear accuracy +3, PvP additional damage +3.'),
(15, 51170, 'Life Protection (3d)', 2000, 'NPOINT', 0, 0, 0, 10, 'NEW', 'Apply effects: HP+300, MP+100 (Cannot be canceled).'),
(16, 500220, 'Witch\'s Mana Potion', 500, 'NCOIN', 50, 3, 0, 50, 'HOT', 'Witch\'s Mana Recovery Potion: Instantly recovers 1000 MP upon use (3 potions in total).'),
(17, 3110091, 'Bible of Atonement Box', 300, 'NCOIN', 30, 0, 0, 50, 'NONE', 'Obtain 10 Atonement Scriptures upon opening.'),
(18, 200000, 'Candle of Reminiscence', 1000, 'NCOIN', 100, 0, 0, 50, 'NONE', 'Allows the reset of character stats upon use.'),
(19, 1500214, 'Spartoi Magic Doll Box', 1000, 'NCOIN', 100, 0, 0, 1, 'LIMIT', 'Obtain Spatoy Doll upon opening.'),
(20, 1500215, 'Magic Doll: Scarecrow Box', 1000, 'NCOIN', 100, 0, 0, 1, 'LIMIT', 'Obtain Scarecrow Doll upon opening.'),
(21, 52005, 'Hero Hourglass', 10000, 'NPOINT', 0, 0, 0, 10, 'NONE', 'Extends the usage period of a hero\'s weapon when used.'),
(22, 52000, 'Hero Weapon Enchant Scroll', 2000, 'NPOINT', 0, 0, 0, 50, 'NONE', 'Increases the enchantment level of a hero\'s weapon by 1 permanently with a certain probability.'),
(23, 52007, 'Hero Two-handed Sword Box', 30000, 'NPOINT', 0, 0, 0, 1, 'NONE', 'Legendary weapon exclusively for heroes! Usable for 7 days after opening the box.'),
(24, 52008, 'Hero Sword Box', 30000, 'NPOINT', 0, 0, 0, 1, 'NONE', 'Legendary weapon exclusively for heroes! Usable for 7 days after opening the box.'),
(25, 52009, 'Hero Dagger Box', 30000, 'NPOINT', 0, 0, 0, 1, 'NONE', 'Legendary weapon exclusively for heroes! Usable for 7 days after opening the box.'),
(26, 52010, 'Hero Bow Box', 30000, 'NPOINT', 0, 0, 0, 1, 'NONE', 'Legendary weapon exclusively for heroes! Usable for 7 days after opening the box.'),
(27, 52011, 'Hero Staff Box', 30000, 'NPOINT', 0, 0, 0, 1, 'NONE', 'Legendary weapon exclusively for heroes! Usable for 7 days after opening the box.'),
(28, 52012, 'Hero Edoryu Box', 30000, 'NPOINT', 0, 0, 0, 1, 'NONE', 'Legendary weapon exclusively for heroes! Usable for 7 days after opening the box.'),
(29, 52013, 'Hero Chainsword Box', 30000, 'NPOINT', 0, 0, 0, 1, 'NONE', 'Legendary weapon exclusively for heroes! Usable for 7 days after opening the box.'),
(30, 52014, 'Hero Kiringku Box', 30000, 'NPOINT', 0, 0, 0, 1, 'NONE', 'Legendary weapon exclusively for heroes! Usable for 7 days after opening the box.'),
(31, 52015, 'Hero Axe Box', 30000, 'NPOINT', 0, 0, 0, 1, 'NONE', 'Legendary weapon exclusively for heroes! Usable for 7 days after opening the box.'),
(32, 52016, 'Hero Spear Box', 30000, 'NPOINT', 0, 0, 0, 1, 'NONE', 'Legendary weapon exclusively for heroes! Usable for 7 days after opening the box.');
