
-- --------------------------------------------------------

--
-- Table structure for table `log_warehouse`
--

CREATE TABLE `log_warehouse` (
  `id` int(10) NOT NULL,
  `datetime` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `type` varchar(45) NOT NULL,
  `account` varchar(45) DEFAULT NULL,
  `char_id` int(10) DEFAULT NULL,
  `char_name` varchar(45) DEFAULT NULL,
  `item_id` varchar(45) DEFAULT NULL,
  `item_name` varchar(45) DEFAULT NULL,
  `item_enchantlvl` varchar(45) DEFAULT NULL,
  `item_count` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `log_warehouse`
--

INSERT INTO `log_warehouse` (`id`, `datetime`, `type`, `account`, `char_id`, `char_name`, `item_id`, `item_name`, `item_enchantlvl`, `item_count`) VALUES
(1, '2024-10-16 17:17:22', 'Personal Deposit', 'test1111@test.com', 331885929, 'Ilusionillo', '336226324', NULL, '0', 1),
(2, '2024-10-16 17:18:02', 'Personal Withdraw', 'test1111@test.com', 299879861, 'Principe', '336226324', NULL, '0', 1),
(3, '2024-10-16 17:18:48', 'Personal Deposit', 'test1111@test.com', 299879861, 'Principe', '336226324', NULL, '0', 1),
(4, '2024-10-16 17:20:59', 'Personal Deposit', 'test1111@test.com', 299879861, 'Principe', '332154390', NULL, '0', 1),
(5, '2024-10-16 17:41:30', 'Personal Withdraw', 'test1111@test.com', 299879861, 'Principe', '332154390', NULL, '0', 1),
(6, '2024-10-16 17:44:42', 'Personal Deposit', 'test1111@test.com', 299879861, 'Principe', '332154390', NULL, '0', 1),
(7, '2024-10-16 20:20:56', 'Personal Withdraw', 'test1111@test.com', 299879861, 'Principe', '332154390', NULL, '0', 1),
(8, '2024-12-05 13:05:56', 'Personal Deposit', 'test1111@test.com', 299879861, 'Principe', '332154390', NULL, '0', 1),
(9, '2024-12-05 13:06:35', 'Personal Withdraw', 'test1111@test.com', 299879861, 'Principe', '332154390', NULL, '0', 1);
