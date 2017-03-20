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
echo "Preparing MySQL..."
echo "==================================================="
	sudo debconf-set-selections <<< "mysql-server mysql-server/root_password password $DBPASSWD"
	sudo debconf-set-selections <<< "mysql-server mysql-server/root_password_again password $DBPASSWD"
	sudo apt-get install -y mysql-server mysql-common mysql-client >> /vagrant/vm_build.log 2>&1
echo "Installing MySQL"
	sudo apt-get install mysql-server -y >> /vagrant/vm_build.log 2>&1
	mysql -uroot -p$DBPASSWD -e "CREATE DATABASE $DBNAME" >> /vagrant/vm_build.log 2>&1
	mysql -uroot -p$DBPASSWD -e "grant all privileges on $DBNAME.* to '$DBUSER'@'localhost' identified by '$DBPASSWD'" > /vagrant/vm_build.log 
	
	sudo service mysql restart
	
echo "Finished provisioning."	