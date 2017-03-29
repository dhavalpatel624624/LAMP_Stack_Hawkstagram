#!/bin/bin/expect
# ssl script
#

sudo apt-get install expect -y

sudo a2enmod ssl

sudo service apache2 restart

sudo mkdir /etc/apache2/ssl

spawn openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /etc/apache2/ssl/apache.key -out /etc/apache2/ssl/apache.crt

expect "Country Name (2 letter code) [AU]:"
send "US"

expect "State or Province Name (full name) [Some-State]:"
send "Illinois"

expect "Locality Name (eg, city) []:"
send "Chicago"

expect "Organization Name (eg, company) [Internet Widgits Pty Ltd]:"
send "Illinois Institute of Technology"

expect "Organizational Unit Name (eg, section) []:"
send "Information Technology Management"

expect "Common Name (e.g. server FQDN or YOUR name) []:"
send "Hawkstagram"

expect "Email Address []:"
send "jhedlund@hawk.iit.edu"

