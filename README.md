# team-2-hawkstagram
ITMT 430 Hawkstagram Project

Jason Hedlund- Security/UI

Dhaval Patel - Operations/Developer

Jacquelle Rowell - UI/Project Management

Lap-Heng Keung - Developer/Project Management

Doug Rubio - Security/Operations

# To get it setup
1. Make sure you have already run the "packer build .json" so you have your Ubuntu 14.04.5 box 
2. Spin up your vagrant boxes (i.e database and webserver)
3. "vagrant box add packer_output.box --name boxname"
4. Make sure you edit the vagrantfiles with the correct box name, or "vagrant init database/webserver" depending on how you name it
5. config.vm.provision :shell, path: "bootstrap.sh"
6. config.vm.network "public_network", ip: "192.168.1.X" -- make sure you set it up with your assigned IP address, otherwise you can refer to http://askubuntu.com/questions/470237/assigning-a-static-ip-to-ubuntu-server-14-04-lts
7. "vagrant ssh" change your /etc/hosts and /etc/hostname files 
8. Look at the credentials of the provisioner file, those are defaults, change them as you like

