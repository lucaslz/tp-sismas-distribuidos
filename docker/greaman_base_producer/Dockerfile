FROM php:5.6.33-cli

LABEL maintainer="Lucas Lima <developmaster@gmail.com"

# Instalando principais pacotes para configuracao do sistema
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

# Criando link simbolico da biblioteca do linux e movendo para pasta /usr/lib
RUN ln -sf /usr/lib/x86_64-linux-gnu/libsybdb.a /usr/lib/

# Instalando algumas bibliotecas via pecl
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

# Instalando bibliotecas disponíveis diretamente pelo docker
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

# Instalando o code snife e o PHP cs fixes para testar o codigo
RUN pear install PHP_CodeSniffer
RUN curl http://get.sensiolabs.org/php-cs-fixer.phar -o /usr/local/bin/php-cs-fixer
RUN chmod a+x /usr/local/bin/php-cs-fixer

# Baixando e configurando biblioteca pfff
RUN cd /opt/
RUN git clone --depth=1 https://github.com/facebook/pfff.git
RUN cd pfff && ./configure && make depend && make && make opt

# Criando pasta e arquivos de logs, e dando as devidas permissoes
RUN mkdir -p /var/log/php
RUN touch /var/log/php/php-cli_errors.log
RUN chmod 777 -R /var/log/php/php-cli_errors.log

# Remover caches dos pacotes
RUN apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Definindo timezone dos containers
RUN echo "America/Sao_Paulo" > /etc/timezone
RUN dpkg-reconfigure -f noninteractive tzdata

# Definindo o diretorio de trabalho
WORKDIR /var/www

# Expondo portas que seram utilizadas
EXPOSE 9000 4730