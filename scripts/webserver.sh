#!/bin/bash	
	sudo apt-get update -y
	sudo apt-get install -y build-essential git
	sudo apt-get install -y debconf-utils -y > /dev/null
# Variables
DBHOST=localhost
DBNAME=hawkstagram
DBUSER=dbuser
DBPASSWD=hawkstagram123
HOST=$(hostname)

echo "==================================================="
echo "Installing Apache2..."
echo "==================================================="
	sudo apt-get -y install apache2 apache2-utils >> /vagrant/vm_build.log 2>&1

sudo rm -rf /var/www
sudo mkdir /var/www
sudo mkdir /var/www/html
sudo ln -fs /vagrant/public /var/www
echo "ServerName $HOSTNAME" | sudo tee -a /etc/apache2/apache2.conf

	sudo service apache2 restart

echo "==================================================="
echo "Installing PHP... "
echo "==================================================="
echo "Installing PHP"
    apt-get install -y php5-common php5-dev php5-cli php5-fpm libapache2-mod-php5
echo "Installing PHP extensions"
    apt-get install -y curl php5-curl php5-gd php5-mcrypt php5-mysql

echo "Installing phpmyadmin"	
	sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/dbconfig-install boolean true"
	sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/app-password-confirm password $DBPASSWD"
	sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/admin-pass password $DBPASSWD"
	sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/app-pass password $DBPASSWD"
	sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/reconfigure-webserver multiselect none"
	apt-get -y install mysql-server phpmyadmin

echo "Finished provisioning."	