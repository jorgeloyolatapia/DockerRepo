FROM php:8.1.6RC1-fpm-alpine3.15

COPY ./docker/php8.1.6/php.ini $PHP_INI_DIR/php.ini
COPY ./docker/php8.1.6/xdebug.ini $PHP_INI_DIR/conf.d/50_xdebug.ini
COPY ./docker/php8.1.6/symfony-cli_5.4.12_aarch64.apk /tmp

# Composer Dependencies
RUN apk --update add \
    bzip2-dev \
    autoconf \
    php-bcmath \
    build-base \
    curl \
    git \
    freetype-dev \
    libjpeg-turbo-dev \
    libmcrypt-dev \
    libpng-dev \
    libbz2 \
    libstdc++ \
    libxslt-dev \
    openldap-dev \
    make \
    unzip \
    wget && \
    docker-php-ext-install gd && \
    docker-php-ext-configure ldap --with-libdir=lib/ && \
    docker-php-ext-install bcmath && \
    docker-php-ext-install ldap && \
    docker-php-ext-install pdo_mysql && \
    pecl install xdebug && \
    docker-php-ext-enable xdebug && \
    apk del build-base && \
    rm -rf /var/cache/apk/*


ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions amqp
    
RUN  git config --global user.email "jorge.loyola.tapia@gmail.com"

# Register the COMPOSER_HOME environment variable
ENV COMPOSER_HOME /composer

# Add global binary directory to PATH and make sure to re-export it
ENV PATH /composer/vendor/bin:$PATH

# Allow Composer to be run as root
ENV COMPOSER_ALLOW_SUPERUSER 1


# Setup the Composer installer
RUN curl -o /tmp/composer-setup.php https://getcomposer.org/installer \
  && curl -o /tmp/composer-setup.sig https://composer.github.io/installer.sig \
  && php -r "if (hash('SHA384', file_get_contents('/tmp/composer-setup.php')) !== trim(file_get_contents('/tmp/composer-setup.sig'))) { unlink('/tmp/composer-setup.php'); echo 'Invalid installer' . PHP_EOL; exit(1); }" \
  && php /tmp/composer-setup.php --no-ansi --install-dir=/usr/local/bin --filename=composer \
  && rm -rf /tmp/composer-setup.php

# Install symfony_cli 5.4.8
WORKDIR /tmp
RUN apk add symfony-cli_5.4.12_aarch64.apk --allow-untrusted

WORKDIR /var/www/app
