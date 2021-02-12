#!/bin/sh
# This is intended to be run by crontab to automatically renew inkCert Proper certs

# Include settings
. /opt/verb/conf/sitenameip

# Stop Apache
/usr/sbin/apachectl -k graceful-stop
## Hard stop in case it doesn't work
/bin/systemctl stop apache2

# Renew
### Put the inkCert Proper renew script here!!!!!

# Start Apache
/bin/systemctl start apache2
/bin/systemctl restart apache2

# Finish
exit 0
