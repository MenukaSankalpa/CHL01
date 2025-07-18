-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2025 at 04:27 AM
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
-- Database: `hr_applications`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `id` int(11) NOT NULL,
  `applicantName` varchar(100) DEFAULT NULL,
  `homeTown` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `familyDetails` text DEFAULT NULL,
  `leaving` text DEFAULT NULL,
  `performance` text DEFAULT NULL,
  `appearance` int(11) DEFAULT NULL,
  `communication` int(11) DEFAULT NULL,
  `experience` int(11) DEFAULT NULL,
  `qualification` int(11) DEFAULT NULL,
  `interest` int(11) DEFAULT NULL,
  `totalMarks` int(11) DEFAULT NULL,
  `noticePeriod` int(11) DEFAULT NULL,
  `presentSalary` int(11) DEFAULT NULL,
  `expectedSalary` int(11) DEFAULT NULL,
  `possibleWork` date DEFAULT NULL,
  `capital_question` varchar(50) DEFAULT NULL,
  `interviewer1Name` varchar(100) DEFAULT NULL,
  `interviewer1Designation` varchar(100) DEFAULT NULL,
  `interviewer1Date` date DEFAULT NULL,
  `interviewer2Name` varchar(100) DEFAULT NULL,
  `interviewer2Designation` varchar(100) DEFAULT NULL,
  `interviewer2Date` date DEFAULT NULL,
  `interviewer3Name` varchar(100) DEFAULT NULL,
  `interviewer3Designation` varchar(100) DEFAULT NULL,
  `interviewer3Date` date DEFAULT NULL,
  `dateAppointment` date DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `companyName` varchar(100) DEFAULT NULL,
  `agreedSalary` varchar(100) DEFAULT NULL,
  `benefits` text DEFAULT NULL,
  `approval` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `aDesignation` varchar(100) DEFAULT NULL,
  `aDate` date DEFAULT NULL,
  `signaturePath` varchar(255) DEFAULT NULL,
  `submitted_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`id`, `applicantName`, `homeTown`, `age`, `status`, `familyDetails`, `leaving`, `performance`, `appearance`, `communication`, `experience`, `qualification`, `interest`, `totalMarks`, `noticePeriod`, `presentSalary`, `expectedSalary`, `possibleWork`, `capital_question`, `interviewer1Name`, `interviewer1Designation`, `interviewer1Date`, `interviewer2Name`, `interviewer2Designation`, `interviewer2Date`, `interviewer3Name`, `interviewer3Designation`, `interviewer3Date`, `dateAppointment`, `position`, `companyName`, `agreedSalary`, `benefits`, `approval`, `name`, `aDesignation`, `aDate`, `signaturePath`, `submitted_at`) VALUES
(4, 'John Doe', 'Springfield', 28, 'Employed', 'Married, 2 children', 'Career advancement', 'Excellent', 8, 9, 10, 8, 8, 0, 30, 60000, 75000, '0000-00-00', '1', 'Alice Smith', 'HR Manager', '2025-07-01', 'Bob Johnson', 'Team Lead', '2025-07-02', 'Carol White', 'Department Head', '2025-07-03', '2025-07-10', 'Software Engineer', 'Tech Innovators Ltd', '70000', '0', 'Approved', 'Michael Brown', 'HR Director', '2025-07-05', 'uploads/signature_1752508569.png', '2025-07-14 21:26:09'),
(5, 'John Doe', 'Springfield', 28, 'Employed', 'Married, 2 children', 'Career advancement', 'Excellent', 8, 9, 10, 8, 8, 0, 30, 60000, 75000, '0000-00-00', '3', 'Alice Smith', 'HR Manager', '2025-07-01', 'Bob Johnson', 'Team Lead', '2025-07-02', 'Carol White', 'Department Head', '2025-07-03', '2025-07-10', 'Software Engineer', 'Tech Innovators Ltd', '70000', '0', 'Approved', 'Michael Brown', 'HR Director', '2025-07-05', 'uploads/signature_1752511505.png', '2025-07-14 22:15:05'),
(6, 'John Doe', 'Springfield', 28, 'Employed', 'Married, 2 children', 'Career advancement', 'Excellent', 8, 9, 10, 8, 8, 0, 30, 60000, 75000, '0000-00-00', '3', 'Alice Smith', 'HR Manager', '2025-07-01', 'Bob Johnson', 'Team Lead', '2025-07-02', 'Carol White', 'Department Head', '2025-07-03', '2025-07-10', 'Software Engineer', 'Tech Innovators Ltd', '70000', '0', 'Approved', 'Michael Brown', 'HR Director', '2025-07-05', 'uploads/signature_1752511510.png', '2025-07-14 22:15:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
