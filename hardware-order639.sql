-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 26, 2022 at 05:01 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hardware-order639`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`jolmstead`@`129.173.0.0/255.255.0.0` PROCEDURE `GetPriceOfPartByID639` (IN `id` INT(255), OUT `price639` DECIMAL(10,2))   BEGIN
SELECT currentPrice639 from Part639 WHERE id = PartNO639 INTO price639;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin639`
--

CREATE TABLE `admin639` (
  `AdminId639` int(11) NOT NULL,
  `Name639` varchar(150) NOT NULL,
  `Username639` int(150) NOT NULL,
  `Password639` int(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='use for admin login and view all purchase orders made';

-- --------------------------------------------------------

--
-- Table structure for table `Client639`
--

CREATE TABLE `Client639` (
  `idClients639` int(11) NOT NULL,
  `ClientsCity639` varchar(45) DEFAULT NULL,
  `dollarsOnOrder639` decimal(10,2) DEFAULT NULL,
  `ClientName639` varchar(45) DEFAULT NULL,
  `ClientStatus639` varchar(45) DEFAULT NULL,
  `clientCompPassword639` varchar(45) DEFAULT NULL,
  `MoneyOwed639` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Client639`
--

INSERT INTO `Client639` (`idClients639`, `ClientsCity639`, `dollarsOnOrder639`, `ClientName639`, `ClientStatus639`, `clientCompPassword639`, `MoneyOwed639`) VALUES
(1, 'Halifax', '0.00', 'Julia', NULL, 'APassword123', '3885.00'),
(2, 'Oakville', NULL, 'Meagan Norman', NULL, NULL, '0.00'),
(33, 'Tokyo', NULL, 'Midori', NULL, NULL, '1155.00'),
(44, 'Toronto', NULL, 'Chris', NULL, NULL, '124.00'),
(99, 'Sydney', NULL, 'Raghav', NULL, NULL, '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `Lines0639`
--

CREATE TABLE `Lines0639` (
  `LineNO639` int(11) NOT NULL,
  `Qty639` varchar(45) DEFAULT NULL,
  `PurchaseOrder0639_poNo639` int(11) NOT NULL,
  `clientID639` int(11) NOT NULL,
  `price639` decimal(10,2) DEFAULT NULL,
  `priceOnPurchase639` decimal(10,2) DEFAULT NULL,
  `Part639_PartNO639` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Lines0639`
--

INSERT INTO `Lines0639` (`LineNO639`, `Qty639`, `PurchaseOrder0639_poNo639`, `clientID639`, `price639`, `priceOnPurchase639`, `Part639_PartNO639`) VALUES
(1, '3', 1, 44, '34.50', '34.50', 78),
(2, '3', 1, 44, '4.00', '4.00', 2),
(3, '3', 1, 44, '4.00', '4.00', 2);

--
-- Triggers `Lines0639`
--
DELIMITER $$
CREATE TRIGGER `UpdateMoneyOwedOnClient639` AFTER INSERT ON `Lines0639` FOR EACH ROW BEGIN
DECLARE price639ID DECIMAL DEFAULT 0;
CALL GetPriceOfPartByID639(NEW.PurchaseOrder0639_poNo639, price639ID);
update Client639 SET MoneyOwed639 := MoneyOwed639 + (NEW.Qty639 * price639ID) WHERE Client639.idClients639 = NEW.clientID639;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Part639`
--

CREATE TABLE `Part639` (
  `PartNO639` int(11) NOT NULL,
  `PartName639` varchar(45) DEFAULT NULL,
  `PartDescription639` varchar(180) DEFAULT NULL,
  `currentPrice639` decimal(10,2) DEFAULT NULL,
  `QoH639` int(45) DEFAULT NULL,
  `Image_Name639` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Part639`
--

INSERT INTO `Part639` (`PartNO639`, `PartName639`, `PartDescription639`, `currentPrice639`, `QoH639`, `Image_Name639`) VALUES
(1, 'Screwdriver', 'A device that can turn screws', '8.99', 30, '0'),
(2, 'Hammer', 'A device that can pound things', '5.99', 13, '0'),
(3, 'Nails (pack of 10)', NULL, '5.67', 30, '0'),
(78, 'HDMI Adaptor for USBC ports', 'A dongle for hdmi to usbc', '34.50', 45, '0'),
(99, 'Pen', 'writing tool', '1.77', 300, '0'),
(101, '', '124124', '124124.00', 1241, ''),
(102, '', 'a magical hammer', '8899.00', 1345, ''),
(103, 'Mary Poppins Umbrella', 'A device to fly ', '44.00', 2, ''),
(104, 'asd', 'asd', '12412.00', 124124, ''),
(105, 'Phone', 'A ring ring device', '1029.00', 300, '');

-- --------------------------------------------------------

--
-- Table structure for table `PurchaseOrder0639`
--

CREATE TABLE `PurchaseOrder0639` (
  `poNo639` int(11) NOT NULL,
  `datePO639` datetime DEFAULT current_timestamp(),
  `statusPO639` varchar(45) DEFAULT NULL,
  `Clients639_idClients639` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `PurchaseOrder0639`
--

INSERT INTO `PurchaseOrder0639` (`poNo639`, `datePO639`, `statusPO639`, `Clients639_idClients639`) VALUES
(1, '2022-07-20 16:02:25', 'Pending', 44),
(2, '2022-07-22 16:31:16', 'Early Bird', 99),
(3, '2022-07-30 16:33:05', 'Transit', 1),
(4, '2022-07-31 16:33:50', 'Pending', 1),
(5, '2022-07-25 21:00:12', 'pending', 44),
(6, '2022-07-25 22:25:33', 'pending', 44),
(7, '2022-07-25 22:25:46', 'pending', 2),
(8, '2022-07-25 23:16:58', 'pending', 33);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Client639`
--
ALTER TABLE `Client639`
  ADD PRIMARY KEY (`idClients639`),
  ADD UNIQUE KEY `idClients_UNIQUE` (`idClients639`);

--
-- Indexes for table `Lines0639`
--
ALTER TABLE `Lines0639`
  ADD PRIMARY KEY (`LineNO639`,`PurchaseOrder0639_poNo639`,`clientID639`,`Part639_PartNO639`),
  ADD KEY `fk_Lines_PurchaseOrder06391_idx` (`PurchaseOrder0639_poNo639`,`clientID639`),
  ADD KEY `fk_Lines0639_Part6391_idx` (`Part639_PartNO639`);

--
-- Indexes for table `Part639`
--
ALTER TABLE `Part639`
  ADD PRIMARY KEY (`PartNO639`),
  ADD UNIQUE KEY `PartNO_UNIQUE` (`PartNO639`);

--
-- Indexes for table `PurchaseOrder0639`
--
ALTER TABLE `PurchaseOrder0639`
  ADD PRIMARY KEY (`poNo639`,`Clients639_idClients639`),
  ADD KEY `fk_PurchaseOrders639_Clients6391_idx` (`Clients639_idClients639`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Part639`
--
ALTER TABLE `Part639`
  MODIFY `PartNO639` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `PurchaseOrder0639`
--
ALTER TABLE `PurchaseOrder0639`
  MODIFY `poNo639` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `PurchaseOrder0639`
--
ALTER TABLE `PurchaseOrder0639`
  ADD CONSTRAINT `fk_PurchaseOrders639_Clients639` FOREIGN KEY (`Clients639_idClients639`) REFERENCES `Client639` (`idClients639`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
