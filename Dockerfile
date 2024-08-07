FROM php:8.1-apache
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN apt-get update && apt-get upgrade -y
WORKDIR /var/www/html/
COPY . ./
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
EXPOSE 80