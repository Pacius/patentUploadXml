-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 22 2019 г., 22:26
-- Версия сервера: 5.6.38
-- Версия PHP: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `uploadXml`
--

-- --------------------------------------------------------

--
-- Структура таблицы `bpp_value`
--

CREATE TABLE `bpp_value` (
  `id` int(11) NOT NULL,
  `id_plan_params` int(11) NOT NULL,
  `id_business_plan` int(11) NOT NULL,
  `value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `bpp_value`
--

INSERT INTO `bpp_value` (`id`, `id_plan_params`, `id_business_plan`, `value`) VALUES
(1, 1, 1, 'true');

-- --------------------------------------------------------

--
-- Структура таблицы `business_plan`
--

CREATE TABLE `business_plan` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `business_plan`
--

INSERT INTO `business_plan` (`id`, `name`, `date`, `description`, `code`) VALUES
(1, 'Бизнес план 1', 123121, 'Бизнес план по выходу из кризиса', 'bp_1');

-- --------------------------------------------------------

--
-- Структура таблицы `business_plan_org`
--

CREATE TABLE `business_plan_org` (
  `id` int(11) NOT NULL,
  `id_business_plan` int(11) NOT NULL,
  `id_organization` int(11) NOT NULL,
  `value` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `business_plan_org`
--

INSERT INTO `business_plan_org` (`id`, `id_business_plan`, `id_organization`, `value`) VALUES
(1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `business_plan_params`
--

CREATE TABLE `business_plan_params` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `business_plan_params`
--

INSERT INTO `business_plan_params` (`id`, `name`, `description`, `code`) VALUES
(1, 'Параметр 1', 'Параметр для бизнес плана', 'param1');

-- --------------------------------------------------------

--
-- Структура таблицы `organizations`
--

CREATE TABLE `organizations` (
  `id` int(11) NOT NULL,
  `unn` varchar(255) DEFAULT NULL,
  `okno` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `form_realt` varchar(255) DEFAULT NULL,
  `fio_director` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `index` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `organizations`
--

INSERT INTO `organizations` (`id`, `unn`, `okno`, `name`, `full_name`, `form_realt`, `fio_director`, `phone`, `email`, `url`, `index`) VALUES
(1, '1020200301', NULL, 'Организация', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `bpp_value`
--
ALTER TABLE `bpp_value`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bpp_value_fk0` (`id_plan_params`),
  ADD KEY `bpp_value_fk1` (`id_business_plan`);

--
-- Индексы таблицы `business_plan`
--
ALTER TABLE `business_plan`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `business_plan_org`
--
ALTER TABLE `business_plan_org`
  ADD PRIMARY KEY (`id`),
  ADD KEY `business_plan_org_fk0` (`id_business_plan`),
  ADD KEY `business_plan_org_fk1` (`id_organization`);

--
-- Индексы таблицы `business_plan_params`
--
ALTER TABLE `business_plan_params`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `bpp_value`
--
ALTER TABLE `bpp_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `business_plan`
--
ALTER TABLE `business_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `business_plan_org`
--
ALTER TABLE `business_plan_org`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `business_plan_params`
--
ALTER TABLE `business_plan_params`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `organizations`
--
ALTER TABLE `organizations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `bpp_value`
--
ALTER TABLE `bpp_value`
  ADD CONSTRAINT `bpp_value_fk0` FOREIGN KEY (`id_plan_params`) REFERENCES `business_plan_params` (`id`),
  ADD CONSTRAINT `bpp_value_fk1` FOREIGN KEY (`id_business_plan`) REFERENCES `business_plan` (`id`);

--
-- Ограничения внешнего ключа таблицы `business_plan_org`
--
ALTER TABLE `business_plan_org`
  ADD CONSTRAINT `business_plan_org_fk0` FOREIGN KEY (`id_business_plan`) REFERENCES `business_plan` (`id`),
  ADD CONSTRAINT `business_plan_org_fk1` FOREIGN KEY (`id_organization`) REFERENCES `organizations` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
