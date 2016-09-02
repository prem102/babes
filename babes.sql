-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 25, 2016 at 12:00 PM
-- Server version: 5.7.13-0ubuntu0.16.04.2
-- PHP Version: 7.0.4-7ubuntu2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `babes`
--

-- --------------------------------------------------------

--
-- Table structure for table `babes_clients_favorites_staff`
--

CREATE TABLE `babes_clients_favorites_staff` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `remarks` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='This table have cliets favorites staff with remarks';

-- --------------------------------------------------------

--
-- Table structure for table `babes_clients_favorites_staff_history`
--

CREATE TABLE `babes_clients_favorites_staff_history` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `remarks` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Through this table we are managed the history';

-- --------------------------------------------------------

--
-- Table structure for table `babes_client_reviews`
--

CREATE TABLE `babes_client_reviews` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `comments` text,
  `rating` int(11) DEFAULT NULL,
  `approve` enum('1','0') NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Babes Client Review table have clients review rating details';

-- --------------------------------------------------------

--
-- Table structure for table `babes_group_permission`
--

CREATE TABLE `babes_group_permission` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Babes Group Permission table have groups permission assigned';

-- --------------------------------------------------------

--
-- Table structure for table `babes_permission`
--

CREATE TABLE `babes_permission` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Permission Table which have permissions of admin control ';

-- --------------------------------------------------------

--
-- Table structure for table `babes_services`
--

CREATE TABLE `babes_services` (
  `id` int(11) NOT NULL,
  `service_type` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `alias` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Babes services table have service which provide by staffs';

--
-- Dumping data for table `babes_services`
--

INSERT INTO `babes_services` (`id`, `service_type`, `name`, `description`, `price`, `alias`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 0, 'Bikini/Lingerie', 'Bikini/Lingerie Bikini/Lingerie Bikini/Lingerie Bikini/Lingerie', 50, 'Bikini/Lingerie', '0', '2016-07-23 07:23:06', '2016-07-23 15:32:26', '2016-07-23 15:33:23'),
(2, 0, 'Nude Waitress Prakash Grijesh', 'Nude Waitress Nude Waitress Nude Waitress Nude Waitress', 100, 'Nude Waitress', '1', '2016-07-23 07:27:42', '2016-07-25 10:54:30', NULL),
(3, 0, 'Topless Waitress', 'Topless Waitress Topless Waitress Topless Waitress', 50, '', '1', '2016-07-23 09:30:56', NULL, NULL),
(4, 1, 'AC Topless G-string Waitress', 'Topless G-string Waitress Topless G-string Waitress Topless G-string Waitress', 1550, 'Topless G-string Waitress', '1', '2016-07-25 05:25:44', '2016-07-25 10:55:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `babes_staff_offered_services`
--

CREATE TABLE `babes_staff_offered_services` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `charges` int(11) NOT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `extra` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Babes Staff offered service table have info staff service';

-- --------------------------------------------------------

--
-- Table structure for table `babes_users_address`
--

CREATE TABLE `babes_users_address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address_type` enum('Work Location','Corresponding Location') NOT NULL DEFAULT 'Work Location',
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `pincode` varchar(5) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Babes Users Address table have users address details ';

-- --------------------------------------------------------

--
-- Table structure for table `babes_user_details`
--

CREATE TABLE `babes_user_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `body_type` varchar(255) DEFAULT NULL,
  `body_color` varchar(255) DEFAULT NULL,
  `mark` varchar(255) DEFAULT NULL,
  `height` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `eye_color` varchar(255) DEFAULT NULL,
  `hair_color` varchar(255) DEFAULT NULL,
  `dress_size` varchar(255) DEFAULT NULL,
  `bust_size` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Babes User Details table have users body details';

-- --------------------------------------------------------

--
-- Table structure for table `babes_user_media`
--

CREATE TABLE `babes_user_media` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `images` varchar(255) DEFAULT NULL,
  `videos` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Babes user media table have user media details';

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'staff', 'Staff'),
(3, 'client', 'Client');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `active`, `first_name`, `last_name`, `company`, `phone`, `address`, `image`, `created_at`, `last_login`, `updated_at`, `deleted_at`, `created_on`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', NULL, 'admin@admin.com', NULL, NULL, NULL, 'gdcnA3zELvKcpSsU2/ydze', 1, 'Admin', 'User', NULL, NULL, NULL, NULL, '2016-07-19 07:19:28', '0000-00-00 00:00:00', '2016-07-25 04:31:25', NULL, '2016-07-19 07:19:28');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `babes_clients_favorites_staff`
--
ALTER TABLE `babes_clients_favorites_staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `babes_client_reviews`
--
ALTER TABLE `babes_client_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `babes_group_permission`
--
ALTER TABLE `babes_group_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `babes_permission`
--
ALTER TABLE `babes_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `babes_services`
--
ALTER TABLE `babes_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `babes_staff_offered_services`
--
ALTER TABLE `babes_staff_offered_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `babes_users_address`
--
ALTER TABLE `babes_users_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `babes_user_details`
--
ALTER TABLE `babes_user_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `babes_user_media`
--
ALTER TABLE `babes_user_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `babes_clients_favorites_staff`
--
ALTER TABLE `babes_clients_favorites_staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `babes_client_reviews`
--
ALTER TABLE `babes_client_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `babes_group_permission`
--
ALTER TABLE `babes_group_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `babes_permission`
--
ALTER TABLE `babes_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `babes_services`
--
ALTER TABLE `babes_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `babes_staff_offered_services`
--
ALTER TABLE `babes_staff_offered_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `babes_users_address`
--
ALTER TABLE `babes_users_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `babes_user_details`
--
ALTER TABLE `babes_user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `babes_user_media`
--
ALTER TABLE `babes_user_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
