
-- --------------------------------------------------------

--
-- Table structure for table `craft_block`
--

CREATE TABLE `craft_block` (
  `craft_id` int(5) NOT NULL DEFAULT 0,
  `craft_name` varchar(45) DEFAULT NULL,
  `desc_kr` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `craft_block`
--

INSERT INTO `craft_block` (`craft_id`, `craft_name`, `desc_kr`) VALUES
(3870, 'Advanced Immortal Protection', '고급 불멸의 가호'),
(3871, 'Immortal Protection', '불멸의 가호'),
(6355, 'Dragon T-Shirt Protection Scroll (1)', '용의 티셔츠 보호 주문서 1장'),
(6356, 'Dragon T-Shirt Protection Scroll (10)', '용의 티셔츠 보호 주문서 10장'),
(9036, 'Potion of Enhanced Growth', '향상된 성장의 물약');
