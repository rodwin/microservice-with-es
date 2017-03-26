FROM rodwin/apache-php7

MAINTAINER rodwin lising <rodwinlising@gmail.com>

COPY config/php.ini /usr/local/etc/php/
COPY config/000-default.conf /etc/apache2/sites-available/

# COPY src/ /var/www/html/
# Volume configuration
VOLUME ["/var/www/html"]