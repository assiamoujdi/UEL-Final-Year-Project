-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2017 at 05:25 PM
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
  `assessment_code` int(9) NOT NULL,
  `module_code` varchar(15) NOT NULL,
  `name` varchar(250) NOT NULL,
  `number_markers` varchar(9) NOT NULL,
  `marking_scheme` varchar(9) NOT NULL,
  `weighs` varchar(5) NOT NULL,
  `description` varchar(255) NOT NULL,
  `deadline` varchar(15) NOT NULL,
  `markers` varchar(250) NOT NULL,
  `sub_assessment` varchar(250) NOT NULL,
  `sub_assessment_description` varchar(250) NOT NULL,
  `sub_assessment_weight` varchar(250) NOT NULL,
  `sub_assessment_marking_scheme` varchar(25) NOT NULL,
  `sub_assessment_deadline` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assessment`
--

INSERT INTO `assessment` (`assessment_code`, `module_code`, `name`, `number_markers`, `marking_scheme`, `weighs`, `description`, `deadline`, `markers`, `sub_assessment`, `sub_assessment_description`, `sub_assessment_weight`, `sub_assessment_marking_scheme`, `sub_assessment_deadline`) VALUES
(22, 'CN5103', 'lab work', '2', 'yes', '25%', 'weekly tutorials', '2017-09-03', 'All Lecturers', ' ', ' ', ' ', ' ', ' '),
(18, 'CN5103', 'exam', '2', 'no', '75%', 'two exams', '2017-09-03', 'All Lecturers', 'january exam', 'january', '50%', '', '2017-09-03');

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
(1, 's1', 'u1407170', 'CN5101', 'Database'),
(7, 's', 'u1309254', 'CN5103', 'Operating Systems'),
(8, 's', 'u1407170', 'CN5103', 'Operating Systems');

-- --------------------------------------------------------

--
-- Table structure for table `marking_scheme`
--

CREATE TABLE `marking_scheme` (
  `id` int(9) NOT NULL,
  `module_code` varchar(9) NOT NULL,
  `module_name` varchar(255) NOT NULL,
  `assessment_code` varchar(9) NOT NULL,
  `criteria` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `percentage` int(9) NOT NULL,
  `range_type` varchar(50) NOT NULL,
  `marks_range` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marking_scheme`
--

INSERT INTO `marking_scheme` (`id`, `module_code`, `module_name`, `assessment_code`, `criteria`, `description`, `percentage`, `range_type`, `marks_range`) VALUES
(26, 'CN5103', 'Operating Systems', '22', 'Project Plan and Proposed Solution', 'Relation being theory and practical work produced', 40, 'Yes', '5'),
(25, 'CN5103', 'Operating Systems', '22', 'Problem Definition and Literature Review', 'Understanding of topic area', 20, 'Yes', '3'),
(24, 'CN5103', 'Operating Systems', '22', 'Problem Definition and Literature Review', 'How well does the report identify the problem being invested?', 40, 'No', '3');

-- --------------------------------------------------------

--
-- Table structure for table `marking_scheme_marks`
--

CREATE TABLE `marking_scheme_marks` (
  `id` int(9) NOT NULL,
  `student_id` varchar(10) NOT NULL,
  `module_code` varchar(10) NOT NULL,
  `assessment_code` varchar(10) NOT NULL,
  `marker` varchar(250) NOT NULL,
  `mark_given` int(5) NOT NULL,
  `total_marks` int(5) NOT NULL,
  `feedback` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marking_scheme_marks`
--

INSERT INTO `marking_scheme_marks` (`id`, `student_id`, `module_code`, `assessment_code`, `marker`, `mark_given`, `total_marks`, `feedback`) VALUES
(39, 'u1407170', 'CN5103', '22', 's1', 1, 6, 'Good effort'),
(40, 'u1407170', 'CN5103', '22', 's1', 2, 6, 'Good effort'),
(41, 'u1407170', 'CN5103', '22', 's1', 3, 6, 'Good effort');

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
(66, 'CN5103', '18', 'exam', 'u1407170', 45, 0, 0, 45, 'Ok', 'Good attempt');

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `id` int(9) NOT NULL,
  `module_code` varchar(7) NOT NULL,
  `module_name` varchar(50) NOT NULL,
  `module_leader` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `level` varchar(25) NOT NULL,
  `assessment1` varchar(50) NOT NULL,
  `assessment2` varchar(50) NOT NULL,
  `assessment3` varchar(50) NOT NULL,
  `lecturers_linked` varchar(250) NOT NULL,
  `engagement_points` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `module_code`, `module_name`, `module_leader`, `description`, `level`, `assessment1`, `assessment2`, `assessment3`, `lecturers_linked`, `engagement_points`) VALUES
(1, 'CN5102', 'Software', 'a1', 'Advanced software module to help students improve java skills further before final year.', '4', '', '', '', '', ''),
(2, 'CN5103', 'Operating Systems', 's1', 'Scripting', '5', '18', '22', '', 'All Lecturers', ''),
(3, 'CN5101', 'Database', 's1', 'Database SQL tutorials', '5', '22', '', '', '', ''),
(15, 'CN5122', 'Data Comuncations', 's1', 'IP Addressing', '5', ' ', ' ', ' ', 'Supervisor', '');

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
  `level` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `username`, `password`, `rank`, `level`) VALUES
('u1309254', 'Student', 'Example', 'student@example.com', 'student', 'pass', 'Student', 5),
('a', 'Admin', 'Example', 'admin@example.co.uk', 'admin', 'Pass', 'Admin', 0),
('s', 'Supervisor', 'Example', 'super@example.com', 'super', 'Pass', 'Lecturer', 0),
('s1', 'usman', 'naeem', 'example@test.co.uk', 'usman', 'pass', 'lecturer', 0),
('a1', 'syed', 'islam', 'example@test.com', 'syed', 'pass', 'admin', 0),
('u1407170', 'assia', 'moujdi', 'test@example.com', 'assia', 'pass', 'student', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assessment`
--
ALTER TABLE `assessment`
  ADD PRIMARY KEY (`assessment_code`);

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
-- Indexes for table `marking_scheme_marks`
--
ALTER TABLE `marking_scheme_marks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`mark_id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assessment`
--
ALTER TABLE `assessment`
  MODIFY `assessment_code` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `lecturers`
--
ALTER TABLE `lecturers`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `marking_scheme`
--
ALTER TABLE `marking_scheme`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `marking_scheme_marks`
--
ALTER TABLE `marking_scheme_marks`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `mark_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
