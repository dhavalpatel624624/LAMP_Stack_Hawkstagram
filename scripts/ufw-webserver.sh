#!/bin/bash
# ufw script
#

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
