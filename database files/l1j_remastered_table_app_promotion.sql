
-- --------------------------------------------------------

--
-- Table structure for table `app_promotion`
--

CREATE TABLE `app_promotion` (
  `id` int(2) NOT NULL DEFAULT 0,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `subText` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `promotionDate` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `targetLink` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `promotionImg` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `listallImg` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `app_promotion`
--

INSERT INTO `app_promotion` (`id`, `title`, `subText`, `promotionDate`, `targetLink`, `promotionImg`, `listallImg`) VALUES
(1, 'Mythic Weapons', 'Beyond legend to myth', '', 'Mythic%20Weapons', '/upload/2021/09/16/PROMO_1_038035ec-f54d-43e9-ba76-cd2b8be6317510_2.jpg', '/upload/2021/09/16/PROMO_1_89eafc50-3473-4a89-b049-06cec7abec0f10_50.jpg'),
(2, 'Level 100 Era', 'Finally, level 100 in Lineage World', '', 'Level%20100', '/upload/2021/09/16/PROMO_2_714e6564-27c8-47ba-bb8e-e63e95b1faf49_2.jpg', '/upload/2021/09/16/PROMO_2_2db0a205-d3ec-4f36-8a0f-10bc2e5bbd209_50.jpg'),
(3, 'Lancer', 'The 10th class', '', 'Lancer', '/upload/2021/09/16/PROMO_3_ee0ea10b-8507-416f-893f-9a82edebb7702_2.jpg', '/upload/2021/09/16/PROMO_3_fcc56497-95d5-4ef3-8c24-aaaaeab74c0e2_50.jpg'),
(4, 'Aden\'s Turmoil', 'Knight and Elf reboot', '', 'Knight%2C%20Elf%20Reboot', '/upload/2021/09/16/PROMO_4_f4cfe679-9ea7-4d20-bd7b-d79977b1778d6_2.jpg', '/upload/2021/09/16/PROMO_4_c52f1267-59e9-438c-a227-6f114f1660406_50.jpg'),
(5, 'Land of the Outcast (Inter)', 'Special hunting ground with players from other servers!', '', 'Land%20of%20the%20Outcast%20(Inter)', '/upload/2021/09/16/PROMO_5_2c0b8634-9c46-475a-959f-44328b0852c07_2.jpg', '/upload/2021/09/16/PROMO_5_c010fa05-4a88-4b20-9551-e70516795bd17_50.jpg'),
(6, 'Warrior\'s Return', 'The beginning of a change that will make your heart race!', '', 'Warrior', '/upload/2021/09/16/PROMO_6_5e59ec2a-ec83-4c17-ba95-6acc867c02755435.jpg', '/upload/2021/09/16/PROMO_6_0a8c6d70-d761-434f-b645-1c4067aa4fea3213210_plaync_50x50.jpg'),
(7, 'Mirror War', 'Challenge the legends invading the Giran Prison!', '', 'Mirror%20War', '/upload/2021/09/16/PROMO_7_0381c880-11e3-48a8-b33b-03d0e9c8d6fa11_2.jpg', '/upload/2021/09/16/PROMO_7_2fb3fb11-9ad8-4554-bbd7-5adbb90291a011_50.jpg'),
(8, 'Windawood Battle', 'A fierce battle is approaching in the new occupation battle!', '', 'Battle+of+Windawood', '/upload/2021/09/27/PROMO_8_cbf3bba2-86cf-4fdf-8880-26a77b927bebgdsdf.jpg', '/upload/2021/09/27/PROMO_8_54c4c884-0ca2-457c-b0f4-4959c6d2fa43adas.jpg'),
(9, 'Forgotten Island', 'Once again, the ancient legend is resurrecting!', '', 'Forgotten%20Island', '/upload/2022/01/28/PROMO_9_6d9fa3a6-a693-4579-91a8-06fb19e37a46BSZFDSA.jpg', '/upload/2022/01/28/PROMO_9_ff57af48-384a-464e-a751-706dfadb4ec8FsfdS.jpg'),
(10, 'Class Rebalancing', 'Alleviate the gap between classes, ensure diversity in combat!', '', '23rd+Anniversary+Class+Rebalancing', '/upload/2022/01/28/PROMO_10_48afae39-173a-44b2-a895-b89f3f226b4fgsafgdsa0_리니지_pc_1920x510.jpg', '/upload/2022/01/28/PROMO_10_7db4031c-17b0-462e-be86-d54c66d1316b002.jpg'),
(11, 'Ant Queen\'s Call', 'World Class Dungeon', '', 'Ant%20Queen%27s%20Nest', '/upload/2022/02/24/PROMO_11_ec8373ee-c82e-460f-a275-283213a39bce0fafgasd_1920x510.jpg', '/upload/2022/02/24/PROMO_11_57a22563-3cab-4965-b8e5-b357fa7e9ed60hgraz_plaync_50x50.jpg'),
(12, 'Call of the Battlefield', 'Victory in the fierce unfolding battle!', '', 'Heine%20Guard%20Tower%20Conquest%20Battle', '/upload/2022/02/24/PROMO_12_c764fc7c-4cae-41da-b7c4-8bbfc963c83ahssdf_1920x510.jpg', '/upload/2022/02/24/PROMO_12_a0a1031b-04f9-4c96-9fb3-9a279e029280hdgss_plaync_50x50.jpg');
