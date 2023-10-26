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

ALTER TABLE `article` ADD `primary_id` int(10) UNSIGNED NOT NULL;
ALTER TABLE `article` ADD `basic_id` varchar(256) DEFAULT NULL;
ALTER TABLE `article` ADD `title` varchar(256) NOT NULL;
ALTER TABLE `article` ADD `hashtag` longtext;
ALTER TABLE `article` ADD `content` longtext NOT NULL;
ALTER TABLE `article` ADD `del` tinyint(1) DEFAULT '0';
ALTER TABLE `article` ADD `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE `article` ADD `update_timeee` varchar(256) DEFAULT NULL;

CREATE TABLE `article_draft` (
  `primary_id` int(10) UNSIGNED NOT NULL,
  `basic_id` varchar(256) DEFAULT NULL,
  `title` varchar(256) DEFAULT NULL,
  `hashtag` longtext,
  `content` longtext,
  `del` tinyint(4) NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

  ALTER TABLE `article_draft` ADD `primary_id` int(10) UNSIGNED NOT NULL;
  ALTER TABLE `article_draft` ADD `basic_id` varchar(256) DEFAULT NULL;
  ALTER TABLE `article_draft` ADD `title` varchar(256) DEFAULT NULL;
  ALTER TABLE `article_draft` ADD `hashtag` longtext;
  ALTER TABLE `article_draft` ADD `content` longtext;
  ALTER TABLE `article_draft` ADD `del` tinyint(4) NOT NULL DEFAULT '0';
  ALTER TABLE `article_draft` ADD `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP;
  ALTER TABLE `article_draft` ADD `update_time` varchar(256) DEFAULT NULL;

