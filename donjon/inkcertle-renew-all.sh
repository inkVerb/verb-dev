#!/bin/sh
# This is intended to be run by crontab to automatically renew letsencrypt certs

# Include settings
. /opt/verb/conf/sitenameip
. /opt/verb/conf/inkcert/inkcertstatus

# Stop Apache
#/usr/sbin/apachectl -k graceful-stop
## Hard stop in case it doesn't work
#/bin/systemctl stop apache2

# Renew LE
/usr/local/bin/certbot renew --dry-run

# Log
if [ $? -ne 0 ]
 then
        ERRORLOG=`tail /var/log/inkcert/inkcertle.log`
        echo -e "The Lets Encrypt verb.ink cert has not been renewed! \n \n" $ERRORLOG | mail -s "Lets Encrypt Cert Alert" ${INKCERTEMAIL}
fi

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
