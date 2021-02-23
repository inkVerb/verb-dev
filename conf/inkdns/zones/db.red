$TTL    86400
hostdomain286.		IN  SOA		DNSID286.DNSDOMAIN286. root.hostdomain286. (
0000000001		; Serial No
10800			; Refresh
3600			; Retry
604800			; Expire
1800 )			; Minimum TTL

$ORIGIN hostdomain286.
; Nameserver Defaults
@		IN  NS		ns1.DNSDOMAIN286.
@		IN  NS		ns2.DNSDOMAIN286.
@		IN  NS		ns3.DNSDOMAIN286.

; Root Site Defaults
@		IN  A		hostip286
@		IN  AAAA	hostipv6286
;; End Root Site Defaults

; Hostname Record Defaults
red.hostdomain286.		IN  A		hostip286
red.hostdomain286.		IN  AAAA	hostipv6286
act.hostdomain286.		IN  A		hostip286
act.hostdomain286.		IN  AAAA	hostipv6286
crm.hostdomain286.		IN  A		hostip286
crm.hostdomain286.		IN  AAAA	hostipv6286
erp.hostdomain286.		IN  A		hostip286
erp.hostdomain286.		IN  AAAA	hostipv6286
hrm.hostdomain286.		IN  A		hostip286
hrm.hostdomain286.		IN  AAAA	hostipv6286
odoo.hostdomain286.		IN  A		hostip286
odoo.hostdomain286.		IN  AAAA	hostipv6286
scm.hostdomain286.		IN  A		hostip286
scm.hostdomain286.		IN  AAAA	hostipv6286

; Aliase Default
www.hostdomain286.		IN  CNAME	hostdomain286.
*.hostdomain286.		IN  CNAME	hostdomain286.

; Text Record Defaults
hostdomain286.		IN  TXT		"v=spf1 a mx a:mailURI286 ip4:hostip286 ip6:hostipv6286 -all"
_dmarc.hostdomain286.		IN  TXT		"v=DMARC1; p=reject; fo=0; aspf=r; adkim=r; pct=100; ri=86400; rua=mailto:dmark@hostdomain286;"
