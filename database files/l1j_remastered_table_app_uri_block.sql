
-- --------------------------------------------------------

--
-- Table structure for table `app_uri_block`
--

CREATE TABLE `app_uri_block` (
  `uri` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=euckr COLLATE=euckr_korean_ci;

--
-- Dumping data for table `app_uri_block`
--

INSERT INTO `app_uri_block` (`uri`) VALUES
('/admin'),
('/bad-request'),
('/cgi-bin'),
('/db'),
('/dbadmin'),
('/jaws'),
('/mysql'),
('/pma'),
('/pmamy'),
('/shell'),
('/sitemap.xml'),
('/tmp'),
('/xampp');
