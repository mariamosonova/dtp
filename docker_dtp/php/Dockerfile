FROM php:7.4-fpm
ARG TIMEZONE
WORKDIR /app
COPY ./conf/php-fpm.conf /etc/php/7.4/fpm/php-fpm.conf
COPY ./conf/dtp-fpm.conf /etc/php/7.4/fpm/pool.d/dtp.conf
RUN docker-php-ext-install pdo pdo_mysql
RUN  apt-get update \
  && apt-get install -y git\
  && apt-get install -y wget \
  && rm -rf /var/lib/apt/lists/*
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN ln -snf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime && echo ${TIMEZONE} > /etc/timezone \
&& printf '[PHP]\ndate.timezone = "%s"\n', ${TIMEZONE} > /usr/local/etc/php/conf.d/tzone.ini \
&& "date"
RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN export PATH="$HOME/.symfony/bin:$PATH"
RUN git config --global user.email "mariamosonova28@gmail.com"
RUN git config --global user.name "MariaSokolova"


EXPOSE 9000
