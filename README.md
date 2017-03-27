# team-2-hawkstagram
ITMT 430 Hawkstagram Project

Jason Hedlund- Security/UI

Dhaval Patel - Operations/Developer

Jacquelle Rowell - UI/Project Management

Lap-Heng Keung - Operations/Project Management

Doug Rubio - Security/Operations

# Packer Setup
1. Go into the install folder - "packer build ubuntu14045-webserver" or "packer build ubuntu14045-database" however it may be easier to simply tab-complete and build the two separate boxes
2. Let packer run, you should now have two box images in the build folder, one for the database and one for webserver
3. "vagrant box add packer_output.box --name boxname" you can name the box however you want, however remember the box names so that you can initialize the correct one. 
4. (OPTIONAL) "vagrant box list" to confirm that you correctly added the two boxes

# To get it setup
1. Make sure you edit the vagrantfiles with the correct box name, or "vagrant init database/webserver" depending on how you name it
2. config.vm.provision :shell, path: "../scripts/database.sh" or "../scripts/webserver.sh"
3. config.vm.network "public_network", ip: "192.168.1.X" -- make sure you set it up with your assigned IP address, otherwise you can refer to http://askubuntu.com/questions/470237/assigning-a-static-ip-to-ubuntu-server-14-04-lts
4. Look at the credentials of the provisioner file, those are defaults, change them as you like
5. Git clone the repository to the correct locations(may need sudo), "git clone https://github.com/illinoistech-itm/team-2-hawkstagram.git"
6. On the webserver, you will want to "sudo cp -r team-2-hawkstagram/webpages /var/www/html"
7. You can either spinup the database's phpmyadmin or directly go into mysql and import database schema from file "hawkstagram.sql" and "dummydata.sql" in the sql directory
8. "vagrant up" or "vagrant reload --provision"

# Reference Links
 +Updating and creating timestamps with MySQL http://gusiev.com/2009/04/update-and-create-timestamps-with-mysql/  
 +Using Triggers for Updating Timestamps http://stackoverflow.com/questions/6576989/two-mysql-timestamp-columns-in-one-table  
 +Echoing past file permissions https://ubuntuforums.org/showthread.php?t=981258  