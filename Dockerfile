FROM ubuntu:latest

#Esto es para que no me pida interactuar
ENV DEBIAN_FRONTEND noninteractive

#apache2 y php 8
RUN  apt-get update \
RUN TZ=Etc/UTC  apt-get -y   install tzdata
RUN  apt-get -y install apache2
RUN  apt-get  install -y net-tools
RUN  apt-get  install -y vim
RUN  apt-get  install -y php
RUN  apt-get  install -y libapache2-mod-php
RUN  apt-get  install -y php-mysql
RUN  apt-get  install -y php-dev
RUN  apt-get  install -y php-pear
RUN  apt-get  install -y apt-utils
RUN  pecl install xdebug
RUN apt-get update
RUN echo "zend_extension=/usr/lib/php/20210902/xdebug.so" >>/etc/php/8.1/apache2/php.ini
RUN echo xdebug_remote.enable=on >> /etc/php/8.1/apache2/php.ini
# Para ver los errores de apache
VOLUME '/var/log/apache2/'
VOLUME '/var/www/html'
RUN echo alias e=\"tail -f /var/log/apache2/error.log\" >> /root/.bashrc
RUN apt-get -y install mysql-client mysql-server
RUN apt-get -y install phpmyadmin \

CMD ["apachectl", "-D", "FOREGROUND"]