-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 04, 2022 at 02:48 PM
-- Server version: 8.0.30-0ubuntu0.22.04.1
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int NOT NULL,
  `companies_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `type_id` int NOT NULL,
  `country` varchar(50) NOT NULL,
  `tva` varchar(50) NOT NULL,
  `companies_created_at` datetime NOT NULL,
  `companies_updated_at` datetime NOT NULL,
  `companies_phone` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `companies_name`, `type_id`, `country`, `tva`, `companies_created_at`, `companies_updated_at`, `companies_phone`) VALUES
(2, 'raviga', 1, 'United States', 'US456 654 321', '2022-09-20 16:11:43', '2022-09-20 16:11:43', '5555-8767'),
(3, 'dunder mufflin', 2, 'United States', 'US676 787 767', '2022-09-20 16:13:51', '2022-09-20 16:13:51', '5555-4529'),
(4, 'Becode', 1, 'Belgium', 'BEO087 876 787', '2022-09-20 16:14:45', '2022-09-20 16:14:45', '5555-8105'),
(5, 'tech trop bien', 1, 'France', 'FR676 676 676', '2022-09-20 16:15:26', '2022-09-20 16:15:26', '5555-8717'),
(6, 'Jouet Jean-Michel', 2, 'France', 'FR787 776 999', '2022-09-20 16:16:12', '2022-09-20 16:16:12', '5555-1841'),
(7, 'Pied Pipper', 2, 'Belgium', 'BE87 876 767 565', '2022-09-20 16:17:36', '2022-09-20 16:17:36', '5555-9978');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int NOT NULL,
  `contacts_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `contacts_firstname` varchar(50) NOT NULL,
  `company_id` int NOT NULL,
  `email` varchar(50) NOT NULL,
  `contacts_phone` varchar(50) CHARACTER SET utf8 NOT NULL,
  `contacts_created_at` datetime NOT NULL,
  `contacts_updates_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `contacts_name`, `contacts_firstname`, `company_id`, `email`, `contacts_phone`, `contacts_created_at`, `contacts_updates_at`) VALUES
(1, 'Gregory', 'Peter', 2, 'peter.gregory@raviga.com', '555-4667', '2022-09-20 16:42:00', '2022-09-20 16:42:00'),
(2, 'Scott', 'Michael', 3, 'michael.scott@dunder.com', '555-9867', '2022-09-20 16:43:28', '2022-09-20 16:43:28'),
(3, 'God', 'George', 4, 'gearge.god@belga.com', '555-6734', '2022-09-20 16:44:30', '2022-09-20 16:44:30'),
(4, 'Cailloux', 'Pierre', 5, 'pierre.cailloux@cailloux.com', '555-6712', '2022-09-20 16:45:31', '2022-09-20 16:45:31'),
(5, 'Boulette', 'Jean-Michel', 6, 'jeanmichel@gmail.com', '555-9371', '2022-09-20 16:46:10', '2022-09-20 16:46:10');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int NOT NULL,
  `ref` varchar(50) NOT NULL,
  `id_company` int NOT NULL,
  `invoices_created_at` datetime NOT NULL,
  `invoices_updated_at` datetime NOT NULL,
  `due_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `ref`, `id_company`, `invoices_created_at`, `invoices_updated_at`, `due_date`) VALUES
(1, 'F20220915-001', 2, '2022-09-20 17:55:03', '2022-09-20 17:55:03', '2022-09-23 17:55:03'),
(2, 'F20220915-002', 3, '2022-09-20 17:57:11', '2022-09-20 17:57:11', '2022-09-24 17:57:11'),
(3, 'F20220915-003', 4, '2022-09-20 17:57:30', '2022-09-20 17:57:30', '2022-09-27 17:57:30'),
(4, 'F20220915-004', 5, '2022-09-20 17:57:46', '2022-09-20 17:57:46', '2022-09-29 17:57:46'),
(5, 'F20220915-005', 6, '2022-09-20 17:58:01', '2022-09-20 17:58:01', '2022-09-23 17:58:01'),
(6, 'F20220915-006', 7, '2022-09-20 17:58:17', '2022-09-20 17:58:17', '2022-09-28 17:58:17');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `roles_permission`
--

CREATE TABLE `roles_permission` (
  `id` int NOT NULL,
  `permission_id` int NOT NULL,
  `role_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` int NOT NULL,
  `types_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `types_created_at` datetime NOT NULL,
  `types_updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `types_name`, `types_created_at`, `types_updated_at`) VALUES
(1, 'supplier', '2020-09-25 00:00:00', '2020-09-25 00:00:00'),
(2, 'client', '2020-09-25 00:00:00', '2020-09-25 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `role_id` int NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_company` (`id_company`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles_permission`
--
ALTER TABLE `roles_permission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_id` (`permission_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles_permission`
--
ALTER TABLE `roles_permission`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `companies`
--
ALTER TABLE `companies`
  ADD CONSTRAINT `companies_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`id_company`) REFERENCES `companies` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `roles_permission`
--
ALTER TABLE `roles_permission`
  ADD CONSTRAINT `roles_permission_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `roles_permission_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
