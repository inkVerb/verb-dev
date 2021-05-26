#!/bin/bash
# inkVerb donjon asset, verb.ink
## This script creates a Postfix vmail user account based on a config
## This is intended to be run by cron regularly to ensure that the email account used by the backend of web apps remains and does not change

# Set the account
accountConfig="$1"

. /opt/verb/conf/vsysmail.${accountConfig}
. /opt/verb/conf/siteurilist

password="$(/bin/echo $PASSWORD | /usr/bin/openssl passwd -1 -stdin)"

# Remove the email directory (it's not for receiving anyway)
/usr/bin/rm -rf /var/vmail/${vmaildirectory}

# Make the database entry
## We need the alias entry for the mailbox to be active
/usr/bin/mysql --defaults-extra-file=/opt/verb/conf/mysqldb.vmail.cnf -e "
INSERT INTO mailbox
  (username, password, name, maildir, quota, local_part, domain, created, modified, active)
VALUES
  ('$username', '$password', '$name', '$vmaildirectory', '$mailboxsize', '$user', '$nameURI', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, 1)
ON DUPLICATE KEY UPDATE
  username = VALUES(username),
  password = VALUES(password),
  name = VALUES(name),
  maildir = VALUES(maildir),
  quota = VALUES(quota),
  local_part = VALUES(local_part),
  domain = VALUES(domain),
  modified = VALUES(modified),
  active = VALUES(active);

INSERT INTO alias
  (address, goto, domain, created, modified, active)
VALUES
  ('$username', '$username', '$nameURI', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, 1)
ON DUPLICATE KEY UPDATE
  address = VALUES(address),
  goto = VALUES(goto),
  domain = VALUES(domain),
  modified = VALUES(modified),
  active = VALUES(active);"
