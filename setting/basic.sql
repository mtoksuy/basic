CREATE TABLE `article` (
  `primary_id` int(10) UNSIGNED NOT NULL,
  `basic_id` varchar(256) DEFAULT NULL,
  `title` varchar(256) NOT NULL,
  `hashtag` longtext,
  `content` longtext NOT NULL,
  `del` tinyint(1) DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `article` (`primary_id`, `basic_id`, `title`, `hashtag`, `content`, `del`, `create_time`, `update_time`) VALUES
(1, NULL, 'Hello world!', '["はじめての記事"]', 'ようこそ！Basicの世界へ\r\nこの記事はサンプル記事です。\r\nBasicは誰でも簡単にマークダウン方式で記事が書けて簡単にサイトが運営できますので楽しみながらあれこれいじってみて下さい。', 0, '2022-10-13 20:33:50', NULL),
(2, NULL, 'Basicではどんなサイトが構築できるか', '[]', 'Basicではお気軽に目的に沿ったサイト運営が可能です。\r\n\r\n・ブログ\r\n・会社HP\r\n・ぺらいち\r\n・etc.\r\n\r\nなどがすぐにでも構築可能です。わからない事がございましたら公式のお問い合わせ or 公式のSNSにて気軽にご連絡してください。\r\n\r\n・ECサイト\r\nにつきましてもBasicで構築できるようアップデート中でございます。', 0, '2022-10-13 20:35:53', NULL),
(3, NULL, 'Basicは世界一簡単なCMSを目指しています', '[]', '最初からPC・スマホ対応なのはもちろんのこと、画面からでもファイル編集からでも誰でも簡単にサイト構築できるのがBasicです。\r\n\r\n何かお困りな事がありましたらお気軽にご連絡ください。', 0, '2022-10-30 13:17:35', NULL);

CREATE TABLE `article_draft` (
  `primary_id` int(10) UNSIGNED NOT NULL,
  `basic_id` varchar(256) DEFAULT NULL,
  `title` varchar(256) DEFAULT NULL,
  `hashtag` longtext,
  `content` longtext,
  `del` tinyint(4) NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `cron` (
  `primary_id` int(10) UNSIGNED NOT NULL,
  `count` int(11) DEFAULT '0',
  `target` varchar(256) DEFAULT NULL,
  `type` varchar(256) DEFAULT NULL,
  `complete` tinyint(4) DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `complete_time` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `hashtag` (
  `primary_id` int(10) UNSIGNED NOT NULL,
  `hashtag_name` varchar(256) DEFAULT NULL,
  `del` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `hashtag` (`primary_id`, `hashtag_name`, `del`) VALUES
(1, 'サンプルのハッシュタグ', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `page` (`primary_id`, `basic_id`, `permalink`, `title`, `content`, `draft`, `del`, `create_time`, `update_time`) VALUES
(1, NULL, 'about', '私たちについて', 'aboutのサンプルページです。', 0, 0, '2022-10-13 20:33:50', NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `setting` (`setting_id`, `basic_version`, `admin_theme_color`, `url`, `title`, `description`, `site_icon`, `date_format`, `time_format`, `theme`, `language`, `icon`, `apple_touch_icon`, `compression`, `compression_type`, `article_view_num`, `run_cron_num`) VALUES
(1, '0.9.12', 'default', NULL, NULL, NULL, 'a.ico', 'Y年m月d日', 'H:i:s', 'first_time', NULL, 'basic_icon_1.svg', 'basic_apple_touch_icon_1.png', 1, 'gz', '12', '500');

CREATE TABLE `token` (
  `primary_id` int(10) UNSIGNED NOT NULL,
  `basic_id` varchar(256) DEFAULT NULL,
  `token` varchar(256) DEFAULT NULL,
  `expiration_date` varchar(256) DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `article`
  ADD PRIMARY KEY (`primary_id`),
  ADD KEY `basic_id` (`basic_id`);
  ADD KEY `idx_basic_id` (`basic_id`),
  ADD KEY `idx_title` (`title`),
  ADD KEY `idx_del` (`del`),
  ADD KEY `idx_title_del` (`title`, `del`);

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

COMMIT;