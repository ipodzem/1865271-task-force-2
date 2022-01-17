
CREATE TABLE `categories` (
                            `id` int NOT NULL,
                            `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                            `icon` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `cities`
--

CREATE TABLE `cities` (
                        `id` int NOT NULL,
                        `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                        `country_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `countries`
--

CREATE TABLE `countries` (
                           `id` int NOT NULL,
                           `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `executor_categories`
--

CREATE TABLE `executor_categories` (
                                     `user_id` int NOT NULL,
                                     `category_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `executor_photos`
--

CREATE TABLE `executor_photos` (
                                 `id` int NOT NULL,
                                 `user_id` int NOT NULL,
                                 `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                                 `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                                 `path` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `ratings`
--

CREATE TABLE `ratings` (
                         `id` int NOT NULL,
                         `response_id` int NOT NULL,
                         `rating` tinyint NOT NULL,
                         `comment` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `regions`
--

CREATE TABLE `regions` (
                         `id` int NOT NULL,
                         `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                         `city_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `responses`
--

CREATE TABLE `responses` (
                           `id` int NOT NULL,
                           `task_id` int NOT NULL,
                           `user_id` int NOT NULL,
                           `amount` int NOT NULL,
                           `text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
                       `id` int NOT NULL,
                       `user_id` int NOT NULL,
                       `executor_id` int DEFAULT NULL,
                       `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                       `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                       `budget` int NOT NULL,
                       `term` int NOT NULL,
                       `city_id` int NOT NULL,
                       `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                       `address_comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                       `latitude` float NOT NULL,
                       `longitude` float NOT NULL,
                       `cat_id` int NOT NULL,
                       `created` timestamp NOT NULL,
                       `status` varchar(55) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `task_attachments`
--

CREATE TABLE `task_attachments` (
                                  `id` int NOT NULL,
                                  `task_id` int NOT NULL,
                                  `path` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
                       `id` int NOT NULL,
                       `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                       `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                       `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                       `surname` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
                       `login` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                       `password` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                       `phone` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                       `skype` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
                       `city_id` int DEFAULT NULL,
                       `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
                       `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                       `last_visited` timestamp NOT NULL,
                       `type` enum('customer','executor') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country_id` (`country_id`);

--
-- Индексы таблицы `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `executor_categories`
--
ALTER TABLE `executor_categories`
  ADD KEY `cat_id` (`category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `executor_photos`
--
ALTER TABLE `executor_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `response_id` (`response_id`);

--
-- Индексы таблицы `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_id` (`city_id`);

--
-- Индексы таблицы `responses`
--
ALTER TABLE `responses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_id` (`task_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `city_id` (`city_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `task_attachments`
--
ALTER TABLE `task_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_id` (`task_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `executor_photos`
--
ALTER TABLE `executor_photos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `responses`
--
ALTER TABLE `responses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `task_attachments`
--
ALTER TABLE `task_attachments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `executor_categories`
--
ALTER TABLE `executor_categories`
  ADD CONSTRAINT `executor_categories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `executor_categories_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `executor_photos`
--
ALTER TABLE `executor_photos`
  ADD CONSTRAINT `executor_photos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`response_id`) REFERENCES `responses` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `regions`
--
ALTER TABLE `regions`
  ADD CONSTRAINT `regions_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `responses`
--
ALTER TABLE `responses`
  ADD CONSTRAINT `responses_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `responses_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tasks_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `task_attachments`
--
ALTER TABLE `task_attachments`
  ADD CONSTRAINT `task_attachments_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
