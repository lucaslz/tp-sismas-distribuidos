FROM php:5.6.33-cli

LABEL maintainer="Lucas Lima <developmaster@gmail.com"

RUN apt-get update && apt-get install --no-install-recommends -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng12-dev \
        libssh2-1 \
        libssh2-1-dev \
        freetds-dev \
        libxml2-dev \
        ocaml \
        git \
        libgearman-dev \
        libgtk2.0-dev \
        libcairo2-dev \
        libpango1.0-dev \
        binutils-gold \
        camlp4-extra

RUN ln -sf /usr/lib/x86_64-linux-gnu/libsybdb.a /usr/lib/

RUN pecl install \
    ssh2-0.13 \
    gearman \
	&& docker-php-ext-enable \
        ssh2 \
        gearman

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
        --install-dir=/usr/local/bin \
        --filename=composer

RUN docker-php-ext-install -j$(nproc) \
        iconv \
    	json \
    	mbstring \
    	mcrypt \
    	mssql \
    	mysqli \
        mysql \
    	pdo \
    	pdo_dblib \
    	pdo_mysql \
    	zip \
        gd \
        soap \
    && docker-php-ext-configure \
        gd \
    	--with-freetype-dir=/usr/include/ \
    	--with-jpeg-dir=/usr/include/

RUN pear install PHP_CodeSniffer
#RUN pear channel-discover pear.pdepend.org
#RUN pear install pdepend/PHP_Depend
# Instalando o PHP_Depend de outra forma
#RUN curl http://static.pdepend.org/php/latest/pdepend.phar -o /usr/local/bin/pdepend
#RUN chmod a+x /usr/local/bin/pdepend

#RUN pear channel-discover pear.phpmd.org
#RUN pear install phpmd/PHP_PMD
RUN curl http://get.sensiolabs.org/php-cs-fixer.phar -o /usr/local/bin/php-cs-fixer
RUN chmod a+x /usr/local/bin/php-cs-fixer

RUN cd /opt/
RUN git clone --depth=1 https://github.com/facebook/pfff.git
RUN cd pfff && ./configure && make depend && make && make opt

RUN mkdir -p /var/log/php
RUN touch /var/log/php/php-cli_errors.log
RUN chmod 777 -R /var/log/php/php-cli_errors.log

# COPY phpunit /usr/local/bin/phpunit

# COPY php.ini_prod /usr/local/etc/php/conf.d/php.ini

RUN apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN echo "America/Sao_Paulo" > /etc/timezone
RUN dpkg-reconfigure -f noninteractive tzdata

WORKDIR /var/www

COPY init_service_worker.sh /var/www

EXPOSE 9000 4730

#ENTRYPOINT ["/var/www/init_service_worker.sh"]