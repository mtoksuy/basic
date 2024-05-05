FROM php:8.2-apache

# 必要なパッケージとPHP拡張をインストール
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql sockets zip mysqli

# Composerをインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Gitをインストール
RUN apt-get install -y git

# Apacheモジュールの有効化
RUN a2enmod rewrite expires deflate

# Apacheを再起動（Dockerfile内では実際には起動していないので再起動は不要ですが、記述例として含めます）
# RUN service apache2 restart

# アプリケーションコードをコンテナにコピー（必要に応じて）
# COPY . /var/www/html

# コンテナが開始したときにApacheをフォアグラウンドで実行
CMD ["apache2-foreground"]
