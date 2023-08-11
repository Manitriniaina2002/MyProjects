-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 24, 2023 at 03:14 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dBventeVoiture`
--

-- --------------------------------------------------------

--
-- Table structure for table `achat`
--

CREATE TABLE `achat` (
  `numAchat` int(11) NOT NULL,
  `idcli` int(11) DEFAULT NULL,
  `idvoit` int(11) DEFAULT NULL,
  `dateachat` date DEFAULT NULL,
  `qte` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `achat`
--

INSERT INTO `achat` (`numAchat`, `idcli`, `idvoit`, `dateachat`, `qte`) VALUES
(53, 16, 7, '2023-04-11', 1),
(54, 22, 8, '2023-04-14', 5),
(57, 18, 8, '2023-04-22', 5),
(58, 17, 7, '2023-04-24', 2);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `idcli` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`idcli`, `nom`, `contact`) VALUES
(15, 'Marco Polo', '0380025142'),
(16, 'Juvanie', '0349097207'),
(17, 'Jean Michel', 'Delve'),
(18, 'Odon', '0342558920'),
(19, 'Alberta', '0325641220'),
(20, 'Michel Brown', '0345641202'),
(21, 'Marcel Olivier', '0342255502'),
(22, 'Mauricio', '02500120012'),
(23, 'aina', 'merciaaina@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `numero`
--

CREATE TABLE `numero` (
  `num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `numero`
--

INSERT INTO `numero` (`num`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `numfacture`
--

CREATE TABLE `numfacture` (
  `num_fact` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `numfacture`
--

INSERT INTO `numfacture` (`num_fact`) VALUES
(1),
(0);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `iduser` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(30) NOT NULL,
  `passwd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`iduser`, `email`, `contact`, `passwd`) VALUES
(1, 'mbolaodon15@gmail.com', '0349097207', 'odonadmin');

-- --------------------------------------------------------

--
-- Table structure for table `voiture`
--

CREATE TABLE `voiture` (
  `idvoit` int(11) NOT NULL,
  `design` varchar(255) DEFAULT NULL,
  `prix` double DEFAULT NULL,
  `nombre` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `voiture`
--

INSERT INTO `voiture` (`idvoit`, `design`, `prix`, `nombre`) VALUES
(7, 'RENAULT', 14000000, 57),
(8, 'TOYOTA', 35000000, 72),
(9, 'MUTSIBUSHI', 140000000, 50),
(11, 'MAZDA', 1000000000, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achat`
--
ALTER TABLE `achat`
  ADD PRIMARY KEY (`numAchat`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`idcli`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`iduser`);

--
-- Indexes for table `voiture`
--
ALTER TABLE `voiture`
  ADD PRIMARY KEY (`idvoit`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achat`
--
ALTER TABLE `achat`
  MODIFY `numAchat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `idcli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `voiture`
--
ALTER TABLE `voiture`
  MODIFY `idvoit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
