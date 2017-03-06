# team-2-hawkstagram
ITMT 430 Hawkstagram Project

Jason Hedlund- Security/UI

Dhaval Patel - Operations/Developer

Jacquelle Rowell - UI/Project Management

Lap-Heng Keung - Developer/Project Management

Doug Rubio - Security/Operations

# Packer Setup
1. Go into the install folder - "packer build ubuntu-webserver" or "packer build ubuntu-database"
2. Let packer run, you should now have two box images in the build folder, one for the database and one for webserver
3. "vagrant box add packer_output.box --name boxname"

# To get it setup
1. Make sure you edit the vagrantfiles with the correct box name, or "vagrant init database/webserver" depending on how you name it
2. config.vm.provision :shell, path: "bootstrap.sh"
3. config.vm.network "public_network", ip: "192.168.1.X" -- make sure you set it up with your assigned IP address, otherwise you can refer to http://askubuntu.com/questions/470237/assigning-a-static-ip-to-ubuntu-server-14-04-lts
4. Look at the credentials of the provisioner file, those are defaults, change them as you like

