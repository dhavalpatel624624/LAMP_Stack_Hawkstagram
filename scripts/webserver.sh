#!/usr/bin/env bash
	sudo apt-get update -y
	sudo apt-get install -y build-essential git
	sudo apt-get install -y debconf-utils -y > /dev/null
# Variables
HOST=$(hostname)
GITUSER=keunglh
GITPASS=Lap123456

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
    apt-get install -y php5-common php5-dev php5-cli php5-fpm libapache2-mod-php5 >> /vagrant/vm_build.log 2>&1
echo "Installing PHP extensions"
    apt-get install -y curl php5-curl php5-gd php5-mcrypt php5-mysql >> /vagrant/vm_build.log 2>&1
	
echo "==================================================="
echo "Installing UFW... "
echo "==================================================="
sudo ufw disable
sudo ufw --force reset

sudo ufw default deny incoming
sudo ufw default allow outgoing

sudo ufw allow ssh
sudo ufw allow 3306/tcp	#Allow mySQL
sudo ufw allow http
sudo ufw allow https


sudo ufw --force enable
sudo ufw logging on 

echo "==================================================="
echo "Cloning and Moving Github Repo... "
echo "==================================================="
cd /var/www/
sudo git clone https://$GITUSER:$GITPASS@github.com/illinoistech-itm/team-2-hawkstagram.git
sudo cp -r team-2-hawkstagram/webpages /var/www/html
echo "==================================================="
echo "What's In The Directory?"
echo "==================================================="
cd /var/www/html
ls

echo "==================================================="
echo "Copying Premade openSSL certs ..."
echo "==================================================="
sudo a2enmod ssl

sudo service apache2 restart

sudo mkdir /etc/apache2/ssl

sudo cp /var/www/team-2-hawkstagram/scripts/ssl/apache.crt /etc/apache2/ssl
sudo cp /var/www/team-2-hawkstagram/scripts/ssl/apache.key /etc/apache2/ssl
sudo cp /var/www/team-2-hawkstagram/scripts/ssl/default-ssl.conf /etc/apache2/sites-available/

sudo a2ensite default-ssl.conf

sudo service apache2 restart

echo "==================================================="
echo "Finished provisioning."	

