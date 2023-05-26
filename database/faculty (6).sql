-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2023 at 02:08 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `faculty`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(15) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `dob` varchar(15) DEFAULT NULL,
  `password` varchar(75) NOT NULL,
  `dp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `gender`, `dob`, `password`, `dp`) VALUES
(12, 'admin1', 'admin1@admin.com', 'Male', '1998-02-02', '1234', '');

-- --------------------------------------------------------

--
-- Table structure for table `grp`
--

CREATE TABLE `grp` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grp`
--

INSERT INTO `grp` (`id`, `name`) VALUES
(1, 'groupe 01'),
(2, 'groupe 02'),
(3, 'groupe 03'),
(4, 'groupe 04'),
(5, 'groupe 05');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `name`) VALUES
(1, 'L1_ING'),
(2, 'L2_SC'),
(3, 'L3_SI'),
(4, 'L3_ISIL'),
(5, 'M1_ISI'),
(6, 'M1_WIC'),
(7, 'M1_RSSI'),
(8, 'M2_ISI'),
(9, 'M2_WIC'),
(10, 'M2_RSSI');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `subject_name` varchar(100) DEFAULT NULL,
  `attendance` enum('present','absent') DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `student_id`, `subject_name`, `attendance`, `timestamp`) VALUES
(25, 2, NULL, 'present', '2023-05-24 01:14:46'),
(26, 32, NULL, 'present', '2023-05-24 01:14:46'),
(27, 33, NULL, 'present', '2023-05-24 01:14:46'),
(28, 34, NULL, 'present', '2023-05-24 01:14:46'),
(29, 35, NULL, 'present', '2023-05-24 01:14:46');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `name`) VALUES
(1, 'section 01'),
(2, 'section 02'),
(3, 'section 03'),
(4, 'section 04'),
(5, 'section 05');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `level_id` int(11) NOT NULL,
  `section_id` int(11) DEFAULT NULL,
  `grp_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `dob`, `gender`, `email`, `mobile`, `level_id`, `section_id`, `grp_id`) VALUES
(1, 'John Doe', '2000-01-01', 'Male', 'john.doe@example.com', '1234567890', 1, 1, 1),
(2, 'Jane Smith', '2001-02-02', 'Female', 'jane.smith@example.com', '9876543210', 2, 2, 2),
(3, 'Michael Johnson', '1999-03-03', 'Male', 'michael.johnson@example.com', '5555555555', 3, 3, 3),
(4, 'Emily Davis', '2002-04-04', 'Female', 'emily.davis@example.com', '1111111111', 4, 4, 4),
(5, 'William Brown', '1998-05-05', 'Male', 'william.brown@example.com', '9999999999', 5, 5, 5),
(6, 'Sarah Wilson', '2003-06-06', 'Female', 'sarah.wilson@example.com', '4444444444', 6, 1, 2),
(7, 'Robert Thompson', '2000-07-07', 'Male', 'robert.thompson@example.com', '7777777777', 7, 2, 3),
(8, 'Olivia Martinez', '1999-08-08', 'Female', 'olivia.martinez@example.com', '2222222222', 8, 3, 4),
(9, 'James Anderson', '2001-09-09', 'Male', 'james.anderson@example.com', '8888888888', 9, 4, 5),
(10, 'Emma Clark', '1998-10-10', 'Female', 'emma.clark@example.com', '3333333333', 10, 5, 1),
(11, 'Daniel Lewis', '2002-11-11', 'Male', 'daniel.lewis@example.com', '6666666666', 1, 1, 2),
(12, 'Sophia Lee', '2003-12-12', 'Female', 'sophia.lee@example.com', '9999999999', 2, 2, 3),
(13, 'Matthew Walker', '2000-01-13', 'Male', 'matthew.walker@example.com', '1111111111', 3, 3, 4),
(14, 'Ava Hall', '1999-02-14', 'Female', 'ava.hall@example.com', '4444444444', 4, 4, 5),
(15, 'Oliver Wright', '2001-03-15', 'Male', 'oliver.wright@example.com', '7777777777', 5, 5, 1),
(16, 'Isabella Turner', '1998-04-16', 'Female', 'isabella.turner@example.com', '2222222222', 6, 1, 2),
(17, 'Ethan Hill', '2002-05-17', 'Male', 'ethan.hill@example.com', '5555555555', 7, 2, 3),
(18, 'Mia Green', '2003-06-18', 'Female', 'mia.green@example.com', '8888888888', 8, 3, 4),
(19, 'Noah Adams', '2000-07-19', 'Male', 'noah.adams@example.com', '1111111111', 9, 4, 5),
(20, 'Charlotte Baker', '1999-08-20', 'Female', 'charlotte.baker@example.com', '4444444444', 10, 5, 1),
(21, 'Liam King', '2001-09-21', 'Male', 'liam.king@example.com', '7777777777', 1, 1, 2),
(22, 'Amelia Wood', '1998-10-22', 'Female', 'amelia.wood@example.com', '2222222222', 2, 2, 3),
(23, 'Benjamin Morris', '2002-11-23', 'Male', 'benjamin.morris@example.com', '5555555555', 3, 3, 4),
(24, 'Evelyn Ward', '2003-12-24', 'Female', 'evelyn.ward@example.com', '8888888888', 4, 4, 5),
(25, 'Alexander Cooper', '2000-01-25', 'Male', 'alexander.cooper@example.com', '1111111111', 5, 5, 1),
(26, 'John Doe', '1990-01-01', 'Male', 'john.doe@example.com', '1234567890', 1, 1, 1),
(27, 'Jane Smith', '1992-02-02', 'Female', 'jane.smith@example.com', '9876543210', 1, 1, 1),
(28, 'Michael Johnson', '1995-03-03', 'Male', 'michael.johnson@example.com', '4567890123', 1, 1, 1),
(29, 'Emily Davis', '1998-04-04', 'Female', 'emily.davis@example.com', '7890123456', 1, 1, 1),
(30, 'Robert Wilson', '2000-05-05', 'Male', 'robert.wilson@example.com', '3210987654', 1, 1, 1),
(31, 'Sarah Johnson', '1991-06-06', 'Female', 'sarah.johnson@example.com', '1234567890', 2, 2, 2),
(32, 'David Brown', '1993-07-07', 'Male', 'david.brown@example.com', '9876543210', 2, 2, 2),
(33, 'Jessica Lee', '1996-08-08', 'Female', 'jessica.lee@example.com', '4567890123', 2, 2, 2),
(34, 'Matthew Miller', '1999-09-09', 'Male', 'matthew.miller@example.com', '7890123456', 2, 2, 2),
(35, 'Olivia Taylor', '2001-10-10', 'Female', 'olivia.taylor@example.com', '3210987654', 2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `name`) VALUES
(1, 'IHM-TD'),
(2, 'IHM-TP'),
(3, 'ASI-TD'),
(4, 'ASD-TP'),
(5, 'PAW-TP'),
(6, 'PAW-TP'),
(7, 'SAD-TD'),
(8, 'SAD-TP'),
(9, 'SIL3-TD'),
(10, 'LM-TD'),
(11, 'SE01-TD'),
(12, 'SE02-TP'),
(13, 'GL-TD'),
(14, 'SIL2-TD'),
(15, 'IA-TD'),
(16, 'IA-TP');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `name`, `email`, `password`) VALUES
(3, 'bahlouli boualem', 'hbboy47@gmail.com', '123'),
(4, 'boualem', 'asd@phpzag.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_subject`
--

CREATE TABLE `teacher_subject` (
  `teacher_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_subject`
--

INSERT INTO `teacher_subject` (`teacher_id`, `subject_id`) VALUES
(3, 5),
(3, 6),
(4, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grp`
--
ALTER TABLE `grp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_id` (`id`),
  ADD KEY `grp_id` (`id`),
  ADD KEY `level_id` (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_subject`
--
ALTER TABLE `teacher_subject`
  ADD PRIMARY KEY (`teacher_id`,`subject_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `grp`
--
ALTER TABLE `grp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
