<?php

$CONF['configured'] = true;

// With this long hash, the setup password is: inkverb77
$CONF['setup_password'] = '6eb7d8657903da15ba69349209a1c4f9:4b0f638a1fc2788682cee2f1c7416c883cfa33e9';


$CONF['postfix_admin_url'] = 'https://pfa.emailTLDURI286/pfafolder286';

$CONF['default_language'] = 'en';

$CONF['language_hook'] = '';

$CONF['database_type'] = 'mysqli';
$CONF['database_host'] = 'localhost';
$CONF['database_user'] = 'mail';
$CONF['database_password'] = 'mailpassword';
$CONF['database_name'] = 'mail';

$CONF['database_prefix'] = '';
$CONF['database_tables'] = array (
    'admin' => 'admin',
    'alias' => 'alias',
    'alias_domain' => 'alias_domain',
    'config' => 'config',
    'domain' => 'domain',
    'domain_admins' => 'domain_admins',
    'fetchmail' => 'fetchmail',
    'log' => 'log',
    'mailbox' => 'mailbox',
    'vacation' => 'vacation',
    'vacation_notification' => 'vacation_notification',
    'quota' => 'quota',
	'quota2' => 'quota2',
);

$CONF['admin_email'] = 'admin@nameURI286';

$CONF['smtp_server'] = 'localhost';
$CONF['smtp_port'] = '25';

$CONF['encrypt'] = 'md5crypt';

$CONF['authlib_default_flavor'] = 'md5raw';

$CONF['dovecotpw'] = "/usr/sbin/doveadm pw";

$CONF['password_validation'] = array(
#    '/regular expression/' => '$PALANG key (optional: + parameter)',
    '/.{5}/'                => 'password_too_short 5',      # minimum length 5 characters
    '/([a-zA-Z].*){3}/'     => 'password_no_characters 3',  # must contain at least 3 letters (A-Z, a-z)
    '/([0-9].*){2}/'        => 'password_no_digits 2',      # must contain at least 2 digits
);

$CONF['generate_password'] = 'NO';

$CONF['show_password'] = 'NO';

$CONF['page_size'] = '500';

$CONF['default_aliases'] = array (
    'abuse' => 'abuse@nameURI286',
    'hostmaster' => 'hostmaster@nameURI286',
    'postmaster' => 'postmaster@nameURI286',
    'webmaster' => 'webmaster@nameURI286'
);

$CONF['domain_path'] = 'YES';

$CONF['domain_in_mailbox'] = 'NO';

$CONF['maildir_name_hook'] = 'NO';

$CONF['aliases'] = '1000';
$CONF['mailboxes'] = '1000';
$CONF['maxquota'] = '1000';
$CONF['domain_quota_default'] = '2048';

$CONF['quota'] = 'YES';

$CONF['domain_quota'] = 'YES';

$CONF['quota_multiplier'] = '1048576';


$CONF['transport'] = 'NO';

$CONF['transport_options'] = array (
    'virtual',
    'local',
    'relay'
);

$CONF['transport_default'] = 'virtual';

$CONF['vacation'] = 'YES';

$CONF['vacation_domain'] = 'away.nameURI286';

$CONF['vacation_control'] ='YES';

$CONF['vacation_control_admin'] = 'YES';

$CONF['vacation_choice_of_reply'] = array (
   0 => 'reply_once',        // Sends only Once the message during Out of Office
   # considered annoying - only send a reply on every mail if you really need it
   # 1 => 'reply_every_mail',       // Reply on every email
   60*60 *24*7 => 'reply_once_per_week'        // Reply if last autoreply was at least a week ago
);


$CONF['alias_control'] = 'YES';

$CONF['alias_control_admin'] = 'YES';

$CONF['special_alias_control'] = 'NO';

$CONF['alias_goto_limit'] = '0';

$CONF['alias_domain'] = 'YES';

$CONF['backup'] = 'YES';

$CONF['sendmail'] = 'YES';

$CONF['logging'] = 'YES';

$CONF['fetchmail'] = 'NO';

$CONF['fetchmail_extra_options'] = 'NO';

$CONF['show_header_text'] = 'YES';
$CONF['header_text'] = 'nameURI286 email accounts & settings';

$CONF['show_footer_text'] = 'YES';
$CONF['footer_text'] = 'Login to inkVerb webmail';
$CONF['footer_link'] = 'https://rc.emailTLDURI286/rcfolder286';

$CONF['motd_user'] = 'Ink is a verb. So, get inking!';
$CONF['motd_admin'] = 'Ink is a verb. So, get inking!';
$CONF['motd_superadmin'] = 'Ink is a verb. So, get inking!';

$CONF['welcome_text'] = <<<EOM
Welcome to inkVerb email! This is real-deal email.

