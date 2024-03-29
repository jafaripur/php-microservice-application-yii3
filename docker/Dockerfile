FROM php:8.1-cli-alpine

LABEL description="Testing Dockerfile for build in https://github.com/jafaripur/php-microservice-application-yii3"
LABEL org.opencontainers.image.authors="mjafaripur@yahoo.com"

RUN apk update && apk upgrade && echo "UTC" > /etc/timezone \
	&& apk add --no-cache autoconf gcc binutils binutils-dev g++ libtool make \
	libmcrypt-dev rabbitmq-c-dev zlib-dev libzip-dev ${PHPIZE_DEPS} \
	&& docker-php-source extract \
	&& docker-php-ext-install sockets bcmath pcntl opcache \
	&& pecl install amqp \
	&& pecl install igbinary \
	&& pecl install msgpack \
	&& pecl install raphf \
	&& docker-php-ext-enable igbinary msgpack raphf amqp \
	&& docker-php-source delete \
	&& apk del bash autoconf gcc binutils binutils-dev g++ libtool make ${PHPIZE_DEPS} \
	&& mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini" \
	&& rm -rf /var/tmp/* \
	&& rm -rf /tmp/* \
	&& rm -rf /var/cache/apk/* \
	&& rm -rf /var/lib/apt/lists/* \
	&& rm -rf /var/cache/*

RUN  adduser \
  --disabled-password \
  --home /app \
  --gecos '' app_user \
  && chown -R app_user /app

WORKDIR /app

COPY --chown=app_user . .

USER app_user

COPY --chown=app_user --from=composer:latest /usr/bin/composer .

ENV COMPOSER_HOME /app/.composer

RUN rm -rf ./docker &&  mkdir ./runtime && mkdir /app/.composer/ \
	&& ./composer validate --strict \
	&& ./composer install \
	&& ./composer du -o -a \
	&& ./composer run-script psalm \
	&& ./composer run-script phplint \
	&& ./composer clear-cache \
	&& rm ./composer \
	&& rm -rf /app/.composer \
	&& rm -rf /tmp/*

ENTRYPOINT ["/app/vendor/bin/codecept", "run"]