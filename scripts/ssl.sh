#!/bin/bash
# ssl script
#

sudo a2enmod ssl

sudo service apache2 restart

sudo mkdir /etc/apache2/ssl

sudo openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /etc/apache2/ssl/apache.key -out /etc/apache2/ssl/apache.crt

printf 'US\Illinois\Chicago\Illinois Institute of Technology\Information Technology Management\Hawkstagram\jhedlund@hawk.iit.edu'



