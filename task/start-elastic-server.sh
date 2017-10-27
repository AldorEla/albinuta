#!/bin/sh

# cdefine variables
console="php /home/ela/webcamp/albinuta/bin/console"

# run full-import using curl
service elasticsearch start

# populate search
$console fos:elastica:populate
