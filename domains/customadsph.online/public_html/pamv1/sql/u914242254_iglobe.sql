-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2020 at 04:45 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u914242254_iglobe`
--

-- --------------------------------------------------------

--
-- Table structure for table `pampadala_txn_history`
--

CREATE TABLE `pampadala_txn_history` (
  `txnID` int(9) NOT NULL,
  `AccountID` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `BranchID` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Username` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Password` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `AccountNo` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Identifier` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `BillerTag` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Amount` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ClientReference` int(50) NOT NULL,
  `isSuccess` tinyint(1) NOT NULL,
  `Message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `ServiceCharge` double(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pampadala_txn_history`
--

INSERT INTO `pampadala_txn_history` (`txnID`, `AccountID`, `BranchID`, `Username`, `Password`, `AccountNo`, `Identifier`, `BillerTag`, `Amount`, `ClientReference`, `isSuccess`, `Message`, `ServiceCharge`) VALUES
(81, '330', '41254', 'TEST_CUSTOMIZED', 'w0rdPas$', '1044145714', 'Ira Melissa Reyes', 'GLOBELINES', '2087', 1114567970, 0, 'PLEASE CHECK THE ACCOUNT NUMBER/IDENTIFIER YOU\'VE ENTERED.', 0.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pampadala_txn_history`
--
ALTER TABLE `pampadala_txn_history`
  ADD PRIMARY KEY (`txnID`),
  ADD UNIQUE KEY `ClientReference` (`ClientReference`),
  ADD UNIQUE KEY `txnID` (`txnID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pampadala_txn_history`
--
ALTER TABLE `pampadala_txn_history`
  MODIFY `txnID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
