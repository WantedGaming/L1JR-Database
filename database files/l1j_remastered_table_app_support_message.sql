
-- --------------------------------------------------------

--
-- Table structure for table `app_support_message`
--

CREATE TABLE `app_support_message` (
  `type` enum('AGREE','PROGRESS','REWARD') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'AGREE',
  `index_id` int(2) NOT NULL DEFAULT 1,
  `content` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `app_support_message`
--

INSERT INTO `app_support_message` (`type`, `index_id`, `content`) VALUES
('AGREE', 1, 'This is a system by which you can contribute to the development and maintenance of the server through donations.'),
('AGREE', 2, 'When a donation is made, a reward is received in return, which will be directly proportional to the amount donated.'),
('AGREE', 3, 'The sponsorhip system is completely optional and is not necessary to be able to play on our server.'),
('AGREE', 4, 'We have no legal responsibility for the sponsorhip system since donations are totally voluntary.'),
('AGREE', 5, 'Amounts donated cannot be refunded, so be sure before you do.'),
('AGREE', 6, 'If the server were to be reset (which is totally exceptional), the donations will also be reset.'),
('AGREE', 7, 'When making a donation, please use the name of the character who will receive the associated rewards.'),
('PROGRESS', 1, 'If you apply to participate in the Sponsorship program, information on how to proceed will be sent to your in-game character within a short period of time.'),
('PROGRESS', 2, 'After making a donation through your account, please indicate the amount donated at the bottom and click on send the message.'),
('PROGRESS', 3, 'Once the process is complete, one of our managers will confirm the deposit and deliver the associated reward.'),
('PROGRESS', 4, 'If the donation cannot be confirmed, the delivery of the reward may be delayed.'),
('REWARD', 1, '10 thousand N Coins for every $10 donated.'),
('REWARD', 2, '※ N Coins: Use them in App Center N Shop');
