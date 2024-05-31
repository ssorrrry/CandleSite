-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 30 2024 г., 09:57
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `girls_want_candles`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'свечи с надписями'),
(2, 'фuгурные свечи'),
(3, 'свечи в стакане');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `name` varchar(256) NOT NULL,
  `telephone` varchar(11) NOT NULL,
  `address` varchar(256) NOT NULL,
  `id_product` int NOT NULL,
  `quantity` int NOT NULL,
  `date` varchar(256) NOT NULL,
  `sost` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `name`, `telephone`, `address`, `id_product`, `quantity`, `date`, `sost`) VALUES
(13, 'Арина', '89990009900', 'гр. Ярославль', 3, 1, '2023-12-11 13:09:35', 0),
(20, 'Александра', '89001234567', 'г.Тверь', 2, 1, '2024-05-05 17:20:05', 0),
(22, 'Шияневская Ариана Георгиевна', '89209470202', 'г. Москва', 2, 1, '2024-05-05 17:28:56', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `id_category` int NOT NULL,
  `price` int NOT NULL,
  `path_img` varchar(256) NOT NULL,
  `availability` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `id_category`, `price`, `path_img`, `availability`) VALUES
(1, 'свеча “FUCK IT”', 'Это идеальное выражение вашего отношения к стрессу и повседневным заботам. Зажгите их и просто расслабьтесь, забыв обо всем остальном.', 1, 650, '../Images/1.png', 0),
(2, 'свеча “OH shit”', 'Ваш надежный спутник в моменты неожиданных сюрпризов. Поднимите настроение и создайте атмосферу юмора с этой свечой, готовой подарить улыбку в самых непредсказуемых моментах.', 1, 650, '../Images/oh_shit.png', 1),
(3, 'свеча “melt me”', 'Путешествие в мир расслабления и умиротворения. Позвольте свече растопить ваши заботы и наполнить пространство умиротворенным светом и ароматом, создавая идеальное место для отдыха и релаксации.', 1, 650, '../Images/melt_me.png', 1),
(4, 'свеча “волна”', 'Погрузитесь в атмосферу морской гармонии с нашей свечой в виде волны. Её изящный дизайн приносит вам спокойствие при каждом зажигании, создавая ощущение ласкового прибоя и вдохновляя на путешествия к берегу моря.', 2, 750, '../Images/wave.png', 0),
(5, 'свеча “кубик”', 'Наша свеча в виде кубика - это гармония геометрии и уюта. Её современный дизайн и чистые линии придадут вашему интерьеру стильный акцент. Подарите себе момент умиротворения с каждым зажиганием этой уникальной свечи.', 2, 350, '../Images/cube.png', 0),
(6, 'свеча “черничный крекер”', 'Погрузитесь в атмосферу уюта и сладких воспоминаний с нашей свечой в стаканчике с запахом черничного крекера. Этот аромат создает волшебное сочетание ягодной сладости и теплых вечеров у камина, принося в ваш дом нежность и удовольствие.', 3, 1300, '../Images/blueberry_cracker.png', 0),
(7, 'СВЕЧА “ЛИМОННЫЙ ПИРОГ”', 'Приготовьтесь к свежему вдохновению с нашей свечой в стаканчике с ароматом лимонного пирога. Её яркий и освежающий запах наполняет пространство летней радостью и солнечным настроением, создавая атмосферу яркого и вдохновляющего дня.', 3, 1300, '../Images/lemon_pie.png', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `role`) VALUES
(1, 'user', 'user', 'user'),
(2, 'admin', 'admin', 'admin'),
(5, 'f', 'f', 'user');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
