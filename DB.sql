-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 10 2020 г., 17:37
-- Версия сервера: 10.4.14-MariaDB
-- Версия PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `register`
--

-- --------------------------------------------------------

--
-- Структура таблицы `lich`
--

CREATE TABLE `lich` (
  `id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `summa` float NOT NULL,
  `valuta` varchar(15) NOT NULL,
  `kursval` float NOT NULL,
  `operac` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `lich`
--

INSERT INTO `lich` (`id`, `login`, `date`, `summa`, `valuta`, `kursval`, `operac`) VALUES
(1, 'vadim_cherenkov', '2020-10-15', 100, 'Доллар', 75.86, 'Pokupka'),
(2, 'vadim_cherenkov', '2020-10-08', 50, 'Доллар', 70, 'Prodazha');

-- --------------------------------------------------------

--
-- Структура таблицы `otdelenia`
--

CREATE TABLE `otdelenia` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `rezhim_raboty` varchar(255) NOT NULL,
  `date_obr` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(17) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `otdelenia`
--

INSERT INTO `otdelenia` (`id`, `name`, `rezhim_raboty`, `date_obr`, `address`, `phone`) VALUES
(5, 'Офис', 'Пн-Пт с 9:00 до 18:00, Сб-Вс с 10:00 до 17:00. Обед 12:00-13:00', '2020-12-10', 'Волгоград, Университетская, 100А', '8(999)-967-66-66');

-- --------------------------------------------------------

--
-- Структура таблицы `sotrudniki`
--

CREATE TABLE `sotrudniki` (
  `idSot` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `birhDate` date NOT NULL,
  `rabDate` date NOT NULL,
  `dolzh` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `otdel_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sotrudniki`
--

INSERT INTO `sotrudniki` (`idSot`, `name`, `birhDate`, `rabDate`, `dolzh`, `image`, `otdel_ID`) VALUES
(33, 'Черенков Валентин', '1998-03-05', '2020-12-09', 'Главный менеджер', 'b69f701c23b338568a043a92cd36692f.png', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `login` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `family` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cookie` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `email`, `name`, `family`, `password`, `cookie`) VALUES
(1, 'vadim_cherenkov', 'vadim_cherenkov@bk.ru', 'Вадим', 'Черенков', '$2y$10$YqMjsKld3kzQrdPoaaw4muAohGCJnpcZbxg0l4ZLRRUdHJjqS38hO', '#ihtU6C4'),
(2, 'tugarin.sanya', 'tugarin.sanya@mail.ru', 'Александр', 'Тугарин', '$2y$10$uR.xQljDpIu0e6rnebReaO9p.Gp03JPwz4pAaf8.lPl7Prn2gy4vu', '#<r8Wdx?');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `lich`
--
ALTER TABLE `lich`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `otdelenia`
--
ALTER TABLE `otdelenia`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sotrudniki`
--
ALTER TABLE `sotrudniki`
  ADD PRIMARY KEY (`idSot`),
  ADD KEY `sotrudniki_ibfk_1` (`otdel_ID`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `lich`
--
ALTER TABLE `lich`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `otdelenia`
--
ALTER TABLE `otdelenia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `sotrudniki`
--
ALTER TABLE `sotrudniki`
  MODIFY `idSot` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `sotrudniki`
--
ALTER TABLE `sotrudniki`
  ADD CONSTRAINT `sotrudniki_ibfk_1` FOREIGN KEY (`otdel_ID`) REFERENCES `otdelenia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
