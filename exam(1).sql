-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2020 at 07:21 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exam`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `fed_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `prof_id` int(11) NOT NULL,
  `stud_id` int(11) NOT NULL,
  `fed_data` varchar(255) NOT NULL,
  `fed_rate` int(11) NOT NULL,
  `fed_con` varchar(255) NOT NULL,
  `fed_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`fed_id`, `exam_id`, `prof_id`, `stud_id`, `fed_data`, `fed_rate`, `fed_con`, `fed_status`) VALUES
(88, 28, 1, 17, '2020-11 Thu 09:55 AM', 2, 'Is not difficulty', 1),
(90, 31, 1, 4, '2020-11 Thu 11:55 AM', 5, 'This is easy exam', 1),
(91, 31, 1, 6, '2020-11 Thu 11:56 AM', 2, 'This acceptable exam', 1),
(92, 31, 1, 16, '2020-11 Thu 11:59 AM', 3, 'This contains some difficult questions', 1),
(93, 31, 1, 17, '2020-11 Thu 12:04 PM', 1, 'fffffffffffffff', 1),
(94, 31, 1, 18, '2020-11 Thu 12:05 PM', 4, 'dddddddddddddddddddd', 1),
(95, 31, 1, 3, '2020-11 Thu 12:07 PM', 2, 'qqqqqqqqqqq', 1),
(96, 32, 1, 3, '2020-11 Thu 12:30 PM', 1, 'no feedack', 1),
(97, 33, 1, 3, '2020-11 Thu 12:30 PM', 5, 'no feedack', 1),
(98, 34, 1, 3, '2020-11 Fri 08:07 PM', 4, 'Hello sir, this is good exam', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `no_id` int(11) NOT NULL,
  `prof_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `std_id` int(11) NOT NULL,
  `no_date` varchar(255) NOT NULL,
  `con_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`no_id`, `prof_id`, `exam_id`, `std_id`, `no_date`, `con_status`) VALUES
(27, 1, 31, 3, '2020 Nov-12', 1),
(28, 1, 31, 4, '2020 Nov-12', 1),
(29, 1, 31, 6, '2020 Nov-12', 1),
(30, 1, 31, 16, '2020 Nov-12', 1),
(31, 1, 31, 17, '2020 Nov-12', 1),
(32, 1, 31, 18, '2020 Nov-12', 1),
(33, 1, 32, 3, '2020 Nov-12', 1),
(34, 1, 32, 4, '2020 Nov-12', 0),
(35, 1, 32, 6, '2020 Nov-12', 0),
(36, 1, 32, 16, '2020 Nov-12', 0),
(37, 1, 32, 17, '2020 Nov-12', 0),
(38, 1, 32, 18, '2020 Nov-12', 0),
(39, 1, 33, 3, '2020 Nov-12', 1),
(40, 1, 33, 4, '2020 Nov-12', 0),
(41, 1, 33, 6, '2020 Nov-12', 0),
(42, 1, 33, 16, '2020 Nov-12', 0),
(43, 1, 33, 17, '2020 Nov-12', 0),
(44, 1, 33, 18, '2020 Nov-12', 0),
(45, 1, 34, 3, 'Nov-13 07:54:24 PM', 1),
(46, 1, 34, 4, 'Nov-13 07:54:24 PM', 0),
(47, 1, 34, 6, 'Nov-13 07:54:24 PM', 0),
(48, 1, 34, 16, 'Nov-13 07:54:24 PM', 0),
(49, 1, 34, 17, 'Nov-13 07:54:24 PM', 0),
(50, 1, 34, 18, 'Nov-13 07:54:24 PM', 0);

-- --------------------------------------------------------

--
-- Table structure for table `online_exam`
--

CREATE TABLE `online_exam` (
  `exam_id` int(11) NOT NULL,
  `prof_id` int(11) NOT NULL,
  `exam_title` varchar(255) NOT NULL,
  `total_ques` int(11) NOT NULL,
  `marks_per_right_answer` float NOT NULL,
  `marks_per_wrong_answer` float NOT NULL,
  `creat_on` varchar(255) NOT NULL,
  `exam_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `online_exam`
--

