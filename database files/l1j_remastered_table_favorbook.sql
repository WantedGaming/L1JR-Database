
-- --------------------------------------------------------

--
-- Table structure for table `favorbook`
--

CREATE TABLE `favorbook` (
  `listId` int(2) NOT NULL DEFAULT 0,
  `category` int(3) NOT NULL DEFAULT 0,
  `slotId` int(1) NOT NULL,
  `itemIds` text DEFAULT NULL,
  `note` varchar(100) DEFAULT '',
  `desc_kr` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `favorbook`
--

INSERT INTO `favorbook` (`listId`, `category`, `slotId`, `itemIds`, `note`, `desc_kr`) VALUES
(1, 1, 1, '2300105\r\n2300106\r\n2300107\r\n2300108\r\n2300109\r\n2300110\r\n2300111\r\n2300112\r\n2300113\r\n2300114\r\n2300115\r\n2300116\r\n2300117\r\n2300118\r\n2300119\r\n2300120', 'Blessing of Growth', '성장의 가호'),
(1, 1, 2, '2300250\r\n2300251\r\n2300252\r\n2300253\r\n2300254\r\n2300255\r\n2300256\r\n2300257\r\n2300258\r\n2300259\r\n2300260\r\n2300261\r\n2300262\r\n2300263\r\n2300264\r\n2300265\r\n2300266\r\n2300267\r\n2300268\r\n2300269\r\n2300270', 'Blessing of Battlefield', '전장의 가호'),
(1, 1, 3, '2300300\r\n2300301\r\n2300302\r\n2300303\r\n2300304\r\n2300305\r\n2300306\r\n2300307\r\n2300308\r\n2300309\r\n2300310\r\n2300311\r\n2300312\r\n2300313\r\n2300314\r\n2300315\r\n2300316\r\n2300317\r\n2300318\r\n2300319\r\n2300320\r\n2300321\r\n2300322\r\n2300323\r\n2300324\r\n2300325\r\n2300326\r\n2300327\r\n2300328\r\n2300329\r\n2300330\r\n2300331\r\n2300332\r\n2300333\r\n2300334\r\n2300335\r\n2300336\r\n2300337\r\n2300338\r\n2300339\r\n2300340\r\n2300341\r\n2300342\r\n2300343\r\n2300344\r\n2300345\r\n2300346\r\n2300347\r\n2300348\r\n2300349\r\n2300350\r\n2300351\r\n2300352\r\n2300353\r\n2300354', 'Blessing of Valor', '용맹의 가호'),
(1, 1, 4, '31637\r\n31638\r\n31639\r\n31640\r\n31641\r\n31642\r\n31643\r\n31644\r\n31645\r\n31646\r\n31647\r\n31648\r\n31649\r\n31650\r\n31651\r\n31652\r\n31653\r\n31654', 'Blessing of Protection', '수호의 가호'),
(1, 2, 1, '30912\r\n30913\r\n30914\r\n30915\r\n30916\r\n30917\r\n30918\r\n30919\r\n30920\r\n30921\r\n30922\r\n30923', 'Blessing of Arrogance', '오만의 가호'),
(1, 2, 2, '2300200\r\n2300201\r\n2300202\r\n2300203\r\n2300204\r\n2300205\r\n2300206\r\n2300207\r\n2300208\r\n2300209', 'Blessing of Stamina', '체력의 가호'),
(2, 3, 1, '31757\r\n31758\r\n31759\r\n31760', '[Rare Loot]', '[진귀한 전리품]');
