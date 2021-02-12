#!/bin/sh
# This is intended to be run by crontab to automatically renew Certbot-DigitalOcean-API certs

# Include settings
. /opt/verb/conf/sitenameip
. /opt/verb/conf/inkcert/inkcertstatus

# Stop Apache
#/usr/sbin/apachectl -k graceful-stop
## Hard stop in case it doesn't work
#/bin/systemctl stop apache2

# Renew LE
/usr/local/bin/certbot renew

# Log
if [ $? -ne 0 ]
 then
        ERRORLOG=`tail /var/log/inkcert/inkcertle.log`
        echo -e "The Lets Encrypt verb.ink cert has not been renewed! \n \n" $ERRORLOG | mail -s "Lets Encrypt Cert Alert" ${INKCERTEMAIL}
fi

# Start Apache
/bin/systemctl start apache2
/bin/systemctl restart apache2

# Finish
exit 0
