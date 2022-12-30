-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2022 at 01:33 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

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

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `createExam` (IN `prof_id` INT(11), IN `extitle` VARCHAR(250), IN `totalquest` INT(11), IN `markright` INT, IN `markwrong` INT, IN `created_at` VARCHAR(250))  NO SQL
INSERT INTO `online_exam`(`prof_id`, `exam_title`, `total_ques`, `marks_per_right_answer`, `marks_per_wrong_answer`, `creat_on`) VALUES (prof_id,extitle,totalquest,markright,markwrong,created_at)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Display_all_student_of_specific_prof` (IN `stu_id` INT)  SELECT * FROM student WHERE stu_id = stu_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `remove` (IN `table_selection` VARCHAR(50), IN `column_selection` VARCHAR(50), IN `exam_id` INT)  BEGIN
	SET @A:= CONCAT('DELETE FROM',' ',table_selection, ' ', 'WHERE ',column_selection,'= ',exam_id);
    PREPARE stmt FROM @A;
    EXECUTE stmt;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updatePassword` (IN `table_selection` VARCHAR(50), IN `pass_col` VARCHAR(50), IN `newPassword` VARCHAR(50), IN `column_selection` VARCHAR(50), IN `col_val` INT)  BEGIN
	SET @A:= CONCAT('UPDATE',' ',table_selection,' ','set',' ',pass_col,'=',newPassword,' WHERE ',' ',column_selection,'=',col_val);
    PREPARE stmt FROM @A;
    EXECUTE stmt;
END$$

DELIMITER ;

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

-- --------------------------------------------------------

--
-- Table structure for table `prof_student`
--

CREATE TABLE `prof_student` (
  `prof_student_id` int(11) NOT NULL,
  `prof_id` int(11) NOT NULL,
  `stu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `stu_id` int(11) NOT NULL,
  `ID` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `old_pass` varchar(255) DEFAULT NULL,
  `last_up` varchar(255) DEFAULT NULL,
  `gender` int(11) NOT NULL DEFAULT 0,
  `collge` int(11) NOT NULL DEFAULT 0,
  `level` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `creat_on` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  MODIFY `fed_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `no_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `online_exam`
--
ALTER TABLE `online_exam`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prof`
--
ALTER TABLE `prof`
  MODIFY `prof_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prof_student`
--
ALTER TABLE `prof_student`
  MODIFY `prof_student_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quest_exam`
--
ALTER TABLE `quest_exam`
  MODIFY `quest_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `stu_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_exam_answer`
--
ALTER TABLE `user_exam_answer`
  MODIFY `user_exam_answer` int(11) NOT NULL AUTO_INCREMENT;

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
