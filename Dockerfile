FROM php:8.1-apache
RUN a2enmod rewrite

# 添加阿里云镜像加速
RUN sed -i "s@http://deb.debian.org@http://mirrors.aliyun.com@g" /etc/apt/sources.list && \
    apt-get clean

##安装相关拓展
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        exiftool \
        zlib1g-dev \
        libzip-dev \
        libmagickcore-dev \
        libmagickwand-dev \
  && docker-php-ext-configure gd\
  && docker-php-ext-install -j$(nproc) gd \
  && docker-php-ext-install exif \
  && docker-php-ext-install bcmath \
  && docker-php-ext-configure exif\
  && docker-php-ext-install pdo_mysql \
  && docker-php-ext-install zip \
  && cd /usr/local/bin && ./docker-php-ext-install mysqli \
  && rm -rf /var/cache/apk/* \
  && pecl install imagick
RUN { \
        echo 'post_max_size = 100M;';\
        echo 'upload_max_filesize = 100M;';\
        echo 'max_execution_time = 600S;';\
    } > /usr/local/etc/php/conf.d/docker-php-upload.ini; 
RUN { \
        echo 'opcache.enable=1'; \
        echo 'opcache.interned_strings_buffer=8'; \
        echo 'opcache.max_accelerated_files=10000'; \
        echo 'opcache.memory_consumption=128'; \
        echo 'opcache.save_comments=1'; \
        echo 'opcache.revalidate_freq=1'; \
    } > /usr/local/etc/php/conf.d/opcache-recommended.ini; \
    \
    echo 'apc.enable_cli=1' >> /usr/local/etc/php/conf.d/docker-php-ext-apcu.ini; \
    \
    echo 'memory_limit=512M' > /usr/local/etc/php/conf.d/memory-limit.ini; \
    \
    echo 'extension=imagick.so' >> /usr/local/etc/php/php.ini; \
    \
    mkdir /var/www/data; \
    chown -R www-data:root /var/www; \
    chmod -R g=u /var/www

COPY ./ /var/www/lsky/
# COPY ./apache2.conf /etc/apache2/
COPY ./000-default.conf /etc/apache2/sites-enabled/
COPY entrypoint.sh /

# COPY ./docker-php.conf /etc/apache2/conf-enabled
WORKDIR /var/www/html/
VOLUME /var/www/html
EXPOSE 80
RUN chmod a+x /entrypoint.sh
ENTRYPOINT ["/entrypoint.sh"]
CMD ["apachectl","-D","FOREGROUND"]