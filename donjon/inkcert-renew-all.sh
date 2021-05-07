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

# Restart the web server
if [ ${SERVERTYPE} = "laemp" ]; then
  /usr/bin/systemctl restart nginx; wait
  /usr/bin/systemctl restart httpd; wait
elif [ ${SERVERTYPE} = "lemp" ]; then
  /usr/bin/systemctl restart nginx; wait
elif [ ${SERVERTYPE} = "lamp" ]; then
  /usr/bin/systemctl restart httpd; wait
fi

# Recompile Postfix for SNI
if [ -f "/etc/postfix/virtual_ssl.map" ]; then
  /usr/bin/postmap -F hash:/etc/postfix/virtual_ssl.map
  /usr/bin/systemctl restart postfix
fi

# Finish
exit 0
