#!/bin/sh

# Black        0;30     Dark Gray     1;30
# Red          0;31     Light Red     1;31
# Green        0;32     Light Green   1;32
# Brown/Orange 0;33     Yellow        1;33
# Blue         0;34     Light Blue    1;34
# Purple       0;35     Light Purple  1;35
# Cyan         0;36     Light Cyan    1;36
# Light Gray   0;37     White         1;37

# Foreground & background colour commands

# tput setab [1-7] # Set the background colour using ANSI escape
# tput setaf [1-7] # Set the foreground colour using ANSI escape

# Colours are as follows:

# Num  Colour    #define         R G B

# 0    black     COLOR_BLACK     0,0,0
# 1    red       COLOR_RED       1,0,0
# 2    green     COLOR_GREEN     0,1,0
# 3    yellow    COLOR_YELLOW    1,1,0
# 4    blue      COLOR_BLUE      0,0,1
# 5    magenta   COLOR_MAGENTA   1,0,1
# 6    cyan      COLOR_CYAN      0,1,1
# 7    white     COLOR_WHITE     1,1,1

# cdefine variables
console="php /home/ela/webcamp/albinuta/bin/console"
green='\033[0;32m'
light_green='\033[1;32m'
orange='\033[0;33m'
yellow='\033[0;33m'
blue='\033[1;34m'
NC='\033[0m' # No Color
SECONDS=0

# run full-import using curl
start_date=`date +"%Y-%m-%d %T"`
printf "${NC}Import ${green}start: ${light_green}`date`${NC}\n\n"
tput setab 2
curl http://albinuta.local/app_dev.php/price-hunter/full-import
end_date=`date +"%Y-%m-%d %T"`
echo "${NC}Import ${green}finish: ${light_green}`date`"
duration=`date -d @$(( $(date -d "$end_date" +%s) - $(date -d "$start_date" +%s) )) -u +'%H:%M:%S'`
echo "${NC}Import ${green}duration: ${light_green} ${duration}"
echo "${blue}======================================================================\n${NC}"


# populate search
$console fos:elastica:populate

# clear cache for both prod and dev env
$console cache:clear --env=prod
$console cache:clear --env=dev


# do some work