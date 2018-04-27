-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 18, 2018 at 10:56 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oneclick`
--
DROP DATABASE IF EXISTS `oneclick`;
CREATE DATABASE IF NOT EXISTS `oneclick` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `oneclick`;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE `course` (
  `CourseID` int(11) NOT NULL,
  `CourseName` varchar(40) DEFAULT NULL,
  `CourseTitle` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `course`
--

TRUNCATE TABLE `course`;
--
-- Dumping data for table `course`
--

INSERT INTO `course` (`CourseID`, `CourseName`, `CourseTitle`) VALUES
(1, 'CSL202', 'PROGRAMMING PARADIGMS AND PRAGMATICS'),
(2, 'CSL310', 'Database Application Programming'),
(3, 'HUL482', 'PSYCHOANALYSIS AND POPULAR CULTURE'),
(4, 'CSL461', 'DIGITAL IMAGE ANALYSIS'),
(5, 'CSP203', 'SOFTWARE SYSTEMS LABORATORY'),
(6, 'MAL213', 'INTRODUCTION TO PROBABILITY THEORY AND STOCHASTIC PROCESSES'),
(7, 'GEL103', 'INTRODUCTION TO COMPUTING'),
(19, 'BML611', 'CANCER BIOLOGY- ADVANCES IN DIAGNOSTICS AND THERAPEUTICS'),
(20, 'BML612', 'TISSUE ENGINEERING AND REGENERATIVE MEDICINE'),
(21, 'HUL461', 'MORPHOLOGY'),
(22, 'HUL464', 'SYNTACTIC TYPOLOGY '),
(23, 'MAL617', 'GRAPH THEORY'),
(24, 'CSL105', 'DISCRETE MATHEMATICAL STRUCTURES'),
(25, 'CSL201', 'DATA STRUCTURES'),
(26, 'CSL307', 'COMPUTER GRAPHICS'),
(27, 'CSL211', 'COMPUTER ARCHITECTURE'),
(28, 'CSL462', 'COMPUTER VISION');

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

DROP TABLE IF EXISTS `instructor`;
CREATE TABLE `instructor` (
  `InstructorID` int(11) NOT NULL,
  `IDPass` varchar(20) NOT NULL,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) DEFAULT NULL,
  `email` varchar(320) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `instructor`
--

TRUNCATE TABLE `instructor`;
--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`InstructorID`, `IDPass`, `FirstName`, `LastName`, `email`) VALUES
(1, 'puneet123', 'Puneet', 'Goyal', 'puneet@iitrpr.ac.in'),
(2, 'kumar123', 'Arun', 'kumar', 'arun@iitrpr.ac.in'),
(3, 'mukesh123', 'Mukesh', 'Saini', 'mukesh@iitrpr.ac.in'),
(4, 'anshu123', 'Anshu', 'Loius', 'anshu@iitrpr.ac.in'),
(5, 'sodhi123', 'Balwinder', 'Sodhi', 'sodhi@iitrpr.ac.in'),
(15, '12345678', 'test', 'test', 'test@iitrpr.ac.in'),
(16, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `Instructor_courses`
--

DROP TABLE IF EXISTS `Instructor_courses`;
CREATE TABLE `Instructor_courses` (
  `CourseID` int(11) NOT NULL,
  `InstructorID` int(11) NOT NULL,
  `no_of_enrolled_students` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncate table before insert `Instructor_courses`
--

TRUNCATE TABLE `Instructor_courses`;
--
-- Dumping data for table `Instructor_courses`
--

INSERT INTO `Instructor_courses` (`CourseID`, `InstructorID`, `no_of_enrolled_students`) VALUES
(1, 5, 0),
(2, 5, 0),
(3, 4, 0),
(4, 1, 0),
(5, 3, 0),
(6, 2, 0),
(7, 5, 0),
(19, 5, 0),
(20, 5, 0),
(21, 5, 0),
(22, 5, 0),
(23, 5, 0),
(24, 5, 0),
(25, 5, 0),
(26, 5, 0),
(27, 5, 0),
(28, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `StudentID` int(11) NOT NULL,
  `IDPass` varchar(20) NOT NULL,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) DEFAULT NULL,
  `photoLocation` text,
  `email` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `student`
--

TRUNCATE TABLE `student`;

--
-- Table structure for table `Student_Attendance`
--

DROP TABLE IF EXISTS `Student_Attendance`;
CREATE TABLE `Student_Attendance` (
  `CourseID` int(11) NOT NULL,
  `StudentID` int(11) DEFAULT NULL,
  `InstructorID` int(11) NOT NULL,
  `dateTaken` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `attendanceStatus` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncate table before insert `Student_Attendance`
--

TRUNCATE TABLE `Student_Attendance`;
--
-- Indexes for dumped tables
--


INSERT INTO `student` (`StudentID`, `IDPass`, `FirstName`, `LastName`, `email`) VALUES
(1, 'A', 'A', 'A', 'A@iitrpr.ac.in'),
(2, 'B', 'B', 'B', 'B@iitrpr.ac.in'),
(3, 'C', 'C', 'C', 'C@iitrpr.ac.in'),
(4, 'D', 'D', 'D', 'D@iitrpr.ac.in'),
(5, 'E', 'E', 'E', 'E@iitrpr.ac.in'),
(15, 'F', 'F', 'F', 'F@iitrpr.ac.in');
--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`CourseID`),
  ADD UNIQUE KEY `CourseID` (`CourseID`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`InstructorID`);
  
--
-- Indexes for table `Instructor_courses`
--
ALTER TABLE `Instructor_courses`
  ADD PRIMARY KEY (`CourseID`,`InstructorID`),
  ADD KEY `InstructorID` (`InstructorID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`StudentID`);

--
-- Indexes for table `Student_Attendance`
--
ALTER TABLE `Student_Attendance`
  ADD PRIMARY KEY (`CourseID`,`InstructorID`),
  ADD KEY `StudentID` (`StudentID`),
  ADD KEY `InstructorID` (`InstructorID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `CourseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `instructor`
--
ALTER TABLE `instructor`
  MODIFY `InstructorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `StudentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for table `Instructor_courses`
--
ALTER TABLE `Instructor_courses`
  ADD CONSTRAINT `Instructor_courses_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `course` (`CourseID`) ON DELETE CASCADE,
  ADD CONSTRAINT `Instructor_courses_ibfk_2` FOREIGN KEY (`InstructorID`) REFERENCES `instructor` (`InstructorID`) ON DELETE CASCADE;
  
--
-- Constraints for table `Student_Attendance`
--
ALTER TABLE `Student_Attendance`
  ADD CONSTRAINT `Student_Attendance_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `course` (`CourseID`) ON DELETE CASCADE,
  ADD CONSTRAINT `Student_Attendance_ibfk_2` FOREIGN KEY (`StudentID`) REFERENCES `student` (`StudentID`) ON DELETE CASCADE,
  ADD CONSTRAINT `Student_Attendance_ibfk_3` FOREIGN KEY (`InstructorID`) REFERENCES `instructor` (`InstructorID`) ON DELETE CASCADE;
  
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;