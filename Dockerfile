FROM php:5.6-apache

RUN apt-get update && apt-get install -y git-core cron \
    libjpeg-dev libmcrypt-dev libpng12-dev libpq-dev \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-configure gd --with-png-dir=/usr --with-jpeg-dir=/usr \
    && docker-php-ext-install gd mcrypt mysqli opcache pdo pdo_mysql zip

COPY . /var/www/html/

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

RUN a2enmod rewrite
RUN service apache2 restart

EXPOSE 80

CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]