
-- --------------------------------------------------------

--
-- Table structure for table `server_explain`
--

CREATE TABLE `server_explain` (
  `num` int(10) NOT NULL,
  `subject` varchar(45) DEFAULT '',
  `content` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `server_explain`
--

INSERT INTO `server_explain` (`num`, `subject`, `content`) VALUES
(1, '[[====== User Commands ======]]', '　.telreset .텔렉　　　　　　　　　　\r\n　.locreset .좌표복구　　　　　　　　　　\r\n　.light .라이트　　　　　　　　　　\r\n　.pledgemark .혈마크　　　　　　　　　　\r\n　.bloodparty .혈맹파티　　　　　　　　　　\r\n　.pledgeautojoin .무인가입　　　　　　　　　　\r\n　.phone .고정신청　　　　　　　　　　\r\n　.changepassword .암호변경　　　　　　　　　　\r\n　.security .보안설정　　　　　　　　　　\r\n　.validatesecurity .보안해제　　　　　　　　　　\r\n　.changename .이름변경　　　　　　　　　　\r\n　.shop .무인상점　　　　　　　　　　\r\n　.chat .드랍멘트　　　　　　　　　　\r\n　.enchant .인챈트연출　　　　　　　　　　\r\n　.grankain .그랑카인　　　　　　　　　　\r\n　.sponsorinfo .후원안내　　　　　　　　　　　　　　　　　\r\n==============================\r\n'),
(2, '[[====== User Commands ======]]', '　.telreset .텔렉　　　　　　　　　　\r\n　.locreset .좌표복구　　　　　　　　　　\r\n　.light .라이트　　　　　　　　　　\r\n　.pledgemark .혈마크　　　　　　　　　　\r\n　.bloodparty .혈맹파티　\r\n　.phone .고정신청　　　　　　　　　　\r\n　.changepassword .암호변경　　　　　　　　　　\r\n　.security .보안설정　　　　　　　　　　\r\n　.validatesecurity .보안해제　　　　　　　　　　\r\n　.changename .이름변경　　　　　　　　　　\r\n　.shop .무인상점　　　　　　　　　　\r\n　.chat .드랍멘트　　　　　　　　　　\r\n　.enchant .인챈트연출　　　　　　　　　　\r\n　.grankain .그랑카인　　　　　　　　　　\r\n　.sponsorinfo .후원안내　　　　\r\n=============================='),
(3, '[[====== User Commands ======]]', '　.telreset .텔렉　　　　　　　　　　\r\n　.locreset .좌표복구　　　　　　　　　　\r\n　.light .라이트　　　　　　　　　　\r\n　.pledgemark .혈마크　　　　　　　　　　\r\n　.bloodparty .혈맹파티　　　　　　　　　　\r\n　.pledgeautojoin .무인가입　　　　　　　　　　\r\n　.phone .고정신청　　　　　　　　　　\r\n　.changepassword .암호변경　　　　　　　　　　\r\n　.security .보안설정　　　　　　　　　　\r\n　.validatesecurity .보안해제　　　　　　　　　　\r\n　.changename .이름변경　　　　　　　　　　\r\n　.shop .무인상점　　　　　　　　　　\r\n　.chat .드랍멘트　　　　　　　　　　\r\n　.enchant .인챈트연출　　　　　　　　　　\r\n　.grankain .그랑카인　　　　　　　　　　\r\n=============================='),
(4, '[[====== User Commands ======]]', '　.telreset .텔렉　　　　　　　　　　\r\n　.locreset .좌표복구　　　　　　　　　　\r\n　.light .라이트　　　　　　　　　　\r\n　.pledgemark .혈마크　　　　　　　　　　\r\n　.bloodparty .혈맹파티　　　　　　　　　　\r\n　.phone .고정신청　　　　　　　　　　\r\n　.changepassword .암호변경　　　　　　　　　　\r\n　.security .보안설정　　　　　　　　　　\r\n　.validatesecurity .보안해제　　　　　　　　　　\r\n　.changename .이름변경　　　　　　　　　　\r\n　.shop .무인상점　　　　　　　　　　\r\n　.chat .드랍멘트　　　　　　　　　　\r\n　.enchant .인챈트연출　　　　　　　　　　\r\n　.grankain .그랑카인　　　　　　　　　　\r\n=============================='),
(6, '[[======Sponsorship Information======]]', '                          \r\n      \r\n10.000 NCoins for every 10 Dollars donated.  \r\n\r\nHow to use it: Official Lineage Warrior Store.   \r\n\r\nTo join: Write a letter to \"Metis\"     '),
(7, '[[======Test======]]', '<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n<npcdialog>\r\n<icon>craft</icon><title>Crafting</title>\r\n<npc><name><var src=\"name\"/></name><job>[Legendary Crafter]</job></npc>\r\n<dialog>\r\n<p><br/>Greetings!<br/>It\'s been a while since you\'ve returned to Aden. It\'s good to be back.<br/>I\'ve traveled to many places, but it seems this is still the best.<br/>By the way, I assume you didn\'t come here just to ask how I\'ve been?<br/>You have it, don\'t you? If so, you\'ve come to the right place. There\'s no one else in Aden who can handle that item but me!<br/><br/>But wait, where did you get it from?<br/><br/>Could it be... Has the Forgotten Island been reopened? A..gain.. reopened?<br/>I once visited that place in my youthful recklessness. It\'s truly a mysterious and terrifying place.<br/><br/>If you\'re going back there, be careful. That place is like a different world during day and night!<br/></p><panel type=\"Panel_Shop_Bt_Craft\"><button action=\"request craft\"/></panel>\r\n</dialog>\r\n</npcdialog>');
