
-- --------------------------------------------------------

--
-- Table structure for table `app_guide_boss`
--

CREATE TABLE `app_guide_boss` (
  `id` int(2) NOT NULL DEFAULT 0,
  `loc` int(2) NOT NULL DEFAULT 0,
  `locName` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `number` int(2) NOT NULL DEFAULT 0,
  `bossName` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `bossImg` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `spawnLoc` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `spawnTime` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `dropName` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `app_guide_boss`
--

INSERT INTO `app_guide_boss` (`id`, `loc`, `locName`, `number`, `bossName`, `bossImg`, `spawnLoc`, `spawnTime`, `dropName`) VALUES
(1, 0, 'Talking Island', 1, 'Baphomet', '/img/guide/boss_tab01_01.png', 'Talking Island Dungeon 2nd Floor', 'Probability Appearance', 'Baphomet\'s Armor, Pure Elixir'),
(2, 0, 'Talking Island', 2, 'Harpy', '/img/guide/boss_tab01_02.png', 'Talking Island Field', 'Probability Appearance', 'Blessed Silver Crow, Pure Elixir'),
(3, 0, 'Talking Island', 3, 'Kurtz', '/img/guide/boss_tab01_03.png', 'Talking Island Field', 'Probability Appearance', 'Renegade\'s Shield, Kurtz\'s Sword (Revival), Commander\'s Helmet (Revival)'),
(4, 1, 'Gludio Dungeon', 1, 'Sema', '/img/guide/boss_tab02_01.png', 'Gludio Dungeon 3rd, 4th Floor', 'Probability Appearance', 'Spellbook (Death Heal), Baphomet\'s Staff, Sema\'s Ring, Orlim\'s Necklace'),
(5, 1, 'Gludio Dungeon', 2, 'Mercuryor', '/img/guide/boss_tab02_02.png', 'Gludio Dungeon 3rd, 4th Floor', 'Probability Appearance', 'Spellbook (Death Heal), Ice Queen\'s Staff, Mercuryor\'s Hat'),
(6, 1, 'Gludio Dungeon', 3, 'Valterzar', '/img/guide/boss_tab02_03.png', 'Gludio Dungeon 3rd, 4th Floor', 'Probability Appearance', 'Spellbook (Death Heal), Demon\'s Staff, Valterzar\'s Hat'),
(7, 1, 'Gludio Dungeon', 4, 'Caspar', '/img/guide/boss_tab02_04.png', 'Gludio Dungeon 3rd, 4th Floor', 'Probability Appearance', 'Spellbook (Death Heal), Zeros\'s Staff (Revival), Caspar\'s Hat'),
(8, 1, 'Gludio Dungeon', 5, 'Necromancer', '/img/guide/boss_tab02_05.png', 'Gludio Dungeon 6th Floor', 'Probability Appearance', 'Warlock\'s Robe, Archmage\'s Hat'),
(9, 1, 'Gludio Dungeon', 6, 'Death Knight', '/img/guide/boss_tab02_06.png', 'Gludio Dungeon 7th Floor', 'Probability Appearance', 'Skillbook (Absolute Blade), Warrior\'s Seal (Titan: Blitz), Skillbook (Counter Barrier), Rond\'s Swordsmanship, Transparent Cloak, Death Knight\'s Inferno Sword'),
(10, 2, 'Ancient Spirit Tomb', 1, 'Mambo King', '/img/guide/boss_tab03_01.png', 'Ancient Spirit Tomb', 'Probability Appearance', 'Spirit Crystal (Soul of Frame), Spirit Crystal (Striker Gale), Orichalcon Dagger'),
(11, 2, 'Ancient Spirit Tomb', 2, 'Spirit Watcher', '/img/guide/boss_tab03_02.png', 'Ancient Spirit Tomb', 'Probability Appearance', 'Spirit Crystal (Soul of Frame), Spirit Crystal (Striker Gale), Orichalcon Dagger'),
(12, 3, 'Wind Dragon\'s Nest', 1, 'Mino Shaman', '/img/guide/boss_tab04_01.png', 'Wind Dragon\'s Nest', 'Probability Appearance', 'Sealed Blood Wind Axe, Ring of One Shot'),
(13, 4, 'Ivory Tower', 1, 'Hidden Dark Wizard', '/img/guide/boss_tab05_01.png', 'Ivory Tower 4th Floor', 'Probability Appearance', 'Demon\'s Swordsmanship, Demon\'s Crossbow'),
(14, 4, 'Ivory Tower', 2, 'Mimic', '/img/guide/boss_tab05_02.png', 'Ivory Tower 4th, 5th Floor', 'Probability Appearance', 'Spellbook (Meteor Strike), Demon\'s Swordsmanship, Demon\'s Crossbow'),
(15, 4, 'Ivory Tower', 3, 'Hidden Haden\'s Replica', '/img/guide/boss_tab05_03.png', 'Ivory Tower 5th Floor', 'Probability Appearance', 'Memory Crystal (Dark Horse), Demon\'s Swordsmanship, Demon\'s Crossbow'),
(16, 5, 'Oren Cliff', 1, 'Big-footed Mayo', '/img/guide/boss_tab06_01.png', 'Oren Cliff', 'Probability Appearance', 'Extreme Chain Sword, Cold Key Link, Ice Queen\'s Staff'),
(17, 6, 'Giran Prison', 1, 'Faust', '/img/guide/boss_tab07_01.png', 'Giran Prison 1st Floor', 'Probability Appearance', 'Sealed Blood Wind Axe, Sealed Typhoon Axe, Spellbook (Majesty)'),
(18, 6, 'Giran Prison', 2, 'Tektus', '/img/guide/boss_tab07_02.png', 'Giran Prison 2nd Floor', 'Probability Appearance', 'Ancient Demon\'s Gauntlets, Ancient Demon\'s Boots, Ancient Demon\'s Gloves, Ancient Demon\'s Cape'),
(19, 6, 'Giran Prison', 3, 'Jailer Taros', '/img/guide/boss_tab07_03.png', 'Giran Prison 2nd Floor', 'Daily 21:00 Probability Appearance', 'Skillbook (Counter Barrier), Memory Crystal (Mobius), Skillbook (Blow Attack)'),
(20, 7, 'Dragon Valley', 1, 'Dragon Guardian', '/img/guide/boss_tab08_01.png', 'Dragon Valley Dungeon 3rd, 4th Floor', 'Probability Appearance', 'Strength Boots (Con), Magic Defense Gauntlets'),
(21, 7, 'Dragon Valley', 2, 'Arcmo', '/img/guide/boss_tab08_02.png', 'Dragon Valley Dungeon 7th Floor', 'Probability Appearance', 'Spellbook (Empire), Spellbook (Disintegrate), Devil\'s Ring, Duke de Phil\'s Sword, Duke de Phil\'s Sword (Revival)'),
(22, 7, 'Dragon Valley', 3, 'Drake', '/img/guide/boss_tab08_03.png', 'Dragon Valley Field', 'Probability Appearance', 'Warrior\'s Seal (Titan: Blitz), Spellbook (Disintegrate) (Revival), Skillbook (Counter Barrier) (Revival), Warrior\'s Seal (Desperado) (Revival), Black Spirit Crystal (Armor Break)'),
(23, 7, 'Dragon Valley', 4, 'Great Warlock', '/img/guide/boss_tab08_04.png', 'Dragon Valley Field', 'Probability Appearance', 'Spellbook (Death Heal), Maple Ring (Revival), Warlock\'s Robe, Warlock\'s Sandals'),
(24, 7, 'Dragon Valley', 5, 'Zeros', '/img/guide/boss_tab08_05.png', 'Dragon Valley Field', 'Probability Appearance', 'Spellbook (Death Heal), Spellbook (Shape Change), Philosopher\'s Necklace, Zeros\'s Staff (Revival), Laya\'s Ring (Revival)'),
(25, 8, 'Fire Dragon\'s Nest', 1, 'Ifrit', '/img/guide/boss_tab09_01.png', 'Fire Dragon\'s Nest', 'Probability Appearance', 'Warrior\'s Seal (Titan: Lock), Warrior\'s Seal (Titan: Rising), Spirit Crystal (Soul of Frame)'),
(26, 8, 'Fire Dragon\'s Nest', 2, 'Phoenix', '/img/guide/boss_tab09_02.png', 'Fire Dragon\'s Nest', 'Probability Appearance', 'Spirit Crystal (Soul Barrier), Spirit Crystal (Hurricane), Black Spirit Crystal (Armor Break), Spellbook (Meteor Strike), Shining Sahha Necklace'),
(27, 9, 'Arrogant Tower', 1, 'Distorted Jenis Queen (Duplicate)', '/img/guide/boss_tab10_01.png', 'Arrogant Tower 1st Floor', 'Daily 11:00 / 23:00 Probability Appearance', 'Sealed Arrogant Tower 1st Floor Movement Charm, Jenis\'s Ring (Revival)'),
(28, 9, 'Arrogant Tower', 2, 'Unfaithful Sire (Duplicate)', '/img/guide/boss_tab10_02.png', 'Arrogant Tower 2nd Floor', 'Daily 11:00 / 23:00 Probability Appearance', 'Sealed Arrogant Tower 2nd Floor Movement Charm, Sire\'s Insight (Revival)'),
(29, 9, 'Arrogant Tower', 3, 'Dreadful Vampire (Duplicate)', '/img/guide/boss_tab10_03.png', 'Arrogant Tower 3rd Floor', 'Daily 11:00 / 23:00 Probability Appearance', 'Sealed Arrogant Tower 3rd Floor Movement Charm, Vampire\'s Cloak (Revival)'),
(30, 9, 'Arrogant Tower', 4, 'Death Zombie Lord (Duplicate)', '/img/guide/boss_tab10_04.png', 'Arrogant Tower 4th Floor', 'Daily 11:00 / 23:00 Probability Appearance', 'Sealed Arrogant Tower 4th Floor Movement Charm'),
(31, 9, 'Arrogant Tower', 5, 'Kugo of Hell (Duplicate)', '/img/guide/boss_tab10_05.png', 'Arrogant Tower 5th Floor', 'Daily 11:00 / 23:00 Probability Appearance', 'Sealed Arrogant Tower 5th Floor Movement Charm'),
(32, 9, 'Arrogant Tower', 6, 'Undying Mamirod (Duplicate)', '/img/guide/boss_tab10_06.png', 'Arrogant Tower 6th Floor', 'Daily 11:00 / 23:00 Probability Appearance', 'Sealed Arrogant Tower 6th Floor Movement Charm, Mamirod\'s Crown (Revival)'),
(33, 9, 'Arrogant Tower', 7, 'Cruel Iris (Duplicate)', '/img/guide/boss_tab10_07.png', 'Arrogant Tower 7th Floor', 'Daily 11:00 / 23:00 Probability Appearance', 'Sealed Arrogant Tower 7th Floor Movement Charm, Iris\'s Necklace'),
(34, 9, 'Arrogant Tower', 8, 'Dark Night Bald (Duplicate)', '/img/guide/boss_tab10_08.png', 'Arrogant Tower 8th Floor', 'Daily 11:00 / 23:00 Probability Appearance', 'Sealed Arrogant Tower 8th Floor Movement Charm, Skillbook (Counter Barrier), Nightbald\'s Two-Handed Sword (Revival)'),
(35, 9, 'Arrogant Tower', 9, 'Immortal Lich (Duplicate)', '/img/guide/boss_tab10_09.png', 'Arrogant Tower 9th Floor', 'Daily 11:00 / 23:00 Probability Appearance', 'Sealed Arrogant Tower 9th Floor Movement Charm, Lich Robe (Revival)'),
(36, 9, 'Arrogant Tower', 10, 'Arrogant Ugnus (Duplicate)', '/img/guide/boss_tab10_10.png', 'Arrogant Tower 10th Floor', 'Daily 11:00 / 23:00 Probability Appearance', 'Sealed Arrogant Tower 10th Floor Movement Charm'),
(37, 9, 'Arrogant Tower', 11, 'Watcher of the Reaper', '/img/guide/boss_tab11_12.png', 'Arrogant Tower Summit', 'Probability Appearance (Every 2 hours)', 'Sealed Arrogant Tower 1-10th Floor Charm'),
(38, 9, 'Arrogant Tower', 12, 'Reaper Grim Reaver', '/img/guide/boss_tab11_13.png', 'Arrogant Tower Summit', 'Probability Appearance (Every 12 hours)', 'Warrior\'s Seal (Desperado), Skillbook (Counter Barrier), Spellbook (Disintegrate), Sealed Arrogant Tower 1-10th Floor Charm, Einhasad\'s Flash, Gran Kain\'s Judgment, Reaper\'s Sword'),
(39, 10, 'Tower of Domination', 1, 'Distorted Jenis Queen', '/img/guide/boss_tab11_01.png', 'Tower of Domination 1st Floor', 'Weekdays 19:00 ~ 19:30 / Saturday 14:30 ~ 15:00 / Sunday 19:00 ~ 19:30 Probability Appearance', 'Jenis\'s Ring'),
(40, 10, 'Tower of Domination', 2, 'Unfaithful Sire', '/img/guide/boss_tab11_02.png', 'Tower of Domination 2nd Floor', 'Weekdays 19:00 ~ 19:30 / Saturday 14:30 ~ 15:00 / Sunday 19:00 ~ 19:30 Probability Appearance', 'Sire\'s Insight'),
(41, 10, 'Tower of Domination', 3, 'Dreadful Vampire', '/img/guide/boss_tab11_03.png', 'Tower of Domination 3rd Floor', 'Weekdays 19:00 ~ 19:30 / Saturday 14:30 ~ 15:00 / Sunday 19:00 ~ 19:30<br> Probability Appearance', 'Vampire\'s Gauntlets, Vampire\'s Cloak'),
(42, 10, 'Tower of Domination', 4, 'Death Zombie Lord', '/img/guide/boss_tab11_04.png', 'Tower of Domination 4th Floor', 'Weekdays 19:00 ~ 19:30 / Saturday 14:30 ~ 15:00 / Sunday 19:00 ~ 19:30<br> Probability Appearance', 'Black Spirit Crystal (Armor Break: Destiny), Gloves of Wrath, Bandages Soaked in Blood'),
(43, 10, 'Tower of Domination', 5, 'Kugo of Hell', '/img/guide/boss_tab11_05.png', 'Tower of Domination 5th Floor', 'Weekdays 19:00 ~ 19:30 / Saturday 14:30 ~ 15:00 / Sunday 19:00 ~ 19:30<br> Probability Appearance', 'Black Spirit Crystal (Armor Break), Kugo\'s Gather'),
(44, 10, 'Tower of Domination', 6, 'Undying Mamirod', '/img/guide/boss_tab11_06.png', 'Tower of Domination 6th Floor', 'Weekdays 22:00 ~ 22:30 / Saturday 15:30 ~ 16:00 / Sunday 22:00 ~ 22:30<br> Probability Appearance', 'Mamirod\'s Gloves, Mamirod\'s Crown'),
(45, 10, 'Tower of Domination', 7, 'Cruel Iris', '/img/guide/boss_tab11_07.png', 'Tower of Domination 7th Floor', 'Weekdays 22:00 ~ 22:30 / Saturday 15:30 ~ 16:00 / Sunday 22:00 ~ 22:30<br> Probability Appearance', 'Iris\'s Boots, Iris\'s Gauntlets, Iris\'s Necklace'),
(46, 10, 'Tower of Domination', 8, 'Dark Nightbald', '/img/guide/boss_tab11_08.png', 'Tower of Domination 8th Floor', 'Weekdays 22:00 ~ 22:30 / Saturday 15:30 ~ 16:00 / Sunday 22:00 ~ 22:30<br> Probability Appearance', 'Skillbook (Counter Barrier Veteran), Skillbook (Counter Barrier), Nightbald\'s Gauntlets, Nightbald\'s Two-Handed Sword'),
(47, 10, 'Tower of Domination', 9, 'Immortal Lich', '/img/guide/boss_tab11_09.png', 'Tower of Domination 9th Floor', 'Weekdays 22:00 ~ 22:30 / Saturday 15:30 ~ 16:00 / Sunday 22:00 ~ 22:30<br> Probability Appearance', 'Spellbook (Meteor Strike), Lich\'s Ring, Lich Robe'),
(48, 10, 'Tower of Domination', 10, 'Arrogant Ugnus', '/img/guide/boss_tab11_10.png', 'Tower of Domination 10th Floor', 'Weekdays 22:00 ~ 22:30 / Saturday 15:30 ~ 16:00 / Sunday 22:00 ~ 22:30<br> Probability Appearance', 'Spellbook (Disintegrate), Ugnus\'s Gather, Ugnus\'s Broken Spear'),
(49, 10, 'Tower of Domination', 11, 'Reaper Grim Reaver', '/img/guide/boss_tab11_11.png', 'Tower of Domination Summit', 'Daily 22:00 ~ 23:00 Probability Appearance', 'Hypereon\'s Despair, Chronos\'s Terror, Titan\'s Fury, Gaia\'s Wrath, Maple Ring, Reaper\'s Ring, Reaper\'s Sword'),
(50, 11, 'Desert', 1, 'Sand Worm', '/img/guide/boss_tab12_01.png', 'Desert', 'Every Friday/Saturday 21:00 Fixed Appearance', 'Black Spirit Crystal (Armor Break), Instant Teleportation Control Ring'),
(51, 11, 'Desert', 2, 'Ersabe', '/img/guide/boss_tab12_02.png', 'Desert', 'Every Friday/Saturday 21:00 Fixed Appearance', 'Golden Wings of the Giant Queen Ant, Silver Wings of the Giant Queen Ant, Instant Teleportation Control Ring'),
(52, 12, 'Other Field Bosses', 1, 'Lord of Darkness', '/img/guide/boss_tab13_01.png', 'Scar of the Dark Dragon', 'Probability Appearance', 'Spellbook (Absolute Barrier)'),
(53, 12, 'Other Field Bosses', 2, 'Nekros', '/img/guide/boss_tab13_02.png', 'Orc Barracks', 'Probability Appearance', 'Necklace of the Warrior, Ancient Warrior\'s Gather'),
(54, 12, 'Other Field Bosses', 3, 'Orcus', '/img/guide/boss_tab13_03.png', 'Orc Barracks', 'Probability Appearance', 'Necklace of the Warrior, Ancient Warrior\'s Gather'),
(55, 12, 'Other Field Bosses', 4, 'Lycanth', '/img/guide/boss_tab13_04.png', 'Aden Field', 'Probability Appearance', 'Silent Sword'),
(56, 12, 'Other Field Bosses', 5, 'Black Knight Captain', '/img/guide/boss_tab13_05.png', 'Grave of the Dead, Kent Field', 'Probability Appearance', 'Renegade\'s Shield, Skillbook (Blow Attack)'),
(57, 12, 'Other Field Bosses', 6, 'Doppelganger Boss', '/img/guide/boss_tab13_06.png', 'Mirror Forest', 'Probability Appearance', 'Spellbook (Shape Change), Doppelganger Boss\'s Necklace, Doppelganger Boss\'s Right Ring, Doppelganger Boss\'s Left Ring');
