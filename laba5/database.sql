-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Май 18 2020 г., 17:44
-- Версия сервера: 8.0.17
-- Версия PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `database`
--

-- --------------------------------------------------------

--
-- Структура таблицы `singers`
--

CREATE TABLE `singers` (
  `id` int(10) UNSIGNED NOT NULL,
  `Full Name` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Country` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `singers`
--

INSERT INTO `singers` (`id`, `Full Name`, `Country`) VALUES
(1, 'Сергей Лазарев', 'Россия'),
(2, 'Александр Солодуха', 'Беларусь'),
(3, 'Rammstein', 'Германия'),
(4, 'Little big', 'Россия'),
(5, 'Виктор Цой', 'Россия'),
(6, 'Юрий Хой', 'Россия'),
(7, 'Noize MC', 'Россия');

-- --------------------------------------------------------

--
-- Структура таблицы `songs`
--

CREATE TABLE `songs` (
  `id` int(10) UNSIGNED NOT NULL,
  `Full Name` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `song` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `songs`
--

INSERT INTO `songs` (`id`, `Full Name`, `song`) VALUES
(1, 'Виктор Цой', 'Кукушка'),
(2, 'Александр Солодуха', 'Здравствуй, чужая милая'),
(3, 'Юрий Хой', 'Демобилизация'),
(4, 'Little big', 'Faradenza');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `singers`
--
ALTER TABLE `singers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Full Name` (`Full Name`);

--
-- Индексы таблицы `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `singers`
--
ALTER TABLE `singers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `songs`
--
ALTER TABLE `songs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;