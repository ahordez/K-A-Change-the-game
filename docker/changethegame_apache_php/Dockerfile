FROM php:7.3-apache AS changethegame_apache_php
ARG APP_ENV=prod
ENV COMPOSER_ALLOW_SUPERUSER=1

RUN useradd -m devandapache --uid 1000; \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --2; \
    cp -r /root/.composer /home/devandapache/.composer; \
    chown devandapache: /home/devandapache/.composer; \
    apt-get update -y; \
    apt-get upgrade -y --no-install-recommends; \
    apt-get install -y wget vim unzip htop acl --no-install-recommends; \
    apt-get install -y  libzip-dev libicu-dev libfreetype6-dev libxml2-dev --no-install-recommends; \
    apt-get clean -y; \
    apt-get autoremove -y; \
    docker-php-ext-install xml; \
    docker-php-ext-install pdo_mysql; \
    docker-php-ext-install mbstring; \
    docker-php-ext-install json; \
    docker-php-ext-install bcmath; \
    docker-php-ext-install zip; \
    docker-php-ext-install opcache; \
    pecl channel-update pecl.php.net; \
    printf "\n" | pecl install apcu; \
    docker-php-ext-enable apcu; \
    a2enmod rewrite; \
    a2enmod headers; \
    a2enmod expires; \
    echo "ls -la" > /usr/bin/ll; \
    chmod +x /usr/bin/ll

WORKDIR /srv/changethegame

COPY --chown=1000:1000 ./ /srv/changethegame
COPY --chown=1000:1000 ./docker/changethegame_apache_php/docker-entrypoint.sh /usr/local/bin
COPY --chown=1000:1000 ./docker/changethegame_apache_php/php.ini /usr/local/etc/php/php.ini
COPY --chown=1000:1000 ./docker/changethegame_apache_php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY --chown=1000:1000 ./docker/changethegame_apache_php/000-default.conf /etc/apache2/sites-available/000-default.conf

RUN PATH=$PATH:/srv/changethegame/vendor/bin:bin

#Prefetch de tous les vendors.
RUN composer install --no-scripts --prefer-dist --no-interaction --no-autoloader --no-suggest; \
    chmod +x /usr/local/bin/docker-entrypoint.sh; \
    chmod +x /srv/changethegame/docker.sh

ENV APACHE_RUN_USER devandapache
ENV APACHE_RUN_GROUP devandapache
EXPOSE 80/tcp
ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
CMD ["/usr/sbin/apachectl","-DFOREGROUND"]
