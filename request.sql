-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2024 at 12:36 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `request`
--

-- --------------------------------------------------------

--
-- Table structure for table `human`
--

CREATE TABLE `human` (
  `name_user` text NOT NULL,
  `type_request` varchar(255) NOT NULL,
  `Director_Human` varchar(255) NOT NULL,
  `Date_Human_res` date NOT NULL,
  `Date_request` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `name_user` text NOT NULL,
  `type_request` varchar(255) NOT NULL,
  `Director_approval` varchar(255) NOT NULL,
  `date_Director` date NOT NULL,
  `date_request` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `time_vacation`
--

CREATE TABLE `time_vacation` (
  `id_user` int(11) NOT NULL,
  `Date_sub` date NOT NULL,
  `hour_age` time NOT NULL,
  `up_tohour` time NOT NULL,
  `Date_time` date NOT NULL,
  `type_time_vacation` text NOT NULL,
  `reason` text DEFAULT NULL,
  `Director_approval` varchar(255) DEFAULT NULL,
  `name_manager` text DEFAULT NULL,
  `signature_manager` text DEFAULT NULL,
  `date_manager` text DEFAULT NULL,
  `Human_resources` text DEFAULT NULL,
  `time_Human` text DEFAULT NULL,
  `request_type` text DEFAULT NULL,
  `id_vacation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `time_vacation`
--

INSERT INTO `time_vacation` (`id_user`, `Date_sub`, `hour_age`, `up_tohour`, `Date_time`, `type_time_vacation`, `reason`, `Director_approval`, `name_manager`, `signature_manager`, `date_manager`, `Human_resources`, `time_Human`, `request_type`, `id_vacation`) VALUES
(1, '2024-09-18', '17:49:00', '15:52:00', '2024-09-26', 'شخصي', '200', 'موافق', 'mohammed', 'imge/new.png', '2024-09-18', 'غير موافق', '2024-09-18', ' طلب اجازه زمنيه ', 2),
(3, '2024-09-18', '05:51:00', '00:57:00', '2024-10-01', 'عمل', 'ghvghghcggcfg', 'موافق', 'mohammed', 'imge/new.png', '2024-09-18', 'موافق', '2024-09-18', ' طلب اجازه زمنيه ', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `Lip_type` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `employee_name` text NOT NULL,
  `employee_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `Lip_type`, `job_title`, `employee_name`, `employee_img`) VALUES
(1, 'محمد المنتظر جمعه', 'alial778810@gmail.com', '@$12345@$12345', 'صباحي', 'برمجه', 'imge/Autograph_of_Benjamin_Franklin.svg.png', 'imge/Autograph_of_Benjamin_Franklin.svg.png'),
(2, 'mohammed', 'm@gmail.com', '12345', 'صباحي', 'مدير', 'imge/new.png', 'imge/new.png'),
(3, 'mohammed', 'mk8l9a0@gmail.com', '1234512345', 'مسائي', 'برمجه', 'imge/new.png', 'imge/new.png'),
(4, 'محمد المنتظر', 'm19@gmail.com', '1234512345', 'صباحي', 'مدير الموارد البشرية', 'imge/Autograph_of_Benjamin_Franklin.svg.png', 'imge/Autograph_of_Benjamin_Franklin.svg.png');

-- --------------------------------------------------------

--
-- Table structure for table `vacation`
--

CREATE TABLE `vacation` (
  `id_user` int(11) NOT NULL,
  `Date_submitting` date NOT NULL,
  `start_date` date NOT NULL,
  `expiration_date` date NOT NULL,
  `num_of_day` int(11) NOT NULL,
  `type_vacation` text NOT NULL,
  `annual_balance` varchar(255) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `request_type` text DEFAULT NULL,
  `Director_approval` text DEFAULT NULL,
  `Manager_name` text DEFAULT NULL,
  `signature` text DEFAULT NULL,
  `Department_manager` text DEFAULT NULL,
  `Date_Department` date DEFAULT NULL,
  `Human_res` text DEFAULT NULL,
  `Date_Human_res` date DEFAULT NULL,
  `Date_Manager` text DEFAULT NULL,
  `id_vacation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vacation`
--

INSERT INTO `vacation` (`id_user`, `Date_submitting`, `start_date`, `expiration_date`, `num_of_day`, `type_vacation`, `annual_balance`, `comments`, `request_type`, `Director_approval`, `Manager_name`, `signature`, `Department_manager`, `Date_Department`, `Human_res`, `Date_Human_res`, `Date_Manager`, `id_vacation`) VALUES
(1, '2024-09-16', '2024-09-24', '2024-09-25', 2, 'مرضية', 'null', 'ملاحظات اخرى :ghvhhvh', 'طلب اجازه  ', 'موافق', 'mohammed', 'imge/new.png', 'موافق', '2024-09-18', 'موافق', '2024-09-18', NULL, 1),
(1, '2024-09-16', '2024-09-24', '2024-10-04', 11, 'سنوية', '1', 'ملاحظات اخرى :nmnmmmmmmmmmmmmzzzzzzzzzz', 'طلب اجازه  ', 'موافق', 'mohammed', 'imge/new.png', 'موافق', '2024-09-18', 'غبر موافق', '2024-09-18', '2024-09-18', 2),
(1, '2024-09-16', '2024-09-25', '2024-09-30', 6, 'سنوية', '1', 'ملاحظات اخرى :300$', 'طلب اجازه  ', 'غير موافق', 'mohammed', 'imge/new.png', 'موافق', '2024-09-18', 'غير موافق', '2024-09-18', '2024-09-16', 3),
(1, '2024-09-16', '2024-09-23', '2024-09-27', 5, 'مرضية', 'null', 'ملاحظات اخرى :400$', 'طلب اجازه  ', 'غير موافق', 'ali', 'imge/new.png', 'غير موافق', '2024-09-18', 'موافق', '2024-09-18', '2024-09-16', 4),
(1, '2024-09-16', '2024-09-25', '2024-09-27', 3, 'مرضية', 'null', 'ملاحظات اخرى :f', 'طلب اجازه  ', 'غير موافق', 'mohammed', 'imge/new.png', 'غير موافق', '2024-09-18', 'غير موافق', '2024-09-18', '2024-09-16', 5),
(1, '2024-09-16', '2024-09-24', '2024-09-27', 4, 'سنوية', '1', 'null', 'طلب اجازه  ', 'غير موافق', 'mohammed', 'imge/new.png', 'غير موافق', '2024-09-18', 'موافق', '2024-09-18', '2024-09-16', 6),
(1, '2024-09-16', '2024-10-01', '2024-10-11', 11, 'مرضية', 'null', 'null', 'طلب اجازه  ', 'غير موافق', 'ali', 'imge/new.png', 'موافق', '2024-09-18', 'موافق', '2024-09-18', '2024-09-16', 7),
(1, '2024-09-17', '2024-09-23', '2024-09-27', 5, 'مرضية', 'null', 'ملاحظات اخرى :300$', 'طلب اجازه  ', 'غير موافق', 'mohammed', 'imge/new.png', 'موافق', '2024-09-18', 'غير موافق', '2024-09-18', '2024-09-17', 8),
(1, '2024-09-17', '2024-09-30', '2024-10-12', 13, 'سنوية', '1', 'ملاحظات اخرى :dghwdgvttygttttttt', 'طلب اجازه  ', 'غير موافق', 'mohammed', 'imge/new.png', 'موافق', '2024-09-18', 'موافق', '2024-09-18', '2024-09-17', 9),
(1, '2024-09-17', '2024-09-23', '2024-09-27', 5, 'سنوية', '1', 'ملاحظات اخرى :300', 'طلب اجازه  ', 'غير موافق', 'm', 'imge/new.png', 'موافق', '2024-09-18', 'غير موافق', '2024-09-18', '2024-09-17', 10),
(1, '2024-09-17', '2024-09-23', '2024-09-30', 8, 'سنوية', '1', 'ملاحظات اخرى :syjhxjhzscjhzajxa', 'طلب اجازه  ', 'غير موافق', 'mohammed', 'imge/new.png', 'موافق', '2024-09-18', 'موافق', '2024-09-18', '2024-09-17', 11),
(1, '2024-09-17', '2024-09-27', '2024-10-03', 7, 'سنوية', '1', 'ملاحظات اخرى :200$', 'طلب اجازه  ', 'غير موافق', 'mohammed', 'imge/new.png', 'موافق', '2024-09-18', 'غير موافق', '2024-09-18', '2024-09-17', 12),
(1, '2024-09-17', '2024-10-01', '2024-10-11', 11, 'مرضية', 'null', 'ملاحظات اخرى :tytyfyuggy', 'طلب اجازه  ', 'غير موافق', 'ghghvgh', 'imge/new.png', 'موافق', '2024-09-18', 'غير موافق', '2024-09-18', '2024-09-17', 13),
(1, '2024-09-17', '2024-10-01', '2024-10-10', 10, 'سنوية', '1', 'ملاحظات اخرى :fgyygyhbbhvxserrfcgvhioi8', 'طلب اجازه  ', 'غير موافق', 'ali', 'imge/new.png', 'موافق', '2024-09-18', 'غير موافق', '2024-09-18', '2024-09-17', 14),
(1, '2024-09-18', '2024-09-16', '2024-09-10', -5, 'سنوية', '1', 'ملاحظات اخرى :dachsbcf', 'طلب اجازه  ', 'موافق', 'mohammed', 'imge/new.png', 'قل اليوم هواي', '2024-09-18', 'غير موافق', '2024-09-18', '2024-09-18', 15),
(1, '2024-09-18', '2024-09-25', '2024-09-27', 3, 'سنوية', '1', 'ملاحظات اخرى :300$', 'طلب اجازه  ', 'موافق', 'mohammed', 'imge/new.png', 'موافق', '2024-09-18', 'غير موافق', '2024-09-18', '2024-09-18', 16),
(3, '2024-09-18', '2024-10-10', '2024-10-12', 3, 'سنوية', '1', 'ملاحظات اخرى :mohammed  ytffgxwawehd', 'طلب اجازه  ', 'غير موافق', 'ali', 'imge/new.png', 'غير موافق', '2024-09-18', 'رافض تام', '2024-09-18', '2024-09-18', 17),
(3, '2024-09-18', '2024-10-09', '2024-10-11', 3, 'سنوية', '1', 'ملاحظات اخرى :errfggh', 'طلب اجازه  ', 'غير موافق', 'mohammed', 'imge/new.png', 'موافق', '2024-09-18', 'رافض تام', '2024-09-18', '2024-09-18', 18),
(3, '2024-09-18', '2024-10-01', '2024-10-11', 11, 'سنوية', '1', 'ملاحظات اخرى :kmjnjbjnjknjknj', 'طلب اجازه  ', 'موافق', 'ali', 'imge/new.png', 'قل اليوم هواي', '2024-09-18', 'رافض تام', '2024-09-18', '2024-09-18', 19);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `time_vacation`
--
ALTER TABLE `time_vacation`
  ADD PRIMARY KEY (`id_vacation`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vacation`
--
ALTER TABLE `vacation`
  ADD PRIMARY KEY (`id_vacation`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `time_vacation`
--
ALTER TABLE `time_vacation`
  MODIFY `id_vacation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vacation`
--
ALTER TABLE `vacation`
  MODIFY `id_vacation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `time_vacation`
--
ALTER TABLE `time_vacation`
  ADD CONSTRAINT `time_vacation_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Constraints for table `vacation`
--
ALTER TABLE `vacation`
  ADD CONSTRAINT `vacation_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
