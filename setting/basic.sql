CREATE TABLE `article` (
  `primary_id` int(10) UNSIGNED NOT NULL,
  `basic_id` varchar(256) DEFAULT NULL,
  `title` varchar(256) NOT NULL,
  `hashtag` longtext,
  `content` longtext NOT NULL,
  `del` tinyint(1) DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `article_draft` (
  `primary_id` int(10) UNSIGNED NOT NULL,
  `basic_id` varchar(256) DEFAULT NULL,
  `title` varchar(256) DEFAULT NULL,
  `hashtag` longtext,
  `content` longtext,
  `del` tinyint(4) NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `file_contents` (
  `primary_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `year` varchar(256) DEFAULT NULL,
  `month` varchar(256) DEFAULT NULL,
  `content_type` varchar(256) DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `hashtag` (
  `primary_id` int(10) UNSIGNED NOT NULL,
  `hashtag_name` varchar(256) DEFAULT NULL,
  `del` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `setting` (
  `setting_id` int(10) UNSIGNED NOT NULL,
  `url` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `site_icon` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `date_format` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `time_format` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `theme` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `language` varchar(256) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `user` (
  `primary_id` int(10) UNSIGNED NOT NULL,
  `basic_id` varchar(256) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `name` varchar(512) DEFAULT NULL,
  `icon` varchar(256) DEFAULT NULL,
  `profile` varchar(1024) DEFAULT NULL,
  `authority_type` varchar(256) DEFAULT NULL,
  `del` tinyint(4) NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `article`
  ADD PRIMARY KEY (`primary_id`);

ALTER TABLE `article_draft`
  ADD PRIMARY KEY (`primary_id`);

ALTER TABLE `file_contents`
  ADD PRIMARY KEY (`primary_id`),
  ADD KEY `year` (`year`),
  ADD KEY `content_type` (`content_type`);

ALTER TABLE `hashtag`
  ADD PRIMARY KEY (`primary_id`);

ALTER TABLE `setting`
  ADD PRIMARY KEY (`setting_id`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`primary_id`);

ALTER TABLE `article`
  MODIFY `primary_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `article_draft`
  MODIFY `primary_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `file_contents`
  MODIFY `primary_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `hashtag`
  MODIFY `primary_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `setting`
  MODIFY `setting_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `user`
  MODIFY `primary_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

INSERT INTO `article` (`primary_id`, `basic_id`, `title`, `hashtag`, `content`, `del`, `create_time`, `update_time`) VALUES (NULL, NULL, 'サンプル記事', '["1"]', 'ようこそ！Basicの世界へ\r\n\r\nこの記事はサンプル記事です。\r\n\r\nBasicは誰でも簡単にマークダウン方式で記事が書けて簡単にサイトが運営できますので楽しみながらあれこれいじってみて下さい。', '0', CURRENT_TIMESTAMP, NULL);

INSERT INTO `hashtag` (`primary_id`, `hashtag_name`, `del`) VALUES (NULL, 'サンプルのハッシュタグ', '0');

INSERT INTO `setting` (`setting_id`, `url`, `title`, `description`, `site_icon`, `date_format`, `time_format`, `theme`, `language`) VALUES (NULL, NULL, NULL, NULL, NULL, 'Y年m月d日', 'H:i:s', 'first_time', NULL);