INSERT INTO `online_exam` (`exam_id`, `prof_id`, `exam_title`, `total_ques`, `marks_per_right_answer`, `marks_per_wrong_answer`, `creat_on`, `exam_status`) VALUES
(18, 22, 'jqurey', 2, 1.5, 1, '13-Oct 2020 at 11:59 PM', 0),
(28, 1, 'javascript', 2, 1.5, 1, '03-Nov 2020 at 12:22 PM', 1),
(29, 21, 'html', 2, 2, 1, '03-Nov 2020 at 05:17 PM', 1),
(31, 1, 'java', 2, 1.5, 1, '12-Nov 2020 at 11:46 AM', 1),
(32, 1, 'infomations tech', 2, 1.5, 1, '12-Nov 2020 at 12:28 PM', 1),
(33, 1, 'management ', 2, 1.5, 1, '12-Nov 2020 at 12:29 PM', 1),
(34, 1, 'oop', 2, 3, 1, '13-Nov 2020 at 07:53 PM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `option_id` int(11) NOT NULL,
  `quest_id` int(11) NOT NULL,
  `option_exam_id` int(11) NOT NULL,
  `option_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`option_id`, `quest_id`, `option_exam_id`, `option_title`) VALUES
(37714, 89, 28, '1'),
(37715, 89, 28, '2'),
(37716, 89, 28, '3'),
(37717, 89, 28, '4'),
(37718, 90, 28, '4'),
(37719, 90, 28, '2'),
(37720, 90, 28, '3'),
(37721, 90, 28, '1'),
(37722, 91, 29, '10'),
(37723, 91, 29, '25'),
(37724, 91, 29, '11'),
(37725, 91, 29, '12'),
(37726, 92, 29, '1'),
(37727, 92, 29, '2'),
(37728, 92, 29, '3'),
(37729, 92, 29, '4'),
(37738, 95, 31, '1'),
(37739, 95, 31, '0'),
(37740, 95, 31, '2'),
(37741, 95, 31, '3'),
(37742, 96, 31, '1'),
(37743, 96, 31, '2'),
(37744, 96, 31, '3'),
(37745, 96, 31, '4'),
(37746, 97, 32, '25'),
(37747, 97, 32, '1'),
(37748, 97, 32, '2'),
(37749, 97, 32, '3'),
(37750, 98, 32, 'a'),
(37751, 98, 32, 'b'),
(37752, 98, 32, 'c'),
(37753, 98, 32, 'd'),
(37754, 99, 33, '1'),
(37755, 99, 33, '2'),
(37756, 99, 33, '3'),
(37757, 99, 33, '4'),
(37758, 100, 33, '0'),
(37759, 100, 33, '1'),
(37760, 100, 33, '2'),
(37761, 100, 33, '3'),
(37762, 101, 34, '25'),
(37763, 101, 34, '10'),
(37764, 101, 34, '12'),
(37765, 101, 34, '11'),
(37766, 102, 34, '2'),
(37767, 102, 34, '1'),
(37768, 102, 34, '4'),
(37769, 102, 34, '7');

-- --------------------------------------------------------

--
-- Table structure for table `prof`
--

CREATE TABLE `prof` (
  `prof_id` int(11) NOT NULL,
  `prof_name` varchar(255) NOT NULL,
  `prof_pass` varchar(255) NOT NULL,
  `gender` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prof`
--

INSERT INTO `prof` (`prof_id`, `prof_name`, `prof_pass`, `gender`) VALUES
(1, 'mahmoud', '1234', 1),
(2, 'ahmed elsayed', '123', 1),
(3, 'ahmed ziad', '123', 1),
(4, 'hossam ziad', '123', 1),
(5, 'mona ismail', '123', 2),
(6, 'hassan ahmed', '123', 1),
(7, 'mostafa elsayed', '123', 1),
(8, 'ahmed elztyeb', '123', 1),
(9, 'gomaa ziad', '123', 1),
(10, 'mai mostafa', '123', 2),
(11, 'marwa ahmed', '123', 1),
(12, 'nabile elsayed', '123', 1),
(13, 'asmaa ahmed', '123', 2),
(14, 'nermmen elsayed', '123', 2),
(15, 'nagwa basher', '123', 2),
(16, 'hatem ashef', '123', 1),
(17, 'youseef elsayed', '123', 1),
(18, 'simar ahed', '123', 1),
(19, 'nour elshref', '123', 2),
(20, 'esrra magdy', '123', 2),
(21, 'hassan yaqab', '123', 1),
(22, 'mahmoud elsayed', '123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `prof_student`
--

CREATE TABLE `prof_student` (
  `prof_student_id` int(11) NOT NULL,
  `prof_id` int(11) NOT NULL,
  `stu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prof_student`
--

INSERT INTO `prof_student` (`prof_student_id`, `prof_id`, `stu_id`) VALUES
(2, 1, 3),
(3, 1, 4),
(4, 1, 6),
(5, 2, 6),
(6, 2, 12),
(7, 2, 19),
(8, 2, 13),
(9, 3, 3),
(10, 1, 16),
(11, 1, 17),
(12, 1, 18),
(13, 8, 3),
(14, 21, 3);

-- --------------------------------------------------------

--
-- Table structure for table `quest_exam`
--

CREATE TABLE `quest_exam` (
  `quest_id` int(11) NOT NULL,
  `online_exam_id` int(11) NOT NULL,
  `question_title` varchar(255) NOT NULL,
  `anwser_quest` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quest_exam`
--

INSERT INTO `quest_exam` (`quest_id`, `online_exam_id`, `question_title`, `anwser_quest`) VALUES
(89, 28, '1*2', 2),
(90, 28, '2*2', 1),
(91, 29, '5*5', 2),
(92, 29, '1*1', 1),
(95, 31, '!true', 2),
(96, 31, 'true', 1),
(97, 32, '5*5', 1),
(98, 32, 'B', 2),
(99, 33, 'true == ?', 1),
(100, 33, 'false == ?', 1),
(101, 34, '5*5', 1),
(102, 34, '2*1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `stu_id` int(11) NOT NULL,
  `ID` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `old_pass` varchar(255) NOT NULL,
  `last_up` varchar(255) NOT NULL,
  `gender` int(11) NOT NULL DEFAULT 0,
  `collge` int(11) NOT NULL DEFAULT 0,
  `level` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `creat_on` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`stu_id`, `ID`, `username`, `password`, `old_pass`, `last_up`, `gender`, `collge`, `level`, `address`, `mobile`, `creat_on`) VALUES
(3, '1-it-4', 'mahmoud khairy', '123', '1234', '2020-Nov 01', 1, 1, 4, 'assuit', '01143124020', '10-oct 2020 at 2:55PM'),
(4, '2-cs-4', 'mahmoud mohmmed', '123', '1', '', 1, 1, 4, 'assuit', '01143122040', '10-oct 2020 at 3:49AM'),
(6, '3-cs-4', 'mohmed elayed', '123', '', '', 1, 1, 4, 'shoag', '01123456789', '9-jan 2020 3:15PM'),
(11, '7-cs-4', 'mohmed elayed', '123', '', '', 1, 1, 4, 'shoag', '01123456789', '9-jan 2020 3:15PM'),
(12, '4-mm-3', 'mohmed elayed', '123', '', '', 1, 1, 3, 'shoag', '01123456789', '9-jan 2020 3:15PM'),
(13, '5-cs-4', 'mohmed elayed', '123', '', '', 1, 1, 4, 'shoag', '01123456789', '9-jan 2020 3:15PM'),
(14, '6-cs-4', 'mohmed elayed', '123', '', '', 1, 1, 4, 'shoag', '01123456789', '9-jan 2020 3:15PM'),
(15, '4-it-3', 'mohmed ashraf', '123', '', '', 1, 1, 3, 'aswan', '01123456789', '25-mar 2020 3:15PM'),
(16, '3-cs-3', 'mohmed magdy', '123', '', '', 1, 1, 4, 'alex', '01123456789', '9-jan 2020 3:15PM'),
(17, '1-si-4', 'mona elayed', '123', '', '', 2, 2, 4, 'shoag', '01123456789', '9-jan 2020 3:15PM'),
(18, '3-mm-4', 'mohmed moner', '123', '', '', 1, 1, 4, 'shoag', '01123456789', '9-jan 2020 3:15PM'),
(19, '4-si-3', 'ahmed mostafa', '123', '', '', 1, 2, 4, 'shoag', '01123456789', '9-jan 2020 3:20PM');

-- --------------------------------------------------------

--
-- Table structure for table `user_exam_answer`
--

CREATE TABLE `user_exam_answer` (
  `user_exam_answer` int(11) NOT NULL,
  `stud_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `user_answer_option` int(11) NOT NULL,
  `mark_per_question` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_exam_answer`
--

INSERT INTO `user_exam_answer` (`user_exam_answer`, `stud_id`, `exam_id`, `question_id`, `user_answer_option`, `mark_per_question`) VALUES
(81, 3, 29, 91, 2, 2),
(82, 3, 29, 92, 1, 2),
(105, 17, 28, 89, 2, 1.5),
(106, 17, 28, 90, 1, 1.5),
(109, 4, 31, 95, 2, 1.5),
(110, 4, 31, 96, 1, 1.5),
(111, 6, 31, 95, 4, -1),
(112, 6, 31, 96, 1, 1.5),
(113, 16, 31, 95, 2, 1.5),
(114, 16, 31, 96, 1, 1.5),
(115, 17, 31, 95, 4, -1),
(116, 17, 31, 96, 1, 1.5),
(117, 18, 31, 95, 2, 1.5),
(118, 18, 31, 96, 1, 1.5),
(119, 3, 31, 95, 2, 1.5),
(120, 3, 31, 96, 1, 1.5),
(121, 3, 32, 97, 1, 1.5),
(122, 3, 32, 98, 2, 1.5),
(123, 3, 33, 99, 1, 1.5),
(124, 3, 33, 100, 1, 1.5),
(125, 3, 34, 101, 1, 3),
(126, 3, 34, 102, 1, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`fed_id`),
  ADD KEY `exam_id` (`exam_id`),
  ADD KEY `prof_id` (`prof_id`),
  ADD KEY `stud_id` (`stud_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`no_id`),
  ADD KEY `prof_id` (`prof_id`),
  ADD KEY `exam_id` (`exam_id`),
  ADD KEY `std_id` (`std_id`);

--
-- Indexes for table `online_exam`
--
ALTER TABLE `online_exam`
  ADD PRIMARY KEY (`exam_id`),
  ADD KEY `prof_id` (`prof_id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`option_id`),
  ADD KEY `quest_id` (`quest_id`),
  ADD KEY `option_exam_id` (`option_exam_id`);

--
-- Indexes for table `prof`
--
ALTER TABLE `prof`
  ADD PRIMARY KEY (`prof_id`),
  ADD UNIQUE KEY `prof_name` (`prof_name`);

--
-- Indexes for table `prof_student`
--
ALTER TABLE `prof_student`
  ADD PRIMARY KEY (`prof_student_id`),
  ADD KEY `prof_id` (`prof_id`),
  ADD KEY `stu_id` (`stu_id`);

--
-- Indexes for table `quest_exam`
--
ALTER TABLE `quest_exam`
  ADD PRIMARY KEY (`quest_id`),
  ADD KEY `online_exam_id` (`online_exam_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`stu_id`),
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indexes for table `user_exam_answer`
--
ALTER TABLE `user_exam_answer`
  ADD PRIMARY KEY (`user_exam_answer`),
  ADD KEY `exam_id` (`exam_id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `stud_id` (`stud_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `fed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `no_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `online_exam`
--
ALTER TABLE `online_exam`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37770;

--
-- AUTO_INCREMENT for table `prof`
--
ALTER TABLE `prof`
  MODIFY `prof_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `prof_student`
--
ALTER TABLE `prof_student`
  MODIFY `prof_student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `quest_exam`
--
ALTER TABLE `quest_exam`
  MODIFY `quest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `stu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_exam_answer`
--
ALTER TABLE `user_exam_answer`
  MODIFY `user_exam_answer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `exam_id` FOREIGN KEY (`exam_id`) REFERENCES `online_exam` (`exam_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prof_id` FOREIGN KEY (`prof_id`) REFERENCES `prof` (`prof_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stud_id` FOREIGN KEY (`stud_id`) REFERENCES `student` (`stu_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`prof_id`) REFERENCES `prof` (`prof_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`exam_id`) REFERENCES `online_exam` (`exam_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notification_ibfk_3` FOREIGN KEY (`std_id`) REFERENCES `student` (`stu_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `online_exam`
--
ALTER TABLE `online_exam`
  ADD CONSTRAINT `online_exam_ibfk_1` FOREIGN KEY (`prof_id`) REFERENCES `prof` (`prof_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `options_ibfk_1` FOREIGN KEY (`quest_id`) REFERENCES `quest_exam` (`quest_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `options_ibfk_2` FOREIGN KEY (`option_exam_id`) REFERENCES `online_exam` (`exam_id`);

--
-- Constraints for table `prof_student`
--
ALTER TABLE `prof_student`
  ADD CONSTRAINT `prof_student_ibfk_1` FOREIGN KEY (`prof_id`) REFERENCES `prof` (`prof_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prof_student_ibfk_2` FOREIGN KEY (`stu_id`) REFERENCES `student` (`stu_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quest_exam`
--
ALTER TABLE `quest_exam`
  ADD CONSTRAINT `quest_exam_ibfk_1` FOREIGN KEY (`online_exam_id`) REFERENCES `online_exam` (`exam_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_exam_answer`
--
ALTER TABLE `user_exam_answer`
  ADD CONSTRAINT `user_exam_answer_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `online_exam` (`exam_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_exam_answer_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `quest_exam` (`quest_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_exam_answer_ibfk_3` FOREIGN KEY (`stud_id`) REFERENCES `student` (`stu_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
