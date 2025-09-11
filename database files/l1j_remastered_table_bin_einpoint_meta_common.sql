
-- --------------------------------------------------------

--
-- Table structure for table `bin_einpoint_meta_common`
--

CREATE TABLE `bin_einpoint_meta_common` (
  `index_id` int(3) NOT NULL DEFAULT 0,
  `stat_type` enum('BLESS(0)','LUCKY(1)','VITAL(2)','ITEM_SPELL_PROB(3)','ABSOLUTE_REGEN(4)','POTION(5)','ATTACK_SPELL(6)','PVP_REDUCTION(7)','PVE_REDUCTION(8)','_MAX_(9)') NOT NULL DEFAULT '_MAX_(9)',
  `AbilityMetaData1_token` varchar(100) DEFAULT NULL,
  `AbilityMetaData1_x100` enum('true','false') NOT NULL DEFAULT 'false',
  `AbilityMetaData1_unit` enum('None(1)','Percent(2)') NOT NULL DEFAULT 'None(1)',
  `AbilityMetaData2_token` varchar(100) DEFAULT NULL,
  `AbilityMetaData2_x100` enum('true','false') NOT NULL DEFAULT 'false',
  `AbilityMetaData2_unit` enum('None(1)','Percent(2)') NOT NULL DEFAULT 'None(1)'
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `bin_einpoint_meta_common`
--

INSERT INTO `bin_einpoint_meta_common` (`index_id`, `stat_type`, `AbilityMetaData1_token`, `AbilityMetaData1_x100`, `AbilityMetaData1_unit`, `AbilityMetaData2_token`, `AbilityMetaData2_x100`, `AbilityMetaData2_unit`) VALUES
(0, 'BLESS(0)', 'restExpReduceEfficiency', 'false', 'Percent(2)', 'expBonus', 'false', 'Percent(2)'),
(1, 'LUCKY(1)', 'acquisitionProbItemBonus', 'false', 'Percent(2)', 'acquisitionProbAdenaBonus', 'false', 'Percent(2)'),
(2, 'VITAL(2)', 'phBoost', 'false', 'Percent(2)', 'healBoost', 'false', 'Percent(2)'),
(3, 'ITEM_SPELL_PROB(3)', 'incArmorSpellProbX100', 'true', 'Percent(2)', 'incWeaponSpellProbX100', 'true', 'Percent(2)'),
(4, 'ABSOLUTE_REGEN(4)', 'absoluteHpMod32s', 'false', 'None(1)', 'absoluteMpMod64s', 'false', 'None(1)'),
(5, 'POTION(5)', 'hpPotionCriticalX100', 'true', 'Percent(2)', 'hpPotionUseDelay', 'false', 'None(1)');
