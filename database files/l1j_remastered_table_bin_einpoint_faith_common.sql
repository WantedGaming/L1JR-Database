
-- --------------------------------------------------------

--
-- Table structure for table `bin_einpoint_faith_common`
--

CREATE TABLE `bin_einpoint_faith_common` (
  `GroupId` int(3) NOT NULL DEFAULT 0,
  `spellId` int(10) NOT NULL DEFAULT 0,
  `Index_indexId` int(3) NOT NULL DEFAULT 0,
  `Index_spellId` int(10) NOT NULL DEFAULT 0,
  `Index_cost` int(10) NOT NULL DEFAULT 0,
  `Index_duration` int(10) NOT NULL DEFAULT 0,
  `Index_additional_desc` int(6) NOT NULL DEFAULT 0,
  `Index_additional_desc_kr` varchar(100) DEFAULT NULL,
  `additional_desc` int(6) NOT NULL DEFAULT 0,
  `additional_desc_kr` varchar(100) DEFAULT NULL,
  `BuffInfo_tooltipStrId` int(6) NOT NULL DEFAULT 0,
  `BuffInfo_tooltipStrId_kr` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `bin_einpoint_faith_common`
--

INSERT INTO `bin_einpoint_faith_common` (`GroupId`, `spellId`, `Index_indexId`, `Index_spellId`, `Index_cost`, `Index_duration`, `Index_additional_desc`, `Index_additional_desc_kr`, `additional_desc`, `additional_desc_kr`, `BuffInfo_tooltipStrId`, `BuffInfo_tooltipStrId_kr`) VALUES
(1, 5513, 1, 5499, 100000, 1209600, 9309, '마법 적중: +1, 적중: 전체+1\\n', 9291, '공격 속도:\\n+1%', 9280, '아인하사드의 신의\\n\\n상세 내용 : Crtl + W'),
(1, 5513, 2, 5514, 80000, 1209600, 0, NULL, 9291, '공격 속도:\\n+1%', 9280, '아인하사드의 신의\\n\\n상세 내용 : Crtl + W'),
(1, 5513, 3, 5515, 30000, 1209600, 0, NULL, 9291, '공격 속도:\\n+1%', 9280, '아인하사드의 신의\\n\\n상세 내용 : Crtl + W'),
(1, 5513, 4, 5516, 50000, 1209600, 0, NULL, 9291, '공격 속도:\\n+1%', 9280, '아인하사드의 신의\\n\\n상세 내용 : Crtl + W'),
(2, 5525, 5, 5526, 100000, 1209600, 9293, 'ME: +1, 내성: 전체+1\\n', 9292, '이동 속도:\\n+1%', 9280, '아인하사드의 신의\\n\\n상세 내용 : Crtl + W'),
(2, 5525, 6, 5527, 80000, 1209600, 0, NULL, 9292, '이동 속도:\\n+1%', 9280, '아인하사드의 신의\\n\\n상세 내용 : Crtl + W'),
(2, 5525, 7, 5528, 30000, 1209600, 0, NULL, 9292, '이동 속도:\\n+1%', 9280, '아인하사드의 신의\\n\\n상세 내용 : Crtl + W'),
(2, 5525, 8, 5529, 50000, 1209600, 0, NULL, 9292, '이동 속도:\\n+1%', 9280, '아인하사드의 신의\\n\\n상세 내용 : Crtl + W');
