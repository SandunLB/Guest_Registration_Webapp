-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2024 at 11:14 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `omega_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`id`, `username`, `password`, `created_at`) VALUES
(3, 'admin@omegaline', '$2y$10$lrzWM7g33IsL0SO7poZCvO8wR4RsgBXc51P3iTHW5z2B.YB46I13m', '2024-02-28 09:31:37');

-- --------------------------------------------------------

--
-- Table structure for table `arrived_guests`
--

CREATE TABLE `arrived_guests` (
  `ArrivalID` int(11) NOT NULL,
  `GuestID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `NIC` varchar(15) NOT NULL,
  `PhoneNumber` varchar(15) DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `ContactPerson` varchar(255) NOT NULL,
  `Purpose` varchar(255) NOT NULL,
  `ArrivalDate` date NOT NULL,
  `ArrivalTime` time NOT NULL,
  `OutTime` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guestdetails`
--

CREATE TABLE `guestdetails` (
  `GuestID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `NIC` varchar(15) NOT NULL,
  `PhoneNumber` varchar(15) DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `QRCodePath` varchar(255) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `Employee_ID` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purpose`
--

CREATE TABLE `purpose` (
  `PurposeID` int(11) NOT NULL,
  `GuestID` int(11) DEFAULT NULL,
  `ContactPerson` varchar(255) NOT NULL,
  `Purpose` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Position` varchar(255) NOT NULL,
  `Employee_ID` varchar(10) NOT NULL,
  `Guest_name` varchar(255) NOT NULL,
  `NIC` varchar(15) NOT NULL,
  `Phone_number` varchar(15) DEFAULT NULL,
  `Arrival_Date` date NOT NULL,
  `Arrival_Time` time NOT NULL,
  `Vehicle_Number` varchar(20) NOT NULL,
  `Purpose_of_visit` varchar(255) DEFAULT NULL,
  `Out_Time` time DEFAULT NULL,
  `QRCodePath` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicledate`
--

CREATE TABLE `vehicledate` (
  `VehicleID` int(11) NOT NULL,
  `Date` date DEFAULT NULL,
  `VehicleNumber` varchar(20) NOT NULL,
  `GuestID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

CREATE TABLE `visits` (
  `VisitID` int(11) NOT NULL,
  `GuestID` int(11) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Time` time DEFAULT NULL,
  `OutTime` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `arrived_guests`
--
ALTER TABLE `arrived_guests`
  ADD PRIMARY KEY (`ArrivalID`),
  ADD KEY `GuestID` (`GuestID`);

--
-- Indexes for table `guestdetails`
--
ALTER TABLE `guestdetails`
  ADD PRIMARY KEY (`GuestID`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Employee_ID` (`Employee_ID`);

--
-- Indexes for table `purpose`
--
ALTER TABLE `purpose`
  ADD PRIMARY KEY (`PurposeID`),
  ADD KEY `GuestID` (`GuestID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `vehicledate`
--
ALTER TABLE `vehicledate`
  ADD PRIMARY KEY (`VehicleID`),
  ADD KEY `GuestID` (`GuestID`);

--
-- Indexes for table `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`VisitID`),
  ADD KEY `GuestID` (`GuestID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `arrived_guests`
--
ALTER TABLE `arrived_guests`
  MODIFY `ArrivalID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guestdetails`
--
ALTER TABLE `guestdetails`
  MODIFY `GuestID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purpose`
--
ALTER TABLE `purpose`
  MODIFY `PurposeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicledate`
--
ALTER TABLE `vehicledate`
  MODIFY `VehicleID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visits`
--
ALTER TABLE `visits`
  MODIFY `VisitID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `arrived_guests`
--
ALTER TABLE `arrived_guests`
  ADD CONSTRAINT `arrived_guests_ibfk_1` FOREIGN KEY (`GuestID`) REFERENCES `guestdetails` (`GuestID`);

--
-- Constraints for table `purpose`
--
ALTER TABLE `purpose`
  ADD CONSTRAINT `purpose_ibfk_1` FOREIGN KEY (`GuestID`) REFERENCES `guestdetails` (`GuestID`);

--
-- Constraints for table `vehicledate`
--
ALTER TABLE `vehicledate`
  ADD CONSTRAINT `vehicledate_ibfk_1` FOREIGN KEY (`GuestID`) REFERENCES `guestdetails` (`GuestID`);

--
-- Constraints for table `visits`
--
ALTER TABLE `visits`
  ADD CONSTRAINT `visits_ibfk_1` FOREIGN KEY (`GuestID`) REFERENCES `guestdetails` (`GuestID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
