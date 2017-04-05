# team-2-hawkstagram
ITMT 430 Hawkstagram Project

192.168.1.X

Jason Hedlund- Security/UI -> X=194/195/200

Dhaval Patel - Operations/Developer -> X=192/193/202

Jacquelle Rowell - UI/Project Management -> X=198/199/204 

Lap-Heng Keung - Operations/Project Management -> X=191/201/2016

Doug Rubio - Security/Operations ->  X=196/197/203 

# Packer Setup
1. Go into the install folder - "packer build ubuntu14045-webserver" or "packer build ubuntu14045-database" 
2. Let packer run, you should now have two box images in the build folder, one for the database and one for webserver
3. "vagrant box add packer_output.box --name boxname" name it database for the database box and webserver for the webserver box  
4. (OPTIONAL) "vagrant box list" to confirm that you correctly added the two boxes

# To get it setup
1. Make sure you edit the vagrantfiles with the correct box name, or "vagrant init database/webserver"
2. config.vm.provision :shell, path: "../scripts/database.sh" or "../scripts/webserver.sh" change pathfile to scripts folder
3. config.vm.network "public_network", ip: "192.168.1.X" -- make sure you set it up with your assigned IP address, otherwise you can refer to http://askubuntu.com/questions/470237/assigning-a-static-ip-to-ubuntu-server-14-04-lts
4. Look at the credentials of the provisioner file, those are defaults, change them as you like
5. Edit the appropriate shell script for the GITUSER and GITPASS fields at the top so the provisioner can automate git cloning.
6. "vagrant up" or "vagrant reload --provision"
7. "vagrant ssh" -- make sure you let each box vagrant up itself first, otherwise you may run into errors. if you do, let one box finish spinning up and then spin up the second.

# Reference Links
 +Updating and creating timestamps with MySQL http://gusiev.com/2009/04/update-and-create-timestamps-with-mysql/  
 +Using Triggers for Updating Timestamps http://stackoverflow.com/questions/6576989/two-mysql-timestamp-columns-in-one-table  
 +Echoing past file permissions https://ubuntuforums.org/showthread.php?t=981258  