CREATE TABLE `contact` (
  `primary_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(256) DEFAULT NULL,
  `company` varchar(256) DEFAULT NULL,
  `name` varchar(256) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `contents` longtext,
  `del` tinyint(4) NOT NULL DEFAULT '0',
  `read_check` tinyint(4) NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

  ALTER TABLE `contact` ADD `primary_id` int(10) UNSIGNED NOT NULL;
  ALTER TABLE `contact` ADD `title` varchar(256) DEFAULT NULL;
  ALTER TABLE `contact` ADD `company` varchar(256) DEFAULT NULL;
  ALTER TABLE `contact` ADD `name` varchar(256) DEFAULT NULL;
  ALTER TABLE `contact` ADD `email` varchar(256) DEFAULT NULL;
  ALTER TABLE `contact` ADD `contents` longtext;
  ALTER TABLE `contact` ADD `del` tinyint(4) NOT NULL DEFAULT '0';
  ALTER TABLE `contact` ADD `read_check` tinyint(4) NOT NULL DEFAULT '0';
  ALTER TABLE `contact` ADD `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP;

CREATE TABLE `cron` (
  `primary_id` int(10) UNSIGNED NOT NULL,
  `count` int(11) DEFAULT '0',
  `target` varchar(256) DEFAULT NULL,
  `type` varchar(256) DEFAULT NULL,
  `complete` tinyint(4) DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `complete_time` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

  ALTER TABLE `cron` ADD `primary_id` int(10) UNSIGNED NOT NULL;
  ALTER TABLE `cron` ADD `count` int(11) DEFAULT '0';
  ALTER TABLE `cron` ADD `target` varchar(256) DEFAULT NULL;
  ALTER TABLE `cron` ADD `type` varchar(256) DEFAULT NULL;
  ALTER TABLE `cron` ADD `complete` tinyint(4) DEFAULT '0';
  ALTER TABLE `cron` ADD `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP;
  ALTER TABLE `cron` ADD `complete_time` varchar(256) DEFAULT NULL;

CREATE TABLE `fileupload` (
  `primary_id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(256) DEFAULT NULL,
  `name` varchar(256) DEFAULT NULL,
  `extension` varchar(256) DEFAULT NULL,
  `type` varchar(256) DEFAULT NULL,
  `year` varchar(256) DEFAULT NULL,
  `month` varchar(256) DEFAULT NULL,
  `del` tinyint(4) NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

  ALTER TABLE `fileupload` ADD `primary_id` int(10) UNSIGNED NOT NULL;
  ALTER TABLE `fileupload` ADD `full_name` varchar(256) DEFAULT NULL;
  ALTER TABLE `fileupload` ADD `name` varchar(256) DEFAULT NULL;
  ALTER TABLE `fileupload` ADD `extension` varchar(256) DEFAULT NULL;
  ALTER TABLE `fileupload` ADD `type` varchar(256) DEFAULT NULL;
  ALTER TABLE `fileupload` ADD `year` varchar(256) DEFAULT NULL;
  ALTER TABLE `fileupload` ADD `month` varchar(256) DEFAULT NULL;
  ALTER TABLE `fileupload` ADD `del` tinyint(4) NOT NULL DEFAULT '0';
  ALTER TABLE `fileupload` ADD `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP;

CREATE TABLE `hashtag` (
  `primary_id` int(10) UNSIGNED NOT NULL,
  `hashtag_name` varchar(256) DEFAULT NULL,
  `del` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

  ALTER TABLE `hashtag` ADD `primary_id` int(10) UNSIGNED NOT NULL;
  ALTER TABLE `hashtag` ADD `hashtag_name` varchar(256) DEFAULT NULL;
  ALTER TABLE `hashtag` ADD `del` tinyint(1) NOT NULL DEFAULT '0';

CREATE TABLE `page` (
  `primary_id` int(10) UNSIGNED NOT NULL,
  `basic_id` varchar(256) DEFAULT NULL,
  `permalink` varchar(256) DEFAULT NULL,
  `title` varchar(256) DEFAULT NULL,
  `content` longtext,
  `draft` tinyint(4) NOT NULL DEFAULT '0',
  `del` tinyint(4) NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

  ALTER TABLE `page` ADD `primary_id` int(10) UNSIGNED NOT NULL;
  ALTER TABLE `page` ADD `basic_id` varchar(256) DEFAULT NULL;
  ALTER TABLE `page` ADD `permalink` varchar(256) DEFAULT NULL;
  ALTER TABLE `page` ADD `title` varchar(256) DEFAULT NULL;
  ALTER TABLE `page` ADD `content` longtext;
  ALTER TABLE `page` ADD `draft` tinyint(4) NOT NULL DEFAULT '0';
  ALTER TABLE `page` ADD `del` tinyint(4) NOT NULL DEFAULT '0';
  ALTER TABLE `page` ADD `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP;
  ALTER TABLE `page` ADD `update_time` varchar(256) DEFAULT NULL;

CREATE TABLE `setting` (
  `setting_id` int(10) UNSIGNED NOT NULL,
  `basic_version` varchar(256) DEFAULT NULL,
  `admin_theme_color` varchar(256) DEFAULT NULL,
  `url` varchar(256) DEFAULT NULL,
  `title` varchar(256) DEFAULT NULL,
  `description` varchar(256) DEFAULT NULL,
  `site_icon` varchar(256) DEFAULT NULL,
  `date_format` varchar(256) DEFAULT NULL,
  `time_format` varchar(256) DEFAULT NULL,
  `theme` varchar(256) DEFAULT NULL,
  `language` varchar(256) DEFAULT NULL,
  `icon` varchar(256) DEFAULT NULL,
  `apple_touch_icon` varchar(256) DEFAULT NULL,
  `apple_touch_icon_precomposed` varchar(256) DEFAULT NULL,
  `compression` tinyint(4) DEFAULT NULL,
  `compression_type` varchar(256) DEFAULT NULL,
  `article_view_num` varchar(256) DEFAULT '12',
  `run_cron_num` varchar(256) DEFAULT '500'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

  ALTER TABLE `setting` ADD `setting_id` int(10) UNSIGNED NOT NULL;
  ALTER TABLE `setting` ADD `basic_version` varchar(256) DEFAULT NULL;
  ALTER TABLE `setting` ADD `admin_theme_color` varchar(256) DEFAULT NULL;
  ALTER TABLE `setting` ADD `url` varchar(256) DEFAULT NULL;
  ALTER TABLE `setting` ADD `title` varchar(256) DEFAULT NULL;
  ALTER TABLE `setting` ADD `description` varchar(256) DEFAULT NULL;
  ALTER TABLE `setting` ADD `date_format` varchar(256) DEFAULT NULL;
  ALTER TABLE `setting` ADD `time_format` varchar(256) DEFAULT NULL;
  ALTER TABLE `setting` ADD `theme` varchar(256) DEFAULT NULL;
  ALTER TABLE `setting` ADD `language` varchar(256) DEFAULT NULL;
  ALTER TABLE `setting` ADD `icon` varchar(256) DEFAULT NULL;
  ALTER TABLE `setting` ADD `apple_touch_icon` varchar(256) DEFAULT NULL;
  ALTER TABLE `setting` ADD `apple_touch_icon_precomposed` varchar(256) DEFAULT NULL;
  ALTER TABLE `setting` ADD `compression` tinyint(4) DEFAULT NULL;
  ALTER TABLE `setting` ADD `compression_type` varchar(256) DEFAULT NULL;
  ALTER TABLE `setting` ADD `article_view_num` varchar(256) DEFAULT '12';
  ALTER TABLE `setting` ADD `run_cron_num` varchar(256) DEFAULT '500';

CREATE TABLE `token` (
  `primary_id` int(10) UNSIGNED NOT NULL,
  `basic_id` varchar(256) DEFAULT NULL,
  `token` varchar(256) DEFAULT NULL,
  `expiration_date` varchar(256) DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

  ALTER TABLE `token` ADD `primary_id` int(10) UNSIGNED NOT NULL;
  ALTER TABLE `token` ADD `basic_id` varchar(256) DEFAULT NULL;
  ALTER TABLE `token` ADD `toke` varchar(256) DEFAULT NULL;
  ALTER TABLE `token` ADD `expiration_date` varchar(256) DEFAULT NULL;
  ALTER TABLE `token` ADD `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP;

CREATE TABLE `user` (
  `primary_id` int(10) UNSIGNED NOT NULL,
  `basic_id` varchar(256) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `name` varchar(512) DEFAULT NULL,
  `icon` varchar(256) DEFAULT NULL,
  `profile` text DEFAULT NULL,
  `role` varchar(256) DEFAULT NULL,
  `del` tinyint(4) NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

  ALTER TABLE `user` ADD `primary_id` int(10) UNSIGNED NOT NULL;
  ALTER TABLE `user` ADD `basic_id` varchar(256) DEFAULT NULL;
  ALTER TABLE `user` ADD `email` varchar(256) DEFAULT NULL;
  ALTER TABLE `user` ADD `password` varchar(256) DEFAULT NULL;
  ALTER TABLE `user` ADD `name` varchar(512) DEFAULT NULL;
  ALTER TABLE `user` ADD `icon` varchar(256) DEFAULT NULL;
  ALTER TABLE `user` ADD `profile` text DEFAULT NULL;
  ALTER TABLE `user` ADD `role` varchar(256) DEFAULT NULL;
  ALTER TABLE `user` ADD `del` tinyint(4) NOT NULL DEFAULT '0';
  ALTER TABLE `user` ADD `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP;
  ALTER TABLE `user` ADD `update_time` varchar(256) DEFAULT NULL;

ALTER TABLE `article`
  ADD PRIMARY KEY (`primary_id`),
  ADD KEY `basic_id` (`basic_id`);

ALTER TABLE `article_draft`
  ADD PRIMARY KEY (`primary_id`);

ALTER TABLE `contact`
  ADD PRIMARY KEY (`primary_id`);

ALTER TABLE `cron`
  ADD PRIMARY KEY (`primary_id`);

ALTER TABLE `fileupload`
  ADD PRIMARY KEY (`primary_id`),
  ADD KEY `year` (`year`),
  ADD KEY `content_type` (`type`),
  ADD KEY `extension` (`extension`),
  ADD KEY `year_month` (`year`, `month`);

ALTER TABLE `hashtag`
  ADD PRIMARY KEY (`primary_id`);

ALTER TABLE `page`
  ADD PRIMARY KEY (`primary_id`);

ALTER TABLE `setting`
  ADD PRIMARY KEY (`setting_id`);

ALTER TABLE `token`
  ADD PRIMARY KEY (`primary_id`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`primary_id`);

ALTER TABLE `article`
  MODIFY `primary_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `article_draft`
  MODIFY `primary_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `contact`
  MODIFY `primary_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `cron`
  MODIFY `primary_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `fileupload`
  MODIFY `primary_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `hashtag`
  MODIFY `primary_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `page`
  MODIFY `primary_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `setting`
  MODIFY `setting_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `token`
  MODIFY `primary_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `user`
  MODIFY `primary_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;