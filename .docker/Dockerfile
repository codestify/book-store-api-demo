FROM ubuntu:20.04

ARG uid=1000
# Create user "devuser"
# set user id "uid" (to match host)
# assign to existing group id "uid" (to match host)
RUN groupadd -g $uid devuser && \
    useradd -d /home/devuser -s /bin/bash -u $uid -g $uid devuser && \
    mkdir /home/devuser && \
    chown -R devuser:devuser /home/devuser

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update --fix-missing && \
    apt-get install -y software-properties-common && \
    add-apt-repository ppa:ondrej/php && \
    apt-get install -y \
        build-essential \
        zip \
        unzip \
        curl \
        jq \
        git \
        vim \
        wget \
        supervisor \
        nginx \
        php8.0 \
        php8.0-fpm \
        php8.0-mbstring \
        php8.0-redis \
        php8.0-zip \
        php8.0-common \
        php8.0-curl \
        php8.0-xml \
        php8.0-mysql \
        php8.0-sqlite3 \
        php8.0-xdebug && \
    rm -rf /var/lib/apt/lists/* /etc/php/8.0/mods-available/xdebug.ini /var/cache/debconf/*.dat /etc/nginx/sites-enabled/* /etc/nginx/sites-available/*


RUN mkdir -p /run/php/ && \
    chown devuser:devuser -R /run/php/ /var/www && \
    rm -rf /var/lib/apt/lists/* \ && \
    apt-get autoremove -y && \
    apt-get autoclean -y && \
    apt-get clean -y && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer
COPY --chown=devuser:devuser . /var/www

COPY .docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY .docker/nginx/default.conf /etc/nginx/sites-enabled/default.conf


COPY .docker/php-fpm/fpm.conf /etc/php/8.0/fpm/php-fpm.conf
COPY .docker/php-fpm/www.conf /etc/php/8.0/fpm/pool.d/www.conf
COPY .docker/php-fpm/custom.ini /etc/php/8.0/fpm/conf.d/00-override.ini
COPY .docker/php-fpm/custom.ini /etc/php/8.0/cli/conf.d/00-override.ini

COPY .docker/entrypoint.sh /entrypoint.sh
COPY .docker/supervisord.conf /etc/supervisord.conf

WORKDIR /var/www

RUN composer install --no-interaction --no-plugins --prefer-dist --optimize-autoloader --no-dev && \
    chmod 775 /entrypoint.sh && \
    chown devuser:devuser -R /var/log/ && \
    chown devuser:devuser -R /var/www/vendor && \
    chown devuser:devuser -R /var/lock && \
    ln -sfT /dev/stderr "/var/log/nginx/error.log" && \
	ln -sfT /dev/stdout "/var/log/nginx/access.log" && \
	chown -R --no-dereference devuser:devuser /var/log/nginx

EXPOSE 80

ENTRYPOINT ["/entrypoint.sh"]
CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisord.conf"]