- Email's settings can be administered at pfa.emailTLDURI286/???
IMPORTANT NOTE ABOUT FORWARD ADDRESSES: If you want to use one emailbox to send mail "from" a separate forwarding address, the "from" address must be the same domain and must forward to the sending address. Otherwise, your server will reject the send request, which can cause errors in services such as Gmail. For example. If you use "forwards@inkisaverb.com" to send mail via SMTP, but you want to use the "From" identity address as "jimmy@inkisaverb.com", then in Alias/Forwarding settings, "jimmy@inkisaverb.com" must be set to forward emails to "forwards@inkisaverb.com".

- Once emailboxes are set up at pfa.emailTLDURI286/??? you can log into them at rc.emailTLDURI286/??? .

- If you set up this email with other email clients, such as Outlook or Thunderbird, you may need to approve the SSL security Certificate before receiving or sending (approve it two times). This is for security.

- We recommend Thunderbird for a desktop email client since we use it to test our servers, but other clients should also work. For desktop email clients, use IMAP if you want your emails left on the server as "backup" or to sync with email clients on more than one computers; this will count against your space on the server. If you use POP instead, then your email client can delete email from the server (it's in settings) so those emails won't count against your inbox space on the email server, but there will be no backup of your email and you can't sync those emails to any other email client. POP and IMAP can both be good choices, depending on your needs. 

- For using this in Gmail, you may need an @gmail.com address. If you don't log into Gmail with an @gmail.com email address, perhaps wtih another email address that you pay Gmail for, then you may not be able to set up this email with that Gmail account.

- There are a few ways to set up this email address in Gmail:

Gmail Part 1: Send "from" another email
Go to: Settings > Accounts and Import > Send mail as: > Add another email address you own...
Enter your email address ('Treat as alias' can be either option)...
On the page with SMTP settings, choose Port 465, SSL, and the password you set in your account at emailTLDURI286.

Gmail Part 2: POP into your emailbox you set up at pfa.emailTLDURI286/???
Go to: Settings > Accounts and Import > Check mail from other accunts: > "Add another account" ...Then follow the steps to add the emailbox you created at pfa.emailTLDURI286/???.

Gmail Part 2 (Option B, less perferable): Forward to your Gmail
Rather than doing a POP from Gmail into the emailbox created at pfa.emailTLDURI286/???, set up that same emailbox at pfa.emailTLDURI286/??? to "Forward" or "Alias" to your Gmail.

*Gmail NOTE* If you change your password or update the server, you'll also have to update/revisit the same settings in Gmail.
To change the Gmail settings later: Settings > Accounts and Import > Send mail as/Check mail from other accunts > [your email] - "edit info"

Thanks for using this real-deal, genuine email server for your email. And, remember...

Ink is a verb. So, ink!
inkVerb Team

PS Here are the email client settings if you are ever asked:
* Use "manual" setup
* Accept all "certificates" (for security questions)
* STARTTLS is preferred; SSL/TLS doesn't work (SSL and TLS conflict, use SSL or TLS)

IMAP:   imap.emailTLDURI286   Port: 143/STARTTLS 143/TLS 993/SSL (choose)
POP3:   pop3.emailTLDURI286   Port: 110/STARTTLS 110/TLS 995/SSL (choose)
SMTP:   smtp.emailTLDURI286   Port: 25/STARTTLS 25/TLS 465/SSL (choose)

Authentication: Normal password
Username: [your emailTLDURI286 username/email address]
Password: [your emailTLDURI286 login password]

EOM;

$CONF['emailcheck_resolve_domain']='YES';

$CONF['show_status']='YES';

$CONF['show_status_key']='YES';

$CONF['show_status_text']='&nbsp;&nbsp;';

$CONF['show_undeliverable']='YES';
$CONF['show_undeliverable_color']='tomato';

$CONF['show_undeliverable_exceptions']=array("unixmail.domain.ext","exchangeserver.domain.ext","nameURI286","gmail.com","hotmail.com","inkisaverb.com","yahoo.com");
$CONF['show_popimap']='YES';
$CONF['show_popimap_color']='darkgrey';

$CONF['show_custom_domains']=array("nameURI286");
$CONF['show_custom_colors']=array("#111111");

$CONF['recipient_delimiter'] = "+";

$CONF['mailbox_postcreation_script'] = '';

$CONF['mailbox_postedit_script'] = '';

$CONF['mailbox_postdeletion_script'] = '';

$CONF['domain_postcreation_script'] = '';

$CONF['domain_postdeletion_script'] = '';

//$CONF['create_mailbox_subdirs'] = array('Archive','Drafts','Junk','Sent','Trash');
$CONF['create_mailbox_subdirs'] = array();

$CONF['create_mailbox_subdirs_host']='localhost';

$CONF['create_mailbox_subdirs_prefix']='';

$CONF['used_quotas'] = 'NO';

$CONF['new_quota_table'] = 'YES';

$CONF['create_mailbox_subdirs_hostoptions'] = array('');

$CONF['theme_logo'] = 'images/logo-ink.png';

$CONF['theme_css'] = 'css/default.css';

$CONF['theme_custom_css'] = '';

$CONF['xmlrpc_enabled'] = false;

/* vim: set expandtab softtabstop=4 tabstop=4 shiftwidth=4: */
