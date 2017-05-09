#! /bin/bash

# Here we will add a php7 repo

SOURCES_CHAR=$(cat /etc/apt/sources.list | grep dotdeb | wc -c );

if [ ${SOURCES_CHAR} -eq 0 ] ;then 
    echo "deb http://packages.dotdeb.org jessie all" >> /etc/apt/sources.list 
    echo "deb-src http://packages.dotdeb.org jessie all" >> /etc/apt/sources.list
fi 

IS_DOTDEB_DOWNLOADED=$(ls -altr | grep dotdeb | wc -c )

if [ ${IS_DOTDEB_DOWNLOADED} -eq 0 ] ;then
    wget -nv https://www.dotdeb.org/dotdeb.gpg
    sudo apt-key add dotdeb.gpg
fi

apt-get update

# we always need vim
apt-get install -y vim

apt-get install -y php7.0

#DATABASE_NAME=budgets
#DATABASE_ROOT_PASSWORD=test
#DATABASE_USER=budgets
#DATABASE_USER_PASSWORD=test

#debconf-set-selections <<< "mysql-server mysql-server/root_password password ${DATABASE_ROOT_PASSWORD}"
#debconf-set-selections <<< "mysql-server mysql-server/root_password_again password ${DATABASE_ROOT_PASSWORD}"

#apt-get install -y mysql-server

#echo "CREATE DATABASE IF NOT EXIST ${DATABASE_NAME}; " | mysql -uroot -p${DATABASE_ROOT_PASSWORD} 
#echo "CREATE USER '${DATABASE_USER}'@'localhost' IDENTIFIED BY '${DATABASE_USER_PASSWORD}';" | mysql -uroot -p${DATABASE_ROOT_PASSWORD} 
#echo "GRANT ALL PRIVILEGES ON * . * TO '${DATABASE_USER}'@'localhost'; " | mysql -uroot -p${DATABASE_ROOT_PASSWORD}  

#Just to install composer on the machine
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '669656bab3166a7aff8a7506b8cb2d1c292f042046c5a994c43155c0be6190fa0355160742ab2e1c88d40d5be660b410') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
mv composer.phar /usr/local/bin/composer
chmod 777 /usr/local/bin/composer

#Install mongodb from default
apt-get install -y mongodb

# node installation

IS_NODE_INSTALLED=$(which node | wc -c )
IS_NPM_INSTALLED=$(which npm | wc -c )

if [ ${IS_NODE_INSTALLED} -eq 1 ] ;then
    sudo su
    wget -O - https://nodejs.org/dist/v6.10.3/node-v6.10.3-linux-x64.tar.xz | tar Jx --strip=1 -C /usr/local
    exit
    node --version
fi

if [ ${IS_NPM_INSTALLED} -eq 1 ];then
    # npm installation
    npm install -g npm
    npm --version
fi 

# Gits installataion
apt-get install -y git

# project

if [ !  -L '/var/www/html/budgets' ] ;then
    ln -fs /vagrant /var/www/html/budgets 
fi

# time to run dev project 
cd /var/www/html/budgets/frontend
npm install
npm run dev &

ps | grep npm
