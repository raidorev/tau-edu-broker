-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 27 2021 г., 10:37
-- Версия сервера: 10.4.20-MariaDB
-- Версия PHP: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `broker`
--

-- --------------------------------------------------------

--
-- Структура таблицы `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('Маклер', '6', NULL),
('Маклер', '7', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item`
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
-- Дамп данных таблицы `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/entrants/*', 2, NULL, NULL, NULL, 1640576451, 1640576451),
('/entrants/index', 2, NULL, NULL, NULL, 1640576453, 1640576453),
('/registry/educational-program/*', 2, NULL, NULL, NULL, 1640576443, 1640576443),
('/registry/educational-program/index', 2, NULL, NULL, NULL, 1640576441, 1640576441),
('Маклер', 1, NULL, NULL, NULL, 1640576382, 1640576382);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('Маклер', '/entrants/*'),
('Маклер', '/registry/educational-program/*');

-- --------------------------------------------------------

--
-- Структура таблицы `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `educational_program`
--

CREATE TABLE `educational_program` (
  `id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `name_ru` varchar(50) NOT NULL,
  `name_kk` varchar(50) DEFAULT NULL,
  `name_en` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `educational_program`
--

INSERT INTO `educational_program` (`id`, `code`, `name_ru`, `name_kk`, `name_en`) VALUES
(1, '6B06102', 'Информационные системы', NULL, NULL),
(2, '6B04201', 'Юриспруденция', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `educational_stage`
--

CREATE TABLE `educational_stage` (
  `id` int(11) NOT NULL,
  `name_ru` varchar(50) NOT NULL,
  `name_kk` varchar(50) DEFAULT NULL,
  `name_en` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `educational_stage`
--

INSERT INTO `educational_stage` (`id`, `name_ru`, `name_kk`, `name_en`) VALUES
(1, 'бакалавр', NULL, NULL),
(2, 'магистр', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `entrant`
--

CREATE TABLE `entrant` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `patronymic` varchar(50) NOT NULL,
  `future_educational_stage_id` int(11) NOT NULL,
  `future_educational_program_id` int(11) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `sex_id` int(11) DEFAULT NULL,
  `birthdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `entrant`
--

INSERT INTO `entrant` (`id`, `first_name`, `last_name`, `patronymic`, `future_educational_stage_id`, `future_educational_program_id`, `phone_number`, `email`, `sex_id`, `birthdate`) VALUES
(1, 'Петр', 'Петров', 'Петрович', 1, 1, '+7 812 333 4411', 'asd@asd.asd', 1, '0000-00-00'),
(2, 'Марк', 'Марков', '', 1, 2, '+7 12312312312', '', 1, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `menu`
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
-- Дамп данных таблицы `menu`
--

INSERT INTO `menu` (`id`, `name`, `parent`, `route`, `order`, `data`) VALUES
(1, 'Реестр', NULL, NULL, NULL, NULL),
(2, 'ОП', 1, '/registry/educational-program/index', NULL, NULL),
(3, 'Список потенциальных абитуриентов', NULL, '/entrants/index', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `migration`
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
-- Структура таблицы `sex`
--

CREATE TABLE `sex` (
  `id` int(11) NOT NULL,
  `name_ru` varchar(50) NOT NULL,
  `name_kk` varchar(50) DEFAULT NULL,
  `name_en` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `sex`
--

INSERT INTO `sex` (`id`, `name_ru`, `name_kk`, `name_en`) VALUES
(1, 'мужской', NULL, NULL),
(2, 'женский', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
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
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `email`, `first_name`, `last_name`, `patronymic`, `auth_key`, `password_hash`, `password_reset_token`, `status`, `created_at`, `updated_at`) VALUES
(2, 'me@domain.tld', 'Иван', 'Иванов', 'Иванович', 'umcsX2rVHQYm6d8_5RboZ9ktdbWSKwpW', '$2y$13$XSQWBIBqVWJJy2jcVNdMgeEa4TAzavQpqZXHEdS4HK4/1ND2F2Y0.', NULL, 10, 1640508755, 1640508755),
(3, 'aa@aa.aa', 'Aaa', 'Aaa', '', 'y9ntztGzvHztE5iruoZIOTHREBFjo3JU', '$2y$13$YY8.eUwb6qXcmiWzMrNjWOXBKn4lp2GHH6Xi80SfzRfx8q00BjR0y', NULL, 10, 1640575994, 1640575994),
(4, 'aa@aa.bb', 'aa', 'aa', '', 'ru2RVb1Tx5_x0ZIGqT1CDP3Ud9JIo02i', '$2y$13$HzXteIcRc6SaWclY0ocXuuLV1v2C30DxAolu3ZI2rsKr5yIly4DXy', NULL, 10, 1640576221, 1640576221),
(5, 'zz@zz.zz', 'zz', 'zz', 'zz', 'ln4F6KeTCeuENDY6WM4OsYiJlTJn6Pj_', '$2y$13$f5CNArNVoSDqddQhbGfVTe8kVBYo68mbFnUzzswvtvIPkFPFSDJea', NULL, 10, 1640576352, 1640576352),
(6, 'xx@xx.xx', 'xx', 'xx', 'xx', 'p_rFQ2k2BVu1OJMYBXZ9u-xHisbYrNo-', '$2y$13$l924qTAfabyq092RG7/O8.kJGSuip4MZvJHO/ghNPrGgM8bDdEJ6i', NULL, 10, 1640576400, 1640576400),
(7, 'sadf@asd.as', 'Bb', 'Aa', '', 'e5sVUo3Hbq6LOjZQuy52bKujwzd-7oxQ', '$2y$13$LQqm7Ihs05BRWlp.s.OANu1zR2PVv20MJa1EqC9rEu1SyuBbz/oCi', NULL, 10, 1640597430, 1640597430);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Индексы таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Индексы таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Индексы таблицы `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Индексы таблицы `educational_program`
--
ALTER TABLE `educational_program`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `educational_stage`
--
ALTER TABLE `educational_stage`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `entrant`
--
ALTER TABLE `entrant`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent` (`parent`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `sex`
--
ALTER TABLE `sex`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `educational_program`
--
ALTER TABLE `educational_program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `educational_stage`
--
ALTER TABLE `educational_stage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `entrant`
--
ALTER TABLE `entrant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `sex`
--
ALTER TABLE `sex`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
