#! /bin/bash

# Here we will add a php7 repo

echo "deb http://packages.dotdeb.org jessie all" >> /etc/apt/sources.list 
echo "deb-src http://packages.dotdeb.org jessie all" >> /etc/apt/sources.list

wget https://www.dotdeb.org/dotdeb.gpg
sudo apt-key add dotdeb.gpg

apt-get update

# we always need vim
apt-get install vim

apt-get install -y php7.0

DATABASE_NAME=budgets
DATABASE_ROOT_PASSWORD=test
DATABASE_USER=budgets
DATABASE_USER_PASSWORD=test

debconf-set-selections <<< "mysql-server mysql-server/root_password password ${DATABASE_ROOT_PASSWORD}"
debconf-set-selections <<< "mysql-server mysql-server/root_password_again password ${DATABASE_ROOT_PASSWORD}"

apt-get install -y mysql-server

echo "CREATE DATABASE IF NOT EXIST ${DATABASE_NAME}; " | mysql -uroot -p${DATABASE_ROOT_PASSWORD} 
echo "CREATE USER '${DATABASE_USER}'@'localhost' IDENTIFIED BY '${DATABASE_USER_PASSWORD}';" | mysql -uroot -p${DATABASE_ROOT_PASSWORD} 
echo "GRANT ALL PRIVILEGES ON * . * TO '${DATABASE_USER}'@'localhost'; " | mysql -uroot -p${DATABASE_ROOT_PASSWORD}  

php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '669656bab3166a7aff8a7506b8cb2d1c292f042046c5a994c43155c0be6190fa0355160742ab2e1c88d40d5be660b410') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
mv composer.phar /usr/local/bin/composer
chmod 777 /usr/local/bin/composer

