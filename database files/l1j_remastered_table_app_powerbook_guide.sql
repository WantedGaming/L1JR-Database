
-- --------------------------------------------------------

--
-- Table structure for table `app_powerbook_guide`
--

CREATE TABLE `app_powerbook_guide` (
  `group_type` enum('1. Beginner''s Guide','2. Classes','3. Items','4. Magic','5. Magic Dolls','6. Monsters & Dungeons','7. Party Content','8. World Content','9. Combat System','10. Community','11. Main Systems','12. Service') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '1. Beginner''s Guide',
  `id` int(2) NOT NULL DEFAULT 0,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `uri` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_new` enum('true','false') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `app_powerbook_guide`
--

INSERT INTO `app_powerbook_guide` (`group_type`, `id`, `title`, `uri`, `is_new`) VALUES
('1. Beginner\'s Guide', 1, 'Play Support System', '/powerbook/search?searchType=4&query=Play%20Support%20System', 'false'),
('1. Beginner\'s Guide', 3, 'Knight Equipment', '/powerbook/search?searchType=4&query=Knight%20Equipment', 'false'),
('1. Beginner\'s Guide', 4, 'Newbie Zone Character Growth Support', '/powerbook/search?searchType=4&query=Character%20Growth', 'false'),
('1. Beginner\'s Guide', 5, 'Beginner Warrior Guidebook', '/powerbook/search?searchType=4&query=Warrior', 'false'),
('2. Classes', 1, 'Class Introduction', '/powerbook/search?searchType=4&query=Classes', 'false'),
('2. Classes', 2, 'Polymorph System', '/powerbook/search?searchType=4&query=Polymorphs', 'false'),
('2. Classes', 3, 'Ranking System', '/powerbook/search?searchType=4&query=Ranking', 'false'),
('2. Classes', 4, 'Stat System', '/powerbook/search?searchType=4&query=Stats', 'false'),
('3. Items', 1, 'Introduction to Items', '/powerbook/search?searchType=4&query=Items', 'false'),
('3. Items', 2, 'Weapons', '/powerbook/search?searchType=4&query=Weapons', 'false'),
('3. Items', 3, 'Armor', '/powerbook/search?searchType=4&query=Armor', 'false'),
('3. Items', 4, 'Accessories', '/powerbook/search?searchType=4&query=Accessory', 'false'),
('3. Items', 5, 'Protection System', '/powerbook/search?searchType=4&query=Protection%20System', 'false'),
('4. Magic', 1, 'Lancer Skills', '/powerbook/search?searchType=4&query=Lancer%20Skills', 'false'),
('4. Magic', 2, 'Fencer Skills', '/powerbook/search?searchType=4&query=Fencer%20Skills', 'false'),
('4. Magic', 3, 'Warrior Skills', '/powerbook/search?searchType=4&query=Warrior%20Skills', 'false'),
('4. Magic', 4, 'Normal Magic', '/powerbook/search?searchType=4&query=Normal%20Magic', 'false'),
('4. Magic', 5, 'Elemental Magic', '/powerbook/search?searchType=4&query=Elemental%20Magic', 'false'),
('4. Magic', 6, 'Black Spirit Magic', '/powerbook/search?searchType=4&query=Black%20Spirit%20Magic', 'false'),
('4. Magic', 7, 'Monarch Magic', '/powerbook/search?searchType=4&query=Monarch%20Magic', 'false'),
('4. Magic', 8, 'Knight Skills', '/powerbook/search?searchType=4&query=Knight%20Skills', 'false'),
('4. Magic', 9, 'Dragon Knight Skills', '/powerbook/search?searchType=4&query=Dragon%20Knight%20Skills', 'false'),
('4. Magic', 10, 'Illusionist Magic', '/powerbook/search?searchType=4&query=Illusionist%20Magic', 'false'),
('5. Magic Dolls', 1, 'Magic Dolls', '/powerbook/search?searchType=4&query=Magic%20Doll', 'false'),
('5. Magic Dolls', 2, 'Strengthen of Magic Doll Potential', '/powerbook/search?searchType=4&query=Strengthen%20Magic%20Doll', 'false'),
('6. Monsters & Dungeons', 1, 'Field Hunting Grounds', '/powerbook/search?searchType=4&query=Hunting%20Grounds', 'false'),
('6. Monsters & Dungeons', 2, 'Hidden Hunting Grounds', '/powerbook/search?searchType=4&query=Hidden%20Hunting%20Grounds', 'false'),
('6. Monsters & Dungeons', 3, 'Boss Monsters', '/powerbook/search?searchType=4&query=Boss%20Monster', 'false'),
('7. Party Content', 1, 'Instance Dungeon', '/powerbook/search?searchType=4&query=Dungeons', 'false'),
('7. Party Content', 2, 'Dark Dragon Dungeon', '/powerbook/search?searchType=4&query=Dark%20Dragon%27s%20Dungeon', 'false'),
('7. Party Content', 3, 'Infinite War', '/powerbook/search?searchType=4&query=Infinite%20War', 'false'),
('7. Party Content', 4, 'Dragon Raid', '/powerbook/search?searchType=4&query=Dragon%20Raid', 'false'),
('7. Party Content', 5, 'Halfas Raid', '/powerbook/search?searchType=4&query=Halfas%20Raid', 'false'),
('8. World Content', 1, 'Tower of Domination', '/powerbook/search?searchType=4&query=Domination%20Tower', 'false'),
('8. World Content', 2, 'Ant Queen\'s Nest', '/powerbook/search?searchType=4&query=Ant%20Queen%27s%20Nest', 'false'),
('8. World Content', 3, 'World Siege', '/powerbook/search?searchType=4&query=World%20Siege', 'false'),
('9. Combat System', 1, 'PvP System', '/powerbook/search?searchType=4&query=PvP', 'false'),
('9. Combat System', 2, 'Battle System', '/powerbook/search?searchType=4&query=2023%20Battle%20System%20Reorganization', 'false'),
('9. Combat System', 3, 'Guardian System ???', '/powerbook/search?searchType=4&query=Guardian%20System', 'false'),
('9. Combat System', 4, 'Siege War', '/powerbook/search?searchType=4&query=Siege', 'false'),
('9. Combat System', 6, 'Survival Cry', '/powerbook/search?searchType=4&query=Survival%20Cry', 'false'),
('9. Combat System', 7, 'Party Assist', '/powerbook/search?searchType=4&query=Party%20Assist', 'false'),
('10. Community', 1, 'Clan System', '/powerbook/search?searchType=4&query=Clan', 'false'),
('10. Community', 2, 'Clan Houses', '/powerbook/search?searchType=4&query=Houses', 'false'),
('10. Community', 3, 'Clan Gathering Place', '/powerbook/search?searchType=4&query=Clan%20Gathering', 'false'),
('10. Community', 4, 'Friend System', '/powerbook/search?searchType=4&query=Friends', 'false'),
('10. Community', 5, 'Party System', '/powerbook/search?searchType=4&query=Party', 'false'),
('10. Community', 6, 'Letter System', '/powerbook/search?searchType=4&query=Letter%2FMail', 'false'),
('10. Community', 7, 'Inn System', '/powerbook/search?searchType=4&query=Inn%20Keeper', 'false'),
('11. Main Systems', 1, 'Einhasad\'s Blessing', '/powerbook/search?searchType=4&query=Einhasad%27s%20Blessing', 'false'),
('11. Main Systems', 2, 'Einhasad Points', '/powerbook/search?searchType=4&query=Einhasad%20Point', 'false'),
('11. Main Systems', 3, 'TAM System', '/powerbook/search?searchType=4&query=TAM', 'false'),
('11. Main Systems', 4, 'Fishing System', '/powerbook/search?searchType=4&query=Fishing', 'false'),
('11. Main Systems', 5, 'Hunting Grounds Catalog', '/powerbook/search?searchType=4&query=Hunting%20Grounds', 'false'),
('11. Main Systems', 6, 'Silectis Exhibition', '/powerbook/search?searchType=4&query=Silectis%20Exhibition', 'true'),
('11. Main Systems', 7, 'Relic System', '/powerbook/search?searchType=4&query=Relic%20System', 'true'),
('12. Service', 1, 'Full Moon Treasure Island Event', '/powerbook/search?searchType=4&query=Full%20Moon%20Treasure%20Island', 'true'),
('12. Service', 2, 'Red Orc Mask Event ???', '/powerbook/search?searchType=4&query=Red%20Orc%20Mask%20Event', 'true'),
('12. Service', 3, 'PC Room Premium Service', '/powerbook/search?searchType=4&query=PC%20Room%20Premium', 'true');
