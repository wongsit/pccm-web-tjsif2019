-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2019 at 12:11 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pcshsm_tjsif2019`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_comment`
--

CREATE TABLE `tb_comment` (
  `id` int(11) NOT NULL,
  `text` mediumtext NOT NULL,
  `project` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_country`
--

CREATE TABLE `tb_country` (
  `id` varchar(2) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_country`
--

INSERT INTO `tb_country` (`id`, `name`) VALUES
('JP', 'Japan'),
('TH', 'Thailand');

-- --------------------------------------------------------

--
-- Table structure for table `tb_fieldtrip`
--

CREATE TABLE `tb_fieldtrip` (
  `id` int(2) NOT NULL,
  `name` varchar(50) NOT NULL COMMENT 'ชื่อทริป',
  `max` int(4) NOT NULL COMMENT 'จำนวนรับได้สูงสุด',
  `select` int(4) NOT NULL COMMENT 'จำนวนคนที่เลือก',
  `about` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_fieldtrip`
--

INSERT INTO `tb_fieldtrip` (`id`, `name`, `max`, `select`, `about`) VALUES
(1, 'Wind Turbine for Electricity', 150, 0, 'To study the principle of generating electricity by using wind turbines and do activities to create wind turbine models to measure wind and electricity.'),
(2, 'Phu Pha Terb National Park', 150, 0, 'study the changes of the crust and the shape of various types of rocks and do activities by using sensors to measure light intensity, humidity, temperature at Phu Pha Terb National Park.'),
(3, 'Thai-Laos Friendship Bridge Mukdahan', 150, 0, 'To study the properties of water in the Mekong River by using various types of sensors such as temperature, pH and the concentration of magnesium ions via application.');

-- --------------------------------------------------------

--
-- Table structure for table `tb_files`
--

CREATE TABLE `tb_files` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `project_id` int(11) NOT NULL,
  `download` int(11) NOT NULL,
  `update_ip` varchar(20) NOT NULL,
  `update_name` varchar(50) NOT NULL,
  `update_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_files_comment`
--

CREATE TABLE `tb_files_comment` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `project_id` int(11) NOT NULL,
  `status` int(1) NOT NULL COMMENT '0=comment, 1=edit',
  `download` int(11) NOT NULL,
  `update_ip` varchar(20) NOT NULL,
  `update_name` varchar(50) NOT NULL,
  `update_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_foods`
--

CREATE TABLE `tb_foods` (
  `id` int(1) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_foods`
--

INSERT INTO `tb_foods` (`id`, `name`) VALUES
(1, 'No'),
(2, 'Seafood'),
(3, 'Beef'),
(4, 'Halal'),
(5, 'Vegetarian'),
(99, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `tb_forgot`
--

CREATE TABLE `tb_forgot` (
  `id` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `token` varchar(70) NOT NULL,
  `used` int(1) NOT NULL DEFAULT 0,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_gender`
--

CREATE TABLE `tb_gender` (
  `id` int(1) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_gender`
--

INSERT INTO `tb_gender` (`id`, `name`) VALUES
(1, 'Not specified'),
(2, 'Male'),
(3, 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `tb_invite`
--

CREATE TABLE `tb_invite` (
  `id` int(11) NOT NULL,
  `make` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `token` varchar(70) NOT NULL,
  `used` int(1) NOT NULL DEFAULT 0,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_notify`
--

CREATE TABLE `tb_notify` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `detail` varchar(200) NOT NULL,
  `link` varchar(200) NOT NULL,
  `update_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_occ_type`
--

CREATE TABLE `tb_occ_type` (
  `id` int(2) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_occ_type`
--

INSERT INTO `tb_occ_type` (`id`, `name`) VALUES
(1, 'Student'),
(2, 'Teacher'),
(3, 'Professor'),
(4, 'Deputy'),
(5, 'Director'),
(6, 'JOVC/JICA'),
(7, 'NP/JF'),
(99, 'The other');

-- --------------------------------------------------------

--
-- Table structure for table `tb_org`
--

CREATE TABLE `tb_org` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `shortname` varchar(30) NOT NULL,
  `address1` varchar(60) NOT NULL,
  `address2` varchar(60) NOT NULL,
  `city` varchar(30) NOT NULL,
  `province` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `fax` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `homepage` varchar(50) NOT NULL,
  `type` int(11) NOT NULL,
  `sister` varchar(50) NOT NULL,
  `about` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `update_ip` varchar(20) NOT NULL,
  `update_name` varchar(30) NOT NULL,
  `update_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Organization';

-- --------------------------------------------------------

--
-- Table structure for table `tb_org_type`
--

CREATE TABLE `tb_org_type` (
  `id` int(2) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_org_type`
--

INSERT INTO `tb_org_type` (`id`, `name`) VALUES
(1, '12 PCSH School'),
(2, 'SSH School in Japan'),
(3, 'Sister School in Thai'),
(4, 'SH School in Thai'),
(5, 'KOSEN College in Japan'),
(10, 'University'),
(20, 'Government'),
(30, 'Company'),
(99, 'The other');

-- --------------------------------------------------------

--
-- Table structure for table `tb_people_type`
--

CREATE TABLE `tb_people_type` (
  `id` int(2) NOT NULL,
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_people_type`
--

INSERT INTO `tb_people_type` (`id`, `name`) VALUES
(1, 'Participant'),
(2, 'Contact person'),
(3, 'Contact person (Not attendee)'),
(4, 'Operation staff'),
(5, 'Observer'),
(29, 'Participant (Not attendee)');

-- --------------------------------------------------------

--
-- Table structure for table `tb_project`
--

CREATE TABLE `tb_project` (
  `id` int(11) NOT NULL,
  `name` varchar(220) NOT NULL,
  `concept` mediumtext NOT NULL,
  `objective` mediumtext NOT NULL,
  `category_id` int(4) NOT NULL,
  `style_id` int(3) NOT NULL,
  `org_id` int(3) NOT NULL,
  `students` varchar(255) NOT NULL,
  `teachers` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `files` varchar(255) NOT NULL,
  `update_ip` varchar(20) NOT NULL,
  `update_name` varchar(50) NOT NULL,
  `update_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_project_style`
--

CREATE TABLE `tb_project_style` (
  `id` int(2) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_project_style`
--

INSERT INTO `tb_project_style` (`id`, `name`) VALUES
(1, 'Oral and poster'),
(2, 'Oral only'),
(3, 'Poster only');

-- --------------------------------------------------------

--
-- Table structure for table `tb_project_type`
--

CREATE TABLE `tb_project_type` (
  `id` int(2) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_project_type`
--

INSERT INTO `tb_project_type` (`id`, `name`) VALUES
(1, 'IoT Application'),
(2, 'Robotics'),
(3, 'Automotive'),
(4, 'Software'),
(5, 'Smart Electronic'),
(6, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `tb_site`
--

CREATE TABLE `tb_site` (
  `id` int(3) NOT NULL,
  `name` varchar(200) NOT NULL COMMENT 'ชื่อเว็บ',
  `address` varchar(255) NOT NULL COMMENT 'ที่อยู่',
  `phone` varchar(15) NOT NULL COMMENT 'โทร',
  `email` varchar(50) NOT NULL COMMENT 'เมล์',
  `open_register` date NOT NULL COMMENT 'วันเปิดลงทะเบียน',
  `close_register` date NOT NULL COMMENT 'วันปิดลงทะเบียน',
  `close_abstract` date NOT NULL COMMENT 'วันปิดเอกสารบทคัดย่อ',
  `close_fullpaper` date NOT NULL COMMENT 'วันปิดเอกสาร fullpaper'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_site`
--

INSERT INTO `tb_site` (`id`, `name`, `address`, `phone`, `email`, `open_register`, `close_register`, `close_abstract`, `close_fullpaper`) VALUES
(1, 'Thailand Japan Student ICT Fair 2019', 'Mukdahan Thailand', '', 'tjsif2019@pccm.ac.th', '2019-04-01', '2019-07-13', '2019-07-15', '2019-07-31');

-- --------------------------------------------------------

--
-- Table structure for table `tb_title`
--

CREATE TABLE `tb_title` (
  `id` int(1) NOT NULL,
  `name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_title`
--

INSERT INTO `tb_title` (`id`, `name`) VALUES
(1, 'Mr.'),
(2, 'Ms.'),
(3, 'Mrs.'),
(4, 'Miss.'),
(5, 'Dr.');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(70) NOT NULL,
  `title` int(11) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `nickname` varchar(30) NOT NULL,
  `gender` int(11) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `address1` varchar(60) NOT NULL,
  `address2` varchar(60) NOT NULL,
  `city` varchar(30) NOT NULL,
  `province` varchar(30) NOT NULL,
  `country` varchar(5) NOT NULL,
  `zip` varchar(30) NOT NULL,
  `chronic` varchar(60) NOT NULL,
  `allergies` varchar(60) NOT NULL,
  `food` int(11) NOT NULL,
  `food_other` varchar(60) NOT NULL,
  `type` int(11) NOT NULL,
  `occ_id` int(3) NOT NULL,
  `org_id` int(3) NOT NULL,
  `position` varchar(30) NOT NULL,
  `trip` int(1) DEFAULT NULL,
  `about` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `update_time` datetime NOT NULL,
  `update_ip` varchar(20) NOT NULL,
  `update_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id`, `email`, `password`, `title`, `firstname`, `middlename`, `lastname`, `nickname`, `gender`, `tel`, `address1`, `address2`, `city`, `province`, `country`, `zip`, `chronic`, `allergies`, `food`, `food_other`, `type`, `occ_id`, `org_id`, `position`, `trip`, `about`, `active`, `update_time`, `update_ip`, `update_name`) VALUES
(1, 'w.khanchai@pccm.ac.th', '$2y$10$4r9nNj4yspiLVhAfjdKJ5u1VyHUC3fN/gLpAVcebpmMzf6MckSjpm', 1, 'khanchai', 'new', 'wongsit', 'mai', 2, '0883779930', '281', 'BangSaiYai', 'warnyai', 'mukdahan', 'TH', '49000', 'no', 'no', 1, '', 4, 2, 1, 'B', NULL, 'I am IT Support. I working in PCSHSM School.', 0, '2019-07-31 10:04:23', '159.192.103.98', 'khanchai');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_comment`
--
ALTER TABLE `tb_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_country`
--
ALTER TABLE `tb_country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_fieldtrip`
--
ALTER TABLE `tb_fieldtrip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_files`
--
ALTER TABLE `tb_files`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `tb_files_comment`
--
ALTER TABLE `tb_files_comment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `tb_foods`
--
ALTER TABLE `tb_foods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_forgot`
--
ALTER TABLE `tb_forgot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_gender`
--
ALTER TABLE `tb_gender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_invite`
--
ALTER TABLE `tb_invite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_notify`
--
ALTER TABLE `tb_notify`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_occ_type`
--
ALTER TABLE `tb_occ_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_org`
--
ALTER TABLE `tb_org`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_org_type`
--
ALTER TABLE `tb_org_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_people_type`
--
ALTER TABLE `tb_people_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_project`
--
ALTER TABLE `tb_project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_project_style`
--
ALTER TABLE `tb_project_style`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_project_type`
--
ALTER TABLE `tb_project_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_site`
--
ALTER TABLE `tb_site`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_title`
--
ALTER TABLE `tb_title`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_comment`
--
ALTER TABLE `tb_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_fieldtrip`
--
ALTER TABLE `tb_fieldtrip`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_files`
--
ALTER TABLE `tb_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_files_comment`
--
ALTER TABLE `tb_files_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_foods`
--
ALTER TABLE `tb_foods`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `tb_forgot`
--
ALTER TABLE `tb_forgot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_gender`
--
ALTER TABLE `tb_gender`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_invite`
--
ALTER TABLE `tb_invite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_notify`
--
ALTER TABLE `tb_notify`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_occ_type`
--
ALTER TABLE `tb_occ_type`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `tb_org`
--
ALTER TABLE `tb_org`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_org_type`
--
ALTER TABLE `tb_org_type`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `tb_people_type`
--
ALTER TABLE `tb_people_type`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tb_project`
--
ALTER TABLE `tb_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_project_style`
--
ALTER TABLE `tb_project_style`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_project_type`
--
ALTER TABLE `tb_project_type`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_site`
--
ALTER TABLE `tb_site`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_title`
--
ALTER TABLE `tb_title`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
