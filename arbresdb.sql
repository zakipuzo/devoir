-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 31, 2021 at 06:18 PM
-- Server version: 5.7.32-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arbresdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `trees`
--

CREATE TABLE `trees` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `treeId` int(11) DEFAULT NULL,
  `node` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trees`
--

INSERT INTO `trees` (`id`, `name`, `treeId`, `node`) VALUES
(55, 'Animal', NULL, '55'),
(57, 'sauvage', 55, '55.57'),
(58, 'Domestique', 55, '55.58'),
(59, 'Chat', 58, '55.58.59'),
(60, 'chien', 58, '55.58.60'),
(61, 'Tigre', 57, '55.57.61'),
(62, 'Lion', 57, '55.57.62'),
(63, 'nouriture chien ', 60, '55.58.60.63'),
(64, 'croquettes', 63, '55.58.60.63.64'),
(65, 'zaza', 64, '55.58.60.63.64.65'),
(66, 'fsdfs', 65, '55.58.60.63.64.65.66'),
(67, 'dgsdgsd', 66, '55.58.60.63.64.65.66.67'),
(68, 'gsgs', 55, '55.68'),
(69, 'fgfgfd', 55, '55.69'),
(70, 'gfdgfdg', 55, '55.70'),
(71, 'zzzzaaa', 55, '55.71'),
(72, 'basta', 57, '55.57.72'),
(73, 'kkk', NULL, '73'),
(74, 'zz', 73, '73.74'),
(75, 'iii', 57, '55.57.75');

--
-- Triggers `trees`
--
DELIMITER $$
CREATE TRIGGER `nodetrigger` BEFORE INSERT ON `trees` FOR EACH ROW BEGIN  
DECLARE pnode varchar(600);
select node into pnode from trees where id=NEW.treeId;
IF NEW.treeId IS NULL THEN
SET NEW.node=(SELECT `AUTO_INCREMENT`  
FROM  INFORMATION_SCHEMA.TABLES
WHERE TABLE_SCHEMA = 'arbresdb'
AND   TABLE_NAME   = 'trees');
ELSE
SET NEW.node=CONCAT(pnode,'.',(SELECT `AUTO_INCREMENT`  
FROM  INFORMATION_SCHEMA.TABLES
WHERE TABLE_SCHEMA = 'arbresdb'
AND   TABLE_NAME   = 'trees'));
 END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `trees`
--
ALTER TABLE `trees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `treeId` (`treeId`),
  ADD KEY `node` (`node`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `trees`
--
ALTER TABLE `trees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `trees`
--
ALTER TABLE `trees`
  ADD CONSTRAINT `trees_ibfk_1` FOREIGN KEY (`treeId`) REFERENCES `trees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
