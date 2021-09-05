#!/bin/bash

## Output styles
txtgrn=$(tput setaf 2)    # Green
txtred=$(tput setaf 1)    # Red
txtrst=$(tput sgr0)       # Text reset

## Get configuration parameters
source .env

## current user - will use in containers
export UID

## Run command in php-fmp container in specified path
function dc_run() {
  if [ ! $# -eq 1 ]; then echo 'ERROR: use dc_run "path" "command"'; exit 1; fi
  docker-compose exec php-fpm sh -c "cd /var/www/html/ && $1"
}

## Run php-fpm container
docker-compose up --build --remove-orphans -d php-fpm
printf "\n%-120s %s\n" "PHP-FPM server start [${txtgrn}Ok${txtrst}]"

## Run MySQL container
docker-compose up --build --remove-orphans -d mysql
printf "%-120s %s\n" "Starting MySQL server"

## Wait MySQL responce at 3306 port
dc_run "while ! nc -z $MYSQL_HOST 3306 > /dev/null 2>&1; do sleep 1 && echo -n .; done;"
printf "\n%-120s %s\n" "MySQL server start [${txtgrn}Ok${txtrst}]"

dc_run "mysql -hmysql -uroot -proot -e 'create database if not exists $MYSQL_DATABASE'"
dc_run "mysql -hmysql -uroot -proot -e \"grant all on $MYSQL_DATABASE.* to '$MYSQL_USER'@'%' identified by '$MYSQL_PASSWORD'\""

docker-compose up --build --remove-orphans -d nginx
printf "%-120s %s\n" "Webserver start [${txtgrn}Ok${txtrst}]"

docker ps --format "{{.Names}}:\t{{.Status}}\t{{.Ports}}"

exit 0;