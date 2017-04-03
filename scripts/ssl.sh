#!/bin/bash
# ssl script
#

sudo a2enmod ssl

sudo service apache2 restart

sudo mkdir /etc/apache2/ssl

sudo cp team-2-hawkstagram/scripts/ssl/apache.crt /etc/apache2/ssl
sudo cp team-2-hawkstagram/scripts/ssl/apache.key /etc/apache2/ssl
sudo cp team-2-hawkstagram/scripts/ssl/default-ssl.conf /etc/apache2/sites-available/

sudo a2ensite default-ssl.conf

sudo service apache2 restart


