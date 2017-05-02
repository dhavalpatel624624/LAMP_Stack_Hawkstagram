#!/bin/bash	

sudo git pull origin master
sudo cp -r /var/www/team-2-hawkstagram/webpages /var/www/html
cd ../html/webpages/includes
sudo vim dbconnect.php
