-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 16 Feb 2016 pada 12.03
-- Versi Server: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `toppon`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_toppon_m_banks`
--

CREATE TABLE IF NOT EXISTS `tbl_toppon_m_banks` (
`bankID` int(11) NOT NULL,
  `bankName` varchar(100) CHARACTER SET utf8 NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `createdBy` varchar(50) NOT NULL,
  `lastUpdated` datetime NOT NULL,
  `lastUpdatedBy` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_toppon_m_coins`
--

CREATE TABLE IF NOT EXISTS `tbl_toppon_m_coins` (
`coinID` int(11) NOT NULL,
  `coin` int(10) NOT NULL,
  `coinConversion` int(10) NOT NULL,
  `poin` int(10) NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `createdBy` varchar(50) NOT NULL,
  `lastUpdated` datetime NOT NULL,
  `lastUpdatedBy` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_toppon_m_gifts`
--

CREATE TABLE IF NOT EXISTS `tbl_toppon_m_gifts` (
`giftID` int(11) NOT NULL,
  `giftName` varchar(100) CHARACTER SET utf8 NOT NULL,
  `giftDescription` text NOT NULL,
  `poin` int(10) NOT NULL,
  `image` varchar(150) CHARACTER SET utf8 NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `createdBy` varchar(50) NOT NULL,
  `lastUpdated` datetime NOT NULL,
  `lastUpdatedBy` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_toppon_m_nominals`
--

CREATE TABLE IF NOT EXISTS `tbl_toppon_m_nominals` (
`nominalID` int(11) NOT NULL,
  `nominalName` varchar(100) CHARACTER SET utf8 NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `createdBy` varchar(50) NOT NULL,
  `lastUpdated` datetime NOT NULL,
  `lastUpdatedBy` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `tbl_toppon_m_nominals`
--

INSERT INTO `tbl_toppon_m_nominals` (`nominalID`, `nominalName`, `isActive`, `created`, `createdBy`, `lastUpdated`, `lastUpdatedBy`) VALUES
(1, '10.000', 1, '2016-02-16 00:00:00', 'admin', '2016-02-16 00:00:00', 'admin'),
(2, '25.000', 1, '2016-02-16 00:00:00', 'admin', '2016-02-16 00:00:00', 'admin'),
(3, '50.000', 1, '2016-02-16 00:00:00', 'admin', '2016-02-16 00:00:00', 'admin'),
(4, '100.000', 1, '2016-02-16 00:00:00', 'admin', '2016-02-16 00:00:00', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_toppon_m_payment_methods`
--

CREATE TABLE IF NOT EXISTS `tbl_toppon_m_payment_methods` (
`paymentMethodID` int(11) NOT NULL,
  `paymentMethodName` varchar(100) CHARACTER SET utf8 NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `createdBy` varchar(50) NOT NULL,
  `lastUpdated` datetime NOT NULL,
  `lastUpdatedBy` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_toppon_m_publishers`
--

CREATE TABLE IF NOT EXISTS `tbl_toppon_m_publishers` (
`publisherID` int(11) NOT NULL,
  `publisherName` varchar(100) CHARACTER SET utf8 NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `createdBy` varchar(50) NOT NULL,
  `lastUpdated` datetime NOT NULL,
  `lastUpdatedBy` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `tbl_toppon_m_publishers`
--

INSERT INTO `tbl_toppon_m_publishers` (`publisherID`, `publisherName`, `isActive`, `created`, `createdBy`, `lastUpdated`, `lastUpdatedBy`) VALUES
(1, 'Megaxus', 1, '2016-02-16 00:00:00', 'admin', '2016-02-16 00:00:00', 'admin'),
(2, 'LYTO', 1, '2016-02-16 00:00:00', 'admin', '2016-02-16 00:00:00', 'admin'),
(3, 'Steam', 1, '2016-02-16 00:00:00', 'admin', '2016-02-16 00:00:00', 'admin'),
(4, 'Gemscool', 1, '2016-02-16 00:00:00', 'admin', '2016-02-16 00:00:00', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_toppon_m_users`
--

CREATE TABLE IF NOT EXISTS `tbl_toppon_m_users` (
`userID` int(11) NOT NULL,
  `userName` varchar(50) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `phoneNumber` varchar(15) CHARACTER SET utf8 NOT NULL,
  `userLevel` enum('super_admin','member') NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `createdBy` varchar(50) NOT NULL,
  `lastUpdated` datetime NOT NULL,
  `lastUpdatedBy` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `tbl_toppon_m_users`
--

INSERT INTO `tbl_toppon_m_users` (`userID`, `userName`, `password`, `name`, `email`, `phoneNumber`, `userLevel`, `isActive`, `created`, `createdBy`, `lastUpdated`, `lastUpdatedBy`) VALUES
(1, 'admin', '$2y$10$qmApFOjasVHsxK7vllH.t.NA20Utc5RWvgwtMfRvynaqTwR9EVymu', 'admin A', 'vzheng92@gmail.com', '09788888888', 'member', 1, '2016-02-16 16:59:14', 'admin', '2016-02-16 16:59:14', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_toppon_s_accounts`
--

CREATE TABLE IF NOT EXISTS `tbl_toppon_s_accounts` (
`sAccountID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `poin` int(15) NOT NULL,
  `coin` int(10) NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `createdBy` varchar(50) NOT NULL,
  `lastUpdated` datetime NOT NULL,
  `lastUpdatedBy` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `tbl_toppon_s_accounts`
--

INSERT INTO `tbl_toppon_s_accounts` (`sAccountID`, `userID`, `poin`, `coin`, `isActive`, `created`, `createdBy`, `lastUpdated`, `lastUpdatedBy`) VALUES
(1, 1, 0, 0, 1, '2016-02-16 00:00:00', 'admin', '2016-02-16 00:00:00', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_toppon_s_games`
--

CREATE TABLE IF NOT EXISTS `tbl_toppon_s_games` (
`sGamesID` int(11) NOT NULL,
  `publisherID` int(11) NOT NULL,
  `nominalID` int(11) NOT NULL,
  `paymentValue` int(10) NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `createdBy` varchar(50) NOT NULL,
  `lastUpdated` datetime NOT NULL,
  `lastUpdatedBy` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data untuk tabel `tbl_toppon_s_games`
--

INSERT INTO `tbl_toppon_s_games` (`sGamesID`, `publisherID`, `nominalID`, `paymentValue`, `isActive`, `created`, `createdBy`, `lastUpdated`, `lastUpdatedBy`) VALUES
(1, 1, 1, 10, 1, '2016-02-23 00:00:00', 'admin', '2016-02-23 00:00:00', 'admin'),
(2, 1, 2, 25, 1, '2016-02-23 00:00:00', 'admin', '2016-02-23 00:00:00', 'admin'),
(3, 1, 3, 50, 1, '2016-02-23 00:00:00', 'admin', '2016-02-23 00:00:00', 'admin'),
(4, 1, 4, 100, 1, '2016-02-23 00:00:00', 'admin', '2016-02-23 00:00:00', 'admin'),
(5, 2, 1, 12, 1, '2016-02-23 00:00:00', 'admin', '2016-02-23 00:00:00', 'admin'),
(6, 2, 2, 27, 1, '2016-02-23 00:00:00', 'admin', '2016-02-23 00:00:00', 'admin'),
(7, 2, 3, 52, 1, '2016-02-23 00:00:00', 'admin', '2016-02-23 00:00:00', 'admin'),
(8, 2, 4, 102, 1, '2016-02-23 00:00:00', 'admin', '2016-02-23 00:00:00', 'admin'),
(9, 3, 1, 13, 1, '2016-02-23 00:00:00', 'admin', '2016-02-23 00:00:00', 'admin'),
(10, 3, 2, 28, 1, '2016-02-23 00:00:00', 'admin', '2016-02-23 00:00:00', 'admin'),
(11, 3, 3, 53, 1, '2016-02-23 00:00:00', 'admin', '2016-02-23 00:00:00', 'admin'),
(12, 3, 4, 103, 1, '2016-02-23 00:00:00', 'admin', '2016-02-23 00:00:00', 'admin'),
(13, 4, 1, 14, 1, '2016-02-23 00:00:00', 'admin', '2016-02-23 00:00:00', 'admin'),
(14, 4, 2, 29, 1, '2016-02-23 00:00:00', 'admin', '2016-02-23 00:00:00', 'admin'),
(15, 4, 3, 54, 1, '2016-02-23 00:00:00', 'admin', '2016-02-23 00:00:00', 'admin'),
(16, 4, 4, 104, 1, '2016-02-23 00:00:00', 'admin', '2016-02-23 00:00:00', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_toppon_t_deposits`
--

CREATE TABLE IF NOT EXISTS `tbl_toppon_t_deposits` (
`tDepositID` int(15) NOT NULL,
  `bankName` varchar(100) CHARACTER SET utf8 NOT NULL,
  `nameRekening` varchar(100) CHARACTER SET utf8 NOT NULL,
  `noRekening` varchar(100) CHARACTER SET utf8 NOT NULL,
  `coin` int(15) NOT NULL,
  `coinConversion` int(15) NOT NULL,
  `poin` int(10) NOT NULL,
  `kodeUnik` int(5) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `createdBy` varchar(50) NOT NULL,
  `lastUpdated` datetime NOT NULL,
  `lastUpdatedBy` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_toppon_t_game_purchases`
--

CREATE TABLE IF NOT EXISTS `tbl_toppon_t_game_purchases` (
`tGamePurchaseID` int(15) NOT NULL,
  `PublisherName` varchar(100) CHARACTER SET utf8 NOT NULL,
  `nominalName` varchar(100) CHARACTER SET utf8 NOT NULL,
  `paymentMethodName` varchar(100) CHARACTER SET utf8 NOT NULL,
  `paymentValue` int(15) NOT NULL,
  `coin` int(15) NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `createdBy` varchar(50) NOT NULL,
  `lastUpdated` datetime NOT NULL,
  `lastUpdatedBy` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_toppon_t_gifts`
--

CREATE TABLE IF NOT EXISTS `tbl_toppon_t_gifts` (
`tGiftID` int(15) NOT NULL,
  `giftID` int(11) NOT NULL,
  `giftName` varchar(100) CHARACTER SET utf8 NOT NULL,
  `poin` int(15) NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `createdBy` varchar(50) NOT NULL,
  `lastUpdated` datetime NOT NULL,
  `lastUpdatedBy` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_toppon_t_transfers`
--

CREATE TABLE IF NOT EXISTS `tbl_toppon_t_transfers` (
`tTransferID` int(15) NOT NULL,
  `coin` int(15) NOT NULL,
  `userPengirim` int(11) NOT NULL,
  `userPenerima` int(11) NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `createdBy` varchar(50) NOT NULL,
  `lastUpdated` datetime NOT NULL,
  `lastUpdatedBy` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_toppon_m_banks`
--
ALTER TABLE `tbl_toppon_m_banks`
 ADD PRIMARY KEY (`bankID`);

--
-- Indexes for table `tbl_toppon_m_coins`
--
ALTER TABLE `tbl_toppon_m_coins`
 ADD PRIMARY KEY (`coinID`);

--
-- Indexes for table `tbl_toppon_m_gifts`
--
ALTER TABLE `tbl_toppon_m_gifts`
 ADD PRIMARY KEY (`giftID`);

--
-- Indexes for table `tbl_toppon_m_nominals`
--
ALTER TABLE `tbl_toppon_m_nominals`
 ADD PRIMARY KEY (`nominalID`);

--
-- Indexes for table `tbl_toppon_m_payment_methods`
--
ALTER TABLE `tbl_toppon_m_payment_methods`
 ADD PRIMARY KEY (`paymentMethodID`);

--
-- Indexes for table `tbl_toppon_m_publishers`
--
ALTER TABLE `tbl_toppon_m_publishers`
 ADD PRIMARY KEY (`publisherID`);

--
-- Indexes for table `tbl_toppon_m_users`
--
ALTER TABLE `tbl_toppon_m_users`
 ADD PRIMARY KEY (`userID`), ADD UNIQUE KEY `phoneNumber` (`phoneNumber`), ADD UNIQUE KEY `userName` (`userName`);

--
-- Indexes for table `tbl_toppon_s_accounts`
--
ALTER TABLE `tbl_toppon_s_accounts`
 ADD PRIMARY KEY (`sAccountID`), ADD KEY `userID` (`userID`);

--
-- Indexes for table `tbl_toppon_s_games`
--
ALTER TABLE `tbl_toppon_s_games`
 ADD PRIMARY KEY (`sGamesID`), ADD KEY `publisherID` (`publisherID`), ADD KEY `nominalID` (`nominalID`);

--
-- Indexes for table `tbl_toppon_t_deposits`
--
ALTER TABLE `tbl_toppon_t_deposits`
 ADD PRIMARY KEY (`tDepositID`);

--
-- Indexes for table `tbl_toppon_t_game_purchases`
--
ALTER TABLE `tbl_toppon_t_game_purchases`
 ADD PRIMARY KEY (`tGamePurchaseID`);

--
-- Indexes for table `tbl_toppon_t_gifts`
--
ALTER TABLE `tbl_toppon_t_gifts`
 ADD PRIMARY KEY (`tGiftID`);

--
-- Indexes for table `tbl_toppon_t_transfers`
--
ALTER TABLE `tbl_toppon_t_transfers`
 ADD PRIMARY KEY (`tTransferID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_toppon_m_banks`
--
ALTER TABLE `tbl_toppon_m_banks`
MODIFY `bankID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_toppon_m_coins`
--
ALTER TABLE `tbl_toppon_m_coins`
MODIFY `coinID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_toppon_m_gifts`
--
ALTER TABLE `tbl_toppon_m_gifts`
MODIFY `giftID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_toppon_m_nominals`
--
ALTER TABLE `tbl_toppon_m_nominals`
MODIFY `nominalID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_toppon_m_payment_methods`
--
ALTER TABLE `tbl_toppon_m_payment_methods`
MODIFY `paymentMethodID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_toppon_m_publishers`
--
ALTER TABLE `tbl_toppon_m_publishers`
MODIFY `publisherID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_toppon_m_users`
--
ALTER TABLE `tbl_toppon_m_users`
MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_toppon_s_accounts`
--
ALTER TABLE `tbl_toppon_s_accounts`
MODIFY `sAccountID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_toppon_s_games`
--
ALTER TABLE `tbl_toppon_s_games`
MODIFY `sGamesID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tbl_toppon_t_deposits`
--
ALTER TABLE `tbl_toppon_t_deposits`
MODIFY `tDepositID` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_toppon_t_game_purchases`
--
ALTER TABLE `tbl_toppon_t_game_purchases`
MODIFY `tGamePurchaseID` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_toppon_t_gifts`
--
ALTER TABLE `tbl_toppon_t_gifts`
MODIFY `tGiftID` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_toppon_t_transfers`
--
ALTER TABLE `tbl_toppon_t_transfers`
MODIFY `tTransferID` int(15) NOT NULL AUTO_INCREMENT;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_toppon_s_accounts`
--
ALTER TABLE `tbl_toppon_s_accounts`
ADD CONSTRAINT `tbl_toppon_s_accounts_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `tbl_toppon_m_users` (`userID`);

--
-- Ketidakleluasaan untuk tabel `tbl_toppon_s_games`
--
ALTER TABLE `tbl_toppon_s_games`
ADD CONSTRAINT `tbl_toppon_s_games_ibfk_1` FOREIGN KEY (`publisherID`) REFERENCES `tbl_toppon_m_publishers` (`publisherID`),
ADD CONSTRAINT `tbl_toppon_s_games_ibfk_2` FOREIGN KEY (`nominalID`) REFERENCES `tbl_toppon_m_nominals` (`nominalID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
