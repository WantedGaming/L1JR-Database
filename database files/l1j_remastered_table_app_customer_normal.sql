
-- --------------------------------------------------------

--
-- Table structure for table `app_customer_normal`
--

CREATE TABLE `app_customer_normal` (
  `id` int(10) NOT NULL DEFAULT 0,
  `title` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `app_customer_normal`
--

INSERT INTO `app_customer_normal` (`id`, `title`, `content`) VALUES
(1, 'How many clients can be used with one IP?', 'VPN, overseas IP restriction\nUp to 2 clients per IP.\n※ Users with overseas IPs should inquire through Telegram.'),
(2, 'How to report a malicious user?', 'You can report a character through the in-game \"/report\" (report) command\nor by reporting to the App Center customer center.'),
(3, 'When is the ranking updated?', 'Updated every 6 hours.\n(6 AM / 12 PM / 6 PM / 12 AM)'),
(4, 'Items disappeared after acquisition.', 'Items acquired through normal paths never disappear.'),
(5, 'Is account hacking recovery possible?', 'The administration does not conduct recovery under any circumstances.\nIDs and passwords are different from other servers;\ncreate them to be known only to yourself.'),
(6, 'How does the server rate work?', 'It is a self-designed balanced rate.'),
(7, 'Are there specific features?', 'This server is oriented towards live play.\nSpecialized items and systems are excluded;\nonly minimal convenience has been added.'),
(8, 'How does sponsorship work?', 'Refer to the sponsorship information page.'),
(9, 'Encountering crafting list and NPC action errors.', 'Errors occur if the client is not normal (due to other server patches or updates).\nThis server applies all the latest live server updates.\nSo, make sure to receive all the latest updates;\nif errors persist, reinstall the client.'),
(10, 'How to promote, and are there rewards?', 'There is no limit to the amount of promotion.\nYou can receive rewards once a day for posting on Lineage promotion sites or doing a minimum 1-hour YouTube broadcast.\nAfter completion, provide the link via Telegram or the customer center.\n\nRewards: Einhasad points 5,000 or 100 million Adena or 100 Pixie Coins\n※ Rewards are subject to change.'),
(11, 'Is real money trading possible?', 'Use the App Center Exchange for trading;\npersonal information is shared only between traders.\nIf below-market trades are detected, they may be seized.\nNo responsibility is taken for trade issues.'),
(12, 'Is there group support?', 'Support is provided for 10 individuals with different IPs.\n※ Support items: Blood Alliance contribution 10 million, Starter Package'),
(13, 'What is the scope of sanctions?', 'Server and administrator defamation results in a first ban.\nFirst ban for illegal program use.\nFirst warning for bug and error abuse, second ban.\nFor some malicious users, a hardware ban may be imposed.\nSanctions are permanent and not lifted.\nMoreover, there is no intervention for insults and sexual harassment on the free server.'),
(14, '\'libcocos2d.dll\' error occurrence.', 'Error message: Cannot find \'libcocos2d.dll\'. Please, re-install this application.\nYou can resolve it by installing the Visual C++ redistributable package for Visual Studio 2012 Update 4.\nRefer to the download page for details.'),
(15, 'Connection kit download issue.', 'If the download link is blocked or traffic-limited,\ncontact customer center. If the download is deleted after a successful download,\nturn off Windows Defender. Refer to the download page for assistance.'),
(16, 'How long is the server operational?', 'The basic operation is for 30 days and may be adjusted based on user count.\n※ There is no reset with user maintenance.');
