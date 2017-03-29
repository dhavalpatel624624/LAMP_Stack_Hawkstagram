#!/bin/bash
# ssl script
#

sudo a2enmod ssl

sudo service apache2 restart

sudo mkdir /etc/apache2/ssl

echo -e 'US\nIllinois\nChicago\nIllinois Institute of Technology\nInformation Technology Management\nHawkstagram\njhedlund@hawk.iit.edu\n'| sudo openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /etc/apache2/ssl/apache.key -out /etc/apache2/ssl/apache.crt





