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

INSERT INTO `article` (`primary_id`, `basic_id`, `title`, `hashtag`, `content`, `del`, `create_time`, `update_time`) VALUES
(1, NULL, 'Hello world!', '[\"1\"]', 'ようこそ！Basicの世界へ\r\nこの記事はサンプル記事です。\r\nBasicは誰でも簡単にマークダウン方式で記事が書けて簡単にサイトが運営できますので楽しみながらあれこれいじってみて下さい。', 0, '2022-10-14 05:33:50', NULL),
(2, NULL, 'Basicではどんなサイトが構築できるか', 'サンプルのハッシュタグ', 'Basicではお気軽に目的に沿ったサイト運営が可能です。\r\n\r\n・ブログ\r\n・会社HP\r\n・ぺらいち\r\n・etc.\r\n\r\nなどがすぐにでも構築可能です。わからない事がございましたら公式のお問い合わせ or 公式のSNSにて気軽にご連絡してください。\r\n\r\n・ECサイト\r\nにつきましてもBasicで構築できるようアップデート中でございます。', 0, '2022-10-14 05:35:53', NULL),
(3, NULL, 'Basicは世界一簡単なCMSを目指しています', NULL, '最初からPC・スマホ対応なのはもちろんのこと、画面からでもファイル編集からでも誰でも簡単にサイト構築できるのがBasicです。\r\n\r\n何かお困りな事がありましたらお気軽にご連絡ください。', 0, '2022-10-30 22:17:35', NULL);

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

CREATE TABLE `contact` (
  `primary_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(256) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `contents` longtext,
  `del` tinyint(4) NOT NULL DEFAULT '0',
  `read_check` tinyint(4) NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
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

INSERT INTO `hashtag` (`primary_id`, `hashtag_name`, `del`) VALUES
(1, 'サンプルのハッシュタグ', 0);

CREATE TABLE `page` (
  `primary_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `dir_name` varchar(256) DEFAULT NULL,
  `title` varchar(256) DEFAULT NULL,
  `content` longtext,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `page` (`primary_id`, `name`, `dir_name`, `title`, `content`, `create_time`, `update_time`) VALUES
(1, 'トップページ', 'root', NULL, NULL, '2022-10-28 22:45:00', NULL),
(2, '私たちについて', 'about', '私たちについて', NULL, '2022-11-01 07:56:46', NULL),
(3, 'お問い合わせ', 'contact', 'お問い合わせ', NULL, '2022-11-01 08:00:09', NULL);

CREATE TABLE `setting` (
  `setting_id` int(10) UNSIGNED NOT NULL,
  `url` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `site_icon` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `date_format` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `time_format` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `theme` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `language` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `icon` varchar(256) DEFAULT NULL,
  `apple_touch_icon` varchar(256) DEFAULT NULL,
  `apple_touch_icon_precomposed` varchar(256) DEFAULT NULL,
  `compression` tinyint(4) DEFAULT NULL,
  `compression_type` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `setting` (`setting_id`, `url`, `title`, `description`, `site_icon`, `date_format`, `time_format`, `theme`, `language`, `icon`, `apple_touch_icon`, `apple_touch_icon_precomposed`, `compression`, `compression_type`) VALUES
(1, NULL, 'CMS', NULL, NULL, 'Y年m月d日', 'H:i:s', 'first_time', NULL, 'basic_icon_1.ico', 'apple_touch_icon_1.png', 'apple_touch_icon_1.png', 1, 'gz');

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

ALTER TABLE `contact`
  ADD PRIMARY KEY (`primary_id`);

ALTER TABLE `file_contents`
  ADD PRIMARY KEY (`primary_id`),
  ADD KEY `year` (`year`),
  ADD KEY `content_type` (`content_type`);

ALTER TABLE `hashtag`
  ADD PRIMARY KEY (`primary_id`);

ALTER TABLE `page`
  ADD PRIMARY KEY (`primary_id`);

ALTER TABLE `setting`
  ADD PRIMARY KEY (`setting_id`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`primary_id`);

ALTER TABLE `article`
  MODIFY `primary_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `article_draft`
  MODIFY `primary_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `contact`
  MODIFY `primary_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `file_contents`
  MODIFY `primary_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `hashtag`
  MODIFY `primary_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,;

ALTER TABLE `page`
  MODIFY `primary_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `setting`
  MODIFY `setting_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `user`
  MODIFY `primary_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

COMMIT;