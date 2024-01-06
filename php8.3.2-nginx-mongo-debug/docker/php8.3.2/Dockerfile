FROM php:8.3.2RC1-fpm-alpine3.18

COPY ./docker/php8.3.2/xdebug.ini $PHP_INI_DIR/conf.d/50_xdebug.ini

RUN apk --update add \
    bzip2-dev \
    autoconf \
    linux-headers \
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
    pecl install xdebug && \
    docker-php-ext-enable xdebug && \
    pecl install mongodb && \
    apk del build-base && \
    rm -rf /var/cache/apk/*

RUN docker-php-ext-enable mongodb

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