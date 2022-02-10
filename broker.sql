-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2022 at 12:28 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `broker`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('Маклер', '6', NULL),
('Маклер', '7', NULL),
('Менеджер', '2', 1643996773),
('Менеджер', '3', 1643801341);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/conflicts/*', 2, NULL, NULL, NULL, 1643804473, 1643804473),
('/conflicts/index', 2, NULL, NULL, NULL, 1643804474, 1643804474),
('/entrants/*', 2, NULL, NULL, NULL, 1640576451, 1640576451),
('/entrants/index', 2, NULL, NULL, NULL, 1640576453, 1640576453),
('/gridview/*', 2, NULL, NULL, NULL, 1644484900, 1644484900),
('/gridview/export/*', 2, NULL, NULL, NULL, 1644484896, 1644484896),
('/materials/*', 2, NULL, NULL, NULL, 1640605942, 1640605942),
('/materials/index', 2, NULL, NULL, NULL, 1640605940, 1640605940),
('/registry/educational-organization/*', 2, NULL, NULL, NULL, 1642581862, 1642581862),
('/registry/educational-organization/index', 2, NULL, NULL, NULL, 1642581864, 1642581864),
('/registry/educational-program/*', 2, NULL, NULL, NULL, 1640576443, 1640576443),
('/registry/educational-program/index', 2, NULL, NULL, NULL, 1640576441, 1640576441),
('Маклер', 1, NULL, NULL, NULL, 1640576382, 1640576382),
('Менеджер', 1, NULL, NULL, NULL, 1643800222, 1643800222),
('Подтверждение абитуриентов', 2, NULL, NULL, NULL, 1644427784, 1644427784),
('Просмотр материалов маклера', 2, NULL, NULL, NULL, 1644423532, 1644423532),
('Просмотр отчетов', 2, NULL, NULL, NULL, 1644423547, 1644423547),
('Работа с потенциальными абитуриентами', 2, 'Добавление и редактирование потенциальных абитуриентов', NULL, NULL, 1644423510, 1644423510),
('Работа со всеми потенциальными абитуриентами', 2, 'Просмотр и редактирование потенциальных абитуриентов любого маклера', NULL, NULL, 1644423586, 1644423631),
('Редактирование реестра ОП', 2, 'Добавление и редактирование образовательных программ', NULL, NULL, 1644423395, 1644423407),
('Редактирование реестра организаций образования', 2, 'Добавление и редактирование организаций образования', NULL, NULL, 1644423448, 1644423448),
('Решение конфликтов', 2, NULL, NULL, NULL, 1644423310, 1644423310);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('Маклер', 'Просмотр материалов маклера'),
('Маклер', 'Работа с потенциальными абитуриентами'),
('Маклер', 'Редактирование реестра ОП'),
('Маклер', 'Редактирование реестра организаций образования'),
('Менеджер', 'Маклер'),
('Менеджер', 'Подтверждение абитуриентов'),
('Менеджер', 'Просмотр отчетов'),
('Менеджер', 'Работа со всеми потенциальными абитуриентами'),
('Менеджер', 'Решение конфликтов'),
('Просмотр материалов маклера', '/materials/*'),
('Просмотр отчетов', '/gridview/export/*'),
('Работа с потенциальными абитуриентами', '/entrants/*'),
('Работа со всеми потенциальными абитуриентами', '/entrants/*'),
('Редактирование реестра ОП', '/registry/educational-program/*'),
('Редактирование реестра организаций образования', '/registry/educational-organization/*'),
('Решение конфликтов', '/conflicts/*');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `conflict`
--

CREATE TABLE `conflict` (
  `id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `reason` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `conflict_member`
--

CREATE TABLE `conflict_member` (
  `conflict_id` int(11) NOT NULL,
  `entrant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `conflict_status`
--

CREATE TABLE `conflict_status` (
  `id` int(11) NOT NULL,
  `name_ru` varchar(50) CHARACTER SET utf8 NOT NULL,
  `name_kk` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `name_en` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `conflict_status`
--

INSERT INTO `conflict_status` (`id`, `name_ru`, `name_kk`, `name_en`) VALUES
(1, 'Открыт', NULL, NULL),
(2, 'Закрыт', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `educational_organization`
--

CREATE TABLE `educational_organization` (
  `id` int(11) NOT NULL,
  `name_ru` varchar(255) CHARACTER SET utf8 NOT NULL,
  `name_kk` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `name_en` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Учебные заведения';

--
-- Dumping data for table `educational_organization`
--

INSERT INTO `educational_organization` (`id`, `name_ru`, `name_kk`, `name_en`) VALUES
(1, 'Fff', NULL, NULL),
(2, 'asd', NULL, NULL),
(3, 'asdf', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `educational_organization_levels`
--

CREATE TABLE `educational_organization_levels` (
  `organization_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `educational_organization_levels`
--

INSERT INTO `educational_organization_levels` (`organization_id`, `level_id`) VALUES
(3, 4),
(3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `educational_program`
--

CREATE TABLE `educational_program` (
  `id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `educational_stage_id` int(11) NOT NULL,
  `name_ru` varchar(50) NOT NULL,
  `name_kk` varchar(50) DEFAULT NULL,
  `name_en` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `educational_program`
--

INSERT INTO `educational_program` (`id`, `code`, `educational_stage_id`, `name_ru`, `name_kk`, `name_en`) VALUES
(1, '6B06102', 1, 'Информационные системы', '', 'Information Technology'),
(2, '6B04201', 1, 'Юриспруденция', '', ''),
(3, '6B01504', 1, 'Биология', 'Биология', 'Biology');

-- --------------------------------------------------------

--
-- Table structure for table `educational_stage`
--

CREATE TABLE `educational_stage` (
  `id` int(11) NOT NULL,
  `name_ru` varchar(50) NOT NULL,
  `name_kk` varchar(50) DEFAULT NULL,
  `name_en` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `educational_stage`
--

INSERT INTO `educational_stage` (`id`, `name_ru`, `name_kk`, `name_en`) VALUES
(1, 'бакалавр', NULL, 'bachelor'),
(2, 'магистр', NULL, 'magister');

-- --------------------------------------------------------

--
-- Table structure for table `education_level`
--

CREATE TABLE `education_level` (
  `id` int(11) NOT NULL,
  `name_ru` varchar(255) CHARACTER SET utf8 NOT NULL,
  `name_kk` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `name_en` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Уровень образования';

--
-- Dumping data for table `education_level`
--

INSERT INTO `education_level` (`id`, `name_ru`, `name_kk`, `name_en`) VALUES
(4, 'среднее общее', NULL, NULL),
(5, 'начальное профессиональное', NULL, NULL),
(6, 'среднее профессиональное', NULL, NULL),
(7, 'высшее', NULL, NULL),
(8, 'послевузовское', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `entrant`
--

CREATE TABLE `entrant` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `patronymic` varchar(50) NOT NULL,
  `future_educational_program_id` int(11) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `sex_id` int(11) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `organization_id` int(11) DEFAULT NULL,
  `level_id` int(11) DEFAULT NULL,
  `iin` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `status_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `entrant`
--

INSERT INTO `entrant` (`id`, `first_name`, `last_name`, `patronymic`, `future_educational_program_id`, `phone_number`, `email`, `sex_id`, `birthdate`, `organization_id`, `level_id`, `iin`, `created_by`, `status_id`, `created_at`) VALUES
(14, 'Василий', 'Пупкин', 'Васильевич', 1, '+71112223344', 'zx', 1, '2000-02-24', 3, 4, '11123', 2, 2, '2022-02-09 22:49:55'),
(15, 'Василий', 'Пупкин', 'Васильевич', 1, '+71112223344', '', 1, NULL, NULL, 4, '', 2, NULL, '2022-02-09 22:49:55'),
(16, 'Василий', 'Пупкин', 'Васильевич', 1, '+71112223344', '', 1, NULL, NULL, 4, '', 2, NULL, '2022-02-09 22:49:55'),
(17, 'Василий', 'Пупкин', 'Васильевич', 1, '+71112223344', '', 1, NULL, NULL, 4, '', 2, NULL, '2022-02-09 22:49:55'),
(18, 'Василий', 'Пупкин', 'Васильевич', 1, '+71112223344', '', 1, NULL, NULL, 4, '', 2, NULL, '2022-02-09 22:49:55'),
(19, 'Василий', 'Пупкин', 'Васильевич', 1, '+71112223344', '', 1, NULL, NULL, 4, '', 2, NULL, '2022-02-09 22:49:55'),
(20, 'Василий', 'Пупкин', 'Васильевич', 1, '+71112223344', '', 1, NULL, NULL, 4, '', 2, NULL, '2022-02-09 22:49:55'),
(21, 'Василий', 'Пупкин', 'Васильевич', 1, '+71112223344', '', 1, NULL, NULL, 4, '', 2, NULL, '2022-02-09 22:49:55'),
(22, 'Василий', 'Пупкин', 'Васильевич', 1, '+71112223344', '', 1, NULL, NULL, 4, '', 2, NULL, '2022-02-09 22:49:55'),
(23, 'Василий', 'Пупкин', 'Васильевич', 1, '+71112223344', '', 1, NULL, NULL, 4, '', 2, NULL, '2022-02-09 22:49:55'),
(24, 'Василий', 'Пупкин', 'Васильевич', 1, '+71112223344', '', 1, NULL, NULL, 4, '', 2, NULL, '2022-02-09 22:49:55'),
(25, 'Василий', 'Пупкин', 'Васильевич', 1, '+71112223344', '', 1, NULL, NULL, 4, '', 2, NULL, '2022-02-09 22:49:55'),
(26, 'Василий', 'Пупкин', 'Васильевич', 1, '+71112223344', '', 1, NULL, NULL, 4, '', 2, NULL, '2022-02-09 22:49:55'),
(27, 'Василий', 'Пупкин', 'Васильевич', 1, '+71112223344', '', 1, NULL, NULL, 4, '', 2, NULL, '2022-02-09 22:49:55'),
(28, 'Василий', 'Пупкин', 'Васильевич', 1, '+71112223344', '', 1, NULL, NULL, 4, '', 2, NULL, '2022-02-09 22:49:55'),
(29, 'Василий', 'Пупкин', 'Васильевич', 1, '+71112223344', '', 1, NULL, NULL, 4, '', 2, NULL, '2022-02-09 22:49:55'),
(30, 'Василий', 'Пупкин', 'Васильевич', 1, '+71112223344', '', 1, NULL, NULL, 4, '', 2, NULL, '2022-02-09 22:49:55'),
(31, 'Василий', 'Пупкин', 'Васильевич', 1, '+71112223344', '', 1, NULL, NULL, 4, '', 2, NULL, '2022-02-09 22:49:55'),
(32, 'Василий', 'Пупкин', 'Васильевич', 1, '+71112223344', '', 1, NULL, NULL, 4, '', 2, NULL, '2022-02-09 22:49:55'),
(33, 'Василий', 'Пупкин', 'Васильевич', 1, '+71112223344', '', 1, NULL, NULL, 4, '', 2, NULL, '2022-02-09 22:49:55'),
(34, 'Василий', 'Пупкин', 'Васильевич', 1, '+71112223344', '', 1, NULL, NULL, 4, '', 2, NULL, '2022-02-09 22:49:55'),
(35, 'Василий', 'Пупкин', 'Васильевич', 1, '+71112223344', '', 1, NULL, NULL, 4, '', 2, NULL, '2022-02-09 22:49:55');

-- --------------------------------------------------------

--
-- Table structure for table `entrant_status`
--

CREATE TABLE `entrant_status` (
  `id` int(11) NOT NULL,
  `name_ru` varchar(50) CHARACTER SET utf8 NOT NULL,
  `name_kk` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `name_en` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `entrant_status`
--

INSERT INTO `entrant_status` (`id`, `name_ru`, `name_kk`, `name_en`) VALUES
(1, 'подал документы', NULL, NULL),
(2, 'заключил договор', NULL, NULL),
(3, 'оплатил обучение', NULL, NULL),
(4, 'отклонен', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `parent`, `route`, `order`, `data`) VALUES
(1, 'Реестр', NULL, NULL, NULL, NULL),
(2, 'ОП', 1, '/registry/educational-program/index', NULL, NULL),
(3, 'Список потенциальных абитуриентов', NULL, '/entrants/index', NULL, NULL),
(4, 'Материалы ', NULL, '/materials/index', NULL, NULL),
(5, 'Организации', 1, '/registry/educational-organization/index', NULL, NULL),
(6, 'Конфликты', NULL, '/conflicts/index', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1640503081),
('m140506_102106_rbac_init', 1640503151),
('m140602_111327_create_menu_table', 1640503083),
('m160312_050000_create_user', 1640503083),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1640503151),
('m180523_151638_rbac_updates_indexes_without_prefix', 1640503151),
('m200409_110543_rbac_update_mssql_trigger', 1640503151);

-- --------------------------------------------------------

--
-- Table structure for table `sex`
--

CREATE TABLE `sex` (
  `id` int(11) NOT NULL,
  `name_ru` varchar(50) NOT NULL,
  `name_kk` varchar(50) DEFAULT NULL,
  `name_en` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sex`
--

INSERT INTO `sex` (`id`, `name_ru`, `name_kk`, `name_en`) VALUES
(1, 'мужской', NULL, NULL),
(2, 'женский', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `patronymic` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `first_name`, `last_name`, `patronymic`, `auth_key`, `password_hash`, `password_reset_token`, `status`, `created_at`, `updated_at`) VALUES
(2, 'me@domain.tld', 'Иван', 'Иванов', 'Иванович', 'umcsX2rVHQYm6d8_5RboZ9ktdbWSKwpW', '$2y$13$XSQWBIBqVWJJy2jcVNdMgeEa4TAzavQpqZXHEdS4HK4/1ND2F2Y0.', NULL, 10, 1640508755, 1640508755),
(3, 'aa@aa.aa', 'Aaa', 'Aaa', '', 'y9ntztGzvHztE5iruoZIOTHREBFjo3JU', '$2y$13$YY8.eUwb6qXcmiWzMrNjWOXBKn4lp2GHH6Xi80SfzRfx8q00BjR0y', NULL, 10, 1640575994, 1640575994),
(4, 'aa@aa.bb', 'aa', 'aa', '', 'ru2RVb1Tx5_x0ZIGqT1CDP3Ud9JIo02i', '$2y$13$HzXteIcRc6SaWclY0ocXuuLV1v2C30DxAolu3ZI2rsKr5yIly4DXy', NULL, 10, 1640576221, 1640576221),
(5, 'zz@zz.zz', 'zz', 'zz', 'zz', 'ln4F6KeTCeuENDY6WM4OsYiJlTJn6Pj_', '$2y$13$f5CNArNVoSDqddQhbGfVTe8kVBYo68mbFnUzzswvtvIPkFPFSDJea', NULL, 10, 1640576352, 1640576352),
(6, 'xx@xx.xx', 'xx', 'xx', 'xx', 'p_rFQ2k2BVu1OJMYBXZ9u-xHisbYrNo-', '$2y$13$l924qTAfabyq092RG7/O8.kJGSuip4MZvJHO/ghNPrGgM8bDdEJ6i', NULL, 10, 1640576400, 1640576400),
(7, 'sadf@asd.as', 'Bb', 'Aa', '', 'e5sVUo3Hbq6LOjZQuy52bKujwzd-7oxQ', '$2y$13$LQqm7Ihs05BRWlp.s.OANu1zR2PVv20MJa1EqC9rEu1SyuBbz/oCi', NULL, 10, 1640597430, 1640597430);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `conflict`
--
ALTER TABLE `conflict`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conflict_conflict_status_id_fk` (`status_id`);

--
-- Indexes for table `conflict_member`
--
ALTER TABLE `conflict_member`
  ADD PRIMARY KEY (`conflict_id`,`entrant_id`),
  ADD KEY `table_name_entrant_id_fk` (`entrant_id`);

--
-- Indexes for table `conflict_status`
--
ALTER TABLE `conflict_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `educational_organization`
--
ALTER TABLE `educational_organization`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `educational_organization_name_ru_uindex` (`name_ru`);

--
-- Indexes for table `educational_organization_levels`
--
ALTER TABLE `educational_organization_levels`
  ADD PRIMARY KEY (`level_id`),
  ADD KEY `educational_organization_levels_educational_organization_id_fk` (`organization_id`);

--
-- Indexes for table `educational_program`
--
ALTER TABLE `educational_program`
  ADD PRIMARY KEY (`id`),
  ADD KEY `educational_stage_id` (`educational_stage_id`) USING BTREE;

--
-- Indexes for table `educational_stage`
--
ALTER TABLE `educational_stage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `education_level`
--
ALTER TABLE `education_level`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `education_level_name_ru_uindex` (`name_ru`);

--
-- Indexes for table `entrant`
--
ALTER TABLE `entrant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `future_educational_program_id` (`future_educational_program_id`),
  ADD KEY `sex_id` (`sex_id`),
  ADD KEY `entrant_user_id_fk` (`created_by`);

--
-- Indexes for table `entrant_status`
--
ALTER TABLE `entrant_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent` (`parent`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `sex`
--
ALTER TABLE `sex`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `conflict`
--
ALTER TABLE `conflict`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `conflict_status`
--
ALTER TABLE `conflict_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `educational_organization`
--
ALTER TABLE `educational_organization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `educational_program`
--
ALTER TABLE `educational_program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `educational_stage`
--
ALTER TABLE `educational_stage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `education_level`
--
ALTER TABLE `education_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `entrant`
--
ALTER TABLE `entrant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `entrant_status`
--
ALTER TABLE `entrant_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sex`
--
ALTER TABLE `sex`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `conflict`
--
ALTER TABLE `conflict`
  ADD CONSTRAINT `conflict_conflict_status_id_fk` FOREIGN KEY (`status_id`) REFERENCES `conflict_status` (`id`);

--
-- Constraints for table `conflict_member`
--
ALTER TABLE `conflict_member`
  ADD CONSTRAINT `table_name_conflict_id_fk` FOREIGN KEY (`conflict_id`) REFERENCES `conflict` (`id`),
  ADD CONSTRAINT `table_name_entrant_id_fk` FOREIGN KEY (`entrant_id`) REFERENCES `entrant` (`id`);

--
-- Constraints for table `educational_organization_levels`
--
ALTER TABLE `educational_organization_levels`
  ADD CONSTRAINT `educational_organization_levels_education_level_id_fk` FOREIGN KEY (`level_id`) REFERENCES `education_level` (`id`),
  ADD CONSTRAINT `educational_organization_levels_educational_organization_id_fk` FOREIGN KEY (`organization_id`) REFERENCES `educational_organization` (`id`);

--
-- Constraints for table `educational_program`
--
ALTER TABLE `educational_program`
  ADD CONSTRAINT `educational_program_ibfk_1` FOREIGN KEY (`educational_stage_id`) REFERENCES `educational_stage` (`id`);

--
-- Constraints for table `entrant`
--
ALTER TABLE `entrant`
  ADD CONSTRAINT `entrant_ibfk_1` FOREIGN KEY (`sex_id`) REFERENCES `sex` (`id`),
  ADD CONSTRAINT `entrant_ibfk_2` FOREIGN KEY (`future_educational_program_id`) REFERENCES `educational_program` (`id`),
  ADD CONSTRAINT `entrant_user_id_fk` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`);

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
