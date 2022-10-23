-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 14 2022 г., 00:15
-- Версия сервера: 8.0.19
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `db_show_more`
--

-- --------------------------------------------------------

--
-- Структура таблицы `image`
--

CREATE TABLE `image` (
  `id` int NOT NULL,
  `img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `image`
--

INSERT INTO `image` (`id`, `img`, `name`) VALUES
(51, '01.jpg', 'Продукт 1'),
(53, '02.jpg', 'Продукт 2'),
(55, '03.jpg', 'Продукт 3'),
(57, '04.jpg', 'Продукт 4'),
(58, '05.jpg', 'Продукт 5'),
(59, '06.jpg', 'Продукт 6'),
(60, '07.jpg', 'Продукт 7'),
(61, '08.jpg', 'Продукт 8'),
(62, '09.jpg', 'Продукт 9'),
(63, '10.jpg', 'Продукт 10'),
(64, '11.jpg', 'Продукт 11'),
(65, '12.jpg', 'Продукт 12'),
(69, '13.jpg', 'Продукт 13'),
(70, '14.jpg', 'Продукт 14'),
(71, '15.jpg', 'Продукт 15'),
(72, '16.jpg', 'Продукт 16'),
(73, '17.jpg', 'Продукт 17'),
(74, '18.jpg', 'Продукт 18'),
(75, '19.jpg', 'Продукт 19'),
(76, '20.jpg', 'Продукт 20'),
(77, '21.jpg', 'Продукт 21'),
(78, '22.jpg', 'Продукт 22'),
(79, '23.jpg', 'Продукт 23'),
(80, '24.jpg', 'Продукт 24');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `image`
--
ALTER TABLE `image`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
