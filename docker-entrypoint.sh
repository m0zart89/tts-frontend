#!/bin/sh
htpasswd -b -c /var/www/.htpasswd ${AUTH_USER} ${AUTH_PASS}
