-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 30 Mars 2015 à 06:37
-- Version du serveur: 5.5.41-cll-lve
-- Version de PHP: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `cardgenerator`
--

-- --------------------------------------------------------

--
-- Structure de la table `artwork`
--

CREATE TABLE IF NOT EXISTS `artwork` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `url` varchar(125) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=108 ;

--
-- Contenu de la table `artwork`
--

INSERT INTO `artwork` (`id`, `url`) VALUES
(2, '03 - Sn95BXy.jpg'),
(3, '04 - lh3e6KR.jpg'),
(4, '05 - I2ZaKS4.jpg'),
(5, '06 - cSiMeQw.jpg'),
(6, '07 - aWzLnTH.jpg'),
(7, '08 - 68MoK1z.jpg'),
(8, '09 - 9O2Ibvz.jpg'),
(9, '10 - 5SnhnXE.jpg'),
(10, '11 - raCZBOc.jpg'),
(11, '12 - kp2afLf.jpg'),
(12, '13 - BNWhoZC.jpg'),
(13, '14 - JaaMVCv.jpg'),
(14, '15 - SLzRd0P.jpg'),
(15, '16 - bDMBFO3.jpg'),
(16, '17 - hUeSC6G.jpg'),
(17, '18 - 1P6TeUP.jpg'),
(18, '19 - RcVPJTP.jpg'),
(19, '20 - XKJ70r2.jpg'),
(20, '21 - 4vzyhnk.jpg'),
(21, '22 - EN6KARV.jpg'),
(22, '23 - ZumFAMu.jpg'),
(23, '24 - zuz1Wqq.jpg'),
(24, '25 - A3VPB2z.jpg'),
(25, '26 - xSuduAV.jpg'),
(26, '27 - uGmMM7A.jpg'),
(27, '28 - EeoFc40.jpg'),
(28, '29 - cRIUqOi.jpg'),
(29, '30 - 7v6YgeZ.jpg'),
(30, '31 - hUlst7b.jpg'),
(31, '32 - 16sLzoa.jpg'),
(32, '33 - 211wbGZ.jpg'),
(33, '34 - ipiUr2F.jpg'),
(34, '35 - A0v9emu.jpg'),
(35, '36 - kTS2YzT.jpg'),
(36, '37 - ahFBXyB.jpg'),
(37, '38 - Tn3i20o.jpg'),
(38, '39 - 6sN8n6N.jpg'),
(39, '40 - ijDDv7d.jpg'),
(40, '41 - whGDFrO.jpg'),
(41, '42 - P1HTAQm.jpg'),
(42, '43 - YUJquNI.jpg'),
(43, '44 - 3MzFPqa.jpg'),
(44, '45 - aWxTMxp.jpg'),
(45, '46 - nL8qqg6.jpg'),
(46, '47 - jBSFY6G.jpg'),
(47, '48 - Emh2zn1.jpg'),
(48, '49 - PwlrcN2.jpg'),
(49, '50 - CnuYTGy.jpg'),
(50, '51 - MzNhgqC.jpg'),
(51, '52 - quLwNad.jpg'),
(52, '53 - CuepVJJ.jpg'),
(53, '54 - XqgSpQO.jpg'),
(54, '55 - IwlTsRy.jpg'),
(55, '56 - SDXCqRP.jpg'),
(56, '57 - wX6hQoN.jpg'),
(57, '58 - YF7aXd0.jpg'),
(58, '59 - AOUOXYd.jpg'),
(59, '60 - cqZydix.jpg'),
(60, '61 - a7nKgBo.jpg'),
(61, '62 - BVLbZH5.jpg'),
(62, '63 - xhtsDgx.jpg'),
(63, '64 - RGIfU8q.jpg'),
(64, '65 - HbfLiln.jpg'),
(65, '66 - qsOeKCa.jpg'),
(66, '67 - S9muTvz.jpg'),
(67, '68 - LH9NGmA.jpg'),
(68, '69 - Gl7CpnT.jpg'),
(69, '70 - H1DlxLw.jpg'),
(70, '71 - p2ZQyuo.jpg'),
(71, '72 - 2cyhIBT.jpg'),
(72, '73 - uv3MQnb.jpg'),
(73, '74 - QKDD7GD.jpg'),
(74, '75 - VEDzT89.jpg'),
(75, '76 - r2NW3eM.jpg'),
(76, '77 - tdw5nqZ.jpg'),
(77, '78 - U2gyVra.jpg'),
(78, '79 - 7WealWu.jpg'),
(79, '80 - qME1joC.jpg'),
(80, '81 - uqm1ay6.jpg'),
(81, '82 - NQCdlDp.jpg'),
(82, '83 - eNddgLH.jpg'),
(83, '84 - eEn1HRg.jpg'),
(84, '85 - fXQ4kgp.jpg'),
(85, '86 - FnrWyjx.jpg'),
(86, '87 - 2Mz0zKd.jpg'),
(87, '88 - 474oL2B.jpg'),
(88, '89 - zAeDcHw.jpg'),
(89, '90 - 30vLpzr.jpg'),
(90, '91 - 2MUcBPu.jpg'),
(91, '92 - CfX728w.jpg'),
(92, '93 - LqSDpuY.jpg'),
(93, '94 - jSi5ThD.jpg'),
(94, '95 - x1gzwAM.jpg'),
(95, '96 - W8voQqj.jpg'),
(96, '97 - 8ahE3CK.jpg'),
(97, '98 - ZnsEhtM.jpg'),
(98, '99 - cltflea.jpg'),
(107, 'wowscrnshot-031415-200239.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `card`
--

CREATE TABLE IF NOT EXISTS `card` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `url` varchar(125) NOT NULL,
  `rarity` varchar(50) NOT NULL,
  `artwork` varchar(250) NOT NULL,
  `mana` int(2) NOT NULL,
  `attack` int(2) NOT NULL,
  `health` int(2) NOT NULL,
  `cardName` varchar(20) NOT NULL,
  `description` varchar(50) NOT NULL,
  `yourName` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `color` varchar(6) NOT NULL,
  `type` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=141 ;

-- --------------------------------------------------------

--
-- Structure de la table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(25) NOT NULL,
  `user_pass` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `login`
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
