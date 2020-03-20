#!/bin/sh

echo -e "\n### Run this script from the script folder ###"
read -p "Press enter to continue or ctrl+c to quit"

echo -e "\nChoose your OS [0]:\n0: LAMP\n1: MAMP"
read os
# Set default value
os=${os:-0}

##########
##########
echo -e "\n---SQL CONFIGURATION---"
##########
##########

echo -e "\nThis script and the sql file need to be on the same folder"
echo -e "The sql file name and the name of the database need to be the same"
read -p "Press enter to continue or ctrl+c to quit"


if [ $os -eq 0 ]; then 
	echo -e "\nDB_HOST [localhost]:"
	read host
	host=${host:-localhost}

	echo -e "\nDB_NAME:"
	read name

	echo -e "\nDB_USER [root]:"
	read user
	user=${user:-root}

	echo -e "\nDB_PWD [root]:"
	read -s pwd
	pwd=${pwd:-root}

	MYSQL="mysql --host=$host -u$user -p$pwd"
	$MYSQL -e "CREATE DATABASE IF NOT EXISTS $name CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
	$MYSQL $name < $name.sql
	
elif [ $os -eq 1 ]; then
	host="localhost"

	echo -e "\nDB_NAME:"
	read name

	user="root"
	pwd="root"

	MYSQL="/Applications/MAMP/Library/bin/mysql --host=$host -u$user -p$pwd"
	$MYSQL -e "CREATE DATABASE IF NOT EXISTS $name CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
	$MYSQL $name < $name.sql
fi

echo -e "\nSQL done"

##########
##########
echo -e "\n---PHP CONFIGURATION---"
##########
##########

touch config.php
cat > config.php << EOF
<?php

	define('DB_HOST',    '$host');
	define('DB_NAME',    '$name');
	define('DB_USER',    '$user');
	define('DB_PWD',     '$pwd');
EOF

echo -e "\nPHP done"

##########
##########
echo -e "\n---RIGHTS CONFIGURATION---"
##########
##########

if [ $os -eq 0 ]; then

	chown -R www-data:www-data /var/www/

	find /var/www/ -type d -exec chmod 750 {} ;
	find /var/www/ -type f -exec chmod 640 {} ;

elif [ $os -eq 1 ]; then
	echo -e "\nNo configuration needed"
fi

echo -e "\nRIGHTS done"