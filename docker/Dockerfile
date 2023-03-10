FROM alpine:latest

ARG WWWGROUP

WORKDIR /var/www/html

ENV TZ=UTC

RUN apk add --no-cache shadow sudo supervisor \
    php81 php81-dev \
    php81-pdo php81-pdo_sqlite php81-pdo_pgsql \
    php81-tokenizer php81-dom php81-gd php81-soap php81-curl php81-imap php81-mbstring php81-xml \
    php81-xmlwriter php81-xmlreader php81-fileinfo php81-zip php81-bcmath php81-pecl-imagick php81-intl php81-ldap \
    php81-pecl-msgpack php81-pecl-igbinary php81-pecl-xdebug \
    composer \
    nodejs yarn npm \
    postgresql15-client

RUN groupadd --force -g $WWWGROUP sail
RUN useradd -ms /bin/bash --no-user-group -g $WWWGROUP -u 1337 sail

COPY start-container /usr/local/bin/start-container
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY php.ini /etc/php81/conf.d/99-sail.ini
RUN mkdir -p /var/log/supervisor
RUN chmod +x /usr/local/bin/start-container

EXPOSE 8000

ENTRYPOINT ["start-container"]
