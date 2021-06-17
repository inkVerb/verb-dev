# Installation and information for inkVerb's "verber" web server
## verb-dev

For installation, see: [HOW-TO-USE.md](https://github.com/inkVerb/verb-dev/blob/master/HOW-TO-USE.md)

# Notes
DEV version numbers have an extra digit and never end in 0, skipping it. This reserves the final number of the stable channel for vital patches.
eg:
stable version: 1.04.00 (main release), 1.04.01 (vital update, no new features), 1.04.02 (vital update, no new features)
develp version: 1.04.19, (NEVER 1.04.20), 1.04.21, 1.04.22

IMPORTANT: As of v0.86.00, serfs are being integrated into the "yeo" tool in the inkverb/yeo repo. This will manage the serfs by providing validation, help, and making them somewhat "mistake-proof". This is a work in progress, but will make this software ready for early beta testing.

# Installation:

## 1. SSH access
	i. Point nameservers to NS1.DIGITALOCEAN.COM NS2.DIGITALOCEAN.COM NS3.DIGITALOCEAN.COM
	ii. Set name subdomains for server IP: NAME.verb.ink NAME.verb.one NAME.verb.email NAME.verb.blue NAME.verb.vip NAME.verb.kiwi NAME.verb.red
	iii. Set the port and ssh logins (for digitalocean)
		- Create ssh keys, two ways:
			1. `ssh-keygen -t rsa -f ~/.ssh/SOME_NAME_YOU MAKE` (passphrase if you want to enter it every time)
			2. Use vrk: `ssh-craft-key SOME_NAME_YOU MAKE`
		- Set up your droplet with ssh keys, which you must)
		- Your-Droplet > Access > <Reset Root Password>, get it from your email...
		- `ssh root@DROPLETIPADDRESS` (do the password thing, answer 'yes' if asked about establishing authenticity of a host IP key fingerprint and if you're sure you want to continue)
		- `nano /etc/ssh/sshd_config` "Port 5555" (for example)
		- ssh-only setup, two ways:
			1. `nano /etc/ssh/sshd_config` "PermitRootLogin without-password" (only if you set up the ssh keys in digitalocean, which you should)
			2. Use vrk:
				a. `ssh-add-key [surfer (server nickname)] [SSH_keyname] [server-password]` (only if you did not add the ssh keys in digitalocean)
				b. `ssh-keyportserver [surfer (server nickname)] [server-password] [new-port (optional)]`

## 2. Download from git
	`cd /opt`
	`git clone https://github.com/inkVerb/verb`

## 3. Run the installation scripts
	`cd /opt/verb/inst`

### Special pre-installation
#### A. Is this a domain mod?
	Are you usingyour own vanity domain instead of the verb.ink domains?
	- `./make-dommod [host] [domain.tld]`
	- You will need two other slave DNS verbers set up, according to the next step
#### B. Is this a DNS slave server?
  This can still operate as a normal verber, but if you want to use it as a slave to others as a secondary DNS server, you need this
	- `./make-dns [host] [domain.tld]`
	- This will override normal host configuration settings
	- Later, master DNS verbers (which you want this DNS server to mirror) can be managed via:
	  - `inkdnsaddslave`
		- `inkdnskillslavedns`

### Normal Installation
#### 	i. `./make-preverber`    # prepares the server, mainly for locale
		* Follow in-file instructions, has optional parameters, reboot
		* Choose "y" or "Yes" when prompted
		* Locale setup may ask for settings, defaults should be okay, US-English is usually the goal.
#### 	ii. `./make-verber-laemp [ swap size in GB, ie: 2 ]`    # prepares directories, Apache configs, web apps, swap, "boss" users, etc. for installation, but no hostname or IP is defined yet.
		* Follow in-file instructions, requires parameters, reboot
		* Now the server is a standard out-of-box inkVerb, ready to setup, can be copied as-is
#### 	iii. `./setupverb [ long list of settings, see instructions inside the file ]`    # sets hostnames, IP, inkVerb namespace, and other settings across the server and the site goes live
		* Follow in-file instructions, requires parameters

## 4. SSL certs: hosted domain websites & email
### Two cert methods
#### Wildcard SSL certs: CertBot (cb)
	- `inkcertcb*` (Use for any wildcard certs)
#### Itemized SSL certs: Letsencrypt (le)
  - `inkcertle*` (This is used in example instructions)
	- Must run `addsubdomain` for each subdomain of a domain you wish to use
### Basic key tools
- i. `inkdnsinstall`
- ii. `inkcertinstall`
- iii. `inkvmailinstall [secret-path]`
- iv. `inkcertdle-all-verbs` add certs for all verb.tld domains
	- Use `inkcertle*` for verb.ink domains, even if using CertBot wildcard certs for hosted domains

### Email & PostFixAdmin
- i. pfa.NAME.verb.email/setup.php
	- After creating an admin login, run `postinstallpfa`
- ii. Login to pfa.NAME.verb.email/SECPATH
- iii. rc.NAME.verb.email/installer (may be phased out)

## 5. Adding and securing a domain, WordPress
- i. `adddomain DOMAIN.TLD` add the domain
- ii. `addsubdomain SUB DOMAIN.TLD` add any subdomains this way
- iii. `inkcertdole DOMAIN.TLD` add certs
- iv. `fixhttps DOMAIN.TLD` make it point to https (can also do after `installwp`)
- v. `fixwww DOMAIN.TLD` make www redirect to domain (can also do after `installwp`)
- vi. `installwp DOMAIN.TLD` install WordPress to that domain

## Note on Updates
Note: Update version numbers reference the framework. Ongoing updates continue for the serfs, etc job scripts. Framework needs rated, sequential alteration, which is why "version" numbers apply to them. Any update will update job scripts, regardless of the current version number.

The "repo" update list at verb/configs/inklists/repoverlist is updated with each update. To customise this, refer to repolinks in the same directory for versions and hashes, and run setrepocust to have your changes stick.

## File Structure Basics (for geeks and Star Trek fans)

I. All files are in the "verb" directory
	A. Verber uses a system of "bosses" (users) and "serfs" (bash scripts)
	B. Note basic directory (folder) structures (folder and directory are used interchangeably in verber instructions)
		- verb is the install folder
		- The inst directory will be deleted after install, necessary subdirectories of inst will be moved to where they need to go based on what you run before `setupverb`
		- First, the verber server must be pre-made (`make-preverber`), then made (`make-verber-laemp`).
		- This is a LAEMP server configuration (Nginx with an Apache reverse proxy for most webapps; some webapps only use Nginx)
		  - `make-verber-lemp` & `make-verber-lamp` are created as frameworks, but are not regularly tested
	C. The "conf" directory is simple and useful, containing many things:
		- MySQL database info for web apps by name
		- Info files: IP address, repo info, special inkVerb namespace, and other settings used by serfs and can be included in other bash scripts
		- Important MySQL configs that allow serfs and the MySQL boss to work with databases quickly, plus the MySQL root password if you ever need it
		- php.ini is only a symlink to the convenient file: php-YOURNAME.ini in configs.

II. "Serfs" (in the 'serfs' directory) are bash scripts that do the chores of the server, with no .sh extension
	A. They update, remove, install, create, etc.
	B. Every serf has instructions inside, many have variables and parameters
	  - Arguments for serf scripts are neither sanitized nor validated
		- Sometimes a serf will check for prerequisites or the number of arguments, but not always
		- Serfs must be run perfectly from the command line with little-to-no forgiveness
	C. "Bosses" are users (Linux, MySQL, etc.) so you don't need to login as root
		1. Bosses have home folders linked to verb, as needed
		2. Bosses are intended as a security option but are not necessary, you can run all serfs as root
		3. Bosses are sudoers and superusers and may require "sudo" if serf instructions require
	D. Serfs are intended to be run sudo by a boss, embedded in server-side scripts, such as PHP, Python, Perl, JS, etc., such as where Linux commands can be embedded for web interface GUI control.
	E. Some serfs deliver messages to help webmasters, but these are not necessarily intended to be displayed through a GUI server-side script
	F. Bosses and serfs leverage the power of verber: one-command installs, comparable to one-click installs.
		1. The most basic boss-serf chore is a MySQL boss creating databases when a serf installs a web app
		2. Serfs "install" web apps on the server without asking quesitons.
		3. The patron (you), then "setup" the web app after the serf "installs" it.
		4. Serfs will create your database, user, and password that you designate when you install a web app.
		5. The WordPress install serf enters the database info into the wp-config for you, so you don't even need it after you define it.
		6. Other web apps, on setup, may ask you for the MySQL database info you designated when you bossed the serf to install it.
		7. After installing an app, the serf should report a message with whatever instructions, databases and setup URL are necessary to finish setting-up the web app.
	G. "inkCert" is the inkVerb SSL serf task
		1. At release of verber, inkCert simply ran Letsencrypt cert scripts, so inkCert = Letsencrypt
		2. By telling serfs to do "inkcert" tasks throughout verber, Letsencrypt certs are fully managed by the verber
		3. inkCert automatically handles installation of mail certs and use in websites
		4. In later plans, inkVerb may become a certificate authority to offer free SSL certificates for all domains and subomains hosted on an inkVerb namespace verber server
		5. inkCert integrates with similar tools like inkDNS and inkDKIM, which automatically manage the DNS zone you need based on what you're doing, including DKIM-signed emails
	H. Backing up and restoring apps - AUTOMATED!!
		1. Use "backup" and "backuprestore" with the "namespace" of the app
		2. An app's "namespace" usually is the "vapps" subdireactory and the install serf "installAPPNAMESPACE"
		3. Use backupemail, etc. for email server backups. Normal backup does NOT work with email or email related apps.
		4. There are several serfs that start with "backup..." and each has instructions
	I. App "namespace"
		1. Every app has a unified name by which it is referred to throughout the server
		2. Email apps are somewhat of an exception
		3. Apps namespace appears in config files, vaps/APP directories, install serfs, etc. They are NOT listed anywhere, you have to just notice them.
	J. Serfs names
		1. Sefs tend to have unified "surnames" at the front of each surf's name so they sort by: task - app - mod |or| app - task - mod
		2. Serfs are surnamed this way to keep larger groups organized, usually depending on which surname would be more common. This is used by yeo.
		3. Serfs only use az09 characters so that APIs and terminal power-users can input them easily, they are not intended for noob humans looking them up as if in a phonebook, though, they do cluster somewhat alphabetically to help humans.
		4. Instructions for serfs exist in each file. THEY ARE NOT NOOB-PROOF! You could destroy your server system if you use a serf incorrectly. Read each file's instructions carefully before using from the command prompt.
		   * Serfs do not and never will have error-check/help functions and they use sh wherever possible; this is to keep their load and size small. Few (usually inkcert) use functions or bash rather than sh because the alternative would have made the files much larger.
		     ** The only exception to error-checking serfs relate to inkNet and inkCert, since those systems include many serfs with complex hierarchies. Their checks can automatically run batch serfs for unmet serf dependencies and prerequesites.
		   * Serfs are intended to be API-friendly/simple to support a "noob-proof" human interface, such as a GUI.
		   * Roadmap Note: A new set of larger "yeomen" bash scripts may be created with error-check/help and functions, which would be intended for Unix command line production.
			* An example yeoman could be "ink-inkinstall" run by a sudoer: $ sudo ink-install appname (for standard settings) or $ sudo ink-install appname -d database -u databaseuser -p databasepassword
			* The yeomen could be written by any contributor and a GUI is a higher roadmap priority. Feel free to pull-request in the repo: verber/yeomen
		5. Some special serfs, such as postinstall- don't always keep namespace tradition because it's not important and we want to keep serf names on the short side
		6. Here are some serf surnames to watch for:
			- install		(everything... web apps, inkVerb services, etc)
			- activate		(similar to install, but for an inkVerb service ready to go)
			- backup		(for apps, etc)
			- fix			(web config settings, such as www, wildcard alias, and https redirects; also used by wpfix to change code settings)
			- postinstall		(sometimes necessary after installing)
			- point			(domain forwarding)
			- new, add, kill	(users and domains, 'add' builds on an existing service or infrastructure created by 'new' or 'install', such as ftp, inknet, or domains)
			- set			(set/adjust site-wide settings)
			- show			(displays info already setup, that may be needed for other settings)
		7. Serf surnames that do jobs unique to a single service or app often start with the app/service name rather than the task.
			- wp			(WordPress)
			- inkcert (manages Letsencrypt & CertBot)
			- inkdkim (creating & managing OpenDKIM keys)
			- inkdns (managing the DNS zone, automatically populating it to the secondary DNS servers integrated by default)
			- mysql (MySQL on LAMP, MariaDB for LAEMP and LEMP)

III. inst contains files only used at installation and updates and some important root-user records
	A. `make-preverber`
		1. Installs basic tools needed before reboot before installing LEMP, etc.
		2. This is intended to work as a "canned", VPS-ready image, such as a VPS snapshot
	B. `make-verber-laemp` (`-lamp`, `-lemp`)
	  1. Installs all tools needed for a LAEMP Nginx-Apache server before a necessary reboot
		2. After running, no further Linux package manager installations are needed to install other web tools available on the verber
		3. One should run regular Linux updates on the verber after this, but it is theoretically not needed for the verber to funciton
		4. This has no customized settings
		5. This cannot be reversed (LAEMP can't change to LEMP, etc)
		6. This links `setubverb` to the serfs directory so it could be run by the same method as any API may handle serfs
		7. This is intended to work as a "canned", VPS-ready image, such as a VPS snapshot
	C. `setupverb`
	  1. This sets the customized user information, namespace, IP addresses, timezones, etc.
		2. This requires another reboot after completion
    3. Some settings, such as IP4 & IP6 addresses, can be changed after `setupverb` installation
		4. Most settings can't be changed after `setupverb` installation, including the hostname and timezone
		5. This deletes the inst directory and the `setupverb` link
		6. After this reboot, then a little more housekeeping
		  - inkDNS installation
			- inkCert installation
			- PostfixVmail installation
			- Obtain inkCert certs for all "verb" domains
			- Then the verber is ready to function

IV. The "donjon" - assets or "native apps"
	A. This is where native apps are kept. They may be written in Python or any other language.
	B. These apps are essential for the work of some routine tasks, often tied to cron tasks

V. inklists is meant for lists and repoes
	A. It contains universal, non-verber-specific config files that get updated regularly with the updateverber serf, such as version info
	B. It may contain more files once certain apps are installed

VI. tools contains common files and special root serfs needed for other CLI Clients logging in to do jobs on the verber (may be phased out)

VII. Special user services and folders
	A. VIP (tech tools)
		1. VIP users are often known as "ftpvips" created by newftpvip, sharing the srv/vip folder as "home", granting wide access to all other users' spaces
		2. VIP governs many other special users and folders for FTP, web control, directly managing files for "vipdomains" via the serf adddomainvip or adddomainfiler
		3. VIP has a direct link into an boss user's home folder, along side serfs and possibly others
		4. Note the "vip" folder is in srv/vip, with a symlink to /var/www/vip
	B. VSFTP
		1. VSFTP creates "files", "filevips", and "ftpusers". See: newftpfiler, newftpvip, and newftpuser for details
		2. A "domainfiler" is a VSFTP user with access to a hosted domain's folder
		3. The "_filecabinet" is a global folder shared by "ftpfilers", but not available to ftpusers
		4. VSFTP's main directory is srv/vip, with some subdirectories for users
	C. Fossil
		1. Fossil can create a user specific to a fossil via the serf: newfossiluser
		2. Fossil users are not a real user on the system, but uses a serf to be created.
		3. Fossil's folder is in srv/vip
	D. Bosses
		1. Bosses are sudoers, but also have special folders via the "verb/boss" box
		2. The "boss box" includes vip, tools, serfs, and Inker knights (if Inker is installed)
		3. Bosses do not have direct access to config files in their home folders
		4. The "boss box" is at local/verb/boss, but boss home folders are in home/

VIII. Server names
	A. The hostname of your server will be the main TLD
		1. For a normal, stand-alone, this means it will be: ink.YOURNAME.verb.ink
		2. For secondary installs, it will be such as blue.YOURNAME.verb.blue, etc.
		3. If you change to a non-inkVerb server, it could be such as: ink.YOURDOMAIN.com
	B. Custom server v inkVerb server
		1. An inkVerb verber server (using such as YOURNAME.verb.ink for $10 a year):
			- Offers to use the inkVerb repo for file installs, saving you additional server space (can't use with custom servers)
		2. A custom server (changes all verb.ink, verb.blue, etc to ink.YOURDOMAIN.com, blue.YOURDOMAIN.com, etc):
			- Cannot connect to the inkVerb repo, so you must follow the instructions to host your own.
			- Still uses the same file structure for inkVerb apps in the www/html directory
			- Retains nearly all other capabilities on the actual server

IX. Other notes
	A. Exit codes from bash scripts
		1. Scripts are ordered to minimize damage if exited from an error. WordPress, for example, will finish the basic install requirements before attempting a plugin download.
		2. Note: All bash scropts have a `set -e` declaration, so included scripts that `exit` other than `0` will abort the entire process. Here are some codes:
		- `0` - non-fatal `exit` (often used for benign failed argument validation or harmless unmet prerequisites)
		- `1` - used by Linux
		- `2` - used by Linux
		- `3` - aborted by user at prompt (changed mind, didn't type 'yes', etc.)
		- `4` - failed attempt, such as a file not downloaded or login credentials rejected, thus cannot proceed
		- `5` - unmet credentials (ie variables for a bash script are incomplete or incorrect, it could cause a problem if continuing)
		- `6` - catostrophic error (something is wrong that shouldn't be possible, such as a script is messed up or something was changed manually-incorrectly, this error status is only for circumstances that creat a problem that didn't exist before, errors that notice a pre-existing problem should `exit 0`)
		- `7` - already installed dilemma ('already installed' reports `7` only if it would cause a problem to continue, this is a mass abort `exit` status to avoid conflict. A benign 'already installed' will `exit 0`)
		- `8` - unmet dependency (the basic 'do your homework' message: something else should have been done first, but can't be complete automatically)
		- `9` - illegal attempt ('you are not allowed to destroy the system' or 'you are not authorized in this area' message)
	B. If statements, checks, and inclusions
		1. Scripts are organized to keep file size small and to standardize system-wide jobs, not to be fool-proof for lazy programming or new users.
		2. Many "if" checks and "usage" messages could be included in serfs, but are not because the user should more or less know what he is doing. Such errors will be in the yoeman tool for easier command line use and a GUI.
		3. The main purpose of "if" checks is for complex situations or to provide contingency alternatives for factors outside of the verber, such as failing to download a webapp for installation.
		4. Generally, failed "plugins" won't break an entire script; failing to download the core webapp will `exit 4` and the webapp won't be installed at all.
