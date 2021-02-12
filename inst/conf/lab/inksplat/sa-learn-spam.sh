#!/bin/sh

exec /usr/bin/spamc -u ${1} -L spam -C report
