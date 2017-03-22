#!/bin/bash
# let's encrypt
#

wget https://dl.eff.org/certbot-auto
chmod a+x certbot-auto

./certbot-auto

./path/to/certbot-auto --apache

./path/to/certbot-auto renew --dry-run



