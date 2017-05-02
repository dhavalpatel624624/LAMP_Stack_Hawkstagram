#!/bin/bash	
	sudo apt-get install -y build-essential git
	sudo apt-get install -y debconf-utils -y > /dev/null
#Variables
DBHOST=localhost
DBNAME=hawkstagram
DBUSER=dbuser
DBPASSWD=hawkstagram123
HOST=$(hostname)
GITUSER=EnterHere
GITPASS=EnterHere

echo "==================================================="
echo "Preparing MariaDB..."
echo "==================================================="
	sudo apt-get -y install software-properties-common
	sudo apt-get -y remove mysql-server
	sudo apt-get -y autoremove
	sudo apt-get -y remove mysql-client
	sudo apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0xcbcb082a1bb943db
	sudo add-apt-repository 'deb [arch=amd64,i386,ppc64el] http://nyc2.mirrors.digitalocean.com/mariadb/repo/10.2/ubuntu trusty main'

	export DEBIAN_FRONTEND=noninteractive
	sudo debconf-set-selections <<< "mariadb-server-10.2 mysql-server/root_password password $DBPASSWD"
	sudo debconf-set-selections <<< "mariadb-server-10.2 mysql-server/root_password_again password $DBPASSWD"
	sudo debconf-set-selections <<< "mariadb-server mysql-server/root_password password $DBPASSWD"
	sudo debconf-set-selections <<< "mariadb-server mysql-server/root_password_again password $DBPASSWD" 

echo "Installing MariaDB Now"
	sudo -E apt-get -qq install mariadb-server
	sudo service mysql restart
	sudo mysql_upgrade -u root -p$DBPASSWD --force

echo "==================================================="
echo "Creating Encryption Key"
echo "==================================================="
echo "1;275F957BBA71D20F42826C3854C7B869;C1845BA78881CE2DE5D1165F359F885A4E7F042850376FBC14CF0B900B" > keys.txt
ls -l
cat keys.txt

sudo mysql -u root -p$DBPASSWD hawkstagram -e "ALTER TABLE users ENCRYPTED=YES ENCRYPTION_KEY_ID=1;"

#sudo vim /etc/mysql/my.cnf -- append under [mysqld]
#skip-external-locking
#plugin-load-add=file_key_management.so
#file-key-management
#file-key-management-filename=/home/vagrant/keys.txt
#file-key-management-encryption-algorithm=aes_ctr

sudo service mysql restart