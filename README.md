# team-2-hawkstagram
ITMT 430 Hawkstagram Project

192.168.1.X

Jason Hedlund- Security/UI -> X=194/195/200

Dhaval Patel - Operations/Developer -> X=192/193/202

Jacquelle Rowell - UI/Project Management -> X=198/199/204 

Lap-Heng Keung - Operations/Project Management -> X=191/201/206

Doug Rubio - Security/Operations ->  X=196/197/203 

# Packer Setup
1. Go into the install folder
2. Packer Build

```
packer build ubuntu14045-webserver
packer build ubuntu14045-database
packer build ubuntu14045-slave
```

3. Let packer run, you should now have three box images in the build folder, one for the database, webserver and slave
4. Add these boxes into vagrant

```
vagrant box add packer_output.box --name webserver
vagrant box add packer_output.box --name database
vagrant box add packer_output.box --name slave
```

9. (OPTIONAL) "vagrant box list" to confirm that you correctly added the three boxes

# Webserver Installation
1. Make sure you edit the vagrantfiles with the correct box name, or "vagrant init webserver"
2. Change pathfile to scripts folder depending on where box is initialized

```
config.vm.provision :shell, path: "../scripts/webserver.sh"
config.vm.network "public_network", ip: "192.168.1.X"
```
3. Make sure you set it up with your assigned IP address, otherwise you can refer to http://askubuntu.com/questions/470237/assigning-a-static-ip-to-ubuntu-server-14-04-lts
4. Look at the credentials of the provisioner file, those are defaults, change them as you like
5. Edit the appropriate shell script for the GITUSER and GITPASS fields at the top so the provisioner can automate git cloning.

```
vagrant up or vagrant reload --provision
vagrant ssh
```

6. Make sure you let each box vagrant up itself first, otherwise you may run into errors. If you do, let one box finish spinning up and then spin up the second.

# Database Installation
1. Make sure you edit the vagrantfiles with the correct box name, or "vagrant init database"
2. Change pathfile to scripts folder depending on where box is initialized

```
config.vm.provision :shell, path: "../scripts/database.sh"
config.vm.network "public_network", ip: "192.168.1.X"
```

3. Make sure you set it up with your assigned IP address, otherwise you can refer to http://askubuntu.com/questions/470237/assigning-a-static-ip-to-ubuntu-server-14-04-lts
4. Look at the credentials of the provisioner file, those are defaults, change them as you like
5. Edit the appropriate shell script for the GITUSER and GITPASS fields at the top so the provisioner can automate git cloning.

```
vagrant up or vagrant reload --provision
vagrant ssh
```

# Slave Installation and Setup
1. Build packer
2. Add the box, call it slave 
3. Make new folder somewhere called Slave
4. Powershell into that folder
5. Vagrant init slave
6. Edit Vagrantfile with the designated slave IP, database.sh script, and the following line "config.vm.network :forwarded_port, guest: 80, host: 4567"
7. SSH into your master DB box 

```
sudo vim /etc/mysql/my.cnf
```

*These will primarily be comments, so just uncomment them*  
```
bind-address = same IP for main database vagrant box
server-id = 1
log_bin = /var/log/mysql/mysql-bin.log
binlog_do_db = hawkstagram
```

**Save file**

**Login to main database:**

```
mysql -u root -p
```

```
GRANT REPLICATION SLAVE ON *.* TO 'dbuser' IDENTIFIED BY 'hawkstagram123';
FLUSH PRIVILEGES;
SHOW MASTER STATUS;
```

example:

| File | Position | Binlog_Do_DB | Binlog_Ignore_DB |
| --- | --- | --- | --- | 
| mysql-bin.000001 | 107 | newdatabase | 

1 row in set (0.00 sec)

**If you do not see this example, first try to restart the mysql service, as well as confirm that the IP address in the my.cnf file is correct**

```
sudo service mysql restart
```

Take note of the "000001" and the position, they may be different from this example. 

```
UNLOCK TABLES;

QUIT;
```

8. Go back to the slave DB box, since you should already have a Hawkstagram db already from the initializing shell script do the following things. 

```
sudo vim /etc/mysql/my.cnf
```

```
bind-address = IP address for slave DB vagrant box
server-id = 2
log_bin = /var/log/mysql/mysql-bin.log
binlog_do_db = hawkstagram
```

**Save**

9. sudo service mysql  restart

10. Go back into your slave DB box and do the following in a MySQL prompt,

**Login to main database:**
```
mysql -u root -p

CHANGE MASTER TO MASTER_HOST='Your MASTER IP',
MASTER_USER='dbuser', 
MASTER_PASSWORD='hawkstagram123', 
MASTER_LOG_FILE='mysql-bin.000001',(Your bin from earlier) 
MASTER_LOG_POS=  107; (Your pos number from earlier)

STOP SLAVE;

RESET SLAVE;

START SLAVE;
```
**If you are having issues with the slave database, please run these commands in the MySQL prompt:**

