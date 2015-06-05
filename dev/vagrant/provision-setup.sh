#!/bin/bash

sudo su

# Update the server
echo 'deb http://http.debian.net/debian wheezy-backports main' > /etc/apt/sources.list.d/wheezy-backports.list
apt-get update
# apt-get -y upgrade

# Install basic tools
apt-get -y install build-essential binutils-doc curl screen git vim

# Install Apache
apt-get -y install apache2
apt-get -y install php5 php5-curl php5-mysql php5-sqlite php5-xdebug php5-mcrypt php-pear php5-gd

# Install MySQL without password prompt
# Set username and password to 'root'
debconf-set-selections <<< "mysql-server mysql-server/root_password password root"
debconf-set-selections <<< "mysql-server mysql-server/root_password_again password root"

# Install MySQL Server
# -qq implies -y --force-yes
apt-get install -qq mysql-server-5.5

# adding grant privileges to mysql root user from everywhere
# thx to http://stackoverflow.com/questions/7528967/how-to-grant-mysql-privileges-in-a-bash-script for this
MYSQL=`which mysql`

Q1="GRANT ALL ON *.* TO 'root'@'%' IDENTIFIED BY 'root' WITH GRANT OPTION;"
Q2="FLUSH PRIVILEGES;"
SQL="${Q1}${Q2}"

$MYSQL -uroot -proot -e "$SQL"

# Install node.js and npm
aptitude -t wheezy-backports -y install nodejs
update-alternatives --install /usr/bin/node nodejs /usr/bin/nodejs 100
curl -L https://npmjs.org/install.sh | sudo sh
rm /var/www/npm-install*.sh
npm update -g

# Install Ruby gems
apt-get -y install gem2deb
gem install compass

# Apache config
a2enmod rewrite
a2enmod expires

apt-get install php5-cli
apt-get install libapache2-mod-php5
apt-get install libapache2-mod-wsgi
apt-get install python-setuptools
apt-get install build-essential
apt-get build-dep python
apt-get install python-dev
apt-get install python-virtualenv
apt-get install python-mysqldb
apt-get install libmysqlclient-dev
apt-get install libxml2-dev
apt-get install libpq-dev
apt-get install memcached
apt-get install nginx-full uwsgi uwsgi-plugin-python

# Change owner of apache2 lock file so apache can be restarted
chown -R www-data:www-data /var/lock/apache2

# Install npm modules
cd /var/www/
npm install --global gulp
npm install --global --save-dev bless
cd /

# Cleanup
apt-get -y autoremove

