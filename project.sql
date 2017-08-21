-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2017 at 09:12 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `assessment`
--

CREATE TABLE `assessment` (
  `assessment_code` varchar(9) NOT NULL,
  `name` varchar(250) NOT NULL,
  `number_markers` varchar(9) NOT NULL,
  `marking_scheme` varchar(9) NOT NULL,
  `weighs` varchar(5) NOT NULL,
  `description` varchar(255) NOT NULL,
  `markers` varchar(250) NOT NULL,
  `sub_assessment` varchar(250) NOT NULL,
  `sub_assessment_description` varchar(250) NOT NULL,
  `sub_assessment_weight` varchar(250) NOT NULL,
  `sub_assessment_marking_scheme` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assessment`
--

INSERT INTO `assessment` (`assessment_code`, `name`, `number_markers`, `marking_scheme`, `weighs`, `description`, `markers`, `sub_assessment`, `sub_assessment_description`, `sub_assessment_weight`, `sub_assessment_marking_scheme`) VALUES
('a1', 'coursework', '2', 'yes', '50%', 'group work', 'All Lecturers', 'report ', 'may', '50', 'No (Single Marking)'),
('a1', 'coursework', '2', 'yes', '50%', 'group work', 'All Lecturers', 'presentation', 'january and may', '50', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

CREATE TABLE `lecturers` (
  `id` int(5) NOT NULL,
  `lecturer_id` varchar(9) NOT NULL,
  `student_id` varchar(9) NOT NULL,
  `module_code` varchar(9) NOT NULL,
  `module_name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecturers`
--

INSERT INTO `lecturers` (`id`, `lecturer_id`, `student_id`, `module_code`, `module_name`) VALUES
(1, 's1', 'u1407170', 'CN5101', 'Database');

-- --------------------------------------------------------

--
-- Table structure for table `marking_scheme`
--

CREATE TABLE `marking_scheme` (
  `id` int(9) NOT NULL,
  `module_code` varchar(9) NOT NULL,
  `module_name` varchar(255) NOT NULL,
  `assessment_code` varchar(9) NOT NULL,
  `total_marks` int(9) NOT NULL,
  `area_name` varchar(255) NOT NULL,
  `questions` varchar(255) NOT NULL,
  `marks_avaliable` varchar(9) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marking_scheme`
--

INSERT INTO `marking_scheme` (`id`, `module_code`, `module_name`, `assessment_code`, `total_marks`, `area_name`, `questions`, `marks_avaliable`) VALUES
(17, 'CN5102', 'Software', 'a1', 100, 'presentation', 'all members showed up', '2'),
(16, 'CN5102', 'Software', 'a1', 100, 'plan', 'how did you separate work evenly between members?', '5'),
(18, 'CN5102', 'Software', 'a1', 100, 'presentation', 'all members contributed ', '5'),
(19, 'CN5102', 'Software', 'a1', 100, 'plan', 'how did you separate work evenly between members?', '5'),
(20, 'CN5102', 'Software', 'a1', 100, 'presentation', 'all members showed up', '2'),
(21, 'CN5102', 'Software', 'a1', 100, 'presentation', 'all members contributed ', '5');

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `mark_id` int(9) NOT NULL,
  `module_code` varchar(9) NOT NULL,
  `assessment_code` varchar(9) NOT NULL,
  `sub_assessment` varchar(50) NOT NULL,
  `student_id` varchar(9) NOT NULL,
  `mark1` int(5) NOT NULL,
  `mark2` int(5) NOT NULL,
  `mark3` int(5) NOT NULL,
  `final_mark` int(5) NOT NULL,
  `engagement` varchar(25) NOT NULL,
  `feedback` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`mark_id`, `module_code`, `assessment_code`, `sub_assessment`, `student_id`, `mark1`, `mark2`, `mark3`, `final_mark`, `engagement`, `feedback`) VALUES
(50, 'CN5101', 'a1', 'report ', 'u1407170', 47, 0, 0, 47, 'Good', 'All points met and well explained.'),
(57, 'CN5102', 'a1', 'report ', 'u1309254', 50, 45, 0, 95, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `module_code` varchar(7) NOT NULL,
  `module_name` varchar(50) NOT NULL,
  `module_leader` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `level` varchar(25) NOT NULL,
  `assessment1` varchar(50) NOT NULL,
  `assessment2` varchar(50) NOT NULL,
  `assessment3` varchar(50) NOT NULL,
  `lecturers_linked` varchar(250) NOT NULL,
  `access_students` varchar(250) NOT NULL,
  `markers` varchar(250) NOT NULL,
  `marking_scheme` varchar(9) NOT NULL,
  `engagement_points` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`module_code`, `module_name`, `module_leader`, `description`, `level`, `assessment1`, `assessment2`, `assessment3`, `lecturers_linked`, `access_students`, `markers`, `marking_scheme`, `engagement_points`) VALUES
('CN5102', 'Software', 'Syed Islam', 'Advanced software module to help students improve java skills further before final year.', '4', '', '', '', '', '', '', '', ''),
('CN5103', 'Operating Systems', 'Usman Naeem', '', '5', '', '', '', '', '', '', '', ''),
('CN5101', 'Database', 'Arish', 'Database SQL tutorials', '5', 'a1', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(8) NOT NULL,
  `name` varchar(25) NOT NULL,
  `surname` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `rank` varchar(15) NOT NULL,
  `level` int(1) NOT NULL,
  `supervisor` varchar(150) NOT NULL,
  `second_supervisor` varchar(150) NOT NULL,
  `modules` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `username`, `password`, `rank`, `level`, `supervisor`, `second_supervisor`, `modules`) VALUES
('u1309254', 'Student', 'Example', 'student@example.com', 'student', 'pass', 'Student', 4, 'Supervisor Example', 'Not assigned/No one', ''),
('a', 'Admin', 'Example', 'admin@example.co.uk', 'admin', 'Pass', 'Admin', 0, '', '', ''),
('s', 'Supervisor', 'Example', 'super@example.com', 'super', 'Pass', 'Lecturer', 0, '', '', 'Software, Operating Systems'),
('s1', 'usman', 'naeem', 'example@test.co.uk', 'usman', 'pass', 'lecturer', 0, '', '', 'Software'),
('a1', 'syed', 'islam', 'example@test.com', 'syed', 'pass', 'admin', 0, '', '', ''),
('u1407170', 'assia', 'moujdi', 'test@example.com', 'assia', 'pass', 'student', 5, 'usman naeem', 'Supervisor Example', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marking_scheme`
--
ALTER TABLE `marking_scheme`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`mark_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lecturers`
--
ALTER TABLE `lecturers`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `marking_scheme`
--
ALTER TABLE `marking_scheme`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `mark_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
