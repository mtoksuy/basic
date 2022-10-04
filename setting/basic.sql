CREATE TABLE `article` (
  `primary_id` int(10) UNSIGNED NOT NULL,
  `basic_id` varchar(256) DEFAULT NULL,
  `title` varchar(256) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `hashtag` varchar(256) DEFAULT NULL,
  `content` longtext NOT NULL,
  `del` tinyint(1) DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `article_draft` (
  `primary_id` int(10) UNSIGNED NOT NULL,
  `basic_id` varchar(256) DEFAULT NULL,
  `title` varchar(256) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `hashtag` varchar(256) DEFAULT NULL,
  `content` longtext,
  `del` tinyint(4) NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `category` (
  `primary_id` int(10) UNSIGNED NOT NULL,
  `display_name` varchar(256) DEFAULT NULL,
  `url_name` varchar(256) DEFAULT NULL,
  `layer` int(11) DEFAULT '0',
  `priority` smallint(6) NOT NULL DEFAULT '0',
  `parent_name` varchar(256) DEFAULT NULL,
  `full_path` varchar(256) DEFAULT NULL,
  `del` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `file_contents` (
  `primary_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `year` varchar(256) DEFAULT NULL,
  `month` varchar(256) DEFAULT NULL,
  `content_type` varchar(256) DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
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
  `authority_type` int(11) DEFAULT NULL,
  `del` tinyint(4) NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `article`
  ADD PRIMARY KEY (`primary_id`);

ALTER TABLE `article_draft`
  ADD PRIMARY KEY (`primary_id`);

ALTER TABLE `category`
  ADD PRIMARY KEY (`primary_id`);

ALTER TABLE `file_contents`
  ADD PRIMARY KEY (`primary_id`),
  ADD KEY `year` (`year`),
  ADD KEY `content_type` (`content_type`);

ALTER TABLE `setting`
  ADD PRIMARY KEY (`setting_id`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`primary_id`);

ALTER TABLE `article`
  MODIFY `primary_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `article_draft`
  MODIFY `primary_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `category`
  MODIFY `primary_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `file_contents`
  MODIFY `primary_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `setting`
  MODIFY `setting_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `user`
  MODIFY `primary_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

INSERT INTO `setting` (`setting_id`, `url`, `title`, `description`, `site_icon`, `date_format`, `time_format`, `theme`, `language`) VALUES (NULL, NULL, NULL, NULL, NULL, 'Y年m月d日', 'H:i:s', 'first_time', NULL);