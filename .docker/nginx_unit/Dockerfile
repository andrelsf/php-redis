FROM    nginx/unit:1.14.0-php7.3

ENV     PHALCON_OS=debian/buster

RUN     apt update \
        && apt install -y php7.3-dev php-redis \
        && mkdir /usr/src/app/public -p

RUN     export PHALCON_REPO="https://packagecloud.io/phalcon/nightly" \
            PHALCON_PKG="php7.3-phalcon_4.0.0-848+php7.3_amd64.deb" \
        && curl -sSL \
            "$PHALCON_REPO/packages/$PHALCON_OS/$PHALCON_PKG/download.deb" \
            -o /tmp/phalcon.deb \
        && mkdir /tmp/pkg \
        && dpkg-deb -R /tmp/phalcon.deb /tmp/pkg \
        && cp /tmp/pkg/usr/lib/php/*/phalcon.so "$(php-config  --extension-dir)/phalcon.so" \
        # && docker-php-ext-install opcache pdo_mysql mysqli 1> /dev/null \
        && printf "\\n" | pecl install --force psr 1> /dev/null \
        && echo "extension=psr.so" > "/etc/php/7.3/mods-available/docker-php-ext-psr.ini" \
        && echo "extension=phalcon.so" > "/etc/php/7.3/mods-available/docker-php-ext-phalcon.ini" \
        #&& php -m | grep -i "opcache\|mysql\|phalcon\|psr\|pdo\|mbstring" \
        #&& mv /code/.env.example /code/.env \
        && apt-get autoremove -y \
        && apt-get autoclean -y \
        && apt-get clean -y \
        && rm -rf /tmp/* /var/tmp/* \
        && find /var/cache/apt/archives /var/lib/apt/lists /var/cache \
        -not -name lock \
        -type f \
        -delete \
        && find /var/log -type f | while read f; do echo -n '' > ${f}; done

WORKDIR /usr/src/app/

ADD    ./config.json /docker-entrypoint.d/