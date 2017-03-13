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

