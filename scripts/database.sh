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
GITUSER=ENTERHERE
GITPASS=ENTERHERE

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

echo "==================================================="
echo "Installing PHP... "
echo "==================================================="
echo "Installing PHP"
    apt-get install -y php5-common php5-dev php5-cli php5-fpm libapache2-mod-php5 >> /vagrant/vm_build.log 2>&1
echo "Installing PHP extensions"
    apt-get install -y curl php5-curl php5-gd php5-mcrypt php5-mysql >> /vagrant/vm_build.log 2>&1

echo "Installing phpmyadmin"	
	sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/dbconfig-install boolean true"
	sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/app-password-confirm password $DBPASSWD"
	sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/admin-pass password $DBPASSWD"
	sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/app-pass password $DBPASSWD"
	sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/reconfigure-webserver multiselect none"
	apt-get -y install mysql-server phpmyadmin >> /vagrant/vm_build.log 2>&1
	
echo "==================================================="
echo "Installing UFW... "
echo "==================================================="
sudo ufw disable
sudo ufw --force reset

sudo u+fw default deny incoming
sudo ufw default allow outgoing

sudo ufw allow ssh
sudo ufw allow 3306/tcp	#Allow mySQL
sudo ufw allow http
sudo ufw allow https


sudo ufw --force enable
sudo ufw logging on 

echo "==================================================="
echo "Cloning and Moving Github Repo "
echo "==================================================="
sudo git clone https://$GITUSER:$GITPASS@github.com/illinoistech-itm/team-2-hawkstagram.git

echo "==================================================="
echo "What's In The Directory?"
echo "==================================================="
ls

echo "==================================================="
echo "Importing mySQL tables and data "
echo "==================================================="
cd team-2-hawkstagram/sql/
mysql -u root -p$DBPASSWD hawkstagram -e "DROP TRIGGER saltPass"
mysql -u root -p$DBPASSWD hawkstagram -e "CREATE TRIGGER saltPass BEFORE INSERT ON users FOR EACH ROW SET NEW.salted_password = SHA2(NEW.salted_password, 224)"
mysql -u root -p$DBPASSWD hawkstagram -e "SHOW TRIGGERS"
mysql -u root -p$DBPASSWD hawkstagram < hawkstagram.sql
mysql -u root -p$DBPASSWD hawkstagram < dummydata.sql
cd ..

echo "==================================================="
echo "Finished provisioning."