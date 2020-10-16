FROM lysender/php
LABEL maintainer="Lucas Lima <lucasdevelopmaster@gmail.com>"

# Instalando pacotes necessarios para o funcionamento do servidor
RUN yum -y install supervisor \
    libevent \
    gearmand \
    libgearman \
    libgearman-devel \
    php-pecl-gearman && yum clean all

# Configurando o servido e o timezone
ADD ./start.sh /start.sh
ADD ./supervisor-phpworker.ini /etc/supervisord.d/phpworker.ini
ADD ./timezone.ini /etc/php.d/timezone.ini

# Muando permissao do arquivo que da vida ao container
RUN chmod 755 /start.sh

# criando pasta onde ficara o script
RUN mkdir -p /var/www/scripts

# criando pasta de logs
RUN mkdir -p /var/log/supervisor

# disponibilizando a possibilidade de criar volumes para as pastas criadas.
VOLUME ["/var/www/scripts", "/var/log/supervisor"]

# Dando vida ao container chamado o arquivo start.sh
CMD ["/bin/bash", "/start.sh"]

