# 使用 PHP 8.2 Apache 基礎映像
FROM php:8.2-apache

# 設定工作目錄
WORKDIR /var/www/html

# 安裝必要的系統套件
RUN apt-get update && apt-get install -y \
    curl \
    git \
    zip \
    unzip \
    libzip-dev \
    && rm -rf /var/lib/apt/lists/*

# 安裝 PHP 擴展
RUN docker-php-ext-install pdo pdo_mysql zip

# 啟用 Apache 模組
RUN a2enmod rewrite headers

# 安裝 Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 複製 composer 文件並安裝依賴
COPY composer.json composer.lock* ./
RUN composer install --no-dev --optimize-autoloader --no-scripts

# 複製專案其餘文件
COPY . .

# 設定檔案權限
RUN mkdir -p storage \
    && chmod -R 777 storage

# 最後再執行 Composer 腳本
RUN composer run-script post-install-cmd

# 修改 Apache 虛擬主機配置，讓其監聽 PORT 環境變數
RUN echo 'Listen ${PORT}\n\
<VirtualHost *:${PORT}>\n\
    DocumentRoot /var/www/html\n\
    <Directory /var/www/html>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# 開放端口
EXPOSE 8080

# 啟動 Apache 伺服器
CMD ["apache2-foreground"]