```
SET GLOBAL SQL_SLAVE_SKIP_COUNTER = 5;
```


11. Now make an edit on the master database such as inserting a new user
```
mysql -u root -p
use hawkstagram;

INSERT INTO users (username, email, salted_password, first_name, last_name, date_created, date_updated)
VALUES ('Toad', 'toad@hawk.iit.edu', 'password', 'Toad', 'Toad', NOW(), NOW());
```

12. Now on the SLAVE database:
```
SELECT * FROM users; 
```

It should show the newly added user. If not, in MySQL use the command: use hawkstagram;

13. This command will show the status of the slave:
```
SHOW SLAVE STATUS\G 
```
The top should say "Waiting for master to send event."
```
Slave_IO_Running: YES 
Slave_SQL_Running: YES
```

Make a new line in the /etc/mysql/my.cnf file :
relay-log = /var/log/mysql/mysql-relay-bin.log

# Integrating Webserver to Slave and Master DB

1. SSH into your three boxes
2. In WEBSERVER, cd /var/www/html/webpages/includes
3. Change the IPs to your slave and master db

```
sudo vim dbconnect.php
```

4. In MASTER DB, login to MySQL: 

```
mysql -u root -p 
GRANT INSERT, SELECT ON hawkstagram.* TO ''@'your webserver IP' identified by 'hawkstagram123';
```

5. In SLAVE DB, login to MySQL:

```
mysql -u root -p 
GRANT INSERT, SELECT ON hawkstagram.* TO ''@'your webserver IP' identified by 'hawkstagram123';
```


6. In your WEBSERVER, test if your database is connected:

```
cd /var/www/html/webpages/includes
php dbconnect.php
```

You should get no error messages, if there is an error then an error "echo" will appear.

# Encrypt Databases (Uses MariaDB due to issues with MySQL 5.5 encryption)
 
1. First you should copy your original database box and make a new vagrant box in a different folder to do this just in case anything screws up.

```
vagrant package --output database2
```

2. Go into new folder:

```
vagrant init database2
vagrant up
vagrant ssh
```

3. Remove MySQL:

```
sudo apt-get remove mysql-server
sudo apt-get remove mysql-client
```

Update MariaDB repos for our ubuntu:
```
sudo apt-get install software-properties-common
sudo apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0xcbcb082a1bb943db
sudo add-apt-repository 'deb [arch=amd64,i386,ppc64el] http://mirrors.accretive-networks.net/mariadb/repo/10.2/ubuntu trusty main'
sudo apt-get update
sudo apt-get install mariadb-server
```

Restart database:

```
sudo service mysql restart (MariaDB uses same commands as MySQL)
```

Run a MySQL upgrade: (I think this helps with installing the plugins necessary for encryptions)

```
sudo mysql_upgrade -u root -p
```

Edit conf file under the [mysqld] section

```
sudo vim /etc/mysql/my.cnf
```
**Add under the [mysqld] section**
```
skip-external-locking
plugin-load-add=file_key_management.so
file-key-management
file-key-management-filename=/home/vagrant/keys.txt
file-key-management-encryption-algorithm=aes_ctr
```

**Save file**

Now make a file called keys.enc and just put this at the top
1;275F957BBA71D20F42826C3854C7B869;C1845BA78881CE2DE5D1165F359F885A4E7F042850376FBC14CF0B900B

```
echo "1;275F957BBA71D20F42826C3854C7B869;C1845BA78881CE2DE5D1165F359F885A4E7F042850376FBC14CF0B900B" > keys.enc
ls -l
cat keys.enc
```

This is a key made with openssl using the password hawkstagram123. If we want more keys we just make them with openssl put them into the file.

**Save file/Restart the database**

```
sudo service mysql restart
sudo mysql -u root -p
```

Now we can go ahead and encrypt our tables

```
use hawkstagram;
ALTER TABLE users ENCRYPTED=YES ENCRYPTION_KEY_ID=1;
```

# Reference Links
 +Updating and creating timestamps with MySQL http://gusiev.com/2009/04/update-and-create-timestamps-with-MySQL/  
 +Using Triggers for Updating Timestamps http://stackoverflow.com/questions/6576989/two-MySQL-timestamp-columns-in-one-table  
 +Echoing past file permissions https://ubuntuforums.org/showthread.php?t=981258  
 +MySQL command to permit webserver to access DB https://serverfault.com/questions/315985/permanent-connection-between-webserver-and-database-server  
 +MariaDB Install https://downloads.mariadb.org/mariadb/repositories/#mirror=accretive&distro=Ubuntu&distro_release=trusty--ubuntu_trusty&version=10.2  
 +MariaDB Encryption https://mariadb.com/kb/en/mariadb/data-at-rest-encryption/  
 +Secure MySQL Instattion https://gist.github.com/Mins/4602864
 


 
