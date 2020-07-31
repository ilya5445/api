-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 31 2020 г., 14:39
-- Версия сервера: 10.3.13-MariaDB-log
-- Версия PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `reviews_api`
--

-- --------------------------------------------------------

--
-- Структура таблицы `photo`
--

CREATE TABLE `photo` (
  `id` int(11) NOT NULL,
  `reviews` int(11) NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `create` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `photo`
--

INSERT INTO `photo` (`id`, `reviews`, `link`, `create`) VALUES
(1, 1, 'test1', '2020-07-31 09:14:15'),
(4, 2, 'test1', '2020-07-31 09:14:15'),
(5, 1, 'test2', '2020-07-31 09:31:24'),
(6, 17, 'testPhoto1', '2020-07-31 11:31:36'),
(7, 17, 'testPhoto2', '2020-07-31 11:31:36'),
(8, 17, 'testPhoto3', '2020-07-31 11:31:37'),
(9, 18, 'testPhoto1', '2020-07-31 11:31:47'),
(10, 18, 'testPhoto2', '2020-07-31 11:31:47'),
(11, 18, 'testPhoto3', '2020-07-31 11:31:47'),
(12, 19, 'testPhoto1', '2020-07-31 11:31:48'),
(13, 19, 'testPhoto2', '2020-07-31 11:31:48'),
(14, 19, 'testPhoto3', '2020-07-31 11:31:48'),
(15, 20, 'testPhoto1', '2020-07-31 11:31:49'),
(16, 20, 'testPhoto2', '2020-07-31 11:31:49'),
(17, 20, 'testPhoto3', '2020-07-31 11:31:49'),
(18, 21, 'testPhoto1', '2020-07-31 11:31:50'),
(19, 21, 'testPhoto2', '2020-07-31 11:31:50'),
(20, 21, 'testPhoto3', '2020-07-31 11:31:50'),
(21, 22, 'testPhoto1', '2020-07-31 11:33:05'),
(22, 22, 'testPhoto2', '2020-07-31 11:33:05'),
(23, 22, 'testPhoto3', '2020-07-31 11:33:05');

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int(1) NOT NULL,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `create` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `user`, `rating`, `description`, `create`) VALUES
(1, 'ilya', 5, 'Какое-то описание', '2020-07-31 09:04:39'),
(2, 'ivan', 3, 'Какое-то описание', '2020-07-31 09:01:39'),
(3, 'vasya', 2, 'Какое-то описание', '2020-07-31 09:04:39'),
(4, 'anya', 5, 'description', '2020-07-31 11:02:40'),
(5, 'stepa', 5, 'description', '2020-07-31 11:02:57'),
(6, 'senya', 5, 'description', '2020-07-31 11:04:08'),
(7, 'alena', 5, 'description', '2020-07-31 11:04:41'),
(8, 'ivan', 5, 'description', '2020-07-31 11:04:42'),
(9, 'ilya', 5, 'description', '2020-07-31 11:10:00'),
(10, 'test1', 2, 'Описание отзыва', '2020-07-31 11:10:35'),
(11, 'test2', 2, 'Описание отзыва', '2020-07-31 11:14:27'),
(12, 'test3', 3, 'Описание отзыва', '2020-07-31 11:14:32'),
(13, 'test4', 2, 'Описание отзыва', '2020-07-31 11:14:33'),
(14, 'test5', 5, 'Описание отзыва', '2020-07-31 11:14:35'),
(15, 'kolya', 5, 'Описание отзыва', '2020-07-31 11:29:50'),
(16, 'kolya', 5, 'Описание отзыва', '2020-07-31 11:30:54'),
(17, 'kolya', 4, 'Описание отзыва', '2020-07-31 11:31:36'),
(18, 'kolya', 5, 'Описание отзыва', '2020-07-31 11:31:47'),
(19, 'kolya', 3, 'Описание отзыва', '2020-07-31 11:31:48'),
(20, 'kolya', 5, 'Описание отзыва', '2020-07-31 11:31:49'),
(21, 'kolya', 2, 'Описание отзыва', '2020-07-31 11:31:50'),
(22, 'kolya', 5, 'Описание отзыва', '2020-07-31 11:33:05');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `photo`
--
ALTER TABLE `photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
