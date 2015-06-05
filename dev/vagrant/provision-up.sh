#!/bin/bash

sudo su
cd /var/www

# Site config
cp /var/www/dev/php/xdebug.ini /etc/php5/mods-available/xdebug.ini
cp /var/www/dev/php/php.ini /etc/php5/apache2/php.ini
cp /var/www/dev/db/mysql/my.cnf /etc/mysql/my.cnf
cp /var/www/dev/apache/default /etc/apache2/sites-available/default
cp /var/www/dev/apache/default-ssl /etc/apache2/sites-available/default-ssl
cp /var/www/dev/apache/envvars /etc/apache2/envvars
rm -f /var/www/index.html

chmod -R 775 /var/www/*

service mysql restart
service apache2 restart


cd /var/www

